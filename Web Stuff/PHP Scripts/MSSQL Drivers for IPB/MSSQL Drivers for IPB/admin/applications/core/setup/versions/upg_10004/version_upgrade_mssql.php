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
|
|   > IPB UPGRADE 1.1 -> 2.0 SQL STUFF!
|   > Script written by Matt Mecham
|   > Date started: 21st April 2004
|   > Interesting fact: Turin Brakes are also good
+--------------------------------------------------------------------------
*/

class version_upgrade
{
	/**
	 * Custom HTML to show
	 *
	 * @access	private
	 * @var		string
	 */
	private $_output = '';

	/**
	* fetchs output
	*
	* @access	public
	* @return	string
	*/
	public function fetchOutput()
	{
		return $this->_output;
	}

	/**
	 * Execute selected method
	 *
	 * @access	public
	 * @param	object		Registry object
	 * @return	void
	 */
	public function doExecute( ipsRegistry $registry )
	{
		/* Make object */
		$this->registry =  $registry;
		$this->DB       =  $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->request  =& $this->registry->fetchRequest();
		$this->cache    =  $this->registry->cache();
		$this->caches   =& $this->registry->cache()->fetchCaches();

		//--------------------------------
		// What are we doing?
		//--------------------------------

		switch( $this->request['workact'] )
		{
			case 'step_1':
				$this->step_1();
				break;
			case 'step_2':
				$this->step_2();
				break;
			case 'step_3':
				$this->step_3();
				break;
			case 'step_4':
				$this->step_4();
				break;
			case 'step_5':
				$this->step_5();
				break;
			case 'step_6':
				$this->step_6();
				break;
			case 'step_7':
				$this->step_7();
				break;
			case 'step_8':
				$this->step_8();
				break;
			case 'step_9':
				$this->step_9();
				break;
			case 'step_10':
				$this->step_10();
				break;
			case 'step_11':
				$this->step_11();
				break;
			case 'step_12':
				$this->step_12();
				break;
			case 'step_13':
				$this->step_13();
				break;
			case 'step_14':
				$this->step_14();
				break;
			case 'step_15':
				$this->step_15();
				break;
			case 'step_16':
				$this->step_16();
				break;
			case 'step_17':
				$this->step_17();
				break;
			case 'step_18':
				$this->step_18();
				break;
			case 'step_19':
				$this->step_19();
				break;
			case 'step_20':
				$this->step_20();
				break;
			case 'step_21':
				$this->step_21();
				break;
			case 'step_22':
				$this->step_22();
				break;
			case 'step_23':
				$this->step_23();
				break;
			case 'step_24':
				$this->step_24();
				break;

			default:
				$this->step_1();
				break;
		}
		if ( $this->request['workact'] )
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 1: COPY AND POPULATE BACK UP FORUMS TABLE
	/*-------------------------------------------------------------------------*/
	function step_1()
	{
		$this->request['st'] = 0;

		// First fix a bug which might exist on older versions of the MSSQL driver
		if ( $this->DB->checkForField('subemthod_custom_4', 'subscription_methods') )
		{
			$this->DB->changeField('subscription_methods', 'subemthod_custom_4', 'submethod_custom_4' );
		}

		$this->DB->renameTable('forums', 'forums_bak');

		$this->DB->query("select name from sysobjects where name in('pk_pid','pk_tid')");
		while ( $keyname = $this->DB->fetch() )
		{
			$SQL[] = "EXEC sp_rename '{$keyname['name']}', '".ipsRegistry::dbFunctions()->getPrefix()."{$keyname['name']}'";
		}

		$this->error = array();
		$this->sqlcount = 3;

		$this->DB->return_die = 1;

		foreach( $SQL as $query )
		{
			$this->DB->allow_sub_select 	= 1;
			$this->DB->error				= '';

			$this->DB->query( $query );

			if ( $this->DB->error )
			{
				$this->registry->output->addError( $query."<br /><br />".$this->DB->error );
			}
			else
			{
				$this->sqlcount++;
			}
		}

		//-----------------------------------------
		// Check...
		//-----------------------------------------

		$this->DB->query( "SELECT COUNT(*) as count FROM ".ipsRegistry::dbFunctions()->getPrefix()."forums_bak" );
		$count = $this->DB->fetch();

		if ( intval( $count['count'] ) < 1 )
		{
			$this->registry->output->addError( "The back-up forums table has not been populated successfully. Continuing this convert WILL delete all forums permanently. Contact technical support immediately." );
		}

		$this->registry->output->addMessage("[Step 1 of 21] Forums table backed up - creating new tables next....<br /><br />{$this->sqlcount} queries run....");
		$this->request['workact'] = 'step_2';
	}

	/*-------------------------------------------------------------------------*/
	// STEP 2: DROP FORUMS TABLE, CREATE NEW TABLES
	/*-------------------------------------------------------------------------*/
	function step_2()
	{
		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."attachments (
		  attach_id int NOT NULL IDENTITY,
		  attach_file varchar(250) NOT NULL default '',
		  attach_location varchar(250) NOT NULL default '',
		  attach_thumb_location varchar(250) NOT NULL default '',
		  attach_hits int NOT NULL default 0,
		  attach_date int NOT NULL default 0,
		  attach_temp tinyint NOT NULL default 0,
		  attach_pid int NOT NULL default 0,
		  attach_post_key varchar(32) NOT NULL default 0,
		  attach_msg int NOT NULL default 0,
		  attach_member_id int NOT NULL default 0,
		  attach_approved int NOT NULL default 1,
		  attach_filesize int NOT NULL default 0,
		  attach_thumb_width smallint NOT NULL default 0,
		  attach_thumb_height smallint NOT NULL default 0,
		  attach_is_image tinyint NOT NULL default 0,
		  attach_ext varchar(10) NOT NULL default '',
		  PRIMARY KEY (attach_id)
		);";
		$SQL[] = "CREATE INDEX attach_pid ON ".ipsRegistry::dbFunctions()->getPrefix()."attachments (attach_pid);";
		$SQL[] = "CREATE INDEX attach_msg ON ".ipsRegistry::dbFunctions()->getPrefix()."attachments (attach_msg);";
		$SQL[] = "CREATE INDEX attach_post_key ON ".ipsRegistry::dbFunctions()->getPrefix()."attachments (attach_post_key);";
		$SQL[] = "CREATE INDEX attach_mid_size ON ".ipsRegistry::dbFunctions()->getPrefix()."attachments (attach_member_id,attach_filesize);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."message_text (
		  msg_id int NOT NULL IDENTITY,
		  msg_date int NULL,
		  msg_post text NULL,
		  msg_cc_users text NULL,
		  msg_sent_to_count smallint NOT NULL default 0,
		  msg_deleted_count smallint NOT NULL default 0,
		  msg_post_key varchar(32) NOT NULL default 0,
		  msg_author_id int NOT NULL default 0,
		  PRIMARY KEY  (msg_id)
		);";
		$SQL[] = "CREATE INDEX msg_date ON ".ipsRegistry::dbFunctions()->getPrefix()."message_text (msg_date);";
		$SQL[] = "CREATE INDEX msg_sent_to_count ON ".ipsRegistry::dbFunctions()->getPrefix()."message_text (msg_sent_to_count);";
		$SQL[] = "CREATE INDEX msg_deleted_count ON ".ipsRegistry::dbFunctions()->getPrefix()."message_text (msg_deleted_count);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."message_topics (
		  mt_id int NOT NULL IDENTITY,
		  mt_msg_id int NOT NULL default 0,
		  mt_date int NOT NULL default 0,
		  mt_title varchar(255) NOT NULL default '',
		  mt_from_id int NOT NULL default 0,
		  mt_to_id int NOT NULL default 0,
		  mt_vid_folder varchar(32) NOT NULL default '',
		  mt_read tinyint NOT NULL default 0,
		  mt_hasattach smallint NOT NULL default 0,
		  mt_hide_cc tinyint NULL default 0,
		  mt_tracking tinyint NULL default 0,
		  mt_owner_id int NOT NULL default 0,
		  mt_user_read int NULL default 0,
		  PRIMARY KEY  (mt_id)
		);";
		$SQL[] = "CREATE INDEX mt_from_id ON ".ipsRegistry::dbFunctions()->getPrefix()."message_topics (mt_from_id);";
		$SQL[] = "CREATE INDEX mt_owner_id ON ".ipsRegistry::dbFunctions()->getPrefix()."message_topics (mt_owner_id,mt_to_id,mt_vid_folder,mt_date);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."skin_sets (
		  set_skin_set_id int NOT NULL IDENTITY,
		  set_name varchar(150) NOT NULL default '',
		  set_image_dir varchar(200) NOT NULL default '',
		  set_hidden tinyint NOT NULL default 0,
		  set_default tinyint NOT NULL default 0,
		  set_css_method varchar(100) NOT NULL default 'inline',
		  set_skin_set_parent smallint NOT NULL default -1,
		  set_author_email varchar(255) NOT NULL default '',
		  set_author_name varchar(255) NOT NULL default '',
		  set_author_url varchar(255) NOT NULL default '',
		  set_css text NOT NULL default '',
		  set_cache_macro text NOT NULL default '',
		  set_wrapper text NOT NULL default '',
		  set_css_updated int NOT NULL default 0,
		  set_cache_css text NOT NULL default '',
		  set_cache_wrapper text NOT NULL default '',
		  set_emoticon_folder varchar(60) NOT NULL default 'default',
		  PRIMARY KEY  (set_skin_set_id)
		);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."skin_templates_cache (
		  template_id varchar(32) NOT NULL default '',
		  template_group_name varchar(255) NOT NULL default '',
		  template_group_content text NOT NULL,
		  template_set_id int NOT NULL default 0,
		  PRIMARY KEY  (template_id)
		);";
		$SQL[] = "CREATE INDEX template_set_id ON ".ipsRegistry::dbFunctions()->getPrefix()."skin_templates_cache (template_set_id);";
		$SQL[] = "CREATE INDEX template_group_name ON ".ipsRegistry::dbFunctions()->getPrefix()."skin_templates_cache (template_group_name);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."mail_queue(
		  mail_id int NOT NULL IDENTITY,
		  mail_date int NOT NULL default 0,
		  mail_to varchar(255) NOT NULL default '',
		  mail_from varchar(255) NOT NULL default '',
		  mail_subject text NOT NULL,
		  mail_content text NOT NULL,
		  mail_type varchar(200) NOT NULL default '',
		  PRIMARY KEY  (mail_id)
		);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."task_manager (
		  task_id int NOT NULL IDENTITY,
		  task_title varchar(255) NOT NULL default '',
		  task_file varchar(255) NOT NULL default '',
		  task_next_run int NOT NULL default 0,
		  task_week_day smallint NOT NULL default -1,
		  task_month_day smallint NOT NULL default -1,
		  task_hour smallint NOT NULL default -1,
		  task_minute smallint NOT NULL default -1,
		  task_cronkey varchar(32) NOT NULL default '',
		  task_log tinyint NOT NULL default 0,
		  task_description text NOT NULL,
		  task_enabled tinyint NOT NULL default 1,
		  task_key varchar(30) NOT NULL default '',
		  task_safemode tinyint NULL,
		  PRIMARY KEY  (task_id)
		);";
		$SQL[] = "CREATE INDEX task_next_run ON ".ipsRegistry::dbFunctions()->getPrefix()."task_manager (task_next_run);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."task_logs (
		  log_id int NOT NULL IDENTITY,
		  log_title varchar(255) NOT NULL default '',
		  log_date int NOT NULL default 0,
		  log_ip varchar(16) NOT NULL default 0,
		  log_desc text NOT NULL,
		  PRIMARY KEY  (log_id)
		);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."custom_bbcode (
		  bbcode_id int NOT NULL IDENTITY,
		  bbcode_title varchar(255) NOT NULL default '',
		  bbcode_desc text NOT NULL,
		  bbcode_tag varchar(255) NOT NULL default '',
		  bbcode_replace text NOT NULL,
		  bbcode_useoption tinyint NOT NULL default 0,
		  bbcode_example text NOT NULL,
		  PRIMARY KEY  (bbcode_id)
		);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings (
		  conf_id int NOT NULL IDENTITY,
		  conf_title varchar(255) NOT NULL,
		  conf_description text NOT NULL,
		  conf_group varchar(255) NOT NULL default '',
		  conf_type varchar(255) NOT NULL default '',
		  conf_key varchar(255) NOT NULL,
		  conf_value text NULL,
		  conf_default text NULL,
		  conf_extra text NULL,
		  conf_evalphp text NULL,
		  conf_protected tinyint NOT NULL default 0,
		  conf_position smallint NOT NULL default 0,
		  conf_start_group varchar(255) NOT NULL default '',
		  conf_end_group tinyint NOT NULL default 0,
		  conf_help_key varchar(255) NOT NULL default 0,
		  conf_add_cache tinyint NOT NULL default 1,
		  PRIMARY KEY  (conf_id)
		);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (
		  conf_title_id smallint NOT NULL IDENTITY,
		  conf_title_title varchar(255) NOT NULL default '',
		  conf_title_desc text NOT NULL,
		  conf_title_count smallint NOT NULL default 0,
		  conf_title_noshow tinyint NOT NULL default 0,
		  conf_title_keyword varchar(200) NOT NULL default '0',
		  PRIMARY KEY  (conf_title_id)
		);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."topics_read (
		  read_tid int NOT NULL default 0,
		  read_mid int NOT NULL default 0,
		  read_date int NOT NULL default 0,
		  PRIMARY KEY (read_tid,read_mid)
		);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."banfilters (
			ban_id int NOT NULL IDENTITY,
			ban_type varchar(10) NOT NULL default 'ip',
			ban_content varchar(255) NOT NULL default '',
			ban_date int NOT NULL default 0,
			PRIMARY KEY (ban_id)
		);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (
		  atype_id int NOT NULL IDENTITY,
		  atype_extension varchar(18) NOT NULL default '',
		  atype_mimetype varchar(255) NOT NULL default '',
		  atype_post tinyint NOT NULL default 1,
		  atype_photo tinyint NOT NULL default 0,
		  atype_img text NOT NULL,
		  PRIMARY KEY (atype_id)
		);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."members_converge (
		  converge_id int NOT NULL IDENTITY,
		  converge_email varchar(250) NOT NULL default '',
		  converge_joined int NOT NULL default 0,
		  converge_pass_hash varchar(32) NOT NULL default '',
		  converge_pass_salt varchar(5) NOT NULL default '',
		  PRIMARY KEY  (converge_id)
		);";
		$SQL[] = "CREATE INDEX converge_email ON ".ipsRegistry::dbFunctions()->getPrefix()."members_converge (converge_email)";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."announcements (
		  announce_id int NOT NULL IDENTITY,
		  announce_title varchar(255) NOT NULL default '',
		  announce_post text NOT NULL default '',
		  announce_forum text NOT NULL default '',
		  announce_member_id int NOT NULL default 0,
		  announce_html_enabled tinyint NOT NULL default 0,
		  announce_views int NOT NULL default 0,
		  announce_start int NOT NULL default 0,
		  announce_end int NOT NULL default 0,
		  announce_active tinyint NOT NULL default 1,
		  PRIMARY KEY (announce_id)
		);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."mail_error_logs (
		  mlog_id int NOT NULL IDENTITY,
		  mlog_date int NOT NULL default 0,
		  mlog_to varchar(250) NOT NULL default '',
		  mlog_from varchar(250) NOT NULL default '',
		  mlog_subject varchar(250) NOT NULL default '',
		  mlog_content varchar(250) NOT NULL default '',
		  mlog_msg text NOT NULL default '',
		  mlog_code varchar(200) NOT NULL default '',
		  mlog_smtp_msg text NOT NULL default '',
		  PRIMARY KEY (mlog_id)
		);";

		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."bulk_mail (
		  mail_id int NOT NULL IDENTITY,
		  mail_subject varchar(255) NOT NULL default '',
		  mail_content text NOT NULL default '',
		  mail_groups text NOT NULL default '',
		  mail_honor tinyint NOT NULL default 1,
		  mail_opts text NOT NULL default '',
		  mail_start int NOT NULL default 0,
		  mail_updated int NOT NULL default 0,
		  mail_sentto int NOT NULL default 0,
		  mail_active tinyint NOT NULL default 0,
		  mail_pergo smallint NOT NULL default 0,
		  PRIMARY KEY (mail_id)
		);";

		/*$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."upgrade_history (
		  upgrade_id int NOT NULL IDENTITY,
		  upgrade_version_id int NOT NULL default 0,
		  upgrade_version_human varchar(200) NOT NULL default '',
		  upgrade_date int NOT NULL default 0,
		  upgrade_mid int NOT NULL default 0,
		  upgrade_notes text NULL default NULL,
		  PRIMARY KEY  (upgrade_id)
		)";*/

//		$SQL[] = "DROP TABLE ".ipsRegistry::dbFunctions()->getPrefix()."forums";
		$SQL[] = "CREATE TABLE ".ipsRegistry::dbFunctions()->getPrefix()."forums (
		  id int NOT NULL default 0,
		  topics int NULL,
		  posts int NULL,
		  last_post int NULL,
		  last_poster_id int NOT NULL default 0,
		  last_poster_name varchar(32) NULL,
		  name varchar(128) NOT NULL default '',
		  description text NULL,
		  position tinyint NULL,
		  use_ibc tinyint NULL,
		  use_html tinyint NULL,
		  status varchar(10) NULL,
		  password varchar(32) NULL,
		  last_title varchar(128) NULL,
		  last_id int NULL,
		  sort_key varchar(32) NULL,
		  sort_order varchar(32) NULL,
		  prune smallint NULL,
		  show_rules tinyint NULL,
		  preview_posts tinyint NULL,
		  allow_poll tinyint NOT NULL default 1,
		  allow_pollbump tinyint NOT NULL default 0,
		  inc_postcount tinyint NOT NULL default 1,
		  skin_id int NULL,
		  parent_id int NULL default -1,
		  quick_reply tinyint NULL default 0,
		  redirect_url varchar(250) NULL default '',
		  redirect_on tinyint NOT NULL default 0,
		  redirect_hits int NOT NULL default 0,
		  redirect_loc varchar(250) NULL default '',
		  rules_title varchar(255) NOT NULL default '',
		  rules_text text NULL,
		  topic_mm_id varchar(250) NOT NULL default '',
		  notify_modq_emails text NULL default '',
		  sub_can_post tinyint default 1,
		  permission_custom_error text NOT NULL default '',
		  permission_array text NOT NULL default '',
		  permission_showtopic tinyint NOT NULL default 0,
		  queued_topics int NOT NULL default 0,
		  queued_posts int NOT NULL default 0,
		  PRIMARY KEY  (id)
		);";
		$SQL[] = "CREATE INDEX id ON ".ipsRegistry::dbFunctions()->getPrefix()."forums (id)";
		$SQL[] = "CREATE INDEX position ON ".ipsRegistry::dbFunctions()->getPrefix()."forums (position,parent_id);";


		$this->error   = array();
		$this->sqlcount 		= 0;
		$output					= "";

		$this->DB->return_die = 1;

		foreach( $SQL as $query )
		{
			$this->DB->allow_sub_select 	= 1;
			$this->DB->error				= '';

			if( IPSSetUp::getSavedData('man') )
			{
				$output .= preg_replace("/\sibf_(\S+?)([\s\.,]|$)/", " ".$this->DB->obj['sql_tbl_prefix']."\\1\\2", preg_replace( "/\s{1,}/", " ", $query ) )."\n\n";
			}
			else
			{
				$this->DB->query( $query );

				if ( $this->DB->error )
				{
					$this->registry->output->addError( $query."<br /><br />".$this->DB->error );
				}
				else
				{
					$this->sqlcount++;
				}
			}
		}

		$this->registry->output->addMessage("[Step 2 of 21] New tables created. Altering tables (Part 1, section 1 - post table)<br /><br />{$this->sqlcount} queries run....");
		$this->request['workact'] = 'step_3';

		if ( IPSSetUp::getSavedData('man') AND $output )
		{
			$this->_output = $this->registry->output->template()->upgrade_manual_queries( $output );
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 3: ALTER POST TABLE
	/*-------------------------------------------------------------------------*/
	function step_3()
	{
		$this->DB->addField('posts', 'post_parent', 'int', '0');
		$this->DB->addField('posts', 'post_key', 'varchar(32)', '0');
		$this->DB->addField('posts', 'post_htmlstate', 'smallint', '0');
	
		$this->error = array();
		$output = "";
		$this->sqlcount = 3;

		$this->registry->output->addMessage("[Step 3 of 21] Post table altered, altering topic table next...<br /><br />{$this->sqlcount} queries run....");
		$this->request['workact'] = 'step_4';

		if ( IPSSetUp::getSavedData('man') AND $output )
		{
			$this->_output = $this->registry->output->template()->upgrade_manual_queries( $output );
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 4: ALTER TOPIC TABLE
	/*-------------------------------------------------------------------------*/
	function step_4()
	{
		$this->DB->changeField('topics', 'title', 'title', 'VARCHAR(250)', '');
		$this->DB->addField('topics', 'topic_hasattach', 'smallint', '0');
		
		$this->error = array();
		$output = "";
		$this->sqlcount = 2;

		$this->registry->output->addMessage("[Step 4 of 21] Topic table altered, altering members table next...<br /><br />{$this->sqlcount} queries run....");
		$this->request['workact'] = 'step_5';

		if ( IPSSetUp::getSavedData('man') AND $output )
		{
			$this->_output = $this->registry->output->template()->upgrade_manual_queries( $output );
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 5: ALTER MEMBERS TABLE
	/*-------------------------------------------------------------------------*/
	function step_5()
	{
		$this->DB->addField('members', 'login_anonymous', 'varchar(3)', "'0&0'");
		$this->DB->addField('members', 'ignored_users', 'text', '');
		$this->DB->addField('members', 'mgroup_others', 'varchar(255)', '');
		$this->DB->addField('members', 'member_login_key', 'varchar(32)', '');
		$this->DB->changeField('members', 'password', 'legacy_password');
		$this->DB->addField('member_extra', 'aim_name', 'varchar(40)', '');
		$this->DB->addField('member_extra', 'icq_number', 'int', '0');
		$this->DB->addField('member_extra', 'website', 'varchar(250)', '');
		$this->DB->addField('member_extra', 'yahoo', 'varchar(40)', '');
		$this->DB->addField('member_extra', 'interests', 'text', '');
		$this->DB->addField('member_extra', 'msnname', 'varchar(200)', '');
		$this->DB->addField('member_extra', 'vdirs', 'text', '');
		$this->DB->addField('member_extra', 'location', 'varchar(250)', '');
		$this->DB->addField('member_extra', 'signature', 'text', '');
		$this->DB->addField('member_extra', 'avatar_location', 'varchar(128)', '');
		$this->DB->addField('member_extra', 'avatar_size', 'varchar(9)', '');
		$this->DB->addField('member_extra', 'avatar_type', 'varchar(15)', "'local'");
		
		$this->error = array();
		$output = "";
		$this->sqlcount = 17;

		$this->registry->output->addMessage("[Step 5 of 21] Members table altered, other tables next...<br /><br />{$this->sqlcount} queries run....");
		$this->request['workact'] = 'step_6';

		if ( IPSSetUp::getSavedData('man') AND $output )
		{
			$this->_output = $this->registry->output->template()->upgrade_manual_queries( $output );
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 6: ALTER OTHER TABLES
	/*-------------------------------------------------------------------------*/
	function step_6()
	{
		$this->DB->renameTable('macro', 'skin_macro');
		$this->DB->changeField('skin_macro', 'can_remove', 'macro_can_remove');
		$this->DB->addField('groups', 'g_bypass_badwords', 'tinyint', '0');
		$this->DB->changeField('cache_store', 'cs_value', 'cs_value', 'text', '');
		$this->DB->addField('cache_store', 'cs_array', 'tinyint', '0');
		$this->DB->addField('sessions', 'in_error', 'tinyint', '0');
		$this->DB->addField('topic_mmod', 'mm_forums', 'text', '');
		$this->DB->changeField('groups', 'g_icon', 'g_icon', 'text', '');
		$this->DB->addField('emoticons', 'emo_set', 'varchar(64)', "'default'");
		$this->DB->changeField('admin_sessions', 'ID', 'session_id');
		$this->DB->changeField('admin_sessions', 'IP_ADDRESS', 'session_ip_address');
		$this->DB->changeField('admin_sessions', 'MEMBER_NAME', 'session_member_name', 'varchar(250)', '');
		$this->DB->changeField('admin_sessions', 'MEMBER_ID', 'session_member_id', 'int', '0');
		$this->DB->changeField('admin_sessions', 'SESSION_KEY', 'session_member_login_key');
		$this->DB->changeField('admin_sessions', 'LOCATION', 'session_location', 'varchar(64)', '');
		$this->DB->changeField('admin_sessions', 'LOG_IN_TIME', 'session_log_in_time');
		$this->DB->changeField('admin_sessions', 'RUNNING_TIME', 'session_running_time');
		$this->DB->addField('forum_tracker', 'forum_track_type', 'varchar(100)', "'delayed'");
		$this->DB->addField('tracker', 'topic_track_type', 'varchar(100)', "'delayed'");

		$SQL[] = "DELETE FROM ".ipsRegistry::dbFunctions()->getPrefix()."members where id=0";
		$SQL[] = "DELETE FROM ".ipsRegistry::dbFunctions()->getPrefix()."member_extra where id=0";

		$this->error = array();
		$this->sqlcount = 19;

		$this->DB->return_die = 1;

		foreach( $SQL as $query )
		{
			$this->DB->allow_sub_select 	= 1;
			$this->DB->error				= '';

			$this->DB->query( $query );

			if ( $this->DB->error )
			{
				$this->registry->output->addError( $query."<br /><br />".$this->DB->error );
			}
			else
			{
				$this->sqlcount++;
			}
		}

		$this->registry->output->addMessage("[Step 6 of 21] Other tables altered, converting forums next...<br /><br />{$this->sqlcount} queries run....");
		$this->request['workact'] = 'step_7';
	}

	/*-------------------------------------------------------------------------*/
	// STEP 7: IMPORT FORUMS
	/*-------------------------------------------------------------------------*/
	function step_7()
	{
		$this->DB->return_die = 1;

		//-----------------------------------------
		// Convert existing forums
		//-----------------------------------------
		$this->DB->build( array( 'select' => '*',
								 'from'   => 'forums_bak',
								 'order'  => 'id ASC' ) );
		$forumRes = $this->DB->execute();

		while ( $r = $this->DB->fetch($forumRes) )
		{
			$perm_array = addslashes( serialize( array( 'start_perms'  => $r['start_perms'],
														'reply_perms'  => $r['reply_perms'],
														'read_perms'   => $r['read_perms'],
														'upload_perms' => $r['upload_perms'],
														'show_perms'   => $r['read_perms'] ) ) );

			$this->DB->insert( 'forums', array ( 'id'                      => $r['id'],
												 'position'                => $r['position'],
												 'topics'                  => $r['topics'],
												 'posts'                   => $r['posts'],
												 'last_post'               => $r['last_post'],
												 'last_poster_id'          => $r['last_poster_id'],
												 'last_poster_name'        => $r['last_poster_name'],
												 'name'                    => $r['name'],
												 'description'             => $r['description'],
												 'use_ibc'                 => $r['use_ibc'],
												 'use_html'                => $r['use_html'],
												 'status'                  => $r['status'],
												 'password'                => $r['password'],
												 'last_id'                 => $r['last_id'],
												 'last_title'              => $r['last_title'],
												 'sort_key'                => $r['sort_key'],
												 'sort_order'              => $r['sort_order'],
												 'prune'                   => $r['prune'],
												 'show_rules'              => $r['show_rules'],
												 'preview_posts'           => $r['preview_posts'],
												 'allow_poll'              => $r['allow_poll'],
												 'allow_pollbump'          => $r['allow_pollbump'],
												 'inc_postcount'           => $r['inc_postcount'],
												 'parent_id'               => $r['parent_id'],
												 'sub_can_post'            => $r['sub_can_post'],
												 'quick_reply'             => $r['quick_reply'],
												 'redirect_on'             => $r['redirect_on'],
												 'redirect_hits'           => $r['redirect_hits'],
												 'redirect_url'            => $r['redirect_url'],
												 'redirect_loc'			   => $r['redirect_loc'],
												 'rules_title'			   => $r['rules_title'],
												 'rules_text'			   => $r['rules_text'],
												 'notify_modq_emails'      => $r['notify_modq_emails'],
												 'permission_array'        => $perm_array,
												 'permission_showtopic'    => '',
												 'permission_custom_error' => '' ) );
		}

		//-----------------------------------------
		// Convert categories
		//-----------------------------------------
		$tmpRes = $this->DB->buildAndFetch( array( 'select' => 'MAX(id) as max', 'from'   => 'forums' ) );
		$fid = $tmpRes['max'];

		$tmpRes = $this->DB->buildAndFetch( array( 'select' => '*',
												   'from'   => 'categories',
												   'where'  => 'id > 0' ) );
		$categoryRes = $this->DB->execute();

		while( $r = $this->DB->fetch($categoryRes) )
		{
			$fid++;

			$perm_array = addslashes( serialize( array( 'start_perms'  => '*',
														'reply_perms'  => '*',
														'read_perms'   => '*',
														'upload_perms' => '*',
														'show_perms'   => '*' ) ) );

			$this->DB->insert( 'forums', array( 'id'               => $fid,
												'position'         => $r['position'],
												'name'             => $r['name'],
												'sub_can_post'     => 0,
												'permission_array' => $perm_array,
												'parent_id'        => -1 ) );

			//-----------------------------------------
			// Update old categories
			//-----------------------------------------
			$tmpRes = $this->DB->buildAndFetch( array( 'select' => 'id',
													   'from'   => 'forums_bak',
													   'where'  => "category='{$r['id']}' AND parent_id='-1'" ) );
			$forumRes = $this->DB->execute();
			$ids = array();

			while( $c = $this->DB->fetch($forumRes) )
			{
				$ids[] = $c['id'];
			}

			if ( count($ids) > 0 )
			{
				$this->DB->update( 'forums', array( 'parent_id' => $fid ), 'id IN ('.implode(',',$ids).')' );
			}
		}

		$this->registry->output->addMessage("[Step 7 of 21] Forums converted, converting attachments next...<br /><br />{$fid} forums converted....");
		$this->request['workact'] = 'step_8';
	}

	/*-------------------------------------------------------------------------*/
	// STEP 8: CONVERT ATTACHMENTS
	/*-------------------------------------------------------------------------*/
	function step_8()
	{
		$this->DB->return_die = 1;

		$start = intval($this->request['st']) ? intval($this->request['st']) : 0;
		$lend  = 500;
		$lastId = 0;

		//-----------------------------------------
		// In steps...
		//-----------------------------------------
		$this->DB->build( array( 'select' => '*',
								 'from'   => 'posts',
								 'where'  => "attach_file != '' AND pid > {$start}",
								 'limit'  => array( 0, $lend ),
								 'order'  => 'pid ASC' ) );
		$outerRes = $this->DB->execute();

		//-----------------------------------------
		// Do it...
		//-----------------------------------------
		if ( $this->DB->getTotalRows($outerRes) )
		{
			//-----------------------------------------
			// Got some to convert!
			//-----------------------------------------
			while ( $r = $this->DB->fetch($outerRes) )
			{
				$image   = 0;
				$ext     = strtolower( str_replace( ".", "", substr( $r['attach_file'], strrpos( $r['attach_file'], '.' ) ) ) );
				$postkey = md5( $r['post_date'].','.$r['pid'] );

				if ( in_array( $ext, array( 'gif', 'jpeg', 'jpg', 'png' ) ) )
				{
					$image = 1;
				}

				$this->DB->insert( 'attachments', array( 'attach_ext'       => $ext,
														 'attach_file'      => $r['attach_file'],
														 'attach_location'  => $r['attach_id'],
														 'attach_is_image'  => $image,
														 'attach_hits'      => $r['attach_hits'],
														 'attach_date'      => $r['post_date'],
														 'attach_pid'       => $r['pid'],
														 'attach_post_key'  => $postkey,
														 'attach_member_id' => $r['author_id'],
														 'attach_filesize'  => @filesize(IPS_ROOT_PATH.'uploads/'.$r['attach_id']) ) );

				$this->DB->update( 'posts', array( 'post_key' => $postkey ), 'pid='.$r['pid'] );
				$this->DB->update( 'topics', array('topic_hasattach=topic_hasattach+1', 'tid='.$r['topic_id'] ) );
				
				$lastId = $r['pid'];
			}

			$this->request['st'] = $lastId;
			$this->registry->output->addMessage("[Step 8 of 21] Attachments completed from posts {$start} to {$lastId} completed....");
			$this->request['workact'] = 'step_8';
		}
		else
		{
			$this->registry->output->addMessage("[Step 8 of 21] Attachments converted, converting members...");
			$this->request['workact'] = 'step_9';
			$this->request['st'] 	  = 0;
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 9: CONVERT MEMBERS
	/*-------------------------------------------------------------------------*/
	function step_9()
	{
		$this->DB->return_die = 1;

		$start = intval($this->request['st']) ? intval($this->request['st']) : 0;
		$lend  = 300;
		$end   = $start + $lend;

		//-----------------------------------------
		// In steps...
		//-----------------------------------------
		$this->DB->build( array( 'select'	=> 'm.*',
								 'from'		=> array( 'members' => 'm' ),
								 'add_join' => array( array( 'select' => 'me.id as mextra',
								 							 'from' => array( 'member_extra' => 'me' ),
								 							 'where' => 'me.id=m.member_id',
								 							 'type' => 'left' ) ),
								 'limit'	=> array( $start, $end ) ) );
		$outerRes = $this->DB->execute();

		//-----------------------------------------
		// Do it...
		//-----------------------------------------
		if ( $this->DB->getTotalRows($outerRes) )
		{
			//-----------------------------------------
			// Got some to convert!
			//-----------------------------------------
			while ( $r = $this->DB->fetch($outerRes) )
			{
				if ( $r['mextra'] )
				{
					$this->DB->update( 'member_extra',
									   array( 'aim_name'        => $r['aim_name'],
									   		  'icq_number'      => $r['icq_number'],
									   		  'website'         => $r['website'],
									   		  'yahoo'           => $r['yahoo'],
									   		  'interests'       => $r['interests'],
									   		  'msnname'         => $r['msnname'],
									   		  'vdirs'           => $r['vdirs'],
									   		  'location'        => $r['location'],
									   		  'signature'       => $r['signature'],
									   		  'avatar_location' => $r['avatar'],
									   		  'avatar_size'     => $r['avatar_size'],
									   		  'avatar_type'     => preg_match( "/^upload\:/", $r['avatar'] ) ? 'upload' : ( preg_match( "#^http://#", $r['avatar'] ) ? 'url' : 'local' ) ),
									   "id='{$r['mextra']}'" );
				}
				else
				{
					$this->DB->insert( 'member_extra', array( 'id'              => $r['id'],
															  'aim_name'        => $r['aim_name'],
															  'icq_number'      => $r['icq_number'],
															  'website'         => $r['website'],
															  'yahoo'           => $r['yahoo'],
															  'interests'       => $r['interests'],
															  'msnname'         => $r['msnname'],
															  'vdirs'           => $r['vdirs'],
															  'location'        => $r['location'],
															  'signature'       => $r['signature'],
															  'avatar_location' => $r['avatar'],
															  'avatar_size'     => $r['avatar_size'],
															  'avatar_type'     => preg_match( "/^upload\:/", $r['avatar'] ) ? 'upload' : ( preg_match( "#^http://#", $r['avatar'] ) ? 'url' : 'local' ) ) );
				}
			}

			$this->request['st'] = $end;
			$this->registry->output->addMessage("[Step 9 of 21] Members adjusted {$start} to {$end} completed....");
			$this->request['workact'] = 'step_9';
		}
		else
		{
			$this->registry->output->addMessage("[Step 9 of 21] Members converted, making members email addresses safe for converge...");
			$this->request['workact'] = 'step_10';
			$this->request['st'] 	  = 0;
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 10: CHECK EMAIL ADDRESSES
	/*-------------------------------------------------------------------------*/
	function step_10()
	{
		$this->DB->return_die = 1;


			$this->registry->output->addMessage("[Step 10 of 21] Members email addresses checked, adding to converge...");
			$this->request['workact'] = 'step_11';
			$this->request['st'] 	  = 0;
		
	}

	/*-------------------------------------------------------------------------*/
	// STEP 11: CONVERGE
	/*-------------------------------------------------------------------------*/
	function step_11()
	{
		$this->DB->return_die = 1;

		$start = intval($this->request['st']) ? intval($this->request['st']) : 0;
		$lend  = 300;
		$lastId = 0;

		/* Grab session user */
		$sessionUser = $this->DB->buildAndFetch( array( 'select' => '*',
													    'from'   => 'upgrade_sessions',
													    'where'  => "session_id='" . addslashes( $this->request['s'] ) . "'" ) );

		$this->DB->build( array( 'select' => 'm.*',
								 'from'   => array( 'members' => 'm' ),
								 'add_join' => array( array( 'select' => 'c.converge_id as cid',
								 							 'from'   => array( 'members_converge' => 'c' ),
								 							 'where'  =>  'c.converge_id=m.id',
								 							 'type'   => 'left' ) ),
								 'where' => "m.id > {$start}",
								 'limit' => array( 0, $lend),
								 'order' => 'm.id ASC' ) );

		$outerRes = $this->DB->execute();

		//-----------------------------------------
		// Do it...
		//-----------------------------------------
		if ( $this->DB->getTotalRows($outerRes) )
		{
			$this->DB->setTableIdentityInsert('members_converge', 'ON');
			
			//-----------------------------------------
			// Got some to convert!
			//-----------------------------------------
			while ( $r = $this->DB->fetch($outerRes) )
			{
				$lastId = $r['id'] > $start ? $r['id'] : $lastId;

				if ( !$r['cid'] || !$r['id'] )
				{
					$r['password'] = $r['password'] ? $r['password'] : $r['legacy_password'];

					$salt = IPSMember::generatePasswordSalt();

					$this->DB->insert( 'members_converge', array( 'converge_id'        => $r['id'],
																  'converge_email'     => strtolower($r['email']),
																  'converge_joined'    => $r['joined'],
																  'converge_pass_hash' => md5( md5($salt) . $r['password'] ),
																  'converge_pass_salt' => $salt ) );

					$member_login_key = IPSMember::generateAutoLoginKey();

					if ( $sessionUser['session_member_id'] AND $sessionUser['session_member_id'] == $r['id'] )
					{
						$member_login_key = $sessionUser['session_member_key'];
					}
					
					$this->DB->update( 'members', array( 'member_login_key' => $member_login_key, 'email' => strtolower($r['email']) ), 'id='.$r['id'] );
				}

			}
			$this->DB->setTableIdentityInsert('members_converge', 'OFF');
			$this->request['st'] = $lastId;
			$this->registry->output->addMessage("[Step 11 of 21] Converge added: {$start} to {$lastId} completed....");
			$this->request['workact'] = 'step_11';
		} else {
			$this->registry->output->addMessage("[Step 11 of 21] Converge completed, converting personal messages...");
			$this->request['workact'] = 'step_12';
			$this->request['st'] 	  = 0;
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 12: CONVERT PMs
	/*-------------------------------------------------------------------------*/
	function step_12()
	{
		$this->DB->return_die = 1;

		$start = $start = intval($this->request['st']) ? intval($this->request['st']) : 0;
		$lend  = 300;
		$lastId = 0;

		//-----------------------------------------
		// In steps...
		//-----------------------------------------
		$this->DB->build( array( 'select' => '*',
								 'from' => 'messages',
								 'where' => "msg_id > {$start}",
								 'limit' => array( 0, $lend ),
								 'order' => 'msg_id ASC' ) );
		$outerRes = $this->DB->execute();

		//-----------------------------------------
		// Do it...
		//-----------------------------------------
		if ( $this->DB->getTotalRows($outerRes) )
		{
			//-----------------------------------------
			// Got some to convert!
			//-----------------------------------------
			while ( $r = $this->DB->fetch($outerRes) )
			{
				$lastId = $r['msg_id'];
				
				if ( ! $r['msg_date'] )
				{
					$r['msg_date'] = $r['read_date'];
				}

				$this->DB->insert( 'message_text', array( 'msg_date'          => $r['msg_date'],
														  'msg_post'          => stripslashes($r['message']),
														  'msg_cc_users'      => $r['cc_users'],
														  'msg_author_id'     => $r['from_id'],
														  'msg_sent_to_count' => 1,
														  'msg_deleted_count' => 0 ) );
				$msgId = $this->DB->getInsertId();
				$this->DB->insert( 'message_topics', array( 'mt_msg_id'     => $msgId,
															'mt_date'       => $r['msg_date'],
															'mt_title'      => $r['title'],
															'mt_from_id'    => $r['from_id'],
															'mt_to_id'      => $r['recipient_id'],
															'mt_vid_folder' => $r['vid'],
															'mt_read'       => $r['read_state'],
															'mt_tracking'   => $r['tracking'],
															'mt_owner_id'   => ($r['vid'] != 'sent' ? $r['recipient_id'] : $r['from_id']) ) );
			}

			$this->request['st'] = $lastId;
			$this->registry->output->addMessage("[Step 12 of 21] Personal messages: {$start} to {$lastId} completed....");
			$this->request['workact'] = 'step_12';
		}
		else
		{
			$this->registry->output->addMessage("[Step 12 of 21] Personal messages converted, proceeding to update topic multi-moderation...");
			$this->request['workact'] = 'step_13';
			$this->request['st'] 	  = 0;
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 13: CONVERT TOPIC MULTI_MODS
	/*-------------------------------------------------------------------------*/
	function step_13()
	{
		$this->DB->return_die = 1;

		$this->DB->build( array( 'select' => '*', 'from' => 'forums' ) );
		$forumRes = $this->DB->execute();

		$final = array();

		while ( $r = $this->DB->fetch($forumRes) )
		{
			$mmids = preg_split( "/,/", $r['topic_mm_id'], -1, PREG_SPLIT_NO_EMPTY );

			if ( is_array( $mmids ) )
			{
				foreach( $mmids as $m )
				{
					$final[ $m ][] = $r['id'];
				}
			}
		}

		$real_final = array();

		foreach( $final as $id => $forums_ids )
		{
			$ff = implode( ",",$forums_ids );

			$this->DB->update( 'topic_mmod', array( 'mm_forums' => $ff ), "mm_id='{$id}'" );
		}

		$this->registry->output->addMessage("[Step 13 of 21] Topic multi-moderation converted, alterting tables, stage 2...");
		$this->request['workact'] = 'step_14';
		$this->request['st'] 	  = 0;
	}

	/*-------------------------------------------------------------------------*/
	// STEP 14: ALTER POST TABLE II
	/*-------------------------------------------------------------------------*/
	function step_14()
	{
		$this->DB->dropField('posts', 'attach_id');
		$this->DB->dropField('posts', 'attach_hits');
		$this->DB->dropField('posts', 'attach_type');
		$this->DB->dropField('posts', 'attach_file');
		$this->DB->changeField('posts', 'queued', 'queued', 'tinyint', '0');
		$this->DB->dropIndex('posts','forum_id');
		$this->DB->dropField('posts', 'forum_id');

		$this->error   = array();
		$this->sqlcount 		= 7;
		$output					= "";

		$this->registry->output->addMessage("[Step 14 of 21] Post table altered, altering topic table next...<br /><br />{$this->sqlcount} queries run....");
		$this->request['workact'] = 'step_15';

		if ( IPSSetUp::getSavedData('man') AND $output )
		{
			$this->_output = $this->registry->output->template()->upgrade_manual_queries( $output );
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 15: ALTER TOPIC TABLE II
	/*-------------------------------------------------------------------------*/
	function step_15()
	{
		$this->DB->addField('topics', 'topic_firstpost', 'int', '0');
		$this->DB->addField('topics', 'topic_queuedposts', 'int', '0');

		$this->error = array();
		$this->sqlcount = 2;
		$output = "";

		$this->registry->output->addMessage("[Step 15 of 21] Topic table altered, altering members table next...<br /><br />$this->sqlcount queries run....");
		$this->request['workact'] = 'step_16';

		if ( IPSSetUp::getSavedData('man') AND $output )
		{
			$this->_output = $this->registry->output->template()->upgrade_manual_queries( $output );
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 16: ALTER MEMBERS TABLE II
	/*-------------------------------------------------------------------------*/
	function step_16()
	{
		$this->DB->dropField('members', 'msg_from_id');
		$this->DB->dropField('members', 'msg_msg_id');
		$this->DB->dropField('members', 'org_supmod');
		$this->DB->dropField('members', 'integ_msg');
		$this->DB->dropField('members', 'aim_name');
		$this->DB->dropField('members', 'icq_number');
		$this->DB->dropField('members', 'website');
		$this->DB->dropField('members', 'yahoo');
		$this->DB->dropField('members', 'interests');
		$this->DB->dropField('members', 'msnname');
		$this->DB->dropField('members', 'vdirs');
		$this->DB->dropField('members', 'signature');
		$this->DB->dropField('members', 'location');
		$this->DB->dropField('members', 'avatar');
		$this->DB->dropField('members', 'avatar_size');
		$this->DB->changeField('members', 'auto_track', 'auto_track', 'varchar(50)', '0');
		$this->DB->addField('members', 'subs_pkg_chosen', 'smallint', '0');
		$this->DB->changeField('members', 'msg_total', 'msg_total', 'smallint', '0');
		$this->DB->changeField('members', 'new_msg', 'new_msg', 'smallint', '0');
		
		$this->DB->update('members', array('temp_ban' => NULL), 'temp_ban IS NOT NULL');
		
		$this->DB->changeField('members', 'temp_ban', 'temp_ban', 'smallint', '0');

		if ( !$this->DB->checkForField( "subs_pkg_chosen", "members" ) )
		{
			$this->DB->addField('members', 'subs_pkg_chosen', 'smallint', '0');
		}

		$SQL[] = "UPDATE ".ipsRegistry::dbFunctions()->getPrefix()."members SET new_msg=0";

		$this->error   = array();
		$this->sqlcount 		= 22;
		$output					= "";

		$this->DB->return_die = 1;

		foreach( $SQL as $query )
		{
			$this->DB->allow_sub_select 	= 1;
			$this->DB->error				= '';

			if( IPSSetUp::getSavedData('man') )
			{
				$output .= preg_replace("/\sibf_(\S+?)([\s\.,]|$)/", " ".$this->DB->obj['sql_tbl_prefix']."\\1\\2", preg_replace( "/\s{1,}/", " ", $query ) )."\n\n";
			}
			else
			{
				$this->DB->query( $query );

				if ( $this->DB->error )
				{
					$this->registry->output->addError( $query."<br /><br />".$this->DB->error );
				}
				else
				{
					$this->sqlcount++;
				}
			}
		}

		$this->registry->output->addMessage("[Step 16 of 21] Members table altered, other tables next...<br /><br />$this->sqlcount queries run....");
		$this->request['workact'] = 'step_17';

		if ( IPSSetUp::getSavedData('man') AND $output )
		{
			$this->_output = $this->registry->output->template()->upgrade_manual_queries( $output );
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 17: ALTER OTHERS TABLE II
	/*-------------------------------------------------------------------------*/
	function step_17()
	{
		$this->DB->addField('topic_mmod', 'topic_approve', 'tinyint', '0');
		$this->DB->addField('groups', 'g_can_msg_attach', 'tinyint', '0');
		$this->DB->addField('groups', 'g_attach_per_post', 'int', '0');
		$this->DB->changeField('pfields_data', 'fid', 'pf_id');
		$this->DB->changeField('pfields_data', 'ftitle', 'pf_title', 'varchar(250)', '');
		$this->DB->changeField('pfields_data', 'fdesc', 'pf_desc', 'varchar(250)', '');
		$this->DB->changeField('pfields_data', 'fcontent', 'pf_content', 'text', '');
		$this->DB->changeField('pfields_data', 'ftype', 'pf_type', 'varchar(250)', '');
		$this->DB->changeField('pfields_data', 'freq', 'pf_not_null', 'tinyint', '0');
		$this->DB->changeField('pfields_data', 'fhide', 'pf_member_hide', 'tinyint', '0');
		$this->DB->changeField('pfields_data', 'fmaxinput', 'pf_max_input', 'smallint', '0');
		$this->DB->changeField('pfields_data', 'fedit', 'pf_member_edit', 'tinyint', '0');
		$this->DB->changeField('pfields_data', 'forder', 'pf_position', 'smallint', '0');
		$this->DB->changeField('pfields_data', 'fshowreg', 'pf_show_on_reg', 'tinyint', '0');
		$this->DB->addField('pfields_data', 'pf_input_format', 'text', '');
		$this->DB->addField('pfields_data', 'pf_admin_only', 'tinyint', '0');
		$this->DB->addField('pfields_data', 'pf_topic_format', 'text', '');
		
		$this->error = array();
		$this->sqlcount = 17;

		$this->registry->output->addMessage("[Step 17 of 21] Other tables altered, inserting data next...<br /><br />$this->sqlcount queries run....");
		$this->request['workact'] = 'step_18';
	}

	/*-------------------------------------------------------------------------*/
	// STEP 18: SAFE INSERTS
	/*-------------------------------------------------------------------------*/
	function step_18()
	{

		
		$SQL = array();
		$SQL[] = "SET IDENTITY_INSERT ".ipsRegistry::dbFunctions()->getPrefix()."task_manager ON";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."task_manager (task_id, task_title, task_file, task_next_run, task_week_day, task_month_day, task_hour, task_minute, task_cronkey, task_log, task_description, task_enabled) VALUES (1, 'Hourly Clean Out', 'cleanout.php', 1079704080, -1, -1, -1, 59, '2a7d083832daa123b73a68f9c51fdb29', 1, 'Kill old sessions, reg images, searches', 1);";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."task_manager (task_id, task_title, task_file, task_next_run, task_week_day, task_month_day, task_hour, task_minute, task_cronkey, task_log, task_description, task_enabled) VALUES (3, 'Daily Stats Rebuild', 'rebuildstats.php', 1079740800, -1, -1, 0, 0, '640b9a6c373ff207bc1b1100a98121af', 1, 'Rebuilds board statistics', 1);";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."task_manager (task_id, task_title, task_file, task_next_run, task_week_day, task_month_day, task_hour, task_minute, task_cronkey, task_log, task_description, task_enabled) VALUES (6, 'Daily Clean Out', 'dailycleanout.php', 1079751600, -1, -1, 3, 0, 'e71b52f3ff9419abecedd14b54e692c4', 1, 'Prunes topic subscriptions', 1);";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."task_manager (task_id, task_title, task_file, task_next_run, task_week_day, task_month_day, task_hour, task_minute, task_cronkey, task_log, task_description, task_enabled) VALUES (8, 'Birthday and Events Cache', 'calendarevents.php', 1079725800, -1, -1, 12, -1, '2c148c9bd754d023a7a19dd9b1535796', 1, 'Caches calendar events &amp; birthdays', 1);";
		$SQL[] = "SET IDENTITY_INSERT ".ipsRegistry::dbFunctions()->getPrefix()."task_manager OFF";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."task_manager (task_title, task_file, task_next_run, task_week_day, task_month_day, task_hour, task_minute, task_cronkey, task_log, task_description, task_enabled) VALUES ('Announcements Update', 'announcements.php', 1080747660, -1, -1, 4, -1, 'e82f2c19ab1ed57c140fccf8aea8b9fe', 1,'Rebuilds cache and expires out of date announcements', 1);";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."task_manager (task_title, task_file, task_next_run, task_week_day, task_month_day, task_hour, task_minute, task_cronkey, task_log, task_description, task_enabled, task_key, task_safemode) VALUES ('Send Bulk Mail', 'bulkmail.php', 1086706080, -1, -1, -1, -1, '61359ac93eb93ebbd935a4e275ade2db', 0, 'Dynamically assigned, no need to edit or change', 0, 'bulkmail', 1);";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."task_manager (task_title, task_file, task_next_run, task_week_day, task_month_day, task_hour, task_minute, task_cronkey, task_log, task_description, task_enabled, task_key, task_safemode) VALUES ('Daily Topic &amp; Forum Digest', 'dailydigest.php', 1086912600, -1, -1, 0, 10, '723cab2aae32dd5d04898b1151038846', 1, 'Emails out daily topic &amp; forum digest emails', 1, 'dailydigest', 0)";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."task_manager (task_title, task_file, task_next_run, task_week_day, task_month_day, task_hour, task_minute, task_cronkey, task_log, task_description, task_enabled, task_key, task_safemode) VALUES ('Weekly Topic &amp; Forum Digest', 'weeklydigest.php', 1087096200, 0, -1, 3, 10, '7e7fccd07f781bdb24ac108d26612931', 1, 'Emails weekly topic &amp; forum digest emails', 1, 'weeklydigest', 0)";

		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."custom_bbcode (bbcode_title, bbcode_desc, bbcode_tag, bbcode_replace, bbcode_useoption, bbcode_example) VALUES ('Post Snap Back', 'This tag displays a little linked image which links back to a post - used when quoting posts from the board. Opens in same window by default.', 'snapback', '<a href=\"index.php?act=findpost&amp;pid={content}\"><{POST_SNAPBACK}></a>', 0, '[snapback]100[/snapback]');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."custom_bbcode (bbcode_title, bbcode_desc, bbcode_tag, bbcode_replace, bbcode_useoption, bbcode_example) VALUES ('Right', 'Aligns content to the right of the posting area', 'right', '<div align=''right''>{content}</div>', 0, '[right]Some text here[/right]');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."custom_bbcode (bbcode_title, bbcode_desc, bbcode_tag, bbcode_replace, bbcode_useoption, bbcode_example) VALUES ('Left', 'Aligns content to the left of the post', 'left', '<div align=''left''>{content}</div>', 0, '[left]Left aligned text[/left]');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."custom_bbcode (bbcode_title, bbcode_desc, bbcode_tag, bbcode_replace, bbcode_useoption, bbcode_example) VALUES ('Center', 'Aligns content to the center of the posting area.', 'center', '<div align=''center''>{content}</div>', 0, '[center]Centered Text[/center]');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."custom_bbcode (bbcode_title, bbcode_desc, bbcode_tag, bbcode_replace, bbcode_useoption, bbcode_example) VALUES ('Topic Link', 'This tag provides an easy way to link to a topic', 'topic', '<a href=''index.php?showtopic={option}''>{content}</a>', 1, '[topic=100]Click me![/topic]');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."custom_bbcode (bbcode_title, bbcode_desc, bbcode_tag, bbcode_replace, bbcode_useoption, bbcode_example) VALUES ('Post Link', 'This tag provides an easy way to link to a post.', 'post', '<a href=''index.php?act=findpost&pid={option}''>{content}</a>', 1, '[post=100]Click me![/post]');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."custom_bbcode (bbcode_title, bbcode_desc, bbcode_tag, bbcode_replace, bbcode_useoption, bbcode_example) VALUES ('CODEBOX', 'Use this BBCode tag to show a scrolling codebox. Useful for long sections of code.', 'codebox', '<div class=''codetop''>CODE</div><div class=''codemain'' style=''height:200px;white-space:pre;overflow:auto''>{content}</div>', 0, '[codebox]long_code_here = '';[/codebox]');";

		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."subscription_methods (submethod_title, submethod_name, submethod_email, submethod_sid, submethod_custom_1, submethod_custom_2, submethod_custom_3, submethod_custom_4, submethod_custom_5, submethod_is_cc, submethod_is_auto, submethod_desc, submethod_logo, submethod_active, submethod_use_currency) VALUES ('Safshop', 'safshop', '', '', '', '', '', '', '', 0, 1, 'Accepts all major credit cards', '', 1, 'USD');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."subscription_methods (submethod_title, submethod_name, submethod_email, submethod_sid, submethod_custom_1, submethod_custom_2, submethod_custom_3, submethod_custom_4, submethod_custom_5, submethod_is_cc, submethod_is_auto, submethod_desc, submethod_logo, submethod_active, submethod_use_currency) VALUES ('Protx', 'protx', '', '', '', '', '', '', '', 1, 1, 'Accepts all major credit cards', '', 1, 'GBP');";

		$SQL[] = "SET IDENTITY_INSERT ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type ON";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (1, 'pdf', 'application/pdf', 1, 0, 'folder_mime_types/pdf.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (2, 'png', 'image/png', 1, 1, 'folder_mime_types/quicktime.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (3, 'viv', 'video/vivo', 1, 0, 'folder_mime_types/win_player.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (4, 'wmv', 'video/x-msvideo', 1, 0, 'folder_mime_types/win_player.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (5, 'html', 'application/octet-stream', 1, 0, 'folder_mime_types/html.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (6, 'ram', 'audio/x-pn-realaudio', 1, 0, 'folder_mime_types/real_audio.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (7, 'gif', 'image/gif', 1, 1, 'folder_mime_types/gif.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (8, 'mpg', 'video/mpeg', 1, 0, 'folder_mime_types/quicktime.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (9, 'ico', 'image/ico', 1, 0, 'folder_mime_types/gif.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (10, 'tar', 'application/x-tar', 1, 0, 'folder_mime_types/zip.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (11, 'bmp', 'image/x-MS-bmp', 1, 0, 'folder_mime_types/gif.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (12, 'tiff', 'image/tiff', 1, 0, 'folder_mime_types/quicktime.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (13, 'rtf', 'text/richtext', 1, 0, 'folder_mime_types/rtf.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (14, 'hqx', 'application/mac-binhex40', 1, 0, 'folder_mime_types/stuffit.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (15, 'aiff', 'audio/x-aiff', 1, 0, 'folder_mime_types/quicktime.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (31, 'zip', 'application/zip', 1, 0, 'folder_mime_types/zip.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (17, 'ps', 'application/postscript', 1, 0, 'folder_mime_types/eps.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (18, 'doc', 'application/msword', 1, 0, 'folder_mime_types/doc.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (19, 'mov', 'video/quicktime', 1, 0, 'folder_mime_types/quicktime.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (20, 'ppt', 'application/powerpoint', 1, 0, 'folder_mime_types/ppt.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (21, 'wav', 'audio/x-wav', 1, 0, 'folder_mime_types/music.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (22, 'mp3', 'audio/x-mpeg', 1, 0, 'folder_mime_types/music.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (23, 'jpg', 'image/jpeg', 1, 1, 'folder_mime_types/gif.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (24, 'txt', 'text/plain', 1, 0, 'folder_mime_types/txt.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (25, 'xml', 'text/xml', 1, 0, 'folder_mime_types/script.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (26, 'css', 'text/css', 1, 0, 'folder_mime_types/script.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (27, 'swf', 'application/x-shockwave-flash', 0, 0, 'folder_mime_types/quicktime.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (32, 'php', 'application/octet-stream', 1, 0, 'folder_mime_types/php.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (28, 'htm', 'application/octet-stream', 1, 0, 'folder_mime_types/html.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (29, 'jpeg', 'image/jpeg', 1, 1, 'folder_mime_types/gif.gif');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type (atype_id, atype_extension, atype_mimetype, atype_post, atype_photo, atype_img) VALUES (33, 'gz', 'application/x-gzip', 1, 0, 'folder_mime_types/zip.gif');";
		$SQL[] = "SET IDENTITY_INSERT ".ipsRegistry::dbFunctions()->getPrefix()."attachments_type OFF";

		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('skin_id_cache', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('bbcode', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('moderators', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('multimod', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('banfilters', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('attachtypes', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('emoticons', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('forum_cache', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('badwords', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('systemvars', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('ranks', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('stats', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('profilefields', 'a:0:{}', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('settings','', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('languages', '', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('birthdays', 'a:0:{}', '', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."cache_store (cs_key, cs_value, cs_extra, cs_array) VALUES ('calendar', 'a:0:{}', '', 1);";

		$SQL[] = "SET IDENTITY_INSERT ".ipsRegistry::dbFunctions()->getPrefix()."skin_sets ON";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."skin_sets (set_skin_set_id, set_name, set_image_dir, set_hidden, set_default, set_css_method, set_skin_set_parent, set_author_email, set_author_name, set_author_url, set_css, set_cache_macro, set_wrapper, set_css_updated, set_cache_css, set_cache_wrapper, set_emoticon_folder) VALUES (1, 'IPB Master Skin Set', '1', 0, 0, '0', -1, '', '', '', '', '', '', 1079109298, '', '', 'default');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."skin_sets (set_skin_set_id, set_name, set_image_dir, set_hidden, set_default, set_css_method, set_skin_set_parent, set_author_email, set_author_name, set_author_url, set_css, set_cache_macro, set_wrapper, set_css_updated, set_cache_css, set_cache_wrapper, set_emoticon_folder) VALUES (2, 'IPB Default Skin', '1', 0, 1, '0', -1, 'ipbauto@invisionboard.com', 'Invision Power Services', 'www.invisionboard.com', '', '', '', 1074679074, '', '', 'default');";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."skin_sets (set_skin_set_id, set_name, set_image_dir, set_hidden, set_default, set_css_method, set_skin_set_parent, set_author_email, set_author_name, set_author_url, set_css, set_cache_macro, set_wrapper, set_css_updated, set_cache_css, set_cache_wrapper, set_emoticon_folder) VALUES (3, 'IPB Pre-2.0 Skins', '1', 0, 0, '0', -1, 'ipbauto@invisionboard.com', 'Invision Power Services', 'www.invisionboard.com', '', '', '', 1074679074, '', '', 'default');";
		$SQL[] = "SET IDENTITY_INSERT ".ipsRegistry::dbFunctions()->getPrefix()."skin_sets OFF";

		$SQL[] = "SET IDENTITY_INSERT ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles ON";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (1, 'General Configuration', 'These settings control the basics of the board such as URLs and paths.', 17);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (2, 'CPU Saving &amp; Optimization', 'This section allows certain features to be limited or removed to get more performance out of your board.', 16);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (3, 'Date &amp; Time Formats', 'This section contains the date and time formats used throughout the board.', 7);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (4, 'User Profiles', 'This section allows you to adjust your member''s global permissions and other options.', 22);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (5, 'Topics, Posts and Polls', 'These options control various elements when posting, reading topics and reading polls.', 32);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (6, 'Security and Privacy', 'These options allow you to adjust the security and privacy options for your board.', 18);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (7, 'Cookies', 'This section allows you to set the default cookie options.', 3);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (8, 'COPPA Set-up', 'This section allows you to comply with <a href=''http://www.ftc.gov/ogc/coppa1.htm''>COPPA</a>.', 3);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (9, 'Calendar &amp; Birthdays', 'This section will allow you to set up the board calendar and its related options.', 8);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (10, 'News Set-up', 'This section will allow you to specify the forum you wish to export news topics from to be used with ssi.php and IPDynamic Lite.', 2);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (11, 'Personal Message Set-up', 'This section allows you to control the global PM options.', 3);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (12, 'Email Set-up', 'This section will allow you to change the incoming and outgoing email addresses as well as the email method.', 7);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (13, 'Warn Set-up', 'This section will allow you to set up the warning system.', 15);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (14, 'Trash Can Set-up', 'The trashcan is a special forum in which topics are moved into instead of being deleted.', 6);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (15, 'Board Offline / Online', 'Use this setting to turn switch your board online or offline and leave a message for your visitors.', 2);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (16, 'Search Engine Spiders', 'This section will allow you to set up and maintain your search engine bot spider recognition settings.', 7);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (17, 'Board Guidelines', 'This section allows you to maintain your board guidelines. If enabled, a link will be added to the board header linking to the board guidelines.', 4);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (18, 'Converge Set Up', 'Converge is Invision Power Services central authentication method for all IPS applications. This allows you to have a single log-in for all your IPS products.', 1);";
		$SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count) VALUES (19, 'Full Text Search Set-Up', 'Full text searching is a very fast and very efficient way of searching large amounts of posts without maintaining a manual index. This may not be available for your system.', 2);";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count, conf_title_noshow, conf_title_keyword) VALUES (20,'Invision Chat Settings (Legacy Version)', 'This will allow you to customize your Invision Chat integration settings for the legacy edition.', 14, 1, 'chat');";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count, conf_title_noshow, conf_title_keyword) VALUES (21,'Invision Chat Settings', 'This will allow you to customize your Invision Chat integration settings for the new 2004 edition', 10, 1, 'chat04');";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count, conf_title_noshow, conf_title_keyword) VALUES (22,'IPB Portal', 'These settings enable you to enable or disable IPB Portal and control the options IPB Portal offers.', 20, 0, 'ipbportal');";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count, conf_title_noshow, conf_title_keyword) VALUES (23,'Subscriptions Manager', 'These settings control various subscription manager features.', 3, 0, 'subsmanager');";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count, conf_title_noshow, conf_title_keyword) VALUES (24,'IPB Registration', 'This section will allow you to edit your IPB registered licence settings.', 3, 1, 'ipbreg');";
        $SQL[] = "INSERT INTO ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles (conf_title_id, conf_title_title, conf_title_desc, conf_title_count, conf_title_noshow, conf_title_keyword) VALUES (25,'IPB Copyright Removal', 'This section allows you to manage your copyright removal key.', 2, 1, 'ipbcopyright');";
		$SQL[] = "SET IDENTITY_INSERT ".ipsRegistry::dbFunctions()->getPrefix()."conf_settings_titles OFF";

		$this->error   = array();
		$this->sqlcount = 0;

		$this->DB->return_die = 1;

		foreach( $SQL as $query )
		{
			$this->DB->allow_sub_select 	= 1;
			$this->DB->error				= '';

			$this->DB->query($query);

			if ( $this->DB->error )
			{
				$this->registry->output->addError( $query."<br /><br />".$this->DB->error );
			}
			else
			{
				$this->sqlcount++;
			}
		}

		$this->registry->output->addMessage("[Step 18 of 21] Inserts completed, dropping old tables next...<br /><br />$this->sqlcount queries run....");
		$this->request['workact'] = 'step_19';
	}

	/*-------------------------------------------------------------------------*/
	// STEP 19: DROPPING TABLES
	/*-------------------------------------------------------------------------*/
	function step_19()
	{
		$this->DB->dropTable('tmpl_names');
		$this->DB->dropTable('forums_bak');
		$this->DB->dropTable('categories');
		$this->DB->dropTable('messages');

		$this->error   = array();
		$this->sqlcount = 4;

		$this->registry->output->addMessage("[Step 19 of 21] Old tables dropped, optimization next...<br /><br />$this->sqlcount queries run....");
		$this->request['workact'] = 'step_20';
	}

	/*-------------------------------------------------------------------------*/
	// STEP 20: OPTIMIZATION
	/*-------------------------------------------------------------------------*/
	function step_20()
	{
		$this->DB->changeField('tracker', 'topic_id', 'topic_id', 'int', '0');
		$this->DB->addIndex('tracker', 'topic_id', 'topic_id');
		$this->DB->dropIndex('topics', 'forum_id');
		$this->DB->changeField('topics', 'pinned', 'pinned', 'tinyint', '0');
		$this->DB->changeField('topics', 'approved', 'approved', 'tinyint', '0');
		$this->DB->addIndex('topics', 'forum_id', 'forum_id,approved,pinned');
		$this->DB->addIndex('topics', 'topic_first_post', 'topic_firstpost');

		$SQL[] = "UPDATE ".ipsRegistry::dbFunctions()->getPrefix()."members SET language=''";

		$this->error   = array();
		$this->sqlcount 		= 7;
		$output					= "";

		$this->DB->return_die = 1;

		foreach( $SQL as $query )
		{
			$this->DB->allow_sub_select 	= 1;
			$this->DB->error				= '';

			if( IPSSetUp::getSavedData('man') )
			{
				$output .= preg_replace("/\sibf_(\S+?)([\s\.,]|$)/", " ".$this->DB->obj['sql_tbl_prefix']."\\1\\2", preg_replace( "/\s{1,}/", " ", $query ) )."\n\n";
			}
			else
			{
				$this->DB->query( $query );

				if ( $this->DB->error )
				{
					$this->registry->output->addError( $query."<br /><br />".$this->DB->error );
				}
				else
				{
					$this->sqlcount++;
				}
			}
		}

		$this->registry->output->addMessage("[Step 20 of 21] Optimization started...<br /><br />{$this->sqlcount} queries run....");
		$this->request['workact'] = 'step_21';

		if ( IPSSetUp::getSavedData('man') AND $output )
		{
			$this->_output = $this->registry->output->template()->upgrade_manual_queries( $output );
		}
	}

	/*-------------------------------------------------------------------------*/
	// STEP 21: OPTIMIZATION II
	/*-------------------------------------------------------------------------*/
	function step_21()
	{
		$this->DB->dropIndex('posts', 'topic_id');
		$this->DB->dropIndex('posts', 'author_id');
		$this->DB->addIndex('posts', 'topic_id', 'topic_id, queued, pid');
		$this->DB->addIndex('posts', 'author_id', 'author_id, topic_id');
		$this->DB->addIndex('posts', 'post_date', 'post_date');
		$this->DB->addIndex('polls', 'tid', 'tid');

		$this->error   = array();
		$this->sqlcount = 6;
		$output = "";

		$this->registry->output->addMessage("[Step 21 of 21] Optimization completed, new skins import next...<br /><br />{$this->sqlcount} queries run....");

		if ( IPSSetUp::getSavedData('man') AND $output )
		{
			$this->_output = $this->registry->output->template()->upgrade_manual_queries( $output );
		}

		unset($this->request['workact']);
		unset($this->request['st']);
	}
}