<!doctype html>
<html lang="en" dir="ltr">
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
            <button id="backBtn" class="btn btn-sm btn-outline-light me-2" title="Back">←</button>
            <a class="navbar-brand" href="/">Librava</a>
            <span class="navbar-text text-light">Library Management System</span>
            <button id="settingsToggle" class="btn btn-sm btn-outline-light ms-auto" aria-label="Settings">⚙︎</button>
        </div>
    </nav>
    <main class="container mt-5">
        <?php if (isset($content)) echo $content; ?>
    </main>
    <footer class="mt-5 py-4 bg-light text-center border-top">
        <p class="text-muted">Librava &copy; 2025. All rights reserved.</p>
    </footer>

    <!-- Floating Settings Panel -->
    <aside id="settingsPanel" class="settings-panel" aria-hidden="true">
        <div class="settings-header">
            <strong>Settings</strong>
            <button id="settingsClose" class="btn btn-sm btn-link">✕</button>
        </div>
        <div class="settings-body">
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" id="toggleRTL">
                <label class="form-check-label" for="toggleRTL">Use RTL layout</label>
            </div>
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" id="toggleDark">
                <label class="form-check-label" for="toggleDark">Dark mode</label>
            </div>
            <div class="mb-2">
                <label class="form-label" for="fontSizeRange">Font size</label>
                <input id="fontSizeRange" type="range" min="14" max="20" value="16" class="form-range">
            </div>
            <div class="mt-3">
                <button id="btnResetSettings" class="btn btn-sm btn-secondary">Reset</button>
            </div>
        </div>
    </aside>

    <div id="settingsBackdrop" class="settings-backdrop" hidden></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/app.js"></script>
</body>
</html>
