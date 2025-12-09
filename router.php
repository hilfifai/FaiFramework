<?php
// Get the requested file path
$request = $_SERVER['REQUEST_URI'];

// Remove query string
$path = parse_url($request, PHP_URL_PATH);

// Remove leading slash
if($path)
$path = ltrim($path, '/');

// If it's a static file that exists, serve it with correct headers
 $file = __DIR__ . '/' . $path;
if (file_exists($file) && !is_dir($file)) {
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    switch ($extension) {
        case 'js':
            header('Content-Type: application/javascript');
            break;
        case 'css':
            header('Content-Type: text/css');
            break;
        case 'json':
            header('Content-Type: application/json');
            break;
        case 'png':
            header('Content-Type: image/png');
            break;
        case 'jpg':
        case 'jpeg':
            header('Content-Type: image/jpeg');
            break;
        case 'gif':
            header('Content-Type: image/gif');
            break;
        case 'svg':
            header('Content-Type: image/svg+xml');
            break;
        case 'ico':
            header('Content-Type: image/x-icon');
            break;
        default:
            // For other files, let the browser detect
            break;
    }
    readfile($file);
    exit;
}

// For dynamic requests, include the main entry point
require_once 'index_standalone.php';
?>