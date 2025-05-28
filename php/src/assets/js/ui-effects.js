document.addEventListener("DOMContentLoaded", function () {
    const animatedButtons = document.querySelectorAll("a.btn, button");

    animatedButtons.forEach((btn) => {
        btn.addEventListener("mouseenter", () => {
            btn.style.transform = "scale(1.05)";
            btn.style.transition = "all 0.2s";
        });

        btn.addEventListener("mouseleave", () => {
            btn.style.transform = "scale(1)";
        });
    });
});
