<?php 
$folder =  $fai->nama_function($page,$page['title']);
$inisiasifolder = '/';
function folder_exist($folder)
{
    // Get canonicalized absolute pathname
    $path = realpath($folder);

    // If it exist, check if it's a directory
    if($path !== false AND is_dir($path))
    {
        // Return canonicalized absolute pathname
        return $path;
    }

    // Path/folder does not exist
    return false;
}
if (!empty($_POST['Controller'])) {
	if($page['app_framework']=='ci'){
		
    $dir ='./Export/'.$page['title'].$inisiasifolder.date('Ymd his').$inisiasifolder.'/controllers/';
	}else{
    $dir ='./Export/'.$page['title'].$inisiasifolder.date('Ymd his').$inisiasifolder.'/app/Http/Controllers/';
		
	}
   
    if(!folder_exist($dir))
	    mkdir($dir, 0777, true);
	
    $file = $fai->nama_controller($page,$page['title']);
    $filename = $dir.$file.'.php';
    $handle = fopen($filename, "w");
    fwrite($handle, $_POST['Controller']);
    fclose($handle);

	if($page['app_framework']=='ci'){
		
    $dir ='./Export/ALL/'.'/controllers/';
	}else{
    $dir ='./Export/ALL/'.'/app/Http/Controllers/';
		
	}
   if(!folder_exist($dir))
	    mkdir($dir, 0777, true);
	
    $file = $fai->nama_controller($page,$page['title']);
    $filename = $dir.$file.'.php';
    $handle = fopen($filename, "w");
    fwrite($handle, $_POST['Controller']);
    fclose($handle);
    echo $file;
    echo '<br>';
}
if (!empty($_POST['view'])) {
	if($page['app_framework']=='ci'){
		
    $dir ='./Export/'.$page['title'].$inisiasifolder.date('Ymd his').$inisiasifolder.'/controllers/'.$folder.'/';
	}else{
    $dir ='./Export/'.$page['title'].$inisiasifolder.date('Ymd his').$inisiasifolder.'/resources/views/'.$folder.'/';
		
	}
   
    if(!folder_exist($dir))
	mkdir($dir, 0777, true);
	foreach($_POST['view'] as $key => $value){
		
    $file = $key.'_'.$fai->nama_function($page,$page['title']).'.blade';
    $filename = $dir.$file.'.php';
    $handle = fopen($filename, "w");
    fwrite($handle, $_POST['view'][$key]);
    fclose($handle);
    echo $file;
    echo '<br>';
	}
	if($page['app_framework']=='ci'){
		
    $dir ='./Export/ALL/'.'/controllers/'.$folder.'/';
	}else{
    $dir ='./Export/ALL/'.'/resources/views/'.$folder.'/';
		
	}
   
    if(!folder_exist($dir))
	mkdir($dir, 0777, true);
	foreach($_POST['view'] as $key => $value){
		
    $file = $key.'_'.$fai->nama_function($page,$page['title']).'.blade';
    $filename = $dir.$file.'.php';
    $handle = fopen($filename, "w");
    fwrite($handle, $_POST['view'][$key]);
    fclose($handle);
    echo $file;
    echo '<br>';
	}
}
