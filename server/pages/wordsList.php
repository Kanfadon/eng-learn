<form action="/" method="get">
    <button class="button">На главную</button>
</form>

<div class="header-text">
    список слов
</div>

<div>
    <?php
    $stmt = $pdo->query("SELECT * FROM word_list");

    while ($row = $stmt->fetch()) {
        echo "<div class=\"card\">";
        echo "<div id=\"remove-btn\" data-word-id=\"" . $row["id"] . "\" class=\"remove\">X</div>";
        echo "<div class=\"img-container\"><img src=\"/download/" . $row['image_url'] . "\"></div>";
        echo "<div id=\"word\" class=\"word\">" . $row['word'] . "</div>";
        echo "<div class=\"word translate\">" . $row['translate'] . "</div>";
        echo "</div>";
    }
    ?>
</div>