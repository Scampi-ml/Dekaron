<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dekaron Maps</title>
</head>
<body>

<h1>Dekaron Maps</h1>

						<form action="image.php" method="post">
							<fieldset>
                            		<label>
									Marker (Default: X)<br />
									<input class="text" name="string" type="text" value="X" /> 
									<br />
									<br />
								</label>
                            		<label>
									Color RGB Colors! (White = 255-250-250)<br />
									R <input class="text" name="r" type="text" size="5" value="255" />
                                    G <input class="text" name="g" type="text" size="5" value="250" />
                                    B <input class="text" name="g" type="text" size="5" value="250" />
									<br />
									<br />
								</label>

								<label>
									AXIS Y(Vertical Axis)<br />
									<input class="text" name="axisy" type="text" /> 512 MAX!
									<br />
									<br />
								</label>
                                <label>
									AXIS X (Horizontal Axis)<br />
                                    <input class="text" name="axisx" type="text" /> 512 MAX!
                                    <br />
                                    <br />
								</label>
                                <label>
                                
                                
                                	Map<br />
                                    <select name="map">
                                    
                               <?php
								if ($handle = opendir('png')) {
								
									/* This is the correct way to loop over the directory. */
									while (false !== ($file = readdir($handle))) {
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
									<span class="go"><input name="submit" type="submit" value="Place my butt on the map!" /></span><br /><br />
                                </label>
							</fieldset>
						</form>
</body>
</html>
