<?php
ob_start();

$bookId = (int)($book_id ?? 0);
$isFa = \Core\Lang::getLocale() === 'fa';
$in = $isFa ? 'fade-left' : 'fade-right';
?>

<section class="py-4">
  <div class="d-flex justify-content-between align-items-center mb-3" data-aos="<?= $in ?>" data-aos-duration="650">
    <div>
      <h1 class="fw-bold m-0" id="titleText"><?= __('book.details.title') ?></h1>
      <div class="text-muted"><?= __('book.details.subtitle') ?></div>
    </div>
    <a class="btn btn-outline-success" href="/books"><?= __('book.back') ?></a>
  </div>

  <div id="detailSkeleton" class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">
      <div class="sk sk-title mb-3"></div>
      <div class="sk sk-line mb-2"></div>
      <div class="sk sk-line mb-2"></div>
      <div class="sk sk-line mb-2"></div>
      <div class="sk sk-line w-50"></div>

      <div class="mt-4 d-flex gap-2">
        <div class="sk sk-btn"></div>
        <div class="sk sk-btn"></div>
      </div>
    </div>
  </div>

  <div id="detailAlert" class="alert alert-warning d-none mt-3"></div>

  <div id="detailCard" class="card shadow-sm border-0 rounded-4 d-none" data-aos="fade-up">
    <div class="card-body p-4">
      <div class="d-flex justify-content-between align-items-start gap-2">
        <div>
          <h2 class="fw-bold m-0" id="bookTitle">—</h2>
          <div class="text-muted mt-2" id="bookAuthor">—</div>
        </div>
        <span class="badge" id="bookStatus">—</span>
      </div>

      <hr class="my-4">

      <div class="row g-3">
        <div class="col-12 col-md-4">
          <div class="small text-muted"><?= __('book.fields.year') ?></div>
          <div class="fw-semibold" id="bookYear">—</div>
        </div>
        <div class="col-12 col-md-4">
          <div class="small text-muted"><?= __('book.fields.created') ?></div>
          <div class="fw-semibold" id="bookCreated">—</div>
        </div>
        <div class="col-12 col-md-4">
          <div class="small text-muted"><?= __('book.fields.id') ?></div>
          <div class="fw-semibold" id="bookId">—</div>
        </div>
      </div>

      <div class="mt-4 d-flex flex-column flex-sm-row gap-2">
        <a class="btn btn-success" href="/books"><?= __('book.more') ?></a>
        <button class="btn btn-outline-success" id="btnPing"><?= __('book.ping') ?></button>
        <span class="small text-muted align-self-center" id="pingText"></span>
      </div>
    </div>
  </div>
</section>

<script>
(function(){
  const TOKEN = "local_xxxxxxxx";
  const bookId = <?= (int)$bookId ?>;

  const sk = document.getElementById('detailSkeleton');
  const alertBox = document.getElementById('detailAlert');
  const card = document.getElementById('detailCard');

  const bookTitle = document.getElementById('bookTitle');
  const bookAuthor = document.getElementById('bookAuthor');
  const bookYear = document.getElementById('bookYear');
  const bookCreated = document.getElementById('bookCreated');
  const bookIdEl = document.getElementById('bookId');
  const statusEl = document.getElementById('bookStatus');

  const btnPing = document.getElementById('btnPing');
  const pingText = document.getElementById('pingText');

  function showError(msg){
    alertBox.textContent = msg;
    alertBox.classList.remove('d-none');
  }

  function escapeHtml(s) {
    return String(s).replace(/[&<>"']/g, (c) => ({
      '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'
    })[c]);
  }

  async function load(){
    if (!bookId || bookId <= 0) {
      sk.classList.add('d-none');
      showError("<?= addslashes(__('book.details.invalid')) ?>");
      return;
    }

    try {
      const res = await fetch(`/api/books/${bookId}`, {
        headers: { 'Authorization': 'Bearer ' + TOKEN }
      });
      const json = await res.json();

      if (!json || json.status !== 'success') {
        sk.classList.add('d-none');
        showError(json?.message || "<?= addslashes(__('book.details.not_found')) ?>");
        return;
      }

      const b = json.data;

      bookTitle.textContent = b.title ?? '—';
      bookAuthor.textContent = b.author ?? '—';
      bookYear.textContent = b.published_year ?? '—';
      bookCreated.textContent = b.created_at ?? '—';
      bookIdEl.textContent = String(b.id ?? bookId);

      if (b.available == 1) {
        statusEl.className = 'badge bg-success';
        statusEl.textContent = "<?= addslashes(__('books.status.available')) ?>";
      } else {
        statusEl.className = 'badge bg-secondary';
        statusEl.textContent = "<?= addslashes(__('books.status.borrowed')) ?>";
      }

      sk.classList.add('d-none');
      card.classList.remove('d-none');

      if (window.AOS) AOS.refresh();
    } catch (e) {
      sk.classList.add('d-none');
      showError("<?= addslashes(__('book.details.error')) ?>");
    }
  }

  btnPing?.addEventListener('click', async () => {
    pingText.textContent = '...';
    try {
      const res = await fetch('/api/ping', { headers: { 'Authorization': 'Bearer ' + TOKEN }});
      const json = await res.json();
      pingText.textContent = (json && json.status === 'success') ? 'OK' : 'FAIL';
    } catch (e) {
      pingText.textContent = 'FAIL';
    }
  });

  load();
})();
</script>

<?php
$content = ob_get_clean();
require BASE_PATH . '/app/views/layouts/main.php';
