# Kódolt Erő – Hivatalos weboldal

> **LEGO animációs sorozat** — 1. évad, 3 részes történet
> Készítő: **Zynox Studio**

🌐 **Élő weboldal:** https://kovrat12345678.github.io/kodolt-ero/

---

## A sorozatról

Egy 15 éves fiú, **Zynox**, otthon kódolt mesterséges intelligenciát.
Egy baleset után megkapta a **tech erejét** – képes irányítani a kódot
és a digitális világot. De a baleset létrehozta sötét hasonmását, **Nexort** is…

### Epizódok

| # | Cím | Premier |
|---|---|---|
| E01 | A Sötét Program | 2026.06.30 |
| E02 | A Fertőzés | 2026.07.31 |
| E03 | Az Árnyék Kódja | 2026.09.01 |

---

## Karakterek

- **ZYNOX** – Főszereplő, 15 éves zseni
- **ZYNOX – TECH NINJA** – harci forma
- **LUNA** – szövetséges
- **LUNA – TECH NINJA** – jövőbeli forma
- **NEXOR** – főgonosz, sötét hasonmás

Helyszín: **Techronica Neon City**

---

## A weboldal funkciói

- **Modern cyber design** neon effektekkel és animációkkal
- **Visszaszámláló** premierig
- **Karakter galéria** (5 karakter)
- **Előzetes oldal** (időzített megjelenés május 31-től)
- **Jegyrendszer** család számára:
  1. Vásárló beírja a nevét
  2. Készítő beírja a titkos kódot (fizetés után)
  3. Vásárló kap egyedi film-kódot (a névből generálva)
  4. Premier napján a film-kóddal nézhető a film
- **Mobil-kompatibilis** reszponzív design
- **"Szivárgott felvétel"** szekció – Nexor által kiszivárogtatott videók
- **Techronica Neon City** helyszín bemutatása
- **3 epizód** infói egy szekcióban

---

## Technológia

- **HTML5 / CSS3** – animációk, neon effektek
- **JavaScript (vanilla)** – jegykód generálás (SHA-256), visszaszámláló, videó vezérlés
- **Web Crypto API** – kódhash-elés
- **Nincs backend** – tisztán statikus, fut bárhol (GitHub Pages, Netlify, helyi szerver)
- Betűtípusok: **Orbitron** (cím), **Rajdhani** (szöveg)

---

## Fájlstruktúra

```
kodolt-ero/
├── index.html              # Főoldal
├── karakterek.html         # Karakterek
├── elozetes.html           # Előzetes
├── jegyek.html             # Jegyvásárlás
├── film.html               # Film + kód-ellenőrzés
├── config.js               # Konfiguráció (dátumok, ár, kód-hash)
├── site.js                 # Közös JS (header, footer, kódgen)
├── styles.css              # Minden stílus
├── favicon.svg             # Logó
├── karakter képek/         # Karakter PNG/JPEG fájlok
├── Techronica Neon City/   # Háttér képek
├── video/                  # Showcase videók (kiszivárgott)
├── elozetes/               # Előzetes videó (külön töltendő)
└── film/                   # Film fájl (külön töltendő)
```

---

## Helyi futtatás

A weboldal **statikus**, így bármilyen webszerverrel működik:

### XAMPP (Windows)
1. Másold a mappát ide: `C:\xampp\htdocs\Zynox film\`
2. Indítsd az Apache-t XAMPP Control Panel-ből
3. Nyisd meg: `http://localhost/Zynox film/`

### Python (gyors helyi szerver)
```bash
cd "kodolt-ero"
python -m http.server 8000
# → http://localhost:8000
```

### VS Code Live Server
1. Telepítsd a "Live Server" extension-t
2. Jobb klikk az `index.html`-en → "Open with Live Server"

---

## Beállítások (config.js)

```javascript
const CONFIG = {
    PREMIER:  '2026-06-30T19:00:00',  // E01 premier
    ELOZETES: '2026-05-31T19:00:00',  // Előzetes
    EP2:      '2026-07-31T19:00:00',  // E02 premier
    EP3:      '2026-09-01T19:00:00',  // E03 premier
    AR: 500,                            // Jegy ára (Ft)
    SECRET_HASH: 'bbe04e1...',          // Titkos kód SHA-256 hash
    SALT: 'ZYNOX_SECRET_SALT_2026'      // Film-kód só (NE változtasd!)
};
```

### Titkos kód módosítása
1. Generálj új SHA-256 hash-t: https://emn178.github.io/online-tools/sha256.html
2. Cseréld le a `SECRET_HASH` értéket a `config.js`-ben
3. Pusholj: `git add config.js && git commit -m "Új titkos kód" && git push`

---

## Videók feltöltése

A `.gitignore` kizárja a videókat (méret miatt). Manuálisan töltsd fel:

- **Előzetes:** `elozetes/elozetes.mp4`
- **Film:** `film/film.mp4`
- **Showcase:** `video/video.mp4`, `video/video (1).mp4`

GitHub web felületen: nyisd meg a megfelelő mappát → "Add file" → "Upload files" → drag & drop.

⚠️ **Max 100 MB / fájl** GitHub-on. Nagyobb fájlokhoz használj YouTube embed-et vagy CDN-t.

---

## Licenc

Minden jog fenntartva © 2026 Zynox Studio

A LEGO® a LEGO Group bejegyzett védjegye.
