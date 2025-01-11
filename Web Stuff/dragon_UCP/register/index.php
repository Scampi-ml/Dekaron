<?php

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
require_once ('../includes/config.php');
;echo '<head>




 

  <link rel="stylesheet" media="screen" href="images/themefor.css" />

  
<style type="text/css">

.swifttext
{

	background: url(images/bg_intpu.png) repeat-x top; border: 1px solid #a7a7a7; padding: 10px; font-size: 15px; font-weight: bold; width: 250px; color: #666; -moz-border-radius: 5px; -webkit-border-radius: 5px;
	border: 1px solid #DFCA88;

}
.sec
{
border:1px solid #b2b2b2;background:white url(\'input_bg.png\') repeat-x top: left;height:25px;width:90px;line-height:15px
   }   
.sec2
{
border:1px solid #b2b2b2;background:white url(\'input_bg.png\') repeat-x top: left;height:25px;width:240px;line-height:15px
   }     
</style>

</head>


 
<body id="">


  <div class="page-wrapper vert_sprite">
		<!-- end header -->

  
    <div id="content">
      <div class="container">
 

<div id="process">
    <br />
	<br />
</div>

  

  <div class="col-s-content">
  
  ';
switch($_GET[go]){
default:
define('UI_ERROR','%s');
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$usernames = $_POST['username'];
$passwords = $_POST['password'];
$password2 = $_POST['password2'];
$gender = $_POST['gender'];
$dob_day = $_POST['dob_day'];
$dob_month = $_POST['dob_month'];
$dob_year = $_POST['dob_year'];
$country = $_POST['country'];
$error = array();
$emaill = preg_replace ('[^A-Za-z0-9]', '', $_POST['email']);
$emaill2 = preg_replace ('[^A-Za-z0-9]', '', $_POST['email2']);
$emaill = str_replace($idk, '', $emaill);
$emaill2 = str_replace($idk, '', $emaill2);
$error = array();
if(!ctype_alnum($usernames)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Illigal characters in the username.</p></div>');
} else
if((strlen($usernames) > 12) || (strlen($usernames) < 3)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Username must be 3 - 12 Alpha Numeric characters.</p></div>');
} else
if(!ctype_alnum($passwords)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Illigal characters in the password.</p></div>');
}else
if((strlen($passwords) > 8) || (strlen($passwords) < 3)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Password must be 3 - 8 Alpha Numeric characters.</p></div>');
} else
if(!ctype_alnum($password2)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Illigal characters in the password.</p></div>');
} else	 if((strlen($password2) > 8) || (strlen($password2) < 3)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Password must be 3 - 8 Alpha Numeric characters.</p></div>');
} 
else if($passwords !== $password2) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> The Passwords Doesnt Much.</p></div>');
}
else
if (@preg_match('/[^a-zA-Z0-9\_\-\.\@]/', $_POST['email'])) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Email Address Not Valid.</p></div>');
}
else if (strlen($emaill) == 0){
$error['error'] = sprintf(UI_ERROR, '<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Dont Left Email Adress Empty.</p></div>');
}
else if($_POST['email'] != $emaill){
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Email Adress is not valid.</p></div>');
} 
else if (strlen($emaill) < 4){
$error['error'] = sprintf(UI_ERROR, '<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Email Adress Too Short.</p></div>');
} 
else if (!ereg('@',$emaill) ) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Email Adress is not valid.</p></div>');
} 
else if (strlen($emaill2) == 0){
$error['error'] = sprintf(UI_ERROR, '<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Dont Left Email Adress Empty.</p></div>');
}
else
if (@preg_match('/[^a-zA-Z0-9\_\-\.\@]/', $_POST['email2'])) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Email Address Not Valid.</p></div>');
}
else if($_POST['email2'] != $emaill2){
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Email Adress is not valid.</p></div>');
} 
else if (strlen($emaill2) < 4){
$error['error'] = sprintf(UI_ERROR, '<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Email Adress Too Short.</p></div>');
} 
else if (!ereg('@',$emaill2) ) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Email Adress is not valid.</p></div>');
} 
else if($emaill !== $emaill2) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Email Adress Doesnt Much.</p></div>');
}
else  if(!ctype_alnum($gender)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> your selection of gender is not valid.</p></div>');
}
else  if(!ctype_alnum($country)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> your selection of country is not valid.</p></div>');
}
else  if(!ctype_alnum($dob_year)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> your selection of Date Of Birth [year] is not valid.</p></div>');
}
else  if(!ctype_alnum($dob_day)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> your selection of Date Of Birth [day] is not valid.</p></div>');
}
else  if(!ctype_alnum($dob_month)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> your selection of Date Of Birth [month] is not valid.</p></div>');
}
else	
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$checkid = $db->Execute("SELECT ID
					  FROM
					     [Login]
                  WHERE
                      ID = '".$usernames."' ");
$ri = $checkid->fetchrow();
$checke = $db->Execute("SELECT [Email Address]
					  FROM
					     [Login]
                  WHERE
                      [Email Address] = '$emaill'

                  ");
$rs = $checke->fetchrow();
if(!empty($ri[0])){
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Account ID Already Taken, Choose Another One.</p></div>');
}elseif(!empty($rs[0])){
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Email Address Already Used, Choose Another One.</p></div>');
}else{
if(empty($error)) { 
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$passwords = Passwords::encode($passwords);
$sn = RandomKeys(15);
$active = RandomKeys(40);
$ip = $_SERVER['REMOTE_ADDR'];
$date = date( 'F. dS. Y - H:i' );
$reg = $db->Execute("INSERT INTO
                        [Login] ([ID],[PWD],[Birth],[Type],[ExpTime],[Info],[Email Address],[Secret Number],[Activation Key] , [Registration_IP] , [Registration_Date] , [Date of Birth] , [Gender] , [Country] ,[Status])
                    VALUES
                        ('".$usernames."',".$passwords.",'19190101',1,4000,0,'".$emaill."','$sn','$active' ,'$ip' ,'$date' , '".$dob_day.'/'.$dob_month.'/'.$dob_year."', '".$gender."','".$country."','Not Activated')
                    ");
if($reg){
if(SendActivationEmail($emaill, $usernames, $password2, $sn, $active)){};
$error['success'] = sprintf(UI_ERROR,'<center><div class="msg msg-ok"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								Success : </strong> Congratulation. Account has been registered successfully.</p></div></center>
								
								<br><br><font color="red" size="2"><strong></strong></font>
								
								  

								');
}
}  		        }
}
}
;echo ' <title>Registration</title>
		
';
if(!@$error['success']){
;echo '	
 
	  	 <form action="" method="post">
      <div id="items" class="shadowed">
      <div class="inner-boundary">
        <ul class="item-list signup">
          <li class="first-item">
      <img class="required-fields" src="images/required.png" alt="" width="92" height="82" />
            <h2 class="decorator"><strong>Create new account</strong></h2>
		  <p class="decorator"></p>
	
 <link rel="stylesheet" type="text/css" href="images/blue0000.css"  />
 	 
								
									';echo @$error['error'];;echo '								
     <input name="user[subscribed_to_foxmail]" type="hidden" value="0" />
								
            <dl class="form-list">
              <dt><font size="2"><strong>Username : </strong></font></dt>
              <dd>
			
			  <input  name="username"  maxlength="16" size="30"  class=\'swifttext\' type="text" onKeyUp="javascript:this.value=this.value.replace(/[&szlig;,&ouml;,&uuml;,&auml;,!,&sect;,$,%,&,/,\\,(,),=,-,:,;,\',+,*,&deg;,^,?,&acute;,`,#,&sup2;,&sup3;,{,},\\,~,|,<,>,&micro;]/g, \'\');" value="" >
               <br/><br><br>
              </dd>
			          
              <dt><font size="2"><strong>Password : </strong></dt>
              <dd>
			
			  <input  name="password"  maxlength="16" size="30"  class=\'swifttext\' type="password" onKeyUp="javascript:this.value=this.value.replace(/[&szlig;,&ouml;,&uuml;,&auml;,!,&sect;,$,%,&,/,\\,(,),=,-,:,;,\',+,*,&deg;,^,?,&acute;,`,#,&sup2;,&sup3;,{,},\\,~,|,<,>,&micro;]/g, \'\');" value="" >
               <br/><br><br>
              </dd>
			  
			   <dt><font size="2"><strong>Retype Password : </strong></dt>
              <dd>
			
			  <input  name="password2"  maxlength="16" size="30"  class=\'swifttext\' type="password" onKeyUp="javascript:this.value=this.value.replace(/[&szlig;,&ouml;,&uuml;,&auml;,!,&sect;,$,%,&,/,\\,(,),=,-,:,;,\',+,*,&deg;,^,?,&acute;,`,#,&sup2;,&sup3;,{,},\\,~,|,<,>,&micro;]/g, \'\');" value="" >
               <br/><br><br>
              </dd>
			  
			  			   <dt><font size="2"><strong>Email Adress :</strong> </dt>
              <dd>
			
			  <input  name="email"  maxlength="50" size="30"  class=\'swifttext\' type="text"  value="" >
               <br/><br><br>
              </dd>
			  			   <dt><font size="2"><strong>Retype Email Adress : </strong></dt>
              <dd>
			   
			  <input  name="email2"  maxlength="50" size="30"  class=\'swifttext\' type="text"  value="" >
               <br/><br><br>
              </dd>
			   
			   <dt><font size="2"><strong>Your Gender : </strong></dt>
              <dd>
			   
		
						
				
							<select id="register_form_gender" name="gender" class=\'sec\'>
								<option selected="selected" value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
									
						<br/><br><br>
              </dd>
			  
			  
			     <dt><font size="2"><strong>Your Date of Birth : </strong></dt>
              <dd>
			   
		
						
					
							<select  id="dob_day" name="dob_day" class=\'sec\'>
								<option selected="selected" value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>							</select>
									<select  id="dob_month" name="dob_month" class=\'sec\'>
								<option selected="selected" value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option>							</select>
							
							<select  id="dob_year" name="dob_year" class=\'sec\'>
								<option selected="selected" value="1997">1997</option>
								<option value="1996">1996</option>
								<option value="1995">1995</option>
								<option value="1994">1994</option>
								<option value="1993">1993</option>
								<option value="1992">1992</option>
								<option value="1991">1991</option>
								<option value="1990">1990</option>
								<option value="1989">1989</option>
								<option value="1988">1988</option>
								<option value="1987">1987</option>
								<option value="1986">1986</option>
								<option value="1985">1985</option>
								<option value="1984">1984</option>
								<option value="1983">1983</option>
								<option value="1982">1982</option>
								<option value="1981">1981</option>
								<option value="1980">1980</option>
								<option value="1979">1979</option>
								<option value="1978">1978</option>
								<option value="1977">1977</option>
								<option value="1976">1976</option>
								<option value="1975">1975</option>
								<option value="1974">1974</option>
								<option value="1973">1973</option>
								<option value="1972">1972</option>
								<option value="1971">1971</option>
								<option value="1970">1970</option>
								<option value="1969">1969</option>
								<option value="1968">1968</option>
								<option value="1967">1967</option>
								<option value="1966">1966</option>
								<option value="1965">1965</option>
								<option value="1964">1964</option>
								<option value="1963">1963</option>
								<option value="1962">1962</option>
								<option value="1961">1961</option>
								<option value="1960">1960</option>
								<option value="1959">1959</option>
								<option value="1958">1958</option>
								<option value="1957">1957</option>
								<option value="1956">1956</option>
								<option value="1955">1955</option>
								<option value="1954">1954</option>
								<option value="1953">1953</option>
								<option value="1952">1952</option>
								<option value="1951">1951</option>
								<option value="1950">1950</option>
								<option value="1949">1949</option>
								<option value="1948">1948</option>
								<option value="1947">1947</option>
								<option value="1946">1946</option>
								<option value="1945">1945</option>
								<option value="1944">1944</option>
								<option value="1943">1943</option>
								<option value="1942">1942</option>
								<option value="1941">1941</option>
								<option value="1940">1940</option>
								<option value="1939">1939</option>
								<option value="1938">1938</option>
								<option value="1937">1937</option>
								<option value="1936">1936</option>
								<option value="1935">1935</option>
								<option value="1934">1934</option>
								<option value="1933">1933</option>
								<option value="1932">1932</option>
								<option value="1931">1931</option>
								<option value="1930">1930</option>
								<option value="1929">1929</option>
								<option value="1928">1928</option>
								<option value="1927">1927</option>
								<option value="1926">1926</option>
								<option value="1925">1925</option>
								<option value="1924">1924</option>
								<option value="1923">1923</option>
								<option value="1922">1922</option>
								<option value="1921">1921</option>
								<option value="1920">1920</option>
								<option value="1919">1919</option>
								<option value="1918">1918</option>
								<option value="1917">1917</option>
								<option value="1916">1916</option>
								<option value="1915">1915</option>
								<option value="1914">1914</option>
								<option value="1913">1913</option>
								<option value="1912">1912</option>
								<option value="1911">1911</option>
								<option value="1910">1910</option>							</select>
					
				
									
						<br/><br><br>
              </dd>
			  
			  <dt><font size="2"><strong>Your Country : </strong></dt>
              <dd>
			   
		
						
					
						 <select name="country" id="id_billing-country" class=\'sec2\'>
<option selected="selected" value="US">United States</option>
<option value="GB">United Kingdom</option>
<option value="AF">Afghanistan</option>
<option value="AX">Aland Islands</option>
<option value="AL">Albania</option>
<option value="DZ">Algeria</option>
<option value="AS">American Samoa</option>
<option value="AD">Andorra</option>
<option value="AO">Angola</option>
<option value="AI">Anguilla</option>
<option value="AQ">Antarctica</option>
<option value="AG">Antigua and Barbuda</option>
<option value="AR">Argentina</option>
<option value="AM">Armenia</option>
<option value="AW">Aruba</option>
<option value="AU">Australia</option>
<option value="AT">Austria</option>
<option value="AZ">Azerbaijan</option>
<option value="BS">Bahamas</option>
<option value="BH">Bahrain</option>
<option value="BD">Bangladesh</option>
<option value="BB">Barbados</option>
<option value="BY">Belarus</option>
<option value="BE">Belgium</option>
<option value="BZ">Belize</option>
<option value="BJ">Benin</option>
<option value="BM">Bermuda</option>
<option value="BT">Bhutan</option>
<option value="BO">Bolivia</option>
<option value="BA">Bosnia and Herzegovina</option>
<option value="BW">Botswana</option>
<option value="BV">Bouvet Island</option>
<option value="BR">Brazil</option>
<option value="IO">British Indian Ocean Territory</option>
<option value="BN">Brunei Darussalam</option>
<option value="BG">Bulgaria</option>
<option value="BF">Burkina Faso</option>
<option value="BI">Burundi</option>
<option value="KH">Cambodia</option>
<option value="CM">Cameroon</option>
<option value="CA">Canada</option>
<option value="CV">Cape Verde</option>
<option value="KY">Cayman Islands</option>
<option value="CF">Central African Republic</option>
<option value="TD">Chad</option>
<option value="CL">Chile</option>
<option value="CN">China</option>
<option value="CX">Christmas Island</option>
<option value="CC">Cocos (Keeling) Islands</option>
<option value="CO">Colombia</option>
<option value="KM">Comoros</option>
<option value="CG">Congo</option>
<option value="CD">Congo, The Democratic Republic of the</option>
<option value="CK">Cook Islands</option>
<option value="CR">Costa Rica</option>
<option value="CI">Cote d\'Ivoire</option>
<option value="HR">Croatia</option>
<option value="CU">Cuba</option>
<option value="CY">Cyprus</option>
<option value="CZ">Czech Republic</option>
<option value="DK">Denmark</option>
<option value="DJ">Djibouti</option>
<option value="DM">Dominica</option>
<option value="DO">Dominican Republic</option>
<option value="EC">Ecuador</option>
<option value="EG">Egypt</option>
<option value="SV">El Salvador</option>
<option value="GQ">Equatorial Guinea</option>
<option value="ER">Eritrea</option>
<option value="EE">Estonia</option>
<option value="ET">Ethiopia</option>
<option value="FK">Falkland Islands (Malvinas)</option>
<option value="FO">Faroe Islands</option>
<option value="FJ">Fiji</option>
<option value="FI">Finland</option>
<option value="FR">France</option>
<option value="GF">French Guiana</option>
<option value="PF">French Polynesia</option>
<option value="TF">French Southern Territories</option>
<option value="GA">Gabon</option>
<option value="GM">Gambia</option>
<option value="GE">Georgia</option>
<option value="DE">Germany</option>
<option value="GH">Ghana</option>
<option value="GI">Gibraltar</option>
<option value="GR">Greece</option>
<option value="GL">Greenland</option>
<option value="GD">Grenada</option>
<option value="GP">Guadeloupe</option>
<option value="GU">Guam</option>
<option value="GT">Guatemala</option>
<option value="GG">Guernsey</option>
<option value="GN">Guinea</option>
<option value="GW">Guinea-Bissau</option>
<option value="GY">Guyana</option>
<option value="HT">Haiti</option>
<option value="HM">Heard Island and McDonald Islands</option>
<option value="VA">Holy See (Vatican City State)</option>
<option value="HN">Honduras</option>
<option value="HK">Hong Kong</option>
<option value="HU">Hungary</option>
<option value="IS">Iceland</option>
<option value="IN">India</option>
<option value="ID">Indonesia</option>
<option value="IR">Iran, Islamic Republic of</option>
<option value="IQ">Iraq</option>
<option value="IE">Ireland</option>
<option value="IM">Isle of Man</option>
<option value="IL">Israel</option>
<option value="IT">Italy</option>
<option value="JM">Jamaica</option>
<option value="JP">Japan</option>
<option value="JE">Jersey</option>
<option value="JO">Jordan</option>
<option value="KZ">Kazakhstan</option>
<option value="KE">Kenya</option>
<option value="KI">Kiribati</option>
<option value="KP">Korea, Democratic People\'s Republic of</option>
<option value="KR">Korea, Republic of</option>
<option value="KW">Kuwait</option>
<option value="KG">Kyrgyzstan</option>
<option value="LA">Lao People\'s Democratic Republic</option>
<option value="LV">Latvia</option>
<option value="LB">Lebanon</option>
<option value="LS">Lesotho</option>
<option value="LR">Liberia</option>
<option value="LY">Libyan Arab Jamahiriya</option>
<option value="LI">Liechtenstein</option>
<option value="LT">Lithuania</option>
<option value="LU">Luxembourg</option>
<option value="MO">Macao</option>
<option value="MK">Macedonia, The Former Yugoslav Republic of</option>
<option value="MG">Madagascar</option>
<option value="MW">Malawi</option>
<option value="MY">Malaysia</option>
<option value="MV">Maldives</option>
<option value="ML">Mali</option>
<option value="MT">Malta</option>
<option value="MH">Marshall Islands</option>
<option value="MQ">Martinique</option>
<option value="MR">Mauritania</option>
<option value="MU">Mauritius</option>
<option value="YT">Mayotte</option>
<option value="MX">Mexico</option>
<option value="FM">Micronesia, Federated States of</option>
<option value="MD">Moldova</option>
<option value="MC">Monaco</option>
<option value="MN">Mongolia</option>
<option value="ME">Montenegro</option>
<option value="MS">Montserrat</option>
<option value="MA">Morocco</option>
<option value="MZ">Mozambique</option>
<option value="MM">Myanmar</option>
<option value="NA">Namibia</option>
<option value="NR">Nauru</option>
<option value="NP">Nepal</option>
<option value="NL">Netherlands</option>
<option value="AN">Netherlands Antilles</option>
<option value="NC">New Caledonia</option>
<option value="NZ">New Zealand</option>
<option value="NI">Nicaragua</option>
<option value="NE">Niger</option>
<option value="NG">Nigeria</option>
<option value="NU">Niue</option>
<option value="NF">Norfolk Island</option>
<option value="MP">Northern Mariana Islands</option>
<option value="NO">Norway</option>
<option value="OM">Oman</option>
<option value="PK">Pakistan</option>
<option value="PW">Palau</option>
<option value="PS">Palestinian Territory, Occupied</option>
<option value="PA">Panama</option>
<option value="PG">Papua New Guinea</option>
<option value="PY">Paraguay</option>
<option value="PE">Peru</option>
<option value="PH">Philippines</option>
<option value="PN">Pitcairn</option>
<option value="PL">Poland</option>
<option value="PT">Portugal</option>
<option value="PR">Puerto Rico</option>
<option value="QA">Qatar</option>
<option value="RE">Reunion</option>
<option value="RO">Romania</option>
<option value="RU">Russian Federation</option>
<option value="RW">Rwanda</option>
<option value="BL">Saint Barthelemy</option>
<option value="SH">Saint Helena</option>
<option value="KN">Saint Kitts and Nevis</option>
<option value="LC">Saint Lucia</option>
<option value="MF">Saint Martin</option>
<option value="PM">Saint Pierre and Miquelon</option>
<option value="VC">Saint Vincent and the Grenadines</option>
<option value="WS">Samoa</option>
<option value="SM">San Marino</option>
<option value="ST">Sao Tome and Principe</option>
<option value="SA">Saudi Arabia</option>
<option value="SN">Senegal</option>
<option value="RS">Serbia</option>
<option value="SC">Seychelles</option>
<option value="SL">Sierra Leone</option>
<option value="SG">Singapore</option>
<option value="SK">Slovakia</option>
<option value="SI">Slovenia</option>
<option value="SB">Solomon Islands</option>
<option value="SO">Somalia</option>
<option value="ZA">South Africa</option>
<option value="GS">South Georgia and the South Sandwich Islands</option>
<option value="ES">Spain</option>
<option value="LK">Sri Lanka</option>
<option value="SD">Sudan</option>
<option value="SR">Suriname</option>
<option value="SJ">Svalbard and Jan Mayen</option>
<option value="SZ">Swaziland</option>
<option value="SE">Sweden</option>
<option value="CH">Switzerland</option>
<option value="SY">Syrian Arab Republic</option>
<option value="TW">Taiwan, Province of China</option>
<option value="TJ">Tajikistan</option>
<option value="TZ">Tanzania, United Republic of</option>
<option value="TH">Thailand</option>
<option value="TL">Timor-Leste</option>
<option value="TG">Togo</option>
<option value="TK">Tokelau</option>
<option value="TO">Tonga</option>
<option value="TT">Trinidad and Tobago</option>
<option value="TN">Tunisia</option>
<option value="TR">Turkey</option>
<option value="TM">Turkmenistan</option>
<option value="TC">Turks and Caicos Islands</option>
<option value="TV">Tuvalu</option>
<option value="UG">Uganda</option>
<option value="UA">Ukraine</option>
<option value="AE">United Arab Emirates</option>
<option value="UM">United States Minor Outlying Islands</option>
<option value="UY">Uruguay</option>
<option value="UZ">Uzbekistan</option>
<option value="VU">Vanuatu</option>
<option value="VE">Venezuela</option>
<option value="VN">Viet Nam</option>
<option value="VG">Virgin Islands, British</option>
<option value="VI">Virgin Islands, U.S.</option>
<option value="WF">Wallis and Futuna</option>
<option value="EH">Western Sahara</option>
<option value="YE">Yemen</option>
<option value="ZM">Zambia</option>
<option value="ZW">Zimbabwe</option>
</select>
									
						<br/><br>
              </dd>
			  
			  			  			   <dt> </dt>
              <dd>

               <br/><br>

			  			   <dt> </dt>
              <dd>
			   
			<input checked="checked" name="accept" type="checkbox"> <font color="green" >I Agree to the rules of game. </font>     
			 <br/><br>
              </dd>
			      <dt> </dt>
              <dd>
			   
			<input checked="checked" name="accept" type="checkbox"> <font color="red" >I have read the [ Notes ] and entered the correct information.</font>   </font>     
			 <br/><br><br><br></font> </font> </font> 
              </dd>
   
						   
              <dd>
            
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button type="submit" class="link-button">
                <span class="sprite"><em class="sprite">Create Your Account</em></span>
              </button>
            </li>
        </ul> 
		



      </div>
    </div>
<br><br>
  
</form>
  </div>
  ';
} else {
;echo '<font size="2">
	  	 <form action="" method="post">
      <div id="items" class="shadowed">
      <div class="inner-boundary">
        <ul class="item-list signup">
          <li class="first-item">	
      <img class="required-fields" src="images/required.png" alt="" width="92" height="82" />
            <h2 class="decorator"><strong>Account Registered</strong></h2>
		  <p class="decorator"></p>
	

 	 
       <link rel="stylesheet" type="text/css" href="images/blue0000.css"  />
 	 
								
     <input name="user[subscribed_to_foxmail]" type="hidden" value="0" />
								
         
          
          
           
<center>
<br><br>';echo @$error['success'];;echo '	

<font color="green" size="3"><strong><br></font><font color="red" size="2">You will receive a message on your email address with activation code <br>To Activate your account.
<br><br><font color="blue">You Must Activate your account to able to login to the game</font></font>
<br><br></b></strong><br><font size="2">
If you didn\'t find the message in <strong>Inbox</strong> Check <strong>Spam</strong></font>
<br><font color="red" size="2"></font></font></font>
<br><dl class="form-list"></strong></strong><br>
<a href="../activate_code" target="_blank"><b><font size="2">Resend Activation Code</b></a></font>


</font>
              <dd>
			
             
			   <br/><br><br>
              <dd>
            


              



			   </div>
    </div> 
<br><br>
  
</form>
  </div>

';
}
;echo '

';
break;
case'activate':
define('UI_ERROR','%s');
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$active = $_POST['active'];
$errors = array();
if(!ctype_alnum($active)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Illigal characters in Activation Code.</p></div>');
}else if (strlen($active) > 50){
$error['error'] = sprintf(UI_ERROR, '<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Activation Code Is Too Long.</p></div>');
} else
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$sql = $db->Execute("SELECT [Activation Key],[Type] FROM Login
								WHERE
 [Activation Key] = '".$active."'
");
$row = $sql->fetchrow();
if(empty($row[0])){
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong>Activation Code Not Correct.</p></div>');
}else
if($row[1] != 1){
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR</strong> Account Already Activated.</p></div>');
}else{
if(empty($error)) {
$activatedate = date( 'F. dS. Y - H:i' );
$activeaa = $db->Execute("UPDATE [Login] SET [Type] = 0 , [Activation Date] = '".$activatedate."',  [Status] = 'Normal Member' WHERE [Activation Key] = '".$active."'");
if($activeaa){
$acct = $db->Execute("SELECT [Secret Number],[PWD],[ID],[Email Address] FROM Login
								WHERE
 [Activation Key] = '".$active."'
");
$rown = $acct->fetchrow();
$pw  = decode($rown[1]);
$sn  = $rown[0];
$emails  = $rown[3];
$id  = $rown[2];
if(SendinfosEmail($emails, $id, $pw, $sn)){};
$error['success'] = sprintf(UI_ERROR,'<div class="msg msg-ok"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								Your account has been activated successfully.</strong> </p></div>
								 <br>    <div class="msg msg-ok"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								You will receive a message on your e-mail with account details.</strong> </p></div> 
								<br>
    <div class="msg msg-ok"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								You can now login to the game.</strong> </p></div>');
}
}
}
}
}
;echo ' <title>Activate Account</title>
<font size="2">
	  	 <form action="" method="post">
      <div id="items" class="shadowed">
      <div class="inner-boundary">
        <ul class="item-list signup">
          <li class="first-item">	
		  ';
if(!@$error['success']){
;echo '	
      <img class="required-fields" src="images/signup01.png" alt="" width="98" height="110" />
            <h2 class="decorator"><strong>Activate your account</strong></h2>
		  <p class="decorator"></p>
	

 	 
       <link rel="stylesheet" type="text/css" href="images/blue0000.css"  />
 	 
							';echo @$error['error'];;echo '		
     <input name="user[subscribed_to_foxmail]" type="hidden" value="0" />
								
         
          
          
           
<center>
		
<font color="green" size="3"><strong><br></font><font size="2">

<br><font color="red" size="2">Put the Activation Code in this field to activate your account</font></font></font>
<br><br><br><dl class="form-list"></strong></strong>

<dt><font size="2"><strong>Activation Code : </strong></font></dt>
              <dd>
			
             
			  <input  name="active"  AutoComplete="off" maxlength="50" size="30"  class=\'swifttext\' type="text"  value="" >
               <br/><br><br>
              <dd>
            



              <button type="submit" class="link-button" >
                <span class="sprite"><em class="sprite">Activate Account</em></span>
              </button></strong></strong>
			  
			  

		
    

';
} else {
;echo '      <img class="required-fields" src="images/signup01.png" alt="" width="98" height="110" />
            <h2 class="decorator"><strong>Your Account Activated</strong></h2>
		  <p class="decorator"></p>
	

 	 
       <link rel="stylesheet" type="text/css" href="images/blue0000.css"  />
';echo @$error['success'];;echo '	
';
}
;echo '
			   </div>
    </div> 
<br><br>
  
</form>
  </div>
  
  ';
break;
case'activated':
define('UI_ERROR','%s');
$active = $_GET['activekey'];
$errors = array();
if(!ctype_alnum($active)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Illigal characters in Activation Code.</p></div>');
}else if (strlen($active) > 50){
$error['error'] = sprintf(UI_ERROR, '<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Activation Code Is Too Long.</p></div>');
} else
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$sql = $db->Execute("SELECT [Activation Key],[Type] FROM Login
								WHERE
 [Activation Key] = '".$active."'
");
$row = $sql->fetchrow();
if(empty($row[0])){
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong>Activation Code Not Correct.</p></div>');
}else
if($row[1] != 1){
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR</strong> Account Already Activated.</p></div>');
}else{
if(empty($error)) {
$activatedate = date( 'F. dS. Y - H:i' );
$activeaa = $db->Execute("UPDATE [Login] SET [Type] = 0 ,[Activation Date] = '".$activatedate."', [Status] = 'Normal Member' WHERE [Activation Key] = '".$active."'");
if($activeaa){
$acct = $db->Execute("SELECT [Secret Number],[PWD],[ID],[Email Address] FROM Login
								WHERE
 [Activation Key] = '".$active."'
");
$rown = $acct->fetchrow();
$pw  = decode($rown[1]);
$sn  = $rown[0];
$emails  = $rown[3];
$id  = $rown[2];
if(SendinfosEmail($emails, $id, $pw, $sn)){};
$error['success'] = sprintf(UI_ERROR,'<div class="msg msg-ok"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								Your account has been activated successfully.</strong> </p></div>
								 <br>								
    <div class="msg msg-ok"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								You will receive a message on your e-mail with account details.</strong> </p></div> 
								<br>
    <div class="msg msg-ok"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								You can now login to the game.</strong> </p></div>');
}
}
}
}
;echo ' <title>Activate Account</title>
<font size="2">
	  	 <form action="" method="post">
      <div id="items" class="shadowed">
      <div class="inner-boundary">
        <ul class="item-list signup">
          <li class="first-item">	
		  ';
if(!@$error['success']){
;echo '	
      <img class="required-fields" src="images/signup01.png" alt="" width="98" height="110" />
            <h2 class="decorator"><strong>Activate your account</strong></h2>
		  <p class="decorator"></p>
	

 	 
       <link rel="stylesheet" type="text/css" href="images/blue0000.css"  />
 	 <br><br>
							';echo @$error['error'];;echo '		
     <input name="user[subscribed_to_foxmail]" type="hidden" value="0" />
								
        
<center>
		


';
} else {
;echo '      <img class="required-fields" src="images/signup01.png" alt="" width="98" height="110" />
            <h2 class="decorator"><strong>Your Account Activated</strong></h2>
		  <p class="decorator"></p>
	

 	 
       <link rel="stylesheet" type="text/css" href="images/blue0000.css"  />
';echo @$error['success'];;echo '	
';
}
;echo '
			   </div>
    </div> 
<br><br>
  
</form>
  </div>
  
';
break;
}
;echo '
<div class="large-sidebar">


    <h4 class="decorator title sprite"><strong>  Read this before registering &nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ Notes ]</strong></h4>
    <div class="inner-boundary first-item last-item">
      <div class="inner-border">
    
    
  
          <ul class="fancy-list">
            <li>After you have registered will receive a message with information on your e-mail address that you typed</li>
            <li>After recording, you must activate your account to be able to enter the game</li>
            <li>If you lost your account information you can retrieved through e-mail of your account</li>
            <li>In the end, follow the rules and play fair</li>
          </ul>
    <br />

      </div>
    </div>
  </div>

</div>

<div class="clear"><!-- --></div>

      </div>
    </div>
  
    
  </div>
  



 

</td><center>
    <div class="msgs msgs-oks"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								Coded By <a href="mailto:the_dragon20072008@hotmail.com">TheDragoN</a></strong> </p></div>
								
								<br>';
?>