<?php
header('Content-type: application/json; charset=utf-8');

ob_start();
$content = file_get_contents('http://127.0.0.1:9966/views');
$error = ob_get_clean();
if (!$content) {
        $content = json_encode(array(
                'streams' => array('main' => 0),
                'error' => trim(strip_tags($error)),
        ));
}

echo $content;