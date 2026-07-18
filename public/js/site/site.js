(function () {
    var header = document.getElementById("site-header");
    var toggle = document.getElementById("site-nav-toggle");
    if (header && toggle) {
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
    }

    // Session flash modal
    var flash = document.querySelector("[data-site-flash]");
    if (!flash) return;

    var titleEl = flash.querySelector("[data-site-flash-title]");
    var descEl = flash.querySelector("[data-site-flash-desc]");
    var closeEls = flash.querySelectorAll("[data-site-flash-close]");
    var btn = flash.querySelector(".site-flash__btn");
    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    var lastFocus = null;

    function openFlash() {
        var title = flash.getAttribute("data-title") || "";
        var description = flash.getAttribute("data-description") || "";
        var type = flash.getAttribute("data-type") || "info";
        if (!title) return;

        flash.setAttribute("data-type", type);
        if (titleEl) titleEl.textContent = title;
        if (descEl) descEl.textContent = description;

        lastFocus = document.activeElement;
        flash.hidden = false;
        document.body.style.overflow = "hidden";

        window.requestAnimationFrame(function () {
            flash.classList.add("is-open");
            if (btn) btn.focus();
        });
    }

    function closeFlash() {
        flash.classList.remove("is-open");
        document.body.style.overflow = "";

        var done = function () {
            flash.hidden = true;
            flash.removeAttribute("data-open");
            if (lastFocus && typeof lastFocus.focus === "function") {
                lastFocus.focus();
            }
        };

        if (reduceMotion) {
            done();
            return;
        }

        window.setTimeout(done, 280);
    }

    closeEls.forEach(function (el) {
        el.addEventListener("click", closeFlash);
    });

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && flash.classList.contains("is-open")) {
            closeFlash();
        }
    });

    if (flash.getAttribute("data-open") === "1") {
        openFlash();
    }
})();
