<?php
    // if (!isset($_SESSION["username"])) {
    //     header("Location: ../sites/login.php");
    //     exit("redirect to index");
    // }
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

    }

    $db = getDb();
    $users = getUsers($db);
?>

<div class="d-flex justify-content-center">
    <ul>
        <?php foreach($users as $user): ?>
        <li>
            <?php
            $allFieldsFilledCorrect = $firstnameCorrect = $lastnameCorrect = $usernameTaken = '';

            if (empty($user -> FirstName) or
                empty($user -> LastName) or
                empty($user -> Title) or
                empty($user -> Email)) {
                $allFieldsFilledCorrect = 'Alle Felder müssen ausgefüllt sein!';
            }
        
            $isFirstnameCorrect = test_capitalized($user -> FirstName);
            $isLastnameCorrect = test_capitalized($user -> LastName);
        
            $firstnameCorrect = $isFirstnameCorrect ? '' : 'Vorname muss mit einem Grossbuchstaben beginnen!';
            $lastnameCorrect = $isLastnameCorrect ? '' : 'Nachname muss mit einem Grossbuchstaben beginnen!';

            ?>
            <div>
                <p><?= $user -> UserName ?></p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="<?= "#collapseUser" . $user -> Id?>" aria-expanded="false" aria-controls="<?= "collapseUser" . $user -> Id?>">
                    Button with data-target
                </button>
                <div class="collapse" id="<?= "collapseUser" . $user -> Id?>">
                    <div class="card card-body">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="form-group col-auto">
                                <label for="title">Anrede:</label>
                                <select name="title" id="title" class="form-control">
                                    <option value="Herr" <?php select_title($user -> Title, "herr") ?>>Herr</option>
                                    <option value="Frau" <?php select_title($user -> Title, "frau") ?>>Frau</option>
                                    <option value="Divers" <?php select_title($user -> Title, "divers") ?>>Divers</option>
                                </select>
                            </div>
                            <div class="form-group col-auto">
                                <label for="firstname">Vorname:</label>
                                <?php echo create_input_tag("text", "firstname", $user -> FirstName);?>
                                <?php check_and_echo_error($firstnameCorrect)?>
                            </div>
                            <div class="form-group col-auto">
                                <label for="lastname">Nachname:</label>
                                <?php echo create_input_tag("text", "lastname", $user -> LastName);?>
                                <?php check_and_echo_error($lastnameCorrect)?>
                            </div>
                            <div class="form-group col-auto">
                                <label for="email">Email-Adresse:</label>
                                <?php echo create_input_tag("email", "email", $user -> Email);?>
                            </div>
                            <div class="form-group col-auto">
                                <?php check_and_echo_error($allFieldsFilledCorrect)?>
                                <input type="hidden" name="id" value="<?= $user -> Id; ?>">
                                <button type="submit" class="btn btn-primary">Speichern</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>