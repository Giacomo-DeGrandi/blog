<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> <?= $title; ?> </title>
        <base href="index.php" target="_top">      <!-- keep your base url index.php !-->
        <link rel="stylesheet" type="text/css" href="public/css/blog.css">
    </head>
    <?= $header; ?>      
    <body>
        <main>
            <?= $content; ?>
        </main>
    </body>
        <footer>
            <?= $footer; ?>
        </footer>
</html>