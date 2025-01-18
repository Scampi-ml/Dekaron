<div class="top-players-header">
  <div class="top-players-header-inner">
    <div class="top-players-header-title">
      <h3 class="portal-heading"><img src="<?php echo base_url('assets/images/top-players-headline-title.png'); ?>" alt="Abyss Ranking" title="Abyss Ranking"></h3>
    </div>
  </div>
</div>
<div class="top-players-table-container">
  <table class="top-players-table">
    <thead>
      <tr class="top-players-row head">
      <th class="top-players-cell players-cell-no-border-right players-align-center header">No</th>
      <th class="top-players-cell players-cell-no-border players-align-left header">Name</th>
      <th class="top-players-cell players-cell-no-border players-align-left header">Level</th>
      <th class="top-players-cell players-cell-no-border-left players-align-center header">Guild</th>
      </tr>
    </thead>
    <tbody>
	  <?php
        $i_1 = '1';
        $ranking1 = $template['ranking1'];
        foreach($ranking1 as $rank1)
        {	
            
            echo '    
              <tr class="top-legions-row">
                <td class="top-legions-cell top-legions-cell-no-border-right top-players-align-center">'.$i_1.'.</td>';
				
				
				if (strlen($rank1['character_name']) >= 20)
				{
					echo '<td class="top-legions-cell top-legions-cell-no-border-left top-players-align-left">'.substr($rank1['character_name'], 0, 15). " ... ".'</td>';
				}
				else
				{
					echo  '<td class="top-legions-cell top-legions-cell-no-border-left top-players-align-left">'.$rank1['character_name'].'</td>';
				}				
				
				echo '
                <td class="top-legions-cell top-legions-cell-no-border top-players-align-center">'.number_format($rank1['wLevel']).'</td>';
				if (strlen($rank1['guild_name']) >= 20)
				{
					echo '<td class="top-legions-cell top-legions-cell-no-border-left top-players-align-center">'.substr($rank1['guild_name'], 0, 15). " ... ".'</td>';
				}
				else
				{
					echo  '<td class="top-legions-cell top-legions-cell-no-border-left top-players-align-center">'.$rank1['guild_name'].'</td>';
				}
				echo '
              </tr>';
			  $i_1++;
        }
    ?>    
    </tbody>
  </table>
</div>
