var swiper = new Swiper(".slide-content", {
    slidesPerView: 1,
    spaceBetween: 25, 
     
    loop: false,
    centerSlide: "true",
    fade: "true", 
    grabCursor: "true",
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    navigation: {
        nextEl: ".slider-pagination-next",
        prevEl: ".slider-pagination-prev",
    },

    breakpoints: {
        768: {
            slidesPerView: 1,
        },
        1024: {
            slidesPerView: 2,
        },
        1700: {
            slidesPerView: 3,
        },
    },
   
});

var swiper = new Swiper(".slide-offer", {
    slidesPerView: 1,
    spaceBetween: 25, 
     
    loop: false,
    centerSlide: "true",
    fade: "true", 
    grabCursor: "true",
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    navigation: {
        nextEl: ".pagination-next",
        prevEl: ".pagination-prev",
    },

    breakpoints: {
        768: {
            slidesPerView: 1,
        },
        1024: {
            slidesPerView: 2,
        },
        1700: {
            slidesPerView: 3,
        },
    },
   
});

