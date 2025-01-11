<?php
include ('header.php');
include ('sidebar.php');

if(!$dekaron->checkForRenewal('cache/index.cache'))
{
	include ('run_cache/run_index.php');
}
if(isset($_GET['force_renew']) && $_GET['force_renew'] == 'yes')
{
	include ('run_cache/run_index.php');
}


$cached_file = file_get_contents('cache/index.cache');
$stats_unserialized = unserialize($cached_file);

$dekaron->flushthis();
?>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("ajax_suggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>

<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Dekaron Evolution Statistics</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
                <div class="message info ac">
                    <div>Rankings are cached once a day!</div>
                    <div>Last cached at <strong><?php echo date ("F d Y H:i:s", filemtime('cache/index.cache')); ?></strong></div>
                </div>
                <div class="message success">
                    <?php include ('dfcounter.php'); ?> 
                </div> 
				<div class="clear"></div>
                <br />
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <fieldset>
                                <legend>Evo Statistics</legend>
                                <label><strong>Characters</strong></label> <span style="float:right;"><?php echo number_format($stats_unserialized[0]); ?></span><br>
                                <label><strong>Accounts</strong></label> <span style="float:right;"><?php echo number_format($stats_unserialized[1]); ?></span><br>
                                <label><strong>Online</strong></label> <span style="float:right;"><?php echo number_format($stats_unserialized[2]); ?></span><br>
                                <label><strong>Banned</strong></label> <span style="float:right;"><?php echo number_format($stats_unserialized[3]); ?></span><br>
                                <label><strong>Guilds</strong></label> <span style="float:right;"><?php echo number_format($stats_unserialized[4]); ?></span><br>
                            </fieldset>
                        </td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td width="50%" align="left">
                            <fieldset>
                                <legend>Today</legend>
                                <label><strong>New Characters</strong></label><span style="float:right;">112</span><br>
                                <label><strong>New Accounts</strong></label><span style="float:right;">56</span><br>
                            </fieldset>
                        </td>
                    </tr>	
                </table>  
                <br />
                    <form id="form" class="form" method="get" action="character.php">
                    <fieldset>
                        <legend>Character Search</legend>
                        <label>Character Name<small></small></label><input type="text" name="character" maxlength="40" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" />
                        <button class="button button-gray" style="float:right;" type="submit"><span class="accept"></span>Search</button>
                    </fieldset>
                    <div class="suggestionsBox message info" id="suggestions" style="display: none;">
                        <strong>Suggestions</strong> <i>(Click the name to select)</i>
                        <br />
                        <br />
                            <div class="suggestionList" id="autoSuggestionsList">
                                &nbsp;
                            </div>
                    </div>                            
                </form>                 
            </div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>