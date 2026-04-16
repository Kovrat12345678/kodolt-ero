# Kódolt Erő – Hivatalos weboldal

> **LEGO animációs sorozat** — 1. évad, 3 részes történet
> Készítő: **Zynox Studio**

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
- **Karakter galéria**
- **Előzetes oldal** (időzített megjelenés)
- **Jegyrendszer** család számára:
  1. Vásárló beírja a nevét
  2. Készítő beírja a titkos kódot (fizetés után)
  3. Vásárló kap egyedi film-kódot
  4. Premier napján a film-kóddal nézhető a film
- **Admin felület** – jegyek, bevétel, kódok kezelése
- **Mobil-kompatibilis** reszponzív design
- **"Szivárgott felvétel"** szekció – Nexor által kiszivárogtatott videók

---

## Telepítés

### Követelmények
- **XAMPP** (Apache + PHP 8.x)

### Lépések

1. Klónozd a repót a `C:\xampp\htdocs\` mappába:
   ```bash
   git clone https://github.com/Kovrat12345678/kodolt-ero.git "Zynox film"
   ```

2. Másold a `data/config.example.json`-t `data/config.json`-ra és állítsd be:
   ```json
   {
       "titkos_kod": "VALAMI_TITKOS",
       "admin_jelszo": "ERŐS_JELSZÓ",
       "premier_datum": "2026-06-30T19:00:00",
       "elozetes_datum": "2026-05-31T19:00:00",
       "ar": 500
   }
   ```

3. Hozz létre üres jegyek fájlt:
   ```bash
   echo "[]" > data/jegyek.json
   ```

4. Indítsd el az XAMPP Apache-t és nyisd meg:
   ```
   http://localhost/Zynox film/
   ```

### Videók (külön kell pótolni)

A `.gitignore` kizárja a videókat (méret miatt). Töltsd be őket:
- Előzetes: `elozetes/elozetes.mp4`
- Film: `film/film.mp4`
- Showcase: `video/video.mp4`, `video/video (1).mp4`

---

## Technológia

- **PHP 8.x** – backend, jegyrendszer
- **HTML5 / CSS3** – animációk, neon effektek
- **JavaScript** (vanilla) – visszaszámláló, videó vezérlés
- **JSON fájl-tárolás** – jegyek és konfiguráció (nincs adatbázis)
- Betűtípusok: **Orbitron** (cím), **Rajdhani** (szöveg)

---

## Licenc

Minden jog fenntartva © 2026 Zynox Studio

A LEGO® a LEGO Group bejegyzett védjegye.
