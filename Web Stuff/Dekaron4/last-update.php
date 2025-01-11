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

imglist.push ('img/update/update_00_00_0000.jpg');
imglist.push ('img/update/update_01_00_0000.jpg');

labels.push('<b>Update [00-00-0000]</font></b><br><br />Nullam molestie sodales urna ac elementum. In tempus tincidunt nisl. Maecenas pretium enim sed massa fermentum venenatis. Curabitur vel fringilla dui. Curabitur fringilla blandit lobortis. Praesent nibh nunc, pharetra porta tempus a, mattis et enim. Integer arcu est, blandit eu tincidunt ut, mattis nec magna. Sed bibendum ante ac felis auctor ultricies. Aenean ac porta purus. Aliquam varius ullamcorper orci, vel pharetra turpis dignissim vel.');
labels.push('<b>Update [01-00-0000]</b><br><br />Nullam molestie sodales urna ac elementum. In tempus tincidunt nisl. Maecenas pretium enim sed massa fermentum venenatis. Curabitur vel fringilla dui. Curabitur fringilla blandit lobortis. Praesent nibh nunc, pharetra porta tempus a, mattis et enim. Integer arcu est, blandit eu tincidunt ut, mattis nec magna. Sed bibendum ante ac felis auctor ultricies. Aenean ac porta purus. Aliquam varius ullamcorper orci, vel pharetra turpis dignissim vel.');
</script>

<script type='text/javascript' src='rotator.js'></script>

<div id='rotator' style='position: relative;'>
<img src='img/spacer.gif' style='align: center'>
</div>