<?php
$dir = "../resources/news/";
$allFiles = scandir($dir);
$files = array_diff($allFiles, array('.', '..'));
usort($files, function($a, $b) {
    $dir = "../resources/news/";
    return filectime($dir . $b) - filectime($dir . $a);
});

$articles = getArticles();
?>

<div class="d-flex justify-content-center">
    <ul class="list-unstyled">
        <?php foreach ($articles as $article):
                if (file_exists($dir . $article -> Filename)):
                    $path_parts = pathinfo($article -> Filename);
                    $filenameWithoutExtension = $path_parts['filename']; ?>
        <li>
            <div class='border border-3 border-black m-2 text-center'>
                <p><?= $article -> UploadDate ?></p>
                <img class="border-top border-bottom border-3 border-black" src="<?= $dir . $article -> Filename ;?>" alt='<?= $filenameWithoutExtension ?>'>
                <p><?= $article -> Comment ;?></p>
            </div>
        </li>
        <?php   endif;
              endforeach; ?>
    </ul>
</div>
