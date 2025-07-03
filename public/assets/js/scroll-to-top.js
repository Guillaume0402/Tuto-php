/**
 * Bouton retour en haut de page
 * Fonctionnalité de scroll smooth et affichage/masquage automatique
 */

document.addEventListener("DOMContentLoaded", function () {
    const scrollToTopBtn = document.getElementById("scrollToTop");

    if (!scrollToTopBtn) return;

    // Configuration
    const showButtonAfter = 300; // Pixels de scroll avant d'afficher le bouton
    const scrollDuration = 800; // Durée de l'animation en ms

    // Fonction pour afficher/masquer le bouton selon la position de scroll
    function toggleScrollButton() {
        const scrollTop =
            window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > showButtonAfter) {
            scrollToTopBtn.classList.add("visible");
        } else {
            scrollToTopBtn.classList.remove("visible");
        }
    }

    // Fonction de scroll smooth vers le haut
    function scrollToTop() {
        const startPosition = window.pageYOffset;
        const startTime = performance.now();

        function animateScroll(currentTime) {
            const timeElapsed = currentTime - startTime;
            const progress = Math.min(timeElapsed / scrollDuration, 1);

            // Fonction d'easing (ease-out-cubic)
            const ease = 1 - Math.pow(1 - progress, 3);

            window.scrollTo(0, startPosition * (1 - ease));

            if (progress < 1) {
                requestAnimationFrame(animateScroll);
            }
        }

        requestAnimationFrame(animateScroll);
    }

    // Event listeners
    window.addEventListener("scroll", toggleScrollButton);
    scrollToTopBtn.addEventListener("click", scrollToTop);

    // Vérification initiale au chargement de la page
    toggleScrollButton();

    // Support pour les utilisateurs qui préfèrent les animations réduites
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        scrollToTopBtn.addEventListener("click", function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: "auto" });
        });
    }
});
