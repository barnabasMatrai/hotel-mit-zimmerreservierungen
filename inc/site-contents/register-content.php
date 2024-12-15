<?php

$takenUsernames = array("Rita12", "Esther56", "user1");

$allFieldsFilledCorrect = $firstnameCorrect = $lastnameCorrect = $passwordSame = $usernameTaken = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];
    
        $firstnameCorrect = test_capitalized($firstname)  ? '' : 'Vorname muss mit einem Grossbuchstaben beginnen!';
        $lastnameCorrect = test_capitalized($lastname)  ? '' : 'Nachname muss mit einem Grossbuchstaben beginnen!';
    
        $usernameTaken = test_username($username, $takenUsernames) ? 'Username ist schon vergeben!' : '';
        $passwordSame = is_password_same($password, $repeatPassword) ? '' : 'Das Passwort stimmt nicht überein!';

        $fieldsCorrect = !$firstnameCorrect && !$lastnameCorrect && !$usernameTaken && !$passwordSame;
    if (empty($firstname) or
        empty($lastname) or
        empty($username) or
        empty($password) or
        empty($repeatPassword)) {
            $allFieldsFilledCorrect = 'Alle Felder müssen ausgefüllt sein!';
    } else if ($fieldsCorrect) {
        $db = getDb();
        $userExists = userExists($db, $username);

        if (!$userExists) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            insertUser($db, $title, $firstname, $lastname, $email, $username, $hashedPassword);
        }
    }

}
?>
<div class="d-flex justify-content-center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group col-auto">
            <label for="title">Anrede:</label>
            <select name="title" id="title" class="form-control">
                <option value="Herr">Herr</option>
                <option value="Frau">Frau</option>
                <option value="Divers">Divers</option>
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
        <div class="form-group col-auto">
            <?php check_and_echo_error($allFieldsFilledCorrect);?>
            <button type="submit" class="btn btn-primary">Registrieren</button>
        </div>
    </form>
</div>
