<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["decision"])) {
    file_put_contents("decision.txt", $_POST["decision"]);
}
?>
