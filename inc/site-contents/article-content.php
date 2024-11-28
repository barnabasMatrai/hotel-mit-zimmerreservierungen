<?php
$uploadFile = null;
$uploadDir = "../resources/news/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "received POST: ".json_encode($_POST)."<br>";
    echo "received FILES: ".json_encode($_FILES)."<br>";

    $uploadFile = $_FILES["file"]["tmp_name"];

    $valid = true; //maybe some checks like filesize, suffix, content-type, ...
    if($valid) {
       $uploadFile = $uploadDir . $_FILES['file']['name'];
// File and new size
$percent = 0.5;

// Get new sizes
list($width, $height) = getimagesize($_FILES['file']['tmp_name']);
$newwidth = $width * $percent;
$newheight = $height * $percent;

// Load
$thumb = imagecreatetruecolor($newwidth, $newheight);

// see https://stackoverflow.com/a/32666832/9219743
$source = imagecreatefromstring(file_get_contents($_FILES['file']['tmp_name']));

// Resize
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// Output
//header('Content-Type: image/jpeg');
imagejpeg($thumb, $uploadFile);
       //move_uploaded_file(imagejpeg($thumb), $uploadFile);
    }
}
?>

<h1>Form with multipart enctype</h1>
<form enctype="multipart/form-data" method="post">
    <input type="file" name="file">
    <input type="submit" value="Hochladen">
</form>

<?php if ($uploadFile): ?>
    <p>This image was uploaded:</p>
<?php endif; ?>

