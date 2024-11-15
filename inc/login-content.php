<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["logout"])) {
        session_unset();
        session_destroy();
        header("Location: ../sites/index.php");
        exit("redirect to index");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if (isset($username) and isset($password)) {
        $_SESSION['title'] = "Herr";
        $_SESSION['firstname'] = "Max";
        $_SESSION['lastname'] = "Muster";
        $_SESSION["email"] = "test@test.de";
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
    }
}

if (empty($_SESSION["username"])) {
    echo '
    <div class="d-flex justify-content-center">
        <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
            <div class="form-group col-auto">
                <label for="username">Username:</label>
                <input name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group col-auto">
                <label for="password">Password:</label>
                <input name="password" type="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>';
} else {
    include '..\\inc\\profile-content.php';
}
?>
