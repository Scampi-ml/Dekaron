
$(document).ready(function(){
   setTimeout(function(){
  $("div.mydiv").fadeOut("slow", function () {
  $("div.mydiv").remove();
      });

}, 3000);
});
