(function () {
    var header = document.getElementById("site-header");
    var toggle = document.getElementById("site-nav-toggle");
    if (!header || !toggle) return;

    toggle.addEventListener("click", function () {
        var open = header.classList.toggle("is-open");
        toggle.setAttribute("aria-expanded", open ? "true" : "false");
        toggle.setAttribute("aria-label", open ? "Close menu" : "Open menu");
    });

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && header.classList.contains("is-open")) {
            header.classList.remove("is-open");
            toggle.setAttribute("aria-expanded", "false");
            toggle.setAttribute("aria-label", "Open menu");
        }
    });
})();
