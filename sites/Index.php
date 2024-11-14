<?php
function check_and_echo_error($data) {
    if ($data !== '')
    {
        echo '<div class="alert alert-danger mt-2"><p class="mb-0">' . $data . '</p></div>';
    }
}

function test_input($data) {
    $data = htmlspecialchars($data);
    return $data;
}

$welcomeText = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && (!isset($_POST["form-type"]) || $_POST["form-type"] === "login")) {
    $passwordsByUsernames = array(
        "Rita12" => "r!ta",
        "Esther56" => "ichbinesther",
        "user1" => "user123"
    );

    $givenUsername = test_input($_POST["username"]);
    $givenPassword = test_input($_POST["passwort"]);

    foreach ($passwordsByUsernames as $username => $password)
    {
        if ($givenUsername === $username && $givenPassword === $password)
        {
            $welcomeText = "Hallo " . htmlspecialchars($_POST["username"]);
        }
    }
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
                <?php
                    if ($welcomeText !== '')
                    {
                        echo '<div class="alert alert-success"><p class="mb-0">' . $welcomeText . '</p></div>';
                    }
                ?>
                <?php
                if (isset($content)) {
                    include $content;
                }
                ?>
            </div>
    </div>
</body>

</html>
