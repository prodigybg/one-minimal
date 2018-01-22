/**
 * Main theme Javascript - Alexander Georgiev (www.ageorgiev.com)
 */
function init() {
    var vidDefer = document.getElementsByTagName('iframe');
    for (var i = 0; i < vidDefer.length; i++) {
        if (vidDefer[i].getAttribute('data-src')) {
            vidDefer[i].setAttribute('src', vidDefer[i].getAttribute('data-src'));
        }
    }
}
window.onload = init;
jQuery(document).ready(function($) {
    $('.site-title a').text('Alexander Georgiev');
    $('[title]').tooltip();
    $('a[title]').click(function() {
        $('.tooltip-inner').html('Loading...');
    });
    $('a').has('img.img-fluid').css('display', 'block');
    //boostrap
    $('.pagination li').addClass('page-item');
    $('.pagination li a').addClass('page-link');
    //header
    $('a[href="#featured-projects"], a[href="#about"], a[href="#contact"]').on('click', function(e) {
        e.preventDefault();
        var target = this.hash;
        var $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing', function() {
            window.location.hash = target;
        });
    });
    $(document).scroll(function() {
        var y = $(this).scrollTop();
        if (y > $('html').height() / 3) {
            $('#to-top').fadeIn();
        } else {
            $('#to-top').fadeOut();
        }
    });
    $('#to-top').click(function() {
        $('html,body').animate({
            scrollTop: 0
        }, 'slow');
        return false;
    });
    // Setup fitvids for entry content and panels
    if (typeof $.fn.fitVids != 'undefined') {
        $('.entry-content, .entry-content .panel').fitVids();
    }
    //sticky nav
    $(window).scroll(function() {
        if ($(window).scrollTop() >= 250) {
            $('.site-header').addClass('smaller');
            $('#header_holder').css({
                display: 'block'
            });
        } else {
            $('.site-header').removeClass('smaller');
            $('#header_holder').css({
                display: 'none'
            });
        }
    });
    //articles footer menu
var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel" //FF doesn't recognize mousewheel as of FF3.x
$('body').bind(mousewheelevt, function(e){

    var evt = window.event || e //equalize event object     
    evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible               
    var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta //check for detail first, because it is used by Opera and FF

    if(delta > 0) {
        $('.post-footer').addClass('visible');
    }
    else{
       $('.post-footer').removeClass('visible');
    }   
});
    //responsive nav menu button
    var pull = $('#pull');
    var tags = false;
    menu = $('.main-navigation ul');
    $(pull).click(function(e) {
        e.preventDefault();
        pull.children('i').toggleClass('fa-bars');
        pull.children('i').toggleClass('fa-times');
        menu.slideToggle();
    });
    //overlay black
    pull.click(function() {
        if (tags == false) {
            addHTML();
            tags = true;
        } else {
            removeHTML();
            tags = false;
        }
        return false;
    });

    function addHTML() {
        $('#site-footer').append('<div class="overlay-lay"></div>');
    }

    function removeHTML() {
        $('.overlay-lay').remove();
    }
    $('.wpcf7-submit').addClass('btn btn-primary');
    // Menu search bar
    $(document).on('click', '#search-icon', function() {
        var $$ = $(this).parent();
        $$.find('form').fadeToggle(250);
        setTimeout(function() {
            $$.find('input[name=s]').focus();
        }, 300);
    });
    // Scroll to top
    $(window).scroll(function() {
        if ($(window).scrollTop() > 250) {
            $('#scroll-to-top').addClass('displayed');
        } else {
            $('#scroll-to-top').removeClass('displayed');
        }
    });
    $('#scroll-to-top').click(function() {
        $("html, body").animate({
            scrollTop: "0px"
        });
        return false;
    });
    // Skill Bars
    $('.skillbar').each(function() {
        $(this).find('.skillbar-bar').animate({
            width: $(this).attr('data-percent')
        }, 4000);
    });
    //POPUP
    if (localStorage.getItem('popup') !== 'true') {
        $(window).scroll(function() {
            if ($(window).scrollTop() > $('body').height() / 3) {
                $('#popup').fadeIn(), '3000';
            }
        });
        localStorage.setItem('popup', 'true');
    }
    $('#popup .close-button').on('click', function() {
        $('#popup').remove();
    });
    $('.all-testimonials').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplayTimeout: 4500,
        autoplayHoverPause: true,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
        768: {
                items: 2
            },
            993: {
                items: 3
            }
        }
    })
    $('.owl-prev, .owl-next').text(' ');
    $('.portfolio-images').owlCarousel({
        items: 1,
        margin: 0,
        nav: true,
        autoHeight: true,
        dots: true,
        dotsData: true,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
    });
    jQuery('small').text(jQuery('small').text());
});