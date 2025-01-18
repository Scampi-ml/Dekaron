<?php
include "header.php";  
 
// -----------------------------------
// Get the account
// ----------------------------------- 
$GET_ACCOUNT_NO = $_GET['account'];

// -----------------------------------
// Do we have a account no ?
// -----------------------------------
if ($GET_ACCOUNT_NO == "")
{
	echo '<div class="error msg">Error getting account. Please try again.</div>';
	include "footer.php";
	die();
}

// -----------------------------------
// Post the new values
// -----------------------------------
if (isset($_POST['submit']))
{
	$new_md5_pass = md5($_POST['password']);
	
	echo '<div class="success msg">
			New password has been created successfully.
			<br>
			Your new MD5 Password is: <b>' . $new_md5_pass . '</b>
			<br>
			Copy the new MD5 Password and <a href="edit_account.php?account=' . $GET_ACCOUNT_NO . '"><b>return</b></a> to the account page.	
	</div>';

}

// -----------------------------------
// Start HTML
// -----------------------------------
echo' 
<article>
	<h1>Create New Password</h1>
	<form class="uniform" method="post">
				<dl class="inline">
					<dt><label>New Password</label></dt>
					<dd>
						<input type="text" name="password" class="medium" size="50" maxlength="50" />
					</dd>
				</dl>
			<div class="buttons">
				<button type="submit" name="submit" class="button">Submit</button>
			</div>
	</form>
</article>';
			
include "footer.php";

?>