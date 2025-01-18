<html>
    <head>
    	<title>Dekaron Server Live Maps</title>
		<script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>
        <style>
        html {
            margin:0;
            padding:0;
        }
        .tooltip {
            display:none;
            background:transparent url(images/box.png);
            font-size:11px;
            font-family:verdana;
            padding:5px;
            padding-left: 5px;
            padding-right: 5px;
            padding-top:5px;
            padding-bottom: 5px;
            color:#ccc;	
        }
        #pretty {
            border:0;
            cursor:pointer;
            margin-top:90px;
            margin-bottom:0px;
            margin-right:0px;
            margin-left:48px;
        }
        #map {
            border:0;
            cursor:pointer;
            margin-top:50px;
            margin-bottom:0px;
            margin-right:0px;
            margin-left:50px;
        }
        </style>
    </head>
    <body align="left" leftmargin="0" topmargin="0">
        <br>
        <br>
        <?php
        $mssql_host = "46.251.49.201";
        $mssql_user = "janvier123";
        $mssql_pasw = "00000000000";
        
        $ms_con = mssql_pconnect($mssql_host, $mssql_user, $mssql_pasw) or die(mssql_get_last_message());
        $msdb = mssql_select_db("character", $ms_con);
        $plist = "select c.wPosX as XX, c.WposY as YY, c.character_name as CC FROM character.dbo.user_character c join account.dbo.user_profile p ON c.user_no = p.user_no WHERE c.login_time IN (SELECT max(login_time) FROM character.dbo.user_character GROUP BY user_no) AND p.login_flag = '1100' AND c.character_name > ']' AND c.wMapIndex = 150 ";
        $pplist = mssql_query($plist);
        
        echo "<div align='left' id='map'><img src='images/map/150.jpg' width='512' height='512' border='none' align='left'>";
        
        while($list = mssql_fetch_array($pplist))
        {
            echo "<div id='pretty' style='position: absolute; top: ".$list[XX]."px; width: 1px; left: ".$list[YY]."px; height: 1px; background-color: white'><img src='images/online.png' width='8' height='8' alt='".$list[CC]."' title='<b>".$list[CC]."</b>'></div> ";
            echo "&nbsp;";
        } 
        
        ?>
        </div>
        <script>
            $("#pretty img[title]").tooltip();
        </script>
    </body>
</html>