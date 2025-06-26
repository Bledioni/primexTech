// Set countdown to 3 days from now
const now = new Date().getTime();
const threeDaysLater = now + (3 * 24 * 60 * 60 * 1000); // 3 days in ms

const countdownEl = document.getElementById("countdown");

const timer = setInterval(() => {
    const current = new Date().getTime();
    const distance = threeDaysLater - current;

    if (distance <= 0) {
        clearInterval(timer);
        countdownEl.innerHTML = "Countdown Finished!";
        return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    countdownEl.innerHTML = `${days} : ${hours} : ${minutes} : ${seconds}`;
    }, 1000);