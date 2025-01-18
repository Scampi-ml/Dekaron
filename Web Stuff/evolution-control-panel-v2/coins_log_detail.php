<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/grid.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />
<link rel="stylesheet" media="screen" href="css/tables.css" />

<!--[if lt IE 8]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<![endif]-->

<!-- jquerytools -->
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript"> jQuery(window).load(function() { jQuery('#loading-image').hide();});</script>




<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/pie.js"></script>
<script type="text/javascript" src="js/ie9.js"></script>
<script type="text/javascript" src="js/ie.js"></script>
<![endif]-->
<?php 
include ('class_dekaron.php');

$dekaron = new dekaron_class();
include ('settings.php');



$dekaron->flushthis();
$GET_ID = $_GET['id'];
if(preg_match('/[^0-9A-Za-z]/', $GET_ID))
{
	echo '<div class="message error"><h3>Error!</h3>Invalid ID</div>';
}
else
{

	$query2 = $dekaron->SQLquery('SELECT * FROM cash.dbo.user_use_log WHERE id = "'.$GET_ID.'" ');
	$use_log = $dekaron->SQLfetchArray($query2);
	echo '
		<table class="datatable full" align="center">
			<thead>
				<tr>
					<th width="50%">Key</th>
					<th width="50%">Value</th>
				</tr>
			</thead>
			<tbody>
				<td>Character Name</td>
				<td>' . $use_log['character_name'] . '</td>					
				</tr>
				<tr>
				<td>Item Name</td>
				<td>' . $use_log['product'] . '</td>					
				</tr>
				<tr>
				<td>Price</td>
				<td>' . number_format($use_log['product_amt']) . '</td>					
				</tr>
				<tr>
				<td>Date</td>
				<td>' . $use_log['intime'] . '</td>
				</tr>
			</tbody>
		</table>
	';
}
?>