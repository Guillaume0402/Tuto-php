document.addEventListener("DOMContentLoaded", function () {
    // Sélection de tous les boutons dropdown
    const dropdownToggles = document.querySelectorAll(".dropdown-toggle");
    let isMobile = window.innerWidth <= 768;

    // Mettre à jour la variable isMobile lors du redimensionnement de la fenêtre
    window.addEventListener("resize", function () {
        isMobile = window.innerWidth <= 768;
    });

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

                    // Réactiver le scroll si on ferme le menu sur mobile
                    if (isMobile) {
                        document.body.classList.remove("dropdown-open");
                    }
                }
            });

            // Basculer l'état du menu actuel
            dropdownMenu.classList.toggle("dropdown-menu-active");

            if (dropdownIcon) {
                dropdownIcon.classList.toggle("dropdown-icon-active");
            }

            // Désactiver le scroll sur mobile quand le menu est ouvert
            if (isMobile) {
                if (dropdownMenu.classList.contains("dropdown-menu-active")) {
                    document.body.classList.add("dropdown-open");

                    // Restructurer le menu mobile pour permettre le défilement
                    // Si le header existe déjà, on ne fait rien
                    if (
                        !dropdownMenu.querySelector(
                            ".dropdown-menu-mobile-header"
                        )
                    ) {
                        // Créer le header fixe
                        const mobileHeader = document.createElement("div");
                        mobileHeader.className = "dropdown-menu-mobile-header";
                        mobileHeader.textContent = "Modules de formation PHP";

                        // Réorganiser le contenu du menu pour permettre le défilement
                        const contentWrapper = document.createElement("div");
                        contentWrapper.className =
                            "dropdown-menu-mobile-content";

                        // Collecter tous les liens et dividers
                        const allElements = Array.from(dropdownMenu.children);

                        // Insérer le header au début
                        dropdownMenu.insertBefore(
                            mobileHeader,
                            dropdownMenu.firstChild
                        );

                        // Déplacer tous les éléments (sauf le header) dans le wrapper
                        allElements.forEach((element) => {
                            if (
                                !element.classList.contains(
                                    "dropdown-menu-mobile-header"
                                )
                            ) {
                                contentWrapper.appendChild(element);
                            }
                        });

                        // Ajouter le wrapper au menu
                        dropdownMenu.appendChild(contentWrapper);
                    }
                } else {
                    document.body.classList.remove("dropdown-open");
                }
            }

            // Positionner le menu correctement lorsqu'il est ouvert
            if (dropdownMenu.classList.contains("dropdown-menu-active")) {
                positionDropdownMenu(dropdownMenu);
            }
        });
    });

    // Fermer le menu si on clique ailleurs dans la page
    document.addEventListener("click", function (e) {
        // Fermer si le clic est en dehors du dropdown
        if (!e.target.closest(".dropdown")) {
            document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                menu.classList.remove("dropdown-menu-active");
            });

            document.querySelectorAll(".dropdown-icon").forEach((icon) => {
                icon.classList.remove("dropdown-icon-active");
            });

            // Réactiver le scroll
            document.body.classList.remove("dropdown-open");
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

// Fonction pour positionner correctement le menu déroulant
function positionDropdownMenu(dropdownMenu) {
    // Réinitialiser les styles de position pour recalculer
    dropdownMenu.style.maxHeight = "";
    dropdownMenu.style.maxWidth = "";

    // Calculer si le menu déborde de l'écran
    const menuRect = dropdownMenu.getBoundingClientRect();
    const viewportHeight = window.innerHeight;
    const viewportWidth = window.innerWidth;
    const dropdown = dropdownMenu.closest(".dropdown");
    const dropdownRect = dropdown.getBoundingClientRect();

    // Vérifier si débordement vertical
    if (menuRect.bottom > viewportHeight) {
        // Calculer la hauteur maximale pour ne pas dépasser l'écran
        const spaceBelow = viewportHeight - menuRect.top;
        dropdownMenu.style.maxHeight = `${Math.max(200, spaceBelow - 20)}px`;
    } else {
        // Limiter quand même à 80% de la hauteur de la fenêtre
        dropdownMenu.style.maxHeight = `${Math.min(
            menuRect.height,
            viewportHeight * 0.8
        )}px`;
    }

    // Vérifier si débordement horizontal
    if (menuRect.right > viewportWidth - 20) {
        // Aligner le menu à droite du bouton
        dropdownMenu.classList.add("dropdown-menu-right");
        // S'assurer que le menu ne dépasse pas à gauche
        const maxWidth = dropdownRect.right - 10;
        dropdownMenu.style.maxWidth = `${Math.min(480, maxWidth)}px`;
    } else {
        dropdownMenu.classList.remove("dropdown-menu-right");
        // S'assurer que le menu ne dépasse pas à droite
        const maxWidth = viewportWidth - dropdownRect.left - 10;
        dropdownMenu.style.maxWidth = `${Math.min(480, maxWidth)}px`;
    }
}
