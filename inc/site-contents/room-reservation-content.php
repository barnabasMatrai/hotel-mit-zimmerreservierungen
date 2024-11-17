<?php
    if (!isset($_SESSION["username"])) {
        header("Location: ../sites/login.php");
        exit("redirect to index");
    }

    $datesCorrect = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (isset($_POST['arrival']) and
            isset($_POST['departure']) and
            isset($_POST['breakfast']) and
            isset($_POST['parking'])) {
            $arrival = $_POST['arrival'];
            $departure = $_POST['departure'];
            $breakfast = $_POST['breakfast'];
            $parking = $_POST['parking'];

            if (empty($arrival) or
                empty($departure) or
                empty($breakfast) or
                empty($parking)) {
                $allFieldsFilledCorrect = 'Alle Felder müssen ausgefüllt sein!';
            }

            if (!arrival_and_departure_valid($arrival, $departure)) {
                $datesCorrect = "Anreise oder Abreise ist nicht korrekt!";
            }

            if (empty($allFieldsFilledCorrect) and empty($datesCorrect)) {
                $_SESSION['arrival'] = $arrival;
                $_SESSION['departure'] = $departure;
                $_SESSION['breakfast'] = $breakfast;
                $_SESSION['parking'] = $parking;
                $_SESSION['cat'] = isset($_POST['cat']) ? true : false;
            }
        }
    }
?>

<div class="d-flex justify-content-center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="flex-row">
            <div class="form-group col-auto flex-shrink-1">
                <label for="arrival">Anreise:</label>
                <input type="date" name="arrival" id="arrival" class="form-control" required>
                <label for="departure">Abreise:</label>
                <input type="date" name="departure" id="departure" class="form-control" required>
                <?php check_and_echo_error($datesCorrect);?>
            </div>
        </div>
        <div class="d-flex justify-content-start flex-row">
            <div class="form-group col-auto flex-shrink-1">
                <p>Mit/Ohne Frühstück:</p>
                <div class="float-left">
                    <label for="withbreakfast">mit</label>
                    <input type="radio" name="breakfast" id="withbreakfast" value="withbreakfast" required>
                </div>
                <div class="float-right">
                    <label for="withoutbreakfast">ohne</label>
                    <input type="radio" name="breakfast" id="withoutbreakfast" value="withoutbreakfast">
                </div>
            </div>
            <div class="form-group col-auto flex-shrink-1">
                <p>Mit/Ohne Parkplatz:</p>
                <div class="float-left">
                    <label for="withparking">mit</label>
                    <input type="radio" name="parking" id="withparking" value="withparking" required>
                </div>
                <div class="float-right">
                    <label for="withoutparking">ohne</label>
                    <input type="radio" name="parking" id="withoutparking" value="withoutparking">
                </div>
            </div>
        </div>
        <div class="flex-row">
            <div class="form-group col-auto flex-shrink-1">
                <label for="cat">Ich bringe eine Katze mit:</label>
                <input class="align-middle" type="checkbox" value="cat" name="cat" id="cat">
            </div>
        </div>
        <div class="flex-row">
            <div class="form-group col-auto flex-shrink-1">
                <button type="submit" class="btn btn-primary">Reservieren</button>
            </div>
        </div>
    </form>
</div>