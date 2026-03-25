<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Token");

ini_set('max_execution_time', 60);
ini_set('memory_limit', '1024M');
ini_set('max_input_time', 60);
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '500M');


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

set_time_limit(20);
date_default_timezone_set('America/Sao_Paulo');

$primary = 'https://exemplo.com/live/primary.m3u8';
$backup  = 'https://exemplo.com/live/backup.m3u8';

function streamOnline($url)
{
    $headers = @get_headers($url);
    return $headers && strpos($headers[0], '200') !== false;
}

if (streamOnline($primary)) {
    header("Location: $primary");
} else {
    header("Location: $backup");
}
