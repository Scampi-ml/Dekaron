<?php
if(stristr($_SERVER['PHP_SELF'], "level.process.php")){
exit("<strong>Error: </strong>Can't be opened directly!");
}

$level['1'] = 0;
$level['2'] = 5;
$level['3'] = 24;
$level['4'] = 60;
$level['5'] = 160;
$level['6'] = 328;
$level['7'] = 548;
$level['8'] = 814;
$level['9'] = 1157;
$level['10'] = 1558;
$level['11'] = 2250;
$level['12'] = 3086;
$level['13'] = 4135;
$level['14'] = 5444;
$level['15'] = 7068;
$level['16'] = 9126;
$level['17'] = 11660;
$level['18'] = 14769;
$level['19'] = 18572;
$level['20'] = 23214;
$level['21'] = 29155;
$level['22'] = 36409;
$level['23'] = 45245;
$level['24'] = 55988;
$level['25'] = 69026;
$level['26'] = 85569;
$level['27'] = 105656;
$level['28'] = 130009;
$level['29'] = 159494;
$level['30'] = 159150;
$level['31'] = 238255;
$level['32'] = 290216;
$level['33'] = 352918;
$level['34'] = 428488;
$level['35'] = 519513;
$level['36'] = 629149;
$level['37'] = 761081;
$level['38'] = 919784;
$level['39'] = 1110624;
$level['40'] = 1340045;
$level['41'] = 1615778;
$level['42'] = 1947099;
$level['43'] = 2345141;
$level['44'] = 2823265;
$level['45'] = 3397501;
$level['46'] = 4087087;
$level['47'] = 4915108;
$level['48'] = 5909267;
$level['49'] = 7102808;
$level['50'] = 8535623;
$level['51'] = 10255633;
$level['52'] = 12320243;
$level['53'] = 14798389;
$level['54'] = 17772795;
$level['55'] = 21342730;
$level['56'] = 25627317;
$level['57'] = 30769501;
$level['58'] = 36940820;
$level['59'] = 44347118;
$level['60'] = 53235407;
$level['61'] = 63902104;
$level['62'] = 76702906;
$level['63'] = 92064653;
$level['64'] = 110499551;
$level['65'] = 132622249;
$level['66'] = 169170373;
$level['67'] = 191028978;
$level['68'] = 229260177;
$level['69'] = 275138508;
$level['70'] = 330193415;
$level['71'] = 396260232;
$level['72'] = 1188853398;
$level['73'] = 1426699190;
$level['74'] = 1712116603;
$level['75'] = 2054620005;
$level['76'] = 2465627972;
$level['77'] = 2958842501;
$level['78'] = 3550695049;
$level['79'] = 4260939963;
$level['80'] = 5113193317;
$level['81'] = 6135910416;
$level['82'] = 7363228039;
$level['83'] = 8835873647;
$level['84'] = 10603329445;
$level['85'] = 12723860419;
$level['86'] = 15268923922;
$level['87'] = 18322568824;
$level['88'] = 21987686895;
$level['89'] = 26385224274;
$level['90'] = 31663104567;
$level['91'] = 37993920972;
$level['92'] = 45594437478;
$level['93'] = 54712077691;
$level['94'] = 65659881812;
$level['95'] = 78786685050;
$level['96'] = 94540297802;
$level['97'] = 113442994895;
$level['98'] = 136147038801;
$level['99'] = 163398692810;  
$level['100'] = 266078431385;
$level['101'] = 325294117685;
$level['102'] = 372352941185;
$level['103'] = 468823529485;
$level['104'] = 539647058885;
$level['105'] = 588094117685;
$level['106'] = 647712941185;
$level['107'] = 711484235285;
$level['108'] = 789781082385;
$level['109'] = 819781082385;
$level['110'] = 939781082385;
$level['111'] = 1049781082385;
$level['112'] = 2079781082385;
$level['113'] = 3099781082385;
$level['114'] = 4119781082385;
$level['115'] = 5139781082385;
$level['116'] = 6169781082385;
$level['117'] = 7199781082385;
$level['118'] = 8269781082385;
$level['119'] = 9319781082385;
$level['120'] = 1699781082385;
$level['121'] = 1869781082385;


$r_Level_plus_1 = $r[5] + 1 ;


if ($r[5] == '1'){
 $bar_3 = '0';
}elseif ($r[5] > '1') {

 $one_bar = $level[$r_Level_plus_1] / '10' ;

 $bar_1 = $r[4] / $one_bar ;
 $bar_2 = number_format($bar_1 ,6);
 $bar_3 = floor($bar_2);
 
};
 if ($bar_3 > '1'){
   $bar = ''.$bar_3.' Bars';
 }elseif ($bar_3 == '1'){
   $bar = ''.$bar_3.' Bar';   
 }elseif ($bar_3 == '0'){
   $bar = '0 Bars';
 }elseif ($bar_3 < '1') {  
   $bar = '0 Bars';
 }

if ($r[5] == '1'){
 $per_cent_of_level_2 = '0.00';
 $per_cent_of_level_3 = '0';
}elseif  ($r[5] > '1'){
 $one_per_cent_level = $level[$r_Level_plus_1] / '100' ;
 $per_cent_of_level_1 = $r[4] / $one_per_cent_level ;
 $per_cent_of_level_2 = number_format($per_cent_of_level_1 ,2);
 $per_cent_of_level_3 = number_format($per_cent_of_level_1 ,0);
};

 $per_cent_of_level_4 = '100' - $per_cent_of_level_3 ; 

if ($r[5] == '1'){
 $per_cent_in_bar_4 = '0';
}elseif ($r[5] > '1'){
 $one_per_cent_bar = $level[$r_Level_plus_1] / '100' ;
 $per_cent_in_bar_1 = $r[4] / $one_per_cent_bar ;
 $per_cent_in_bar_2 = number_format($per_cent_in_bar_1 ,3);
 $per_cent_in_bar_abgerundet = floor($per_cent_in_bar_2/10)*10;
 $per_cent_in_bar_3 = $per_cent_in_bar_2 - $per_cent_in_bar_abgerundet;
 $per_cent_in_bar_4 = $per_cent_in_bar_3 * 10;
 $per_cent_in_bar_5 = floor($per_cent_in_bar_4);
};

$bar_4 = '<img src="design_1_bar_white.png" style="width:10px; height:10px" alt="">';

$bar_5 = 'for ($i = 0; $i < $bar_3; $i++){
  echo $bar_4;}';
  
if ($per_cent_in_bar_4 > '9'){
  $position_left = '35';
}elseif ($per_cent_in_bar_4 < '10'){
  $position_left = '40';
};

if ($r[5] == '1'){
  $per_cent_1 = '<div style="position:relative;top:2px;left:'.$position_left.';"><font size="1" color="white">0.00 %</font></div>';
}elseif ($r[5] > '1'){
$per_cent_1 = '<div style="position:relative;">
<img src="design_1_one_per_cent.png" style="position:absolute;top:4px;left:0;width:'.$per_cent_in_bar_5.'px; height:10px;" alt="">
<div style="position:relative;top:2px;left:'.$position_left.';"><font size="1" color="white">'.$per_cent_in_bar_4.'%</font></div>
</div>';
};


$design_2_1 = '<img src="images/design_2_red_01.gif" width="1px" height="12px" alt=""><img src="images/design_2_green_02.gif" width="'.$per_cent_of_level_3.'px" height="12px" alt=""><img src="images/design_2_red_02.gif" width="'.$per_cent_of_level_4.'px" height="12px" alt=""><img src="images/design_2_red_03.gif" width="1px" height="12px"alt="">';

$design_1_1 = '['.$bar_3.' Bars & '.$per_cent_in_bar_4.'%]';



?>