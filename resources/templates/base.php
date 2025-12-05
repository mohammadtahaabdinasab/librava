<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= htmlentities($title ?? 'Librava') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">📚 Librava</a>
            <span class="navbar-text text-light">Library Management System</span>
        </div>
    </nav>
    <main class="container mt-5">
        <?php if (isset($content)) echo $content; ?>
    </main>
    <footer class="mt-5 py-4 bg-light text-center border-top">
        <p class="text-muted">Librava &copy; 2025. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
