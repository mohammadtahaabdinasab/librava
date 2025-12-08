<?php
/**
 * Home page view
 */
?>
<!-- Hero Section -->
<section class="hero-section py-5 bg-gradient" style="background: linear-gradient(135deg, #606c38 0%, #283618 100%);">
    <div class="container text-center text-white py-5">
        <h1 class="display-3 fw-bold mb-3">📚 Welcome to Librava</h1>
        <p class="lead mb-4">The Modern Multilingual Library Management System</p>
        <a href="/books" class="btn btn-primary btn-lg me-2">
            <i class="fas fa-book me-2"></i>Browse Books
        </a>
        <a href="#features" class="btn btn-outline-light btn-lg">
            <i class="fas fa-info-circle me-2"></i>Learn More
        </a>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">✨ Key Features</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center">
                        <i class="fas fa-globe fa-3x mb-3" style="color: #dda15e;"></i>
                        <h5 class="card-title">Multilingual</h5>
                        <p class="card-text small">Support for English and Persian (RTL/LTR)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center">
                        <i class="fas fa-mobile-alt fa-3x mb-3" style="color: #dda15e;"></i>
                        <h5 class="card-title">Mobile Ready</h5>
                        <p class="card-text small">Fully responsive design with API support</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center">
                        <i class="fas fa-lock fa-3x mb-3" style="color: #dda15e;"></i>
                        <h5 class="card-title">Secure</h5>
                        <p class="card-text small">JWT authentication and role-based access</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center">
                        <i class="fas fa-bolt fa-3x mb-3" style="color: #dda15e;"></i>
                        <h5 class="card-title">Fast</h5>
                        <p class="card-text small">Optimized performance and quick search</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-3">
                <h3 class="display-5" style="color: #606c38;">1000+</h3>
                <p class="text-muted">Books in Collection</p>
            </div>
            <div class="col-md-4 mb-3">
                <h3 class="display-5" style="color: #606c38;">500+</h3>
                <p class="text-muted">Active Members</p>
            </div>
            <div class="col-md-4 mb-3">
                <h3 class="display-5" style="color: #606c38;">25+</h3>
                <p class="text-muted">API Endpoints</p>
            </div>
        </div>
    </div>
</section>

<!-- Recent Books Section -->
<section class="py-5">
    <div class="container">
        <h2 class="mb-5">📖 Featured Books</h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm book-card">
                    <div class="card-body">
                        <h5 class="card-title">1984</h5>
                        <p class="card-text text-muted">George Orwell</p>
                        <p class="card-text small"><strong>Published:</strong> 1949</p>
                        <p class="card-text">Dystopian novel exploring themes of totalitarianism and control.</p>
                        <a href="/books" class="btn btn-sm btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm book-card">
                    <div class="card-body">
                        <h5 class="card-title">To Kill a Mockingbird</h5>
                        <p class="card-text text-muted">Harper Lee</p>
                        <p class="card-text small"><strong>Published:</strong> 1960</p>
                        <p class="card-text">A gripping tale of racial injustice and childhood innocence.</p>
                        <a href="/books" class="btn btn-sm btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm book-card">
                    <div class="card-body">
                        <h5 class="card-title">The Great Gatsby</h5>
                        <p class="card-text text-muted">F. Scott Fitzgerald</p>
                        <p class="card-text small"><strong>Published:</strong> 1925</p>
                        <p class="card-text">A masterpiece depicting the Jazz Age and American Dream.</p>
                        <a href="/books" class="btn btn-sm btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="/books" class="btn btn-lg btn-outline-primary">
                <i class="fas fa-library me-2"></i>View All Books
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, #dda15e 0%, #bc6c25 100%);">
    <div class="container text-center text-white">
        <h2 class="mb-4">Ready to Get Started?</h2>
        <p class="lead mb-4">Join our community and manage your library efficiently</p>
        <a href="/contact" class="btn btn-light btn-lg me-2">
            <i class="fas fa-envelope me-2"></i>Contact Us
        </a>
        <a href="#" class="btn btn-outline-light btn-lg">
            <i class="fas fa-external-link-alt me-2"></i>View API Docs
        </a>
    </div>
</section>

<style>
    .hero-section {
        min-height: 500px;
        display: flex;
        align-items: center;
    }
    
    .feature-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(96, 108, 56, 0.15);
    }
    
    .book-card {
        transition: transform 0.3s ease;
        border: none;
    }
    
    .book-card:hover {
        transform: scale(1.02);
    }
</style>
