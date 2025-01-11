<?php
/*
+--------------------------------------------------------------------------
|   IP.Board v3.1.4
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


class SQLVC
{
	public static function updateOne( $old, $field )
	{
		$DB  = ipsRegistry::DB();
		$PRE = ipsRegistry::dbFunctions()->getPrefix();

		return "UPDATE {$PRE}pfields_content
						SET {$PRE}pfields_content.field_{$field['pf_id']}={$PRE}member_extra.{$old}
					FROM {$PRE}pfields_content, {$PRE}member_extra
					WHERE {$PRE}pfields_content.member_id={$PRE}member_extra.id";;
	}
	
	public static function updateTwo( $gender )
	{
		$DB  = ipsRegistry::DB();
		$PRE = ipsRegistry::dbFunctions()->getPrefix();

		return "UPDATE {$PRE}pfields_content SET {$PRE}pfields_content.field_{$gender['pf_id']}='f' FROM {$PRE}profile_portal, {$PRE}pfields_content WHERE {$PRE}profile_portal.pp_gender='female' AND {$PRE}profile_portal.pp_member_id={$PRE}pfields_content.member_id";
	}
	
	public static function updateThree( $gender )
	{
		$DB  = ipsRegistry::DB();
		$PRE = ipsRegistry::dbFunctions()->getPrefix();

		return "UPDATE {$PRE}pfields_content SET {$PRE}pfields_content.field_{$gender['pf_id']}='m' FROM {$PRE}profile_portal, {$PRE}pfields_content WHERE {$PRE}profile_portal.pp_gender='male' AND {$PRE}profile_portal.pp_member_id={$PRE}pfields_content.member_id";
	}
}

