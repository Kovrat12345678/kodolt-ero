<?php
$aktualisOldal = 'elozetes';
require_once __DIR__ . '/includes/header.php';

$visszaszam = visszaszamlalas($config['elozetes_datum']);
$elozetesElerheto = $visszaszam['lejart'];

$videoFile = null;
foreach (['mp4', 'webm', 'mov'] as $ext) {
    $path = __DIR__ . '/elozetes/elozetes.' . $ext;
    if (file_exists($path)) {
        $videoFile = 'elozetes/elozetes.' . $ext;
        break;
    }
}
?>

<section class="hero" style="padding: 3rem 1rem;">
    <h1 class="hero-title" style="font-size: clamp(2.5rem, 7vw, 5rem);">ELŐZETES</h1>
    <p class="hero-subtitle">Kódolt Erő – A Sötét Program</p>
</section>

<?php if (!$elozetesElerheto): ?>

    <section class="section">
        <div class="locked-content">
            <div class="locked-icon">[ ZÁROLVA ]</div>
            <h2 class="locked-title">Az előzetes hamarosan érkezik</h2>
            <p class="locked-text">
                Az előzetes <strong style="color: var(--neon-cyan);">2026. május 31-én</strong> jelenik meg.
            </p>

            <div class="countdown" id="countdown" data-target="<?= htmlspecialchars($config['elozetes_datum']) ?>">
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
        </div>
    </section>

<?php elseif ($videoFile): ?>

    <section class="section">
        <div class="video-container">
            <div class="video-wrapper">
                <video controls poster="">
                    <source src="<?= htmlspecialchars($videoFile) ?>" type="video/mp4">
                    A böngésződ nem támogatja a video lejátszást.
                </video>
            </div>
            <p style="text-align: center; margin-top: 2rem; color: var(--text-secondary);">
                Kíváncsi a teljes filmre? <a href="jegyek.php" style="color: var(--neon-cyan);">Vegyél jegyet most!</a>
            </p>
        </div>
    </section>

<?php else: ?>

    <section class="section">
        <div class="locked-content">
            <div class="locked-icon">[ ! ]</div>
            <h2 class="locked-title">Az előzetes elérhető!</h2>
            <p class="locked-text">
                Töltsd fel az előzetes videót az <code style="color: var(--neon-cyan); background: rgba(0,240,255,0.1); padding: 0.25rem 0.5rem; border-radius: 4px;">elozetes/</code> mappába
                <code style="color: var(--neon-cyan); background: rgba(0,240,255,0.1); padding: 0.25rem 0.5rem; border-radius: 4px;">elozetes.mp4</code> névvel.
            </p>
        </div>
    </section>

<?php endif; ?>

<script src="script.js"></script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
