<?php
$aktualisOldal = 'jegyek';
require_once __DIR__ . '/includes/header.php';

$uzenet = '';
$uzenetTipus = '';
$generaltKod = null;
$lepes = $_SESSION['jegy_lepes'] ?? 1;
$nev = $_SESSION['jegy_nev'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nev_kuld'])) {
        $beirtNev = trim($_POST['nev'] ?? '');
        if (strlen($beirtNev) < 2) {
            $uzenet = 'Add meg a teljes nevedet (legalább 2 karakter).';
            $uzenetTipus = 'error';
        } else {
            $_SESSION['jegy_nev'] = $beirtNev;
            $_SESSION['jegy_lepes'] = 2;
            $lepes = 2;
            $nev = $beirtNev;
        }
    } elseif (isset($_POST['kod_kuld'])) {
        $beirtKod = trim($_POST['titkos_kod'] ?? '');
        $beirtNev = $_SESSION['jegy_nev'] ?? '';

        if ($beirtKod === $config['titkos_kod']) {
            $jegyek = getJegyek();
            $filmKod = generateFilmKod();

            $jegyek[] = [
                'nev' => $beirtNev,
                'film_kod' => $filmKod,
                'datum' => date('Y-m-d H:i:s'),
                'aktiv' => true,
            ];

            saveJegyek($jegyek);

            $_SESSION['jegy_lepes'] = 3;
            $_SESSION['jegy_film_kod'] = $filmKod;
            $generaltKod = $filmKod;
            $lepes = 3;
        } else {
            $uzenet = 'Hibás titkos kód! Kérd meg a film készítőjét, hogy írja be a kódot.';
            $uzenetTipus = 'error';
        }
    } elseif (isset($_POST['ujraIndit'])) {
        unset($_SESSION['jegy_lepes'], $_SESSION['jegy_nev'], $_SESSION['jegy_film_kod']);
        header('Location: jegyek.php');
        exit;
    }
}

if ($lepes === 3 && isset($_SESSION['jegy_film_kod'])) {
    $generaltKod = $_SESSION['jegy_film_kod'];
}
?>

<section class="hero" style="padding: 3rem 1rem;">
    <h1 class="hero-title" style="font-size: clamp(2.5rem, 7vw, 5rem);">JEGYVÁSÁRLÁS</h1>
    <p class="hero-subtitle">Csak családtagok számára</p>
</section>

<section class="section">
    <div class="jegyek-container">
        <div class="ticket-card">

            <div class="ticket-header">
                <h2 class="ticket-title">KÓDOLT ERŐ</h2>
                <p class="ticket-subtitle">1. évad – 1. rész: A Sötét Program</p>
            </div>

            <div class="ticket-info">
                <div class="info-item">
                    <span class="info-label">Premier</span>
                    <span class="info-value">2026.06.30</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Időtartam</span>
                    <span class="info-value">20 perc</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Helyszín</span>
                    <span class="info-value">Otthon</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Ár</span>
                    <span class="info-value price"><?= (int)$config['ar'] ?> Ft</span>
                </div>
            </div>

            <?php if ($uzenet): ?>
                <div class="alert alert-<?= htmlspecialchars($uzenetTipus) ?>">
                    <?= htmlspecialchars($uzenet) ?>
                </div>
            <?php endif; ?>

            <?php if ($lepes === 1): ?>

                <form method="POST">
                    <div class="form-group">
                        <label class="form-label" for="nev">Add meg a neved</label>
                        <input type="text" class="form-input" id="nev" name="nev"
                               placeholder="Pl: Kiss Anna" required minlength="2"
                               value="<?= htmlspecialchars($_POST['nev'] ?? '') ?>">
                    </div>
                    <button type="submit" name="nev_kuld" class="btn btn-primary btn-full">
                        Tovább &rarr;
                    </button>
                </form>

            <?php elseif ($lepes === 2): ?>

                <div class="alert alert-info">
                    <strong>Szia <?= htmlspecialchars($nev) ?>!</strong><br>
                    Most fizesd ki a <?= (int)$config['ar'] ?> forintot a film készítőjének.
                    Ezután ő beírja Neked a titkos kódot.
                </div>

                <form method="POST">
                    <div class="form-group">
                        <label class="form-label" for="titkos_kod">Titkos kód</label>
                        <input type="password" class="form-input" id="titkos_kod" name="titkos_kod"
                               placeholder="A készítő írja be" required autocomplete="off"
                               style="font-family: 'Orbitron', sans-serif; letter-spacing: 4px; text-align: center;">
                    </div>
                    <button type="submit" name="kod_kuld" class="btn btn-primary btn-full">
                        Jegy aktiválása
                    </button>
                </form>

                <form method="POST" style="margin-top: 1rem;">
                    <button type="submit" name="ujraIndit" class="btn btn-secondary btn-full">
                        Mégse / Új név
                    </button>
                </form>

            <?php elseif ($lepes === 3 && $generaltKod): ?>

                <div class="alert alert-success">
                    <strong>Sikeres jegyvásárlás!</strong><br>
                    <?= htmlspecialchars($nev) ?> – itt a Te film-kódod:
                </div>

                <div class="kod-display">
                    <div class="kod-label">A Te film-kódod</div>
                    <div class="kod" id="filmKod"><?= htmlspecialchars($generaltKod) ?></div>
                    <button type="button" class="btn btn-secondary" onclick="masolKod()">Másolás</button>
                    <p class="kod-info">
                        <strong>Őrizd meg ezt a kódot!</strong><br>
                        Június 30-án ezzel a kóddal nézheted meg a filmet a "Film" menüpont alatt.
                    </p>
                </div>

                <form method="POST">
                    <button type="submit" name="ujraIndit" class="btn btn-primary btn-full">
                        Új jegyvásárlás
                    </button>
                </form>

            <?php endif; ?>

        </div>
    </div>
</section>

<script>
function masolKod() {
    const kod = document.getElementById('filmKod').textContent.trim();
    navigator.clipboard.writeText(kod).then(() => {
        alert('Kód a vágólapra másolva: ' + kod);
    }).catch(() => {
        const textarea = document.createElement('textarea');
        textarea.value = kod;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        alert('Kód másolva: ' + kod);
    });
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
