document.addEventListener("DOMContentLoaded", function () {
    const modulesBtn = document.querySelector(".header__modules-btn");
    const modulesMenu = document.querySelector(".header__modules-menu");
    const closeBtn = document.querySelector(".header__close");
    const overlay = document.querySelector(".header__overlay");
    const burger = document.querySelector(".header__burger");
    const nav = document.querySelector(".header__nav");

    function openMenu() {
        modulesMenu.classList.add("open");
        overlay.classList.add("open");
        modulesBtn.setAttribute("aria-expanded", "true");
        document.body.style.overflow = "hidden";
    }
    function closeMenu() {
        modulesMenu.classList.remove("open");
        overlay.classList.remove("open");
        modulesBtn.setAttribute("aria-expanded", "false");
        document.body.style.overflow = "";
    }
    modulesBtn.addEventListener("click", function (e) {
        e.preventDefault();
        if (modulesMenu.classList.contains("open")) {
            closeMenu();
        } else {
            openMenu();
        }
    });
    closeBtn.addEventListener("click", closeMenu);
    overlay.addEventListener("click", closeMenu);
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") closeMenu();
    });
    burger.addEventListener("click", function () {
        nav.style.display = nav.style.display === "flex" ? "none" : "flex";
    });
});
