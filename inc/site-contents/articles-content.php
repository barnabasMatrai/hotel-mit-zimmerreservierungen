<?php
$dir = "../resources/news/";
$allFiles = scandir($dir);
$files = array_diff($allFiles, array('.', '..'));
// $files = glob('path/to/files/*.swf');
usort($files, function($a, $b) {
    $dir = "../resources/news/";
    return filectime($dir . $b) - filectime($dir . $a);
});
?>

<ul>
    <?php
    foreach ($files as $filename) {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        echo $ext;
        $filePath = str_replace(' ', '%20', $dir . $filename);
        if (strcmp($ext, "png") === 0) {
            echo $filePath;
            echo "<li><img src=" . $filePath . " alt='Bild'></li>";
        } else {
            echo "<li>$filename</li>";
            echo file_get_contents($dir . $filename);
        }
    }

    // How to list only files with specific suffix (e.g. .txt and .json)?
    ?>
</ul>