(function () {
    if (!document.body.classList.contains("site-body--news")) return;

    var hub = document.querySelector("[data-nw-hub]");
    if (!hub) return;

    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    // Typewriter
    var typeEl = hub.querySelector("[data-nw-type]");
    if (typeEl) {
        var phrases = [
            "Gujarat updates",
            "India headlines",
            "local briefs",
            "topic desks",
            "daily wrap-ups",
        ];
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

    // Local time
    function updateTime() {
        var el = hub.querySelector("[data-nw-time]");
        if (!el) return;
        try {
            el.textContent =
                "India · " +
                new Intl.DateTimeFormat("en-IN", {
                    timeZone: "Asia/Kolkata",
                    hour: "numeric",
                    minute: "2-digit",
                    hour12: true,
                }).format(new Date());
        } catch (e) {
            el.textContent = "India time";
        }
    }
    updateTime();
    setInterval(updateTime, 30000);

    // Right-side headline constellation
    var visualCanvas = hub.querySelector("[data-nw-visual]");
    if (visualCanvas && !reduceMotion && visualCanvas.getContext) {
        var vCtx = visualCanvas.getContext("2d");
        var vStage = visualCanvas.parentElement;
        var vDpr = Math.min(window.devicePixelRatio || 1, 2);
        var vw = 0;
        var vh = 0;
        var vNodes = [];
        var vPackets = [];
        var vTick = 0;
        var vRunning = true;

        function seedVisual() {
            var count = Math.max(16, Math.min(32, Math.floor((vw * vh) / 14000)));
            vNodes = [];
            vPackets = [];
            for (var i = 0; i < count; i++) {
                vNodes.push({
                    x: Math.random() * vw,
                    y: Math.random() * vh,
                    vx: (Math.random() - 0.5) * 0.28,
                    vy: (Math.random() - 0.5) * 0.28,
                    r: 1.2 + Math.random() * 1.6,
                    pulse: Math.random() * Math.PI * 2,
                });
            }
        }

        function resizeVisual() {
            var rect = vStage.getBoundingClientRect();
            vw = Math.max(1, Math.floor(rect.width));
            vh = Math.max(1, Math.floor(rect.height));
            visualCanvas.width = Math.floor(vw * vDpr);
            visualCanvas.height = Math.floor(vh * vDpr);
            visualCanvas.style.width = vw + "px";
            visualCanvas.style.height = vh + "px";
            vCtx.setTransform(vDpr, 0, 0, vDpr, 0, 0);
            seedVisual();
        }

        function spawnPacket(links) {
            if (!links.length) return;
            var link = links[Math.floor(Math.random() * links.length)];
            vPackets.push({
                a: link.a,
                b: link.b,
                t: 0,
                speed: 0.01 + Math.random() * 0.014,
            });
            if (vPackets.length > 14) vPackets.shift();
        }

        function drawVisual() {
            if (!vRunning) return;
            vCtx.clearRect(0, 0, vw, vh);
            vTick += 1;

            for (var i = 0; i < vNodes.length; i++) {
                var n = vNodes[i];
                n.x += n.vx;
                n.y += n.vy;
                n.pulse += 0.025;
                if (n.x < -10) n.x = vw + 10;
                if (n.x > vw + 10) n.x = -10;
                if (n.y < -10) n.y = vh + 10;
                if (n.y > vh + 10) n.y = -10;
            }

            var links = [];
            for (var a = 0; a < vNodes.length; a++) {
                for (var b = a + 1; b < vNodes.length; b++) {
                    var dx = vNodes[a].x - vNodes[b].x;
                    var dy = vNodes[a].y - vNodes[b].y;
                    var dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 105) links.push({ a: a, b: b, alpha: 1 - dist / 105 });
                }
            }

            if (vTick % 28 === 0) spawnPacket(links);

            for (var l = 0; l < links.length; l++) {
                var link = links[l];
                var na = vNodes[link.a];
                var nb = vNodes[link.b];
                vCtx.beginPath();
                vCtx.moveTo(na.x, na.y);
                vCtx.lineTo(nb.x, nb.y);
                vCtx.strokeStyle = "rgba(225, 29, 72," + (link.alpha * 0.2).toFixed(3) + ")";
                vCtx.lineWidth = 1;
                vCtx.stroke();
            }

            for (var p = vPackets.length - 1; p >= 0; p--) {
                var packet = vPackets[p];
                packet.t += packet.speed;
                if (packet.t >= 1) {
                    vPackets.splice(p, 1);
                    continue;
                }
                var pa = vNodes[packet.a];
                var pb = vNodes[packet.b];
                if (!pa || !pb) {
                    vPackets.splice(p, 1);
                    continue;
                }
                var px = pa.x + (pb.x - pa.x) * packet.t;
                var py = pa.y + (pb.y - pa.y) * packet.t;
                var grad = vCtx.createRadialGradient(px, py, 0, px, py, 6);
                grad.addColorStop(0, "rgba(225, 29, 72, 0.85)");
                grad.addColorStop(1, "rgba(225, 29, 72, 0)");
                vCtx.beginPath();
                vCtx.arc(px, py, 6, 0, Math.PI * 2);
                vCtx.fillStyle = grad;
                vCtx.fill();
                vCtx.beginPath();
                vCtx.arc(px, py, 1.6, 0, Math.PI * 2);
                vCtx.fillStyle = "rgba(17, 19, 24, 0.85)";
                vCtx.fill();
            }

            for (var j = 0; j < vNodes.length; j++) {
                var node = vNodes[j];
                var glowR = node.r + 1.2 + Math.sin(node.pulse) * 0.7;
                vCtx.beginPath();
                vCtx.arc(node.x, node.y, glowR, 0, Math.PI * 2);
                vCtx.fillStyle = "rgba(225, 29, 72, 0.1)";
                vCtx.fill();
                vCtx.beginPath();
                vCtx.arc(node.x, node.y, node.r, 0, Math.PI * 2);
                vCtx.fillStyle =
                    j % 4 === 0 ? "rgba(17, 19, 24, 0.5)" : "rgba(225, 29, 72, 0.7)";
                vCtx.fill();
            }

            requestAnimationFrame(drawVisual);
        }

        resizeVisual();
        drawVisual();
        window.addEventListener("resize", resizeVisual);
        document.addEventListener("visibilitychange", function () {
            vRunning = !document.hidden;
            if (vRunning) drawVisual();
        });
    }

    // Scroll progress
    var progress = hub.querySelector("[data-nw-progress]");
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
    var glow = hub.querySelector("[data-nw-glow]");
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
    var canvas = hub.querySelector("[data-nw-particles]");
    if (canvas && !reduceMotion && canvas.getContext) {
        var ctx = canvas.getContext("2d");
        var particles = [];
        var dpr = Math.min(window.devicePixelRatio || 1, 2);
        var running = true;

        function resizeCanvas() {
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
            if (!running) return;
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
                ctx.fillStyle = "rgba(225, 29, 72," + p.a + ")";
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fill();
            }
            requestAnimationFrame(drawParticles);
        }

        resizeCanvas();
        drawParticles();
        window.addEventListener("resize", resizeCanvas);
        document.addEventListener("visibilitychange", function () {
            running = !document.hidden;
            if (running) drawParticles();
        });
    }

    // Reveal
    var revealEls = hub.querySelectorAll(".nw-reveal");
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

    // Story reel (category detail) — depth stack + scan + pips
    var stack = hub.querySelector("[data-nw-stack]");
    var stage = hub.querySelector("[data-nw-stage] .nw-stage") || hub.querySelector(".nw-stage");
    if (stack) {
        var cards = Array.prototype.slice.call(stack.querySelectorAll("[data-nw-card], .nw-stack__card"));
        var pips = Array.prototype.slice.call(hub.querySelectorAll("[data-nw-pips] .nw-stage__pip"));
        var statusEl = hub.querySelector("[data-nw-status]");
        var total = cards.length;

        function pad2(n) {
            return n < 10 ? "0" + n : String(n);
        }

        function setDepth(activeIdx, exiting) {
            cards.forEach(function (card, i) {
                card.classList.remove("is-active", "is-prev", "is-next", "is-back", "is-exit", "is-enter");
                if (exiting && card === exiting) {
                    card.classList.add("is-exit");
                    return;
                }
                if (i === activeIdx) {
                    card.classList.add("is-active");
                    var meter = card.querySelector(".nw-stack__meter-fill");
                    var scan = card.querySelector(".nw-stack__scan");
                    [meter, scan].forEach(function (el) {
                        if (!el) return;
                        el.style.animation = "none";
                        void el.offsetWidth;
                        el.style.animation = "";
                    });
                    return;
                }
                var dist = (i - activeIdx + total) % total;
                if (dist === total - 1) card.classList.add("is-prev");
                else if (dist === 1) card.classList.add("is-next");
                else card.classList.add("is-back");
            });

            pips.forEach(function (pip, i) {
                pip.classList.toggle("is-on", i === activeIdx);
            });

            if (statusEl) {
                statusEl.textContent = "Queue " + pad2(activeIdx + 1) + " / " + pad2(total);
            }
        }

        if (total) {
            var stackIdx = 0;
            setDepth(0);

            if (!reduceMotion && total > 1) {
                setInterval(function () {
                    var leaving = cards[stackIdx];
                    stackIdx = (stackIdx + 1) % total;
                    setDepth(stackIdx, leaving);
                    window.setTimeout(function () {
                        setDepth(stackIdx);
                    }, 620);
                }, 3200);
            }
        }

        // Pointer tilt on the reel stage
        if (stage && !reduceMotion) {
            var visual = hub.querySelector("[data-nw-stage]");
            var tiltRaf = 0;
            var targetX = 0;
            var targetY = 0;
            var curX = 0;
            var curY = 0;

            function tickTilt() {
                curX += (targetX - curX) * 0.12;
                curY += (targetY - curY) * 0.12;
                stage.style.transform =
                    "rotateY(" + curX.toFixed(2) + "deg) rotateX(" + curY.toFixed(2) + "deg)";
                if (Math.abs(targetX - curX) > 0.05 || Math.abs(targetY - curY) > 0.05) {
                    tiltRaf = requestAnimationFrame(tickTilt);
                } else {
                    tiltRaf = 0;
                }
            }

            function onMove(e) {
                if (!visual) return;
                var rect = visual.getBoundingClientRect();
                var nx = ((e.clientX - rect.left) / rect.width) * 2 - 1;
                var ny = ((e.clientY - rect.top) / rect.height) * 2 - 1;
                targetX = Math.max(-1, Math.min(1, nx)) * 7;
                targetY = Math.max(-1, Math.min(1, ny)) * -5;
                if (!tiltRaf) tiltRaf = requestAnimationFrame(tickTilt);
            }

            function onLeave() {
                targetX = 0;
                targetY = 0;
                if (!tiltRaf) tiltRaf = requestAnimationFrame(tickTilt);
            }

            if (visual) {
                visual.addEventListener("pointermove", onMove);
                visual.addEventListener("pointerleave", onLeave);
            }
        }
    }

    // Count-up
    var counters = hub.querySelectorAll("[data-nw-count]");
    function animateCount(el) {
        var target = parseInt(el.getAttribute("data-nw-count"), 10) || 0;
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
