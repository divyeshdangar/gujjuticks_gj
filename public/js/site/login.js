(function () {
    if (!document.body.classList.contains("site-body--login")) return;

    var page = document.querySelector("[data-lg-page]");
    if (!page) return;

    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    if (reduceMotion) return;

    var googleBtn = page.querySelector(".lg-btn--google");
    if (googleBtn) {
        googleBtn.addEventListener("pointerenter", function () {
            googleBtn.classList.add("is-ready");
        });
    }
})();
