<?php

$allFieldsFilledCorrect = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["password"])) {
        $_SESSION["password"] = $_POST["password"];
    }

    if (isset($_POST["username"]) and
        isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (empty($username) or
            empty($password)) {
            $allFieldsFilledCorrect = 'Alle Felder müssen ausgefüllt sein!';
        } else {
            if (!isset($db)) {
                $db = getDb();
            }
            $user = getUserSecure($db, $username, $password);

            if ($user != null) {
                $_SESSION["title"] = $user["Title"];
                $_SESSION["firstname"] = $user["FirstName"];
                $_SESSION["lastname"] = $user["LastName"];
                $_SESSION["email"] = $user["Email"];
                $_SESSION["username"] = $user["UserName"];
                $_SESSION["isAdmin"] = $user["IsAdmin"];

                if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) {
                    changeDbUserToAdmin($db);
                } else {
                    changeDbUserToRegular($db);
                }
        
                header("Location: ../sites/login.php");
                exit("redirect to index");
            } else {
                echo "User not found.";
            }
        }

    }
}
?>

<div class="d-flex justify-content-center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group col-auto">
            <label for="username">Username:</label>
            <input name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group col-auto">
            <label for="password">Passwort:</label>
            <input name="password" type="password" id="password" class="form-control" required>
        </div>
        <div class="form-group col-auto">
            <?php check_and_echo_error($allFieldsFilledCorrect)?>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>