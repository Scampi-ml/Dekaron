<?php
$html_title = 'Emblem Generator';
?>
<div class="start">Emblem Generator</div>
        <div class="box">
			<div style="text-align: center;">
            	<p>Emblem Generator, created by a unknown 2moons VGM lets you create emblems without having a dekaron / 2moons client. And normal guild members do not have permission in the game to change this. This is the way you can create emblems without guild permission or to have the game running.</p>
                <br />
                <a href="projects/emblem/index.php" target="_blank"><img src="css/images/emblem_preview.png"  /></a>
                <br />
                <br />
                <p style="text-align:center">Click the image for the demo
                <br /><small>(Opens new window)</small></p>
                <p><strong>HINT:</strong> <em>To save your emblem, click "Register" to save it to your computer.</em></p>
                <br>
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
