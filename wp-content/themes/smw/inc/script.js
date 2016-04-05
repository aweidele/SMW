var $ = jQuery;
$(document).ready(function() {
  if($("#homepageVideo").length) { homepageVideo(); }
  if($("a[data-action='leadership']").length) { leadershipPopup(); }
  if($('.tiled').length) { tiledGo(); }
});

$(window).load(function() {

  if( $('.slideshowContainer').length ) { slideshowInit(); }


});

function slideshowInit() {
  $slideshows = {};
  $('.slideshowContainer').each(function() {
    ssid = $(this).prop('id');
    total = $('.slideshowSlider .slide',this).length;
    $slideshows[ssid] = {id: ssid, total: total, current: 0, count: 0};
  });
  console.log($slideshows);

  $('.slideshowControls .prevNext li').on('click',function() {
    dir = $(this).index() ? 1 : -1;
    ssid = $(this).parent().data('slideshow');
    slideshowNexPrev(ssid,dir);
  });
  $('.slideshowControls .slideshowIndicators li').on('click',function() {
    ssid = $(this).parent().data('slideshow');
    current = $(this).index();
    slideshowJumpto(ssid,current);
  });
}

function slideshowNexPrev(ssid,dir) {
  $slideshows[ssid].count += dir;
  $slideshows[ssid].current += dir;
  if($slideshows[ssid].current < 0) { $slideshows[ssid].current = $slideshows[ssid].total - 1; }
  if($slideshows[ssid].current >= $slideshows[ssid].total) { $slideshows[ssid].current = 0; }
  slideshowAdvance(ssid);
}

function slideshowJumpto(ssid,current) {
//  if(current > $slideshows[ssid].current) {
    $slideshows[ssid].count++;
//  } else {
//    $slideshows[ssid].count--;
//  }
  $slideshows[ssid].current = current;
  slideshowAdvance(ssid);
}

function slideshowAdvance(ssid) {
  count = $slideshows[ssid].count;
  current = $slideshows[ssid].current;
  left = (count * -100) + '%';
  right = (count * 100) + '%';
  
  $('#'+ssid+' .slideshowSlider').css({left:left,right:right});
  $('#'+ssid+' .slideshowSlider .slide:eq('+current+')').css({left:right});
  $('#'+ssid+' .slideshowIndicators li').removeClass('active');
  $('#'+ssid+' .slideshowIndicators li:eq('+current+')').addClass('active');
}

function homepageVideo() {
  $("#homepageVideo video").hide();
  
  $(".contentLayer .jumplink a").on("click",function(e) {
    e.preventDefault();
    h = $(this).prop("href");
    o = $(h).offset().top - $(".fixedTop").height();
    $("body,html").animate({ scrollTop: o },500);
  });
  
  $(window).load(function() {
    $("#homepageVideo video").fadeIn(500);
    $vw = $("#homepageVideo video").width();
    $vh = $("#homepageVideo video").height();
    $vr = $vh / $vw;
    
//     $(window).resize(function() { videoResize(); });
//     videoResize();
    
  });
}

function leadershipPopup() {
  $("body").append('<aside id="leadershipPopup"><div class="leadershipPopupContainer"><div class="leadershipPopupContent"></div><div class="leadershipPopupClose"><button><span>Close</span></button></div></div></aside>');
  $("a[data-action='leadership']").on('click',function(e) {
    e.preventDefault();
    h = $(this).prop('href') + ' .leadershipBio';
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

function tiledGo() {
  $('.tiled').addClass('go');
  $(window).on('load resize',function() { tiledResize(); });
  tiledResize();
}

function tiledResize() {
  
  // DETERMINE NUMBER OF COLUMNS
  smallest = Infinity;
  largest = 0;
  container = $('.tile').parent().width();
  $('.tiled .tile').each(function() {
    w = $(this).width();
    if(w < smallest) { smallest = w; }
    if(w > largest) { largest = w; }
  });
  numcols = Math.round(container / smallest);

  columns = new Array(); 
  for(i=0;i<numcols;i++) {
    columns.push(0);
  }
  
  gutter = (container - (smallest * numcols)) / (numcols - 1); /* the space between columns */
  colwidth = gutter + smallest;
  
  // ASSIGN TILE TO CORRECT SPACE
  $('.tiled .tile').each(function() {
    w = $(this).width();
    h = $(this).height() + 30;
    s = Infinity;
    
    if(w > smallest) {
      l = numcols - 1;
    } else {
      l = numcols;
    }
    
    for(i=0;i<l;i++) {
      if(columns[i] < s) {
        scol = i;
        s = columns[i];
      }
    }
    
    $(this).css({ 
      left: scol * colwidth,
      top: columns[scol]
    });
    columns[scol] += h;
    if(w > smallest) {
      columns[scol + 1] += h;
    }
    
  });
  
  tallest = 0;
  for(i=0;i<numcols;i++) {
    if(columns[i] > tallest) {
      tallest = columns[i];
    }
  }
  
  $('.tile').parent().height(tallest);
  console.log(columns); 
  $('#feedback').html($(window).width() + '<br>' + smallest + ' / ' + largest + ' / ' + container + ' / ' + numcols + ' / ' + gutter);
}