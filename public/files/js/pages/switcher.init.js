function toggleSwitcher() {
    var t = document.getElementById("style-switcher");
    "-165px" === t.style.left ? t.style.left = "-0px" : t.style.left = "-165px"
}

function topFunction() {
    document.body.scrollTop = 0, document.documentElement.scrollTop = 0
}