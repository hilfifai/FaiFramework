<?php
class JsonApp {
    private string $dbPath;
    private string $fileJson;
    private string $cachePath;
    private const CACHE_ENABLED = false;

    /**
     * @param string $dbName Nama folder database di dalam direktori 'data'.
     * @param string $apiKey API Key yang dikirim oleh pengguna.
     * @throws Exception Jika API Key tidak valid atau path DB tidak ditemukan.
     */
    public function __construct(string $dbName,$type='json') {
        // Keamanan: Validasi API Key di awal
        //$this->validateApiKey($apiKey);
		if($type=='json'){
				$this->dbPath = __DIR__ . '/../../Pages/json/' . basename(trim($dbName)) . '/';
				$this->cachePath = __DIR__ . '/../../Pages/cache/';
		}else{
				$this->dbPath = __DIR__ . '/../../versions/generate_content/' . basename(trim($dbName)) . '/';
				$this->cachePath = __DIR__ . '/../../versions/generate_content/';
		}
		$this->fileJson = ""; 
        if (!is_dir($this->dbPath)) {
            throw new Exception("Database '$dbName' tidak ditemukan.");
        }
        if (!is_dir($this->cachePath) || !is_writable($this->cachePath)) {
            throw new Exception("Folder cache tidak ditemukan atau tidak writable.");
        }
    }

    /**
     * Memvalidasi API Key.
     * Di aplikasi nyata, ini bisa berupa pengecekan ke database.
     */
    private function validateApiKey(string $apiKey): void {
        $VALID_API_KEY = 'YOUR_SUPER_SECRET_API_KEY'; // Ganti dengan kunci Anda
        if ($apiKey !== $VALID_API_KEY) {
            throw new Exception("Akses ditolak: API Key tidak valid.", 401);
        }
    }

    /**
     * Metode utama untuk melakukan query.
     * @param array $conditions Berisi 'where', 'orderBy', dan 'limit'.
     * @return array Hasil query.
     */
    public function setfileJson($fileName) {
		$this->fileJson=$fileName;
	}
    public function query(array $conditions = []): array {
        $data = $this->loadData();

        // 1. Terapkan klausa WHERE
        if (!empty($conditions['where'])) {
            $data = $this->applyWhere($data, $conditions['where']);
        }

        // 2. Terapkan klausa ORDER BY
        if (!empty($conditions['orderBy'])) {
            $data = $this->applyOrderBy($data, $conditions['orderBy']);
        }

        // 3. Terapkan klausa LIMIT
        //if (!empty($conditions['limit'])) {
        //    $data = $this->applyLimit($data, $conditions['limit']);
        //}
		 $limit = $conditions['limit'] ?? null;
		$offset = $conditions['offset'] ?? 0; // Default offset adalah 0
        
        $data = $this->applyPagination($data, $limit, $offset);
        return $data;
    }

    /**
     * Memuat data dari cache atau dari file JSON jika cache usang.
     */
    private function loadData(): array {
        $cacheFile = $this->cachePath . md5($this->dbPath) . '.cache.json';

        if (self::CACHE_ENABLED && $this->isCacheValid($cacheFile)) {
            // Performa Tinggi: Muat dari cache
            return json_decode(file_get_contents($cacheFile), true);
        }

        // Performa Rendah (Hanya jalan sekali atau jika ada update): Gabungkan semua file JSON
        $combinedData = [];
		if(!$this->fileJson){
			$files = glob($this->dbPath . '*.json');
			foreach ($files as $file) {
				$content = file_get_contents($file);
				$jsonData = json_decode($content, true);
				if (is_array($jsonData)) {
					$combinedData = array_merge($combinedData, $jsonData);
				}
			}
        }else{
			$file = file_get_contents($this->dbPath.$this->fileJson.'.json');
			$jsonData = json_decode($content, true);
			if (is_array($jsonData)) {
				$combinedData = array_merge($combinedData, $jsonData);
			}
		}
        // Simpan ke cache untuk request berikutnya
        if (self::CACHE_ENABLED) {
            file_put_contents($cacheFile, json_encode($combinedData));
        }

        return $combinedData;
    }

    /**
     * Memeriksa apakah cache masih valid dengan membandingkan waktu modifikasi file.
     */
    private function isCacheValid(string $cacheFile): bool {
        if (!file_exists($cacheFile)) {
            return false;
        }
        $cacheTime = filemtime($cacheFile);
        $files = glob($this->dbPath . '*.json');
        foreach ($files as $file) {
            if (filemtime($file) > $cacheTime) {
                return false; // File sumber lebih baru dari cache, cache tidak valid
            }
        }
        return true;
    }

    /**
     * Memfilter data berdasarkan klausa WHERE.
     * Mendukung: =, !=, >, <, >=, <=, contains.
     */
	 private function applyWhere3(array $data, array $clauses): array {
        return array_filter($data, function ($item) use ($clauses) {
            foreach ($clauses as $clause) {
                // Ambil operator untuk diperiksa
                $operator = strtolower($clause['operator'] ?? '');
                
                // ---- TAMBAHAN BARU: Operator Kustom 'like_or_fields' ----
                if ($operator === 'like_or_fields') {
                    // Klausa ini butuh 'fields' (array) dan 'value'
                    $fieldsToSearch = $clause['fields'] ?? [];
                    $searchValue = $clause['value'] ?? '';
                    
                    if (empty($fieldsToSearch) || $searchValue === '') {
                        $match = true; // Jika tidak ada field/value, abaikan klausa ini
                    } else {
                        $regex = $this->likeToRegex($searchValue);
                        $fieldMatch = false; // Flag untuk menandai jika ada satu field yang cocok
                        foreach ($fieldsToSearch as $field) {
                            if (isset($item[$field]) && preg_match($regex, $item[$field])) {
                                $fieldMatch = true; // Ditemukan kecocokan!
                                break; // Karena ini OR, kita tidak perlu cek field lain
                            }
                        }
                        $match = $fieldMatch;
                    }

                } else {
                    // --- Logika yang sudah ada sebelumnya untuk operator lain ---
                    if (!isset($clause['field']) || !isset($item[$clause['field']]) || count($clause) !== 3) {
                        return false; // Klausa standar tidak valid, item gagal
                    }
                    [$field, $op, $value] = $clause;
                    $itemValue = $item[$field];
                    $match = false;
                    switch (strtolower($op)) {
                        case '=': $match = ($itemValue == $value); break;
                        case '!=': $match = ($itemValue != $value); break;
                        case '>': $match = ($itemValue > $value); break;
                        case '<': $match = ($itemValue < $value); break;
                        case '>=': $match = ($itemValue >= $value); break;
                        case '<=': $match = ($itemValue <= $value); break;
                        case 'contains': $match = (stripos($itemValue, $value) !== false); break;
                        case 'like':
                            $regex = $this->likeToRegex($value);
                            $match = (bool) preg_match($regex, $itemValue);
                            break;
                        case 'not like':
                            $regex = $this->likeToRegex($value);
                            $match = !((bool) preg_match($regex, $itemValue));
                            break;
                    }
                }
                
                if (!$match) return false; // Jika satu klausa (baik kustom maupun standar) tidak cocok, seluruh item gagal
            }
            return true; // Semua klausa cocok
        });
    }
	private function applyWhere(array $data, array $clauses): array {
    return array_filter($data, function ($item) use ($clauses) {
        foreach ($clauses as $clause) {
            $operator = strtolower($clause['operator'] ?? '');
            
            // ---- OPERATOR KUSTOM 'like_or_fields' dengan nested search ----
            if ($operator === 'like_or_fields') {
                $fieldsToSearch = $clause['fields'] ?? [];
                $searchValue = $clause['value'] ?? '';
                
                if (empty($fieldsToSearch) || $searchValue === '') {
                    $match = true;
                } else {
                    $regex = $this->likeToRegex($searchValue);
                    $fieldMatch = false;
                    
                    foreach ($fieldsToSearch as $field) {
                        // Handle nested fields dengan dot notation
						if ($field === 'barcode_varian' || $field === 'nama_varian') {
							
							if (isset($item['varian']) && is_array($item['varian'])) {
								foreach ($item['varian'] as $variant) {
									$variantValue = $variant[$field] ?? '';
									if ($variantValue && preg_match($regex, $variantValue)) {
										$fieldMatch = true;
										break 2; // Break kedua loop
									}
								}
							}
						}else
						if (strpos($field, '.') !== false) {
                            // Nested field: cari di dalam struktur nested
                            $nestedValue = $this->getNestedValue($item, $field);
                            if ($nestedValue !== null && preg_match($regex, $nestedValue)) {
                                $fieldMatch = true;
                                break;
                            }
                        } else {
                            // Regular field
                            if (isset($item[$field]) && preg_match($regex, $item[$field])) {
                                $fieldMatch = true;
                                break;
                            }
                        }
                    }
                    $match = $fieldMatch;
                }

            } else {
                // --- Logika untuk operator lain ---
                if (!isset($clause['field']) || count($clause) !== 3) {
                    return false;
                }
                
                $field = $clause['field'];
                $value = $clause['value'];
                
                // Handle nested fields untuk operator biasa
                if (strpos($field, '.') !== false) {
                    $itemValue = $this->getNestedValue($item, $field);
                } else {
                    $itemValue = $item[$field] ?? null;
                }
                
                if ($itemValue === null) {
                    return false;
                }
                
                $match = false;
                switch (strtolower($operator)) {
                    case '=': $match = ($itemValue == $value); break;
                    case '!=': $match = ($itemValue != $value); break;
                    case '>': $match = ($itemValue > $value); break;
                    case '<': $match = ($itemValue < $value); break;
                    case '>=': $match = ($itemValue >= $value); break;
                    case '<=': $match = ($itemValue <= $value); break;
                    case 'contains': $match = (stripos($itemValue, $value) !== false); break;
                    case 'like':
                        $regex = $this->likeToRegex($value);
                        $match = (bool) preg_match($regex, $itemValue);
                        break;
                    case 'not like':
                        $regex = $this->likeToRegex($value);
                        $match = !((bool) preg_match($regex, $itemValue));
                        break;
                }
            }
            
            if (!$match) return false;
        }
        return true;
    });
}
	private function getNestedValue(array $item, string $fieldPath) {
		$keys = explode('.', $fieldPath);
		$current = $item;
		
		foreach ($keys as $key) {
			if (!is_array($current) || !array_key_exists($key, $current)) {
				return null;
			}
			$current = $current[$key];
		}
		
		return is_scalar($current) ? $current : null;
	}
    private function applyWhere2(array $data, array $clauses): array {
        return array_filter($data, function ($item) use ($clauses) {
            foreach ($clauses as $clause) {
                // Pastikan format clause valid
                if (!isset($item[$clause['field']]) || count($clause) !== 3) {
                    return false;
                }
                [$field, $operator, $value] = $clause;
                
                $itemValue = $item[$field];
                $match = false;
                switch (strtolower($operator)) {
                    case '=': $match = ($itemValue == $value); break;
                    case '!=': $match = ($itemValue != $value); break;
                    case '>': $match = ($itemValue > $value); break;
                    case '<': $match = ($itemValue < $value); break;
                    case '>=': $match = ($itemValue >= $value); break;
                    case '<=': $match = ($itemValue <= $value); break;
                    case 'contains': $match = (stripos($itemValue, $value) !== false); break;
					case 'like':
                        $regex = $this->likeToRegex($value);
                        $match = (bool) preg_match($regex, $itemValue);
                        break;
                    
                    // ---- TAMBAHAN BARU UNTUK NOT LIKE ----
                    case 'not like':
                        $regex = $this->likeToRegex($value);
                        $match = !((bool) preg_match($regex, $itemValue));
                        break;
                }
                if (!$match) return false; // Jika satu klausa tidak cocok, seluruh item gagal
            }
            return true; // Semua klausa cocok
        });
    }
	private function likeToRegex(string $pattern): string {
        // 1. Escape karakter khusus regex yang mungkin ada di dalam pattern, kecuali % dan _
        $pattern = preg_quote($pattern, '/');

        // 2. Konversi wildcard SQL LIKE ke wildcard Regex
        //    % -> .* (nol atau lebih karakter apa pun)
        //    _ -> .  (tepat satu karakter apa pun)
        $pattern = str_replace('%', '.*', $pattern);
        $pattern = str_replace('_', '.', $pattern);

        // 3. Buat pola Regex lengkap:
        //    ^ -> Cocokkan dari awal string
        //    $ -> Cocokkan sampai akhir string
        //    i -> Case-insensitive (membuat LIKE tidak peka huruf besar/kecil)
        return '/^' . $pattern . '$/i';
    }
    /**
     * Mengurutkan data berdasarkan klausa ORDER BY.
     */
    private function applyOrderBy(array $data, array $clause): array {
        $field = $clause['field'] ?? null;
        $direction = strtolower($clause['direction'] ?? 'asc');

        if (!$field) return $data;

        usort($data, function ($a, $b) use ($field, $direction) {
            if (!isset($a[$field]) || !isset($b[$field])) return 0;
            
            $valA = $a[$field];
            $valB = $b[$field];

            $result = $valA <=> $valB; // Spaceship operator

            return ($direction === 'desc') ? -$result : $result;
        });
        return $data;
    }

    /**
     * Membatasi jumlah hasil.
     */
    private function applyLimit(array $data, int $limit): array {
        // Mengembalikan array dengan keys yang berurutan
        return array_values(array_slice($data, 0, $limit));
    }
	 private function applyPagination(array $data, ?int $limit, int $offset): array {
        // array_slice adalah fungsi PHP yang sempurna untuk ini.
        // Jika limit null, ambil semua data dari offset.
        $slicedData = array_slice($data, $offset, $limit);

        // Mengembalikan array dengan keys yang berurutan mulai dari 0
        return array_values($slicedData);
    }
}