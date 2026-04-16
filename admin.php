<?php
require_once __DIR__ . '/includes/functions.php';
$config = getConfig();

$uzenet = '';
$uzenetTipus = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['kijelentkezes'])) {
        unset($_SESSION['admin']);
        header('Location: admin.php');
        exit;
    }

    if (isset($_POST['login_jelszo'])) {
        if ($_POST['login_jelszo'] === $config['admin_jelszo']) {
            $_SESSION['admin'] = true;
            header('Location: admin.php');
            exit;
        } else {
            $uzenet = 'Hibás jelszó!';
            $uzenetTipus = 'error';
        }
    }

    if (isAdminLoggedIn()) {
        if (isset($_POST['kod_modositas'])) {
            $ujKod = trim($_POST['uj_titkos_kod'] ?? '');
            if (strlen($ujKod) >= 4) {
                $config['titkos_kod'] = $ujKod;
                saveConfig($config);
                $uzenet = 'Titkos kód módosítva: ' . htmlspecialchars($ujKod);
                $uzenetTipus = 'success';
            } else {
                $uzenet = 'A kódnak legalább 4 karakter hosszúnak kell lennie.';
                $uzenetTipus = 'error';
            }
        }

        if (isset($_POST['ar_modositas'])) {
            $ujAr = (int)($_POST['uj_ar'] ?? 0);
            if ($ujAr > 0) {
                $config['ar'] = $ujAr;
                saveConfig($config);
                $uzenet = 'Ár módosítva: ' . $ujAr . ' Ft';
                $uzenetTipus = 'success';
            }
        }

        if (isset($_POST['jegy_torles']) && isset($_POST['kod'])) {
            $jegyek = getJegyek();
            $jegyek = array_values(array_filter($jegyek, fn($j) => $j['film_kod'] !== $_POST['kod']));
            saveJegyek($jegyek);
            $uzenet = 'Jegy törölve.';
            $uzenetTipus = 'success';
        }

        if (isset($_POST['datum_modositas'])) {
            $ujPremier = $_POST['uj_premier'] ?? '';
            $ujElozetes = $_POST['uj_elozetes'] ?? '';
            if ($ujPremier && $ujElozetes) {
                $config['premier_datum'] = $ujPremier;
                $config['elozetes_datum'] = $ujElozetes;
                saveConfig($config);
                $uzenet = 'Dátumok módosítva.';
                $uzenetTipus = 'success';
            }
        }
    }
}

$config = getConfig();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Kódolt Erő</title>
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <meta name="theme-color" content="#0a0a14">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="cyber-bg"></div>
    <div class="grid-overlay"></div>

    <header class="main-header">
        <nav class="nav-container">
            <a href="index.php" class="logo">
                <span class="logo-text">KÓDOLT</span>
                <span class="logo-accent">ADMIN</span>
            </a>
            <ul class="nav-links">
                <li><a href="index.php">Vissza a főoldalra</a></li>
                <?php if (isAdminLoggedIn()): ?>
                    <li>
                        <form method="POST" style="display: inline;">
                            <button type="submit" name="kijelentkezes" style="background: none; border: none; color: var(--neon-pink); cursor: pointer; font-family: 'Rajdhani', sans-serif; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.95rem;">
                                Kijelentkezés
                            </button>
                        </form>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="main-content">

        <section class="hero" style="padding: 2rem 1rem;">
            <h1 class="hero-title" style="font-size: clamp(2rem, 6vw, 4rem);">ADMIN PANEL</h1>
            <p class="hero-subtitle">Csak a film készítője számára</p>
        </section>

        <?php if ($uzenet): ?>
            <div class="alert alert-<?= htmlspecialchars($uzenetTipus) ?>" style="max-width: 800px; margin: 0 auto 2rem;">
                <?= $uzenet ?>
            </div>
        <?php endif; ?>

        <?php if (!isAdminLoggedIn()): ?>

            <section class="section">
                <div class="jegyek-container">
                    <div class="ticket-card">
                        <div class="ticket-header">
                            <h2 class="ticket-title">BEJELENTKEZÉS</h2>
                            <p class="ticket-subtitle">Add meg az admin jelszót</p>
                        </div>
                        <form method="POST">
                            <div class="form-group">
                                <label class="form-label" for="login_jelszo">Admin jelszó</label>
                                <input type="password" class="form-input" id="login_jelszo" name="login_jelszo" required autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary btn-full">Bejelentkezés</button>
                        </form>
                        <p style="margin-top: 1.5rem; text-align: center; color: var(--text-muted); font-size: 0.85rem;">
                            Alap jelszó: <code style="color: var(--neon-cyan);">admin123</code><br>
                            (ezt változtasd meg a data/config.json fájlban!)
                        </p>
                    </div>
                </div>
            </section>

        <?php else: ?>

            <section class="section">
                <div class="admin-card">
                    <h2>Beállítások</h2>

                    <form method="POST" style="margin-bottom: 2rem;">
                        <div class="form-group">
                            <label class="form-label" for="uj_titkos_kod">Titkos kód (jegyvásárláshoz)</label>
                            <input type="text" class="form-input" id="uj_titkos_kod" name="uj_titkos_kod"
                                   value="<?= htmlspecialchars($config['titkos_kod']) ?>" required minlength="4">
                            <p style="margin-top: 0.5rem; color: var(--text-muted); font-size: 0.85rem;">
                                Ezt a kódot kell beírnod a vásárlóknak fizetés után.
                            </p>
                        </div>
                        <button type="submit" name="kod_modositas" class="btn btn-primary">Kód módosítása</button>
                    </form>

                    <form method="POST" style="margin-bottom: 2rem;">
                        <div class="form-group">
                            <label class="form-label" for="uj_ar">Ár (forintban)</label>
                            <input type="number" class="form-input" id="uj_ar" name="uj_ar"
                                   value="<?= (int)$config['ar'] ?>" required min="1">
                        </div>
                        <button type="submit" name="ar_modositas" class="btn btn-primary">Ár módosítása</button>
                    </form>

                    <form method="POST">
                        <div class="form-group">
                            <label class="form-label" for="uj_premier">Premier dátum</label>
                            <input type="datetime-local" class="form-input" id="uj_premier" name="uj_premier"
                                   value="<?= htmlspecialchars(substr($config['premier_datum'], 0, 16)) ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="uj_elozetes">Előzetes dátum</label>
                            <input type="datetime-local" class="form-input" id="uj_elozetes" name="uj_elozetes"
                                   value="<?= htmlspecialchars(substr($config['elozetes_datum'], 0, 16)) ?>" required>
                        </div>
                        <button type="submit" name="datum_modositas" class="btn btn-primary">Dátumok mentése</button>
                    </form>
                </div>

                <div class="admin-card">
                    <h2>Eladott jegyek (<?= count(getJegyek()) ?> db)</h2>

                    <?php $jegyek = getJegyek(); ?>
                    <?php if (empty($jegyek)): ?>
                        <p style="color: var(--text-muted);">Még nincs eladott jegy.</p>
                    <?php else: ?>
                        <div style="overflow-x: auto;">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Név</th>
                                        <th>Film-kód</th>
                                        <th>Vásárlás dátuma</th>
                                        <th>Státusz</th>
                                        <th>Művelet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_reverse($jegyek) as $j): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($j['nev']) ?></td>
                                            <td><strong style="color: var(--neon-cyan); font-family: 'Orbitron', sans-serif;"><?= htmlspecialchars($j['film_kod']) ?></strong></td>
                                            <td><?= htmlspecialchars($j['datum']) ?></td>
                                            <td><span class="status active">Aktív</span></td>
                                            <td>
                                                <form method="POST" style="display: inline;" onsubmit="return confirm('Biztosan törlöd ezt a jegyet?')">
                                                    <input type="hidden" name="kod" value="<?= htmlspecialchars($j['film_kod']) ?>">
                                                    <button type="submit" name="jegy_torles" style="background: rgba(255,0,100,0.2); border: 1px solid #ff0064; color: #ff5588; padding: 0.25rem 0.75rem; border-radius: 4px; cursor: pointer; font-family: inherit;">
                                                        Törlés
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

                    <p style="margin-top: 2rem; padding: 1rem; background: rgba(0,240,255,0.05); border-radius: 8px; color: var(--text-secondary);">
                        <strong style="color: var(--neon-cyan);">Bevétel összesen:</strong>
                        <?= count($jegyek) * (int)$config['ar'] ?> Ft
                        (<?= count($jegyek) ?> jegy × <?= (int)$config['ar'] ?> Ft)
                    </p>
                </div>
            </section>

        <?php endif; ?>

    </main>

    <footer class="main-footer">
        <div class="footer-bottom">
            <p>&copy; 2026 Kódolt Erő – Admin felület</p>
        </div>
    </footer>
</body>
</html>
