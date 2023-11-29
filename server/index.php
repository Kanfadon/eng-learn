<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once "./helpers/db.php";
$pdo = db_connect();

$content = "";

ob_start();
if (str_contains($_SERVER['REQUEST_URI'], '/page/add-word')) {
    require_once('./pages/addWordPage.php');
    $content = ob_get_contents();
} else if (str_contains($_SERVER['REQUEST_URI'], '/page/words')) {
    require_once('./pages/wordsList.php');
    $content = ob_get_contents();
} else {
    require_once('./pages/homePage.php');
    $content = ob_get_contents();
}
ob_end_clean();

require_once('./layouts/main.php');
?>