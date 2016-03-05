$(document).ready(function() { 

  if($('.slideshowContainer').length) {
    $slideSpeed = 3000 + 1000;
    slideshowGo();
  }

});

function slideshowGo() {
  if($('.slideshowSlides li').length > 1) {
    $slide = 0;
    $t = setTimeout(function() { slideshowNext(0); },$slideSpeed);
    $('.slideshowSlides a').on('click',function(e) {
      e.preventDefault();
      clearTimeout($t);
      c = $(this).parents('p').attr('class');
      if(c=='prev') {
        $slide -= 2;
      }
      slideshowNext();
    });
    $('.slideThumbs a').on('click',function(e) {
      e.preventDefault();
      clearTimeout($t);
      $slide = $(this).parent().index();
      $('.slideshowSlides li').removeClass('active');
      $('.slideshowSlides li:eq('+$slide+')').addClass('active');
      $t = setTimeout(function() { slideshowNext(); },$slideSpeed);
    });
  }
}

function slideshowNext() {
  numSlides = $('.slideshowSlides li').length - 1;
  $slide++;
  if($slide > numSlides) {
    $slide = 0;
  }
  if($slide < 0) { $slide = numSlides; }
  console.log($slide);
  $('.slideshowSlides li').removeClass('active');
  $('.slideshowSlides li:eq('+$slide+')').addClass('active');
  $t = setTimeout(function() { slideshowNext(); },$slideSpeed);
}