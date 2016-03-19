var $ = jQuery;
$(document).ready(function() {
  if($("#homepageVideo").length) { homepageVideo(); }
  if($("a[data-action='leadership']").length) { leadershipPopup(); }
});

$(window).load(function() {

  if( $('.slideshowContainer').length ) { slideshowInit(); }


});

function slideshowNext(slideshow) {
  count = slideshow.count;
  ssID = '#'+slideshow.id;
  slideTo = (-100 * count)+'%';
  newLeft = (100 * count)+'%';
  slideTotal = $(ssID+' .slide').length;
  currentSlide = count % slideTotal;
  
  $(ssID+' .slide:eq('+currentSlide+')').css({ left: newLeft });
  $(ssID+' .slideshowSlider').css({ left:slideTo });
  $(ssID+' .slideshowControls li').removeClass('active');
  $(ssID+' .slideshowControls li:eq('+currentSlide+')').addClass('active');

  slideshow.count++;
}

function slideshowInit() {

  var slideshows = {};
  $('.slideshowContainer').each(function() {
    if($('.slide',this).length > 1) {
      thisID = $(this).attr('id');
      slideshows[thisID] = {id: thisID, count: 1, interval: {}  };
    }
  });
  slideshowInterval = setInterval(function() {
    for(var key in slideshows) {
      slideshowNext(slideshows[key]);
    }
  },3000);
}


function videoResize() {
  winW = $("#homepageVideo").width();
  winH = $("#homepageVideo").height();
  winR = winH / winW;

  newVW = winW;
  newVH = winW * $vr;

  if(newVH < winH) {
    newVH = winH;
    newVW = winH / $vr;
  }

  newVX = (winW - newVW) / 2;
  newVY = (winH - newVH) / 2;
  $("#homepageVideo .videoLayer").css({
    top:newVY,
    left:newVX
  });

  $("#homepageVideo video").width(newVW).height(newVH);
}

function homepageVideo() {
  $("#homepageVideo video").hide();
  
  $(".contentLayer .jumplink a").on("click",function(e) {
    e.preventDefault();
    h = $(this).attr("href");
    o = $(h).offset().top - $(".fixedTop").height();
    $("body,html").animate({ scrollTop: o },500);
  });
  
  $(window).load(function() {
    $("#homepageVideo video").fadeIn(500);
    $vw = $("#homepageVideo video").width();
    $vh = $("#homepageVideo video").height();
    $vr = $vh / $vw;
    
    $(window).resize(function() { videoResize(); });
    videoResize();
    
  });
}

function leadershipPopup() {
  $("body").append('<aside id="leadershipPopup"><div class="leadershipPopupContainer"><div class="leadershipPopupContent"></div><div class="leadershipPopupClose"><button><span>Close</span></button></div></div></aside>');
  $("a[data-action='leadership']").on('click',function(e) {
    e.preventDefault();
    h = $(this).attr('href') + ' .leadershipBio';
    o = $(this).parents('section').offset().top;
    $('#leadershipPopup .leadershipPopupContent').load(h,function() {
      $('#leadershipPopup').css({ top:o }).fadeIn(250);
    });
  });
  $(".leadershipPopupClose button").on('click',function(e) {
    e.preventDefault();
    $('#leadershipPopup').fadeOut(250);
  });
}