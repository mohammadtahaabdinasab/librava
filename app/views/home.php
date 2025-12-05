<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= htmlentities(
        $title ?? 'Librava'
    ) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <main>
        <h1><?= htmlentities($message ?? 'Librava') ?></h1>
        <p>This is a simple scaffolded view file at <code>app/views/home.php</code>.</p>
    </main>
</body>
</html>
