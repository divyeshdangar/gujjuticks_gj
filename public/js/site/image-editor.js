(function () {
    if (!document.body.classList.contains("site-body--image-editor")) return;

    var hub = document.querySelector("[data-ie-hub]");
    if (!hub) return;

    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    var progress = hub.querySelector("[data-ie-progress]");
    if (progress) {
        function updateProgress() {
            var doc = document.documentElement;
            var max = doc.scrollHeight - window.innerHeight;
            var pct = max > 0 ? (window.scrollY / max) * 100 : 0;
            progress.style.width = pct.toFixed(2) + "%";
        }
        updateProgress();
        window.addEventListener("scroll", updateProgress, { passive: true });
    }

    var glow = hub.querySelector("[data-ie-glow]");
    if (glow && !reduceMotion) {
        var glowX = window.innerWidth / 2;
        var glowY = window.innerHeight * 0.3;
        var targetX = glowX;
        var targetY = glowY;
        var glowRaf = 0;

        function paintGlow() {
            glowX += (targetX - glowX) * 0.12;
            glowY += (targetY - glowY) * 0.12;
            glow.style.left = glowX + "px";
            glow.style.top = glowY + "px";
            glowRaf = requestAnimationFrame(paintGlow);
        }

        window.addEventListener(
            "pointermove",
            function (e) {
                targetX = e.clientX;
                targetY = e.clientY;
                glow.classList.add("is-on");
                if (!glowRaf) glowRaf = requestAnimationFrame(paintGlow);
            },
            { passive: true }
        );
    }

    var revealEls = hub.querySelectorAll(".ie-reveal");
    if (revealEls.length) {
        if (reduceMotion || !("IntersectionObserver" in window)) {
            revealEls.forEach(function (el) {
                el.classList.add("is-in");
            });
        } else {
            var revealObs = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("is-in");
                            revealObs.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.12, rootMargin: "0px 0px -6% 0px" }
            );
            revealEls.forEach(function (el) {
                revealObs.observe(el);
            });
        }
    }
})();
