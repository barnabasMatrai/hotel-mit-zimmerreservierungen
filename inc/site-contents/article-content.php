<?php
if (!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]) {
    header("Location: ../sites/login.php");
    exit("redirect to index");
}

$fileUploaded = false;
$uploadDir = "../resources/news/";

$fileCorrect = $commentCorrect = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $extensions = array("png");
    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    $isImage = matchesAny($extension, $extensions);

    $isValid = true;
    if (empty($_FILES["file"]["name"])) {
        $isValid = false;
        $fileCorrect = "Ein Bild muss hochgeladet werden!";
    } else if (!$isImage) {
        $isValid = false;
        $fileCorrect = "Das hochgeladete File ist kein Bild!";
    }

    $comment = $_POST["comment"];
    if (empty($comment)) {
        $isValid = false;
        $commentCorrect = "Das Kommentar darf nicht leer sein!";
    }
    
    if ($isValid) {
        createAndSaveResizedImage($_FILES["file"]["tmp_name"], $uploadDir);
        createAndSaveComment($comment, $uploadDir);
        
        insertArticle($comment, $_FILES["file"]["name"], date("Y-m-d H:i:s"));
        $fileUploaded = true;
    }
    
}

function createAndSaveComment($comment, $uploadDir) {
    $path_parts = pathinfo($uploadDir . $_FILES['file']['name']);
    $filename = $path_parts['filename'];
    $newFile = fopen($uploadDir . $filename . ".txt","w");
    fwrite($newFile, $comment);
}

function matchesAny($filename, $allowedSuffixes){
    foreach ($allowedSuffixes as $suffix) {
        if (str_ends_with($filename, $suffix)) {
            return true;
        }
    }
    return false;
}

function createAndSaveResizedImage($uploadFile, $uploadDir) {
    $uploadFile = $uploadDir . $_FILES['file']['name'];

    list($width, $height) = getimagesize($_FILES['file']['tmp_name']); 
    $newwidth = 720;
    $newheight = 480;

    $thumb = imagecreatetruecolor($newwidth, $newheight);

    $source = imagecreatefromstring(file_get_contents($_FILES['file']['tmp_name']));

    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    imagejpeg($thumb, $uploadFile);
}
?>

<div class="d-flex justify-content-center">
    <form enctype="multipart/form-data" method="post">
        <div class="form-group col-auto">
            <label for="file">Bild:</label>
            <input class="form-control" type="file" name="file" id="file">
            <?php check_and_echo_error($fileCorrect);?>
        </div>
        <div class="form-group col-auto">
            <label for="comment">Artikel:</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" cols="50"></textarea>
            <?php check_and_echo_error($commentCorrect);?>
        </div>
        <div class="form-group col-auto">
            <input class="btn btn-primary m-2" type="submit" value="Hochladen">
        </div>
        <?php if ($fileUploaded): ?>
            <div class="alert alert-success"><p class="mb-0">Artikel hochgeladen!</p></div>
        <?php endif; ?>
    </form>
</div>