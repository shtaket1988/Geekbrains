var slideWidth=341;

$(function(){
    $('#slide-left').click(function () {
        prevSlide();
    });

    $('#slide-right').click(function () {
        nextSlide();
    });
});

function nextSlide(){
    var currentSlide=parseInt($('.slidewrapper').data('current'));
    currentSlide++;
    if(currentSlide>=$('.slidewrapper').children().length)
    {
        currentSlide=0;
    }
    $('.slidewrapper').animate({left: -currentSlide*slideWidth},300).data('current',currentSlide);
}

function prevSlide(){
    var currentSlide=parseInt($('.slidewrapper').data('current'));
    currentSlide--;
    if(currentSlide < 0)
    {
        currentSlide= $('.slidewrapper').children().length - 1;
    }
    $('.slidewrapper').animate({left: -currentSlide*slideWidth},300).data('current',currentSlide);
}