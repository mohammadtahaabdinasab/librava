<?php
/**
 * Home page view
 */
?>
<!-- Hero Section -->
<section class="hero-section py-5 bg-gradient" style="background: linear-gradient(135deg, #606c38 0%, #283618 100%);">
    <div class="container text-center text-white py-5">
        <h1 class="display-3 fw-bold mb-3">📚 <?php t('home.title'); ?></h1>
        <p class="lead mb-4"><?php t('home.subtitle'); ?></p>
        <a href="/books" class="btn btn-primary btn-lg me-2">
            <i class="fas fa-book me-2"></i><?php t('home.browse_books'); ?>
        </a>
        <a href="#features" class="btn btn-outline-light btn-lg">
            <i class="fas fa-info-circle me-2"></i><?php t('home.learn_more'); ?>
        </a>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">✨ <?php t('home.features'); ?></h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center">
                        <i class="fas fa-globe fa-3x mb-3" style="color: #dda15e;"></i>
                        <h5 class="card-title"><?php t('home.multilingual'); ?></h5>
                        <p class="card-text small"><?php t('home.multilingual_desc'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center">
                        <i class="fas fa-mobile-alt fa-3x mb-3" style="color: #dda15e;"></i>
                        <h5 class="card-title"><?php t('home.mobile_ready'); ?></h5>
                        <p class="card-text small"><?php t('home.mobile_ready_desc'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center">
                        <i class="fas fa-lock fa-3x mb-3" style="color: #dda15e;"></i>
                        <h5 class="card-title"><?php t('home.secure'); ?></h5>
                        <p class="card-text small"><?php t('home.secure_desc'); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 feature-card">
                    <div class="card-body text-center">
                        <i class="fas fa-bolt fa-3x mb-3" style="color: #dda15e;"></i>
                        <h5 class="card-title"><?php t('home.fast'); ?></h5>
                        <p class="card-text small"><?php t('home.fast_desc'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
                <p class="text-muted"><?php t('home.books_collection'); ?></p>
            </div>
            <div class="col-md-4 mb-3">
                <h3 class="display-5" style="color: #606c38;">500+</h3>
                <p class="text-muted"><?php t('home.active_members'); ?></p>
            </div>
            <div class="col-md-4 mb-3">
                <h3 class="display-5" style="color: #606c38;">25+</h3>
                <p class="text-muted"><?php t('home.api_endpoints'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Recent Books Section -->
<section class="py-5">
    <div class="container">
        <h2 class="mb-5">📖 <?php t('home.featured_books'); ?></h2>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm book-card">
                    <div class="card-body">
                        <h5 class="card-title">1984</h5>
                        <p class="card-text text-muted">George Orwell</p>
                        <p class="card-text small"><strong><?php t('books.published'); ?>:</strong> 1949</p>
                        <p class="card-text">Dystopian novel exploring themes of totalitarianism and control.</p>
                        <a href="/books" class="btn btn-sm btn-primary"><?php t('books.view_details'); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm book-card">
                    <div class="card-body">
                        <h5 class="card-title">To Kill a Mockingbird</h5>
                        <p class="card-text text-muted">Harper Lee</p>
                        <p class="card-text small"><strong><?php t('books.published'); ?>:</strong> 1960</p>
                        <p class="card-text">A gripping tale of racial injustice and childhood innocence.</p>
                        <a href="/books" class="btn btn-sm btn-primary"><?php t('books.view_details'); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm book-card">
                    <div class="card-body">
                        <h5 class="card-title">The Great Gatsby</h5>
                        <p class="card-text text-muted">F. Scott Fitzgerald</p>
                        <p class="card-text small"><strong><?php t('books.published'); ?>:</strong> 1925</p>
                        <p class="card-text">A masterpiece depicting the Jazz Age and American Dream.</p>
                        <a href="/books" class="btn btn-sm btn-primary"><?php t('books.view_details'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="/books" class="btn btn-lg btn-outline-primary">
                <i class="fas fa-library me-2"></i><?php t('home.view_all_books'); ?>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, #dda15e 0%, #bc6c25 100%);">
    <div class="container text-center text-white">
        <h2 class="mb-4"><?php t('home.ready_to_start'); ?></h2>
        <p class="lead mb-4"><?php t('home.join_community'); ?></p>
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
