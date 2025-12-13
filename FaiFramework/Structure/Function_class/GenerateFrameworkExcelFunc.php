<?php 

class GenerateFrameworkExcelFunc
{
    public static function excel_framework()
    {

        //require('plugins\spreadsheet-reader-master\php-excel-reader/excel_reader2.php');
        //require('plugins\spreadsheet-reader-master\SpreadsheetReader.php');
        //$Reader = new SpreadsheetReader($uploadFilePath);
        $file_open = fopen("ERP ESION - Master.csv", "r");
        // print_r(fgetcsv($file_open, 1000, ","));  die;
        echo '<pre>
        
        ';
        $content_class = "
        <?php 

        class ERPESIOS{
            public static function first(){

            
        ";
        $menu = "<ol>";
        $rows = 0;
        while (($csv = fgetcsv($file_open, 1000, ",")) !== false) {
            $i = 0;
            if($rows>=3){
                if($csv[0]=='Title Menu'){
                    
                    $content_class .='

                   
                    public static function '.strtolower(str_replace(array(' '), array('_'), $csv[2])).'(){
                        $page[\'title\'] = "'.$csv[2].'";
                        $page[\'route\'] = __FUNCTION__ ;
                        $page[\'layout_pdf\'] = array(\'a4\',\'portait\') ;
                    ';
                }else if($csv[0]=="Nama Database"){
                    $content_class .='
                    $database_utama = "'.$csv[2].'";
                    $primary_key =null;
                    ';

                
                }else if($csv[0]=="Struktur"){
                    
                }else if($csv[4]=="Required"){
                    $content_class .='
                        $array = array(
                    ';

                }else if($csv[0]=="------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------"){

                    $content_class .='
                    );
                    $search = array();
                   
                    $page[\'crud\'][\'array\'] = $array ;
                    $page[\'crud\'][\'search\'] = $search ;
                     
                     
                    $page[\'database\'][\'utama\'] = $database_utama;
                    $page[\'database\'][\'primary_key\'] = $primary_key ;
                    $page[\'database\'][\'select\'] = array("*"); ;
                    $page[\'database\'][\'join\'] = array();
                    $page[\'database\'][\'where\'] = array();  
                     return $page;
                   }
                   ';
                
                }else {
                    $content_class .="
                            ".$csv[12]."
                    ";
                }
            
                $i++;
                // echo '<br>';
                // echo '<br>';
                // echo '<br>';
            }
            echo $rows;
            echo '<textarea>';
            echo  $content_class ;
            echo '</textarea>';
            $rows++;
        } echo '<br>';
        echo '<textarea>';
        echo  $content_class ;
        echo '</textarea>';
            // header("Location: " . URL::to('/backend/gapok'), true, 302);

        ;
    }
    public function index()
    {

        $source = file_get_contents('../FaiFramework/MainFaiFramework.php');

        $tokens = token_get_all($source);

        foreach ($tokens as $i => $token) {
        }
        $tokens = PhpToken::tokenize($source);
        $parse = "";
        $content_array = [];
        $i = 0;

        echo '<pre>';
        $i = 0;
        $code = "";
        foreach ($tokens as $i => $token) {

            echo '<br>';
            echo "Line {$token->line}: {$token->getTokenName()} ('{$token->text}')", PHP_EOL;
            if ($token->getTokenName() == 'T_OPEN_TAG') {
                $parse .= '<?php ';
            } else if ($token->getTokenName() == 'T_VARIABLE' and !in_array($token->text, array('$_SESSION', '$_POST', '$_GET'))) {
                $parse .= '$' . en($token->text . 'en', true);
            } else if ($token->getTokenName() == 'T_DOUBLE_COLON') {
                $parse .= '' . en($tokens[$i - 1]->text . 'class', true);

                $parse .= $token->text . '';
                $code = "function";
            } else if ($token->getTokenName() == 'T_FUNCTION') {
                $parse .= $token->text . '';

                $code = "function";
            } else if ($token->getTokenName() == 'T_OBJECT_OPERATOR') {
                $parse .= $token->text . '';

                $code = "function";
            } else if ($token->getTokenName() == 'T_CLASS') {
                $parse .= $token->text . '';
                $code = "class";
            } else if ($token->getTokenName() == 'T_EXTENDS') {
                $parse .= $token->text . '';
                $code = "class";
            } else if ($token->getTokenName() == 'T_NEW') {
                $parse .= $token->text . '';
                $code = "class";
            } else if ($token->getTokenName() == 'T_STRING') {
                if ($code == 'class') {

                    $parse .= en($token->text . 'class', true);
                } else
                if ($code == 'function') {
                    if ($token->text != '__construct')
                        $parse .=  en($token->text . 'function', true);

                    else  if ($tokens[$i + 1]->getTokenName() == '(')
                        $parse .=  en($token->text . 'function', true);

                    else
                        $parse .= $token->text . '';
                } else {
                    if (isset(($tokens[$i + 1]))) {
                        if ($tokens[$i + 1]->getTokenName() != 'T_DOUBLE_COLON') {
                            $parse .= $token->text . '';
                        }
                    } else {
                        $parse .= $token->text . '';
                    }
                }
                $code = "";
            } else {
                if (isset(($tokens[$i + 1]))) {
                    if ($tokens[$i + 1]->getTokenName() != 'T_DOUBLE_COLON') {
                        $parse .= $token->text . '';
                    }
                } else {
                    $parse .= $token->text . '';
                }
            }
        }
        echo '<textarea style="width:100%;height:200px">' . $parse . '</textarea>';
    }
}