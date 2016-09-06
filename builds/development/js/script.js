

//------------------------------------------
// Document Ready Function
jQuery(document).ready(function(){

});


// Slick Carousel Settings
$('.gallery-responsive').slick({
  dots: false,
  accessibility: true,
  autoplay: true,
  infinite: true,
  speed: 500,
  arrows: false,
  slidesToShow: 5,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 920,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        arrows: false
      }
    },
    {
      breakpoint: 720,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        accessibility: true
      }
    },
    {
      breakpoint: 460,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        arrows: true
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
  