<?php
include ('header.php');
include ('sidebar.php');

?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Cache</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
                <table class="datatable full" width="100%" align="center">
                    <thead>
                        <tr>
                        	<th>File</th>
                            <th>Last Cached</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
	  					$dekaron->flushthis();
						$array_files = array('cache/index.cache', 'cache/pvp_win.cache', 'cache/pvp_lose.cache');
						
						foreach ($array_files as $file)
						{
							echo "<tr>";
							echo '<td>'.$file.'</td>';
							echo '<td>'.date ("F d Y H:i:s", filemtime($file)).'</td>';
							$cachetime = '86400'; //one day (24hrs)
							$filetimemod = filemtime($file) + $cachetime;
							$f_date = $filetimemod - time();
							
							$time_left = $dekaron->countPercent($f_date, $cachetime);
							
							echo '<td><div class="progress progress-green"><span style="width: '.$time_left.'%"><b>'.$time_left.'% </b></span></div></td>';
							echo "</tr>";
						}
							
                    ?>
                    </tbody>
                </table>
			<div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>
