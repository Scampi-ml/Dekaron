<?php
$html_title = 'Deadfront Counter';
?>
<div class="start">Deadfront Counter</div>
        <div class="box">
			<div style="text-align: center;">
            	<p>Deadfront Counter, created by a unknown dekaron member to countdown to the next dead front. This is still a good script and allot of users cant get it to work, so i added / replaced some code in the counter. </p>
                <br />
                <fieldset>
                	<legend>&nbsp;&nbsp; Live Counter &nbsp;&nbsp;</legend>
                    <br>
				<?php include ('projects/deadfront_counter/dfcounter.php'); ?>
                    <br><br>
                </fieldset>
                <br />
                <p><strong>Example: </strong>Dead front times are (24hours based)
                <ul style="text-align:left;">
                	<li>04:00</li>
                    <li>08:00</li>
                    <li>12:00</li>
                    <li>16:00</li>
                    <li>20:00</li>
                </ul>
                </p>
  				<br />
                <p>When the time is up the Deadfront will start with the following message: <b>Deadfront is NOW!!</b></p>
                <br><br>
                <fieldset>
                	<legend>&nbsp;&nbsp; <b>Download</b> &nbsp;&nbsp;</legend>
                    <br>
                    <?php
					$file_info = $dku->get_download_file_info('Patch pack tool'); 
					?>
                    <div style="text-align:left;">
                        <ul>
                            <li><strong class="title">File Size: </strong><?php echo $dku->format_bytes($file_info['file_size']); ?></li>
                            <li><strong class="title">Downloads: </strong><?php echo $file_info['file_downloads']; ?></li>
                        </ul>
                    </div> 
                    <a href=""><img src="css/images/download.png"  /></a>
                    <br> 
                    <br>          
                </fieldset>

            </div>
        </div>
<div class="end"></div>
