<?php
$dir = "../resources/news/";
$allFiles = scandir($dir);
$files = array_diff($allFiles, array('.', '..'));
usort($files, function($a, $b) {
    $dir = "../resources/news/";
    return filectime($dir . $b) - filectime($dir . $a);
});
?>

<div class="d-flex justify-content-center">
    <ul>
        <?php
        foreach ($files as $filename) {
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $filePath = str_replace(' ', '%20', $dir . $filename);

            if (strcmp($ext, "png") === 0) {
                echo "<li><div class='border border-3 border-black m-2'>";
                echo "<img src=" . $filePath . " alt='Bild'>";
            } else {
                echo "<p>" . file_get_contents($dir . $filename) . "</p>";
                echo "</div></li>";
            }
        }
        ?>
    </ul>
</div>
