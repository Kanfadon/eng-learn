<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["word"]) && isset($_POST["translate"])) {
    $allowed = array("gif", "png", "jpg", "jpeg");
    $filename = $_FILES["file"]["name"];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (in_array($ext, $allowed)) {
        $uploadfile = "./download/" . $_POST["word"] . "." . $ext;
    
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            $sql = "INSERT INTO word_list (word, translate, image_url) VALUES (?,?,?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$_POST["word"], $_POST["translate"], $_POST["word"] . "." . $ext]);
        }
    }
}
?>

<form action="/" method="get">
    <button class="button">На главную</button>
</form>

<div class="header-text">
    Добавить слово
</div>

<div>
    <form action="/page/add-word" method="post" enctype="multipart/form-data">
        <input class="field" type="text" placeholder="слово" name="word">
        <input class="field margin-top-m" type="text" placeholder="перевод" name="translate">
        <input class="field-upload margin-top-m" type="file" name="file">
        <button class="button margin-top-m" type="submit">Добавить</button>
    </form>
</div>