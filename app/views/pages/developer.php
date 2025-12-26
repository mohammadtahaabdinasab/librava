<?php
ob_start();
$isFa = \Core\Lang::getLocale() === 'fa';
$in = $isFa ? 'fade-left' : 'fade-right';
?>

<section class="py-4">
  <div class="mb-4" data-aos="<?= $in ?>" data-aos-duration="650">
    <h1 class="fw-bold m-0"><?= __('developer.title') ?></h1>
    <div class="text-muted"><?= __('developer.subtitle') ?></div>
  </div>

  <div class="row g-3">
    <div class="col-12 col-lg-5" data-aos="fade-up">
      <div class="p-4 rounded-4 shadow-sm text-white"
           style="background: linear-gradient(135deg, var(--pine-teal), var(--dark-emerald));">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-4 border border-white">
            <img class="rounded-4" src="https://avatars.githubusercontent.com/u/188295997?v=4" alt="<?= __('site.title') ?>" width="96" height="96">
          </div>
          <div>
            <div class="h5 m-0 fw-semibold"><?= __('site.developer') ?></div>
            <div class="small" style="opacity:.85;">Computer Software Engineering student</div>
          </div>
        </div>

        <div class="mt-3 small" style="opacity:.85;">
          <?= __('developer.stack') ?>: <?= __('developer.stack.items') ?>
        </div>

        <div class="mt-3 d-flex gap-2 flex-wrap">
          <a class="btn btn-light btn-sm" target="_blank" href="https://github.com/mohammadtahaabdinasab">
            <?= __('developer.github') ?>
          </a>
          <a class="btn btn-outline-light btn-sm" target="_blank" href="https://github.com/mohammadtahaabdinasab/librava">
            <?= __('developer.repo') ?>
          </a>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-7" data-aos="fade-up" data-aos-delay="120">
      <div class="card h-100 shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
          <h5 class="fw-semibold mb-3"><?= __('site.title') ?> • Roadmap</h5>
          <div class="row g-3">
            <div class="col-12 col-md-6">
              <div class="p-3 rounded-4" style="background: rgba(0,0,0,.03);">
                <div class="fw-semibold mb-1">API</div>
                <div class="text-muted small">Books / Borrows / Auth (later)</div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="p-3 rounded-4" style="background: rgba(0,0,0,.03);">
                <div class="fw-semibold mb-1">Android</div>
                <div class="text-muted small">Admin panel via REST API</div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="p-3 rounded-4" style="background: rgba(0,0,0,.03);">
                <div class="fw-semibold mb-1">UI</div>
                <div class="text-muted small">RTL/LTR, responsive, AOS animations</div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="p-3 rounded-4" style="background: rgba(0,0,0,.03);">
                <div class="fw-semibold mb-1">Security</div>
                <div class="text-muted small">Prepared statements, validation</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
require BASE_PATH . '/app/views/layouts/main.php';
