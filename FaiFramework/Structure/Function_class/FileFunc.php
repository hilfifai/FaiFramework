<?php

//use Illuminate\Support\Arr;

class FileFunc
{
    public static function file_upload($page, $input_name, $path, $folder, $database, $id_ext, $field_name, $type_input = "input_name", $type_return = "upload_data")
    {


        $panel = Database::get_database_panel($page, 'drive', 'all');
        $id_panel = $panel['id_panel'];
        $array = array(
            array("", "id_drive", 'number'),
            array("", "nama_folder", 'text'),
            array("", "id_parent_folder", 'number'),
        );
        Database::create_database_check($page, $array, 'drive__folder', Database::converting_primary_key($page, 'drive__folder', 'ontable'), $page['database_provider'], $page['app_framework']);

        $array = array(
            array("", "id_drive", 'number'),
            array("", "id_drive_folder", 'number'),
            array("", "domain", 'text'),
            array("", "storage", 'text'),
            array("", "path", 'text'),
            array("", "file_name_save", 'text'),
            array("", "file_name_asli", 'text'),
            array("", "file_name_system", 'text'),
            array("", "sizes", 'text'),
            array("", "extension", 'text'),
            array("", "type", 'text'),
            array("", "thumbail", 'text'),
            array("", "ref_database", 'text'),
            array("", "ref_external_id", 'number'),
            array("", "judul", 'text'),
            array("", "caption", 'text'),
            array("", "support", 'text'),
            array("", "input_name", 'text'),
        );
        Database::create_database_check($page, $array, 'drive__file', Database::converting_primary_key($page, 'drive__file', 'ontable'), $page['database_provider'], $page['app_framework']);

        $idUser = Partial::id_user();
        $panel['panel'];
        $id_folder = FileFunc::folder($page, $panel, $panel['panel'], $id_panel, 'get_default_name_panel', null);
        $exfolder = explode('/', $folder);

        for ($i = 0; $i < count($exfolder); $i++) {
            if ($exfolder[$i])
                $id_folder = FileFunc::folder($page, $panel, $panel['panel'], $id_panel, $exfolder[$i], $id_folder);
        }
        $expath = explode('/', $path);
        $enpath = '';
        for ($i = 0; $i < count($expath); $i++) {

            $enpath .= ($expath[$i]);
            if ($i != count($expath) - 1)
                $enpath .= '/';
        }
        $last_one = 0;
        if ($type_input == 'input_name') {
             $file_upload['name'] = $input_name;
            
           
            $filesCount = is_array($_FILES[$input_name]['name'])?count($_FILES[$input_name]['name']):1;
            $input_file = function ($page, $file, $i, $database, $id_ext, $input_name, $field_name, $enpath, $panel, $id_folder, $path_upload, $idUser) {
                $filename = time() . '-' . random(20);
                $name     =  $file["name"];
                $ext      = pathinfo($name, PATHINFO_EXTENSION);
                $filename = random_str(10) . date('Y-m-d-H-i-s') . random(10) . '-' . $filename . '.' . $ext;
                $filename_sys = 'Be3-' . date('Y-m-d H:i:s') . '-' . random_num(2) . '.' . $ext;
                createPath($path_upload);
                move_uploaded_file($file['tmp_name'], $path_upload . '/' . $filename);
                $uploadData[$i]['file_name_asli'] = $name;
                $uploadData[$i]['file_name_system'] = $filename_sys;
                $uploadData[$i]['file_name_save'] = $filename;
                $uploadData[$i]['type'] =  $file['type'];
                $uploadData[$i]['sizes'] =  $file['size'];
                $uploadData[$i]['ref_database'] = $database;
                $uploadData[$i]['ref_external_id'] = $id_ext;
                $uploadData[$i]['path'] = $enpath;
                $uploadData[$i]['extension'] = $ext;
                $uploadData[$i]['id_drive_folder'] = $id_folder;
                $uploadData[$i]['input_name'] = $field_name;
                $uploadData[$i]['id_drive'] = $panel['id_database_panel'];
                $uploadData[$i][(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
                $uploadData[$i][(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;
                if ($uploadData[$i]['sizes']) {

                    CRUDFunc::crud_insert(false, $page, $uploadData[$i], [], 'drive__file', []);
                    $last_one = $uploadData[$i]['id_file'] = DB::lastInsertId($page, 'drive__file');
                    return array('last_one' => $last_one, 'uploadData' => $uploadData);
                }else{
                    return array('last_one' => -1, 'uploadData' => $uploadData);

                }
            };
            $path_upload = './uploads/' . $enpath;
            $literasi = 0;
            if(is_array($_FILES[$input_name]['name'])){
            for ($i = 0; $i < $filesCount; $i++) {
                $this_file = array();
                if (gettype($_FILES[$input_name]["name"][$i]) == 'array') {
                    for ($j = 0; $j < count($_FILES[$input_name]["name"][$i]); $j++) {

                        $file = array();
                        foreach ($_FILES[$input_name] as $key => $value) {

                            $file[$key] = $_FILES[$input_name][$key][$i][$j];
                        }
                        $return = $input_file($page, $file, $i, $database, $id_ext, $input_name, $field_name, $enpath, $panel, $id_folder, $path_upload, $idUser);
                        $uploadData[$literasi] = $return['uploadData'];
                        $array_last_one[] = $return['last_one'];
                        $last_one = $return['last_one'];
                        $literasi++;
                    }
                } else {
                    $file = array();
                    foreach ($_FILES[$input_name] as $key => $value) {
                        $file[$key] = $_FILES[$input_name][$key][$i];
                    }
                    $return = $input_file($page, $file, $i, $database, $id_ext, $input_name, $field_name, $enpath, $panel, $id_folder, $path_upload, $idUser);
                    $uploadData[$literasi] = $return['uploadData'];
                    $array_last_one[] = $return['last_one'];
                    $last_one = $return['last_one'];
                    $literasi++;
                }
            }
            }else{
                 $file = array();
                foreach ($_FILES[$input_name] as $key => $value) {
                        $file[$key] = $_FILES[$input_name][$key];
                    }
             
                 $return = $input_file($page, $file, $i, $database, $id_ext, $input_name, $field_name, $enpath, $panel, $id_folder, $path_upload, $idUser);
                    $uploadData[$literasi] = $return['uploadData'];
                    $array_last_one[] = $return['last_one'];
                    $last_one = $return['last_one'];
                    $literasi++;
            }
            $list_last_one = implode(',', $array_last_one);
        } else if ($type_input = "url") {
            $uploadData[$i]['ref_database'] = $database;
            $uploadData[$i]['ref_external_id'] = $id_ext;
            $uploadData[$i]['path'] = $enpath;
            $uploadData[$i]['storage'] = "External";
            $uploadData[$i]['id_drive_folder'] = $id_folder;
            $uploadData[$i]['id_drive'] = $panel['id_database_panel'];
            $uploadData[$i]['input_name'] = $input_name;
            $uploadData[$i][(isset($page['load']['database']['create_date']) ? $page['load']['database']['create_date'] : "create_date")] = date('Y-m-d H:i:s');
            $uploadData[$i][(isset($page['load']['database']['create_by']) ? $page['load']['database']['create_by'] : "create_by")] = $idUser;
            CRUDFunc::crud_insert(false, $page, $uploadData[$i], [], 'drive__file', []);

            $last_one = $uploadData[$i]['id_file'] = DB::lastInsertId($page, 'drive__file');
        }
        $return['list_last_one'] = $list_last_one;
        $return['last_one'] = $last_one;
        $return['uploadData'] = $uploadData;

        if ($type_return == 'all') {
            return $return;
        } else
        if ($type_return == 'last_one') {
            return $list_last_one;
        } else
            return $uploadData;
    }
    public static function folder($page, $panel_array, $panel, $id_panel, $nama_folder, $parent)
    {
        if ($nama_folder) {

            if ($nama_folder == 'get_default_name_panel') {
                if ($panel == 'organisasi') {
                    $database['utama'] = "organisasi";
                    $database['primary_key'] = Database::converting_primary_key($page, "organisasi", 'ontable');
                    $database['where'][] = array('id_organisasi', "=", $_SESSION['id_organisasi']);
                    $row_get = "nama_organisasi";
                } else if ($panel == 'program') {
                    $database['utama'] = "program";
                    $database['primary_key'] = Database::converting_primary_key($page, "program", 'ontable');
                    $database['where'][] = array('id_program', "=", $_SESSION['id_program']);
                    $row_get = "nama_program";
                } else if ($panel == 'user') {
                    $database['utama'] = "apps_user";
                    $database['primary_key'] = Database::converting_primary_key($page, "apps_user", 'ontable');
                    $database['where'][] = array('id_apps_user', "=", $_SESSION['id_apps_user']);
                    $row_get = "nama_lengkap";
                } else {
                    $row_get = "";
                }
                $nama_folder = 'public';
                if ($row_get) {
                    $query = Database::database_coverter($page, $database, array(), 'all');
                    if ($query['num_rows']) {
                        $nama_folder = $query['row'][0]->$row_get;
                    }
                }
            }
            $data = array();
            $data['nama_folder'] = $nama_folder;
            $data['id_drive'] = $panel_array['id_database_panel'];
            if ($parent)
                $data['id_parent_folder'] = $parent;
            $where = array();
            foreach ($data as $key => $value) {
                if ($key == 'nama_folder') {

                    $where[] = array($key, '=', "'$value'");
                } else
                    $where[] = array($key, '=', $value);
            }
            $database['utama'] = 'drive__folder';
            $database['primary_key'] = Database::converting_primary_key($page, 'drive__folder', 'ontable');
            $database['where'] = $where;
            $query = Database::database_coverter($page, $database, array(), 'all');

            if (($query['num_rows'])) {

                $id = $query['row'][0]->id;
            } else {
                CRUDFunc::crud_insert(false, $page, $data, [], 'drive__folder', []);

                $id = DB::lastInsertId($page, 'drive__folder');
            }
            return $id;
        }
    }
}
