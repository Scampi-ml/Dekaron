<?php 
if(isset($_SESSION['user_id'])){	
		if($_SESSION['dev']){
		
?>
		<div id="tabs">
        
				<?php include "ul_tabs.php"; ?>  
                          
			<div id="tabs-1">
            	<?php include "tab-1.php"; ?>
			</div>
            	            
			<div id="tabs-2">
            	<?php include "tab-2.php"; ?>
            </div>
            
			<div id="tabs-3">
            	<?php include "tab-3.php"; ?>
            </div>
            
			<div id="tabs-4">
            <div class="content">
                    <form name="form" action="?osds=dev&amp;page=search4&action=search" method="post">
                    <div class="form-field">
                      <input class="form-text" type="text" name="ip" size="50" />
                      <input class="form-submit" type="submit"  name="Submit" value="Search" />
                    </div>
                    </form>
            </div> 
            </div>
            
            <div id="tabs-5">
            <div class="content">
                    <form name="form" action="?osds=dev&amp;page=search3&action=search" method="post">
                    <div class="form-field">
                      <input class="form-text" type="text" name="email" size="50" />
                      <input class="form-submit" type="submit"  name="Submit" value="Search" />
                    </div>
                    </form>
            </div>        
            </div>

            
			</div>

<?php				
			} else {

?>			
<div class='ui-widget'>
    <div class='ui-state-error ui-corner-all' style='padding: 0 .5em;'>
    	<p>
        	<center><strong>Alert: </strong>Sorry, you dont have access to the admin menu.</center>
        </p>
    </div>
</div>
<?php
			}
		
			
		} else {
		
	if(isset($_POST['login'])) {
	
		$u = anti_injection($_POST['username']);
		$p = anti_injection($_POST['password']);
		$crypt_p = md5($p);
		$s = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_id = '".$u."'");
		$i = mssql_fetch_array($s);
		
		if($i['user_pwd'] == $crypt_p ){
			$userz = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_id = '".$i['user_id']."' AND user_pwd = '".$i['user_pwd']."'");
			$auser = mssql_fetch_array($userz);
			$_SESSION['user_id'] = $auser['user_id'];
			
			$ip = $_SERVER['REMOTE_ADDR'];
			$time = date("r"); 
			
			mssql_query("UPDATE account.dbo.tbl_user SET 
									lastlogin = '$time', 
									ip = '$ip',
									sitelogged = '1'
									
						WHERE user_id = '".$i['user_id']."' ");

			
			
			$userz2 = mssql_query("SELECT * FROM account.dbo.tbl_user WHERE user_id='".$u."'");
			$auser2 = mssql_fetch_array($userz2);
			if($auser2['admin'] == "1"){
				$_SESSION['dev'] = $auser2['admin'];
			}
			
			if($auser2['gm'] == "1"){
				$_SESSION['gm'] = $auser2['gm'];
			}
			
			$return = "<meta http-equiv=refresh content='0; url=?osds=misc&amp;script=redir'>";
			
		} else {
		
			$return = "
	<div class='ui-widget'>
		<div class='ui-state-error ui-corner-all' style='padding: 0 .2em;'> 
			<p>
            	<span class='ui-icon ui-icon-alert' style='float: middle; margin-right: .1em;'></span> 
				<strong>Alert:</strong> Invalid username or password.
            </p>
		</div>
	</div>
</center>";
			
		}
		
	}
	
?>
<div class="yui-t7 ui-corner-all">
	<center><h1>Login</h1></center>
		<div class="content">
				<div class="ui-widget-content ui-corner-all">
  					<form method="post" action=""> 
   							<div class="form-field">
                            <br />
								<label>Username:</label>
								<input class="form-text" type="text" name="username" maxlength='12' />
							</div>
                            
   							<div class="form-field">
								<label>Password:</label>
								<input class="form-text" type="password" name="password" maxlength='12' />
							</div>
                            
                            <div class="form-field">
								<center><input class="form-submit" type="submit" name="login" value="login" /></center>
                            </div>
                            
                        </form>
                       <center><?php echo $return; ?></center>
				</div>
        </div>
</div>
<?php
}

?>