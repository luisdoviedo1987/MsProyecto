/* Unsure how to center this without JS :/*/
$(function(){
  $("#sidebar-tab-text").width($("#sidebar").height());
});
$( window ).resize(function() {
  $("#sidebar-tab-text").width($("#sidebar").height());
});
/* End of unsure centering */

//The only necessary piece of code lol
function toggleSidebar(){
    console.log('entro a sidebar')
  $("#sidebar").toggleClass("move-to-left");
  $("#sidebar-tab").toggleClass("move-to-left");
  $("main").toggleClass("move-to-left-partly");
  $(".arrow").toggleClass("active");
}

/* Totally unncessary swyping gestures*/
var gestureZone = document;
var touchstartX = 0, touchstartY = 0;
gestureZone.addEventListener('touchstart', function(event) {
    touchstartX = event.changedTouches[0].screenX;
    touchstartY = event.changedTouches[0].screenY;
}, false);

gestureZone.addEventListener('touchend', function(event) {
    var touchendX = event.changedTouches[0].screenX;
    var touchendY = event.changedTouches[0].screenY;
    handleGesure(touchendX, touchendY);
}, false); 

function handleGesure(touchendX, touchendY) {
    var acceptableYTravel = (touchendY-touchstartY) < 15 && (touchendY-touchstartY) > -15;
  
    var swiped = 'swiped: ';
    if (touchendX < touchstartX && acceptableYTravel) {
        openSidebar();
        console.log(swiped + 'left!');
    }
    if (touchendX > touchstartX  && acceptableYTravel) {
        closeSidebar();
        console.log(swiped + 'right!');
    }
}
function openSidebar(){
  $("#sidebar").addClass("move-to-left");
  $("main").addClass("move-to-left-partly");
  $("#sidebar-tab").addClass("move-to-left");
  $(".arrow").addClass("active");
}
function closeSidebar(){
  $("#sidebar").removeClass("move-to-left");
  $("main").removeClass("move-to-left-partly");
  $("#sidebar-tab").removeClass("move-to-left");
  $(".arrow").removeClass("active");
}
/* End of totally unncessary swyping gestures*/