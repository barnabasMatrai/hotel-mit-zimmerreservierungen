<?php


if (empty($_SESSION["username"])) {
    include '../inc/site-contents/login-content.php';
} else {
    include '../inc/site-contents/profile-content.php';
}
?>
