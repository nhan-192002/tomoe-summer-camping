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
    const scrollSpeed = 1; // Pixels per frame
    let scrollDirection = 1; // 1 for right, -1 for left

    function autoMoveImages() {
        // Calculate the max scrollable width
        const maxScroll = $imageList[0].scrollWidth - $(window).width();

        // Update scroll position
        scrollAmount += scrollSpeed * scrollDirection;

        // Reverse direction when reaching boundaries
        if (scrollAmount >= maxScroll || scrollAmount <= 0) {
            scrollDirection *= -1; // Change direction
        }

        // Apply the scroll translation
        $imageList.css("transform", `translateX(-${scrollAmount}px)`);

        requestAnimationFrame(autoMoveImages); // Keep animating
    }

    autoMoveImages(); // Start animation

});


