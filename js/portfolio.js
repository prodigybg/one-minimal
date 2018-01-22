jQuery(document).ready(function($) { //  ISOTOPE

function ag_masonry() {
    var $grid = $('#portfolio').imagesLoaded(function() {
        $grid.isotope({
            itemSelector: '.portfolio-item',
            layoutMode: 'masonry',
            columnWidth: 15,
            gutter: 15,
            getSortData: {
                category: '[data-category]',
                newest: function(elem1) {
                    var datee = $(elem1).find('.date').text();
                    return Date.parse(datee);
                },
                oldest: function(elem2) {
                    var oldest = $(elem2).find('.date').text();
                    return Date.parse(oldest);
                },
                views: '.views',
                liked: '.sl-count'
            }
        });
    });
}
//   $(window).load(function(){
//     $container = $('#portfolio'); // this is the grid container

//     ag_masonry();

//     // Triggers re-layout on infinite scroll
//     $( document.body ).on( 'post-load', function () {
        
//         // I removed the infinite_count code
//         var $selector = $('.infinite-wrap');
//         var $elements = $selector.find('.portfolio-item');
        
//         /* here is the idea which is to catch the selector whether it contain element or not, if it's move it to the masonry grid. */
//         if( $selector.children().length > 0 ) {
//             $container.append( $elements ).isotope( 'appended', $elements, true );
//             ag_masonry();
//         }
        
//     });
// });

    var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function() {
            var number = $(this).find('.number').text();
            return parseInt(number, 10) > 50;
        },
        // show if name ends with -ium
        ium: function() {
            var name = $(this).find('.name').text();
            return name.match(/ium$/);
        }
    };
    // bind filter button click
    $('#filters').on('click', 'li a', function() {

        var filterValue = $(this).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[filterValue] || filterValue;
        $('#portfolio').isotope({
            filter: filterValue
        });
    });
    // bind sort button click
    $('#sorts').on('click', 'li a', function() {
        var sortValue = $(this).attr('data-sort-value');
        var sortDirection = $(this).attr('data-sort-direction');
        /* convert it to a boolean */
        sortDirection = sortDirection == 'desc';
        $('#portfolio').isotope({
            sortBy: sortValue,
            sortAscending: sortDirection
        });
    });
    // change is-checked class on buttons
    $('.filter-sorting ul').each(function(i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', 'li a', function() {
            $buttonGroup.find('.btn-primary.active').removeClass('btn-primary active');
            $(this).addClass('btn-primary active');
        });
    });
    //tooltip
    // $('[title]').hover(function() {
    //     // Hover over code
    //     var title = $(this).attr('title');
    //     $(this).data('tipText', title).removeAttr('title');
    //     $('<p class="tooltips"></p>').text(title).appendTo('body').fadeIn('slow')
    // }, function() {
    //     // Hover out code
    //     $(this).attr('title', $(this).data('tipText'));
    //     $('.tooltips').fadeOut('slow').remove();
    // }).mousemove(function(e) {
    //     var mousex = e.pageX + 20; //Get X coordinates
    //     var mousey = e.pageY - 10; //Get Y coordinates
    //     $('.tooltips').css({
    //         top: mousey,
    //         left: mousex
    //     })
    // });
    //Lightbox
    // ARROWS

           

    var activityIndicatorOn = function() {
            $('<div id="imagelightbox-loading"><div></div></div>').appendTo('body');
        },
        activityIndicatorOff = function() {
            $('#imagelightbox-loading').remove();
        },
        // OVERLAY
        overlayOn = function() {
            $('<div id="imagelightbox-overlay"></div>').appendTo('body');
        },
        overlayOff = function() {
            $('#imagelightbox-overlay').remove();
        },
         arrowsOn = function( instance, selector )
            {
                var $arrows = $( '<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"><i class="fa fa-chevron-left"></i></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"><i class="fa fa-chevron-right"></i></button>' );

                $arrows.appendTo( 'body' );

                $arrows.on( 'click touchend', function( e )
                {
                    e.preventDefault();

                    var $this   = $( this ),
                        $target = $( selector + '[href="' + $( '#imagelightbox' ).attr( 'src' ) + '"]' ),
                        index   = $target.index( selector );

                    if( $this.hasClass( 'imagelightbox-arrow-left' ) )
                    {
                        index = index - 1;
                        if( !$( selector ).eq( index ).length )
                            index = $( selector ).length;
                    }
                    else
                    {
                        index = index + 1;
                        if( !$( selector ).eq( index ).length )
                            index = 0;
                    }

                    instance.switchImageLightbox( index );
                    return false;
                });
            },
            arrowsOff = function()
            {
                $( '.imagelightbox-arrow' ).remove();
            },
        captionOn = function() {
            var description = $('a[href="' + $('#imagelightbox').attr('src') + '"] img').attr('alt');
            if (description.length > 0) $('<div id="imagelightbox-caption">' + description + '</div>').appendTo('body');
        },
        captionOff = function() {
            $('#imagelightbox-caption').remove();
        };
        var selectorG = 'a[data-imagelightbox="true"]';
   var instanceG = $(selectorG).imageLightbox({
        onStart: function() {
            overlayOn();
            arrowsOn(instanceG, selectorG);
        },
        onEnd: function() {
            captionOff();
            overlayOff();
            arrowsOff();
            activityIndicatorOff();
        },
        onLoadStart: function() {
            captionOff();
            activityIndicatorOn();
        },
        onLoadEnd: function() {
            captionOn();
            activityIndicatorOff();
        }
    });
});