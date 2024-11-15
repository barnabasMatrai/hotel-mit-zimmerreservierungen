<?php
$vornameCorrect = $nachnameCorrect = $passwordSame = $usernameTaken = '';
$username = "";
echo session_status();
if (session_status() === PHP_SESSION_ACTIVE) {
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
    }
    
}

$passwort = isset($_SESSION["passwort"]);
?>

<div class="d-flex justify-content-center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group col-auto">
                <label for="anrede">Anrede:</label>
                <select name="anrede" id="anrede" class="form-control">
                    <option value="herr">Herr</option>
                    <option value="frau">Frau</option>
                    <option value="divers">Divers</option>
                </select>
            </div>
            <div class="form-group col-auto">
                <label for="vorname">Vorname:</label>
                <input name="vorname" id="vorname" class="form-control" required>
                <?php check_and_echo_error($vornameCorrect);?>
            </div>
            <div class="form-group col-auto">
                <label for="nachname">Nachname:</label>
                <input name="nachname" id="nachname" class="form-control" required>
                <?php check_and_echo_error($nachnameCorrect);?>
            </div>
            <div class="form-group col-auto">
                <label for="email">Email-Adresse:</label>
                <input name="email" type="email" id="email" class="form-control" required>
            </div>
            <div class="form-group col-auto">
                <label for="username">Username:</label>
                <?php echo '<input name="username" id="username" class="form-control" value="' . $username . '" required>';?>
                <?php check_and_echo_error($usernameTaken);?>
            </div>
            <div class="form-group col-auto">
                <label for="passwort">Passwort:</label>
                <input name="passwort" type="password" id="passwort" class="form-control" required>
            </div>
            <div class="form-group col-auto">
                <label for="passwortWiederholen">Passwort wiederholen:</label>
                <input name="passwortWiederholen" type="password" id="passwortWiederholen" class="form-control" required>
                <?php check_and_echo_error($passwordSame);?>
            </div>
            <div>
                <input type="hidden" name="form-type" value="register">
            </div>
        <button type="submit" class="btn btn-primary">Registrieren</button>
    </form>
</div>
