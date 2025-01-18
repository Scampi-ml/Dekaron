<html>
    <head>
        <title>Vote Now!</title>
        <style>
           body { background-color: #202020; 
                  color: yellow;
                }	
        </style>
    </head>
	<body>
		<?php
        // Report all PHP errors (see changelog)
		error_reporting(E_ALL);
		
		// for gedimazs
		
		include ("config.php");
		
						
        //---DO NOT EDIT ANYTHING BELOW HERE UNLESS YOU KNOW WHAT YOU ARE DOING!! ---
		
		function clean($str){
			return is_array($str) ? array_map('clean', $str) : str_replace("\\", "\\\\", htmlspecialchars((get_magic_quotes_gpc() ? stripslashes($str) : $str), ENT_QUOTES));
		}
		  
		$mslink = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
        $ip = getenv("REMOTE_ADDR");
        $httpref = getenv ("HTTP_REFERER");
        $httpagent = getenv ("HTTP_USER_AGENT");
        $account = clean($_POST['account']);
		$date = date("Y-m-d G:i");
        
        if (empty($account)){
		
			echo '<SCRIPT LANGUAGE="JavaScript">alert("You didnt enter a account name! \n Please try again.")</script>';
			echo "<script type='text/javascript'>window.location='votenow.php';</script>";

			
        } elseif(!preg_match("/[0-9a-zA-Z]?/", $account)) {
		
			echo '<SCRIPT LANGUAGE="JavaScript">alert("Incorrect account name format. \n Please try again.")</script>';
			echo "<script type='text/javascript'>window.location='votenow.php';</script>";

			
        } else {
            
            $result1 = mssql_query("SELECT * FROM account.dbo.user_profile WHERE user_id = '".$account."'",$mslink);
            $count1 = mssql_num_rows($result1);
			$row1 = mssql_fetch_row($result1);
			
            if($count1 == '0') {
			
				echo '<SCRIPT LANGUAGE="JavaScript">alert("Account not found. \n Please try again.")</script>';
				echo "<script type='text/javascript'>window.location='votenow.php';</script>";

				
            } else { 

				$result2 = mssql_query("SELECT * FROM cash.dbo.user_cash WHERE user_no = '".$row1[0]."'",$mslink);
				$count_coins = mssql_num_rows($result2);
			
				if($count_coins == '0') {
				
					echo '<SCRIPT LANGUAGE="JavaScript">alert("This account didnt visit the D-shop yet. \n You cannot recive your coins. \n Please login into the server, and visit the D-shop.")</script>';
					echo "<script type='text/javascript'>window.location='votenow.php';</script>";

				} else {

        
					$result2 = mssql_query("SELECT * FROM account.dbo.user_votes WHERE account = '".$account."' ",$mslink);
					$row2 = mssql_fetch_row($result2);
					$count2 = mssql_num_rows($result2);
					
					if($count2 == 1){
							
						$voted_ip = $row2[2];
						if($voted_ip == $ip){
						
							echo '<SCRIPT LANGUAGE="JavaScript">alert("You cant vote anymore with this IP! \n Please try again later.")</script>';
							echo "<script type='text/javascript'>window.location='votenow.php';</script>";

						} else {
						
							$voted_date = $row2[3];
							$voted_id = $row2[0];
							$voted_account = $row2[1];
							$to_time = strtotime($voted_date);
							$from_time = strtotime($date);
						
							if (round(abs($to_time - $from_time) / 60,2) > $time_needed) {
								
								$amount = $coins;	
								mssql_query("UPDATE account.dbo.user_votes SET date = '".$date."' WHERE account = '".$account."' ",$mslink);		
								mssql_query("UPDATE cash.dbo.user_cash SET amount = amount+".$amount." WHERE user_no = '".$row1[0]."'",$mslink);	
								echo '<SCRIPT LANGUAGE="JavaScript">alert("Thank you for you vote!")</script>';
								echo "<script type='text/javascript'>window.location='$votesite';</script>";
											
							} else {
							
								echo '<SCRIPT LANGUAGE="JavaScript">alert("You cant vote anymore! \n Please try again later.")</script>';
								echo "<script type='text/javascript'>window.location='votenow.php';</script>";
	
							}
						
						}
						
					} else {
						$amount = $coins;	
						mssql_query("INSERT INTO account.dbo.user_votes (account,ip,date) VALUES ('".$account."','".$ip."','".$date."' ) ",$mslink);
						mssql_query("UPDATE cash.dbo.user_cash SET amount = amount+".$amount." WHERE user_no = '".$row1[0]."'",$mslink);				
						echo '<SCRIPT LANGUAGE="JavaScript">alert("Thank you for you vote!")</script>';
						echo "<script type='text/javascript'>window.location='$votesite';</script>";
	
					}
				}	
			}
        }
		mssql_close($mslink);
        ?>
	</body>
</html>