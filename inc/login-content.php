<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start();
    echo "session started!<br>";

    echo "this is the current session id: ".session_id()."<br>";
    
    echo "here are all session variables: ".json_encode($_SESSION)."<br>";
    $_SESSION["username"] = test_input($_POST["username"]);
    $_SESSION["passwort"] = test_input($_POST["passwort"]);

    echo "set some session variables!";
}
?>

<div class="d-flex justify-content-center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group col-auto">
            <label for="username">Username:</label>
            <input name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group col-auto">
            <label for="passwort" id="password-label">Passwort:</label>
            <input name="passwort" type="password" id="passwort" class="form-control" required>
        </div>
        <div>
            <input type="hidden" name="form-type" value="login">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
