$(document).ready(function() {
    //Navigation
    const navigation = $('.navigation');
    var headerHeight = navigation.outerHeight();

    const menuIcon = $('.navigation-left-mobile');
    const closeMenu = $('.navigation-right-mobile');

    const headerMobile = $('.header-mobile');
    var headerHeightMobile = headerMobile.outerHeight();
    
    const navigationMobile = $('.navigation-mobile');

    const opacityBody = $('.opacityBody');

    menuIcon.on("click", function () {
        closeMenu.show();
        menuIcon.hide();
        headerMobile.addClass('show-header-mobile');
        navigationMobile.addClass('show-nav-mobile');
        opacityBody.addClass('overlay');
    });
    closeMenu.on("click", function () {
        menuIcon.show();
        closeMenu.hide();
        headerMobile.removeClass('show-header-mobile');
        navigationMobile.removeClass('show-nav-mobile');
        opacityBody.removeClass('overlay')
    });

    $(window).on("scroll", function () {
        const currentScrollY = $(window).scrollTop();

        if (currentScrollY > headerHeight) {
            navigation.addClass("hidden");
        } else {
            navigation.removeClass("hidden");
        }
        headerHeight = currentScrollY;
    });

    // Initialize Swiper
    const swiper = new Swiper('.swiper-container', {
        loop: true, // Infinite loop
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 5000, // Auto slide every 5 seconds
            disableOnInteraction: false,
        },
    });


    const swiper2 = new Swiper('.swiper', {
        loop: true, // Infinite loop
        slidesPerView: 2,
        spaceBetween: 20,
        freeMode: true,
        breakpoints: {
            276: {
                slidesPerView: 1,
                spaceBetween: 40,
                freeMode: true,
            },
            576: {
              slidesPerView: 2,
                spaceBetween: 40,
              freeMode: true,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 40,
                freeMode: true,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 40,
                freeMode: true,
            },
        },
        autoplay: {
            delay: 5000, // Auto slide every 5 seconds
            disableOnInteraction: false,
        },
    });
});

// Class Schedule
const locationBlocks = document.querySelectorAll('.location-block');
for(var i = 0; i < locationBlocks.length; i++){
    if(i % 2 == 0){
        locationBlocks[i].classList.add('block-1');
    }
}
