<?php
function db_connect()
{
    $config = require_once "./config/db.php";

    return new PDO(...$config);
}

function getSoundFromText($text)
{
    $txt = htmlspecialchars($text);
    $txt = rawurlencode($txt);
    $html = file_get_contents("https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q=" . $txt . "&tl=en-IN");
    return base64_encode($html);
}
