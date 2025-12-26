<?php
ob_start();
$isFa = \Core\Lang::getLocale() === 'fa';
$in = $isFa ? 'fade-left' : 'fade-right';
?>

<section class="py-4">
  <div class="mb-4" data-aos="<?= $in ?>" data-aos-duration="650">
    <h1 class="fw-bold m-0"><?= __('contact.title') ?></h1>
    <div class="text-muted"><?= __('contact.subtitle') ?></div>
  </div>

  <div class="row g-3">
    <div class="col-12 col-lg-7" data-aos="fade-up">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
          <form onsubmit="return false;">
            <div class="row g-3">
              <div class="col-12 col-md-6">
                <label class="form-label"><?= __('contact.form.name') ?></label>
                <input class="form-control" placeholder="<?= __('contact.form.name') ?>">
              </div>

              <div class="col-12 col-md-6">
                <label class="form-label"><?= __('contact.form.email') ?></label>
                <input class="form-control" placeholder="<?= __('contact.form.email') ?>">
              </div>

              <div class="col-12">
                <label class="form-label"><?= __('contact.form.subject') ?></label>
                <input class="form-control" placeholder="<?= __('contact.form.subject') ?>">
              </div>

              <div class="col-12">
                <label class="form-label"><?= __('contact.form.message') ?></label>
                <textarea class="form-control" rows="5" placeholder="<?= __('contact.form.message') ?>"></textarea>
              </div>

              <div class="col-12 d-flex gap-2">
                <button class="btn btn-success" type="submit"><?= __('contact.form.send') ?></button>
                <!-- <span class="text-muted small align-self-center"><?= __('contact.note') ?></span> -->
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-5" data-aos="fade-up" data-aos-delay="120">
      <div class="p-4 rounded-4 shadow-sm text-white"
           style="background: linear-gradient(135deg, var(--pine-teal), var(--dark-emerald));">
        <div class="fw-semibold mb-2"><?= __('footer.contact') ?></div>
        <div class="small" style="opacity:.85;">
          <div class="mb-2"><span class="fw-semibold text-white"><?= __('footer.contact.email') ?>:</span> mohammadtahaabdinasab@outlook.com</div>
          <div><span class="fw-semibold text-white"><?= __('footer.contact.location') ?>:</span> Iran, Kerman</div>
        </div>

        <div class="mt-3">
          <a class="btn btn-light btn-sm" href="/developer"><?= __('nav.developer') ?></a>
          <a class="btn btn-outline-light btn-sm" href="/books"><?= __('nav.books') ?></a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
require BASE_PATH . '/app/views/layouts/main.php';
