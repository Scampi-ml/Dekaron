<?php
$this->output->set_header("Expires: Tue, 01 Jan 2000 00:00:00 GMT"); 
$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false); 
$this->output->set_header("Pragma: no-cache");  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>API Admin</title>
	<style type="text/css">
    body{background:#E1E1E1;color:#000;font:11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;margin:0;padding:0;}a{text-decoration:underline;color:#22229C;}.border{background:#F2F2F2;color:#000;}.action_table{color:#000;padding:0 4px 4px;}.action_title{color:#7C7C7C;font:bold 12px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;padding:2px;}input,option,select,textarea{font:bold 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;}.smallfont{font:10px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;}.curent_version{font:11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;}.last_version a{font:11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;text-decoration:underline;}.cat{background:#425584;color:#FFF;font:bold 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;padding:2px;}.table_panel{background:#fff;color:#000;}.panel_title{background:#6E7A9A;color:#FFF;font:bold 10pt verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;padding:2px;}.panel_title_sub{background:#B0BDD3;font:bold 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;color:#595959;padding:2px 2px 2px 4px;}.panel_title_sub2{background:#B0BDD3;font:bold 11px tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;color:#595959;border:outset 1px #666;padding:2px 2px 2px 4px;}.panel_text_area{padding:10px;}.panel_text_alt_list{height:20px;color:#666;padding:8px 8px 8px 4px;}.panel_buttons{background:#EEE;border-top:outset 1px #666;padding:4px;}input[type=radio]{border:0;}.even{background:#EAEAEA;}.even2{background:#E1E1E1;}.msg_error{background:#F9F2B9;border:1px solid #ccc;text-align:left;margin-bottom:6px;margin-top:6px;font-size:11px;font-weight:700;color:#444;padding:4px 4px 4px 10px;}.rss_feed{padding-left:18px;line-height:23px;font-size:12px;}a:visited,a:hover{text-decoration:none;color:#22229C;}small,blink{color:red;}.panel_text_alt1,.panel_text_alt2{height:20px;padding:8px 8px 8px 4px;}div#wrapper {position:relative;margin-left:auto;margin-right:auto;width:1280px;margin-top:20px;margin-bottom:20px;}.side{background-color:#425584;}.border_big{background:#F2F2F2;color:#000;border-right:outset 1px #DEE0E2;}.cat_big{background:#425584;color:#FFF;font:bold 12px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;padding:4px;}.border_big a{text-decoration:none;color:#fff;}.border_big a:hover{text-decoration:underline;color:#fff;}h3{margin-top:5px;font-size:16px;}.left_table{background:#425584;color:#000;border-right:outset 1px #DEE0E2;padding:0 4px 4px;}.nav_table{background:#6E7A9A;color:#000;}.nav_title{background:#EFEFEF;color:#7C7C7C;font:bold 12px verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif;padding:2px;}.nav_title_sub{background:#fff;color:#FFF;padding:2px 2px 2px 4px;}.action_title_sub{color:#FFF;padding:2px 2px 2px 4px;}.nav_title_sub:hover{background:#F8F8F8;color:#FFF;padding:2px 2px 2px 4px;}.nav_table a:link,.nav_table a:visited,nav_table a:active{text-decoration:none;}.nav_table a:hover{text-decoration:underline;}.maintenance{background-color:#F7F3F7;border:1px #425584 solid;width:600px;margin:4px;padding:2px;}.maintenance .maintenance_title{background-color:#425584;position:relative;font:bold 14px Arial, Helvetica, sans-serif;color:#FFF;padding:4px;}.maintenance .maintenance_reason{font:normal 12px/20px Arial, Helvetica, sans-serif;color:#375264;margin:5px;}.maintenance .maintenance_author{font:normal 12px Arial, Helvetica, sans-serif;color:#375264;padding:4px;}.login,.maintenance{background-color:#F7F3F7;border:1px #425584 solid;width:600px;margin:4px;padding:2px;}.login .login_title{background-color:#425584;position:relative;font:bold 14px Arial, Helvetica, sans-serif;color:#FFF;padding:4px;}.login .login_reason{font:bold 12px/20px Arial, Helvetica, sans-serif;margin:5px;}.login .login_author {font:normal 12px Arial, Helvetica, sans-serif;color:#375264;padding:4px;}
    ul{list-style-type: disc;}
    li {list-style-type: disc; }
	
    </style>
</head>
<body>
<br>
<table width="98%" align="center" class="table_panel">
  <tr>
    <td scope="col" valign="top" >
    
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
            <tr>
                <td align="center" class="panel_title" colspan="1"><h1>Controllers</h1></td>
            </tr>
            <tr>
            	<th class="panel_title_sub2">Controller -> Function</th> 
            </tr>
            <tr>
            <td align="left" class="">
		<?php
        	$ar = array('__destruct','_remap','response','get','options','head','post','put','delete','patch','validation_errors'); 
        
			echo '<ul>';
			foreach($controllerlist as $key=>$val)
			{
				
				if($key == 'admin'){continue;}
				
				echo '<li><a href="'.$key.'">'.ucfirst($key).'</a>';
				foreach($val as $f)
				{
					if(in_array($f, $ar)){continue;}
					echo '<ul>';
						echo '<li><a href="'.$key.'/'.$f.'">'.$f.'</a></li>';
					echo '</ul>';
				}
				echo '</li>';
				
			} 
			echo '</ul>';
       
        ?>
        </td>
        </tr>
		</table>        
    </td>
    <td scope="col" valign="top">
    	<!-- API LOG-->
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
            <tr>
                <td align="center" class="panel_title" colspan="7"><h1>API Logs</h1></td>
            </tr>
            <tr>
                <th class="panel_title_sub2">ID</th> 
                <th class="panel_title_sub2">Controller / Function</th>    
                <th class="panel_title_sub2">Method</th>    
                <th class="panel_title_sub2">Params</th>
                <th class="panel_title_sub2">Ip Address</th>
                <th class="panel_title_sub2">Time</th>
                <th class="panel_title_sub2">Time Ago</th>
            </tr>
            <tr>
                <th>&nbsp;</th>
            </tr>
            <?php echo $table; ?>
        </table>    
    
    </td>
  </tr>
</table>
<br>
<center>Page rendered in {elapsed_time} seconds</center>
</body>
</html>