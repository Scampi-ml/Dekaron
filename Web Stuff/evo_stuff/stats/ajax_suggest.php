<?php
include ('class_dekaron.php');
$dekaron = new dekaron_class();
include ('settings.php');

if(isset($_POST['queryString']))
{
        $queryString = $_POST['queryString'];
        // Is the string length greater than 0?
        if(strlen($queryString) > 0)
		{
			// Run the query: We use LIKE '$queryString%'
			// The percentage sign is a wild-card, in my example of countries it works like this...
			// $queryString = 'Uni';
			// Returned data = 'United States, United Kindom';
	 
			$query = $dekaron->SQLquery("SELECT TOP 10 character_name FROM character2.dbo.user_character WHERE character_name LIKE '%".$queryString."%' AND character_name NOT LIKE '[[]%]%' ");
			if($query)
			{
				while ($result = $dekaron->SQLfetchArray($query))
				{
					echo '<li onClick="fill(\''.$result['character_name'].'\');">'.$result['character_name'].'</li>';
				}
			}
			else
			{
				echo 'ERROR: There was a problem with the query.';
			}
			
		}
		else
		{
    	}
}
else
{
    die( 'There should be no direct access to this script!' );
}
?>