<div class="top-legions-header">
  <div class="top-legions-header-inner">
    <div class="top-legions-header-title">
      <h4 class="portal-heading"><img src="<?php echo base_url('assets/images/top-legions-headline-title.png'); ?>" alt="Legions Ranking" title="Legions Ranking"></h4>
    </div>
  </div>
</div>
<div class="top-legions-table-container">
  <table class="top-legions-table">
    <thead>
      <tr class="top-legions-row head">
        <th class="top-legions-cell top-legions-cell-no-border-right top-legions-align-center">No</th>
        <th class="top-legions-cell top-legions-cell-no-border top-legions-align-left">Name</th>
        <th class="top-legions-cell top-legions-cell-no-border top-legions-align-center">PVP Win</th>
        <th class="top-legions-cell top-legions-cell-no-border-left top-legions-align-center">Guild</th>
      </tr>
    </thead>
    <tbody>
	  <?php
        $i_2 = '1';
        $ranking2 = $template['ranking2'];
        foreach($ranking2 as $rank2)
        {	
            echo '    
              <tr class="top-legions-row">
                <td class="top-legions-cell top-legions-cell-no-border-right top-players-align-center">'.$i_2.'.</td>';
				
				
				if (strlen($rank2['character_name']) >= 20)
				{
					echo '<td class="top-legions-cell top-legions-cell-no-border-left top-players-align-left">'.substr($rank2['character_name'], 0, 15). " ... ".'</td>';
				}
				else
				{
					echo  '<td class="top-legions-cell top-legions-cell-no-border-left top-players-align-left">'.$rank2['character_name'].'</td>';
				}				
				
				echo '
                <td class="top-legions-cell top-legions-cell-no-border top-players-align-center">'.number_format($rank2['wWinRecord']).'</td>';
				if (strlen($rank2['guild_name']) >= 20)
				{
					echo '<td class="top-legions-cell top-legions-cell-no-border-left top-players-align-center">'.substr($rank2['guild_name'], 0, 15). " ... ".'</td>';
				}
				else
				{
					echo  '<td class="top-legions-cell top-legions-cell-no-border-left top-players-align-center">'.$rank2['guild_name'].'</td>';
				}
				echo '
              </tr>';
			  $i_2++;
        }
    ?>   
    </tbody>
  </table>
</div>
