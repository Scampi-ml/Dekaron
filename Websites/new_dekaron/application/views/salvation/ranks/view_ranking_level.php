<?php $this->load->view('./inc/top.php'); ?>
<?php $this->load->view('./inc/topbar.php'); ?>
<?php $this->load->view('./inc/section.php'); ?>
<?php $this->load->view('./inc/header.php'); ?>
<?php $this->load->view('./inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">
    <div class="pages-inner">
    <h2 style="text-align:center" >Level Ranking</h2>
      <div class="players-table-container">
        <table class="players-table" id="tablesort">
          <thead>
            <tr class="players-row head">
              <th class="players-cell players-cell-no-border-right players-align-center header">No</th>
              <th class="players-cell players-cell-no-border players-align-left header">Name</th>
              <th class="players-cell players-cell-no-border players-align-left header">Level</th>
              <th class="players-cell players-cell-no-border-left players-align-center header">Guild</th>
              <th class="players-cell players-cell-no-border-left players-align-right header">Class</th>
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
				  <td class="players-cell players-cell-no-border players-align-left"><a href="">'.$player['character_name'].'</a> </td>
				  <td class="players-cell players-cell-no-border players-align-left"> '.$player['wLevel'].'  </td>
				  <td class="players-cell players-cell-no-border players-align-center"><a href="arsenal/legions/1177294">'.$player['guild_name'].'</a> </td>
				  <td class="players-cell players-cell-no-border players-align-right">'.$this->l_pcclass->class2name($player['byPCClass']).'</td>
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