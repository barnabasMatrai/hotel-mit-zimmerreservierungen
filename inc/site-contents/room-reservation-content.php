<?php
    if (!isset($_SESSION["username"])) {
        header("Location: ../sites/login.php");
        exit("redirect to index");
    }

    $datesCorrect = $reservationNotAvailableCorrect = '';
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
            $cat = isset($_POST['cat']) ? true : false;

            if (empty($arrival) or
                empty($departure)) {
                $allFieldsFilledCorrect = 'Alle Felder müssen ausgefüllt sein!';
            }

            if (!arrival_and_departure_valid($arrival, $departure)) {
                $datesCorrect = "Anreise oder Abreise ist nicht korrekt!";
            }

            if (!isReservationAvailable($arrival, $departure)) {
                $reservationNotAvailableCorrect = "Das Zimmer ist schon für dieser Zeit vergeben!";
            }

            if (empty($allFieldsFilledCorrect) and empty($datesCorrect) and empty($reservationNotAvailableCorrect)) {
                $basePrice = 300;
                $breakfastPrice = $breakfast ? 25 : 0;
                $parkingPrice = $parking ? 100 : 0;
                $catPrice = $cat ? 5 : 0;
                $price = $basePrice + $breakfastPrice + $parkingPrice + $catPrice;

                $bookingDate = date("Y-m-d H:i:s");

                $db = getDb();
                insertReservation($db, $_SESSION['userid'], $arrival, $departure, $breakfast, $parking, $cat, $price, $bookingDate);
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
                <?php check_and_echo_error($reservationNotAvailableCorrect);?>
            </div>
        </div>
        <div class="d-flex justify-content-start flex-row">
            <div class="form-group col-auto flex-shrink-1">
                <p>Mit/Ohne Frühstück (+25€):</p>
                <div class="float-left">
                    <label for="withbreakfast">mit</label>
                    <input type="radio" name="breakfast" id="withbreakfast" value="1" required>
                </div>
                <div class="float-right">
                    <label for="withoutbreakfast">ohne</label>
                    <input type="radio" name="breakfast" id="withoutbreakfast" value="0">
                </div>
            </div>
            <div class="form-group col-auto flex-shrink-1">
                <p>Mit/Ohne Parkplatz (+100€):</p>
                <div class="float-left">
                    <label for="withparking">mit</label>
                    <input type="radio" name="parking" id="withparking" value="1" required>
                </div>
                <div class="float-right">
                    <label for="withoutparking">ohne</label>
                    <input type="radio" name="parking" id="withoutparking" value="0">
                </div>
            </div>
        </div>
        <div class="flex-row">
            <div class="form-group col-auto flex-shrink-1">
                <label for="cat">Ich bringe eine Katze mit (+5€):</label>
                <input class="align-middle" type="checkbox" value="cat" name="cat" id="cat">
            </div>
        </div>
        <div class="flex-row">
            <p class="text-primary">Grundpreis: 300€</p>
        </div>
        <div class="flex-row">
            <div class="form-group col-auto flex-shrink-1">
                <button type="submit" class="btn btn-primary">Reservieren</button>
            </div>
        </div>
    </form>
</div>