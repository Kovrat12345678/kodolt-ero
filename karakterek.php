<?php
$aktualisOldal = 'karakterek';
require_once __DIR__ . '/includes/header.php';

$kepMappa = 'karakter%20k%C3%A9pek';

$karakterek = [
    [
        'nev' => 'ZYNOX',
        'tipus' => 'hero',
        'role' => 'Főszereplő',
        'kep' => $kepMappa . '/Zynox.jpeg',
        'leiras' => 'Egy 15 éves zseni, aki otthon kódolt mesterséges intelligenciát. Egy baleset után megkapta a tech erejét – képes irányítani a kódot és a digitális világot.',
    ],
    [
        'nev' => 'ZYNOX – TECH NINJA',
        'tipus' => 'hero',
        'role' => 'Harci forma',
        'kep' => $kepMappa . '/zynox%20tech%20ruh%C3%A1ja.jpeg',
        'leiras' => 'Zynox harci ruhája, amit aktivál, amikor használnia kell az erejét. Sebezhetetlen pajzs és energiafegyverek – a digitális ninja.',
    ],
    [
        'nev' => 'LUNA',
        'tipus' => 'neutral',
        'role' => 'Szövetséges',
        'kep' => $kepMappa . '/Luna.jpeg',
        'leiras' => 'Zynox barátja, aki később csatlakozik a csapathoz. Még nincs ereje – egyelőre… A sors azonban mást tartogat számára.',
    ],
    [
        'nev' => 'LUNA – TECH NINJA',
        'tipus' => 'neutral',
        'role' => 'Jövőbeli forma',
        'kep' => $kepMappa . '/Luna%20tech%20ruh%C3%A1ja.jpeg',
        'leiras' => 'Luna jövőbeli ninja formája – egy előre vetített kép, amikor majd ő is felfedezi az erejét. Vajon mi vár rá a következő részekben?',
    ],
    [
        'nev' => 'NEXOR',
        'tipus' => 'evil',
        'role' => 'Főgonosz',
        'kep' => $kepMappa . '/Photoroom_20260416_185626.jpeg',
        'leiras' => 'Zynox sötét hasonmása, aki a baleset során keletkezett. A káosz és a bosszú programja – mindent meg akar semmisíteni, amit Zynox épített.',
    ],
];
?>

<section class="hero" style="padding: 3rem 1rem;">
    <h1 class="hero-title" style="font-size: clamp(2.5rem, 7vw, 5rem);">A KARAKTEREK</h1>
    <p class="hero-subtitle">Ismerd meg a Kódolt Erő szereplőit</p>
</section>

<section class="section">
    <div class="karakter-grid">
        <?php foreach ($karakterek as $k): ?>
            <div class="karakter-card <?= htmlspecialchars($k['tipus']) ?>">
                <div class="karakter-img-wrap">
                    <img src="<?= $k['kep'] ?>" alt="<?= htmlspecialchars($k['nev']) ?>" loading="lazy">
                </div>
                <div class="karakter-info">
                    <h3 class="karakter-name"><?= htmlspecialchars($k['nev']) ?></h3>
                    <span class="karakter-role"><?= htmlspecialchars($k['role']) ?></span>
                    <p class="karakter-desc"><?= htmlspecialchars($k['leiras']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
