<div style='padding: 20px 20px 20px 20px; text-align: justify;'>
<b><i><u>Top 20 List:</b></i></u>
<select class="target" id="drop1">
    <option value="">Choose One</option>
    <option value="http://deaddekaron.com/toplists/topguild.php">Top 20 Guilds</option>
    <option value="http://deaddekaron.com/toplists/toppvp.php">Top 20 Pvp</option>
    <option value="http://deaddekaron.com/toplists/toppk.php">Top 20 Pk</option>
    <option value="http://deaddekaron.com/toplists/topplayers.php">Top 20 Players</option>
</select>
<br /><br />

<b><i><u>Server Statistics:</b></i></u>
<select class="target" id="drop2">
    <option value="">Choose One</option>
    <option value="http://deaddekaron.com/toplists/totalchar.php">Total Chars</option>
    <option value="http://deaddekaron.com/toplists/totaldelchar.php">Total Deleted Chars</option>
    <option value="http://deaddekaron.com/toplists/totalstorage.php">Total Storage</option>
    <option value="http://deaddekaron.com/toplists/totalstore.php">Total Shop</option>
    <option value="http://deaddekaron.com/toplists/totalcostumes.php">Total Costumes</option>
</select>
<br /><br />
</div>


<script>
$('.target').change(function() {
    var id = $(this).attr('id');
    var url = $("#" + id).val()
        
    if(!url) return;
        
    window.location = url;
});
</script>