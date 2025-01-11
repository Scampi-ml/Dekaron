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
		$ip = $_SERVER['REMOTE_ADDR'] ;
        $account = clean($_POST['account']);
		$date = date("Y-m-d G:i");
        
        if (empty($account)){
		
			echo '<SCRIPT LANGUAGE="JavaScript">alert("You didnt enter a account name! \n Please try again.")</script>';
			echo "<script type='text/javascript'>window.location='votenow.php';</script>";
			exit();

			
        } elseif(!preg_match("/[0-9a-zA-Z]?/", $account)) {
		
			echo '<SCRIPT LANGUAGE="JavaScript">alert("Incorrect account name format. \n Please try again.")</script>';
			echo "<script type='text/javascript'>window.location='votenow.php';</script>";
			exit();

			
        } else {
            
            $result1 = mssql_query("SELECT * FROM account.dbo.user_profile WHERE user_id = '".$account."' ",$mslink);
            $count1 = mssql_num_rows($result1);
			$row1 = mssql_fetch_row($result1);
			
			
			
            if($count1 == '0') {
			
				echo '<SCRIPT LANGUAGE="JavaScript">alert("Account not found. \n Please try again.")</script>';
				echo "<script type='text/javascript'>window.location='votenow.php';</script>";
				exit();


			} else {
			
			
				// account found, check for dshop
				$get_coins = mssql_query("SELECT * FROM cash.dbo.user_cash WHERE user_no = '".$row1[0]."'",$mslink);
				$count_coins = mssql_num_rows($get_coins);
			
			
				if($count_coins == '0') {
					// didnt visit dhop
					echo '<SCRIPT LANGUAGE="JavaScript">alert("This account didnt visit the D-shop yet. \n You cannot recive your coins. \n Please login into the server, and visit the D-shop.")</script>';
					echo "<script type='text/javascript'>window.location='votenow.php';</script>";
					exit();

				} else {
				
					// he visted the dshop.. contiue
					// found account found in votes, get his info
					$result2 = mssql_query("SELECT * FROM account.dbo.user_votes WHERE account = '".$account."' ",$mslink);
					$row2 = mssql_fetch_row($result2);
					$count2 = mssql_num_rows($result2);
					
					
					$voted_ip = $row2[2];
					$voted_date = $row2[3];
					$voted_id = $row2[0];
					$voted_account = $row2[1];
					$to_time = strtotime($voted_date);
					$from_time = strtotime($date);
					
					//
					if($count2 == 1){
					//i found account in votes
					
					
						// check if time has expired
						if (round(abs($to_time - $from_time) / 60,2) > $time_needed) {
						// time expired,delete his info and add new one
							$amount = $coins;	
							
							mssql_query("DELETE FROM account.dbo.user_votes WHERE account = '".$row1[1]."'",$mslink);
							mssql_query("INSERT INTO account.dbo.user_votes (account,ip,date) VALUES ('".$account."','".$ip."','".$date."' ) ",$mslink);		
							mssql_query("UPDATE cash.dbo.user_cash SET amount = amount+".$amount." WHERE user_no = '".$row1[0]."'",$mslink);	
							echo '<SCRIPT LANGUAGE="JavaScript">alert("Thank you for you vote!")</script>';
							echo "<script type='text/javascript'>window.location='$votesite';</script>";
							exit();
						
						} else { 
						// time not expired
							echo '<SCRIPT LANGUAGE="JavaScript">alert("You cant vote anymore! \n Vote time did not expire yet. \n Please try again later.")</script>';
							echo "<script type='text/javascript'>window.location='votenow.php';</script>";
							exit();
							
						}
							
							
							
					} else {
					
						// check is new account have voted IP
						$result3 = mssql_query("SELECT * FROM account.dbo.user_votes WHERE ip = '".$ip."' ",$mslink);
						$count3 = mssql_num_rows($result3);
					
						
						if($count3 == 1){
							
							echo '<SCRIPT LANGUAGE="JavaScript">alert("You cannot vote anymore with this IP! \n Please wait until you time has expired.")</script>';
							echo "<script type='text/javascript'>window.location='votenow.php';</script>";
							exit();

						} else {
							
							$amount = $coins;	
							mssql_query("INSERT INTO account.dbo.user_votes (account,ip,date) VALUES ('".$account."','".$ip."','".$date."' ) ",$mslink);
							mssql_query("UPDATE cash.dbo.user_cash SET amount = amount+".$amount." WHERE user_no = '".$row1[0]."'",$mslink);				
							echo '<SCRIPT LANGUAGE="JavaScript">alert("Thank you for you vote!")</script>';
							echo "<script type='text/javascript'>window.location='$votesite';</script>";
							exit();
							
						}
						
						
					}
				}
			}
        }
		mssql_close($mslink);
        ?>
	</body>
</html>