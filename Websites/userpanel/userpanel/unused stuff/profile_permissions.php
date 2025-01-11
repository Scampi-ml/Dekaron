<?php
include ('header.php');
include ('sidebar.php');

$query3 = $dekaron->SQLquery("SELECT * FROM account.dbo.user_profile WHERE user_no = '".$_SESSION['USERNO']."' ");
$getAccount = $dekaron->SQLfetchArray($query3);
							
$query2 = $dekaron->SQLquery("SELECT * FROM character.dbo.user_character WHERE user_no = '".$_SESSION['USERNO']."' ");
$getChars = $dekaron->SQLfetchArray($query2);
$getCharsNum = $dekaron->SQLfetchNum($query2);

$query4 = $dekaron->SQLquery("SELECT user_no,amount,free_amount FROM cash.dbo.user_cash WHERE user_no = '".$_SESSION['USERNO']."' ");
if ( !$query4 )
{
	$getCash = 0;
}
else
{
	$getCash_query = $dekaron->SQLfetchArray($query4);
	$getCash = $getCash_query['amount'] + $getCash_query['free_amount'];
}
?>
<!-- Main Section -->
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <ul class="action-buttons clearfix fr">
                <li><a href="documentation/index.html" class="button button-gray no-text help" rel="#overlay"><span class="help"></span></a></li>
            </ul>
            <h2>Public Profile</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            <form id="form" class="form grid_6">
            </div>
            <div class="clear"></div>
                        
            <div class="grid_2">
                <h3>Character</h3>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Show Characters</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show PVP Stats</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show PK</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Storage Dil</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                    <tr>
                    <td>Show Inventory Dil</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Inventory Items</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Storage Items</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Suit</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Allow Live Map</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Guild</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>                  
                </table>
            </div>
            <div class="grid_2">
                <h3>Account</h3>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Show Coins</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Auctions</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Friends</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Achievements</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                </table>
            </div>
            <div class="grid_2">
                <h3>Profile</h3>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Show First Name</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Last Name</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Real Email</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Birthday</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Website</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Location</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Show Gender</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                </table>
            </div>
            <div class="clear"></div>
            <hr />
            <div class="grid_2">
                <h3>Permissions</h3>
                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Allow comments</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Allow Private Messaging</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                  <tr>
                    <td>Allow Friendship</td>
                    <td align="right"><input type="checkbox" name="password" value="" /></td>
                  </tr>
                </table>
            </div>
            <div class="grid_6">
                <br />
                <hr />
            </div>
                <div class="action">
                	<button class="button button-gray" type="submit" style="float:right;"><span class="accept"></span>OK</button>
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