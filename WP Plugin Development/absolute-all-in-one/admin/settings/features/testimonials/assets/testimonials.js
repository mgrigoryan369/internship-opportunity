document.addEventListener('DOMContentLoaded', function () {
	new Swiper('.aaio-testimonials-swiper', {
		loop: true,
		slidesPerView: 1,
		spaceBetween: 20,
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
	});
});