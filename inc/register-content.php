<?php
function test_input($data) {
    $data = htmlspecialchars($data);
    return $data;
}

function test_not_empty($name, $data) {
    return empty($data) ? $name . ' kann nicht leer sein!' : $name . ' ist nicht leer';
}

function test_username($username, $takenUsernames) {
    return in_array($username, $takenUsernames) ? 'Username ist schon vergeben!' : 'Username ist noch nicht vergeben';
}

function test_password($passwort, $passwortWiederholung) {
    return $passwort === $passwortWiederholung ? 'Das Passwort ist okay' : 'Das Passwort stimmt nicht überein!';
}

$takenUsernames = array("Rita12", "Esther56", "user1");

$anredeCorrect = $vornameCorrect = $nachnameCorrect = $emailCorrect = $usernameCorrect = $passwortCorrect
= $passwortWiederholenCorrect = $passwordSame = $usernameTaken = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anrede = test_input($_POST["anrede"]);
    $vorname = test_input($_POST["vorname"]);
    $nachname = test_input($_POST["nachname"]);
    $email = test_input($_POST["email"]);
    $username = test_input($_POST["username"]);
    $passwort = test_input($_POST["passwort"]);
    $passwortWiederholen = test_input($_POST["passwortWiederholen"]);

    $anredeCorrect = test_not_empty('Anrede', $anrede);
    $vornameCorrect = test_not_empty('Vorname', $vorname);
    $nachnameCorrect = test_not_empty('Nachname', $nachname);
    $emailCorrect = test_not_empty('Email', $email);
    $usernameCorrect = test_not_empty('Username', $username);
    $passwortCorrect = test_not_empty('Passwort', $passwort);
    $passwortWiederholenCorrect = test_not_empty('Passwort wiederholen', $passwortWiederholen);

    $usernameTaken = test_username($username, $takenUsernames);
    $passwordSame = test_password($passwort, $passwortWiederholen);
}
?>
<div class="bg-light d-flex justify-content-center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group col-auto">
                <label for="anrede">Anrede:</label>
                <select name="anrede" id="anrede" class="form-control">
                    <option value="herr">Herr</option>
                    <option value="frau">Frau</option>
                    <option value="divers">Divers</option>
                </select>
                <span><?php echo $anredeCorrect;?></span>
            </div>
            <div class="form-group col-auto">
                <label for="vorname">Vorname:</label>
                <input name="vorname" id="vorname" class="form-control" required>
                <span><?php echo $vornameCorrect;?></span>
            </div>
            <div class="form-group col-auto">
                <label for="nachname">Nachname:</label>
                <input name="nachname" id="nachname" class="form-control" required>
                <span><?php echo $nachnameCorrect;?></span>
            </div>
            <div class="form-group col-auto">
                <label for="email">Email-Adresse:</label>
                <input name="email" type="email" id="email" class="form-control" required>
                <span><?php echo $emailCorrect;?></span>
            </div>
            <div class="form-group col-auto">
                <label for="username">Username:</label>
                <input name="username" id="username" class="form-control" required>
                <span><?php echo $usernameCorrect;?></span>
                <span><?php echo $usernameTaken;?></span>
            </div>
            <div class="form-group col-auto">
                <label for="passwort">Passwort:</label>
                <input name="passwort" type="password" id="passwort" class="form-control" required>
                <span><?php echo $passwortCorrect;?></span>
            </div>
            <div class="form-group col-auto">
                <label for="passwortWiederholen">Passwort wiederholen:</label>
                <input name="passwortWiederholen" type="password" id="passwortWiederholen" class="form-control" required>
                <span><?php echo $passwordSame;?></span>
            </div>
        <button type="submit" class="btn btn-primary">Registrieren</button>
    </form>
</div>
