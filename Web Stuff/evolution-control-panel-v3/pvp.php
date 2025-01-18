<?php
include ('header.php');
include ('sidebar.php');
?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>PVP</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
                 <form action="pvp.php" method="get">
                    <select name="character">
                        <option value="">Select character</option>
                        <?php
                        foreach($_SESSION['CHARACTERS'] as $character)
                        {
                            $name_no = explode("-", $character);
                            echo '<option value="'.$name_no[0].'">'.$name_no[1].'</option>';
                        }
                        ?>
                    </select>
                    <button type="submit" class="button button-gray" style="padding-top: 1px;">Get pvp stats</button>
                </form>
				 <?php
                    if(isset($_GET['character']) && $dekaron->isValid($_GET['character']) == true && strlen($_GET['character']) == '18' && !preg_match('/[^0-9A-Za-z]/', $_GET['character']))
                    {
                        $dekaron->flushthis();							
                        $query4 = $dekaron->SQLquery("SELECT wWinRecord,wLoseRecord,character_no,character_name FROM character.dbo.user_character WHERE character_no = '".$_GET['character']."' ");
                        while($getPvp = $dekaron->SQLfetchArray($query4))
                        {
							$total_pvp = $getPvp['wWinRecord'] + $getPvp['wLoseRecord'];
                            echo '
                            </div>
							<br>
							<br><br>
							<div class="message info ac"><h3>'.$getPvp['character_name'].' Player VS Player Stats</h3></div>
                            <div class="clear"></div>
                            <br>
                                <center>	
                                    <figure class="grid_2 ac">
                                        <h3 style="color: #FFFFFF;">Won</h3>
                                        <h1 style="color: #FFFFFF;">'.$getPvp['wWinRecord'].'</h1>
                                    </figure>
                                    <figure class="grid_2 ac">
                                        <h3 style="color: #FFFFFF;">Lost</h3>
                                        <h1 style="color: #FFFFFF;">'. $getPvp['wLoseRecord'].'</h1>
                                    </figure>
                                    <figure class="grid_2 ac">
                                        <h3 style="color: #FFFFFF;">Total</h3>
                                        <h1 style="color: #FFFFFF;">'.$total_pvp.'</h1>
                                    </figure> 
                                </center>
                        ';                                                      

                        }
                    }
                    else
                    {}
                ?>
			<div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>