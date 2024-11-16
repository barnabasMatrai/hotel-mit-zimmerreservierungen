<?php

if (isset($_POST["oldpassword"]) and isset($_POST["newpassword"]) and isset($_POST["repeatnewpassword"])) {
    if ($_POST["oldpassword"] === $_SESSION["password"] and is_password_same($_POST["newpassword"], $_POST["repeatnewpassword"]))
    {
        $_SESSION["password"] = $_POST['newpassword'];
        header("Location: ../sites/login.php");
        exit("redirect to login");
    }
}

?>

<div class="d-flex justify-content-center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group col-auto">
            <label for="oldpassword">Altes Passwort:</label>
            <input name="oldpassword" type="password" id="oldpassword" class="form-control" required>
        </div>
        <div class="form-group col-auto">
            <label for="newpassword">Neues Passwort:</label>
            <input name="newpassword" type="password" id="newpassword" class="form-control" required>
        </div>
        <div class="form-group col-auto">
            <label for="repeatnewpassword">Neues Passwort wiederholen:</label>
            <input name="repeatnewpassword" type="password" id="repeatnewpassword" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Speichern</button>
    </form>
</div>