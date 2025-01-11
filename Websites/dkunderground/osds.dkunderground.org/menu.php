<?php


function getCurrentFileName()
{
	$currentFile = $_SERVER["SCRIPT_NAME"];
	$parts = explode('/', $currentFile);
	$currentFile2 = $parts[count($parts) - 1];
			
	return $currentFile2;

}
echo '<div id="menus">';
echo '<ul id="main-menu" class="dropdown dropdown-horizontal">';







if(getCurrentFileName() == 'index.php') { echo '<li><a id="current" href="index.php">Home</a></li> '; 				} else { echo '<li><a href="index.php">Home</a></li> ';}

if(getCurrentFileName() == 'stats.php') { echo '<li><a id="current" href="stats.php">Statistics</a></li> '; 		} else { echo '<li><a href="stats.php">Statistics</a></li> ';}

if(getCurrentFileName() == 'support.php') { echo '<li><a id="current" href="support.php">Support</a></li> '; 		} else { echo '<li><a href="support.php">Support</a></li> ';}

if(getCurrentFileName() == 'news.php') { echo '<li><a id="current" href="news.php">News</a></li> '; 				} else { echo '<li><a href="news.php">News</a></li> ';}

if(getCurrentFileName() == 'changelog.php') { echo '<li><a id="current" href="changelog.php">Changelog</a></li> '; 	} else { echo '<li><a href="changelog.php">Changelog</a></li> ';}

if(getCurrentFileName() == 'donate.php') { echo '<li><a id="current" href="donate.php">Donate</a></li> '; 			} else { echo '<li><a href="donate.php">Donate</a></li> ';}

if(getCurrentFileName() == 'docs.php') { echo '<li><a id="current" href="docs.php">Documentation</a></li> '; 		} else { echo '<li><a href="docs.php">Documentation</a></li> ';}

if(getCurrentFileName() == 'translate.php') { echo '<li><a id="current" href="translate.php">Help us translate</a></li> '; 		} else { echo '<li><a href="translate.php">Help us translate</a></li> ';}




/*
if(getCurrentFileName() == 'stats.php') { echo '<li><a id="current" href="stats.php">Statistics</a></li> '; 		} else { echo '<li><a href="stats.php">Statistics</a></li> ';}

if(getCurrentFileName() == 'stats.php') { echo '<li><a id="current" href="stats.php">Statistics</a></li> '; 		} else { echo '<li><a href="stats.php">Statistics</a></li> ';}

if(getCurrentFileName() == 'stats.php') { echo '<li><a id="current" href="stats.php">Statistics</a></li> '; 		} else { echo '<li><a href="stats.php">Statistics</a></li> ';}
*/



echo '</ul>';
echo '</div>';


?>