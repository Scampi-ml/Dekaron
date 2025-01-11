<?php
$lineno = $_GET['line_no'];
$item = $_GET['item'];
$source = $_GET['source'];
$item_name = base64_decode($_GET['item_name']);
?>
<h2>Auction your item</h2>
<hr />
<div id="profile">

<form action="auction.php?action=post_auction" method="post">
	<input type="hidden" name="item_index" value="<?php echo $item; ?>" />
    <input type="hidden" name="source" value="<?php echo $source; ?>" />
    <input type="hidden" name="line_no" value="<?php echo $lineno; ?>" />
    <table width="100%" border="0" cellpadding="10" cellspacing="0" >
        <tr>
            <td width="50%"><b>Item Name</b></td>
            <td align="right" width="50%"><input type="text" name="product_name" size="44" readonly value="<?php echo $item_name; ?>" /></td>
        </tr>
        <tr>
            <td width="50%"><b>Item Options</b></td>
            <td align="right" width="50%">
            <table width="100%" border="0">
              <tr>
                <td align="left"><b>Fortify</b></td>
                <td align="right">
                <?php
				
				$number = preg_replace("/[^0-9]/", '', $item_name);
				
				?>
                <select name="fortify" size="1" style="width: 205px;">
                		<option value="0" <?php if ($number == false){ echo 'selected'; } else { echo ''; } ?> >None</option>
                        <option value="1" <?php if ($number == '1'){ echo 'selected'; } else { echo ''; } ?> > +1</option>
                        <option value="2" <?php if ($number == '2'){ echo 'selected'; } else { echo ''; } ?> > +2</option>
                        <option value="3" <?php if ($number == '3'){ echo 'selected'; } else { echo ''; } ?> > +3</option>
                        <option value="4" <?php if ($number == '4'){ echo 'selected'; } else { echo ''; } ?> > +4</option>
                        <option value="5" <?php if ($number == '5'){ echo 'selected'; } else { echo ''; } ?> > +5</option>
                        <option value="6" <?php if ($number == '6'){ echo 'selected'; } else { echo ''; } ?> > +6</option>
                        <option value="7" <?php if ($number == '7'){ echo 'selected'; } else { echo ''; } ?> > +7</option>
                        <option value="8" <?php if ($number == '8'){ echo 'selected'; } else { echo ''; } ?> > +8</option>
                        <option value="9" <?php if ($number == '9'){ echo 'selected'; } else { echo ''; } ?> > +9</option>
                        <option value="10" <?php if ($number == '10'){ echo 'selected'; } else { echo ''; } ?> > +10</option>
                        <option value="11" <?php if ($number == '11'){ echo 'selected'; } else { echo ''; } ?> > +11</option>
                        <option value="12" <?php if ($number == '12'){ echo 'selected'; } else { echo ''; } ?> > +12</option>
                </select>
                </td>
              </tr>

              <tr>
                <td align="left"><b>Classification </b></td>
                <td align="right">
                <select name="item_option" size="1" style="width: 205px;">
                		<option value="0" >Normal Item (White)</option>
                        <option value="1" >Magic Item (Blue)</option>
                        <option value="2" >Noble Item (Purple)</option>
                        <option value="3" >Divine Noble Item (Yellow)</option>
                        <option value="4" >Legendary Item (Green)</option>
                </select>
                </td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td align="right">&nbsp;</td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td align="right">&nbsp;</td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td align="right">&nbsp;</td>
              </tr>
              <tr>
                <td align="left">&nbsp;</td>
                <td align="right">&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
            <td width="50%"><b>Item Category</b></td>
            <td align="right" width="50%">
            <select name="category"  size="1"  style="width: 205px;">
            
            	<optgroup label="Etc Items">
                    <option value="Etc" >Etc</option>
                </optgroup>
                
                <optgroup label="Accessory">
                    <option value="Necklace" >Necklace</option>
                    <option value="Ring" >Ring</option>
                </optgroup>
                
                <optgroup label="Armor">
                    <option value="Helmet" >Helmet</option>
                    <option value="Glove" >Glove</option>
                    <option value="Armor" >Armor</option>
                    <option value="Pants" >Pants</option>
                    <option value="Boots" >Boots</option>
                </optgroup>
                 
                <optgroup label="Weapon">
                    <option value="Axe" >Axe</option>
                    <option value="Bloopwhip" >Bloopwhip</option>
                    <option value="Bow" >Bow</option>
                    <option value="Crossbow" >Crossbow</option>
                    <option value="Dagger" >Dagger</option>
                    <option value="Gauntlet" >Gauntlet</option>
                    <option value="GreatAcxe" >Great Axe</option>
                    <option value="GreatMace" >Great Mace</option>
                    <option value="GreatSword" >Great Sword</option>
                    <option value="Mace" >Mace</option>
                    <option value="Shield" >Shield</option>
                    <option value="Staff" >Staff</option>
                    <option value="Twinsword" >Twinsword</option>
                    <option value="Wand" >Wand</option>
                </optgroup>
                
            </select>
            </td>
        </tr> 
        <tr>
            <td width="50%"><b>Auction duration</b></td>
            <td align="right" width="50%">
            <select name="product_duration" size="1" style="width: 205px;">
            	<option value="2" >2 Hours</option>
            	<option value="4" >4 Hours</option>
                <option value="8" >8 Hours</option>
                <option value="12" >12 Hours</option>
                <option value="16" >16 Hours</option>
                <option value="24" >1 Day</option>
                <option value="48" >2 Days</option>
                <option value="72" >3 Days</option>
            </select>
            </td>
        </tr> 
         <tr>
            <td width="50%"><b>Buyout Price</b></td>
            <td align="right" width="50%"><input type="text" name="buyout_price" size="44"  />
            <br><small><i>Leave blank if you dont want a buyout price</i></small>
            </td>
        </tr>  
        <tr>
            <td width="50%"><b>Minimum bid price</b></td>
            <td align="right" width="50%">
            <?php
			$rand = rand(1000, 9999);
			?>
            <input type="text" name="minimum_bid" size="44" value="<?php echo $rand; ?>"  />
            </td>
        </tr>  
        <tr>
            <td width="50%"><b></b></td>
            <td align="right" width="50%"></td>
        </tr>                                                
    </table>
    <br /><br />
    <button type="submit" class="button button-gray" style="padding-top: 1px; float:right;">Continue & check</button>
    </form>
</div>
	