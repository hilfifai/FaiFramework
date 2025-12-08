<?php
// Get the requested file path
$request = $_SERVER['REQUEST_URI'];

// Remove query string
$path = parse_url($request, PHP_URL_PATH);

// Map paths
if (strpos($path, '/JSFramework/') === 0) {
    $path = '..' . $path;
}

// If it's a .js file, serve with correct MIME type
if (pathinfo($path, PATHINFO_EXTENSION) === 'js') {
    header('Content-Type: application/javascript');
    // Read and output the file
    $file = __DIR__ . '/' . $path;
    if (file_exists($file)) {
        readfile($file);
        exit;
    }
}

// For other files, let PHP handle normally
return false;
?>