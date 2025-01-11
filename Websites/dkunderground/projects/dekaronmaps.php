<?php
$html_title = 'Dekaron Maps';
?>
<div class="start">Dekaron Maps</div>
        <div class="box">
			<div style="text-align: center;">
            	<p>Dekaron Maps was created by janvier123. This is created so players can find other players or objects or any location on a map using the X and Y coordinates.</p>
                <p><strong>How to use:</strong>
                <br>
                Enter your AXIS X <em>(<small>vertical</small>)</em> and AXIS Y <em>(<small>horizontal</small>)</em> coordinates, select a map and press "Find". 
                <br>
                For advanced location you can change the "marker" and "marker color".
                </p>
  <br />
                <form action="projects/dekaronmaps/image.php" method="post">
                    <fieldset >
                            <label>
                            Marker (Default: X)<br />
                            <input class="text" name="string" type="text" value="X" /> 
                            <br />
                            <br />
                        </label>
                            <label>
                            Color (White = 255-250-250)<br />
                            R <input class="text" name="r" type="text" size="5" value="255" />
                            G <input class="text" name="g" type="text" size="5" value="250" />
                            B <input class="text" name="g" type="text" size="5" value="250" />
                            <br />
                            <br />
                        </label>

                        <label>
                            AXIS Y (Vertical)<br />
                            <input class="text" name="axisy" type="text" /> 512 MAX!
                            <br />
                            <br />
                        </label>
                        <label>
                            AXIS X (Horizontal)<br />
                            <input class="text" name="axisx" type="text" /> 512 MAX!
                            <br />
                            <br />
                        </label>
                        <label>
                            Map<br />
                            <select name="map">
							   <?php
                                if ($handle = opendir('projects/dekaronmaps/png')) {
                                
                                    /* This is the correct way to loop over the directory. */
                                    while (false !== ($file = readdir($handle)))
                                    {
                                        if($file == '.')
                                        {
                                            continue;
                                        }
                                        if($file == '..')
                                        {
                                            continue;
                                        }
                                        echo "<option value='$file'>$file</option>";
                                    }
                                    closedir($handle);
                                }
                                ?>
                            </select>
                            <br />
                            <br />
                        </label>
                        <label>
                            <span class="go"><input name="submit" type="submit" value="Find" /></span><br /><br />
                        </label>
                    </fieldset>
                </form>
                
                <br />
                <br />
                <p style="text-align:center"><small>(Press "find" will open a new window)</small></p>
                <br>
                <p><strong>HINT:</strong> To save your images, Right-Click the image, Save As... and rename your image! </p>
                <p><strong>NOTE:</strong> DO NOT SAVE YOUR IMAGE AS image.php!</p>
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
