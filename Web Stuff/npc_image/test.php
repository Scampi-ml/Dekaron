<?php
header("Content-type: image/png"); 
        // Insert your MYSQL info here 
		
            $mysql = array( 
            'host' => "localhost", 
            'user' => "root", 
            'pass' => "", 
            'db'   => "mobs" // Do not change it the DB is vote
            ); 
			
       		$mylink = mysql_connect($mysql['host'], $mysql['user'], $mysql['pass']) or die(mysql_error());
       		mysql_select_db($mysql['db'],$mylink); 



		$result2 = mysql_query("SELECT * FROM 03_deneb");
		$string = "X";	
		$map = "minimap_deneb.png";
		$im     = imagecreatefrompng($map); // the map	
		$color  = imagecolorallocate($im, 255, 250, 250); // colors WHITE
		$colorY = imagecolorallocate($im, 255, 255, 0); // colors YELLOW
		$colorR = imagecolorallocate($im, 255, 0, 250); // colors RED
		$colorB = imagecolorallocate($im, 0, 0, 255); // colors BLUE
		$colorG = imagecolorallocate($im, 0, 255, 0); // colors GREEN
		$colorP = imagecolorallocate($im, 255, 0, 255); // colors PINK
			

		//while ($row = mysql_fetch_row($result2)){
		
		//imagestring($im, 5, $row[3], $row[4], $string, $colorY);
		
		
		imagestring($im, 10, 114, 236, $string, $color);
		
		//}    
   
    imagepng($im); 
    imagedestroy($im); 
	//var_dump($result2);


?>