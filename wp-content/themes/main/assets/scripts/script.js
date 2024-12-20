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

});

