(function () {
    if (!document.body.classList.contains("site-body--cities")) return;

    var hub = document.querySelector("[data-bd-hub]");
    if (!hub) return;

    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    // Typewriter
    var typeEl = hub.querySelector("[data-bd-type]");
    if (typeEl) {
        var phrases = ["by city", "by category", "near you", "across Gujarat"];
        var phraseIdx = 0;
        var charIdx = phrases[0].length;
        var deleting = false;
        var typePaused = false;

        function typeTick() {
            if (typePaused || reduceMotion) return;
            var current = phrases[phraseIdx];
            if (!deleting) {
                charIdx += 1;
                typeEl.textContent = current.slice(0, charIdx);
                if (charIdx >= current.length) {
                    deleting = true;
                    typePaused = true;
                    window.setTimeout(function () {
                        typePaused = false;
                        typeTick();
                    }, 1400);
                    return;
                }
            } else {
                charIdx -= 1;
                typeEl.textContent = current.slice(0, charIdx);
                if (charIdx <= 0) {
                    deleting = false;
                    phraseIdx = (phraseIdx + 1) % phrases.length;
                }
            }
            window.setTimeout(typeTick, deleting ? 36 : 58);
        }

        if (!reduceMotion) window.setTimeout(typeTick, 900);
    }

    // Interactive Gujarat city map
    var mapCanvas = hub.querySelector("[data-bd-map]");
    var mapStage = hub.querySelector("[data-bd-map-stage]");
    if (mapCanvas && mapStage && mapCanvas.getContext) {
        var mCtx = mapCanvas.getContext("2d");
        var mDpr = Math.min(window.devicePixelRatio || 1, 2);
        var mw = 0;
        var mh = 0;
        var pinPts = [];
        var pinEls = [];
        var packets = [];
        var tick = 0;
        var running = true;
        var activeIndex = -1;
        var radar = mapStage.querySelector("[data-bd-radar]");
        var statusEl = mapStage.querySelector("[data-bd-map-status]");
        var defaultStatus = statusEl ? statusEl.textContent : "";

        function readPins() {
            pinPts = [];
            pinEls = Array.prototype.slice.call(mapStage.querySelectorAll("[data-bd-pin]"));
            pinEls.forEach(function (el) {
                var parts = (el.getAttribute("data-bd-pin") || "").split(",");
                var xPct = parseFloat(parts[0]);
                var yPct = parseFloat(parts[1]);
                if (!isNaN(xPct) && !isNaN(yPct)) {
                    pinPts.push({ x: (xPct / 100) * mw, y: (yPct / 100) * mh });
                }
            });
        }

        function resizeMap() {
            var rect = mapStage.getBoundingClientRect();
            mw = Math.max(1, Math.floor(rect.width));
            mh = Math.max(1, Math.floor(rect.height));
            mapCanvas.width = Math.floor(mw * mDpr);
            mapCanvas.height = Math.floor(mh * mDpr);
            mapCanvas.style.width = mw + "px";
            mapCanvas.style.height = mh + "px";
            mCtx.setTransform(mDpr, 0, 0, mDpr, 0, 0);
            readPins();
        }

        function setActive(index, name) {
            activeIndex = index;
            pinEls.forEach(function (el, i) {
                el.classList.toggle("is-active", i === index);
            });
            mapStage.classList.toggle("is-active", index >= 0);
            if (statusEl) {
                statusEl.textContent =
                    index >= 0 && name ? "Open " + name + " →" : defaultStatus;
            }
            if (index >= 0 && !reduceMotion) {
                for (var i = 0; i < pinPts.length; i++) {
                    if (i === index) continue;
                    packets.push({
                        a: index,
                        b: i,
                        t: 0,
                        speed: 0.012 + Math.random() * 0.01,
                        boost: true,
                    });
                }
                if (packets.length > 18) packets.splice(0, packets.length - 18);
            }
        }

        function spawnPacket() {
            if (pinPts.length < 2) return;
            var a;
            var b;
            if (activeIndex >= 0) {
                a = activeIndex;
                b = Math.floor(Math.random() * pinPts.length);
                if (b === a) b = (a + 1) % pinPts.length;
            } else {
                a = Math.floor(Math.random() * pinPts.length);
                b = Math.floor(Math.random() * pinPts.length);
                if (b === a) b = (a + 1) % pinPts.length;
            }
            packets.push({
                a: a,
                b: b,
                t: 0,
                speed: 0.008 + Math.random() * 0.01,
                boost: activeIndex >= 0,
            });
            if (packets.length > 10) packets.shift();
        }

        function drawMap() {
            if (!running) return;
            mCtx.clearRect(0, 0, mw, mh);
            if (reduceMotion) {
                // Static faint links
                for (var s = 0; s < pinPts.length; s++) {
                    for (var t = s + 1; t < pinPts.length; t++) {
                        mCtx.beginPath();
                        mCtx.setLineDash([4, 6]);
                        mCtx.moveTo(pinPts[s].x, pinPts[s].y);
                        mCtx.lineTo(pinPts[t].x, pinPts[t].y);
                        mCtx.strokeStyle = "rgba(194, 65, 12, 0.12)";
                        mCtx.lineWidth = 1;
                        mCtx.stroke();
                    }
                }
                mCtx.setLineDash([]);
                return;
            }
            tick += 1;

            // Base links
            for (var i = 0; i < pinPts.length; i++) {
                for (var j = i + 1; j < pinPts.length; j++) {
                    if (activeIndex >= 0 && activeIndex !== i && activeIndex !== j) {
                        continue;
                    }
                    mCtx.beginPath();
                    mCtx.setLineDash(activeIndex >= 0 ? [] : [4, 6]);
                    mCtx.moveTo(pinPts[i].x, pinPts[i].y);
                    mCtx.lineTo(pinPts[j].x, pinPts[j].y);
                    mCtx.strokeStyle =
                        activeIndex >= 0
                            ? "rgba(194, 65, 12, 0.45)"
                            : "rgba(194, 65, 12, 0.16)";
                    mCtx.lineWidth = activeIndex >= 0 ? 1.6 : 1.1;
                    mCtx.stroke();
                }
            }
            mCtx.setLineDash([]);

            if (tick % (activeIndex >= 0 ? 18 : 42) === 0) spawnPacket();

            for (var p = packets.length - 1; p >= 0; p--) {
                var packet = packets[p];
                packet.t += packet.speed;
                if (packet.t >= 1) {
                    packets.splice(p, 1);
                    continue;
                }
                var a = pinPts[packet.a];
                var b = pinPts[packet.b];
                if (!a || !b) {
                    packets.splice(p, 1);
                    continue;
                }
                var px = a.x + (b.x - a.x) * packet.t;
                var py = a.y + (b.y - a.y) * packet.t;
                var radius = packet.boost ? 8 : 6;
                var grad = mCtx.createRadialGradient(px, py, 0, px, py, radius);
                grad.addColorStop(0, "rgba(194, 65, 12, 0.9)");
                grad.addColorStop(1, "rgba(194, 65, 12, 0)");
                mCtx.beginPath();
                mCtx.arc(px, py, radius, 0, Math.PI * 2);
                mCtx.fillStyle = grad;
                mCtx.fill();
                mCtx.beginPath();
                mCtx.arc(px, py, packet.boost ? 2.2 : 1.7, 0, Math.PI * 2);
                mCtx.fillStyle = "rgba(17, 19, 24, 0.9)";
                mCtx.fill();
            }

            requestAnimationFrame(drawMap);
        }

        pinEls = Array.prototype.slice.call(mapStage.querySelectorAll("[data-bd-pin]"));
        pinEls.forEach(function (el, index) {
            el.addEventListener("mouseenter", function () {
                setActive(index, el.getAttribute("data-bd-pin-name") || "");
            });
            el.addEventListener("focus", function () {
                setActive(index, el.getAttribute("data-bd-pin-name") || "");
            });
            el.addEventListener("mouseleave", function () {
                if (document.activeElement !== el) setActive(-1, "");
            });
            el.addEventListener("blur", function () {
                setActive(-1, "");
            });
        });

        mapStage.addEventListener(
            "pointermove",
            function (e) {
                if (!radar || reduceMotion) return;
                var rect = mapStage.getBoundingClientRect();
                var x = ((e.clientX - rect.left) / rect.width) * 100;
                var y = ((e.clientY - rect.top) / rect.height) * 100;
                radar.style.left = Math.max(8, Math.min(92, x)) + "%";
                radar.style.top = Math.max(10, Math.min(88, y)) + "%";
            },
            { passive: true }
        );

        mapStage.addEventListener("pointerleave", function () {
            if (!radar) return;
            radar.style.left = "50%";
            radar.style.top = "45%";
            setActive(-1, "");
        });

        resizeMap();
        drawMap();
        if (!reduceMotion) {
            // keep loop; drawMap schedules itself unless reduceMotion returns early
        } else {
            // one static paint already done in drawMap
        }
        window.addEventListener("resize", function () {
            resizeMap();
            if (reduceMotion) drawMap();
        });
        document.addEventListener("visibilitychange", function () {
            running = !document.hidden;
            if (running) drawMap();
        });
    }

    // Scroll progress
    var progress = hub.querySelector("[data-bd-progress]");
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

    // Pointer glow
    var glow = hub.querySelector("[data-bd-glow]");
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

    // Soft particles
    var canvas = hub.querySelector("[data-bd-particles]");
    if (canvas && !reduceMotion && canvas.getContext) {
        var ctx = canvas.getContext("2d");
        var particles = [];
        var dpr = Math.min(window.devicePixelRatio || 1, 2);
        var pRunning = true;

        function resizeParticles() {
            var w = window.innerWidth;
            var h = window.innerHeight;
            canvas.width = Math.floor(w * dpr);
            canvas.height = Math.floor(h * dpr);
            canvas.style.width = w + "px";
            canvas.style.height = h + "px";
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

            var count = Math.min(36, Math.floor((w * h) / 32000));
            particles = [];
            for (var i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * w,
                    y: Math.random() * h,
                    r: 0.6 + Math.random() * 1.3,
                    vx: (Math.random() - 0.5) * 0.2,
                    vy: -0.12 - Math.random() * 0.28,
                    a: 0.1 + Math.random() * 0.22,
                });
            }
        }

        function drawParticles() {
            if (!pRunning) return;
            var w = window.innerWidth;
            var h = window.innerHeight;
            ctx.clearRect(0, 0, w, h);
            for (var i = 0; i < particles.length; i++) {
                var p = particles[i];
                p.x += p.vx;
                p.y += p.vy;
                if (p.y < -4) {
                    p.y = h + 4;
                    p.x = Math.random() * w;
                }
                if (p.x < -4) p.x = w + 4;
                if (p.x > w + 4) p.x = -4;
                ctx.beginPath();
                ctx.fillStyle = "rgba(194, 65, 12," + p.a + ")";
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fill();
            }
            requestAnimationFrame(drawParticles);
        }

        resizeParticles();
        drawParticles();
        window.addEventListener("resize", resizeParticles);
        document.addEventListener("visibilitychange", function () {
            pRunning = !document.hidden;
            if (pRunning) drawParticles();
        });
    }

    // Reveal
    var revealEls = hub.querySelectorAll(".bd-reveal");
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

    // Count-up
    var counters = hub.querySelectorAll("[data-bd-count]");
    function animateCount(el) {
        var target = parseInt(el.getAttribute("data-bd-count"), 10) || 0;
        if (reduceMotion) {
            el.textContent = target.toLocaleString();
            return;
        }
        var started = performance.now();
        function frame(now) {
            var t = Math.min(1, (now - started) / 1100);
            var eased = 1 - Math.pow(1 - t, 3);
            el.textContent = Math.round(target * eased).toLocaleString();
            if (t < 1) requestAnimationFrame(frame);
        }
        requestAnimationFrame(frame);
    }

    if (counters.length) {
        if (!("IntersectionObserver" in window)) {
            counters.forEach(animateCount);
        } else {
            var countObs = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            animateCount(entry.target);
                            countObs.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.4 }
            );
            counters.forEach(function (el) {
                countObs.observe(el);
            });
        }
    }
})();
