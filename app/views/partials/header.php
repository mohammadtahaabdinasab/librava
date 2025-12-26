<?php
$isFa = \Core\Lang::getLocale() === 'fa';
$current = $_SERVER['REQUEST_URI'] ?? '/';

function isActive(string $path, string $current): string {
    $currentPath = parse_url($current, PHP_URL_PATH) ?? '/';
    return $currentPath === $path ? 'active' : '';
}
?>
<header class="shadow-sm" style="background: linear-gradient(135deg, var(--pine-teal), var(--dark-emerald));">
  <nav class="navbar navbar-expand-lg navbar-dark py-3">
    <div class="container">

      <a class="navbar-brand d-flex align-items-center gap-2" href="/" data-aos="fade-down" data-aos-duration="600">
        <span class="rounded-3 p-2 d-inline-flex align-items-center justify-content-center">
          <img src="/assets/img/nav-logo.png" alt="<?= __('site.title') ?>" width="56" height="34">
        </span>
        <span class="fw-semibold"><?= __('site.title') ?></span>
      </a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNav">

        <ul class="navbar-nav <?= $isFa ? 'me-auto' : 'ms-auto' ?> gap-lg-1 mt-3 mt-lg-0" data-aos="fade-down" data-aos-delay="80" data-aos-duration="600">
          <li class="nav-item">
            <a class="nav-link <?= isActive('/', $current) ?>" href="/"><?= __('nav.home') ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isActive('/books', $current) ?>" href="/books"><?= __('nav.books') ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isActive('/about', $current) ?>" href="/about"><?= __('nav.about') ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isActive('/contact', $current) ?>" href="/contact"><?= __('nav.contact') ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isActive('/developer', $current) ?>" href="/developer"><?= __('nav.developer') ?></a>
          </li>
        </ul>

        <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0" data-aos="fade-down" data-aos-delay="140" data-aos-duration="600">

          <div class="dropdown">
            <button class="btn btn-outline-light btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <?= __('nav.language') ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-<?= $isFa ? 'start' : 'end' ?>">
              <li><a class="dropdown-item" href="?lang=fa"><?= __('nav.fa') ?></a></li>
              <li><a class="dropdown-item" href="?lang=en"><?= __('nav.en') ?></a></li>
            </ul>
          </div>

          <a class="btn btn-light btn-sm" href="/books">
            <?= __('home.hero.cta.books') ?>
          </a>
        </div>

      </div>
    </div>
  </nav>
    </div>
  </div>
</header>
