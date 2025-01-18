<?php
include ('header.php');
include ('sidebar.php');
?>
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Account Log</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
                <table class="datatable paginate sortable full" align="center">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Ip Adress</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $dekaron->flushthis(); ?>                    
                    <?php
                        $query2 = $dekaron->SQLquery("SELECT TOP 100 account,date,ip, id FROM ban_info.dbo.account_login WHERE account LIKE '".$_SESSION['USER']."' ORDER BY id DESC");
                        while ( $getLog2 = $dekaron->SQLfetchArray($query2) ) 
                        {
                            echo "<tr>";
                            echo '<td align="center">'.$getLog2['date'].'</td>';
                            echo '<td align="center">'.$$getLog2['ip'].'</td>';
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