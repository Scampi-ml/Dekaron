<?php
$SQLquery1 = $db->SQLquery("SELECT character_no FROM character.dbo.user_character");   
$smarty->assign("SQLquery1", number_format($db->SQLfetchNum($SQLquery1))); 
$SQLquery2 = $db->SQLquery("SELECT user_id FROM account.dbo.user_profile");   
$smarty->assign("SQLquery2", number_format($db->SQLfetchNum($SQLquery2))); 
$SQLquery3 = $db->SQLquery("SELECT user_id FROM account.dbo.user_profile WHERE login_flag = '1100' ");  
$smarty->assign("SQLquery3", number_format($db->SQLfetchNum($SQLquery3))); 
$SQLquery4 = $db->SQLquery("SELECT user_id FROM account.dbo.user_profile WHERE login_tag = 'N' ");   
$smarty->assign("SQLquery4", number_format($db->SQLfetchNum($SQLquery4))); 
$SQLquery5 = $db->SQLquery("SELECT * FROM character.dbo.guild_info ");   
$smarty->assign("SQLquery5", number_format($db->SQLfetchNum($SQLquery5))); 
$SQLquery6 = $db->SQLquery("SELECT * FROM character.dbo.cm_bcd_item ");   
$smarty->assign("SQLquery6", number_format($db->SQLfetchNum($SQLquery6))); 
$SQLquery7 = $db->SQLquery("SELECT character_no FROM character.dbo.del_user_char_list ");   
$smarty->assign("SQLquery7", number_format($db->SQLfetchNum($SQLquery7))); 
$SQLquery8 = $db->SQLquery("SELECT * FROM character.dbo.GUILD_CHAR_INFO ");   
$smarty->assign("SQLquery8", number_format($db->SQLfetchNum($SQLquery8))); 
$SQLquery9 = $db->SQLquery("SELECT * FROM character.dbo.user_suit ");   
$smarty->assign("SQLquery9", number_format($db->SQLfetchNum($SQLquery9))); 
$SQLquery10 = $db->SQLquery("SELECT * FROM character.dbo.USER_POSTBOX ");   
$smarty->assign("SQLquery10", number_format($db->SQLfetchNum($SQLquery10)));  
$SQLquery11 = $db->SQLquery("SELECT * FROM character.dbo.USER_POSTBOX_SECEDE ");   
$smarty->assign("SQLquery11", number_format($db->SQLfetchNum($SQLquery11))); 
$SQLquery12 = $db->SQLquery("SELECT * FROM character.dbo.User_Quest_Doing ");   
$smarty->assign("SQLquery12", number_format($db->SQLfetchNum($SQLquery12))); 
$SQLquery13 = $db->SQLquery("SELECT * FROM character.dbo.User_Quest_Done ");   
$smarty->assign("SQLquery13", number_format($db->SQLfetchNum($SQLquery13))); 
$SQLquery14 = $db->SQLquery("SELECT * FROM character.dbo.user_skill ");   
$smarty->assign("SQLquery14", number_format($db->SQLfetchNum($SQLquery14))); 
$SQLquery15 = $db->SQLquery("SELECT * FROM character.dbo.user_storage ");   
$smarty->assign("SQLquery15", number_format($db->SQLfetchNum($SQLquery15))); 
$SQLquery16 = $db->SQLquery("SELECT * FROM character.dbo.USER_STORE ");   
$smarty->assign("SQLquery16", number_format($db->SQLfetchNum($SQLquery16))); 
$SQLquery17 = $db->SQLquery("SELECT * FROM character.dbo.user_bag ");   
$smarty->assign("SQLquery17", number_format($db->SQLfetchNum($SQLquery17))); 
$SQLquery18 = $db->SQLquery("SELECT * FROM character.dbo.user_bag_secede ");  
$smarty->assign("SQLquery18",  number_format($db->SQLfetchNum($SQLquery18))); 
?>