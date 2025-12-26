<?php
$title = $title ?? 'Librava';
$lang = \Core\Config::get('app.default_lang') ?? 'fa';
$dir = $lang === 'fa' ? 'rtl' : 'ltr';
?>
<!doctype html>
<?php
$lang = \Core\Lang::getLocale();
$dir = \Core\Lang::dir();
?>
<html lang="<?= $lang ?>" dir="<?= $dir ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title) ?></title>
  <link rel="shortcut icon" href="/assets/img/fav-logo.png" type="image/png">
  <?php $isFa = \Core\Lang::getLocale() === 'fa'; ?>
  <link rel="stylesheet" href="/assets/css/bootstrap/<?= $isFa ? 'bootstrap.rtl.min.css' : 'bootstrap.min.css' ?>">
  <link rel="stylesheet" href="/assets/css/aos/aos.css">
  <link rel="stylesheet" href="/assets/css/fonts.css">
  <link rel="stylesheet" href="/assets/css/theme.css">
  <link rel="stylesheet" href="/assets/css/app.css">

</head>
<body class="layout-root">

  <?php require BASE_PATH . '/app/views/partials/header.php'; ?>

  <main class="layout-content container py-4">
    <?= $content ?? '' ?>
  </main>

  <?php require BASE_PATH . '/app/views/partials/footer.php'; ?>

</body>
</html>
