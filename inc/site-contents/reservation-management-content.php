<?php
    if (!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]) {
        header("Location: ../sites/login.php");
        exit("redirect to index");
    }

    $status = '';

    if (isset($_POST["filter"]) && $_POST["filter"]) {
        $status = $_POST["filter"];
    }
    $reservations = getAllReservations($status);
    $index = 1;
?>

<div class="d-flex justify-content-center">
    <form class="float-end m-2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group col-auto">
            <label for="status">Anrede:</label>
            <select name="filter" id="status" class="form-control">
                <option value=""></option>    
                <option value="neu">neu</option>
                <option value="bestätigt">bestätigt</option>
                <option value="storniert">storniert</option>
            </select>
        </div>
        <div class="form-group col-auto">
            <input type="hidden" name="reservationId" value="<?= -1; ?>">
            <button type="submit" class="btn btn-primary my-2">Filter</button>
        </div>
    </form>
</div>
<div>
    <ul class="d-flex flex-row flex-wrap justify-content-center border p-2 list-unstyled">
        <?php foreach ($reservations as $reservation): ?>
            <?php
            $userName = getUsernameFromReservationId($reservation -> Id);
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if ($reservation -> Id == $_POST['reservationId']) {
                    updateStatus($_POST['status'], $_POST['reservationId']);
                    $reservation -> Status = $_POST['status'];
                }
            }    
            ?>
            <li class="mx-3 my-2">
                <div>
                    <div class="d-flex flex-row justify-content-center">
                        <p class="text-center"><?= $userName ?></p>
                    </div>
                    <div class="d-flex flex-row justify-content-center">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="<?= "#collapseReservation" . $reservation -> Id ?>" aria-expanded="false" aria-controls="<?= "collapseReservation" . $reservation -> Id ?>">
                            <?php
                                echo "Reservation " . $index;
                                $index++;
                            ?>
                        </button>
                    </div>
                </div>
                <div class="collapse" id="<?= "collapseReservation" . $reservation -> Id ?>">
                    <div class="card card-body">
                        <div>
                            <p><?= "Anreise: " . $reservation->Arrival; ?></p>
                            <p><?= "Abreise: " . $reservation->Departure; ?></p>
                            <p><?= $reservation->Breakfast ? 'Mit Frühstück' : 'Ohne Frühstück'; ?></p>
                            <p><?= $reservation->Parking ? 'Mit Parkplatz' : 'Ohne Parkplatz'; ?></p>
                            <p><?= $reservation->Cat ? 'Katze' : 'Keine Katze'; ?></p>
                            <p><?= "Status: " . $reservation -> Status ;?></p>
                            <p><?= "Preis: " . $reservation -> Price . "€";?></p>
                        </div>
                        <form class="m-2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="form-group col-auto">
                                <label for="<?= "status" . $reservation -> Id?>">Status ändern:</label>
                                <select name="status" id="<?= "status" . $reservation -> Id?>" class="form-control">
                                    <option value="neu" <?php select_choice($reservation -> Status, "neu") ?>>neu</option>
                                    <option value="bestätigt" <?php select_choice($reservation -> Status, "bestätigt") ?>>bestätigt</option>
                                    <option value="storniert" <?php select_choice($reservation -> Status, "storniert") ?>>storniert</option>
                                </select>
                            </div>
                            <div class="form-group col-auto">
                                <input type="hidden" name="reservationId" value="<?= $reservation -> Id; ?>">
                                <button type="submit" class="btn btn-primary my-2">Speichern</button>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>