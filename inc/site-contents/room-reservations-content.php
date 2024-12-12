<?php
    if (!isset($_SESSION["username"])) {
        header("Location: ../sites/login.php");
        exit("redirect to index");
    }

    $db = getDb();
    $reservations = getReservations($db, $_SESSION["userid"]);
?>

<div class="d-flex justify-content-center">
    <ul>
        <?php foreach($reservations as $reservation): ?>
        <li>
            <p><?= "Anreise: " . $reservation -> Arrival ;?></p>
            <p><?= "Abreise: " . $reservation -> Departure ;?></p>
            <p><?= $reservation -> Breakfast ? 'Mit Frühstück' : 'Ohne Frühstück' ;?></p>
            <p><?= $reservation -> Parking ? 'Mit Parkplatz' : 'Ohne Parkplatz' ;?></p>
            <p><?= $reservation -> Cat ? 'Katze' : 'Keine Katze' ;?></p>
        </li>
        <?php endforeach; ?>
    </ul>    
</div>