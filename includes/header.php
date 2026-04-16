<?php
require_once __DIR__ . '/functions.php';
$config = getConfig();
$aktualisOldal = $aktualisOldal ?? '';
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kódolt Erő – A sötét Program | Zynox</title>
    <link rel="icon" type="image/svg+xml" href="/Zynox%20film/favicon.svg">
    <link rel="apple-touch-icon" href="/Zynox%20film/favicon.svg">
    <meta name="theme-color" content="#0a0a14">
    <link rel="stylesheet" href="/Zynox%20film/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="cyber-bg"></div>
    <div class="grid-overlay"></div>

    <header class="main-header">
        <nav class="nav-container">
            <a href="/Zynox%20film/" class="logo">
                <span class="logo-text">KÓDOLT</span>
                <span class="logo-accent">ERŐ</span>
            </a>
            <ul class="nav-links">
                <li><a href="/Zynox%20film/" class="<?= $aktualisOldal === 'home' ? 'active' : '' ?>">Főoldal</a></li>
                <li><a href="/Zynox%20film/karakterek.php" class="<?= $aktualisOldal === 'karakterek' ? 'active' : '' ?>">Karakterek</a></li>
                <li><a href="/Zynox%20film/elozetes.php" class="<?= $aktualisOldal === 'elozetes' ? 'active' : '' ?>">Előzetes</a></li>
                <li><a href="/Zynox%20film/jegyek.php" class="<?= $aktualisOldal === 'jegyek' ? 'active' : '' ?>">Jegyvásárlás</a></li>
                <li><a href="/Zynox%20film/film.php" class="<?= $aktualisOldal === 'film' ? 'active' : '' ?>">Film</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
