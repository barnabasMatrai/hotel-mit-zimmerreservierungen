<?php
$uploadFile = null;
$uploadDir = "../resources/news/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "received POST: ".json_encode($_POST)."<br>";
    // echo "received FILES: ".json_encode($_FILES)."<br>";
    $valid = true; //maybe some checks like filesize, suffix, content-type, ... 
    $extensions=array("png","gif","jpeg");
    $valid = matchesAny(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION), $extensions);
    if($valid) {
        createAndSaveResizedImage($_FILES["file"]["tmp_name"], $uploadDir);
        
        $comment = $_POST["comment"];
        $path_parts = pathinfo($uploadDir . $_FILES['file']['name']);
        $filename = $path_parts['filename'];
        $newFile = fopen($uploadDir . $filename . ".txt","w");
        fwrite($newFile, $comment);
    }
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
    // File and new size
    $percent = 0.3;

    // Get new sizes
    list($width, $height) = getimagesize($_FILES['file']['tmp_name']); 
    $newwidth = $width;
    $newheight = $height;
    if ($width > 900) {
        $newwidth *= $percent;
        $newheight *= $percent;
    }

    // Load
    $thumb = imagecreatetruecolor($newwidth, $newheight);

    // see https://stackoverflow.com/a/32666832/9219743
    $source = imagecreatefromstring(file_get_contents($_FILES['file']['tmp_name']));

    // Resize
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    // Output
    //header('Content-Type: image/jpeg');
    imagejpeg($thumb, $uploadFile);
}
?>

<h1>Form with multipart enctype</h1>
<form enctype="multipart/form-data" method="post">
    <input type="file" name="file">
    <label for="comment"></label>
    <textarea id="comment" name="comment" rows="3" cols="50"></textarea>
    <input type="submit" value="Hochladen">
</form>

<?php if ($uploadFile): ?>
    <p>This image was uploaded:</p>
<?php endif; ?>

