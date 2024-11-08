<?php
function test_capitalized($name, $data) {
    return $data[0]=== strtolower($data[0]) ? $name . ' muss mit einem Grossbuchstaben beginnen!' : '';
}

function test_username($username, $takenUsernames) {
    return in_array($username, $takenUsernames) ? 'Username ist schon vergeben!' : '';
}

function test_password($passwort, $passwortWiederholung) {
    return $passwort !== $passwortWiederholung ? 'Das Passwort stimmt nicht überein!' : '';
}

function check_and_echo_error($data) {
    if ($data !== '')
    {
        echo '<div class="alert alert-danger mt-2"><p class="mb-0">' . $data . '</p></div>';
    }
}

$takenUsernames = array("Rita12", "Esther56", "user1");

$vornameCorrect = $nachnameCorrect = $passwordSame = $usernameTaken = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vorname = test_input($_POST["vorname"]);
    $nachname = test_input($_POST["nachname"]);
    $username = test_input($_POST["username"]);
    $passwort = test_input($_POST["passwort"]);
    $passwortWiederholen = test_input($_POST["passwortWiederholen"]);

    $vornameCorrect = test_capitalized('Vorname', $vorname);
    $nachnameCorrect = test_capitalized('Nachname', $nachname);

    $usernameTaken = test_username($username, $takenUsernames);
    $passwordSame = test_password($passwort, $passwortWiederholen);
}
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
                <input name="username" id="username" class="form-control" required>
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
