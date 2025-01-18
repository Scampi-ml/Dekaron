<?php
include ('header.php');
include ('sidebar.php');
?>
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Coins Log</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
                <table class="datatable paginate sortable full" align="center">
                    <thead>
                        <tr>
                            <th>Character</th>
                            <th width="50px">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
					$dekaron->flushthis();
					
					
					$query1 = $dekaron->SQLquery('SELECT user_no,character_name,ip_address,product,intime,id FROM cash.dbo.user_use_log WHERE user_no = '.$_SESSION['USERNO'].' ORDER BY id DESC  ');
					while ( $use_log = $dekaron->SQLfetchArray($query1) )
					{
						echo "<tr>";
						echo '<td>'.$use_log['character_name'].'</td>';
						echo '<td><a href="coins_log_detail.php?id='.$use_log['id'].'" class="button button-gray  help" rel="#overlay">More</a></td>';
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