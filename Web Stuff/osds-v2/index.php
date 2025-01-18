<?php

echo "<link href='config/stylesheet.css' type='text/css' rel='stylesheet'>
<table width='397' border='0' align='center' cellspacing='0' class='innertab'>
<form action='pages/index.php' method='POST'>
<center>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<table width='397' border='0' align='center' cellspacing='0' class='innertab'>
<form action='pages/index.php' method='POST'>
  <tr>
    <th height='248' background='pages/images/login.png' scope='col'>
	<table width='100%' border='0'   height='100%' valign='bottom' align='right' cellspacing='0'>
      <tr>
        <th width='43%' scope='col'>&nbsp;</th>
        <th width='57%' scope='col'>&nbsp;</th>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height='58'>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height='86'>&nbsp;</td>
        <td><table width='100%' height='22%' border='0' align='left'>
          <tr>
            <th scope='col'>&nbsp;</th>
          </tr>
          <tr>
            <td><div align='left'>
              <input type='text' name='accname' maxlength='12' />
            </div></td>
          </tr>
          <tr>
            <td><div align='left'>
              <input type='password' name='accpass' maxlength='12' />
            </div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        	<input type='hidden' name='log' value='login'>
			<input type='submit' value='Login'>
        </td>
      </tr>
    </table></th>
  </tr>
  </form>
</table>
</center>";