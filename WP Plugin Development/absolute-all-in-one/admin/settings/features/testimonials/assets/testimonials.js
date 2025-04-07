document.addEventListener('DOMContentLoaded', function () {

    const container = document.querySelector('.aaio-testimonials-swiper');

	if (!container) return;

	const totalSlides = container.querySelectorAll('.swiper-slide').length;

    new Swiper(container, {
		loop: totalSlides > 1,
		slidesPerView: 1,
		spaceBetween: 20,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});

    //console.log("Our own swiper initialization loaded...");

});

