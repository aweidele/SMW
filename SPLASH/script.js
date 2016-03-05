$(document).ready(function() {
  $("#videoLayer video").hide();
  $(window).resize(function() { windowResize(); });
  
  ////// TEMP
  $("#purple").on('keyup',function() {
    //c = parseFloat($("#contentLayer").css('background-color').split(',')[3]);
    newC = 'rgba(38, 18, 140, '+$(this).val()+')';
    //console.log(c);
    $("#contentLayer").css({'background-color':newC});
  });
  $("#swoosh").on('keyup',function() {
    $("#swooshLayer").css({'opacity':$(this).val()});
  });
});

$(window).load(function() {

  $("#videoLayer video").fadeIn(500);
  $vw = $("#videoLayer video").width();
  $vh = $("#videoLayer video").height();
  $vr = $vh / $vw;
  
  windowResize();
});

function windowResize() {
  winW = $(window).width();
  winH = $(window).height();
  winR = winH / winW;
  
  newVW = winW;
  newVH = winW * $vr;
  
  if(newVH < winH) {
    newVH = winH;
    newVW = winH / $vr;
  }
  
  newVX = (winW - newVW) / 2;
  newVY = (winH - newVH) / 2;
  $("#videoLayer").css({
    top:newVY,
    left:newVX
  });
  
  $("#videoLayer video").width(newVW).height(newVH);
  
  //$('.feedback').html(winW+' x '+winH + ' / ' + winR + '<br>' + newVW + ' x ' + newVH + ' / ' + $vr);
}