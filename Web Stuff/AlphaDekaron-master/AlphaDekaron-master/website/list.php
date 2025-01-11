<?php
if(ALLOW_OPEN != '1') 
{
	Header('HTTP/1.1 403');
	exit(0);
}
else
{
	if ($_SESSION['isGM'] == '0')
	{
		Header('HTTP/1.1 403');
		exit(0);
	}
}
echo '<center><a href=?do=list&val=mon>Monsters</a> | <a href=?do=list&val=map>Maps</a> | <a href=?do=list&val=armor>Armors</a> | <a href=?do=list&val=weapon>Weapons</a> | <a href=?do=list&val=etc>Etc</a>';
if($_GET['val']=='map')
{
$fd = fopen ($mapsPath, "r");
echo '<table>';
if ($fd)
{
	while ($buffer = fgetcsv($fd, 4096)) 
	{
		echo '<tr><td>',$buffer[0],'</td><td>',$buffer[1],'</td></tr>';
	}
	fclose ($fd);
}
echo '</table>';
}

if($_GET['val']=='armor')
{
$fd = fopen ($armPath, "r");
echo '<table>';
if ($fd)
{
	while ($buffer = fgetcsv($fd, 4096)) 
	{
		echo '<tr><td>',$buffer[0],'</td><td>',$buffer[1],'</td></tr>';
	}
	fclose ($fd);
}
echo '</table>';
}

if($_GET['val']=='weapon')
{
$fd = fopen ($weapPath, "r");
echo '<table>';
if ($fd)
{
	while ($buffer = fgetcsv($fd, 4096)) 
	{
		echo '<tr><td>',$buffer[0],'</td><td>',$buffer[1],'</td></tr>';
	}
	fclose ($fd);
}
echo '</table>';
}
if($_GET['val']=='etc')
{
$fd = fopen ($etcPath, "r");
echo '<table>';
if ($fd)
{
	while ($buffer = fgetcsv($fd, 4096)) 
	{
		echo '<tr><td>',$buffer[0],'</td><td>',$buffer[1],'</td></tr>';
	}
	fclose ($fd);
}
echo '</table>';
}
if($_GET['val']=='mon')
{
echo '<table>';
$fd = fopen ($monPath, "r");
if ($fd)
{
	while ($buffer = fgetcsv($fd, 4096)) 
	{
		echo '<tr><td>',$buffer[0],'</td><td>',$buffer[1],'</td></tr>';
	}
	fclose ($fd);
}
echo '</table>';
}
echo '</center>';
?>