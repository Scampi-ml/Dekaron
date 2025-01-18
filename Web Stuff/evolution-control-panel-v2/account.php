<?php
include ('header.php');
include ('sidebar.php');

?>
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Account</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
				<?php            
                if(isset($_POST['submit']))
                {
                    if($dekaron->isValid($_POST['password']) == false && $dekaron->isValid($_POST['password2']) == false)
                    {
                        echo '<div class="message error"><h3>Error!</h3>You cannot use MSSQL commands as password.</div>';
                    }
                    elseif(preg_match('/[^0-9A-Za-z]/', $_POST['password']) && preg_match('/[^0-9A-Za-z]/', $_POST['password2']))
                    {
                        echo '<div class="message error"><h3>Error!</h3>You can only use A-Z / 0-9 characters in your password.</div>';
                    }
                    elseif(strlen($_POST['password']) > '32' && strlen($_POST['password2']) > '32')
                    {
                        echo '<div class="message error"><h3>Error!</h3>Your password cannot exceed 32 characters.</div>';
                    }
                    elseif($_POST['password2'] == '')
                    {
                        echo '<div class="message error"><h3>Error!</h3>Please fill in password check.</div>';
                    }
                    elseif($_POST['password'] != $_POST['password2'])
                    {
                        echo '<div class="message error"><h3>Error!</h3>Passwords do not match.</div>';
                    }
                    else
                    {
						$new_password = md5($_POST['password']);
						$dekaron->SQLquery("UPDATE account.dbo.user_profile SET user_pwd = '".$new_password."' WHERE user_no = '".$_SESSION['USERNO']."' ");
						$dekaron->SQLquery("UPDATE account.dbo.tbl_user SET user_pwd = '".$_POST['password']."' WHERE user_no = '".$_SESSION['USERNO']."' ");
						$dekaron->user_action('changed password');
						echo '<div class="message success">Password updated.</div><br>';
                    }
                }
				
                if(isset($_POST['submit2']))
                {
					if($_POST['privacy'] == '1')
					{
						$dekaron->SQLquery("INSERT INTO account.dbo.privacy (uid) VALUES ('".$_SESSION['USERNO']."') ");
						$dekaron->user_action('changed privacy to enabled');
						echo '<div class="message success">Privacy is now enabled</div>';
					}
					else
					{
						$dekaron->SQLquery("DELETE FROM account.dbo.privacy WHERE uid = '".$_SESSION['USERNO']."' ");
						$dekaron->user_action('changed privacy to disabled');
						echo '<div class="message success">Privacy is now disabled</div>';
					}
				}
				$query3 = $dekaron->SQLquery("SELECT * FROM account.dbo.user_profile WHERE user_no = '".$_SESSION['USERNO']."' ");
				$getAccount = $dekaron->SQLfetchArray($query3);
				
				$query4 = $dekaron->SQLquery("SELECT * FROM account.dbo.privacy WHERE uid = '".$_SESSION['USERNO']."' ");
				$getPrivacy = $dekaron->SQLfetchNum($query4);
                ?>

                <form id="form" class="form grid_6" method="post" action="account.php">
                    <input type="hidden" name="submit"  />
                    <fieldset>
                        <legend>Edit Account</legend>
                        <label>Password<small>Leave blank for no change</small></label><input type="password" name="password" maxlength="32" value="" />
                        <label>Password check<small>Re-enter your password</small></label><input type="password" name="password2" data-equals="password" maxlength="32" value="" />
                        <div class="action">
                            <button class="button button-gray" type="submit"><span class="accept"></span>OK</button>
                        </div>
                    </fieldset>
                </form> 
                <form id="form" class="form grid_6" method="post" action="account.php">
                    <input type="hidden" name="submit2"  />
                    <fieldset>
                        <legend>Edit Privacy</legend>
                        <label>Privacy <small>Default: Disabled</small></label>
                        <select name="privacy"  size="1"  style="width: 205px;">
                        <?php
                            if( $getPrivacy == '0')
                            {
                                
                                echo '<option value="0" selected >Disabled</option>';
                                echo '<option value="1" >Enabled</option>';
                            }
                            else
                            {
                                echo '<option value="1" selected >Enabled</option>';
                                echo '<option value="0" >Disabled</option>';
                            }
                        ?> 
                        </select>
                        
                        <div class="action">
                            <button class="button button-gray" type="submit"><span class="accept"></span>OK</button>
                        </div>
                    </fieldset>
                </form>              
            </div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>