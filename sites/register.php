<?php
$content = '../inc/register-content.php';

include 'index.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
echo 'Hello ' . htmlspecialchars($_POST["vorname"]) . '!'; 
}
?>
