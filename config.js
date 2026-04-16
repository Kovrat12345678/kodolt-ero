// === KONFIGURÁCIÓ ===
const CONFIG = {
    // Dátumok
    PREMIER:  '2026-06-30T19:00:00',
    ELOZETES: '2026-05-31T19:00:00',
    EP2:      '2026-07-31T19:00:00',
    EP3:      '2026-09-01T19:00:00',

    // Ár
    AR: 500,

    // SHA-256 hash a titkos kódról ("ZYNOX2026")
    // Ezt változtatd ha új titkos kódot szeretnél!
    // Új hash generálása: https://emn178.github.io/online-tools/sha256.html
    SECRET_HASH: 'bbe04e1253c3295d898c770a579b0c58f62d578ed6899138644422e142079dac',

    // Sót a film-kód generáláshoz (ne változtasd, mert akkor az összes régi kód érvénytelen lesz)
    SALT: 'ZYNOX_SECRET_SALT_2026'
};
