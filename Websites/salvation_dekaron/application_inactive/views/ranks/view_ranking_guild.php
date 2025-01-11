<?php $this->load->view('./inc/top.php'); ?>
<?php $this->load->view('./inc/topbar.php'); ?>
<?php $this->load->view('./inc/section.php'); ?>
<?php $this->load->view('./inc/header.php'); ?>
<?php $this->load->view('./inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">
    <div class="pages-inner">
    <h2 style="text-align:center" >Guild Ranking</h2>
      <div class="players-table-container">
        <table class="players-table" id="tablesort">
          <thead>
            <tr class="players-row head">
              <th class="players-cell players-cell-no-border-right players-align-center header">No</th>
              <th class="players-cell players-cell-no-border players-align-left header">Guild Name</th>
              <th class="players-cell players-cell-no-border players-align-left header">Level</th>
              <th class="players-cell players-cell-no-border-left players-align-left header">Leader</th>
              <th class="players-cell players-cell-no-border-left players-align-right header">Members</th>
            </tr>
          </thead>
          <tbody>
          <?php
		  	$i = '1';
			$players = $template['players'];
			foreach($players as $player)
			{	
				echo '
				<tr>
				  <td class="players-cell players-cell-no-border players-align-center"> '.$i.'. </td>
				  <td class="players-cell players-cell-no-border players-align-left"><a href="">'.$player['guild_name'].'</a> </td>
				  <td class="players-cell players-cell-no-border players-align-left"> '.$player['guild_Level'].'  </td>
				  <td class="players-cell players-cell-no-border players-align-left">'.$player['guildleader'].' </td>
				  <td class="players-cell players-cell-no-border players-align-right">'.$player['guildcount'].'</td>
				</tr>			
				';
				$i++;
			}		  
		  ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('./inc/footer.php'); ?>