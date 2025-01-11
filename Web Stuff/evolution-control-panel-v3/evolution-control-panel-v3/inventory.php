<?php
include ('header.php');
include ('sidebar.php');
include ('items.php');

?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Inventory</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
                 <form action="inventory.php" method="get">
                    <select name="character">
                        <option value="">Select character</option>
                        <?php
                        foreach($_SESSION['CHARACTERS'] as $character)
                        {
							$name_no = explode("-", $character);
							if(isset($_GET['character']) && $_GET['character'] == $name_no[0])
							{
								echo '<option value="'.$name_no[0].'" selected>'.$name_no[1].'</option>';
							}
							else
							{
								echo '<option value="'.$name_no[0].'">'.$name_no[1].'</option>';
							}
                        }
                        ?>
                    </select>
                    <select name="where">
                    	<option value="">Select where</option>
						<?php
                        if(isset($_GET['where']) && $_GET['where'] == 'inventory')
                        {
                        	echo '<option value="inventory" selected>Inventory</option>';
                        }
                        else
						{
							echo '<option value="inventory">Inventory</option>';
						}
						
						if(isset($_GET['where']) && $_GET['where'] == 'store')	
                        {
                        	echo '<option value="store" selected>Personal Store</option>';
                        }
                        else
						{
							echo '<option value="store">Personal Store</option>';
						}
						
						
						if(isset($_GET['where']) && $_GET['where'] == 'storage')
                        {
							echo '<option value="storage" selected>Storage</option>';
                        }
                        else
                        {
                        	echo '<option value="storage">Storage</option>';
                        }			
                        ?>
                    </select>
                    
                    <button type="submit" class="button button-gray" style="padding-top: 1px;">Get items</button>
                </form>
				 <?php
                    if(isset($_GET['character']) && $dekaron->isValid($_GET['character']) == true && strlen($_GET['character']) == '18' )
                    {
						if(isset($_GET['where']))
						{
							?>
							<br />
                            <br />
							<table class="datatable full" align="center">
								<thead>
									<tr>
										<th>Item </th>
										<th width="100px">Detail</th>
									</tr>
								</thead>
								<tbody>
							<?php	
							//$dekaron->flushthis();	
							if($_GET['where'] == 'inventory')
							{
								$where = 'user_bag';
								$query4 = $dekaron->SQLquery("SELECT * FROM character.dbo.".$where." WHERE character_no = '".$_GET['character']."' ");
								while($getStats = $dekaron->SQLfetchArray($query4))
								{
									echo "<tr>";
									echo '<td >'.$items[$getStats['wIndex']].'</td>';
									echo '<td align="center"><a href="inventory_detail.php?windex='.$getStats['wIndex'].'&info='. strtoupper(bin2hex($getStats['info'])).'&serial='. strtoupper(bin2hex($getStats['dwSerialNumber'])).'" class="button button-gray  help" rel="#overlay">More</a></td>';
									echo "</tr>";
								}									
								
							}
							elseif($_GET['where'] == 'store')
							{
								$where = 'user_store';
								$query4 = $dekaron->SQLquery("SELECT * FROM character.dbo.".$where." WHERE character_no = '".$_GET['character']."' ");
								while($getStats = $dekaron->SQLfetchArray($query4))
								{
									echo "<tr>";
									echo '<td >'.$items[$getStats['wIndex']].'</td>';
									echo '<td align="center"><a href="inventory_detail.php?windex='.$getStats['wIndex'].'&info='. strtoupper(bin2hex($getStats['info'])).'&serial='. strtoupper(bin2hex($getStats['dwSerialNumber'])).'" class="button button-gray  help" rel="#overlay">More</a></td>';
									echo "</tr>";
								}									
								
							}
							else
							{
								$where = 'user_storage';
								$query4 = $dekaron->SQLquery("SELECT * FROM character.dbo.".$where." WHERE character_no = '".$_GET['character']."' ");
								while($getStats = $dekaron->SQLfetchArray($query4))
								{
									echo "<tr>";
									echo '<td >'.$items[$getStats['wIndex']].'</td>';
									echo '<td align="center"><a href="inventory_detail.php?windex='.$getStats['wIndex'].'&info='. strtoupper(bin2hex($getStats['info'])).'&serial='. strtoupper(bin2hex($getStats['dwSerialNumber'])).'" class="button button-gray  help" rel="#overlay">More</a></td>';
									echo "</tr>";
								}									
							}
							
							?>
								</tbody>
							</table>
                        <?php

							
						}
                    }
                ?>
			<div>
        </section>
    </div>
</section>

<?php include ('footer.php'); ?>