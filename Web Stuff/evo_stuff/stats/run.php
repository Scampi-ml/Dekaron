<?php
include ('header.php');
include ('sidebar.php');


?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Player versus Player</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            <?php
			
						$query1 = $dekaron->SQLquery("SELECT * FROM character2.dbo.user_character WHERE character_name LIKE '%{L}%' ");
						while ( $pvp = $dekaron->SQLfetchArray($query1) )
						{
							$name_no = explode("{L}", $pvp['character_name'] );
                            echo ''.$pvp['character_name'].' - '.$name_no[1].'<br>';
							$dekaron->SQLquery("UPDATE character2.dbo.user_character SET character_name = '".$name_no[1]."' WHERE character_name = '".$pvp['character_name']."' ");

						}
			

         	?>
			<div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>