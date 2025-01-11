<?php
// written by zombe and  
// modifyed janvier123 :) 
// cleaning up after is ass :) 
//----------------------------------------------- 
// This script is made for players to reborn themselfs 
// But its has some limits inside 
//    - Cant Reborn a [GM] character 
//      - Can have some bug, that i cant find :) 
// 
// How does it work ? 
// - Enter a name 
// - Check the requirements 
// - Press "Yes, make me rebiorn plz 
// - Done :) 
//----------------------------------------------- 


// Please fill in your MSSQL Info 
//<--! begin MSSQL info !--> 
$mssql = array( 
        'host' => "localhost",    // Normaly "localhost" or "XXX.XXX.XXX.XXX" 
        'user' => "sa",            // Your username for MSSQL server, normaly "sa" 
        'pass' => "server"        // Your password for MSSQL server 
    ); 
//<--! ind MSSQL info !--> 


// Please fill in your Classes info if not correct 
//<--! begin classes info !--> 
$classes = array( 
'0' => "Azure Knight",  
'1' => "Segita Hunter",  
'2' => "Incar Magician",  
'3' => "Vicious Summoner",  
'4' => "Segnale",  
'5' => "Bagi Warrior", 
'6' => "Aloken" 
); 
//<--! end classes info !--> 


// Please fill in your requirements if not correct 
// WARNING DO NOT PUT "." BETWEEN "dil" 
//<--! begin requirements info !--> 
$req = array(  
'name' =>  "Any name... Duh!", 
'level' => "170", 
'dil' => "50000000", 
'class' => "Any class... Duh!", 
'reborn' => "None" 
); 
//<--! end requirements info !--> 


// Please chance if you want 
//<--! begin text info !--> 
$text = array(  
'title1' =>  "Is this correct?", 
'title2' => "Your new stats.", 
'button1' => "Next ...", 
'step1' => "Enter character name:", 
'table1' => "--------- Type ---------", 
'table2' => "--------- Current ---------", 
'table3' => "--------- Required ---------", 
'done' => "Reborn was successful, blah.", 
'error1' => "Something went wrong, lol", 
'error2' => "No such character" 
); 
//<--! end text info !--> 

// Step 1: 
// Getting name to fill in the table below and to exec the reborn script 

if ($_GET['step'] == ""){ 
    echo'<center><Form Name ="form" action="reborn.php?step=2" Method ="POST">'; 
    echo''.$text['step1'].'<p>'; 
    echo'<input name="name" type="text" value="">'; 
    echo'<br>'; 
    echo'<input type="hidden" name="select" value="1">'; 
    echo'<input name="submit" type="submit" value="'.$text['button1'].'">'; 
    echo'</form></center>'; 

// getting name from form and go to step 2 
// OK time for step 2 

} else if ($_GET['step'] == "2"){ 

        if($_POST['select'] == '1') { 
        $ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']); 
        $result1 = mssql_query("SELECT * FROM character.dbo.user_character WHERE character_name = '".$_POST['name']."'",$ms_con); 
        $count1 = mssql_num_rows($result1); 

        if($count1 < '1') { 
            echo "<center><br>Could not find the character name. <br><a href='javascript:history.back()'>Go Back</a></center>"; 
        } elseif($count > '1') { 
            echo "<center><br>There were several characters with the same name found. <br>Please check that name in the database.<br><a href='javascript:history.back()'>Go Back</a></center>"; 
             
        } else { 
        $ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']); 
        $result2 = mssql_query("SELECT character_name,dwExp,dwMoney,wLevel,Reborn FROM character.dbo.user_character WHERE character_name = '".$_POST['name']."'",$ms_con); 
        $row2 = mssql_fetch_row($result2); 
             
            echo "<center><br><form action='reborn.php?step=3' method='POST'> 
                <table class='innertab'> 
                    <tr> 
                        <td colspan='3' align='left'><b><center>".$text['title1']."</center></b></td> 
                    </tr> 
                    <tr> 
                        <td colspan='3' align='left'>&nbsp;</td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>".$text['table1']."</b></td> 
                        <td align='left'><b>".$text['table2']."</b></td> 
                        <td align='left'><b>".$text['table3']."</b></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>Character Name:</b></td> 
                        <td align='left'><input type='text' name='new_name' readonly=readonly maxlength='20' value='".$row2[0]."'></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$req['name']."'></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>Level:</b></td> 
                        <td align='left'><input type='text' name='new_wLevel' readonly=readonly maxlength='20' value='".$row2[3]."'></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$req['level']."'></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>DIL Inventory:</b></td> 
                        <td align='left'><input type='text' name='new_dwMoney' readonly=readonly maxlength='20' value='".$row2[2]."'></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$req['dil']."'></td> 
                    </tr> 
                        <tr> 
                        <td align='left'><b>Reborn:</b></td> 
                        <td align='left'><input type='text' name='new_reborn' readonly=readonly maxlength='20' value='".$row2[4]."'></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$req['reborn']."'></td> 
                    </tr> 
                    <tr> 
                            <td align='left' colspan='3'> 
                            <input type='submit' value='Yes, make me reborn'> 
                        </tr> 
                </table> 
            </form></center>"; 
            } 
            } 
            // WARNING YOU NEED TO CHANGE "/170/" IF YOU CHANGED YOUR REQUIREMENTS 
             } elseif(!preg_match("/170/", $_POST['new_wLevel'])) { 
            echo "<br><center>The level does not match the requirements.<br><a href='javascript:history.back()'>Go Back</a></center>"; 
             
            // WARNING YOU NEED TO CHANGE "/50000000/" IF YOU CHANGED YOUR REQUIREMENTS             
//             } elseif(!preg_match("/50000000/", $_POST['new_dwMoney'])) { 
//            echo "<br><center>The dill does not match the requirements.<br><a href='javascript:history.back()'>Go Back</a></center>"; 

// if step 2 is ok go to step 3 
// OK time for step 3 
         

} else if ($_GET['step'] == "3"){ 

        $ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']); 
        $result3 = mssql_query(" 
            USE character; 
            EXEC RemoteReborn '".$_POST['new_name']."' 
        ",$ms_con); 
         
        $ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']); 
        $result4 = mssql_query("SELECT character_name,dwExp,wLevel,wStr,wDex,wCon,wSpr,dwMoney,wStatPoint,wSkillPoint,Reborn FROM character.dbo.user_character WHERE character_name = '".$_POST['new_name']."'",$ms_con); 
        $row4 = mssql_fetch_array($result4); 
         
        echo"<center><table class='innertab'> 
                    <tr> 
                        <td colspan='3' align='left'><b><center>".$text['done']."</center></b></td> 
                    </tr> 
                    <tr> 
                        <td colspan='3' align='left'>&nbsp;</td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>".$text['table1']."</b></td> 
                        <td align='left'><b>".$text['table2']."</b></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>Character Name:</b></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$row4[0]."'></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>Exp:</b></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$row4[1]."'></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>Level:</b></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$row4[2]."'></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>Str points:</b></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$row4[3]."'></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>Dex points:</b></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$row4[4]."'></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>Con points:</b></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$row4[5]."'></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>Spr points:</b></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$row4[6]."'></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>Dill:</b></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$row4[7]."'></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>Stat points:</b></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$row4[8]."'></td> 
                    </tr> 
                    <tr> 
                        <td align='left'><b>Dil Inventory:</b></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$row4[9]."'></td> 
                    </tr> 
                        <tr> 
                        <td align='left'><b>Reborn:</b></td> 
                        <td align='left'><input type='text' readonly=readonly maxlength='20' value='".$row4[10]."'></td> 
                    </tr> 
                </table></center>"; 
                 
                echo "<center><br><a href='reborn.php'>Thank you! Take me back now.</a></center>"; 
                 
                } 
        else echo"<p>Something went wrong, lol."; 
         
?> 