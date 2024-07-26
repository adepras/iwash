// Navbar
var lastScrollTop = 0;
$(window).scroll(function () {
    var scrollTop = $(this).scrollTop();
    if (scrollTop > lastScrollTop) {
        $('.navbar').css('top', '-100px');
    } else {
        $('.navbar').css('top', '0');
    }
    lastScrollTop = scrollTop;

    // Show/hide "Back to Top" button
    if (scrollTop > 300) {
        $('#back-to-top').fadeIn();
    } else {
        $('#back-to-top').fadeOut();
    }
});

// "Back to Top" button is clicked
$('#back-to-top').click(function () {
    window.scrollTo({
        top: 0,
        behavior: 'auto'
    });
});
