<?php 
include "osdscore.php";
$GET_IP = $_GET['ip'];
flush_this();
class ipology
{
    var $_ip = "255.255.255.255";
    var $_whois = "whois.ripe.net";
    var $_port = 43;
    var $_timeout = 10;
    var $_buffer = "";
    var $out = array();
    var $array_return_mode;
    var $_total = 0;

    function ipology($ip_array, $array_return_mode = "array")
    {
        $this->array_return_mode = $array_return_mode;
        $ip_array = (array) $ip_array;
        $this->_total = count($ip_array);
        $i = 0;
        foreach($ip_array as $ip)
        {
            if($this->isValidIP($ip))
            {
                $this->_ip = $ip;
                if($this->_fetch())
                {
                    $this->out[$ip] = $this->_extract();
                    if($this->out[$ip]["inetnum"] == "0.0.0.0 - 255.255.255.255")
                        $this->out[$ip] = 102;
                }
                else
                {
                    $this->out[$ip] = 101; //could not connect
                }
            }
            else
                $this->out[$ip] = 100; //incorrect IP format
        }
    }

    function _fetch()
    {
        if(!$sock = @fsockopen($this->_whois, $this->_port, &$errno, &$errstr, 10))
            return false;
        else
        {
			$buffer = "";
            fputs($sock, "{$this->_ip}\n");
            while(!feof($sock))
                $buffer .= fgets($sock, 10240);
            fclose($sock);
            $this->_buffer = $buffer;
            return true;
        }
    }

    function _extract()
    {
        $ret = array();
        $w = array("inetnum","org","netname","descr","country","tech-c","status","mnt-by","mnt-lower","mnt-routes","organisation","org-name","org-type","address","phone","fax-no","e-mail","mnt-ref","person","nic-hdl","route","origin","remarks");
        foreach($w as $get)
        {
            if(preg_match_all("/$get:\s*(.*+)/i", $this->_buffer, $matches))
            {
                if(count($matches[1]) > 1)
                {
                    if($this->array_return_mode == "array")
                        $ret[$get] = $matches[1];
                    else
                        foreach($matches[1] as $ras)
                            $ret[$get] .= $ras . "\n";
                }
                else
                    $ret[$get] = $matches[1][0];
            }
        }
        return $ret;
    }

    function isValidIp($ip)
    {
        return preg_match("/(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/", $ip) ? true : false;
    }

    function out($w=0)
    {
        return $this->out;
    }
}

// -----------------------------------
// Start HTML
// -----------------------------------

echo '
<fieldset>

	<legend>'.LAN_whois_h2.': ' . $GET_IP . '</legend>
	';
	
		
	$ipology = new ipology(array($GET_IP));
	$out = $ipology->out();
	
	if(is_array($out[$GET_IP]))
	{
					
	echo '<table>';
	
		foreach($out[$GET_IP] as $tag=>$val)
		{
			echo '<tr>
					<td style="width:20%;"><b>' . ucfirst($tag) . '</b></td>
					<td style="width:80%;">';
						if (is_array( $val ))
						{
							echo implode('<br>',$val);
						}
						else
						{
							echo $val;
						}
			echo '</td>
				</tr>';
		}
	echo '</table></fieldset>';
	
	}
	else
	{
		JavaAlert(LAN_nodata, 'goback');
		die();
	}
	
?>
