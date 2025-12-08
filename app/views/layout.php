<?php
/**
 * Main layout template for all pages
 * Includes navigation and footer
 */
?><!doctype html>
<html lang="<?= htmlentities($lang ?? 'en') ?>" dir="<?= htmlentities($dir ?? 'ltr') ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="<?= htmlentities($description ?? 'Librava - Multilingual Library Management System') ?>">
    <meta name="keywords" content="<?= htmlentities($keywords ?? 'library, books, management') ?>">
    <title><?= htmlentities($title ?? 'Librava') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVJkEZSMUjwokJlakedysLqiQmBNkENk16NfvYxqvapXenjf3AUW+RTOOMBF572HCwXMqsom8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="fas fa-book-open me-2"></i>Librava
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/books">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/creator">Creator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary btn-sm text-white ms-2" href="/api/books" target="_blank">
                            <i class="fas fa-flask me-1"></i>API
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?php if (isset($content)) echo $content; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5><i class="fas fa-book-open me-2 text-primary"></i>Librava</h5>
                    <p class="text-muted small">A comprehensive multilingual library management system for modern needs.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled small">
                        <li><a href="/" class="text-muted text-decoration-none">Home</a></li>
                        <li><a href="/books" class="text-muted text-decoration-none">Browse Books</a></li>
                        <li><a href="/about" class="text-muted text-decoration-none">About Us</a></li>
                        <li><a href="/contact" class="text-muted text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h6>Follow Us</h6>
                    <div class="text-muted small">
                        <a href="#" class="text-decoration-none text-muted me-3"><i class="fab fa-github"></i></a>
                        <a href="#" class="text-decoration-none text-muted me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-decoration-none text-muted me-3"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-decoration-none text-muted"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="text-center text-muted small">
                <p>&copy; 2025 Librava. All rights reserved. | <a href="#" class="text-muted text-decoration-none">Privacy Policy</a> | <a href="#" class="text-muted text-decoration-none">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <!-- Settings Panel -->
    <aside id="settingsPanel" class="settings-panel" aria-hidden="true">
        <div class="settings-header">
            <strong>Settings</strong>
            <button id="settingsClose" class="btn btn-sm btn-link text-dark">✕</button>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/app.js"></script>
</body>
</html>
