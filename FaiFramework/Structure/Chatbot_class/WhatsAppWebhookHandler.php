<?php
class WhatsAppWebhookHandler
{

    //     // Contoh 1: Pesan dengan jumlah
    // $waData1 = [
    //     'from' => '+6281234567890',
    //     'message' => 'PESAN 103250850012304023:2 103250850012304017:1 103250850012304018'
    // ];

    // // Contoh 2: Pesan format alternatif
    // $waData2 = [
    //     'from' => '+6281234567890',
    //     'message' => 'PESAN 103250850012304023 2 103250850012304017 1'
    // ];

    // // Contoh 3: Payment
    // $waData3 = [
    //     'from' => '+6281234567890',
    //     'message' => 'PAYMENT ORD12345 BCA'
    // ];

    // // Contoh 4: Konfirmasi dengan attachment
    // $waData4 = [
    //     'from' => '+6281234567890',
    //     'message' => 'KONFIRMASI ORD12345',
    //     'media_url' => 'https://example.com/bukti-transfer.jpg'
    // ];

    // // Contoh 5: Status order
    // $waData5 = [
    //     'from' => '+6281234567890',
    //     'message' => 'STATUS ORD12345'
    // ];

    // // Proses
    // $result = WhatsAppWebhookHandler::handleOrderFromWA($page, $waData1);

    // // Response yang akan dikirim ke WhatsApp
    // if ($result['status'] == 1) {
    //     echo $result['message'];
    // } else {
    //     echo "❌ *ERROR*\n\n" . $result['message'];
    // }
    public static function handleOrderFromWA($page, $waData)
    {
        /**
         * Handler untuk pemesanan dari WhatsApp dengan berbagai format:
         * 1. PESAN [barcode1] [barcode2] ...
         * 2. PESAN [barcode1] [jumlah1] [barcode2] [jumlah2] ...
         * 3. PESAN [barcode]:[jumlah] [barcode]:[jumlah] ...
         */

        DB::beginTransaction();
        try {
            $nomor_wa = $waData['participant'];
            $message = trim($waData['content_message']);

            // Parse pesan
            $parts = explode(' ', $message);
            $command = strtoupper(array_shift($parts));

            // Handle berbagai command
            switch ($command) {
                case 'PESAN':
                    return self::handlePesanCommand($page, $nomor_wa, $parts);

                case 'PAYMENT':
                    return self::handlePaymentCommand($page, $nomor_wa, $parts);

                case 'KONFIRMASI':
                    return self::handleKonfirmasiCommand($page, $nomor_wa, $parts, $waData);

                case 'STATUS':
                case 'CEK':
                    return self::handleStatusCommand($page, $nomor_wa, $parts);
                case 'SEARCH':
                    return self::handleSearchFilterCommand($page, $nomor_wa, $parts);
                case 'BANTUAN':
                case 'HELP':
                    return self::handleHelpCommand();

                default:
                    return [
                        'status' => 0,
                        'message' => 'Format tidak dikenali. Ketik BANTUAN untuk melihat daftar perintah.'
                    ];
            }
        } catch (Exception $e) {
            DB::rollBack();
            return [
                'status' => 0,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ];
        }
    }
    private static function handleSearchCommand($page, $nomor_wa, $args)
    {
        /**
         * Format: SEARCH [keyword]
         * Contoh: SEARCH iPhone 13
         * Contoh: CARI laptop gaming
         * Contoh: PRODUK mouse wireless
         */

        if (empty($args)) {
            return [
                'status' => 0,
                'message' => 'Format salah. Gunakan: SEARCH [keyword]'
            ];
        }

        $keyword = implode(' ', $args);

        if (strlen($keyword) < 2) {
            return [
                'status' => 0,
                'message' => 'Keyword minimal 2 karakter'
            ];
        }

        // Cari produk
        $searchResults = self::searchProducts($page, $keyword);

        if (empty($searchResults)) {
            return [
                'status' => 0,
                'message' => "Produk dengan keyword '$keyword' tidak ditemukan.\n\nCoba gunakan keyword lain atau periksa ejaan."
            ];
        }

        // Format response
        $response = self::formatSearchResultsWA($searchResults, $keyword);

        return [
            'status' => 1,
            'message' => $response,
            'data' => [
                'keyword' => $keyword,
                'results_count' => count($searchResults)
            ]
        ];
    }

    private static function searchProducts($page, $keyword, $limit = 10)
    {
        /**
         * Mencari produk berdasarkan keyword
         * Mencari di:
         * 1. Nama barang
         * 2. Barcode
         * 3. Kategori
         * 4. Deskripsi
         */

        $sql = "SELECT DISTINCT
                    ial.id as id_asset,
                    ial.join_nama_barang,
                    ial.barcode,
                    ial.deskripsi,
                    sp.harga_jual,
                    sp.stok,
                    sp.id as id_produk,
                    sp.id_toko,
                    spt.nama_toko,
                    spk.nama_kategori,
                    GROUP_CONCAT(DISTINCT ialb.barcode SEPARATOR ', ') as barcode_lain,
                    (
                        CASE 
                            WHEN ial.join_nama_barang LIKE ? THEN 10
                            WHEN ial.barcode = ? THEN 9
                            WHEN ial.join_nama_barang LIKE ? THEN 8
                            WHEN ial.deskripsi LIKE ? THEN 5
                            WHEN ialb.barcode LIKE ? THEN 7
                            WHEN spk.nama_kategori LIKE ? THEN 4
                            ELSE 1
                        END
                    ) as relevance_score
                FROM inventaris__asset__list ial
                LEFT JOIN store__produk sp ON ial.id = sp.id_asset
                LEFT JOIN store__toko st ON sp.id_toko = st.id
                LEFT JOIN store__produk__kategori spk ON sp.id_kategori = spk.id
                LEFT JOIN inventaris__asset__list__barcode ialb ON ial.id = ialb.id_barang
                LEFT JOIN inventaris__asset__list__varian ialv ON ial.id = ialv.id_asset
                WHERE (ial.join_nama_barang LIKE ? 
                       OR ial.barcode LIKE ? 
                       OR ial.deskripsi LIKE ? 
                       OR ialb.barcode LIKE ?
                       OR spk.nama_kategori LIKE ?)
                    AND sp.active = 1
                    AND sp.stok > 0
                GROUP BY ial.id, ial.join_nama_barang, ial.barcode, sp.harga_jual, sp.stok
                ORDER BY relevance_score DESC, ial.join_nama_barang ASC
                LIMIT ?";

        $searchTerm = "%$keyword%";
        $exactMatch = $keyword;

        DB::queryRaw($page, $sql, [
            "$keyword%",       // nama dimulai dengan keyword (10)
            $exactMatch,       // barcode exact match (9)
            "%$keyword%",      // nama mengandung keyword (8)
            "%$keyword%",      // deskripsi mengandung keyword (5)
            "%$keyword%",      // barcode lain mengandung keyword (7)
            "%$keyword%",      // kategori mengandung keyword (4)
            $searchTerm,      // OR conditions
            $searchTerm,
            $searchTerm,
            $searchTerm,
            $searchTerm,
            $limit
        ]);

        $result = DB::get('all');

        if ($result['num_rows'] > 0) {
            return $result['row'];
        }

        // Fallback: Cari juga di varian
        return self::searchProductsInVariants($page, $keyword, $limit);
    }

    private static function searchProductsInVariants($page, $keyword, $limit)
    {
        $sql = "SELECT 
                    ial.id as id_asset,
                    ial.join_nama_barang,
                    ial.barcode,
                    sp.harga_jual,
                    sp.stok,
                    sp.id as id_produk,
                    iv.nama_varian_1,
                    iv.nama_varian_2,
                    iv.nama_varian_3,
                    spt.nama_toko
                FROM inventaris__asset__list ial
                LEFT JOIN inventaris__asset__list__varian ialv ON ial.id = ialv.id_asset
                LEFT JOIN inventaris__varian_1 iv ON ialv.id_varian_1 = iv.id
                LEFT JOIN inventaris__varian_2 iv2 ON ialv.id_varian_2 = iv2.id
                LEFT JOIN inventaris__varian_3 iv3 ON ialv.id_varian_3 = iv3.id
                LEFT JOIN store__produk sp ON ial.id = sp.id_asset
                LEFT JOIN store__toko spt ON sp.id_toko = spt.id
                WHERE (iv.nama_varian_1 LIKE ? 
                       OR iv2.nama_varian_2 LIKE ? 
                       OR iv3.nama_varian_3 LIKE ?)
                    AND sp.active = 1
                    AND sp.stok > 0
                GROUP BY ial.id
                LIMIT ?";

        $searchTerm = "%$keyword%";

        DB::queryRaw($page, $sql, [
            $searchTerm,
            $searchTerm,
            $searchTerm,
            $limit
        ]);

        $result = DB::get('all');

        return $result['num_rows'] > 0 ? $result['row'] : [];
    }

    private static function formatSearchResultsWA($results, $keyword)
    {
        $count = count($results);

        $response = "🔍 *HASIL PENCARIAN: '$keyword'*\n\n";
        $response .= "📊 Ditemukan: $count produk\n\n";

        if ($count > 10) {
            $response .= "⚠️ Menampilkan 10 hasil pertama\n\n";
        }

        foreach ($results as $index => $product) {
            $productNumber = $index + 1;

            $response .= "*{$productNumber}. {$product->join_nama_barang}*\n";

            // Harga
            if ($product->harga_jual) {
                $response .= "💰 Rp " . number_format($product->harga_jual, 0, ',', '.') . "\n";
            }

            // Stok
            $stokText = isset($product->stok) ? "Stok: {$product->stok}" : "Stok tersedia";
            $response .= "📦 $stokText\n";

            // Barcode
            if ($product->barcode) {
                $response .= "🏷️ Barcode: `{$product->barcode}`\n";
            }

            // Toko
            if (isset($product->nama_toko)) {
                $response .= "🏪 {$product->nama_toko}\n";
            }

            // Kategori
            if (isset($product->nama_kategori)) {
                $response .= "📂 {$product->nama_kategori}\n";
            }

            // Tombol aksi
            $response .= "🛒 Pesan: `PESAN {$product->barcode}`\n";

            $response .= "\n";
        }

        if ($count > 0) {
            $response .= "━━━━━━━━━━━━━━━━━━━━\n\n";
            $response .= "📋 *Cara Pesan:*\n";
            $response .= "1. Salin barcode produk\n";
            $response .= "2. Ketik: `PESAN [barcode]:[jumlah]`\n";
            $response .= "   Contoh: `PESAN {$results[0]->barcode}:1`\n\n";
            $response .= "🔍 *Cari Lagi:*\n";
            $response .= "Ketik: `SEARCH [keyword]`\n\n";
            $response .= "🆘 *Bantuan:*\n";
            $response .= "Ketik: `BANTUAN`";
        }

        return $response;
    }

    // Tambahkan juga function untuk DETAIL produk
    private static function handleDetailCommand($page, $nomor_wa, $args)
    {
        /**
         * Format: DETAIL [barcode]
         * Contoh: DETAIL 103250850012304023
         */

        if (empty($args)) {
            return [
                'status' => 0,
                'message' => 'Format salah. Gunakan: DETAIL [barcode]'
            ];
        }

        $barcode = $args[0];

        // Cari detail produk
        $productDetails = self::getProductDetails($page, $barcode);

        if (!$productDetails) {
            return [
                'status' => 0,
                'message' => "Produk dengan barcode '$barcode' tidak ditemukan.\n\nCoba cari dengan: SEARCH [nama produk]"
            ];
        }

        // Format response
        $response = self::formatProductDetailWA($productDetails);

        return [
            'status' => 1,
            'message' => $response
        ];
    }

    private static function getProductDetails($page, $barcode)
    {
        // Cari produk dengan detail lengkap
        $sql = "SELECT 
                    ial.*,
                    sp.*,
                    spt.nama_toko,
                    spt.alamat_toko,
                    spk.nama_kategori,
                    GROUP_CONCAT(DISTINCT 
                        CASE 
                            WHEN iv1.nama_varian_1 IS NOT NULL THEN iv1.nama_varian_1
                            WHEN iv2.nama_varian_2 IS NOT NULL THEN iv2.nama_varian_2
                            WHEN iv3.nama_varian_3 IS NOT NULL THEN iv3.nama_varian_3
                        END
                    SEPARATOR ', ') as varian,
                    GROUP_CONCAT(DISTINCT ialb.barcode SEPARATOR ', ') as semua_barcode,
                    (SELECT SUM(stok_available) 
                     FROM inventaris__storage__data isd 
                     WHERE isd.id_asset = ial.id) as total_stok
                FROM inventaris__asset__list ial
                LEFT JOIN store__produk sp ON ial.id = sp.id_asset
                LEFT JOIN store__toko spt ON sp.id_toko = spt.id
                LEFT JOIN store__produk__kategori spk ON sp.id_kategori = spk.id
                LEFT JOIN inventaris__asset__list__varian ialv ON ial.id = ialv.id_asset
                LEFT JOIN inventaris__varian_1 iv1 ON ialv.id_varian_1 = iv1.id
                LEFT JOIN inventaris__varian_2 iv2 ON ialv.id_varian_2 = iv2.id
                LEFT JOIN inventaris__varian_3 iv3 ON ialv.id_varian_3 = iv3.id
                LEFT JOIN inventaris__asset__list__barcode ialb ON ial.id = ialb.id_barang
                WHERE ial.barcode = ? 
                   OR ialb.barcode = ?
                GROUP BY ial.id
                LIMIT 1";

        DB::queryRaw($page, $sql, [$barcode, $barcode]);
        $result = DB::get('first');

        return $result['num_rows'] > 0 ? $result['row'] : false;
    }

    private static function formatProductDetailWA($product)
    {
        $response = "📋 *DETAIL PRODUK*\n\n";

        // Nama Produk
        $response .= "*{$product->join_nama_barang}*\n\n";

        // Harga
        if ($product->harga_jual) {
            $response .= "💰 *Harga:* Rp " . number_format($product->harga_jual, 0, ',', '.') . "\n";
        }

        // Stok
        $stok = $product->total_stok ?? $product->stok ?? 0;
        $stokStatus = $stok > 0 ? "✅ Tersedia ($stok)" : "❌ Habis";
        $response .= "📦 *Stok:* $stokStatus\n";

        // Barcode
        $response .= "🏷️ *Barcode Utama:* `{$product->barcode}`\n";

        // Barcode Lain
        if (!empty($product->semua_barcode)) {
            $response .= "🏷️ *Barcode Lain:* " . substr($product->semua_barcode, 0, 50) . "\n";
        }

        // Kategori
        if (!empty($product->nama_kategori)) {
            $response .= "📂 *Kategori:* {$product->nama_kategori}\n";
        }

        // Varian
        if (!empty($product->varian)) {
            $response .= "🎨 *Varian:* {$product->varian}\n";
        }

        // Toko
        if (!empty($product->nama_toko)) {
            $response .= "🏪 *Toko:* {$product->nama_toko}\n";
        }

        // Deskripsi
        if (!empty($product->deskripsi)) {
            $desc = strlen($product->deskripsi) > 100
                ? substr($product->deskripsi, 0, 100) . '...'
                : $product->deskripsi;
            $response .= "\n📝 *Deskripsi:*\n$desc\n";
        }

        $response .= "\n━━━━━━━━━━━━━━━━━━━━\n\n";
        $response .= "🛒 *Cara Pesan:*\n";
        $response .= "1. `PESAN {$product->barcode}:1` (qty 1)\n";
        $response .= "2. `PESAN {$product->barcode}:2` (qty 2)\n\n";
        $response .= "🔍 *Cari Produk Lain:*\n";
        $response .= "`SEARCH [nama produk]`\n\n";
        $response .= "📊 *Cek Status:*\n";
        $response .= "`STATUS [nomor order]`";

        return $response;
    }
    private static function handlePesanCommand($page, $nomor_wa, $args)
    {
        // Parse argumen untuk mendukung berbagai format
        $items = self::parsePesanArgs($args);

        if (empty($items)) {
            return [
                'status' => 0,
                'message' => 'Format salah. Gunakan: ' . self::getPesanFormatHelp()
            ];
        }

        // Cari atau buat user
        $user = self::getOrCreateUserByWA($page, $nomor_wa);
        if (!$user) {
            return [
                'status' => 0,
                'message' => 'Gagal membuat/mencari user'
            ];
        }
        $_SESSION['id_apps_user_wawebhook'] = $user->id_apps_user;
        $_SESSION['id_apps_user'] = $user->id_apps_user;

        // Proses setiap item
        $cartItems = [];
        $errorMessages = [];

        foreach ($items as $item) {
            $barcode = $item['barcode'];
            $qty = $item['qty'];

            $productInfo = self::getProductByBarcode($page, $barcode);

            if (!$productInfo) {
                $errorMessages[] = "Produk dengan barcode $barcode tidak ditemukan";
                continue;
            }

            // Tambah ke cart dengan quantity yang ditentukan
            $cartItem = self::addToCartFromWA($page, $productInfo, $user->id_apps_user, $qty);
            if ($cartItem['status'] != 1) {
                $errorMessages[] = $cartItem['message'];
                continue;
            }

            $cartItems[] = [
                'id_cart' => $cartItem['id_cart'],
                'qty' => $qty,
                'product_name' => $cartItem['product_name']
            ];
        }

        if (!empty($errorMessages)) {
            return [
                'status' => 0,
                'message' => implode("\n", $errorMessages)
            ];
        }

        if (empty($cartItems)) {
            return [
                'status' => 0,
                'message' => 'Tidak ada produk valid untuk diproses'
            ];
        }

        // Proses checkout
        $_POST['send_cart_proses'] = array_map(function ($item) {
            return [
                'id_cart' => $item['id_cart'],
                'qty' => $item['qty']
            ];
        }, $cartItems);

        $checkoutResult = self::processCheckoutFromWA($page);

        if ($checkoutResult['status'] != 1) {
            DB::rollBack();
            return $checkoutResult;
        }

        // Proses payment (default)
        $paymentResult = self::processPaymentFromWA($page, $checkoutResult['id']);

        if ($paymentResult['status'] != 1) {
            DB::rollBack();
            return $paymentResult;
        }

        DB::commit();

        // Format response
        $response = self::formatOrderConfirmationWA($checkoutResult, $cartItems);

        return [
            'status' => 1,
            'message' => $response,
            'data' => [
                'order_id' => $checkoutResult['id'],
                'items_count' => count($cartItems),
                'total_qty' => array_sum(array_column($cartItems, 'qty'))
            ]
        ];
    }

    private static function parsePesanArgs($args)
    {
        $items = [];
        $i = 0;
        $n = count($args);

        while ($i < $n) {
            $arg = $args[$i];

            // Format: barcode:qty
            if (strpos($arg, ':') !== false) {
                list($barcode, $qty) = explode(':', $arg);
                $items[] = [
                    'barcode' => trim($barcode),
                    'qty' => (int)$qty ?: 1
                ];
                $i++;
            }
            // Format: barcode qty
            elseif ($i + 1 < $n && is_numeric($args[$i + 1])) {
                $barcode = $arg;
                $qty = (int)$args[$i + 1];
                $items[] = [
                    'barcode' => $barcode,
                    'qty' => $qty
                ];
                $i += 2;
            }
            // Format: barcode saja (qty default 1)
            else {
                $items[] = [
                    'barcode' => $arg,
                    'qty' => 1
                ];
                $i++;
            }
        }

        return $items;
    }

    private static function handlePaymentCommand($page, $nomor_wa, $args)
    {
        /**
         * Format: PAYMENT [nomor_order] [metode_pembayaran]
         * Contoh: PAYMENT ORD12345 BCA
         * Contoh: PAYMENT ORD12345 BCA-Transfer
         */

        if (count($args) < 2) {
            return [
                'status' => 0,
                'message' => 'Format salah. Gunakan: PAYMENT [nomor_order] [metode_pembayaran]'
            ];
        }

        $orderId = $args[0];
        $paymentMethod = $args[1];

        // Cari user
        $user = self::getOrCreateUserByWA($page, $nomor_wa);
        if (!$user) {
            return [
                'status' => 0,
                'message' => 'User tidak ditemukan'
            ];
        }

        $_SESSION['id_apps_user_wawebhook'] = $user->id_apps_user;

        // Cari order
        $order = self::getOrderByIdentifier($page, $orderId, $user->id_apps_user);
        if (!$order) {
            return [
                'status' => 0,
                'message' => "Order $orderId tidak ditemukan atau bukan milik Anda"
            ];
        }

        // Cari metode pembayaran
        $paymentBrand = self::findPaymentBrand($page, $paymentMethod);
        if (!$paymentBrand) {
            $availableMethods = self::getAvailablePaymentMethods($page);
            return [
                'status' => 0,
                'message' => "Metode pembayaran '$paymentMethod' tidak tersedia.\nMetode yang tersedia:\n" . $availableMethods
            ];
        }

        // Proses pembayaran
        return self::processPaymentForOrder($page, $order, $paymentBrand);
    }

    private static function handleKonfirmasiCommand($page, $nomor_wa, $args, $waData)
    {
        /**
         * Format: KONFIRMASI [nomor_order] [attachment/foto]
         * Mendukung attachment dari WhatsApp
         */

        if (count($args) < 1) {
            return [
                'status' => 0,
                'message' => 'Format salah. Gunakan: KONFIRMASI [nomor_order]'
            ];
        }

        $orderId = $args[0];

        // Cari user
        $user = self::getOrCreateUserByWA($page, $nomor_wa);
        if (!$user) {
            return [
                'status' => 0,
                'message' => 'User tidak ditemukan'
            ];
        }

        // Cari order
        $order = self::getOrderByIdentifier($page, $orderId, $user->id_apps_user);
        if (!$order) {
            return [
                'status' => 0,
                'message' => "Order $orderId tidak ditemukan atau bukan milik Anda"
            ];
        }

        // Cek apakah ada attachment/foto
        $attachmentUrl = $waData['media_url'] ?? $waData['attachment'] ?? null;

        if (!$attachmentUrl) {
            return [
                'status' => 0,
                'message' => 'Silakan lampirkan bukti pembayaran (foto/attachment) bersama dengan pesan konfirmasi'
            ];
        }

        // Download attachment
        $buktiPembayaran = self::downloadAndSaveAttachment($page, $attachmentUrl, $order->id);

        if (!$buktiPembayaran) {
            return [
                'status' => 0,
                'message' => 'Gagal menyimpan bukti pembayaran'
            ];
        }

        // Update status pembayaran
        return self::updatePaymentConfirmation($page, $order, $buktiPembayaran);
    }
    private static function getOrCreateUserByWA($page, $nomor_wa)
    {
        // Cari user berdasarkan nomor WA
        DB::table('apps_user');
        DB::whereRaw("nomor_handphone = " . $nomor_wa);
        $user = DB::get('all');

        if ($user['num_rows'] > 0) {
            return $user['row'][0];
        }

        // Buat user baru jika tidak ditemukan
        $newUser = [
            'nama_lengkap' => 'Customer WA - ' . $nomor_wa,
            'nomor_handphone' => $nomor_wa,
            'username' => 'wa_' . preg_replace('/[^0-9]/', '', $nomor_wa),
            'password' => random_num(8), // Password default
            'create_date' => date('Y-m-d H:i:s'),
            'akses' => 'wa'
        ];

        $userId = DB::insert('apps_user', $newUser);

        if ($userId) {
            DB::table('apps_user');
            DB::whereRaw("nomor_handphone = " . $nomor_wa);
            $user = DB::get('all');

            if ($user['num_rows'] > 0) {
                return $user['row'][0];
            }
        }

        return false;
    }
    private static function getProductByBarcode($page, $barcode)
    {
        /**
         * Mencari produk berdasarkan barcode
         * Mencari di beberapa tabel: 
         * 1. inventaris__asset__list__barcode
         * 2. inventaris__asset__list (barcode utama)
         */

        // Cari di tabel barcode varian
        $sql = "SELECT 
                    barcode.*,
                    id_barang_varian as id_varian,
                    id_asset,
                    id_varian_1,
                    id_varian_2,
                    id_varian_3,
                    id_store_varian,
                    barcode.id as id_store__produk,
                    id_toko,
                    join_nama_barang,
                    harga_pokok_penjualan as harga_jual
                FROM view_produk_detail barcode
                
                WHERE (barcode = $barcode or barcode_varian = $barcode )  
                LIMIT 1";

        DB::queryRaw($page, $sql);
        $result = DB::get('all');

        if ($result['num_rows'] > 0) {
            return $result['row'][0];
        }

        return false;
    }
    private static function handleStatusCommand($page, $nomor_wa, $args)
    {
        if (count($args) < 1) {
            return [
                'status' => 0,
                'message' => 'Format salah. Gunakan: STATUS [nomor_order]'
            ];
        }

        $orderId = $args[0];

        // Cari user
        $user = self::getOrCreateUserByWA($page, $nomor_wa);
        if (!$user) {
            return [
                'status' => 0,
                'message' => 'User tidak ditemukan'
            ];
        }

        // Cari order
        $order = self::getOrderByIdentifier($page, $orderId, $user->id_apps_user);
        if (!$order) {
            return [
                'status' => 0,
                'message' => "Order $orderId tidak ditemukan atau bukan milik Anda"
            ];
        }

        // Get order details
        $orderDetails = self::getOrderDetails($page, $order->id);

        return [
            'status' => 1,
            'message' => self::formatOrderStatusWA($order, $orderDetails)
        ];
    }
    private static function searchProductsAdvanced($page, $keyword, $filters = [])
    {
        /**
         * Pencarian advanced dengan filter:
         * - Harga minimum
         * - Harga maksimum
         * - Kategori
         * - Toko
         * - Stok tersedia
         */

        $sql = "SELECT 
                ial.id as id_asset,
                ial.join_nama_barang,
                ial.barcode,
                sp.harga_jual,
                sp.stok,
                sp.id as id_produk,
                spt.nama_toko,
                spk.nama_kategori,
                CASE 
                    WHEN ial.join_nama_barang LIKE ? THEN 100
                    WHEN ial.join_nama_barang LIKE ? THEN 50
                    WHEN ial.deskripsi LIKE ? THEN 20
                    WHEN spk.nama_kategori LIKE ? THEN 15
                    ELSE 1
                END as search_score
            FROM inventaris__asset__list ial
            LEFT JOIN store__produk sp ON ial.id = sp.id_asset
            LEFT JOIN store__toko spt ON sp.id_toko = spt.id
            LEFT JOIN store__produk__kategori spk ON sp.id_kategori = spk.id
            WHERE sp.active = 1 
                AND sp.stok > 0";

        $params = [
            "$keyword%",   // Nama dimulai dengan
            "%$keyword%",  // Nama mengandung
            "%$keyword%",  // Deskripsi mengandung
            "%$keyword%"   // Kategori mengandung
        ];

        // Filter harga minimum
        if (isset($filters['min_price']) && $filters['min_price'] > 0) {
            $sql .= " AND sp.harga_jual >= ?";
            $params[] = $filters['min_price'];
        }

        // Filter harga maksimum
        if (isset($filters['max_price']) && $filters['max_price'] > 0) {
            $sql .= " AND sp.harga_jual <= ?";
            $params[] = $filters['max_price'];
        }

        // Filter kategori
        if (isset($filters['kategori']) && !empty($filters['kategori'])) {
            $sql .= " AND spk.nama_kategori LIKE ?";
            $params[] = "%{$filters['kategori']}%";
        }

        // Filter toko
        if (isset($filters['toko']) && !empty($filters['toko'])) {
            $sql .= " AND spt.nama_toko LIKE ?";
            $params[] = "%{$filters['toko']}%";
        }

        $sql .= " ORDER BY search_score DESC, sp.harga_jual ASC LIMIT 10";

        DB::queryRaw($page, $sql, $params);
        $result = DB::get('all');

        return $result['num_rows'] > 0 ? $result['row'] : [];
    }
    private static function handleSearchFilterCommand($page, $nomor_wa, $args)
    {
        /**
         * Format: SEARCH [keyword] HARGA [min]-[max] KATEGORI [kategori]
         * Contoh: SEARCH laptop HARGA 3000000-8000000 KATEGORI elektronik
         */

        $keyword = '';
        $filters = [];

        $i = 0;
        $n = count($args);

        while ($i < $n) {
            $arg = strtoupper($args[$i]);

            switch ($arg) {
                case 'HARGA':
                    if ($i + 1 < $n) {
                        $priceRange = $args[$i + 1];
                        if (strpos($priceRange, '-') !== false) {
                            list($min, $max) = explode('-', $priceRange);
                            $filters['min_price'] = (int)$min;
                            $filters['max_price'] = (int)$max;
                            $i += 2;
                        }
                    }
                    break;

                case 'KATEGORI':
                    if ($i + 1 < $n) {
                        $filters['kategori'] = $args[$i + 1];
                        $i += 2;
                    }
                    break;

                case 'TOKO':
                    if ($i + 1 < $n) {
                        $filters['toko'] = $args[$i + 1];
                        $i += 2;
                    }
                    break;

                default:
                    // Ini bagian dari keyword
                    $keyword .= ($keyword ? ' ' : '') . $args[$i];
                    $i++;
                    break;
            }
        }

        if (empty($keyword)) {
            return [
                'status' => 0,
                'message' => 'Format salah. Gunakan: SEARCH [keyword] [filter]\nContoh: SEARCH laptop HARGA 3000000-8000000'
            ];
        }

        $searchResults = self::searchProductsAdvanced($page, $keyword, $filters);

        if (empty($searchResults)) {
            $filterInfo = '';
            if (!empty($filters)) {
                $filterInfo = "\nFilter: " . json_encode($filters);
            }

            return [
                'status' => 0,
                'message' => "Produk '$keyword' tidak ditemukan dengan filter yang diberikan.$filterInfo"
            ];
        }

        $response = "🔍 *HASIL PENCARIAN DENGAN FILTER*\n\n";

        // Info filter
        if (!empty($filters)) {
            $response .= "*Filter Aktif:*\n";
            foreach ($filters as $key => $value) {
                $response .= "- " . ucfirst($key) . ": $value\n";
            }
            $response .= "\n";
        }

        $response .= self::formatSearchResultsWA($searchResults, $keyword);

        return [
            'status' => 1,
            'message' => $response,
            'data' => [
                'keyword' => $keyword,
                'filters' => $filters,
                'results_count' => count($searchResults)
            ]
        ];
    }
    private static function handleHelpCommand()
    {
        $help = "📋 *DAFTAR PERINTAH WHATSAPP*\n\n";
        $help .= "🔍 *PENCARIAN PRODUK*\n";
        $help .= "• SEARCH [keyword] - Cari produk\n";
        $help .= "  Contoh: SEARCH iPhone 13\n\n";

        $help .= "• DETAIL [barcode] - Detail produk\n";
        $help .= "  Contoh: DETAIL 103250850012304023\n\n";

        $help .= "🛒 *PEMESANAN*\n";
        $help .= "• PESAN [barcode1] [barcode2] ...\n";
        $help .= "  Contoh: PESAN 103250850012304023\n\n";

        $help .= "• PESAN [barcode1]:[qty1] [barcode2]:[qty2] ...\n";
        $help .= "  Contoh: PESAN 103250850012304023:2 103250850012304017:1\n\n";

        $help .= "• PESAN [barcode1] [qty1] [barcode2] [qty2] ...\n";
        $help .= "  Contoh: PESAN 103250850012304023 2 103250850012304017 1\n\n";

        $help .= "💳 *PEMBAYARAN*\n";
        $help .= "• PAYMENT [nomor_order] [metode]\n";
        $help .= "  Contoh: PAYMENT ORD12345 BCA\n\n";

        $help .= "✅ *KONFIRMASI*\n";
        $help .= "• KONFIRMASI [nomor_order] [lampirkan foto bukti]\n";
        $help .= "  Kirim foto bukti transfer dengan caption: KONFIRMASI ORD12345\n\n";

        $help .= "📊 *STATUS*\n";
        $help .= "• STATUS [nomor_order]\n";
        $help .= "  Contoh: STATUS ORD12345\n\n";

        $help .= "🆘 *BANTUAN*\n";
        $help .= "• BANTUAN atau HELP\n";

        return [
            'status' => 1,
            'message' => $help
        ];
    }

    private static function processPaymentForOrder($page, $order, $paymentBrand)
    {
        // Set data untuk proses_bayar
        $_POST['checkout_id'] = $order->id;
        $_POST['brand_pembayaran'] = $paymentBrand['id'] . '-' . $paymentBrand['webapps_id'];
        $_POST['biaya_payment_user'] = 0;
        $_POST['biaya_payment_system'] = 0;

        try {
            ob_start();
            ApiApp::proses_bayar($page);
            $output = ob_get_clean();

            $result = json_decode($output, true);

            if ($result['status'] == 1) {
                // Get payment details
                $paymentDetails = self::getPaymentDetails($page, $result['id']);

                return [
                    'status' => 1,
                    'message' => self::formatPaymentConfirmationWA($order, $paymentDetails, $paymentBrand)
                ];
            } else {
                return [
                    'status' => 0,
                    'message' => 'Gagal memproses pembayaran. Silakan coba lagi.'
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => 0,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }

    private static function updatePaymentConfirmation($page, $order, $buktiPembayaran)
    {
        // Cari payment terbaru untuk order ini
        DB::table('erp__pos__payment');
        DB::whereRaw('id_erp__pos__group = ?', [$order->id]);
        DB::orderByRaw($page, [['id', 'desc']]);
        $payment = DB::get('first');

        if ($payment['num_rows'] == 0) {
            return [
                'status' => 0,
                'message' => 'Data pembayaran tidak ditemukan untuk order ini'
            ];
        }

        // Update bukti pembayaran
        $updateData = [
            'bukti_payment' => $buktiPembayaran,
            'status_payment' => 'Menunggu Verifikasi',
            'tanggal_konfirmasi' => date('Y-m-d H:i:s')
        ];

        DB::update('erp__pos__payment', $updateData, 'id = ' . $payment['row']->id);

        // Update status group
        DB::update('erp__pos__group', [
            'status' => 'Menunggu Verifikasi'
        ], 'id = ' . $order->id);

        // Kirim notifikasi ke admin
        self::notifyAdminPaymentConfirmation($page, $order, $buktiPembayaran);

        return [
            'status' => 1,
            'message' => "✅ *BUKTI PEMBAYARAN BERHASIL DIKIRIM*\n\n" .
                "Nomor Order: #{$order->nomor_group}\n" .
                "Status: Menunggu verifikasi admin\n\n" .
                "Terima kasih telah melakukan konfirmasi pembayaran."
        ];
    }

    private static function downloadAndSaveAttachment($page, $url, $orderId)
    {
        // Download file dari URL
        $tempFile = tempnam(sys_get_temp_dir(), 'wa_payment_');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $fileData = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != 200 || !$fileData) {
            return false;
        }

        file_put_contents($tempFile, $fileData);

        // Determine file type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $tempFile);
        finfo_close($finfo);

        $extension = self::getExtensionFromMime($mimeType);
        $fileName = 'bukti_payment_' . $orderId . '_' . time() . '.' . $extension;

        // Save to server
        $uploadDir = 'uploads/payment_proof/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $destination = $uploadDir . $fileName;

        if (copy($tempFile, $destination)) {
            unlink($tempFile);
            return $destination;
        }

        unlink($tempFile);
        return false;
    }

    private static function getExtensionFromMime($mimeType)
    {
        $mimeMap = [
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'application/pdf' => 'pdf'
        ];

        return $mimeMap[$mimeType] ?? 'jpg';
    }

    private static function getOrderByIdentifier($page, $identifier, $userId)
    {
        // Cari dengan nomor_group atau ID
        DB::table('erp__pos__group');
        DB::whereRaw(
            '(nomor_group = ? OR id = ?) AND id_apps_user_wawebhook = ?',
            [$identifier, $identifier, $userId]
        );
        $result = DB::get('first');

        if ($result['num_rows'] > 0) {
            return $result['row'];
        }

        return false;
    }

    private static function findPaymentBrand($page, $paymentMethod)
    {
        // Cari payment method berdasarkan nama
        $sql = "SELECT 
                    wpmb.id,
                    wpmb.nama_brand,
                    wpw.id as webapps_id,
                    wpw.no_rek_webapps,
                    wpw.atas_nama_webapps
                FROM webmaster__payment_method_brand wpmb
                LEFT JOIN webmaster__payment_webapps wpw 
                    ON wpmb.id = wpw.id_payment_brand
                WHERE LOWER(wpmb.nama_brand) LIKE LOWER(?)
                AND wpw.active = 1
                LIMIT 1";

        DB::queryRaw($page, $sql, ["%$paymentMethod%"]);
        $result = DB::get('first');

        if ($result['num_rows'] > 0) {
            return $result['row'];
        }

        return false;
    }

    private static function getAvailablePaymentMethods($page)
    {
        $sql = "SELECT DISTINCT nama_brand 
                FROM webmaster__payment_method_brand wpmb
                LEFT JOIN webmaster__payment_webapps wpw 
                    ON wpmb.id = wpw.id_payment_brand
                WHERE wpw.active = 1
                ORDER BY nama_brand";

        DB::queryRaw($page, $sql);
        $result = DB::get('all');

        $methods = [];
        foreach ($result['row'] as $row) {
            $methods[] = $row->nama_brand;
        }

        return implode(', ', $methods);
    }

    private static function getPaymentDetails($page, $paymentId)
    {
        DB::table('erp__pos__payment');
        DB::whereRaw('id = ?', [$paymentId]);
        $result = DB::get('first');

        return $result['row'] ?? null;
    }

    private static function getOrderDetails($page, $orderId)
    {
        $sql = "SELECT 
                    epd.qty,
                    epd.total_harga,
                    ial.join_nama_barang,
                    sp.harga_jual,
                    epg.nomor_group,
                    epg.status,
                    epg.total as total_order,
                    epg.create_date,
                    ep.nomor_payment,
                    ep.status_payment
                FROM erp__pos__group epg
                LEFT JOIN erp__pos__utama epu ON epg.id = epu.id_erp__pos__group
                LEFT JOIN erp__pos__utama__detail epd ON epu.id = epd.id_erp__pos__utama
                LEFT JOIN inventaris__asset__list ial ON epd.id_inventaris__asset__list = ial.id
                LEFT JOIN store__produk sp ON ial.id = sp.id_asset
                LEFT JOIN erp__pos__payment ep ON epg.id_payment = ep.id
                WHERE epg.id = ?
                ORDER BY epd.create_date";

        DB::queryRaw($page, $sql, [$orderId]);
        return DB::get('all');
    }

    private static function formatOrderConfirmationWA($checkoutResult, $cartItems)
    {
        $response = "✅ *PEMESANAN BERHASIL DIBUAT*\n\n";
        $response .= "📦 *No. Order:* #{$checkoutResult['id']}\n";
        $response .= "📅 Tanggal: " . date('d/m/Y H:i') . "\n";
        $response .= "━━━━━━━━━━━━━━━━━━━━\n\n";
        $response .= "📋 *Detail Pesanan:*\n";

        $total = 0;
        foreach ($cartItems as $index => $item) {
            $response .= ($index + 1) . ". {$item['product_name']}\n";
            $response .= "   Qty: {$item['qty']}\n";
            $response .= "\n";
        }

        $response .= "━━━━━━━━━━━━━━━━━━━━\n";
        $response .= "Total Item: " . count($cartItems) . "\n";
        $response .= "Total Qty: " . array_sum(array_column($cartItems, 'qty')) . "\n\n";
        $response .= "💰 *Total:* Menunggu konfirmasi\n\n";
        $response .= "📋 *Langkah Selanjutnya:*\n";
        $response .= "1. Ketik: STATUS #{$checkoutResult['id']}\n";
        $response .= "   Untuk melihat total pembayaran\n\n";
        $response .= "2. Ketik: PAYMENT #{$checkoutResult['id']} [METODE]\n";
        $response .= "   Contoh: PAYMENT #{$checkoutResult['id']} BCA\n\n";
        $response .= "3. Setelah transfer, kirim bukti dengan:\n";
        $response .= "   KONFIRMASI #{$checkoutResult['id']}\n";
        $response .= "   (Lampirkan foto bukti transfer)\n\n";
        $response .= "Terima kasih telah berbelanja! 🛍️";

        return $response;
    }

    private static function formatPaymentConfirmationWA($order, $paymentDetails, $paymentBrand)
    {
        $response = "💳 *INFORMASI PEMBAYARAN*\n\n";
        $response .= "📦 No. Order: #{$order->nomor_group}\n";
        $response .= "💰 Total: Rp " . number_format($order->total, 0, ',', '.') . "\n";
        $response .= "📋 Metode: {$paymentBrand->nama_brand}\n\n";

        if ($paymentBrand->no_rek_webapps) {
            $response .= "🏦 *Rekening Tujuan:*\n";
            $response .= "Bank: {$paymentBrand->nama_brand}\n";
            $response .= "No. Rek: {$paymentBrand->no_rek_webapps}\n";
            $response .= "A/N: {$paymentBrand->atas_nama_webapps}\n\n";
        }

        if ($paymentDetails && $paymentDetails->nomor_payment) {
            $response .= "📄 No. Pembayaran: {$paymentDetails->nomor_payment}\n";
        }

        $response .= "━━━━━━━━━━━━━━━━━━━━\n\n";
        $response .= "📋 *Cara Pembayaran:*\n";
        $response .= "1. Transfer sesuai total di atas\n";
        $response .= "2. Simpan bukti transfer\n";
        $response .= "3. Balas pesan ini dengan:\n";
        $response .= "   KONFIRMASI #{$order->nomor_group}\n";
        $response .= "   (Lampirkan foto bukti transfer)\n\n";
        $response .= "⏰ *Batas Waktu:* 24 jam\n";
        $response .= "Setelah itu order akan dibatalkan otomatis.";

        return $response;
    }

    private static function formatOrderStatusWA($order, $orderDetails)
    {
        $response = "📊 *STATUS ORDER #{$order->nomor_group}*\n\n";
        $response .= "📅 Tanggal: " . date('d/m/Y', strtotime($order->create_date)) . "\n";
        $response .= "📋 Status: {$order->status}\n";
        $response .= "💰 Total: Rp " . number_format($order->total, 0, ',', '.') . "\n\n";

        if ($orderDetails['num_rows'] > 0) {
            $response .= "━━━━━━━━━━━━━━━━━━━━\n";
            $response .= "📦 *Detail Items:*\n";

            $totalItems = 0;
            foreach ($orderDetails['row'] as $index => $item) {
                $response .= ($index + 1) . ". {$item->join_nama_barang}\n";
                $response .= "   Qty: {$item->qty} x Rp " . number_format($item->harga_jual, 0, ',', '.') . "\n";
                $response .= "   Subtotal: Rp " . number_format($item->total_harga, 0, ',', '.') . "\n\n";
                $totalItems += $item->qty;
            }

            $response .= "Total Item: " . $orderDetails['num_rows'] . "\n";
            $response .= "Total Qty: " . $totalItems . "\n";
        }

        $response .= "\n━━━━━━━━━━━━━━━━━━━━\n";
        $response .= "📋 *Status Pembayaran:*\n";

        if ($order->status_payment) {
            $response .= "{$order->status_payment}\n";

            if ($order->status_payment == 'Menunggu Verifikasi') {
                $response .= "\n⚠️ *PENTING:*\n";
                $response .= "Admin sedang memverifikasi pembayaran Anda.\n";
                $response .= "Proses verifikasi membutuhkan waktu 1-2 jam.\n";
            }
        } else {
            $response .= "Belum dibayar\n";
            $response .= "\n💳 *Untuk pembayaran, ketik:*\n";
            $response .= "PAYMENT #{$order->nomor_group} [METODE]\n";
            $response .= "Contoh: PAYMENT #{$order->nomor_group} BCA\n";
        }

        return $response;
    }

    private static function getPesanFormatHelp()
    {
        return "Beberapa format yang didukung:\n" .
            "1. PESAN 103250850012304023\n" .
            "2. PESAN 103250850012304023 2\n" .
            "3. PESAN 103250850012304023:2\n" .
            "4. PESAN 103250850012304023:2 103250850012304017:1";
    }
    private static function processCheckoutFromWA($page)
    {
        // Simulate $_POST data
        $originalPost = $_POST;
        
        try {
            // Panggil fungsi checkout yang sudah ada
            ob_start();
            ApiApp::proses_checkout($page);
            $output = ob_get_clean();
            
            $result = json_decode($output, true);
            
            // Restore original POST
            $_POST = $originalPost;
            
            return $result;
            
        } catch (Exception $e) {
            $_POST = $originalPost;
            return [
                'status' => 0,
                'message' => 'Checkout gagal: ' . $e->getMessage()
            ];
        }
    }
    private static function processPaymentFromWA($page, $orderId)
    {
        // Set default payment data
        $paymentData = [
            'checkout_id' => $orderId,
            'penerima' => 0, // Default alamat
            'tipe_pemesanan' => 'dropship-ecommerce',
            'dropship_toko' => 0,
            'nomor_resi_ecommerce' => '-',
            'ekspedisi_ecommerce' => '-',
            'service_ecommerce' => '-',
            'plaform_ecommerce' => 'WhatsApp',
            'ongkir' => json_encode([]),
            'file_resi_ecommerce' => null
        ];
        
        // Simulate $_POST data
        $originalPost = $_POST;
        $_POST = array_merge($_POST, $paymentData);
        
        try {
            ob_start();
            ApiApp::proses_payment($page);
            $output = ob_get_clean();
            
            $result = json_decode($output, true);
            
            // Restore original POST
            $_POST = $originalPost;
            
            return $result;
            
        } catch (Exception $e) {
            $_POST = $originalPost;
            return [
                'status' => 0,
                'message' => 'Payment gagal: ' . $e->getMessage()
            ];
        }
    }
    
    private static function formatWAResponse($paymentResult, $checkoutResult, $cartItems)
    {
        $response = "✅ *PEMESANAN BERHASIL*\n\n";
        $response .= "Nomor Order: #" . $checkoutResult['id'] . "\n";
        $response .= "Jumlah Item: " . count($cartItems) . "\n";
        $response .= "Status: Menunggu Pembayaran\n\n";
        $response .= "Silakan lanjutkan pembayaran melalui link berikut:\n";
        $response .= "https://yourdomain.com/payment/" . $checkoutResult['id'] . "\n\n";
        $response .= "Terima kasih telah berbelanja!";
        
        return $response;
    }
    private static function addToCartFromWA($page, $productInfo, $userId, $qty = 1)
    {
        $fai = new MainFaiFramework();
        
        // Siapkan data untuk cart
        $data = [
            'id_apps_user' => $userId,
            'id_produk' => $productInfo->id_store__produk ?? $productInfo->id_produk,
            'id_asset' => $productInfo->id_asset,
            'id_asset_varian' => $productInfo->id_varian ?? null,
            'id_produk_varian' => $productInfo->id_store_varian ?? null,
            'id_varian_pra_order_1' => $productInfo->id_varian_1 ?? 0,
            'id_varian_pra_order_2' => $productInfo->id_varian_2 ?? 0,
            'id_varian_pra_order_3' => $productInfo->id_varian_3 ?? 0,
            'jumlah' => $qty,
            'create_date' => date('Y-m-d H:i:s'),
            // 'harga_satuan' => $productInfo->harga_jual ?? 0,
            // 'total_harga' => ($productInfo->harga_jual ?? 0) * $qty
        ];

        // Cek stok
        $stokData = [
            'id_produk' => $data['id_produk'],
            'id_asset' => $data['id_asset'],
            'id_asset_varian' => $data['id_asset_varian'],
            'id_produk_varian' => $data['id_produk_varian']
        ];

        $stok_available = EcommerceApp::stok_satuan($stokData);

        if ($qty > $stok_available) {
            return [
                'status' => 0,
                'message' => "Stok tidak cukup untuk produk: " . ($productInfo->join_nama_barang ?? 'Unknown') .
                    " (Stok: $stok_available, Pesan: $qty)"
            ];
        }

        // Insert ke cart
        DB::insert('erp__pos__pra_order', $data);
        $cartId = DB::lastInsertId($page,'erp__pos__pra_order');

        if ($cartId) {
            return [
                'status' => 1,
                'id_cart' => $cartId,
                'product_name' => $productInfo->join_nama_barang ?? 'Unknown',
                'qty' => $qty
            ];
        }

        return [
            'status' => 0,
            'message' => 'Gagal menambahkan ke keranjang'
        ];
    }
}
