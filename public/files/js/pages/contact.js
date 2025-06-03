function fadeIn() {
    var e = document.getElementById("error-msg"),
        t = 0,
        n = setInterval(function () {
            t < 1 ? (t += .5, e.style.opacity = t) : clearInterval(n)
        }, 200)
}
