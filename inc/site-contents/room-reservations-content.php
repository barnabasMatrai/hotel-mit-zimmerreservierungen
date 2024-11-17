<?php
    if (!isset($_SESSION["username"])) {
        header("Location: ../sites/login.php");
        exit("redirect to index");
    }
?>

<div class="d-flex justify-content-center">
    <?php
    if (isset($_SESSION['arrival'])) {
        echo '<ul>
                  <li>
                      <div>
                            <p>Anreise: ' . $_SESSION['arrival'] . '</p>
                            <p>Abreise: ' . $_SESSION['departure'] . '</p>
                            <p>' . ($_SESSION['breakfast'] ? 'Mit Frühstück' : 'Ohne Frühstück') . '</p>
                            <p>' . ($_SESSION['parking'] ? 'Mit Parkplatz' : 'Ohne Parkplatz') . '</p>
                            <p>' . ($_SESSION['cat'] ? 'Katze' : 'Keine Katze') . '</p>
                      </div>
                  </li>
              </ul>';
    }
    ?>
</div>