<?php
$isFa = \Core\Lang::getLocale() === 'fa';
?>
<footer class="mt-5" style="background: var(--evergreen); color: rgba(255,255,255,.85);">
  <div class="container py-5">

    <div class="row g-4">

      <div class="col-12 col-lg-5" data-aos="fade-up" data-aos-duration="650">
        <div class="d-flex align-items-center gap-2 mb-3">
          <span class="rounded-3 p-2 d-inline-flex align-items-center justify-content-center">
            <img src="/assets/img/logo.png" alt="<?= __('site.title') ?>" width="34" height="34">
          </span>
          <div class="fw-semibold fs-5"><?= __('site.title') ?></div>
        </div>

        <div class="fw-semibold mb-2"><?= __('footer.about') ?></div>
        <p class="mb-3" style="color: rgba(255,255,255,.65);">
          <?= __('footer.about.desc') ?>
        </p>

        <div class="small" style="color: rgba(255,255,255,.65);">
          <?= __('site.copyright') ?> <span class="fw-semibold text-white"><?= __('site.developer') ?></span>
        </div>
      </div>

      <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="80" data-aos-duration="650">
        <div class="fw-semibold mb-3"><?= __('footer.links') ?></div>
        <ul class="list-unstyled d-grid gap-2 m-0">
          <li><a class="link-light text-decoration-none" href="/"><?= __('nav.home') ?></a></li>
          <li><a class="link-light text-decoration-none" href="/books"><?= __('nav.books') ?></a></li>
          <li><a class="link-light text-decoration-none" href="/about"><?= __('nav.about') ?></a></li>
          <li><a class="link-light text-decoration-none" href="/contact"><?= __('nav.contact') ?></a></li>
          <li><a class="link-light text-decoration-none" href="/developer"><?= __('nav.developer') ?></a></li>
        </ul>
      </div>

      <div class="col-6 col-lg-4" data-aos="fade-up" data-aos-delay="160" data-aos-duration="650">
        <div class="fw-semibold mb-3"><?= __('footer.contact') ?></div>

        <div class="d-grid gap-2">
          <div class="small" style="color: rgba(255,255,255,.65);">
            <span class="fw-semibold text-white"><?= __('footer.contact.email') ?>:</span>
            <span>mohammadtahaabdinasab@outlook.com</span>
          </div>

          <div class="small" style="color: rgba(255,255,255,.65);">
            <span class="fw-semibold text-white"><?= __('footer.contact.location') ?>:</span>
            <span>Iran, Kerman</span>
          </div>

          <div class="mt-2">
            <button id="footerPing" class="btn btn-outline-light btn-sm">
              <?= __('footer.status') ?>
            </button>
            <span id="footerPingText" class="ms-2 small" style="color: rgba(255,255,255,.75);"></span>
          </div>
        </div>
      </div>

    </div>

    <hr class="my-4" style="border-color: rgba(255,255,255,.12);">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2" data-aos="fade-up" data-aos-delay="120">
      <div class="small" style="color: rgba(255,255,255,.65);">
        © <?= date('Y') ?> <?= __('site.title') ?> • <?= __('footer.rights') ?>
      </div>

      <div class="small" style="color: rgba(255,255,255,.65);">
        <?= __('home.footer.note') ?>
      </div>
    </div>
  </div>
</footer>

<script>
(function(){
  const TOKEN = "local_xxxxxxxx";
  const btn = document.getElementById('footerPing');
  const text = document.getElementById('footerPingText');

  async function ping(){
    if (!btn || !text) return;
    text.textContent = '...';
    try {
      const res = await fetch('/api/ping', { headers: { 'Authorization': 'Bearer ' + TOKEN }});
      const json = await res.json();
      text.textContent = (json && json.status === 'success') ? 'OK' : 'FAIL';
    } catch (e) {
      text.textContent = 'FAIL';
    }
  }

  btn?.addEventListener('click', ping);
})();
</script>

<script src="/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/aos/aos.js"></script>
<script>
  AOS.init({
    once: true,
    duration: 700,
    easing: 'ease-out-cubic',
  });
</script>
