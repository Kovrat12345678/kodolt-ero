<?php
$aktualisOldal = 'film';
require_once __DIR__ . '/includes/header.php';

$visszaszam = visszaszamlalas($config['premier_datum']);
$premier = $visszaszam['lejart'];

$uzenet = '';
$uzenetTipus = '';
$kodOk = false;
$jegytulajdonos = '';
$nezheto = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kod'])) {
    $beirtKod = strtoupper(trim($_POST['kod']));
    $jegyek = getJegyek();

    foreach ($jegyek as $j) {
        if ($j['film_kod'] === $beirtKod && !empty($j['aktiv'])) {
            $kodOk = true;
            $jegytulajdonos = $j['nev'];
            $_SESSION['film_kod_ok'] = $beirtKod;
            break;
        }
    }

    if (!$kodOk) {
        $uzenet = 'Hibás kód! Ellenőrizd, hogy pontosan írtad-e be.';
        $uzenetTipus = 'error';
    }
}

if (!$kodOk && isset($_SESSION['film_kod_ok'])) {
    $jegyek = getJegyek();
    foreach ($jegyek as $j) {
        if ($j['film_kod'] === $_SESSION['film_kod_ok'] && !empty($j['aktiv'])) {
            $kodOk = true;
            $jegytulajdonos = $j['nev'];
            break;
        }
    }
}

$nezheto = $kodOk && $premier;

$videoFile = null;
foreach (['mp4', 'webm', 'mov'] as $ext) {
    $path = __DIR__ . '/film/film.' . $ext;
    if (file_exists($path)) {
        $videoFile = 'film/film.' . $ext;
        break;
    }
}

$datumFormat = 'Y. F j. – H:i';
$premierStr = (new DateTime($config['premier_datum']))->format('Y. m. d. – H:i');
?>

<section class="hero" style="padding: 3rem 1rem;">
    <h1 class="hero-title" style="font-size: clamp(2.5rem, 7vw, 5rem);">A FILM</h1>
    <p class="hero-subtitle">Kódolt Erő – A Sötét Program</p>
    <p class="hero-episode">1. évad – 1. rész</p>
</section>

<?php if ($nezheto && $videoFile): ?>

    <section class="section">
        <div class="alert alert-success" style="max-width: 800px; margin: 0 auto 2rem;">
            <strong>Üdv, <?= htmlspecialchars($jegytulajdonos) ?>!</strong>
            Jó szórakozást a filmhez!
        </div>
        <div class="video-container">
            <div class="video-wrapper">
                <video controls autoplay>
                    <source src="<?= htmlspecialchars($videoFile) ?>" type="video/mp4">
                    A böngésződ nem támogatja a video lejátszást.
                </video>
            </div>
        </div>
    </section>

<?php elseif ($kodOk && !$premier): ?>

    <section class="section">
        <div class="locked-content">
            <div class="locked-icon">[ KÓD ELFOGADVA ]</div>
            <h2 class="locked-title">Üdv, <?= htmlspecialchars($jegytulajdonos) ?>!</h2>
            <p class="locked-text">
                A kódod <strong style="color: var(--neon-green);">érvényes</strong> –
                a film <strong style="color: var(--neon-cyan);"><?= htmlspecialchars($premierStr) ?></strong>
                időpontban válik elérhetővé. Akkor automatikusan megnézheted!
            </p>

            <div class="countdown" id="countdown" data-target="<?= htmlspecialchars($config['premier_datum']) ?>">
                <div class="countdown-item">
                    <span class="countdown-number" id="cd-days"><?= $visszaszam['napok'] ?></span>
                    <span class="countdown-label">Nap</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="cd-hours"><?= $visszaszam['orak'] ?></span>
                    <span class="countdown-label">Óra</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="cd-minutes"><?= $visszaszam['percek'] ?></span>
                    <span class="countdown-label">Perc</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="cd-seconds"><?= $visszaszam['masodpercek'] ?></span>
                    <span class="countdown-label">Másodperc</span>
                </div>
            </div>

            <p style="margin-top: 1.5rem; color: var(--text-muted);">
                A kódod megjegyezve – jelentkezés nélkül megtekintheted, ha eljön az idő.
            </p>
        </div>
    </section>

<?php elseif ($kodOk && !$videoFile): ?>

    <section class="section">
        <div class="locked-content">
            <div class="locked-icon">[ ! ]</div>
            <h2 class="locked-title">A kód érvényes</h2>
            <p class="locked-text">
                Üdv, <?= htmlspecialchars($jegytulajdonos) ?>!<br>
                A filmfájl még nincs feltöltve. Töltsd fel a
                <code style="color: var(--neon-cyan); background: rgba(0,240,255,0.1); padding: 0.25rem 0.5rem; border-radius: 4px;">film/film.mp4</code> helyre.
            </p>
        </div>
    </section>

<?php else: ?>

    <section class="section">
        <div class="jegyek-container">
            <div class="ticket-card">
                <div class="ticket-header">
                    <h2 class="ticket-title">FILM-KÓD</h2>
                    <p class="ticket-subtitle">Add meg a jegyvásárláskor kapott kódot</p>
                </div>

                <?php if (!$premier): ?>
                    <div class="alert alert-info" style="text-align: center;">
                        A film <strong><?= htmlspecialchars($premierStr) ?></strong> időpontban indul.<br>
                        Most már be tudod írni a kódodat – ellenőrizzük, és majd a premier napján megnézheted!
                    </div>
                <?php endif; ?>

                <?php if ($uzenet): ?>
                    <div class="alert alert-<?= htmlspecialchars($uzenetTipus) ?>">
                        <?= htmlspecialchars($uzenet) ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="form-group">
                        <label class="form-label" for="kod">Film-kód</label>
                        <input type="text" class="form-input" id="kod" name="kod"
                               placeholder="ZNX-XXXXXXXX" required
                               style="font-family: 'Orbitron', sans-serif; letter-spacing: 3px; text-align: center; text-transform: uppercase;"
                               maxlength="12">
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">
                        <?= $premier ? 'Megnézem a filmet' : 'Kód ellenőrzése' ?>
                    </button>
                </form>

                <p style="text-align: center; margin-top: 1.5rem; color: var(--text-secondary);">
                    Még nincs kódod? <a href="jegyek.php" style="color: var(--neon-cyan);">Vegyél jegyet!</a>
                </p>
            </div>
        </div>
    </section>

<?php endif; ?>

<script src="script.js"></script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
