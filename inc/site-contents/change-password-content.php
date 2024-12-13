<?php

$allFieldsFilledCorrect = $oldPasswordCorrect = $newPasswordCorrect = '';

if (isset($_POST["oldpassword"]) and isset($_POST["newpassword"]) and isset($_POST["repeatnewpassword"])) {
    $oldPassword = $_POST["oldpassword"];
    $newPassword = $_POST["newpassword"];
    $repeatNewPassword = $_POST["repeatnewpassword"];

    if (empty($oldPassword) or
            empty($newPassword) or
            empty($repeatNewPassword)) {
            $allFieldsFilledCorrect = 'Alle Felder müssen ausgefüllt sein!';
        }

    if (!is_password_same($oldPassword, $_SESSION["password"]))
    {
        $oldPasswordCorrect = "Altes Passwort ist nicht korrekt!";
    }
    
    if (!is_password_same($newPassword, $repeatNewPassword)) {
        $newPasswordCorrect = "Das neue Passwort stimmt nicht überein!";
    }
    
    if (is_password_same($oldPassword, $_SESSION["password"]) and
        is_password_same($newPassword, $repeatNewPassword)) {
        $db = getDb();   
        updatePassword($db, $newPassword, $_SESSION['userid']);
        $_SESSION["password"] = $newPassword;
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
            <?php check_and_echo_error($oldPasswordCorrect)?>
        </div>
        <div class="form-group col-auto">
            <label for="newpassword">Neues Passwort:</label>
            <input name="newpassword" type="password" id="newpassword" class="form-control" required>
        </div>
        <div class="form-group col-auto">
            <label for="repeatnewpassword">Neues Passwort wiederholen:</label>
            <input name="repeatnewpassword" type="password" id="repeatnewpassword" class="form-control" required>
            <?php check_and_echo_error($newPasswordCorrect)?>
        </div>
        <div class="form-group col-auto">
            <?php check_and_echo_error($allFieldsFilledCorrect)?>
            <button type="submit" class="btn btn-primary">Speichern</button>
        </div>
    </form>
</div>