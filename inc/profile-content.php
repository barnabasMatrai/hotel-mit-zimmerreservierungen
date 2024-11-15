<?php

function create_input_tag($type, $name, $value) {
    return '<input name="' . $name . '" type="' . $type . '" id="' . $name . '" class="form-control" value="' . $value . '" required>';
}

$firstnameCorrect = $lastnameCorrect = $passwordSame = $usernameTaken = '';
$title = $firstname = $lastname = $email = $username = $password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $_SESSION["title"] = isset($_POST['title']) ? $_POST['title'] : $_SESSION['title'];
    $_SESSION["firstname"] = isset($_POST['firstname']) ? $_POST['firstname'] : $_SESSION['firstname'];
    $_SESSION["lastname"] = isset($_POST['lastname']) ? $_POST['lastname'] : $_SESSION['lastname'];
    $_SESSION["email"] = isset($_POST['email']) ? $_POST['email'] : $_SESSION['email'];
    $_SESSION["username"] = isset($_POST['username']) ? $_POST['username'] : $_SESSION['username'];
    $_SESSION["password"] = isset($_POST['password']) ? $_POST['password'] : $_SESSION['password'];
}

if (isset($_SESSION["username"]))
{
    $title = $_SESSION["title"];
    $firstname = $_SESSION["firstname"];
    $lastname = $_SESSION["lastname"];
    $email = $_SESSION["email"];
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
}
?>

<form class="float-right m-2" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div>
        <input type="hidden" name="logout" value="true">
    </div>
    <button type="submit" class="btn btn-primary">Logout</button>
</form>
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
            <?php echo create_input_tag("text", "firstname", $firstname);?>
            <php? check_and_echo_error($firstnameCorrect)?>
        </div>
        <div class="form-group col-auto">
            <label for="lastname">Nachname:</label>
            <?php echo create_input_tag("text", "lastname", $lastname);?>
            <php? check_and_echo_error($lastnameCorrect)?>
        </div>
        <div class="form-group col-auto">
            <label for="email">Email-Adresse:</label>
            <?php echo create_input_tag("email", "email", $email);?>
        </div>
        <div class="form-group col-auto">
            <label for="username">Username:</label>
            <?php echo create_input_tag("text", "username", $username);?>
            <php? check_and_echo_error($usernameTaken)?>
        </div>
        <div class="form-group col-auto">
            <label for="password">Passwort:</label>
            <?php echo create_input_tag("password", "password", $password);?>
        </div>
        <div class="form-group col-auto">
            <label for="repeatPassword">Passwort wiederholen:</label>
            <?php echo create_input_tag("password", "repeatPassword", $password);?>
            <php? check_and_echo_error($passwordSame);?>
        </div>
        <button type="submit" class="btn btn-primary">Speichern</button>
    </form>
</div>
