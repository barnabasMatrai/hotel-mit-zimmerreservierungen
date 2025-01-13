<?php
if (isset($_SESSION["username"])) {
    header("Location: ../sites/login.php");
    exit("redirect to index");
}

$title = $firstname = $lastname = $email = $username = $password = $repeatPassword = '';
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
    
        $usernameTaken = userExists($username); ? 'Username ist schon vergeben!' : '';
        $passwordSame = is_password_same($password, $repeatPassword) ? '' : 'Das Passwort stimmt nicht überein!';

        $fieldsCorrect = !$firstnameCorrect && !$lastnameCorrect && !$usernameTaken && !$passwordSame;
    if (empty($firstname) or
        empty($lastname) or
        empty($username) or
        empty($password) or
        empty($repeatPassword)) {
            $allFieldsFilledCorrect = 'Alle Felder müssen ausgefüllt sein!';
    } else if ($fieldsCorrect) {
        $userExists = userExists($username);

        if (!$userExists) {
            insertUser($title, $firstname, $lastname, $email, $username, $password);
        }
    }

}
?>
<div class="d-flex justify-content-center">
    <form class="m-2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
            <?php echo create_input_tag("text", "firstname", "firstname", $firstname);?>
            <?php check_and_echo_error($firstnameCorrect);?>
        </div>
        <div class="form-group col-auto">
            <label for="lastname">Nachname:</label>
            <?php echo create_input_tag("text", "lastname", "lastname", $lastname);?>
            <?php check_and_echo_error($lastnameCorrect);?>
        </div>
        <div class="form-group col-auto">
            <label for="email">Email-Adresse:</label>
            <?php echo create_input_tag("email", "email", "email", $email);?>
        </div>
        <div class="form-group col-auto">
            <label for="username">Username:</label>
            <?php echo create_input_tag("text", "username", "username", $username);?>
            <?php check_and_echo_error($usernameTaken);?>
        </div>
        <div class="form-group col-auto">
            <label for="password">Passwort:</label>
            <?php echo create_input_tag("password", "password", "password", $password);?>
        </div>
        <div class="form-group col-auto">
            <label for="repeatPassword">Passwort wiederholen:</label>
            <?php echo create_input_tag("password", "repeatPassword", "repeatPassword", $repeatPassword);?>
            <?php check_and_echo_error($passwordSame);?>
        </div>
        <div class="form-group col-auto">
            <?php check_and_echo_error($allFieldsFilledCorrect);?>
            <button type="submit" class="btn btn-primary">Registrieren</button>
        </div>
    </form>
</div>
