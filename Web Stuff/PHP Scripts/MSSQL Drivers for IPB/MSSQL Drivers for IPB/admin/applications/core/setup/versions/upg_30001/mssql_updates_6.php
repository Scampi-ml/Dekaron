<?php
/*
+--------------------------------------------------------------------------
|   I[{$PRE}profile_portal].Board v3.1.4
|   ========================================
|   by Matthew Mecham
|   (c) 2001 - 2004 Invision Power Services
|   http://www.invisionpower.com
|   ========================================
|   Web: http://www.invisionboard.com
|   Email: matt@invisionpower.com
|   Licence Info: http://www.invisionboard.com/?license
+---------------------------------------------------------------------------
*/

$PRE = trim(ipsRegistry::dbFunctions()->getPrefix());

# Member table updates
# We use [] on the second table to stop IPSSetUp::addPrefixToQuery() from stripping the prefix

$SQL[] = "UPDATE members SET [{$PRE}members].members_pass_hash=[{$PRE}members_converge].converge_pass_hash FROM [{$PRE}members], [{$PRE}members_converge] WHERE [{$PRE}members_converge].converge_id=[{$PRE}members].member_id;";
$SQL[] = "UPDATE members SET [{$PRE}members].members_pass_salt=[{$PRE}members_converge].converge_pass_salt FROM [{$PRE}members], [{$PRE}members_converge] WHERE [{$PRE}members_converge].converge_id=[{$PRE}members].member_id;";

# Blank email addresses
$SQL[] = "UPDATE members SET email=CAST(member_id as VARCHAR ) + '-' + CAST( DATEDIFF(s, '19700101', GETDATE()) as VARCHAR) + '@fakeemail.com' WHERE email='';";

# If we upgraded from 2.1.0ish then we may not have anything in profile_portal so...
$count = ipsRegistry::DB()->buildAndFetch( array( 'select' => 'count(*) as count',
												  'from'   => 'profile_portal' ) );
												
if ( ! $count['count'] )
{
	ipsRegistry::DB()->update( 'member_extra', array( 'ta_size' => '' ), 'ta_size IS NULL' );
	ipsRegistry::DB()->allow_sub_select = 1;
	$SQL[] ="INSERT INTO profile_portal (pp_member_id,notes,links,bio,ta_size,signature,avatar_location,avatar_size,avatar_type) SELECT id,notes,links,bio,ta_size,signature,avatar_location,avatar_size,avatar_type FROM [{$PRE}member_extra]";
}
else
{
	ipsRegistry::DB()->update( 'member_extra', array( 'ta_size' => '' ), 'ta_size IS NULL' );
	
	$SQL[] = "UPDATE profile_portal SET [{$PRE}profile_portal].notes=CAST([{$PRE}member_extra].notes as VARCHAR(255)),
								 		[{$PRE}profile_portal].links=CAST([{$PRE}member_extra].links as VARCHAR(255)),
								 		[{$PRE}profile_portal].bio=CAST([{$PRE}member_extra].bio as VARCHAR(255)),
								 		[{$PRE}profile_portal].ta_size=CAST([{$PRE}member_extra].ta_size as VARCHAR(255)),
								 		[{$PRE}profile_portal].signature=CAST([{$PRE}member_extra].signature as VARCHAR(MAX)),
								 		[{$PRE}profile_portal].avatar_location=CAST([{$PRE}member_extra].avatar_location as VARCHAR(255)),
								 		[{$PRE}profile_portal].avatar_size=CAST([{$PRE}member_extra].avatar_size as VARCHAR(255)),
								 		[{$PRE}profile_portal].avatar_type=CAST([{$PRE}member_extra].avatar_type  as VARCHAR(255))
			  FROM [{$PRE}member_extra], [{$PRE}profile_portal]
			  WHERE [{$PRE}profile_portal].pp_member_id=[{$PRE}member_extra].id;";
}

$SQL[] = "UPDATE profile_portal SET pp_setting_count_friends=5 WHERE pp_setting_count_friends=0;";
$SQL[] = "UPDATE profile_portal SET pp_setting_count_comments=10 WHERE pp_setting_count_comments=0;";
$SQL[] = "UPDATE profile_portal SET pp_setting_count_visitors=5 WHERE pp_setting_count_visitors=0;";

$SQL[] = "SET IDENTITY_INSERT core_sys_lang ON;";
$SQL[] = "INSERT INTO core_sys_lang (lang_id, lang_short, lang_title, lang_currency_name, lang_currency_symbol, lang_decimal, lang_comma, lang_default, lang_isrtl) VALUES (1, 'en_US', 'English (USA)', 'USD', '$', '.', ',', 1, 0);";
$SQL[] = "SET IDENTITY_INSERT core_sys_lang OFF;";

?>