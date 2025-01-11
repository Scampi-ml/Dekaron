<?php
if ($_GET['action'] == 'download')
{
	flush_this();
	
	$remote_crc = file_get_contents('http://www.dkunderground.org/dac_remote/md5_file_list.dat');
	$local_temp_crc = "temp/md5_file_list.dat";
	
	if(file_exists($local_temp_crc))
	{
		unlink($local_temp_crc);
	}
	
	$file = fopen($local_temp_crc, 'w');
	fwrite($file, $remote_crc);
	fclose($file);
	
	echo notice_message_admin('Remote MD5 File list successfully downloaded, scanning dac now...', '1', '0', 'index.php?get=module_file_scan');
	die();
}

if (checkForRenewal() == 'needed')
{
	echo notice_message_admin('Downloading updated file list...', '1', '0', 'index.php?get=module_file_scan&action=download');
	die();
}

if (file_exists('temp/md5_file_list.dat'))
{
	?>
    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
        <tr>
            <td align="center" class="panel_title" colspan="2">File Scan</td>
        </tr>
        <tr> 
            <td align="left" class="panel_title_sub2" width="50%">File</td>
            <td align="left" class="panel_title_sub2" width="50%">Result</td>  
        </tr> 
        <?php   
            flush_this(); 
            $count = 0;
            
            $remote_crc = "temp/md5_file_list.dat";
            
            $lines = file($remote_crc);
            if ($lines)
            {
                foreach ($lines as $line_num => $line)
                {
                    $good_line = explode(',', $line);
					if(preg_match("/servers/", $good_line[0]))
					{
						continue;	
					}
					elseif(preg_match("/temp/", $good_line[0]))
					{
						continue;	
					}
					elseif($good_line[0] == './'.$remote_crc)
					{
						continue;
					}
					else
					{
						$current_file = @md5_file($good_line[0]);
					}
                    
                    
                    if(trim($current_file) == trim($good_line[1]))
                    {
                        continue;	
                    }
                    else
                    {
						$count++;
                   		$tr_color = ($count % 2) ? '' : 'even';
                        echo "<tr class='" . $tr_color . "' >";
                        echo "<td align='left' class='panel_text_alt_list' width='50%'>".$good_line[0]."</td>";
						
						if(!file_exists($good_line[0]))
						{
							echo "<td align='left' class='panel_text_alt_list' width='50%'><font color='red'><b>File not found!</b></font></td>";
						}
						else
						{
							echo "<td align='left' class='panel_text_alt_list' width='50%'><font color='red'><b>File does not match!</b></font></td>";
						}
                        echo "</tr>"; 
                    }	
                }
				if($count == '0')
				{
					echo '<tr><td align="center" class="panel_buttons" colspan="2"><p><font color="green"><b>All files passed!</b></font></p></td></tr>';
				}						
            } 
        ?>
    </table>
	<?php
}
?>