<?php
/**
 * Books page view - Browse and search books
 */
?>
<!-- Page Header -->
<section class="py-5" style="background: linear-gradient(135deg, #606c38 0%, #283618 100%);">
    <div class="container">
        <h1 class="text-white display-4 fw-bold">📚 <?php t('books.title'); ?></h1>
        <p class="text-light lead"><?php t('books.subtitle'); ?></p>
    </div>
</section>

<!-- Search and Filter Section -->
<section class="py-4 bg-light border-bottom sticky-top" style="z-index: 100;">
    <div class="container">
        <form id="booksSearchForm" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="<?php t('books.search_placeholder'); ?>">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="yearFilter">
                    <option value=""><?php t('books.all_years'); ?></option>
                    <option value="1900-1950">1900-1950</option>
                    <option value="1950-2000">1950-2000</option>
                    <option value="2000-2025">2000-2025</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search me-2"></i><?php t('books.search_btn'); ?>
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Books Grid -->
<section class="py-5">
    <div class="container">
        <div id="booksContainer" class="row g-4">
            <!-- Books will be loaded here or shown from API -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 book-card shadow-sm">
                    <div class="card-body">
                        <div class="book-icon mb-3 text-center">
                            <i class="fas fa-book fa-4x" style="color: #606c38;"></i>
                        </div>
                        <h5 class="card-title">1984</h5>
                        <p class="card-text text-muted"><strong><?php t('books.author'); ?>:</strong> George Orwell</p>
                        <p class="card-text text-muted"><strong><?php t('books.published'); ?>:</strong> 1949</p>
                        <p class="card-text">
                            Dystopian novel exploring themes of totalitarianism, surveillance, and control in a bleak future society.
                        </p>
                        <div class="rating mb-3">
                            <span style="color: #ffc107;">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </span>
                            <small class="text-muted">(4.5/5)</small>
                        </div>
                        <button class="btn btn-sm btn-primary w-100">
                            <i class="fas fa-info-circle me-2"></i><?php t('books.view_details'); ?>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 book-card shadow-sm">
                    <div class="card-body">
                        <div class="book-icon mb-3 text-center">
                            <i class="fas fa-book fa-4x" style="color: #606c38;"></i>
                        </div>
                        <h5 class="card-title">To Kill a Mockingbird</h5>
                        <p class="card-text text-muted"><strong><?php t('books.author'); ?>:</strong> Harper Lee</p>
                        <p class="card-text text-muted"><strong><?php t('books.published'); ?>:</strong> 1960</p>
                        <p class="card-text">
                            A gripping tale of racial injustice, moral growth, and childhood innocence in the American South.
                        </p>
                        <div class="rating mb-3">
                            <span style="color: #ffc107;">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                            <small class="text-muted">(5/5)</small>
                        </div>
                        <button class="btn btn-sm btn-primary w-100">
                            <i class="fas fa-info-circle me-2"></i><?php t('books.view_details'); ?>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 book-card shadow-sm">
                    <div class="card-body">
                        <div class="book-icon mb-3 text-center">
                            <i class="fas fa-book fa-4x" style="color: #606c38;"></i>
                        </div>
                        <h5 class="card-title">The Great Gatsby</h5>
                        <p class="card-text text-muted"><strong>Author:</strong> F. Scott Fitzgerald</p>
                        <p class="card-text text-muted"><strong>Year:</strong> 1925</p>
                        <p class="card-text">
                            A masterpiece depicting the Jazz Age, the American Dream, wealth, love, and the pursuit of happiness.
                        </p>
                        <div class="rating mb-3">
                            <span style="color: #ffc107;">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </span>
                            <small class="text-muted">(4.5/5)</small>
                        </div>
                        <button class="btn btn-sm btn-primary w-100">
                            <i class="fas fa-info-circle me-2"></i>View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load More / Pagination -->
        <div class="text-center mt-5">
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5"><?php t('books.popular_categories'); ?></h2>
        <div class="row g-3">
            <div class="col-md-4 col-lg-2">
                <a href="#" class="category-btn text-decoration-none text-center">
                    <div class="category-icon mb-2">
                        <i class="fas fa-globe fa-2x" style="color: #606c38;"></i>
                    </div>
                    <h6><?php t('books.fiction'); ?></h6>
                </a>
            </div>
            <div class="col-md-4 col-lg-2">
                <a href="#" class="category-btn text-decoration-none text-center">
                    <div class="category-icon mb-2">
                        <i class="fas fa-flask fa-2x" style="color: #606c38;"></i>
                    </div>
                    <h6><?php t('books.science'); ?></h6>
                </a>
            </div>
            <div class="col-md-4 col-lg-2">
                <a href="#" class="category-btn text-decoration-none text-center">
                    <div class="category-icon mb-2">
                        <i class="fas fa-graduation-cap fa-2x" style="color: #606c38;"></i>
                    </div>
                    <h6><?php t('books.education'); ?></h6>
                </a>
            </div>
            <div class="col-md-4 col-lg-2">
                <a href="#" class="category-btn text-decoration-none text-center">
                    <div class="category-icon mb-2">
                        <i class="fas fa-heart fa-2x" style="color: #606c38;"></i>
                    </div>
                    <h6><?php t('books.romance'); ?></h6>
                </a>
            </div>
            <div class="col-md-4 col-lg-2">
                <a href="#" class="category-btn text-decoration-none text-center">
                    <div class="category-icon mb-2">
                        <i class="fas fa-book fa-2x" style="color: #606c38;"></i>
                    </div>
                    <h6><?php t('books.history'); ?></h6>
                </a>
            </div>
            <div class="col-md-4 col-lg-2">
                <a href="#" class="category-btn text-decoration-none text-center">
                    <div class="category-icon mb-2">
                        <i class="fas fa-lightbulb fa-2x" style="color: #606c38;"></i>
                    </div>
                    <h6><?php t('books.self_help'); ?></h6>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    .book-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        height: 100%;
    }
    
    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(96, 108, 56, 0.15) !important;
    }
    
    .book-icon {
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 8px;
    }
    
    .category-btn {
        padding: 2rem 1rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: block;
    }
    
    .category-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }
    
    .category-btn h6 {
        margin: 0;
        color: #283618;
        font-weight: 600;
    }
    
    #booksSearchForm {
        background: white;
        padding: 1rem;
        border-radius: 8px;
    }
</style>

<script>
document.getElementById('booksSearchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    
    // Filter books based on search
    const bookCards = document.querySelectorAll('.book-card');
    bookCards.forEach(card => {
        const title = card.querySelector('.card-title').textContent.toLowerCase();
        const author = card.querySelector('.card-text').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || author.includes(searchTerm)) {
            card.closest('[class*="col-"]').style.display = 'block';
        } else {
            card.closest('[class*="col-"]').style.display = 'none';
        }
    });
});
</script>
