<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["logout"])) {
        session_unset();
        session_destroy();
        header("Location: ../sites/index.php");
        exit("redirect to index");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["password"])) {
        $_SESSION['password'] = $_POST['password'];
    }

    if (isset($_POST["username"])) {
        $_SESSION['title'] = "Herr";
        $_SESSION['firstname'] = "Max";
        $_SESSION['lastname'] = "Muster";
        $_SESSION["email"] = "test@test.de";
        $_SESSION["username"] = $_POST["username"];
    }
}

if (empty($_SESSION["username"])) {
    include '../inc/site-contents/login-content.php';
} else {
    include '../inc/site-contents/profile-content.php';
}
?>
