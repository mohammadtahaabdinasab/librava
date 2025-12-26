<?php
ob_start();

$isFa = \Core\Lang::getLocale() === 'fa';
$heroIn = $isFa ? 'fade-left' : 'fade-right';
$sideIn = $isFa ? 'fade-right' : 'fade-left';
?>

<section class="py-4 py-md-5">
  <div class="row align-items-center g-4">
    <div class="col-12 col-lg-6" data-aos="<?= $heroIn ?>" data-aos-duration="750">
      <div class="p-4 p-md-5 rounded-4 shadow-sm bg-white">
        <h1 class="fw-bold mb-3" style="color: var(--evergreen);">
          <?= __('home.hero.title') ?>
        </h1>

        <p class="lead mb-4" style="color: rgba(0,0,0,.65);">
          <?= __('home.hero.subtitle') ?>
        </p>

        <div class="d-flex flex-column flex-sm-row gap-2" data-aos="fade-up" data-aos-delay="100">
          <a class="btn btn-success btn-lg" href="/books">
            <?= __('home.hero.cta.books') ?>
          </a>

          <button id="btnPing" class="btn btn-outline-success btn-lg" type="button">
            <?= __('home.hero.cta.api') ?>
          </button>
        </div>

        <div id="pingBox" class="mt-3 d-none"></div>
      </div>
    </div>

    <div class="col-12 col-lg-6" data-aos="<?= $sideIn ?>" data-aos-duration="750">
      <div class="p-4 p-md-5 rounded-4 shadow-sm text-white"
           style="background: linear-gradient(135deg, var(--pine-teal), var(--dark-emerald));">
        <div class="d-flex align-items-center gap-3 mb-4" data-aos="zoom-in" data-aos-delay="100">
          <div class="rounded-3 border border-white p-2">
            <img src="/assets/img/logo.png" alt="Librava" width="52" height="52">
          </div>
          <div>
            <div class="h4 m-0 fw-semibold"><?= __('site.title') ?></div>
            <div class="small" style="opacity:.85;"><?= __('home.footer.note') ?></div>
          </div>
        </div>

        <div class="row g-3" id="statsRow">
          <div class="col-6" data-aos="fade-up" data-aos-delay="150">
            <div class="rounded-4 p-3 bg-white text-dark shadow-sm">
              <div class="small text-muted"><?= __('home.stats.books') ?></div>
              <div class="h3 m-0 fw-bold" id="statBooks">—</div>
            </div>
          </div>

          <div class="col-6" data-aos="fade-up" data-aos-delay="200">
            <div class="rounded-4 p-3 bg-white text-dark shadow-sm">
              <div class="small text-muted"><?= __('home.stats.users') ?></div>
              <div class="h3 m-0 fw-bold" id="statUsers">—</div>
            </div>
          </div>

          <div class="col-6" data-aos="fade-up" data-aos-delay="250">
            <div class="rounded-4 p-3 bg-white text-dark shadow-sm">
              <div class="small text-muted"><?= __('home.stats.borrows') ?></div>
              <div class="h3 m-0 fw-bold" id="statBorrows">—</div>
            </div>
          </div>

          <div class="col-6" data-aos="fade-up" data-aos-delay="300">
            <div class="rounded-4 p-3 bg-white text-dark shadow-sm">
              <div class="small text-muted"><?= __('home.stats.active_borrows') ?></div>
              <div class="h3 m-0 fw-bold" id="statActive">—</div>
            </div>
          </div>
        </div>

        <div class="mt-4 small" style="opacity:.85;" data-aos="fade-up" data-aos-delay="350">
          <?= __('site.developer') ?> • <?= date('Y') ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="pb-4 pb-md-5" data-aos="fade-up">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-2 mb-3">
    <div>
      <h2 class="fw-bold m-0"><?= __('home.features.title') ?></h2>
      <div class="text-muted"><?= __('home.features.subtitle') ?></div>
    </div>
  </div>

  <div class="row g-3">
    <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
      <div class="card h-100 shadow-sm border-0 rounded-4">
        <div class="card-body">
          <div class="fw-semibold mb-2"><?= __('home.features.mvc.title') ?></div>
          <div class="text-muted small"><?= __('home.features.mvc.desc') ?></div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="80">
      <div class="card h-100 shadow-sm border-0 rounded-4">
        <div class="card-body">
          <div class="fw-semibold mb-2"><?= __('home.features.api.title') ?></div>
          <div class="text-muted small"><?= __('home.features.api.desc') ?></div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="160">
      <div class="card h-100 shadow-sm border-0 rounded-4">
        <div class="card-body">
          <div class="fw-semibold mb-2"><?= __('home.features.sec.title') ?></div>
          <div class="text-muted small"><?= __('home.features.sec.desc') ?></div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="240">
      <div class="card h-100 shadow-sm border-0 rounded-4">
        <div class="card-body">
          <div class="fw-semibold mb-2"><?= __('home.features.rtl.title') ?></div>
          <div class="text-muted small"><?= __('home.features.rtl.desc') ?></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="pb-5">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-2 mb-3" data-aos="fade-up">
    <div>
      <h2 class="fw-bold m-0"><?= __('home.latest.title') ?></h2>
      <div class="text-muted"><?= __('home.latest.subtitle') ?></div>
    </div>

    <a class="btn btn-outline-success" href="/books">
      <?= __('home.hero.cta.books') ?>
    </a>
  </div>

  <div id="booksAlert" class="alert alert-info d-none" data-aos="fade-up"></div>
  <div id="booksGrid" class="row g-3"></div>
</section>

<script>
(function () {
  const TOKEN = "local_xxxxxxxx";

  const pingBtn = document.getElementById('btnPing');
  const pingBox = document.getElementById('pingBox');

  const booksGrid = document.getElementById('booksGrid');
  const booksAlert = document.getElementById('booksAlert');

  const statBooks = document.getElementById('statBooks');
  const statUsers = document.getElementById('statUsers');
  const statBorrows = document.getElementById('statBorrows');
  const statActive = document.getElementById('statActive');

  function showPing(type, text) {
    pingBox.className = 'mt-3 alert alert-' + type;
    pingBox.textContent = text;
    pingBox.classList.remove('d-none');
    if (window.AOS) AOS.refresh();
  }

  async function apiGet(path) {
    const url = new URL(path, window.location.origin);
    const res = await fetch(url, { headers: { 'Authorization': 'Bearer ' + TOKEN } });
    const json = await res.json();
    return { res, json };
  }

  async function loadLatestBooks() {
    booksAlert.classList.add('d-none');
    booksGrid.innerHTML = '';

    const url = new URL('/api/books', window.location.origin);
    url.searchParams.set('page', '1');
    url.searchParams.set('per_page', '6');

    let json = null;
    try {
      const res = await fetch(url, { headers: { 'Authorization': 'Bearer ' + TOKEN } });
      json = await res.json();
    } catch (e) {
      json = null;
    }

    if (!json || json.status !== 'success') {
      booksAlert.textContent = "<?= addslashes(__('home.latest.error')) ?>";
      booksAlert.className = 'alert alert-warning';
      booksAlert.classList.remove('d-none');
      if (window.AOS) AOS.refresh();
      return;
    }

    if (!json.data || json.data.length === 0) {
      booksAlert.textContent = "<?= addslashes(__('home.latest.empty')) ?>";
      booksAlert.className = 'alert alert-info';
      booksAlert.classList.remove('d-none');
      if (window.AOS) AOS.refresh();
      return;
    }

    for (let i = 0; i < json.data.length; i++) {
      const b = json.data[i];
      const col = document.createElement('div');
      col.className = 'col-12 col-sm-6 col-lg-4';

      col.setAttribute('data-aos', 'fade-up');
      col.setAttribute('data-aos-delay', String(80 * i));

      col.innerHTML = `
        <div class="card h-100 shadow-sm border-0 rounded-4">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start gap-2">
              <h5 class="card-title m-0">${escapeHtml(b.title)}</h5>
              <span class="badge ${b.available == 1 ? 'bg-success' : 'bg-secondary'}">
                ${b.available == 1 ? 'OK' : 'OUT'}
              </span>
            </div>
            <div class="text-muted mt-2 small">${escapeHtml(b.author ?? '-')}</div>
            <div class="text-muted small mt-1">${b.published_year ?? '-'}</div>
          </div>
        </div>
      `;
      booksGrid.appendChild(col);
    }

    statBooks.textContent = String(json.meta?.total ?? json.data.length);

    if (window.AOS) AOS.refresh();
  }

  async function loadStats() {
    try {
      const [{json: books}, {json: borrows}] = await Promise.all([
        apiGet('/api/books?page=1&per_page=1'),
        apiGet('/api/borrows?page=1&per_page=1'),
      ]);

      if (books?.status === 'success') statBooks.textContent = String(books.meta?.total ?? '—');
      if (borrows?.status === 'success') statBorrows.textContent = String(borrows.meta?.total ?? '—');

      statUsers.textContent = '—';

      const {json: active} = await apiGet('/api/borrows?page=1&per_page=50');
      if (active?.status === 'success') {
        const cnt = (active.data || []).filter(x => x.returned_at === null).length;
        statActive.textContent = String(cnt);
      } else {
        statActive.textContent = '—';
      }

      if (window.AOS) AOS.refresh();
    } catch (e) {
      statBooks.textContent = '—';
      statUsers.textContent = '—';
      statBorrows.textContent = '—';
      statActive.textContent = '—';
      if (window.AOS) AOS.refresh();
    }
  }

  pingBtn?.addEventListener('click', async () => {
    try {
      const {json} = await apiGet('/api/ping');
      if (json?.status === 'success') {
        showPing('success', "<?= addslashes(__('home.api.pong')) ?>");
      } else {
        showPing('warning', "<?= addslashes(__('home.api.fail')) ?>");
      }
    } catch (e) {
      showPing('warning', "<?= addslashes(__('home.api.fail')) ?>");
    }
  });

  function escapeHtml(s) {
    return String(s).replace(/[&<>"']/g, (c) => ({
      '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'
    })[c]);
  }

  loadLatestBooks();
  loadStats();
})();
</script>

<?php
$content = ob_get_clean();
require BASE_PATH . '/app/views/layouts/main.php';
