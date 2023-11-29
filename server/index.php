<?php

// TODO: Временные заголовки для локального тестирования
header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

ini_set("error_reporting", E_ALL);
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);

require_once "./helpers/db.php";
$pdo = db_connect();

// TODO: Временное условие для проверки API
if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    strtolower($_SERVER['CONTENT_TYPE'] ?? '') ===  "application/json; charset=utf-8"
) {
    if (str_contains($_SERVER["REQUEST_URI"], "/api")) {
        header("Content-Type: application/json; charset=utf-8");

        if (str_contains($_SERVER["REQUEST_URI"], "/api/words")) {
            $stmt = $pdo->prepare("SELECT * FROM word_list");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
            exit();
        }
    }
}

if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    strtolower($_SERVER['CONTENT_TYPE'] ?? '') ===  "application/json; charset=utf-8"
) {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header("Content-Type: application/json; charset=utf-8");

    if (str_contains($_SERVER["REQUEST_URI"], "/page/words")) {
        $json = file_get_contents("php://input");
        $data = json_decode($json);
        $sound = getSoundFromText($data->text);
        echo $sound;
        exit();
    }

    if (str_contains($_SERVER["REQUEST_URI"], "/page/remove-word")) {
        try {
            $json = file_get_contents("php://input");
            $data = json_decode($json);

            if ($data->id) {
                $sql = "DELETE FROM word_list WHERE id = :id;";
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute(["id" => $data->id]);

                if ($result > 0) {
                    echo json_encode(["status" => true, "result" => true]);
                } else {
                    echo json_encode(["status" => false]);
                }
            } else {
                echo json_encode(["status" => false]);
            }
            exit();
        } catch (PDOException $e) {
            echo json_encode(["status" => false, "error" => $e]);
            exit();
        }
    }

    echo json_encode(["status" => false]);
    exit();
}

$content = "";

ob_start();
if (str_contains($_SERVER["REQUEST_URI"], "/page/add-word")) {
    require_once("./pages/addWordPage.php");
    $content = ob_get_contents();
} else if (str_contains($_SERVER["REQUEST_URI"], "/page/words")) {
    require_once("./pages/wordsList.php");
    $content = ob_get_contents();
} else {
    require_once("./pages/homePage.php");
    $content = ob_get_contents();
}
ob_end_clean();

require_once("./layouts/main.php");
