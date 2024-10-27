<?php
$welcomeText = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $welcomeText = "Hallo " . htmlspecialchars($_POST["username"]);
    
}
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
                <span><?php echo $welcomeText;?></span>
                <?php
                if (isset($content)) {
                    include $content;
                }
                ?>
            </div>
    </div>
</body>

</html>
