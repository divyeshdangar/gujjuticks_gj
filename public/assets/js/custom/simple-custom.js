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
			if(message){
				Swal.fire(message.title, message.description, message.type);
			}
		} catch (err) { }

	};

	try {
		feather.replace();		
	} catch (error) {
		console.log(error)
	}

})();
