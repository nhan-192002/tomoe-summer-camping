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

    const $imageList = $(".camping-image-list");

    let scrollAmount = 0;
    const scrollSpeed = 1;
    let scrollDirection = 1;

    function autoMoveImages() {
        const maxScroll = $imageList[0].scrollWidth - $(window).width();
        scrollAmount += scrollSpeed * scrollDirection;

        if (scrollAmount >= maxScroll || scrollAmount <= 0) {
            scrollDirection *= -1;
        }
        $imageList.css("transform", `translateX(-${scrollAmount}px)`);

        requestAnimationFrame(autoMoveImages); // Keep animating
    }

    autoMoveImages();

});


