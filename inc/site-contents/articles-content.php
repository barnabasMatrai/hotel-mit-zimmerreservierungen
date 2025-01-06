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
        <?php foreach ($articles as $article):
                if (file_exists($dir . $article -> Filename)): ?>
        <li><div class='border border-3 border-black m-2'>
            <img src="<?= $dir . $article -> Filename ;?>" alt='Bild'>
            <p><?= $article -> Comment ;?></p>
        </li>
        <?php   endif;
              endforeach; ?>
    </ul>
</div>
