<?php

$firstnameCorrect = $lastnameCorrect = $passwordSame = $usernameTaken = '';
$title = $firstname = $lastname = $email = $password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $_SESSION["title"] = isset($_POST['title']) ? $_POST['title'] : $_SESSION['title'];
    $_SESSION["firstname"] = isset($_POST['firstname']) ? $_POST['firstname'] : $_SESSION['firstname'];
    $_SESSION["lastname"] = isset($_POST['lastname']) ? $_POST['lastname'] : $_SESSION['lastname'];
    $_SESSION["email"] = isset($_POST['email']) ? $_POST['email'] : $_SESSION['email'];
}

if (isset($_SESSION["username"]))
{
    $title = $_SESSION["title"];
    $firstname = $_SESSION["firstname"];
    $lastname = $_SESSION["lastname"];
    $email = $_SESSION["email"];
}
?>

<form class="float-right m-2" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div>
        <input type="hidden" name="logout" value="true">
    </div>
    <button type="submit" class="btn btn-primary">Logout</button>
</form>
<form class="float-right m-2" method="get" action="change-password.php">
    <div>
        <input type="hidden" name="changepassword" value="true">
    </div>
    <button type="submit" class="btn btn-primary">Passwort ändern</button>
</form>
<div class="d-flex justify-content-center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group col-auto">
            <label for="title">Anrede:</label>
            <select name="title" id="title" class="form-control">
                <option value="herr" <?php select_title("herr") ?>>Herr</option>
                <option value="frau" <?php select_title("frau") ?>>Frau</option>
                <option value="divers" <?php select_title("divers") ?>>Divers</option>
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
        <button type="submit" class="btn btn-primary">Speichern</button>
    </form>
</div>
