<?php
$welcomeText = "";

if (isset($_SESSION["username"]) and isset($_SESSION["password"]))
{
    $welcomeText = "Hallo " . htmlspecialchars($_SESSION["username"]);
    echo '<div class="alert alert-success"><p class="mb-0">' . $welcomeText . '</p></div>';
}
?>
