<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Dekaron Evolution Stats</title>
<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/grid.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />
<link rel="stylesheet" media="screen" href="css/tables.css" />
<!--[if lt IE 8]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<![endif]-->
<!-- jquerytools -->
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/pie.js"></script>
<script type="text/javascript" src="js/ie9.js"></script>
<script type="text/javascript" src="js/ie.js"></script>
<![endif]-->
</head>
<body>
<div id="wrapper">
<header>
  <div class="container_8 clearfix">
    <h1 class="grid_1"> <a href="index.php">ACH</a></h1>
    <nav class="grid_5">
      <ul class="clearfix">
        <li class="action"></li>
        <li><a href="http://www.scampiml.com/evo_stuff/achievements/submit_achievements.html">Add achievement</a></li>
      </ul>
    </nav>
  </div>
</header>
<section>
<div class="container_8 clearfix">
    <table class="datatable paginate sortable full" align="center">
      <thead>
        <tr>
          <th width="36%">Short Text</th>
          <th width="47%">Description</th>
          <th width="10%">Progress Bar</th>
          <th width="7%">Count</th>
        </tr>
      </thead>
      <tbody>
        <?php
                                    @$conn = mysql_pconnect('xxxxxxx','xxxxxxx','xxxxxxx') or die('<div class="message error"><h3>Fatal Error!</h3>Cant connect to the database, please try again later.</div>');
                                    @mysql_select_db('dekaronremote') or die('<div class="message error"><h3>Fatal Error!</h3>Cant select database, please try again later.</div>');
                                    
                                    $query1 = mysql_query('SELECT * FROM form_results ORDER BY id DESC  ');
                                    while ( $use_log = mysql_fetch_array($query1) )
                                    {
                                        echo "<tr>";
                                        echo '<td>'.$use_log['txt'].'</td>';
                                        echo '<td>'.$use_log['desc'].'</td>';
                                        echo '<td align="center">'.$use_log['progress'].'</td>';
                                        echo '<td align="center">'.$use_log['count'].'</td>';
                                        echo "</tr>";
                                    }
                                    ?>
      </tbody>
    </table>
    <?php mysql_close($conn); ?>
    <div>

  </section>
</div>
</body>
</html>
