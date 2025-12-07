<?php

function parse_card($page, $array, $row, $fai)
{
    $page['row']['card'] = $row;
     $id = $page['load']['id'];
    $i = 0;
    $type = isset($array[$i]) ? $array[$i] : null;
    $i++;
    $field = isset($array[$i]) ? $array[$i] : null;
    $i++;
    $dataset = isset($array[$i]) ? $array[$i] : null;
    $i++;
    $enkripsi = isset($array[$i]) ? $array[$i] : null;
    $i++;
    $support = isset($array[$i]) ? $array[$i] : null;
    // print_r($support);

    $dataset;
    $info = '';
    $prefix_costum = '';
    $suffix_costum = '';
    //echo ''.$page['load']['id'];
    //print_r($page['row_section'][$id]);
    if ($dataset == 'database') {
        $info = $row->$field;
    } else if ($dataset == 'function') {
        $field_function = $field;
        $strutktur_folder = ucfirst(strtolower($field_function[0]));
        $class  = $field_function[1];
        // echo __DIR__ . "../../../Structure/Controller/" . $strutktur_folder . "_class/$class.php";
        require_once(__DIR__ . "../../../Structure/Controller/" . $strutktur_folder . "_class/$class.php");
        $new = new $class();
        $function = $field_function[2];
        $parameter1 = isset($field_function[3][0]) ? Database::string_database($page, $fai, $field_function[3][0]) : null;
        $parameter2 = isset($field_function[3][1]) ? Database::string_database($page, $fai, $field_function[3][1]) : null;
        $parameter3 = isset($field_function[3][2]) ? Database::string_database($page, $fai, $field_function[3][2]) : null;
        $parameter4 = isset($field_function[3][3]) ? Database::string_database($page, $fai, $field_function[3][3]) : null;
        $parameter5 = isset($field_function[3][4]) ? Database::string_database($page, $fai, $field_function[3][4]) : null;
        $parameter6 = isset($field_function[3][5]) ? Database::string_database($page, $fai, $field_function[3][5]) : null;
        if(isset($field_function[4])){
            $info = $new->$function($page, $page['load']['type'],$page['load']['id'],$parameter1, $parameter2, $parameter3, $parameter4, $parameter5, $parameter6)[$field_function[4]];
        }else
        $info = $new->$function($page, $page['load']['type'],$page['load']['id'],$parameter1, $parameter2, $parameter3, $parameter4, $parameter5, $parameter6);
        // $info = $new->$function($page, $parameter1, $parameter2, $parameter3, $parameter4, $parameter5, $parameter6);//
    } else if ($dataset == 'database-costum') {
        $field_costum = $field;
        $prefix_costum = $field_costum[0];
        $field  = $field_costum[1];
        $suffix_costum = $field_costum[2];
        $info = ($row->$field);
    } else if ($dataset == 'database-relation') {
        $field_relation = $field;
        $internal_field = $field[1];

        $info = $row->$field;
    } else if ($dataset == 'database-join') {
        //print_r($field);
        $field_relation = $field;
        $internal_field = $field[3];

        $info = $row->$internal_field;
    }

    // if ($enkripsi) {
    //     $info = $prefix_costum . '<be3 text="' . $info . '" done="false"><span class="skeleton-box" style="width:100%;"></span></be3>' . $suffix_costum;
    // }
     $info = $prefix_costum . $info . $suffix_costum; 
    /*
Jika Full Tag itu pake 
dataset body
tapi kalau di dalamnya banyak berarti pake dataset tag kemudian set infonya
*/
    //echo $type;
    $return = "";
    if ($type == 'img') {
        $nama_data = $enkripsi[2];
        $id_data = $enkripsi[1];
        $avatar = $fai->get_avatar($page, de($row->$nama_data), $row->$id_data, $enkripsi[0],1,0);
       if(isset($support['source'])){
        if($support['source']=='template'){
            $get_template = file_get_contents(__DIR__ . '/../../Pages/_template/' .
                        $support['template_name'] . '/' .
                        $support['template_file'] . '.php');
            $tag = $support['replace_to_image'];
            }  else{
                $get_template = ' <div class="avatar position-relative" style="width: 100%;height: 100%;min-height: 100px;text-align: center;vertical-align: middle;display: flex;justify-content: center;justify-items: center;align-content: center;align-items: center;;"><IMG-SRC></IMG-SRC></div>';
                $tag = "IMG-SRC";
            }           
        }else{
            $get_template = ' <div class="avatar position-relative" style="width: 100%;height: 100%;min-height: 100px;text-align: center;vertical-align: middle;display: flex;justify-content: center;justify-items: center;align-content: center;align-items: center;;"><IMG-SRC></IMG-SRC></div>';
            $tag = "IMG-SRC";
        }
        if($avatar['avatar_type']=='img'){
            $to_img = "<img src='".$avatar['avatar_value']."' style='height:100%;width:100%;".(isset($support['style'])?$support['style']:'')."'>";
        }else{
            $to_img = "<span  style='width:100%'>".$avatar['avatar_value']."</span>";    
        }
        $return .= str_replace("<$tag></$tag>",$to_img,$get_template);
    } else if ($type == 'title') {
        $return .= '<h3 class="'.(isset($support['class'])?$support['class']:'card-title').'">' . $info . '</h3>';
    } else if ($type == 'subtitle') {
        $return .= '<h6 class="card-title">' . $info . '</h6>';
    } else if ($type == 'subtitle') {
        $return .= '<h6 class="card-title">' . $info . '</h6>';
    } else if ($type == 'header') {
        $return .= '<div class="card-header">' . $info . '</div>';
    } else if ($type == 'body') {
        $return .= '<div class="card-body">' . $info . '</div>';
    } else if ($type == 'footer') {
        $return .= '<div class="card-footer">' . $info . '</div>';
    } else if ($type == 'tag') {
        $return .= '<div class="card-' . $type . '">';
    } else if ($type == 'end') {
        $return .= '</div>';
    } else if ($type == 'list') { ?>

        <div class="toolbar card-toolbar-tabs  ml-auto">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                </li>
            </ul>
        </div>
<?php
    } else if ($dataset == 'extend') {
       
        $fai->view($type . '/_Main.blade.php', $page, array('card' => $card));
    }else{
        $return = $info;
    }

    return $return;
}
?>