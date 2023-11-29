<?php
function db_connect() {
    $config = require_once "./config/db.php";

    return new PDO(...$config);
}
?>