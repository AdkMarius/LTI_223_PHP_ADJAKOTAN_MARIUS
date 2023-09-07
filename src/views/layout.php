<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $description ?>">
    <link <?php if(isset($linkFirst)) echo $linkFirst ?> >
    <link <?php if(isset($linkSecond)) echo $linkSecond ?> >
    <link <?php if(isset($linkThird)) echo $linkThird ?> >
    <link <?php if(isset($linkFourth)) echo $linkFourth ?> >
    <script <?php if(isset($script)) echo $script ?> ></script>
    <script <?php if(isset($scriptFontAwesome)) echo $scriptFontAwesome ?> ></script>
</head>
<body>
    <?= $content; ?>
</body>
</html>