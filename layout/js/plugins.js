(function ($) {// jscs:ignore validateLineBreaks
  'use strict'

  /* ==========================================================================
                   When document is ready, do
 ========================================================================== */
  $(document).ready(function () {
    var slides

    // Owl Carousel - used to create carousels throughout the site
    // http://owlgraphic.com/owlcarousel/
    if ('undefined' !== typeof $.fn.owlCarousel) {

      $('.owlCarousel').each(function () {

        var sliderSelector = '#owlCarousel-' + $(this).data('slider-id') // This is the slider selector
        var sliderItems = $(this).data('slider-items')
        var sliderSpeed = $(this).data('slider-speed')
        var sliderAutoPlay = $(this).data('slider-auto-play')
        var sliderNavigation = $(this).data('slider-navigation')
        var sliderPagination = $(this).data('slider-pagination')
        var sliderSingleItem = $(this).data('slider-single-item')

        //Conversion of 1 to true & 0 to false
        // auto play
        if (0 === sliderAutoPlay || 'false' === sliderAutoPlay) {
          sliderAutoPlay = false
        } else {
          sliderAutoPlay = true
        }

        // Pager
        if (0 === sliderPagination || 'false' === sliderPagination) {
          sliderPagination = false
        } else {
          sliderPagination = true
        }

        // Navigation
        if (0 === sliderNavigation || 'false' === sliderNavigation) {
          sliderNavigation = false
        } else {
          sliderNavigation = true
        }

        // Custom Navigation events outside of the owlCarousel mark-up
        $('.mt-owl-next').on('click', function () {
          $(sliderSelector).trigger('owl.next')
        })
        $('.mt-owl-prev').on('click', function () {
          $(sliderSelector).trigger('owl.prev')
        })

        // Instantiate the slider with all the options
        $(sliderSelector).owlCarousel({
          items: sliderItems,
          slideSpeed: sliderSpeed,
          navigation: false,
          autoPlay: sliderAutoPlay,
          pagination: sliderPagination,
          navigationText: [ // Custom navigation text (instead of bullets). navigationText : false to disable arrows / bullets
            '<i class=\'fa fa-angle-left\'></i>',
            '<i class=\'fa fa-angle-right\'></i>'
          ]
        })

      })

    } // End

    if ($('.mt-blogpost-wrapper').length) {
      slides = $('.mt-blogpost-wrapper').data('slider-items')
      $('.mt-blogpost-wrapper').owlCarousel({
        items: slides,
        lazyLoad: true,
        navigation: true,
        navigationText: [
          ReginaLite.prevText,
          ReginaLite.nextText
        ],
        pagination: false
      })
    }
  })

})(window.jQuery)

//Non jQuery plugins below
