<?php
$content2 	= @file('ban/data.txt');
$continut3	= explode("$#",$content2[0]);

foreach ($continut3 as $val){
		$expl=explode('|',$val);
			list($ip,$timestamp,$type)=$expl;
		if($timestamp>time()){
			$continut4[]=$val;		
		}
}
$fp = @fopen('ban/data.txt','w');
$string = @implode("$#",$continut4);
		  @fwrite($fp, $string);
		  @fclose($fp);



class TPL{
    var $tpl;
    function TPL($template){
      if (file_exists($template)){
        $this->tpl = join("", file($template));
      }else if (file_exists($pathway."".$template)){
        $this->tpl = join("", file($pathway."".$template));
      }else{
        echo "Template file ".$template." not found.";
      }
    }
    function parse($tplfile) {
      extract($GLOBALS);
      ob_start();
      include($tplfile);
      $buffer = ob_get_contents();
      ob_end_clean();
      return $buffer;
    }
    function replace_tags($tags = array()) {
      if (sizeof($tags) > 0){
        foreach ($tags as $tag => $data) {
          $data = (strstr($data, "data") || strstr($data, "template") || strstr($data, "panels") || strstr($data, "pages")) ? $this->parse($data) : $data;
          $this->tpl = str_replace("{" . $tag . "}", $data, $this->tpl);
          }
      }else{
        echo "Nothing to replace.";
      }
    }
    function output() {
      echo $this->tpl;
    }   

	function outret() {
      return $this->tpl;
    }
  }

function countdown($timestamp)
{
  $the_countdown_date = $timestamp;

  $today = time();

  $difference = $the_countdown_date - $today;
  if ($difference < 0) $difference = 0;

  $days_left = floor($difference/60/60/24);
  $hours_left = floor(($difference - $days_left*60*60*24)/60/60);
  $minutes_left = floor(($difference - $days_left*60*60*24 - $hours_left*60*60)/60);
  
  if($days_left > 1)$s1 = 's';
  if($hours_left > 1)$s2 = 's';
  if($minutes_left > 1)$s3 = 's';
  
 return $days_left." day".$s1." ".$hours_left." hour".$s2." ".$minutes_left." min".$s3.".";
}


function time2type($id){
	if($id == '12') return "12 Hours";
	if($id == '24') return "1 Day";
	if($id == '48') return "2 Days";
	if($id == '72') return "3 Days";
	if($id == '168') return "1 Week";
	if($id == '336') return "2 Weeks";
	if($id == '744') return "1 Month";
	if($id == '8760') return "1 Year";
}

function is_ip($str){
	if ((substr_count($str, ".") != 3) or (empty($str))) { return false; }
		$ip_array = explode(".", $str);

		for ($i = 0; $i < count($ip_array); $i++){
   			if (($ip_array[$i] > 256) or (!is_numeric($ip_array[$i]))){
     		return false;
   			}
		}

	return true;
}


?>