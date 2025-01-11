<?php

        //---------------------------------------------------------- 
		// Give X coins
		// Dont forget to change this in votenow.php
        $coins = 25;
		
		// Yout website after vote was successfull
		// Add http:// in your list
        $votesite = "votenow.php";
		
		// Time needed to vote again
		// You need to remove 1 minut from the time
		// 720 should be 12hours
		// Dont forget to change this in votenow.php
		$time_needed = "1"; // in mintutes
		
        
        // Insert your MSSQL info here 

        $mssql = array( 
          'host' => "localhost", 
          'user' => "sa", 
          'pass' => "xxxxxxxx" 
        );
			
?>