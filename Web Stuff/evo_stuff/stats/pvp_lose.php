<?php
include ('header.php');
include ('sidebar.php');

?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Player versus Player Lose (PVP)</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
                <table class="datatable paginate full" width="100%" align="center">
                    <thead>
                        <tr>
                        	<th width="12%">Rank</th>
                            <th width="38%">Character</th>
                            <th width="19%">Class</th>
                            <th width="14%">Win</th>
                            <th width="17%">Lose</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
						if(!$dekaron->checkForRenewal('cache/pvp_lose.cache'))
						{
							include ('run_cache/run_pvp_lose.php');
						}
						if(isset($_GET['force_renew']) && $_GET['force_renew'] == 'yes')
						{
							include ('run_cache/run_pvp_lose.php');
						}
						
						
						$cached_file = file_get_contents('cache/pvp_lose.cache');
						$stats_unserialized = unserialize($cached_file);
							 
	  
	  					$dekaron->flushthis();
						$rank = '1';
						
						foreach($stats_unserialized as $key=>$val)
						{
							echo "<tr>";
							if($rank == '1')
							{
								echo '<td align="center"><b><font color="red">1st</font></b></td>';	
							}
							elseif($rank == '2')
							{
								echo '<td align="center"><b><font color="blue">2nd</font></b></td>';
							}
							elseif($rank == '3')
							{
								echo '<td align="center"><b><font color="green">3th</b></font></td>';
							}							
							else
							{
								echo '<td align="center">'.$rank.'</td>';
							}
							echo '<td><a style="color: #000;" href="character.php?character='.$val[0].'">'.$val[0].'</a></td>';
							echo '<td align="center">'.$dekaron->_class($val[3]).'</td>';
							echo '<td align="center">'.$val[1].'</td>';
							echo '<td align="center">'.$val[2].'</td>';
							echo "</tr>";
							
							
							
							$rank ++;
						}
                    ?>
                    </tbody>
                </table>
                <div class="message info">Last cached at <strong><?php echo date ("F d Y H:i:s", filemtime('cache/pvp_lose.cache')); ?></strong></div>
			<div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>
