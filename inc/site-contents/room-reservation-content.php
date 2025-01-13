<?php
    if (!isset($_SESSION["username"])) {
        header("Location: ../sites/login.php");
        exit("redirect to index");
    }

    $arrival = $departure = $breakfast = $parking = $cat = null;
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

                insertReservation($_SESSION['userid'], $arrival, $departure, $breakfast, $parking, $cat, $price, $bookingDate);
            }
        }
    }
?>

<div class="d-flex justify-content-center">
    <form class="m-2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="flex-row">
            <div class="form-group col-auto flex-shrink-1">
                <label for="arrival">Anreise:</label>
                <?php echo create_input_tag("date", "arrival", "arrival", $arrival);?>
                <label for="departure">Abreise:</label>
                <?php echo create_input_tag("date", "departure", "departure", $departure);?>
                <?php check_and_echo_error($datesCorrect);?>
                <?php check_and_echo_error($reservationNotAvailableCorrect);?>
            </div>
        </div>
        <div class="d-flex justify-content-start flex-row">
            <div class="form-group col-auto flex-shrink-1 m-1">
                <fieldset>
                    <legend class="fs-5">Mit/Ohne Frühstück (+25€):</legend>
                    <div class="float-left">
                        <label for="withbreakfast">mit</label>
                        <?php echo create_bool_input_tag("radio", "breakfast", "withbreakfast", 1, "required", $breakfast ? "checked" : "");?>
                    </div>
                    <div class="float-right">
                        <label for="withoutbreakfast">ohne</label>
                        <?php echo create_bool_input_tag("radio", "breakfast", "withoutbreakfast", 0, "required" , $breakfast || $breakfast === null ? "" : "checked");?>
                    </div>
                </fieldset>
            </div>
            <div class="form-group col-auto flex-shrink-1 m-1">
                <fieldset>
                    <legend class="fs-5">Mit/Ohne Parkplatz (+100€):</legend>
                    <div class="float-left">
                        <label for="withparking">mit</label>
                        <?php echo create_bool_input_tag("radio", "parking", "withparking", 1, "required" , $parking ? "checked" : "");?>
                    </div>
                    <div class="float-right">
                        <label for="withoutparking">ohne</label>
                        <?php echo create_bool_input_tag("radio", "parking", "withoutparking", 0, "required", $parking || $parking === null ? "" : "checked");?>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="flex-row">
            <div class="form-group col-auto flex-shrink-1">
                <label for="cat">Ich bringe eine Katze mit (+5€):</label>
                <?php echo create_bool_input_tag("checkbox", "cat", "cat", 0, "", $cat ? "checked" : "");?>
            </div>
        </div>
        <div class="flex-row bg-info">
            <p>Grundpreis: 300€</p>
        </div>
        <div class="flex-row">
            <div class="form-group col-auto flex-shrink-1">
                <button type="submit" class="btn btn-primary">Reservieren</button>
            </div>
        </div>
    </form>
</div>