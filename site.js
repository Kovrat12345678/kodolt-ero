// === KÖZÖS JS ===

// SHA-256 hash készítés
async function sha256(text) {
    const buf = new TextEncoder().encode(text);
    const hash = await crypto.subtle.digest('SHA-256', buf);
    return Array.from(new Uint8Array(hash))
        .map(b => b.toString(16).padStart(2, '0'))
        .join('');
}

// Film-kód generálása névből (determinisztikus)
async function generateFilmKod(name) {
    const tisztaNev = name.toLowerCase().trim().replace(/\s+/g, ' ');
    const hash = await sha256(tisztaNev + CONFIG.SALT);
    return 'ZNX-' + hash.substring(0, 8).toUpperCase();
}

// Titkos kód ellenőrzése
async function verifyTitkos(input) {
    const hash = await sha256(input.trim());
    return hash === CONFIG.SECRET_HASH;
}

// Film-kód ellenőrzése
async function verifyFilmKod(name, code) {
    const expected = await generateFilmKod(name);
    return expected.toUpperCase() === code.toUpperCase().trim();
}

// Visszaszámláló
function visszaszamlal(target, ids) {
    const targetTime = new Date(target).getTime();

    function update() {
        const now = Date.now();
        const diff = targetTime - now;

        if (diff < 0) {
            ids.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = '0';
            });
            return false;
        }

        const napok = Math.floor(diff / 86400000);
        const orak = Math.floor((diff % 86400000) / 3600000);
        const percek = Math.floor((diff % 3600000) / 60000);
        const masodpercek = Math.floor((diff % 60000) / 1000);

        const set = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.textContent = val;
        };
        set(ids[0], napok);
        set(ids[1], orak);
        set(ids[2], percek);
        set(ids[3], masodpercek);
        return true;
    }

    update();
    setInterval(update, 1000);
}

// Dátum elérve?
function lejartE(target) {
    return Date.now() >= new Date(target).getTime();
}

// Dátum formázás magyar
function formatDatum(target) {
    const d = new Date(target);
    const pad = n => String(n).padStart(2, '0');
    return `${d.getFullYear()}. ${pad(d.getMonth() + 1)}. ${pad(d.getDate())}. – ${pad(d.getHours())}:${pad(d.getMinutes())}`;
}

// Header injektálás
function injectHeader(active) {
    const html = `
    <header class="main-header">
        <nav class="nav-container">
            <a href="index.html" class="logo">
                <span class="logo-text">KÓDOLT</span>
                <span class="logo-accent">ERŐ</span>
            </a>
            <ul class="nav-links">
                <li><a href="index.html" class="${active==='home'?'active':''}">Főoldal</a></li>
                <li><a href="karakterek.html" class="${active==='karakterek'?'active':''}">Karakterek</a></li>
                <li><a href="elozetes.html" class="${active==='elozetes'?'active':''}">Előzetes</a></li>
                <li><a href="jegyek.html" class="${active==='jegyek'?'active':''}">Jegyvásárlás</a></li>
                <li><a href="film.html" class="${active==='film'?'active':''}">Film</a></li>
            </ul>
        </nav>
    </header>`;
    document.getElementById('site-header').outerHTML = html;
}

// Footer injektálás
function injectFooter() {
    const html = `
    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-section">
                <h3>KÓDOLT ERŐ</h3>
                <p>1. évad – 1. rész: A sötét Program</p>
                <p>Egy LEGO animációs sorozat</p>
            </div>
            <div class="footer-section">
                <h4>Premier</h4>
                <p>2026. június 30.</p>
            </div>
            <div class="footer-section">
                <h4>Készítette</h4>
                <p>Zynox Studio</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Kódolt Erő. Minden jog fenntartva.</p>
        </div>
    </footer>`;
    document.getElementById('site-footer').outerHTML = html;
}

// Auto init header/footer ha van data-page
document.addEventListener('DOMContentLoaded', () => {
    const page = document.body.dataset.page || '';
    if (document.getElementById('site-header')) injectHeader(page);
    if (document.getElementById('site-footer')) injectFooter();
});
