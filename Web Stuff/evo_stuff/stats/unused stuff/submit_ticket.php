<?php
include ('header.php');
include ('sidebar.php');

$query = $dekaron->SQLquery("SELECT user_no,reason FROM tickets.dbo.banned_accounts WHERE user_no = '".$_SESSION['USERNO']."' ");
$get_ban = $dekaron->SQLfetchNum($query);
?>
<!-- Main Section -->
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <ul class="action-buttons clearfix fr">
                <li><a href="documentation/index.html" class="button button-gray no-text help" rel="#overlay"><span class="help"></span></a></li>
            </ul>
            <h2>Submit Support Ticket</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            
             <?php
			if($get_ban == '1')
			{
				$get_ban_reason = $dekaron->SQLfetchArray($query);
				echo '<br><div class="message error"><h3>Error!</h3>Tickets system has been disabled from your account<br><br><b>Reason:</b> '.$get_ban_reason['reason'].'</div>';
				echo '</div></section></div></section>';
				include ('footer.php');
				die();
			}
			?>
            
            <form id="form" class="form grid_6">
                <fieldset>
                    <legend>Submit your ticket</legend>
                    <label>Account Name<small></small></label><input type="text" name="user_id" maxlength="30" disabled="disabled" value="<?php echo $_SESSION['USER']; ?>" />
                    <label>Character<small>If you have a character specific problem.</small></label>
                    <select name="character"  size="1"  style="width: 205px;">
                        <option value="none" selected="selected">Select character</option>
                        <?php
                        foreach($_SESSION['CHARACTERS'] as $character)
                        {
                            $name_no = explode("-", $character);
                            echo '<option value="'.$name_no[0].'">'.$name_no[1].'</option>';
                        }
                        ?>
                    </select>
                    <label>Category <em>*</em><small></small></label>
                    <select name="problem_cat"  size="1"  style="width: 205px;" required="required">
                        <option value="" selected="selected">Please select</option>
                        <option value="0">Billing</option>
                        <option value="1">Coins</option>
                        <option value="2">Character</option>
                        <option value="3">Account</option>
                        <option value="4">Items</option>
                    </select>
                    <label>Subject <em>*</em><small>Keep it short</small></label><input type="test" name="subject" maxlength="30" value="" />
                    <label>Message <em>*</em><small>Please give detailed info</small></label>
                    <textarea cols="60" rows="6" name="message" ></textarea>
                    <label>Screenshot 1<small></small></label><input type="file" name="image1">
                    <label>Screenshot 2<small></small></label><input type="file" name="image2">
                    <label>Screenshot 3<small></small></label><input type="file" name="image3">
                    <label>Chatlog<small></small></label><input type="file" name="chatlog">  
                    

                    <div class="action">
                        <button class="button button-gray" type="submit"><span class="accept"></span>OK</button>
                    </div>
                </fieldset>
                <div class="message info">Only screenshots allowed with ( <strong>.png</strong> | <strong>.gif</strong> | <strong>.bmp</strong> | <strong>.jpeg</strong> | <strong>.jpg</strong> )
					<br>Maximum Size <b>500kb</b> for each picture.<br>
				</div>
            </form>  
            </div>
        </section>
    </div>
</section>
<!-- Main Section End -->
<?php
include ('footer.php');
?>