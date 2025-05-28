document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.querySelector("form[action='#']");

    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            const name = document.getElementById("nume").value.trim();
            const email = document.getElementById("email").value.trim();
            const message = document.getElementById("mesaj").value.trim();

            if (!name || !email || !message) {
                alert("Toate câmpurile sunt obligatorii!");
                e.preventDefault();
            } else {
                alert("Mulțumim! Mesajul tău a fost trimis.");
            }
        });
    }
});
