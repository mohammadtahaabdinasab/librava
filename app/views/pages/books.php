<?php
ob_start();
$isFa = \Core\Lang::getLocale() === 'fa';
$in = $isFa ? 'fade-left' : 'fade-right';
?>

<section class="py-4">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-2 mb-3">
    <div data-aos="<?= $in ?>" data-aos-duration="650">
      <h1 class="fw-bold m-0"><?= __('books.title') ?></h1>
      <div class="text-muted"><?= __('books.subtitle') ?></div>
    </div>

    <div class="d-flex gap-2" data-aos="fade-up" data-aos-delay="100">
      <input id="q" class="form-control" style="min-width: 240px;" placeholder="<?= __('books.search') ?>">
      <button id="btnSearch" class="btn btn-success"><?= __('books.filter') ?></button>
      <button id="btnReset" class="btn btn-outline-success"><?= __('books.reset') ?></button>
    </div>
  </div>

  <div id="booksAlert" class="alert alert-info d-none" data-aos="fade-up"></div>

<div id="booksSkeleton" class="row g-3">
  <?php for ($i=0; $i<6; $i++): ?>
    <div class="col-12 col-sm-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 rounded-4">
        <div class="card-body">
          <div class="sk sk-title mb-3"></div>
          <div class="sk sk-line mb-2"></div>
          <div class="sk sk-line w-50"></div>
        </div>
      </div>
    </div>
  <?php endfor; ?>
</div>


  <div id="booksGrid" class="row g-3"></div>

  <div class="d-flex justify-content-between align-items-center mt-4" data-aos="fade-up">
    <button id="prevBtn" class="btn btn-outline-success"><?= __('books.pagination.prev') ?></button>
    <div class="small text-muted" id="pageInfo">—</div>
    <button id="nextBtn" class="btn btn-outline-success"><?= __('books.pagination.next') ?></button>
  </div>
</section>

<script>
(function(){
  const TOKEN = "local_xxxxxxxx";

  const grid = document.getElementById('booksGrid');
  const sk = document.getElementById('booksSkeleton');
  const alertBox = document.getElementById('booksAlert');
  const qInput = document.getElementById('q');

  const btnSearch = document.getElementById('btnSearch');
  const btnReset = document.getElementById('btnReset');

  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const pageInfo = document.getElementById('pageInfo');

  let page = 1;
  const perPage = 12;
  let lastPage = 1;

  function show(type, msg){
    alertBox.className = 'alert alert-' + type;
    alertBox.textContent = msg;
    alertBox.classList.remove('d-none');
  }

  function hideAlert(){ alertBox.classList.add('d-none'); }

  function escapeHtml(s) {
    return String(s).replace(/[&<>"']/g, (c) => ({
      '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'
    })[c]);
  }

  async function load(){
    hideAlert();
    grid.innerHTML = '';
    pageInfo.textContent = '...';
    sk.classList.remove('d-none');

    const url = new URL('/api/books', window.location.origin);
    url.searchParams.set('page', String(page));
    url.searchParams.set('per_page', String(perPage));
    const q = qInput.value.trim();
    if (q) url.searchParams.set('search', q);

    let json = null;
    try {
      const res = await fetch(url, { headers: { 'Authorization': 'Bearer ' + TOKEN }});
      json = await res.json();
    } catch (e) {
      json = null;
    }

    sk.classList.add('d-none');

    if (!json || json.status !== 'success') {
      show('warning', "<?= addslashes(__('books.error')) ?>");
      pageInfo.textContent = '—';
      if (window.AOS) AOS.refresh();
      return;
    }

    lastPage = json.meta?.last_page ?? 1;
    page = json.meta?.page ?? page;

    const items = json.data || [];
    if (!items.length) {
      show('info', "<?= addslashes(__('books.empty')) ?>");
    }

    for (let i = 0; i < items.length; i++) {
      const b = items[i];
      const col = document.createElement('div');
      col.className = 'col-12 col-sm-6 col-lg-4';
      col.setAttribute('data-aos', 'fade-up');
      col.setAttribute('data-aos-delay', String(60 * i));

      const statusText = (b.available == 1)
        ? "<?= addslashes(__('books.status.available')) ?>"
        : "<?= addslashes(__('books.status.borrowed')) ?>";

      col.innerHTML = `
        <div class="card h-100 shadow-sm border-0 rounded-4">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start gap-2">
              <a class="card-title m-0 fw-semibold text-decoration-none" href="/books/${b.id}">
                ${escapeHtml(b.title)}
              </a>
              <span class="badge ${b.available == 1 ? 'bg-success' : 'bg-secondary'}">${statusText}</span>
            </div>
            <div class="text-muted mt-2 small">${escapeHtml(b.author ?? '-')}</div>
            <div class="text-muted small mt-1">${b.published_year ?? '-'}</div>
          </div>
        </div>
      `;
      grid.appendChild(col);
    }

    prevBtn.disabled = page <= 1;
    nextBtn.disabled = page >= lastPage;
    pageInfo.textContent = `${page} / ${lastPage}`;

    if (window.AOS) AOS.refresh();
  }

  btnSearch.addEventListener('click', () => { page = 1; load(); });
  btnReset.addEventListener('click', () => { qInput.value = ''; page = 1; load(); });

  qInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') { page = 1; load(); }
  });

  prevBtn.addEventListener('click', () => { if (page > 1) { page--; load(); }});
  nextBtn.addEventListener('click', () => { if (page < lastPage) { page++; load(); }});

  load();
})();
</script>


<?php
$content = ob_get_clean();
require BASE_PATH . '/app/views/layouts/main.php';
