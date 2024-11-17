<?php
session_start();

include '..\inc\functions.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cat Hotel</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="content">
        <?php include '..\\inc\\nav.php';?>
        <main>
            <div class="bg-light">
                <?php
                $welcomeText = "";

                if (isset($_SESSION["username"]) and isset($_SESSION["password"]))
                {
                    $welcomeText = "Hallo " . htmlspecialchars($_SESSION["username"]);
                    echo '<div class="alert alert-success"><p class="mb-0">' . $welcomeText . '</p></div>';
                }

                if (isset($content)) {
                    include $content;
                }
                ?>
            </div>
    </div>
</body>

</html>
