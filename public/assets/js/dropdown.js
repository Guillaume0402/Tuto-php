document.addEventListener("DOMContentLoaded", function () {
    const modulesBtn = document.querySelector(".header__modules-btn");
    const modulesMenu = document.querySelector(".header__modules-menu");
    const closeBtn = document.querySelector(".header__close");
    const overlay = document.querySelector(".header__overlay");
    const burger = document.querySelector(".header__burger");
    const nav = document.querySelector(".header__nav");
    const burgerClose = document.querySelector(".burger-menu__close");

    modulesMenu.classList.remove("open");
    overlay.classList.remove("open");
    if (modulesBtn) modulesBtn.setAttribute("aria-expanded", "false");
    document.body.style.overflow = "";
    if (window.innerWidth <= 900 && nav) nav.style.display = "none";

    function openModulesMenu() {
        modulesMenu.classList.add("open");
        overlay.classList.add("open");
        if (modulesBtn) modulesBtn.setAttribute("aria-expanded", "true");
        document.body.style.overflow = "hidden";
    }
    function closeModulesMenu() {
        modulesMenu.classList.remove("open");
        overlay.classList.remove("open");
        if (modulesBtn) modulesBtn.setAttribute("aria-expanded", "false");
        document.body.style.overflow = "";
    }
    if (modulesBtn) {
        modulesBtn.addEventListener("click", function (e) {
            e.preventDefault();
            if (modulesMenu.classList.contains("open")) {
                closeModulesMenu();
            } else {
                openModulesMenu();
            }
        });
    }
    if (burger && nav) {
        burger.addEventListener("click", function () {
            if (window.innerWidth > 900) return;
            const isOpen = document.body.classList.contains("menu-open");
            if (isOpen) {
                nav.style.display = "none";
                document.body.classList.remove("menu-open");
            } else {
                nav.style.display = "flex";
                document.body.classList.add("menu-open");
            }
        });
    }
    if (burgerClose && nav) {
        burgerClose.addEventListener("click", function () {
            nav.style.display = "none";
            document.body.classList.remove("menu-open");
        });
    }
    if (closeBtn) closeBtn.addEventListener("click", closeModulesMenu);
    if (overlay) overlay.addEventListener("click", closeModulesMenu);
    document.addEventListener("keydown", function (e) {
        if (
            e.key === "Escape" &&
            document.body.classList.contains("menu-open")
        ) {
            if (nav) nav.style.display = "none";
            document.body.classList.remove("menu-open");
        }
    });
    window.addEventListener("resize", function () {
        if (window.innerWidth > 900 && nav) {
            nav.style.display = "flex";
            document.body.classList.remove("menu-open");
        }
        if (window.innerWidth <= 900 && nav) {
            nav.style.display = "none";
            document.body.classList.remove("menu-open");
        }
    });
});
