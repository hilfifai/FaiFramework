<?php

class VersionApp
{

    public static function admin($page)
    {
        include __DIR__ . '/../../versions/admin/index.php';
    }
    public static function get_versions($page)
    {
        DB::connection($page);
        DB::table('web__versions');
        DB::orderRaw($page, 'id desc');
        $all = DB::get('all');
        echo json_encode(
            [
                "success" => 1,
                "data"    => $all['row'],
            ]);
    }
    public static function add_version($page)
    {
        try {
            $name    = $_POST['version_name'] ?? '';
            $status  = $_POST['status'] ?? 'alpha';
            $encrypt = isset($_POST['encryption_enabled']) ? 1 : 0;
            $fai     = new MainFaiFramework();
            DB::connection($page);
            $insert['version_name'] = $name;
            $insert['status']       = $status;
            $insert['encrypt']      = $encrypt;
            CRUDFunc::crud_insert($fai, $page, $insert, [], 'web__versions');
            echo json_encode(["success" => 1]);
        } catch (Exception $e) {
            echo $e->getMassage();
            echo '<pre>';
            echo $e->getTraceAsString();
        }
    }public static function get($page)
    {
        try {
            $domain = $_POST['domain'] ?? '';

            $fai = new MainFaiFramework();
            DB::connection($page);
            DB::table('web__versions__user');
            DB::joinRaw('web__versions on id_web__versions  = web__versions.id ', 'left');
            DB::whereRaw("domain='$domain'");
            $user = DB::get('all');
            if ($user['num_rows'] == 0) {
                DB::table('web__versions');
                DB::orderRaw($page, 'create_date desc');
                $all = DB::get('all');

                echo json_encode([
                    "success"      => 1,
                    "version_name" => $all['row'][0]->version_name,
                ]);
            } else {
                echo json_encode(
                    [
                        "success"      => 1,
                        "version_name" => $user['row'][0]->version_name,
                    ]);
            }
        } catch (Exception $e) {
            echo $e->getMassage();
            echo '<pre>';
            echo $e->getTraceAsString();
        }
    }public static function get_content($page)
    {
        try {
            $id = $_POST['id'] ?? '';

            $fai = new MainFaiFramework();
            DB::connection($page);
            DB::table('web__versions');
            DB::orderRaw($page, 'create_date desc');
            $all = DB::get('all');
            echo json_encode(
                [
                    "success" => 1,
                    "data"    => $all['row'][0],
                ]);
            echo json_encode(["success" => 1]);
        } catch (Exception $e) {
            echo $e->getMassage();
            echo '<pre>';
            echo $e->getTraceAsString();
        }
    }
    public static function generate($page)
    {
        ini_set('memory_limit', '1024M'); // atau 2G jika perlu
        $fai = new MainFaiFramework();
        $id  = $fai->input('id');
        DB::connection($page);
        DB::table('web__versions');
        DB::whereRaw('id=' . $id);
        $all = DB::get('all');

        $version_name        = $all['row'][0]->version_name;
        $fileName            = 'Fai-Version-Template.json';
        $data['main_page']   = $main_page   = json_decode(trim(file_get_contents($fileName)), true);
        $fileName            = 'Fai-Version-Template-Menu.json';
        $data['main_menu']   = $main_menu   = json_decode(trim(file_get_contents($fileName)), true);
        $fileName            = 'Fai-Version-Template-App.json';
        $data['main_app']    = $main_app    = json_decode(trim(file_get_contents($fileName)), true);
        $fileName            = 'Fai-Version-Template-MenuList.json';
        $data['menu_list']   = $menu_list   = json_decode(trim(file_get_contents($fileName)), true);
        $fileName            = 'Fai-Version-Template-Search.json';
        $data['main_search'] = $main_search = json_decode(trim(file_get_contents($fileName)), true);

        function get_compres($main_compres)
        {
            $m_compres                  = [];
            $m_compres['data-versions'] = $main_compres['data-versions'];
            foreach ($main_compres['versions'] as $nama => $version) {
                '<br>' . $nama . '$' . $get_last                     = $version['last_version'];
                $m_compres['versions'][$nama]['last_version']        = $get_last;
                $m_compres['versions'][$nama]['last_generate_date']  = $version['last_generate_date'];
                $m_compres['versions'][$nama]['versions'][$get_last] = $version['versions'][$get_last];
            }
            return $m_compres;
        }
        function get_compres2($main_compres)
        {
            $m_compres                  = [];
            $m_compres['data-versions'] = $main_compres['data-versions'];
            foreach ($main_compres['versions'] as $app => $aversion) {
                foreach ($aversion as $func => $version) {
                    '<br>' . $app . $func . '$' . $get_last                    = $version['last_version'];
                    $m_compres['versions'][$app][$func]['last_version']        = $get_last;
                    $m_compres['versions'][$app][$func]['last_generate_date']  = $version['last_generate_date'];
                    $m_compres['versions'][$app][$func]['versions'][$get_last] = $version['versions'][$get_last];
                }
            }
            return $m_compres;
        }
        $data['main_menu']   = $main_menu   = get_compres($main_menu);
        $data['main_page']   = $main_page   = get_compres($main_page);
        $data['menu_list']   = $menu_list   = get_compres($menu_list);
        $data['main_search'] = $main_search = get_compres($main_search);
        $data['main_app']    = $main_app    = get_compres2($main_app);

        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        // Buat folder jika belum ada
        $dirPath = "FaiFramework/versions/generated_versions/$version_name/";
        if (! is_dir($dirPath)) {
            mkdir($dirPath, 0777, true);
        }
        // Step 3: Save the JSON data to a file
        file_put_contents(__DIR__ . '/../../versions/generated_versions/' . $version_name . '/main_page.json', json_encode($main_page, JSON_PRETTY_PRINT));
        file_put_contents(__DIR__ . '/../../versions/generated_versions/' . $version_name . '/main_menu.json', json_encode($main_menu, JSON_PRETTY_PRINT));
        file_put_contents(__DIR__ . '/../../versions/generated_versions/' . $version_name . '/main_app.json', json_encode($main_app, JSON_PRETTY_PRINT));
        file_put_contents(__DIR__ . '/../../versions/generated_versions/' . $version_name . '/menu_list.json', json_encode($menu_list, JSON_PRETTY_PRINT));
        file_put_contents(__DIR__ . '/../../versions/generated_versions/' . $version_name . '/main_search.json', json_encode($main_search, JSON_PRETTY_PRINT));
        file_put_contents(__DIR__ . '/../../versions/generated_versions/' . $version_name . '.json', $jsonData);
        echo json_encode(["success" => 1]);

    }
    public static function content($page)
    {
        $fai         = new MainFaiFramework();
        $versionName = $fai->input('version');
        if (! $versionName) {
            header('Content-Type: application/json');
            http_response_code(400); // Bad Request
            echo json_encode(['success' => false, 'message' => 'Nama versi tidak disediakan.']);
            exit();
        }
        $safeVersionName = basename($versionName);
        $filePath        = __DIR__ . '/../../versions/generated_versions/' . $safeVersionName . '.json';

        if (! file_exists($filePath)) {
            header('Content-Type: application/json');
            http_response_code(404); // Not Found
            echo json_encode(['success' => false, 'message' => 'Versi yang diminta tidak ditemukan.']);
            exit();
        }
        $fileContent = file_get_contents($filePath);
        $isEncrypted = false;
        $outputData  = $fileContent;
        if ($isEncrypted) {
            $enc           = new Encryption();
            $decryptedData = $enc->decrypt($fileContent);

            // Jika dekripsi gagal (kunci salah, data korup), kirim error
            if ($decryptedData === false) {
                throw new Exception('Gagal melakukan dekripsi konten.');
            }
            $outputData = $decryptedData;
        }
        header('Content-Type: application/json');
        header('Content-Length: ' . strlen($outputData));
        header('Cache-Control: no-cache, no-store, must-revalidate'); // Penting untuk data sensitif
        header('Pragma: no-cache');
        header('Expires: 0');

        echo $outputData;
        exit();

    }
}
