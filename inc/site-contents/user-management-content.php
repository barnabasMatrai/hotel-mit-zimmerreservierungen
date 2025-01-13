<?php
    if (!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]) {
        header("Location: ../sites/login.php");
        exit("redirect to index");
    }

    $db = getDb();
    $users = getUsers($db);
?>

<div class="d-flex justify-content-center">
    <ul class="list-unstyled">
        <?php foreach($users as $user): ?>
        <li>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if ($user -> Id == $_POST['id']) {
                    if ($_POST['type'] == 'changeProfile') {
                        updateUser($user -> Id, $_POST['title'], $_POST['firstname'], $_POST['lastname'], $_POST['email']);
                        $user -> FirstName = $_POST["firstname"];
                        $user -> LastName = $_POST['lastname'];
                        $user -> Title = $_POST['title'];
                        $user -> Email = $_POST['email'];
                    } else if ($_POST['type'] == 'changePassword') {
                        updatePassword($_POST['password'], $user -> Id);
                    } else if ($_POST['type'] == 'changeIsActive') {
                        updateIsActive($_POST['isActive'], $user -> Id);
                        $user -> IsActive = $_POST['isActive'];
                    }
                }
            }
            ?>
            <div class="border border-info">
                <div class="d-flex flex-row align-items-center justify-content-center m-2">
                    <div class="flex-column">
                        <p><?= $user->UserName ?></p>
                    </div>
                    <div class="flex-row">
                        <button class="btn btn-primary m-2" type="button" data-toggle="collapse" data-target="<?= "#collapseUser" . $user->Id ?>" aria-expanded="false" aria-controls="<?= "collapseUser" . $user->Id ?>">
                            Profildaten ändern
                        </button>
                        <button class="btn btn-primary m-2" type="button" data-toggle="collapse" data-target="<?= "#collapsePassword" . $user->Id ?>" aria-expanded="false" aria-controls="<?= "collapsePassword" . $user->Id ?>">
                            Passwort ändern
                        </button>
                        <button class="btn btn-primary m-2" type="button" data-toggle="collapse" data-target="<?= "#collapseIsActive" . $user->Id ?>" aria-expanded="false" aria-controls="<?= "collapseIsActive" . $user->Id ?>">
                            Aktivstatus ändern
                        </button>
                    </div>
                </div>

                <div id="accordion<?= $user->Id ?>">
                    <div class="collapse" id="<?= "collapseUser" . $user->Id ?>" data-parent="#accordion<?= $user->Id ?>">
                        <div class="card card-body">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <div class="form-group col-auto">
                                    <label for="<?= "title" . $user -> Id?>">Anrede:</label>
                                    <select name="title" id="<?= "title" . $user -> Id?>" class="form-control">
                                        <option value="Herr" <?php select_choice($user -> Title, "Herr") ?>>Herr</option>
                                        <option value="Frau" <?php select_choice($user -> Title, "Frau") ?>>Frau</option>
                                        <option value="Divers" <?php select_choice($user -> Title, "Divers") ?>>Divers</option>
                                    </select>
                                </div>
                                <div class="form-group col-auto">
                                    <label for="<?= "firstname" . $user -> Id?>">Vorname:</label>
                                    <?php echo create_input_tag("text", "firstname", "firstname" . $user -> Id, $user -> FirstName);?>
                                </div>
                                <div class="form-group col-auto">
                                    <label for="<?= "lastname" . $user -> Id?>">Nachname:</label>
                                    <?php echo create_input_tag("text", "lastname", "lastname" . $user -> Id, $user -> LastName);?>
                                </div>
                                <div class="form-group col-auto">
                                    <label for="<?= "email" . $user -> Id?>">Email-Adresse:</label>
                                    <?php echo create_input_tag("email", "email", "email" . $user -> Id, $user -> Email);?>
                                </div>
                                <div class="form-group col-auto">
                                    <input type="hidden" name="type" value="<?= "changeProfile"; ?>">
                                    <input type="hidden" name="id" value="<?= $user -> Id; ?>">
                                    <button type="submit" class="btn btn-primary">Speichern</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="collapse" id="<?= "collapsePassword" . $user->Id ?>" data-parent="#accordion<?= $user->Id ?>">
                        <div class="card card-body">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <div class="form-group col-auto">
                                    <label for="<?= "password" . $user -> Id?>">Neues Passwort:</label>
                                    <?php echo create_input_tag("password", "password", "password" . $user -> Id, "");?>
                                </div>
                                <div class="form-group col-auto">
                                    <input type="hidden" name="type" value="<?= "changePassword"; ?>">
                                    <input type="hidden" name="id" value="<?= $user -> Id; ?>">
                                    <button type="submit" class="btn btn-primary">Speichern</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="collapse" id="<?= "collapseIsActive" . $user->Id ?>" data-parent="#accordion<?= $user->Id ?>">
                        <div class="card card-body">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <fieldset>
                                    <legend>Benutzer ist Aktiv:</legend>
                                    <div class="float-left">
                                        <label for="<?= "isActive" . $user -> Id?>">ja</label>
                                        <input type="radio" name="isActive" id="<?= "isActive" . $user -> Id?>" value="1" required <?php select_isActive($user -> IsActive, 1); ?>>
                                    </div>
                                    <div class="float-right">
                                        <label for="<?= "isNotActive" . $user -> Id?>">nein</label>
                                        <input type="radio" name="isActive" id="<?= "isNotActive" . $user -> Id?>" value="0" <?php select_isActive($user -> IsActive, 0); ?>>
                                    </div>
                                </fieldset>
                                <div class="form-group col-auto">
                                    <input type="hidden" name="type" value="<?= "changeIsActive"; ?>">
                                    <input type="hidden" name="id" value="<?= $user -> Id; ?>">
                                    <button type="submit" class="btn btn-primary">Speichern</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>