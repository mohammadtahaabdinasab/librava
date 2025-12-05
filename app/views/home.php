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
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="mb-4"><?= htmlentities($message ?? 'Librava') ?></h1>
                <div class="alert alert-success" role="alert">
                    <strong>✅ Success!</strong> Your Librava application is running correctly.
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Getting Started</h5>
                        <p class="card-text">Welcome to Librava, a multilingual PHP MVC Library Management System.</p>
                        <ul>
                            <li>📖 Check out the <strong>README.md</strong> for project structure and features</li>
                            <li>🗄️ Import <code>database/librava.sql</code> to set up the database</li>
                            <li>⚙️ Configure your <code>.env</code> and <code>.env.local</code> files</li>
                            <li>🚀 Start building your library management features!</li>
                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                API Endpoint
                            </div>
                            <div class="card-body">
                                <code>/api/books</code> - Get all books (JSON)
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                Documentation
                            </div>
                            <div class="card-body">
                                <a href="https://github.com/mohammadtahaabdinasab/librava" class="btn btn-sm btn-primary">GitHub Repo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="mt-5 py-4 bg-light text-center border-top">
        <p class="text-muted">Librava &copy; 2025. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
