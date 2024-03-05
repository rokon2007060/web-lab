<?php
$page = $_POST["page"];
$section = $_POST["section"];
$content = $_POST["content"];
if ($page == "index") {
    file_put_contents("index.php", $content);
} elseif ($page == "edit") {
    file_put_contents("edit.php", $content);
}
?>
