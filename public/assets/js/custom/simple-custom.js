(function () {
    "use strict";

    window.onload = function () {
        // Preloader JS
        const getPreloaderId = document.getElementById('preloader');
        if (getPreloaderId) {
            getPreloaderId.style.display = 'none';
        }

        try {
            console.log(message)
            if (message) {
                Swal.fire(message.title, message.description, message.type);
            }
        } catch (err) {}

    };

    try {
        feather.replace();
    } catch (error) {
        console.log(error)
    }

    // Init BS Tooltip
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

})();
