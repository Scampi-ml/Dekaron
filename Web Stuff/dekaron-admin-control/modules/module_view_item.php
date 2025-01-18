<link rel="stylesheet" type="text/css" href="style/stickytooltip.css" />
<?php
flush_this();
$header = $_GET["header"];
$item = $_GET["item"];
$windex = $_GET['windex'];

include('engine/array_itemoption.php');

$debug = 0; // set to 1 to enable debug output

// Initialize our item info variables with default values
$socket[0] = 'No Socket';
$socket[1] = 'No Socket';
$socket[2] = 'No Socket';
$socket[3] = 'No Socket';

$opt[0] = 'No Option';
$opt[1] = 'No Option';
$opt[2] = 'No Option';
$opt[3] = 'No Option';



// function to parse CSV files and store data from file into
// an array of strings
//
// in > $file - the file to Parse
// out > An array containing the string data from the given file


// function to get the data from the column on the row matching
// the passed in index from the passed in array of strings
//
// in > $data - an array of strings that contain the data we
// need to find
// in > $index - the item index we are looking for
// in > $idCol - the column to find the item index (0 or 1)
// in > $getCol - the colum to get the return data from
// out > A string containg the data found
// open and parse the files, if they are not found exit with an error message
$f_itemetc = fopen("csv/itemetc.csv", "r") or die("csv/itemetc.csv not found!");
$f_itemoption = fopen("csv/itemoption.csv","r") or die("csv/itemoption.csv not found!");
$f_itemoption_etc = fopen("csv/itemoption_etc.csv","r") or die("csv/itemoption_etc.csv not found!");
$f_itemoption_gem = fopen("csv/itemoption_gem.csv","r") or die("csv/itemoption_gem.csv not found!");
$f_itemoption_armor = fopen("csv/itemoption_armor.csv","r") or die("csv/itemoption_armor.csv not found!");
$f_itemoption_weapon = fopen("csv/itemoption_weapon.csv","r") or die("csv/itemoption_weapon.csv not found!");
$f_item_cash = fopen("csv/itemcash.csv","r") or die("csv/itemcash.csv not found!");
$f_item_armor = fopen("csv/itemarmor.csv","r") or die("csv/itemarmor.csv not found!");
$f_item_weapon = fopen("csv/itemweapon.csv","r") or die("csv/itemweapon.csv not found!");


// Parse all the files to prep them for use
$itemetc = ParseCSVFile($f_itemetc);
$itemoption = ParseCSVFile($f_itemoption);
$itemoption_etc = ParseCSVFile($f_itemoption_etc);
$itemoption_gem = ParseCSVFile($f_itemoption_gem);
$itemoption_armor = ParseCSVFile($f_itemoption_armor);
$itemoption_weapon = ParseCSVFile($f_itemoption_weapon);
$item_cash = ParseCSVFile($f_item_cash);
$item_armor = ParseCSVFile($f_item_armor);
$item_weapon = ParseCSVFile($f_item_weapon);


fclose($f_itemetc);
fclose($f_itemoption);
fclose($f_itemoption_etc);
fclose($f_itemoption_gem);
fclose($f_itemoption_armor);
fclose($f_itemoption_weapon);
fclose($f_item_cash);
fclose($f_item_armor);
fclose($f_item_weapon);

// Parse all the files to prep them for use

if(GetItemData($item_cash, $windex, 0, 0))
{
	$csv_file = $item_cash;
	$item_type = 'cash';
}
elseif(GetItemData($item_armor, $windex, 0, 0) == $windex)
{
	$csv_file = $item_armor;
	$item_type = 'armor';
}

elseif(GetItemData($item_weapon, $windex, 0, 0) == $windex)
{
	$csv_file = $item_weapon;
	$item_type = 'weapon';
}
else
{
	$csv_file = $itemetc;
	$item_type = 'etc';
}
flush_this();




/////////////////////////////////////////
// Prep our hex string for use!
/////////////////////////////////////////

// Get the number of sockets
//  this is needed now to split the info string properly
$numSockets = $header/16;

// Dump the 0x at the start of the item string, we don't need it
if($item[1] == 'x')
$item = str_ireplace("0x", "", $item);

$socketString = substr($item, 0, 4*(int)$numSockets);
$optionString = substr($item, 4*(int)$numSockets, strlen($item)-(4*(int)$numSockets));

// Convert the hex string for sockets into an array of decimal values
$sArr = str_split($socketString, 4);

if($debug)
print_r($sArr); echo '</br>';

for($i = 0; $i < count($sArr); ++$i)
$indexArr[$i] = hexdec($sArr[$i]);

if($debug)
print_r($indexArr); echo '</br>';


//////////////////////////////////////////
// Get socket info!
//
// Format: every 2 bytes => index into
//      itemetc.csv
//////////////////////////////////////////

// For each socket get it's data
for($i = 0; $i < (int)$numSockets; ++$i)
{
	// There is nothing in this socket
	if($indexArr[$i] <= 0)
	{
		$socket[$i] = 'Empty Socket';
	}
	else
	{
		$itemID = $indexArr[$i];
		// Get the option1 index
		$option = GetItemData($itemetc, $itemID, 0, 43);
		
		// Get the option1 value
		$value = GetItemData($itemetc, $itemID, 0, 44);
		
		// Get the description for gem options
		$optionDesc = GetItemData($itemoption_gem, $option, 0, 1);
		
		// Replace '<VALUE>' with $value
		$optionDesc = str_replace(' <VALUE>', $value, $optionDesc);
		
		$gemName = GetItemData($itemetc, $itemID, 0, 1);
		
		$socket[$i] = $optionDesc.'<span style="float:right; color: #fff;">('.$gemName.')</span>';
	}
}


//////////////////////////////////////////
// Get magic/noble/divine info!
//
// Format: 2bytes => index int itemoption.csv
//               1byte => percentage of difference
//      for stat value between min & max
//////////////////////////////////////////

$optionInfoArr = str_split($optionString, 6);

$numOptions = count($optionInfoArr);

if($debug)
print_r($optionInfoArr);

for($i = 0; $i < $numOptions; ++$i)
{

$arr = str_split($optionInfoArr[$i], 4);
$itemID = hexdec($arr[0]);

if($arr[0] == 0)
break;

// check itemoption for the option ID
$optionDesc = GetItemData($itemoption_etc, $itemID, 1, 2);

if($optionDesc)
{
$min = (int)GetItemData($itemoption_etc, $itemID, 1, 4);
$max = (int)GetItemData($itemoption_etc, $itemID, 1, 5);
}
else // wasn't found in itemoption
{
// check itemoption_weapon for the option ID
$optionDesc = GetItemData($itemoption_weapon, $itemID, 1, 2);

if($optionDesc)
{
$min = (int)GetItemData($itemoption_weapon, $itemID, 1, 4);
$max = (int)GetItemData($itemoption_weapon, $itemID, 1, 5);
}
else // wasn't found in itemoption_weapon either
{
// check itemoption_armor for the option ID
$optionDesc = GetItemData($itemoption_armor, $itemID, 1, 2);

if($optionDesc)
{
$min = (int)GetItemData($itemoption_armor, $itemID, 1, 4);
$max = (int)GetItemData($itemoption_armor, $itemID, 1, 5);
}
else // wasn't found in itemoption_armor either
{
// last place to look in itemoption_etc
$optionDesc = GetItemData($itemoption, $itemID, 1, 2);

$min = (int)GetItemData($itemoption, $itemID, 1, 4);
$max = (int)GetItemData($itemoption, $itemID, 1, 5);
}
}

}



if($min != $max)
$val = $min + (int)(($max-$min)* (float)(hexdec($arr[1])/100));
else
$val = $max;

$opt[$i] = '+'.$val.' '.$itemoption_desc[$optionDesc];
}


	
// by janvier123
$str = str_split($item, 4);
if($item == '00')
{
	$item_special = '';
}
else
{
	if(is_numeric(hexdec($str[1])) && $str[4] == '')
	{
		$item_special = 'magic';
	}
	else
	{
		$item_special = 'divine';	
	}
}
		
if($item_special == 'magic')
{
	$special_name = '-Magic Item-';
	$special_color = '#6699cc';							
}
elseif($item_special == 'divine')
{
	$special_name = '-Divine Noble Item-';
	$special_color = '#ffff00';														
}
else
{
	$special_name = '';
	$special_color = '#fff';
}

$job = array(
   '1000-0000-0000-0000-0000-0000-0000-0000' => "Azure Knight",
   '0100-0000-0000-0000-0000-0000-0000-0000' => "Segita Hunter",
   '0010-0000-0000-0000-0000-0000-0000-0000' => "Incar Magician",
   '0001-0000-0000-0000-0000-0000-0000-0000' => "Vicious Summoner",
   '0000-1000-0000-0000-0000-0000-0000-0000' => "Segnale",
   '0000-0100-0000-0000-0000-0000-0000-0000' => "Bagi Warrior"
);	

$weapon_type = array(
   '5' => "One-Handed",
   '4' => "Two-handed"
);	


$non_int = array("1", "2", "3", "4", "5", "6", "7", "8", "9");
$int = array("+1", "+2", "+3", "+4", "+5", "+6", "+7", "+8", "+9");

$new_item_name = str_replace($non_int, $int, urldecode($_GET['item_name']));


flush_this();
?>
<div class="tooltip2" >
  <div style="padding:5px">
    <div style="width:300px" class="ati2" align="center"><span style="color: <?php echo $special_color; ?>;"><?php echo $special_name; echo $new_item_name; ?></span><br>
      <div style="text-align:left; color:#fff; margin-left:10px;">
      <br><br>
		<?php   
		if($item_type == 'weapon')
		{ 
			if(GetItemData($csv_file, $windex, 0, 58) != '0' || GetItemData($csv_file, $windex, 0, 60) != '0')
			{
				$socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none">Weapon Type : '.$weapon_type[GetItemData($csv_file, $windex, 0, 3)].'</div>';
				$socket_info_html .=  '<br>';
			}
		}
        flush_this();
        
        $socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none">Class : '.$job[GetItemData($csv_file, $windex, 0, 8)].'</div>';
        
        if(GetItemData($csv_file, $windex, 0, 13) != '0')
        {
            $socket_info_html .=  '<br>';
            $socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none">Selling Price : '.number_format(GetItemData($csv_file, $windex, 0, 13)).'</span></div>'; 
        }
		flush_this();
        
        if(GetItemData($csv_file, $windex, 0, 66) != '0')
        {
            $socket_info_html .=  '<br>';
            $socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none">Defense : '.GetItemData($csv_file, $windex, 0, 66).'</div>';
        }
		flush_this();
        
        if(GetItemData($csv_file, $windex, 0, 12) != '0')
        {			
            $socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none">Req. Level : Lv '.GetItemData($csv_file, $windex, 0, 12).'</div>';
        }
		flush_this();
        
        if(GetItemData($csv_file, $windex, 0, 70) != '0')
        {
            $socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none">Req. Str : '.GetItemData($csv_file, $windex, 0, 70).'</div>';
        }
		flush_this();
        
        if(GetItemData($csv_file, $windex, 0, 71) != '0')
        {			
            $socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none">Req. Dex : '.GetItemData($csv_file, $windex, 0, 71).'</div>';
        }
		flush_this();
        
        if(GetItemData($csv_file, $windex, 0, 72) != '0')
        {
            $socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none">Req. Spr : '.GetItemData($csv_file, $windex, 0, 72).'</div>';
        }
		flush_this();
        
        if(GetItemData($csv_file, $windex, 0, 62) != '0' && GetItemData($csv_file, $windex, 0, 63) != '0')
        {
            $socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none">Physical Damage : '.GetItemData($csv_file, $windex, 0, 62).' ~ '.GetItemData($csv_file, $windex, 0, 63).'</div>';
        }	
		flush_this();		
        
        if(GetItemData($csv_file, $windex, 0, 64) != '0' && GetItemData($csv_file, $windex, 0, 65) != '0')
        {
            $socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none">Magic Damage : '.GetItemData($csv_file, $windex, 0, 64).' ~ '.GetItemData($csv_file, $windex, 0, 65).'</div>';
        }
		flush_this();
        
        if(GetItemData($csv_file, $windex, 0, 62) != '0' || GetItemData($csv_file, $windex, 0, 64) != '0')
        {
            $socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none">Attack Speed : 1</div>';
        }
		flush_this();
        
        if(GetItemData($csv_file, $windex, 0, 68) != '0')
        {
            $socket_info_html .=  '<div style="margin-left:10px; color: #fff; text-decoration:none">Block Rate : '.GetItemData($csv_file, $windex, 0, 68).'%</div>';	
        }
		flush_this();
		
      echo $socket_info_html.'<br><br>';
      
	  if($socket[0] != 'No Socket' )
	  {
	  		echo '<div style="margin-left:10px; color: #F00; text-decoration:none">'.$socket[0].'</div>';
			flush_this();
	  }
	  
	  if($socket[1] != 'No Socket')
	  {
	  		echo '<div style="margin-left:10px; color: #F00; text-decoration:none">'.$socket[1].'</div>';
			flush_this();
	  }
	  
	  if($socket[2] != 'No Socket')
	  {
	  		echo '<div style="margin-left:10px; color: #F00; text-decoration:none">'.$socket[2].'</div>';
			flush_this();
	  }
	  
	  if($socket[3] != 'No Socket')
	  {
	  		echo '<div style="margin-left:10px; color: #F00; text-decoration:none">'.$socket[3].'</div>';
			flush_this();
	  }
	  // options
	  
	  if($opt[0] != 'No Option')
	  {
	  	echo '<div style="margin-left:10px; color: #6699cc; text-decoration:none">'.$opt[0].'</div>';
		flush_this();
	  }
	  
	  if($opt[1] != 'No Option')
	  {
	  	echo '<div style="margin-left:10px; color: #6699cc; text-decoration:none">'.$opt[1].'</div>';
		flush_this();
	  }
	  
	  if($opt[2] != 'No Option')
	  {
	  	echo '<div style="margin-left:10px; color: #ccccff; text-decoration:none">'.$opt[2].'</div>';
		flush_this();
	  }
	  
	  if($opt[3] != 'No Option')
	  {
	  	echo '<div style="margin-left:10px; color: #ffff00; text-decoration:none">'.$opt[3].'</div>';
		flush_this();
	  }
	  ?>
      <br>
      </div>
    </div>
  </div>
  <div class="status2"></div>
</div>
