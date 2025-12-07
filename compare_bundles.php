<?php

class ClassComparator
{
    /**
     * Membandingkan 2 file class PHP dan menampilkan function yang hanya ada di file2.
     *
     * @param string $classFile1 Path ke file class pertama.
     * @param string $classFile2 Path ke file class kedua.
     * @return array Daftar function yang ada di class2 tapi tidak ada di class1.
     */
    function splitStaticFunctionToFiles($functionCode)
    {
        // Cari nama function
        if (!preg_match('/public\s+static\s+function\s+(\w+)\s*\(\)/', $functionCode, $matches)) {
            echo "Function tidak valid.\n";
            return;
        }

        $functionName = $matches[1];
        $folderPath = __DIR__ . "/$functionName";

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // Ambil bagian CSS, JS, HTML dari $return["..."]
        preg_match('/\$return\["css"\]\s*=\s*(.*?);/s', $functionCode, $cssMatch);
        preg_match('/\$return\["js"\]\s*=\s*(.*?);/s', $functionCode, $jsMatch);
        preg_match('/\$return\["html"\]\s*=\s*(.*?);/s', $functionCode, $htmlMatch);

        $css = trim(trim($cssMatch[1] ?? ""), "'\";");
        $js = trim(trim($jsMatch[1] ?? ""), "'\";");
        $html = trim(trim($htmlMatch[1] ?? ""), "'\";");

        // Bersihkan multiline HTML jika ada tanda heredoc/quoted
        $html = preg_replace('/^\'|\'$/s', '', $html);
        $html = str_replace(["\\n", "\\t"], ["\n", "\t"], $html);

        file_put_contents("$folderPath/{$functionName}.css.php", $css);
        file_put_contents("$folderPath/{$functionName}.js.php", $js);
        file_put_contents("$folderPath/{$functionName}.html.php", $html);

        // Generate code baru
        $newFunction = <<<PHP
public static function {$functionName}()
{
    \$return["css"] = file_get_contents(__DIR__ . "/$functionName/{$functionName}.css.php");
    \$return["js"] = file_get_contents(__DIR__ . "/$functionName/{$functionName}.js.php");
    \$return["html"] = file_get_contents(__DIR__ . "/$functionName/{$functionName}.html.php");
    return \$return;
}
PHP;

        echo "✅ Folder & file dibuat: $folderPath\n";
        echo "🔁 Ini kode function barunya:\n\n$newFunction\n";
    }

    public static function compareFunctions(string $classFile1, string $classFile2): array
    {
        if (!file_exists($classFile1) || !file_exists($classFile2)) {
            throw new Exception("❌ Salah satu file tidak ditemukan.");
        }

        $functions1 = self::extractStaticFunctions(file_get_contents($classFile1));
        $functions2 = self::extractStaticFunctions(file_get_contents($classFile2));

        $missingInClass1 = array_diff($functions2, $functions1);

        echo "🧠 Function yang ADA di class2 tetapi TIDAK ADA di class1:\n";
        foreach ($missingInClass1 as $func) {
            echo "- $func<br>";
        }

        return array_values($missingInClass1);
    }

    /**
     * Menangkap semua nama function static public dari sebuah kode class PHP.
     *
     * @param string $classCode Isi dari file class.
     * @return array List nama function.
     */
    private static function extractStaticFunctions(string $classCode): array
    {
        preg_match_all('/public\s+static\s+function\s+(\w+)\s*\(/', $classCode, $matches);
        return $matches[1] ?? [];
    }
}


$file1 = __DIR__ . '/FaiFramework\Structure\Content_class\BundleContent.php';
$file2 = __DIR__ . '/FaiFramework\Structure\Content_class\BundleContent2.php';
ClassComparator::compareFunctions($file1, $file2);
