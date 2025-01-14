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
<div class="d-flex justify-content-center">
    <ul class="border p-2 list-unstyled">
        <?php foreach ($reservations as $reservation): ?>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if ($reservation -> Id == $_POST['reservationId']) {
                    updateStatus($_POST['status'], $_POST['reservationId']);
                    $reservation -> Status = $_POST['status'];
                }
            }    
            ?>
            <li>
                <p><?= "Anreise: " . $reservation->Arrival; ?></p>
                <p><?= "Abreise: " . $reservation->Departure; ?></p>
                <p><?= $reservation->Breakfast ? 'Mit Frühstück' : 'Ohne Frühstück'; ?></p>
                <p><?= $reservation->Parking ? 'Mit Parkplatz' : 'Ohne Parkplatz'; ?></p>
                <p><?= $reservation->Cat ? 'Katze' : 'Keine Katze'; ?></p>
                <p><?= "Status: " . $reservation -> Status ;?></p>
            </li>
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
        <?php endforeach; ?>
    </ul>
</div>