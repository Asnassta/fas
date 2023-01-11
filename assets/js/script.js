function tabs(n)
{
  $('.tabs-nav a').removeClass('active');
  $('.tabs-nav a.t'+n).addClass('active');
  $('.tabs-block').fadeOut(0);
  $('.tabs-block.tab_'+n).fadeIn(222);
};

$(document).ready(function() {
	/*======Lang (dropdown)=============*/
  		$(".lang__select").on("click", function() {
  		  $(this).toggleClass('active');
  		  $(".lang__dropdown").slideToggle(333);
  		});
  /*==========/lang (dropdown)=========*/

  /*======Header__nav (dropdown)=============*/
  $(".burger").on("click", function() {
    $(this).toggleClass('active');
    $(".header__nav").slideToggle(333);
  });
  /*==========/header__nav (dropdown)=========*/

  /*======Header__dropdown=============*/
  $(".header__link_drop").hover( function(event) {
    event.preventDefault();
    if ($(window).width() > 992){
      $(this).toggleClass("dropdown");
      $(this).find(".header__dropdown").fadeToggle(222);   
    }
  });
  $(".header__link_drop span").on("click", function(event) {
    event.preventDefault();
    if ($(window).width() <= 992){
      $(this).parent().toggleClass("dropdown");
      $(this).parent().find(".header__dropdown").slideToggle();   
      $(".header__link_drop span").not(this).parent().find(".header__dropdown").slideUp();   
      $(".header__link_drop span").not(this).parent().removeClass('dropdown');   
    }
  });
  /*==========/header__dropdown=========*/

  /*======Footer-menu (dropdown)=============*/
  		$(".footer-menu__title").on("click", function() {
  		  $(this).toggleClass('active');
  		  $(this).next().slideToggle(333);
  		});
  /*==========/footer-menu (dropdown)=========*/

  /*===============Popup=================*/
    $(".open-popup").on("click", function (event) {
        name_pop = $(this).attr('data-popup');
        event.preventDefault();
        $(".popup."+name_pop).fadeIn(333);
        $(".popup."+name_pop+" .popup__inner").fadeIn(333);
        $('body').addClass("hidden");
    });
    $(".popup__close,  .closex").on("click", function (event) {
        event.preventDefault();
        $(".popup").fadeOut('333');
        $(".popup__inner").fadeOut(333);
        $('body').removeClass("hidden");
    });
  /*==============/popup=================*/

  /*==========Sliders========*/
	 $('.links-box__inner').slick({
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  arrows: false,
	  responsive: [
     {
       breakpoint: 993,
        settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
        }
      },
      {
       breakpoint: 769,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: true,
        }
      },
      {
       breakpoint: 547,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
        }
      },
    ]
	});
  /*==========/sliders========*/
});