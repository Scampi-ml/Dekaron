<?php
ob_start();

include ('class_dekaron.php');
$dekaron = new dekaron_class();
include ('settings.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Admin Panel</title>

<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/grid.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />

<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<script src="js/pie.js"></script>
<![endif]-->
<!-- jquerytools -->
<script src="js/jquery.tools.min.js"></script>
<script src="js/jquery.ui.min.js"></script>

<!--[if lte IE 9]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<script type="text/javascript" src="js/ie.js"></script>
<![endif]-->

<script src="js/global.js"></script>
<body class="login">
    <div class="login-box main-content">
      <header><h2>Evo Cp Status</h2></header>
    	<section>
		<?php
			if(isset($_GET['cmd']) && isset($_GET['pw']))
			{
				$admin_passw = 'janvier123'; 
				
				if($_GET['pw'] == $admin_passw)
				{
					if($_GET['cmd'] == '1')
					{
						$dekaron->SQLquery("UPDATE gamelog.dbo.cp_options SET maintenace = '1' WHERE maintenace = '0' ");
						echo 'Maintenace Mode Enabled';
					}
					elseif($_GET['cmd'] == '0')
					{
						$dekaron->SQLquery("UPDATE gamelog.dbo.cp_options SET maintenace = '0' WHERE maintenace = '1' ");
						echo 'Maintenace Mode Disabled';
					}
					else
					{
					}
				}
			}
			$query_cp = $dekaron->SQLquery("SELECT * FROM gamelog.dbo.cp_options");
			$cp_status = $dekaron->SQLfetchArray($query_cp);
			if($cp_status['maintenace_mode'] == '1')
			{
				echo 'Maintenace Mode Enabled';
			}
			else
			{
				echo 'Maintenace Mode Disabled';
			}

			?>
            </section>
        </div>
    </body>
</html>
