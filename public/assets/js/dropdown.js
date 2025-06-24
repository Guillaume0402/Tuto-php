document.addEventListener("DOMContentLoaded", function () {
    // Sélection de tous les boutons dropdown
    const dropdownToggles = document.querySelectorAll(".dropdown-toggle");

    // Ajout d'un écouteur d'événement à chaque bouton
    dropdownToggles.forEach((toggle) => {
        toggle.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            const dropdown = this.closest(".dropdown");
            const dropdownMenu = dropdown.querySelector(".dropdown-menu");
            const dropdownIcon = dropdown.querySelector(".dropdown-icon");

            // Fermer tous les autres menus avant d'ouvrir celui-ci
            document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                if (
                    menu !== dropdownMenu &&
                    menu.classList.contains("dropdown-menu-active")
                ) {
                    menu.classList.remove("dropdown-menu-active");
                    const otherIcon =
                        menu.parentElement.querySelector(".dropdown-icon");
                    if (otherIcon)
                        otherIcon.classList.remove("dropdown-icon-active");
                }
            });

            // Basculer l'état du menu actuel
            dropdownMenu.classList.toggle("dropdown-menu-active");
            if (dropdownIcon)
                dropdownIcon.classList.toggle("dropdown-icon-active");

            // Positionner le menu correctement lorsqu'il est ouvert
            if (dropdownMenu.classList.contains("dropdown-menu-active")) {
                positionDropdownMenu(dropdownMenu);
            }
        });
    });

    // Fermer le menu si on clique ailleurs dans la page
    document.addEventListener("click", function (e) {
        if (!e.target.closest(".dropdown")) {
            document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                menu.classList.remove("dropdown-menu-active");
            });

            document.querySelectorAll(".dropdown-icon").forEach((icon) => {
                icon.classList.remove("dropdown-icon-active");
            });
        }
    });

    // Empêcher la fermeture lorsqu'on clique à l'intérieur du menu
    document.querySelectorAll(".dropdown-menu").forEach((menu) => {
        menu.addEventListener("click", function (e) {
            // Ne pas propager l'événement, sauf pour les liens
            if (!e.target.classList.contains("dropdown-item")) {
                e.stopPropagation();
            }
        });
    });

    // Ajuster la position lors du redimensionnement de la fenêtre
    window.addEventListener("resize", function () {
        document.querySelectorAll(".dropdown-menu-active").forEach((menu) => {
            positionDropdownMenu(menu);
        });
    });

    // Ajuster la position lors du défilement
    window.addEventListener("scroll", function () {
        document.querySelectorAll(".dropdown-menu-active").forEach((menu) => {
            positionDropdownMenu(menu);
        });
    });
});

// Ajouter cette fonction dans votre script existant
function positionDropdownMenu(dropdownMenu) {
    // Réinitialiser les styles de position pour recalculer
    dropdownMenu.style.maxHeight = "";

    // Calculer si le menu déborde de l'écran
    const menuRect = dropdownMenu.getBoundingClientRect();
    const viewportHeight = window.innerHeight;
    const viewportWidth = window.innerWidth;

    // Vérifier si débordement vertical
    if (menuRect.bottom > viewportHeight) {
        // Calculer la hauteur maximale pour ne pas dépasser l'écran
        const spaceBelow = viewportHeight - menuRect.top;
        dropdownMenu.style.maxHeight = `${Math.max(200, spaceBelow - 20)}px`;
    }

    // Vérifier si débordement horizontal
    if (menuRect.right > viewportWidth) {
        dropdownMenu.classList.add("dropdown-menu-right");
    } else {
        dropdownMenu.classList.remove("dropdown-menu-right");
    }
}
