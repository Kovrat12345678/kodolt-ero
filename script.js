document.addEventListener('DOMContentLoaded', () => {
    const countdown = document.getElementById('countdown');
    if (!countdown) return;

    const target = new Date(countdown.dataset.target).getTime();
    const days = document.getElementById('cd-days');
    const hours = document.getElementById('cd-hours');
    const minutes = document.getElementById('cd-minutes');
    const seconds = document.getElementById('cd-seconds');

    function update() {
        const now = new Date().getTime();
        const distance = target - now;

        if (distance < 0) {
            days.textContent = '0';
            hours.textContent = '0';
            minutes.textContent = '0';
            seconds.textContent = '0';
            return;
        }

        days.textContent = Math.floor(distance / (1000 * 60 * 60 * 24));
        hours.textContent = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        minutes.textContent = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        seconds.textContent = Math.floor((distance % (1000 * 60)) / 1000);
    }

    update();
    setInterval(update, 1000);
});
