<?php
$aktualisOldal = 'home';
require_once __DIR__ . '/includes/header.php';
$visszaszam = visszaszamlalas($config['premier_datum']);
?>

<section class="hero">
    <div class="hero-tag">LEGO ANIMÁCIÓS SOROZAT</div>
    <h1 class="hero-title" data-text="KÓDOLT ERŐ">KÓDOLT ERŐ</h1>
    <p class="hero-subtitle">1. évad – 1. rész</p>
    <p class="hero-episode">A Sötét Program</p>

    <div class="hero-buttons">
        <a href="jegyek.php" class="btn btn-primary">Jegyvásárlás</a>
        <a href="elozetes.php" class="btn btn-secondary">Előzetes</a>
    </div>
</section>

<section class="showcase-section leaked-mode">
    <div class="showcase-bg-glow"></div>
    <div class="showcase-particles">
        <span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span>
    </div>

    <div class="leaked-warning">
        <span class="warning-icon">⚠</span>
        <span class="warning-text">FIGYELEM · NEXOR ÁLTAL KISZIVÁROGTATVA</span>
        <span class="warning-icon">⚠</span>
    </div>

    <h2 class="showcase-title glitch-text" data-text="// NEXOR FELVÉTELEI //">
        // NEXOR FELVÉTELEI //
    </h2>
    <p class="showcase-sub">A sötét hasonmás feltörte a rendszert · Ezt akarja, hogy lásd</p>

    <div class="showcase-video-wrap">
        <div class="showcase-border leaked">
            <div class="showcase-corner tl"></div>
            <div class="showcase-corner tr"></div>
            <div class="showcase-corner bl"></div>
            <div class="showcase-corner br"></div>

            <div class="showcase-scanlines"></div>
            <div class="leaked-noise"></div>
            <div class="leaked-vignette"></div>

            <video class="showcase-video leaked" id="featuredVideo"
                   autoplay muted playsinline preload="metadata">
                <source src="video/video.mp4" type="video/mp4">
            </video>

            <div class="leaked-bars">
                <div class="leaked-bar top">
                    <div class="leaked-meta">
                        <span class="leaked-rec">● REC</span>
                        <span class="leaked-code" id="clipCode">CLIP-01</span>
                    </div>
                    <div class="leaked-meta">
                        <span class="leaked-class">CLASSIFIED</span>
                    </div>
                </div>
                <div class="leaked-bar bottom">
                    <span class="leaked-time" id="liveTime">--:--:--</span>
                    <span class="leaked-source">FELTÖLTŐ: <span class="nexor-tag">NEXOR</span></span>
                </div>
            </div>

            <div class="leaked-redact" style="top: 18%; left: 8%; width: 22%;"></div>
            <div class="leaked-redact" style="top: 72%; right: 10%; width: 18%;"></div>

            <div class="showcase-overlay" onclick="toggleShowcaseSound()">
                <div class="showcase-mute" id="muteIndicator">
                    <span>NÉMÍTVA · KATTINTS A HANGÉRT</span>
                </div>
            </div>
        </div>
    </div>

    <p class="leaked-footer">
        <span>// AUTO-PLAY · LOOP //</span>
        <span class="dot-sep">·</span>
        <span>2 KLIPP</span>
        <span class="dot-sep">·</span>
        <span class="nexor-tag">NEXOR-HACK</span>
    </p>

    <div class="nexor-signature">
        <span class="nexor-sig-bracket">[</span>
        <span class="nexor-sig-text">NEXOR_v1.0 // SYSTEM_BREACHED</span>
        <span class="nexor-sig-bracket">]</span>
    </div>
</section>

<script>
const showcasePlaylist = [
    { src: 'video/video.mp4',           code: 'CLIP-01' },
    { src: 'video/video%20%281%29.mp4', code: 'CLIP-02' }
];
let currentClip = 0;

const featuredVid  = document.getElementById('featuredVideo');
const clipCodeEl   = document.getElementById('clipCode');
const liveTimeEl   = document.getElementById('liveTime');
const muteIndicator = document.getElementById('muteIndicator');

featuredVid.addEventListener('ended', () => {
    currentClip = (currentClip + 1) % showcasePlaylist.length;
    loadClip(currentClip);
});

function loadClip(i) {
    const clip = showcasePlaylist[i];
    clipCodeEl.textContent = clip.code;
    featuredVid.querySelector('source').src = clip.src;
    featuredVid.load();
    featuredVid.play().catch(() => {});
}

function toggleShowcaseSound() {
    featuredVid.muted = !featuredVid.muted;
    muteIndicator.querySelector('span').textContent = featuredVid.muted
        ? 'NÉMÍTVA · KATTINTS A HANGÉRT'
        : 'HANG BE · KATTINTS A NÉMÍTÁSHOZ';
}

setInterval(() => {
    const d = new Date();
    const pad = n => String(n).padStart(2, '0');
    liveTimeEl.textContent = `${pad(d.getHours())}:${pad(d.getMinutes())}:${pad(d.getSeconds())}`;
}, 1000);
</script>

<section class="countdown-section">
    <h2 class="countdown-title">Premierig hátralévő idő</h2>
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
    <p style="margin-top: 1.5rem; color: var(--text-secondary); font-size: 1.1rem;">
        2026. június 30. – 19:00
    </p>
</section>

<section class="section">
    <h2 class="section-title">A Történet</h2>
    <div class="story-card">
        <p class="story-text">
            Egy 15 éves fiú, <strong>Zynox</strong>, otthon kódolt mesterséges intelligenciát
            és különböző tech projekteken dolgozott. Egy napon azonban valami szörnyű történt –
            a rendszere meghibásodott, és egy ismeretlen energia szállta meg.
        </p>
        <br>
        <p class="story-text">
            Így született meg a <strong>tech ereje</strong>, amellyel képes irányítani a kódot,
            az áramköröket és a digitális világot. De a baleset másvalamit is létrehozott…
            megjelent <span class="villain">Nexor</span>, Zynox sötét hasonmása,
            a bosszú és a káosz programja.
        </p>
        <br>
        <p class="story-text">
            Hamarosan csatlakozik hozzájuk <strong style="color: var(--neon-pink);">Luna</strong>,
            akinek egyelőre még nincs ereje – de a sors mást tartogat számára…
        </p>
    </div>
</section>

<section class="section">
    <h2 class="section-title">A Helyszín</h2>
    <div class="story-card" style="padding: 0; overflow: hidden;">
        <div class="city-showcase">
            <div class="city-image">
                <img src="Techronica%20Neon%20City/21A30887-2AAB-4BF8-B685-08157617EC4A.png"
                     alt="Techronica Neon City" loading="lazy">
            </div>
            <div class="city-content">
                <h3 class="city-title">TECHRONICA</h3>
                <p class="city-subtitle">— NEON CITY —</p>
                <p class="city-text">
                    A jövő városa, ahol a fény és a technológia összeolvad.
                    Itt él <strong>Zynox</strong>, és itt találkozik először
                    a <span style="color: var(--neon-purple);">sötét programmal</span>,
                    Nexorral. A neon utcákon hamarosan eldől, ki uralja a kódot.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <h2 class="section-title">1. Évad – Az epizódok</h2>
    <p style="text-align: center; color: var(--text-secondary); margin-top: -2rem; margin-bottom: 3rem; letter-spacing: 2px; text-transform: uppercase; font-size: 0.95rem;">
        3 részes történet · LEGO animáció
    </p>

    <div class="episode-list">
        <article class="episode-card available">
            <div class="episode-number">E01</div>
            <div class="episode-line"></div>
            <div class="episode-content">
                <span class="episode-status status-soon">PREMIER · 2026.06.30</span>
                <h3 class="episode-title">A Sötét Program</h3>
                <p class="episode-desc">
                    Zynox AI rendszere meghibásodik, és megjelenik a sötét hasonmás, Nexor.
                    A tech erő születésének kezdete.
                </p>
                <a href="jegyek.php" class="episode-link">Jegyvásárlás &rarr;</a>
            </div>
        </article>

        <article class="episode-card upcoming">
            <div class="episode-number">E02</div>
            <div class="episode-line"></div>
            <div class="episode-content">
                <span class="episode-status status-future">PREMIER · 2026.07.31</span>
                <h3 class="episode-title">A Fertőzés</h3>
                <p class="episode-desc">
                    Nexor terjedni kezd a hálózaton. Zynoxnak meg kell tanulnia uralni az erejét,
                    mielőtt egész Techronica fertőzötté válik.
                </p>
                <span class="episode-link disabled">Hamarosan &rarr;</span>
            </div>
        </article>

        <article class="episode-card upcoming">
            <div class="episode-number">E03</div>
            <div class="episode-line"></div>
            <div class="episode-content">
                <span class="episode-status status-future">PREMIER · 2026.09.01</span>
                <h3 class="episode-title">Az Árnyék Kódja</h3>
                <p class="episode-desc">
                    A leleplezés. Luna felfedezi a saját erejét, és felfedik a sötét program
                    végső titkát. Az évad döntő ütközete.
                </p>
                <span class="episode-link disabled">Hamarosan &rarr;</span>
            </div>
        </article>
    </div>
</section>

<section class="section">
    <h2 class="section-title">Fontos dátumok</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
        <div class="story-card" style="text-align: center;">
            <h3 style="font-family: 'Orbitron', sans-serif; color: var(--neon-purple); letter-spacing: 2px; margin-bottom: 1rem;">ELŐZETES</h3>
            <p style="font-size: 2rem; font-family: 'Orbitron', sans-serif; color: var(--neon-cyan); margin-bottom: 0.5rem;">Május 31.</p>
            <p style="color: var(--text-secondary);">Kiadás napja</p>
        </div>
        <div class="story-card" style="text-align: center;">
            <h3 style="font-family: 'Orbitron', sans-serif; color: var(--neon-cyan); letter-spacing: 2px; margin-bottom: 1rem;">PREMIER</h3>
            <p style="font-size: 2rem; font-family: 'Orbitron', sans-serif; color: var(--neon-cyan); margin-bottom: 0.5rem;">Június 30.</p>
            <p style="color: var(--text-secondary);">A film bemutatója</p>
        </div>
        <div class="story-card" style="text-align: center;">
            <h3 style="font-family: 'Orbitron', sans-serif; color: var(--neon-pink); letter-spacing: 2px; margin-bottom: 1rem;">HOSSZ</h3>
            <p style="font-size: 2rem; font-family: 'Orbitron', sans-serif; color: var(--neon-cyan); margin-bottom: 0.5rem;">20 perc</p>
            <p style="color: var(--text-secondary);">Az 1. rész időtartama</p>
        </div>
    </div>
</section>

<script src="script.js"></script>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
