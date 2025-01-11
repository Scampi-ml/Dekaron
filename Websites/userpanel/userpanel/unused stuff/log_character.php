<?php
include ('header.php');
include ('sidebar.php');
?>
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Character Log</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
                <table class="datatable paginate sortable full" align="center">
                    <thead>
                        <tr>
                            <th>Character</th>
                            <th>Login</th>
                            <th>Logout</th>
                            <th>Ip Adress</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $dekaron->flushthis(); ?>                    
                    <?php
                        $query1 = $dekaron->SQLquery("SELECT TOP 100 
                          character.dbo.user_character.character_name,
                          character.dbo.CHAR_CONNLOG_KEY.conn_no,
                          character.dbo.CHAR_CONNLOG_KEY.user_no,
                          character.dbo.CHAR_CONNLOG_KEY.login_time,
                          character.dbo.CHAR_CONNLOG_KEY.logout_time,
                          character.dbo.CHAR_CONNLOG_KEY.conn_ip
                        FROM
                         character.dbo.CHAR_CONNLOG_KEY
                         INNER JOIN character.dbo.user_character ON (character.dbo.CHAR_CONNLOG_KEY.character_no = character.dbo.user_character.character_no)
                        WHERE character.dbo.CHAR_CONNLOG_KEY.user_no = '".$_SESSION['USERNO']."' ORDER BY character.dbo.CHAR_CONNLOG_KEY.conn_no DESC");
                        while ( $getLog = $dekaron->SQLfetchArray($query1) ) 
                        {
                            echo "<tr>";
                            echo '<td>'.$getLog['character_name'].'</td>';
                            echo '<td align="center">'.$getLog['login_time'].'</td>';
                            echo '<td align="center">'.$getLog['logout_time'].'</td>';
                            echo '<td align="center">'.$dekaron->decodeIp($getLog['conn_ip']).'</td>';
							
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>