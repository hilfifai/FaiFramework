<?php

class SecureFunc extends SmartEncryptor{

}

class SmartEncryptor extends DBMigrator{
    private $defaultShift = 15;
    private $keyCharset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    private function generateKey($text, $mode = 'dinamis') {
        if ($mode === 'statis-search') {
            return substr(hash('sha256', $text), 0, strlen($text));
        }
        $seed = $text . microtime(true);
        return substr(hash('sha256', $seed), 0, strlen($text));
    }

    private function shiftChar($char, $shift) {
        $ord = ord($char);
        return chr(($ord + $shift) % 256);
    }

    private function unshiftChar($char, $shift) {
        $ord = ord($char);
        return chr(($ord - $shift + 256) % 256);
    }

    public function encrypt($text, $mode = 'dinamis') {
        $shift = $mode === 'statis-search' ? $this->defaultShift : rand(1, 25);
        $key = $this->generateKey($text, $mode);
        $result = '';

        for ($i = 0; $i < strlen($text); $i++) {
            $c = $text[$i];
            $k = $key[$i % strlen($key)];
            $result .= $this->shiftChar(chr(ord($c) ^ ord($k)), $shift);
        }

        $encoded = base64_encode($result);
        return $encoded . '_' . $shift; // pemisah tetap
    }

    public function decrypt($cipherTextWithShift, $originalTextRef = null, $mode = 'dinamis') {
        [$cipherText, $shift] = explode('_', $cipherTextWithShift);
        $shift = (int)$shift;
        $decoded = base64_decode($cipherText);
        $key = $this->generateKey($originalTextRef ?? $decoded, $mode);
        $result = '';

        for ($i = 0; $i < strlen($decoded); $i++) {
            $c = $this->unshiftChar($decoded[$i], $shift);
            $k = $key[$i % strlen($key)];
            $result .= chr(ord($c) ^ ord($k));
        }

        return $result;
    }
}
class DBMigrator {
    private $pdo;
    private $encryptor;
    private $engine;
    private $mapping = [];

    public function __construct($pdo, $encryptor, $engine = 'mysql') {
        $this->pdo = $pdo;
        $this->encryptor = $encryptor;
        $this->engine = $engine;
    }

    public function migrate($schema, $outputFolder) {
        $encDB = $this->encryptor->encrypt($schema['database'], "statis-search");
        $sql = "CREATE DATABASE IF NOT EXISTS `" . $encDB . "`;\nUSE `" . $encDB . "`;\n\n";

        foreach ($schema['tables'] as $table => $columns) {
            $encTable = $this->encryptor->encrypt($table, "statis-search");
            $this->mapping[$table]['_enc'] = $encTable;

            $sql .= "CREATE TABLE `$encTable` (\n";
            $fields = [];

            foreach ($columns as $field => $type) {
                $encField = $this->encryptor->encrypt($field, "statis-search");
                $fields[] = "`$encField` $type";
                $this->mapping[$table][$field] = $encField;
            }

            $sql .= implode(",\n", $fields) . "\n);\n\n";

            // Migrasi datanya juga
            $dataRows = $this->pdo->query("SELECT * FROM `$table`")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dataRows as $row) {
                $fields = [];
                $values = [];

                foreach ($row as $field => $value) {
                    $encField = $this->mapping[$table][$field];
                    $type = $columns[$field];
                    $fields[] = "`$encField`";

                    if (preg_match('/int|float|double|timestamp|datetime|date|numeric/i', $type)) {
                        $values[] = $this->pdo->quote($value);
                    } else {
                        $encValue = $this->encryptor->encrypt((string)$value, "statis-search");
                        $values[] = $this->pdo->quote($encValue);
                    }
                }

                $sql .= "INSERT INTO `$encTable` (" . implode(",", $fields) . ") VALUES (" . implode(",", $values) . ");\n";
            }

            $sql .= "\n";
        }

        // Simpan file SQL
        file_put_contents($outputFolder . '/export.sql', $sql);

        // Simpan mapping
        file_put_contents($outputFolder . '/mapping.json', json_encode($this->mapping, JSON_PRETTY_PRINT));
    }
}

// $pdo = new PDO("mysql:host=localhost;dbname=my_app_db", "root", "");
// $enc = new SmartEncryptor();

// $schema = [
//     'database' => 'my_app_db',
//     'tables' => [
//         'users' => [
//             'id' => 'INT PRIMARY KEY',
//             'username' => 'VARCHAR(100)',
//             'created_at' => 'DATETIME'
//         ],
//         'posts' => [
//             'id' => 'INT PRIMARY KEY',
//             'user_id' => 'INT',
//             'content' => 'TEXT',
//             'posted_at' => 'TIMESTAMP'
//         ]
//     ]
// ];

// $migrator = new DBMigrator($pdo, $enc);
// $migrator->migrate($schema, __DIR__ . '/output');