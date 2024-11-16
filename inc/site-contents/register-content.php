<?php

$takenUsernames = array("Rita12", "Esther56", "user1");

$firstnameCorrect = $lastnameCorrect = $passwordSame = $usernameTaken = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = test_input($_POST["firstname"]);
    $lastname = test_input($_POST["lastname"]);
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $repeatPassword = test_input($_POST["repeatPassword"]);

    $firstnameCorrect = test_capitalized('Vorname', $firstname);
    $lastnameCorrect = test_capitalized('Nachname', $lastname);

    $usernameTaken = test_username($username, $takenUsernames);
    $passwordSame = is_password_same($password, $repeatPassword) ? '' : 'Das Passwort stimmt nicht überein!';
}
?>
<div class="d-flex justify-content-center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group col-auto">
                <label for="title">Anrede:</label>
                <select name="title" id="title" class="form-control">
                    <option value="sir">Herr</option>
                    <option value="madam">Frau</option>
                    <option value="diverse">Divers</option>
                </select>
            </div>
            <div class="form-group col-auto">
                <label for="firstname">Vorname:</label>
                <input name="firstname" id="firstname" class="form-control" required>
                <?php check_and_echo_error($firstnameCorrect);?>
            </div>
            <div class="form-group col-auto">
                <label for="lastname">Nachname:</label>
                <input name="lastname" id="lastname" class="form-control" required>
                <?php check_and_echo_error($lastnameCorrect);?>
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
                <label for="password">Passwort:</label>
                <input name="password" type="password" id="password" class="form-control" required>
            </div>
            <div class="form-group col-auto">
                <label for="repeatPassword">Passwort wiederholen:</label>
                <input name="repeatPassword" type="password" id="repeatPassword" class="form-control" required>
                <?php check_and_echo_error($passwordSame);?>
            </div>
        <button type="submit" class="btn btn-primary">Registrieren</button>
    </form>
</div>
