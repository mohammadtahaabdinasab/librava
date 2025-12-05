<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= htmlentities($title ?? 'Librava') ?></title>
</head>
<body>
    <?php if (isset($content)) echo $content; ?>
</body>
</html>
