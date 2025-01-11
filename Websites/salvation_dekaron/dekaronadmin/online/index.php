<?php
require_once ('jpgraph.php');
require_once ('jpgraph_line.php');



$datay1 = array();
$datay2 = array();


$link = mssql_pconnect('37.59.180.41', 'SaBaker1893', 'ImPP8pL0h');
$query7 = mssql_query("SELECT TOP 22 DATEPART(hour,tijd) AS Hour, DATEPART(minute,tijd) AS Min, online, id FROM game.dbo.online_log ORDER BY id DESC", $link);


while ($inga_db = mssql_fetch_array($query7)) 
{
	$datay1[] = $inga_db['online'];
		
	if(strlen($inga_db['Hour']) == '1')
	{
		$hour = '0'.$inga_db['Hour'];
	}
	else
	{
		$hour = $inga_db['Hour'];
	}
	$datay2[] = $hour;
}


// Setup the graph
$graph = new Graph(1041,300);
$graph->SetScale("textlin");

$theme_class= new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->title->Set('<= NEW                                                                            ( 1hr interval - 24hr format )                                                                            OLD =>');
$graph->SetBox(false);

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xaxis->SetTickLabels($datay2);
$graph->ygrid->SetFill(false);
//$graph->SetBackgroundImage("tiger_bkg.png",BGIMG_FILLFRAME);

$p1 = new LinePlot($datay1);
$graph->Add($p1);


$p1->SetColor("#55bbdd");
//$p1->SetLegend('Line 1');
$p1->mark->SetType(MARK_FILLEDCIRCLE,'',1.0);
$p1->mark->SetColor('#55bbdd');
$p1->mark->SetFillColor('#55bbdd');
$p1->SetCenter();


$graph->legend->SetFrameWeight(1);
$graph->legend->SetColor('#4E4E4E','#00A78A');
$graph->legend->SetMarkAbsSize(8);


// Output line
$graph->Stroke();
