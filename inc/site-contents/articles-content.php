<?php
$dir = "../resources/news/";
$allFiles = scandir($dir);
$files = array_diff($allFiles, array('.', '..'));
usort($files, function($a, $b) {
    $dir = "../resources/news/";
    return filectime($dir . $b) - filectime($dir . $a);
});

$db = getDb();
$articles = getArticles($db);
?>

<div class="d-flex justify-content-center">
    <ul>
        <?php foreach ($articles as $article): ?>
        <li><div class='border border-3 border-black m-2'>
            <img src="<?= $dir . $article -> filename ;?>" alt='Bild'>
            <p><?= $article -> comment ;?></p>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
