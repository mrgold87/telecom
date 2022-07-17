jQuery(document).ready(function($){
    $('.tariff-carousel').owlCarousel({
      autoWidth:true,
      loop:true,
      items:4,
      dots:false
});
    $(".slider-carousel").owlCarousel({
        margin:45,
        loop:true,
        items:1,
        dots:false,
        autoplay:true,
        smartSpeed:3000,
        autoplayTimeout:6000,
    });

    $('.form__services a').click(function (e){
        e.preventDefault();
        $('.form__services a').removeClass('form__services-button_active');
        $(this).addClass('form__services-button_active');
        service = $(this).attr('data-service');
        $('#button-service').val(service);
    });

    $('.contact-form-7__acceptance').click(function (){
        $('.contact-form-7__acceptance span').toggleClass('checkbox-on');
    });

});