<?php
include ('osdscore.php');
echo HEADER;

//$getMaXorder = $db_character->query("SELECT MAX(orderby_no) AS orderbymax FROM CM_BCD_ITEM");
//$max_orderby_no = $db_character->fetchArray($getMaXorder);

//$new = $max_orderby_no['orderbymax'] + 1;

// given array. 3 and 6 are missing.


// -----------------------------------
// Add df
// -----------------------------------
if (isset($_POST['add']))
{
	$sort_nm = $_POST['sort_nm'];
	$order   = ':00';
	$replace = '';

	// Processes \r\n's first so they aren't converted twice.
	$sort_nm_clean = str_replace($order, $replace, $sort_nm);
	
	$insert_df = $db_character->query('INSERT INTO cm_bcd_item 
	
	(
	bcd_id,
	bcd_no,
	sort_cd,
	sort_nm,
	orderby_no,
	num_val_1,
	upt_ip_addr

	) 
	
	VALUES 
	(
		"DEADFRONT",
		"001",
		"'.$sort_nm_clean.'",
		"'.$_POST['sort_nm'].'",
		"'.$_POST['orderby_no'].'",
		"'.$sort_nm_clean.'",
		"1.1.1.1"
	)
	
	
	  ');
	echo '<div class="success msg">Deadfront has been added!</div>';
}



echo '	<h1>Add Deadfront</h1>
		<form method="post" class="uniform">
			<dl class="inline">

				<fieldset>
					<dt><label>Time</label></dt>
					<dd><select name="sort_nm" class="medium" size="1">
							<option value="0:00">0:00</option>
							<option value="1:00">1:00</option>
							<option value="2:00">2:00</option>
							<option value="3:00">3:00</option>
							<option value="4:00">4:00</option>
							<option value="5:00">5:00</option>
							<option value="6:00">6:00</option>
							<option value="7:00">7:00</option>
							<option value="8:00">8:00</option>
							<option value="9:00">9:00</option>
							<option value="10:00">10:00</option>
							<option value="11:00">11:00</option>
							<option value="12:00">12:00</option>
							<option value="13:00">13:00</option>
							<option value="14:00">14:00</option>
							<option value="15:00">15:00</option>
							<option value="16:00">16:00</option>
							<option value="17:00">17:00</option>
							<option value="18:00">18:00</option>
							<option value="19:00">19:00</option>
							<option value="20:00">20:00</option>
							<option value="21:00">21:00</option>
							<option value="22:00">22:00</option>
							<option value="23:00">23:00</option>
						</select>
						<small>Time to start the deadfront</small>
					</dd>					
					<dt><label>Id</label></dt>
					<dd>
						<input type="text" name="orderby_no" class="medium" />
						<div class="error msg">
						BUG & NOTICE:<br>
						You need to look at all the IDs and find a missing number<br>
						If you cant find a missing numer, just take the last one and add +1<br>
						This will get fixed, but do it like this for now
						</div>
					</dd>
				</fieldset>
			</dl>
			<div class="buttons"><button type="submit" name="add" class="button">Add Deadfront</button></div>
		</form>
';
echo FOOTER;
?>