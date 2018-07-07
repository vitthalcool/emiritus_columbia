$(document).ready(function(){

var maxHeight = 0;

$("fieldset").each(function(){
   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
});

$("fieldset").height(maxHeight);

// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });

	
$(function(){
  $("fieldset > p").each(function(i){
    len=$(this).text().length;
    if(len>50)
    {
  var yourString  = $(this).text();
  var maxLength  =60 // maximum number of characters to extract

  //trim the string to the maximum length
  var trimmedString = yourString.substr(0, maxLength);

  //re-trim if we are in the middle of a word
  trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))
       $(this).text(trimmedString+'...');
    }
  });
});
	function resetSlick($slick_slider, settings) {
		$(window).on('resize', function() {
			if ($(window).width() < 320) {
				if ($slick_slider.hasClass('slick-initialized')) {
					$slick_slider.slick('unslick');
				}
				return
			}

			if (!$slick_slider.hasClass('slick-initialized')) {
				return $slick_slider.slick(settings);
			}
		});
	}

	slick_slider = $('.faculty-slider');
	settings = {
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,
		arrows: true,
		pauseOnHover: true,

		responsive: [
		{
			breakpoint: 1024,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 1,
			}
		},
		{
			breakpoint: 1000,
			settings: {
				slidesToShow: 2,
				slidesToScroll: 1,
			}
		},
		{
			breakpoint: 550,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
			}
		}
		]
	};
	slick_slider.slick(settings);
	resetSlick(slick_slider, settings);

	
});