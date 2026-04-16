<?php
declare(strict_types=1);

session_start();

const CONFIG_FILE = __DIR__ . '/../data/config.json';
const JEGYEK_FILE = __DIR__ . '/../data/jegyek.json';

function getConfig(): array {
    return json_decode(file_get_contents(CONFIG_FILE), true);
}

function saveConfig(array $config): void {
    file_put_contents(CONFIG_FILE, json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function getJegyek(): array {
    return json_decode(file_get_contents(JEGYEK_FILE), true);
}

function saveJegyek(array $jegyek): void {
    file_put_contents(JEGYEK_FILE, json_encode($jegyek, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function generateFilmKod(): string {
    $karakterek = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $kod = 'ZNX-';
    for ($i = 0; $i < 8; $i++) {
        $kod .= $karakterek[random_int(0, strlen($karakterek) - 1)];
    }
    return $kod;
}

function isAdminLoggedIn(): bool {
    return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
}

function visszaszamlalas(string $datum): array {
    $most = new DateTime();
    $cel = new DateTime($datum);
    $diff = $most->diff($cel);
    return [
        'napok' => $diff->invert ? 0 : (int)$diff->days,
        'orak' => $diff->invert ? 0 : $diff->h,
        'percek' => $diff->invert ? 0 : $diff->i,
        'masodpercek' => $diff->invert ? 0 : $diff->s,
        'lejart' => (bool)$diff->invert,
    ];
}
