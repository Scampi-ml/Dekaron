<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $(".head").click(function() {
        $(".body").slideUp(500);
        var obj = $(this).parent();
        if(!$(".body", obj).is(":hidden"))
        return false;
        $(".body", obj).css("visibility", "hidden");
        $(".body", obj).toggle(500, function callback(){
        $(".body", obj).css("visibility", "visible");
        $(".body", obj).fadeOut(0);
        $(".body", obj).fadeIn("slow");
        });
    });
    $(".body").slideUp(500);
});
</script>

<script type='text/javascript'>
var imglist = new Array();
var labels = new Array();
var imgs = new Array();

imglist.push ('img/update/update_00_00_0000.png');
imglist.push ('img/update/update_01_00_0000.jpg');

labels.push('<b>Update [00.00.20]</b><br><br />Update for balancing the Summy and Aloken, and included the Blood Armor Wings into the D-Shop! ');
labels.push('<b>Update [00.00.21]</font></b><br><br />More balancing of the Summy, Reduced damage and increased defence!');

</script>

<script type='text/javascript' src='rotator.js'></script>

<div id='rotator' style='position: relative;'>
<img src='img/spacer.gif' style='align: center'>
</div>