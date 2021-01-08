<?php
header('Content-type: application/json');
$content = file_get_contents('http://stream.retroscene.org:9966/views');
if ($content) {
        echo $content;
} else {
        echo '{"streams":{"main":0},"status":"fetch error"}';
}