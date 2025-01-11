<link rel="stylesheet" href="css/themes/base/jquery.ui.all.css">

<script src="js/jquery-1.7.1.js"></script>
<script src="js/ui/jquery.ui.core.js"></script>
<script src="js/ui/jquery.ui.widget.js"></script>
<script src="js/ui/jquery.ui.accordion.js"></script>
<script>
$(function() {
    $( "#accordion" ).accordion({
        autoHeight: false,
        navigation: true
    });
});
</script>
<?php

include ('array_map.php');
include ('class_dekaron.php');

$dekaron = new dekaron_class();
include ('settings.php');


$query1 = $dekaron->SQLquery("SELECT * FROM character.dbo.user_character WHERE character_no = '".$_GET['character']."' ");
$getChars = $dekaron->SQLfetchArray($query1);


$query2 = $dekaron->SQLquery("SELECT * FROM account.dbo.user_profile WHERE user_no = ".$getChars['user_no']." ");
$getAccountInfo = $dekaron->SQLfetchArray($query2);
							
$query3 = $dekaron->SQLquery("SELECT * FROM character.dbo.guild_char_info WHERE character_name = '".$getChars['character_name']."' ");
$getGuildNum = $dekaron->SQLfetchNum($query3);
$getGuildCode = $dekaron->SQLfetchArray($query3);
  
if ($getGuildNum == '0')
{
	$guildname = 'No Guild';
}
else
{
	$query4 = $dekaron->SQLquery("SELECT * FROM character.dbo.guild_info WHERE guild_code = '". $getGuildCode['guild_code']."' ");
	$getGuildName = $dekaron->SQLfetchArray($query4);
	$guildname = $getGuildName['guild_name'];
} 
$dekaron->flushthis();

?><div style="background-color: #fff;">
<div id="accordion">
  <h3><a href="#">General</a></h3>
  <div>
    <table width="100%" cellpadding="1" cellspacing="1">
      <tr>
        <td><strong> Character Name </strong></td>
        <td align="right"><?php echo $getChars['character_name']; ?></td>
      </tr>
      <tr>
        <td><strong> Guild </strong></td>
        <td align="right"><?php echo $guildname; ?></td>
      </tr>
      <tr>
        <td><strong> Class </strong></td>
        <td align="right"><?php echo $dekaron->_class($getChars['byPCClass']); ?></td>
      </tr>
    </table>
  </div>
  <h3><a href="#">Dil</a></h3>
  <div>
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td><strong> Inventory </strong></td>
        <td align="right"><?php echo number_format($getChars['dwMoney']); ?></td>
      </tr>
      <tr>
        <td><strong> Store </strong></td>
        <td align="right"><?php echo number_format($getChars['dwStoreMoney']); ?></td>
      </tr>
      <tr>
        <td><strong> Storage </strong></td>
        <td align="right"><?php echo number_format($getChars['dwStorageMoney']); ?></td>
      </tr>
    </table>
  </div>
  <h3><a href="#">Statistics</a></h3>
  <div>
    <table width="100%" cellpadding="1" cellspacing="1">
      <tr>
        <td><strong> Adv </strong></td>
        <td align="right"><?php echo number_format($getChars['dwAdv']); ?></td>
      </tr>
      <tr>
        <td><strong> HP </strong></td>
        <td align="right"><?php echo number_format($getChars['nHP']); ?></td>
      </tr>
      <tr>
        <td><strong> MP </strong></td>
        <td align="right"><?php echo number_format($getChars['nMP']); ?></td>
      </tr>
      <tr>
        <td><strong> Shield </strong></td>
        <td align="right"><?php echo number_format($getChars['nShield']); ?></td>
      </tr>
      <tr>
        <td><strong> Str </strong></td>
        <td align="right"><?php echo number_format($getChars['wStr']); ?></td>
      </tr>
      <tr>
        <td><strong> Dex </strong></td>
        <td align="right"><?php echo number_format($getChars['wDex']); ?></td>
      </tr>
      <tr>
        <td><strong> Con </strong></td>
        <td align="right"><?php echo number_format($getChars['wCon']); ?></td>
      </tr>
      <tr>
        <td><strong> Spr </strong></td>
        <td align="right"><?php echo number_format($getChars['wSpr']); ?></td>
      </tr>
      <tr>
        <td><strong> Unused Stat Points </strong></td>
        <td align="right"><?php echo number_format($getChars['wStatPoint']); ?></td>
      </tr>
      <tr>
        <td><strong> Unused Skill Points </strong></td>
        <td align="right"><?php echo number_format($getChars['wSkillPoint']); ?></td>
      </tr>
      <tr>
        <td><strong> Skill Reset </strong></td>
        <td  align="right">
		<?php
		if ( $getChars['bySkillClearCount'] == '1')
		{
			echo 'Used';
		} else {
			echo 'Unused';	   
		}
        ?>        </td>
      </tr>
      <tr>
        <td><strong> Stats Reset </strong></td>
        <td align="right">
		<?php
        if ( $getChars['byStatClearCount'] == '1')
        {
            echo 'Used';
        } else {
            echo 'Unused';	   
        }
        ?>        </td>
      </tr>
    </table>
  </div>
  <h3><a href="#">Level Progress</a></h3>
  <div>
    <table width="100%" cellpadding="1" cellspacing="1">
      <tr>
        <td><strong> Current Level </strong></td>
        <td align="right"><?php echo $getChars['wLevel']; ?></td>
      </tr>
      <tr>
        <td><strong> Current EXP </strong></td>
        <td align="right"><?php echo number_format($getChars['dwExp']); ?></td>
      </tr>
    </table>
  </div>
  <h3><a href="#">Player vs Player</a></h3>
  <div>
    <table width="100%" cellpadding="1" cellspacing="1">
      <tr>
        <td><strong> PK Count </strong></td>
        <td align="right"><?php echo number_format($getChars['wPKCount']); ?></td>
      </tr>
      <tr>
        <td><strong> Win Record </strong></td>
        <td align="right"><?php echo number_format($getChars['wWinRecord']); ?></td>
      </tr>
      <tr>
        <td><strong> Lose Record </strong></td>
        <td align="right"><?php echo number_format($getChars['wLoseRecord']); ?></td>
      </tr>
    </table>
  </div>
  <h3><a href="#">Map Info</a></h3>
  <div>
    <table width="100%" cellpadding="1" cellspacing="1">
      <tr>
        <td><strong>Current</strong></td>
        <td align="right"><table width="100%" border="0">
            <tr>
              <td align="right"><?php echo $array_map[$getChars['wMapIndex']]; ?></td>
            </tr>
            <tr>
              <td align="right">X <?php echo $getChars['wPosX']; ?></td>
            </tr>
            <tr>
              <td align="right">Y <?php echo $getChars['wPosY']; ?></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td><strong>Return</strong></td>
        <td><table width="100%" border="0">
            <tr>
              <td align="right"><?php echo $array_map[$getChars['wRetMapIndex']]; ?></td>
            </tr>
            <tr>
              <td align="right">X <?php echo $getChars['wRetPosX']; ?></td>
            </tr>
            <tr>
              <td align="right">Y <?php echo $getChars['wRetPosY']; ?></td>
            </tr>
          </table></td>
      </tr>
    </table>
  </div>
  <h3><a href="#">Online</a></h3>
  <div>
    <table width="100%" cellpadding="1" cellspacing="1">
      <tr>
        <td><strong> Date Created </strong></td>
        <td align="right"><?php echo $getChars['ipt_time']; ?></td>
      </tr>
      <tr>
        <td><strong> Login time </strong></td>
        <td align="right"><?php echo $getChars['login_time']; ?></td>
      </tr>
      <tr>
        <td><strong> Logout time </strong></td>
        <td align="right"><?php echo $getChars['logout_time']; ?></td>
      </tr>
      <tr>
        <td><strong> Ip Adress </strong></td>
        <td align="right"><?php echo $dekaron->decodeip(bin2hex($getChars['ip'])); ?></td>
      </tr>
    </table>
  </div>
</div>
</div>