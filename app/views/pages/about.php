<?php
ob_start();
$isFa = \Core\Lang::getLocale() === 'fa';
$in = $isFa ? 'fade-left' : 'fade-right';
?>

<section class="py-4">
  <div class="mb-4" data-aos="<?= $in ?>" data-aos-duration="650">
    <h1 class="fw-bold m-0"><?= __('about.title') ?></h1>
    <div class="text-muted"><?= __('about.subtitle') ?></div>
  </div>

  <div class="row g-3">
    <div class="col-12 col-lg-4" data-aos="fade-up">
      <div class="card h-100 shadow-sm border-0 rounded-4">
        <div class="card-body">
          <div class="fw-semibold mb-2"><?= __('about.card1.title') ?></div>
          <div class="text-muted small"><?= __('about.card1.desc') ?></div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-4" data-aos="fade-up" data-aos-delay="80">
      <div class="card h-100 shadow-sm border-0 rounded-4">
        <div class="card-body">
          <div class="fw-semibold mb-2"><?= __('about.card2.title') ?></div>
          <div class="text-muted small"><?= __('about.card2.desc') ?></div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-4" data-aos="fade-up" data-aos-delay="160">
      <div class="card h-100 shadow-sm border-0 rounded-4">
        <div class="card-body">
          <div class="fw-semibold mb-2"><?= __('about.card3.title') ?></div>
          <div class="text-muted small"><?= __('about.card3.desc') ?></div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
require BASE_PATH . '/app/views/layouts/main.php';
