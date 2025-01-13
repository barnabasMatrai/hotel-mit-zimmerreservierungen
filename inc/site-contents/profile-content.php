<?php

$allFieldsFilledCorrect = $firstnameCorrect = $lastnameCorrect = $usernameTaken = '';
$userId = $_SESSION["userid"];
$title = $_SESSION['title'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["logout"])) {
        session_unset();
        session_destroy();
        header("Location: ../sites/index.php");
        exit("redirect to index");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (isset($_POST['title']) and
        isset($_POST['firstname']) and
        isset($_POST['lastname']) and
        isset($_POST['email'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        if (empty($firstname) or
            empty($lastname) or
            empty($title) or
            empty($email)) {
            $allFieldsFilledCorrect = 'Alle Felder müssen ausgefüllt sein!';
        }

        $isFirstnameCorrect = test_capitalized($firstname);
        $isLastnameCorrect = test_capitalized($lastname);

        $firstnameCorrect = $isFirstnameCorrect ? '' : 'Vorname muss mit einem Grossbuchstaben beginnen!';
        $lastnameCorrect = $isLastnameCorrect ? '' : 'Nachname muss mit einem Grossbuchstaben beginnen!';
    
        if ($isFirstnameCorrect && $isLastnameCorrect) {
            updateUser($userId, $_POST['title'], $_POST['firstname'], $_POST['lastname'], $_POST['email']);
            $_SESSION["title"] = $_POST['title'];
            $_SESSION["firstname"] = $_POST['firstname'];
            $_SESSION["lastname"] = $_POST['lastname'];
            $_SESSION["email"] = $_POST['email'];

            $title = $_SESSION['title'];
            $firstname = $_SESSION['firstname'];
            $lastname = $_SESSION['lastname'];
            $email = $_SESSION['email'];
        }
    }
}
?>

<form class="float-end m-2" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div>
        <input type="hidden" name="logout" value="true">
    </div>
    <button type="submit" class="btn btn-primary">Logout</button>
</form>
<form class="float-end m-2" method="get" action="change-password.php">
    <div>
        <input type="hidden" name="changepassword" value="true">
    </div>
    <button type="submit" class="btn btn-primary">Passwort ändern</button>
</form>
<div class="d-flex justify-content-center">
    <form class="m-2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group col-auto">
            <label for="title">Anrede:</label>
            <select name="title" id="title" class="form-control">
                <option value="Herr" <?php select_choice($_SESSION['title'], "Herr") ?>>Herr</option>
                <option value="Frau" <?php select_choice($_SESSION['title'], "Frau") ?>>Frau</option>
                <option value="Divers" <?php select_choice($_SESSION['title'], "Divers") ?>>Divers</option>
            </select>
        </div>
        <div class="form-group col-auto">
            <label for="firstname">Vorname:</label>
            <?php echo create_input_tag("text", "firstname", "firstname", $firstname);?>
            <?php check_and_echo_error($firstnameCorrect)?>
        </div>
        <div class="form-group col-auto">
            <label for="lastname">Nachname:</label>
            <?php echo create_input_tag("text", "lastname", "lastname", $lastname);?>
            <?php check_and_echo_error($lastnameCorrect)?>
        </div>
        <div class="form-group col-auto">
            <label for="email">Email-Adresse:</label>
            <?php echo create_input_tag("email", "email", "email", $email);?>
        </div>
        <div class="form-group col-auto">
            <?php check_and_echo_error($allFieldsFilledCorrect)?>
            <button type="submit" class="btn btn-primary">Speichern</button>
        </div>
    </form>
</div>
