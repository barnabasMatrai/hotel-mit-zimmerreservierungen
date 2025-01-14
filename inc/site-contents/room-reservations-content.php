<?php
    if (!isset($_SESSION["username"])) {
        header("Location: ../sites/login.php");
        exit("redirect to index");
    }

    $reservations = getReservations($_SESSION["userid"]);
    $index = 1;
?>

<div class="d-flex justify-content-center">
    <ul class="d-flex flex-row flex-wrap justify-content-center border p-2 list-unstyled">
        <?php foreach($reservations as $reservation): ?>
        <li class="mx-3 my-2">
            <div>
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
                    <p><?= "Anreise: " . $reservation -> Arrival ;?></p>
                    <p><?= "Abreise: " . $reservation -> Departure ;?></p>
                    <p><?= $reservation -> Breakfast ? 'Mit Frühstück' : 'Ohne Frühstück' ;?></p>
                    <p><?= $reservation -> Parking ? 'Mit Parkplatz' : 'Ohne Parkplatz' ;?></p>
                    <p><?= $reservation -> Cat ? 'Katze' : 'Keine Katze' ;?></p>
                    <p><?= "Status: " . $reservation -> Status ;?></p>
                    <p><?= "Preis: " . $reservation -> Price . "€";?></p>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>