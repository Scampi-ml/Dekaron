if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SP_ACC_LOGIN]') and OBJECTPROPERTY(id, N'IsProcedure') = 1)
drop procedure [dbo].[SP_ACC_LOGIN]
GO

SET QUOTED_IDENTIFIER ON 
GO
SET ANSI_NULLS ON 
GO

/******************************************************************************
   捞  抚 :	dbo.SP_ACC_LOGIN
   汲  疙 : 拌沥 肺弊牢
   包访按眉 : 
   角青搬苞 : @sp_rtn
				0   : 己傍.
			  	-1	: 蜡历沥焊啊 绝阑锭.
				-2	: 菩胶况靛啊 老摹窍瘤 臼阑锭.
				-3	: 昆其捞瘤俊辑 俺牢沥焊函版 救登绢 乐绰 惑怕.
				-4	: 厚肺弊牢 惑怕啊 酒匆锭. (捞固 肺弊牢吝)
				-5	: 肺弊牢惑怕 函版 角菩.
				-6	: 辑厚胶 扁埃捞 酒凑聪促.
				-7	: 霸烙力犁 沥焊傈价 坷幅.
				-8	: 霸烙力犁吝.
				-10 : Update Lock 坷幅(DB 坷幅)
				-11 : 力茄IP措惑.
				-20 : DB Error
				-21 : 促弗辑滚 肺弊牢吝
 Ver        Date        Author          Description
 ---------  ----------  --------------  ------------------------------------
 1.0		2004-10-11  茄瘤宽          1. 拌沥 肺弊牢
 1.1		2005-09-07	弥瘤券			1. 荤郴IP喉钒 窃荐肺 函版.
 1.2		2005-09-12	弥瘤券			1. IP备盒怕弊(@ip_addr_tag) OUTPUT颇扼皋磐 眠啊.
										   (PC规 IP咯何甫 魄窜窍扁 困茄 蔼)
 1.3		2005-11-14	弥瘤券			1. 拌沥立加老访锅龋Key, PC规雀盔锅龋,
										   PC规 醚魄锅龋 眠啊.
										2. PC规 IP咯何八荤 窃荐(FN_IsPCBangIP)甫
										   SP_GET_PCBANG_INFO_R肺 函版.
 1.4		2006-01-04  茄瘤宽          1. 立加肺弊 飘罚黎记 救栏肺 捞悼
 1.5		2006-01-11  茄瘤宽          1. 捞固 肺弊牢吝(-4) : 沥惑贸府 (RollBack, Return 绝澜)
 1.6        2007.02.05	CHOI JI HWAN  	1. modify @user_pwd parameter.
											before : varchar(20) 
											after  : varchar(64)
 1.7		2007.02.14	CHOI JI HWAN	1. 秦欧傈淬馆 ip 牢刘 风凭 眠啊.
										2. 厚剐锅龋 MD5 鞠龋拳
											@user_pwd : VARCHAR(20) -> VARCHAR(64)
 1.8		2007.02.15	Han JI wook		1. User_ID -> Lower Casting
 1.9		2007.02.20	Han JI wook		1. User_ID -> Lower Casting Cancel
 ******************************************************************************/

CREATE    PROCEDURE dbo.SP_ACC_LOGIN
	@user_id			varchar(40)				,	-- 霸烙拌沥ID
	@user_pwd			varchar(64)				,	-- 霸烙拌沥 菩胶况靛
	@login_flag			int					,	-- 肺弊牢惑怕幅
	@user_ip_addr			varbinary(4)				,	-- 立加磊IP林家
	@user_no			varchar(14)		OUTPUT	,	-- 霸烙拌沥雀盔锅龋
	@session_id			int			OUTPUT	,	-- 技记辑滚ID
	@teen_tag			int			OUTPUT	,	-- 霸烙殿鞭怕弊 (0:18技捞惑, 1:18技固父)
	@ip_addr_tag			int			OUTPUT	,	-- IP林家备盒怕弊(0:老馆, 1:PC规)
	@o_ac_conn_no		char(20)			OUTPUT	,	-- 拌沥立加老访锅龋Key				-> 眠啊
	@o_pcbang_no			varchar(14)		OUTPUT	,	-- PC规 雀盔锅龋.					-> ( 2005-11-11 )眠啊
	@o_pc_agency_no		varchar(5)		OUTPUT	,	-- PC规 醚魄锅龋					-> 眠啊
	@sp_rtn			int			OUTPUT		-- 馆券蔼 府畔 (0:沥惑)
AS
	DECLARE @v_user_pwd	varchar(64)
	DECLARE @v_login_flag	int
	DECLARE @v_user_no		varchar(14)
	DECLARE @v_resident_no	varchar(13)
	DECLARE @v_login_tag		char(1)
	DECLARE @v_user_age	int
	DECLARE @ipt_time		datetime
	DECLARE @conn_rtn		int
	DECLARE @ip_tag		int
	DECLARE @company_ip	varbinary(3)
	DECLARE @v_server_id		varchar(3)
	DECLARE @v_user_sex		varchar(1)
	DECLARE @rowcnt		int
	DECLARE @rowcnt2		int
	
	--// 霸烙力犁
	DECLARE @o_p_step_no	int				--力犁窜拌
	DECLARE @o_p_reason_sort	varchar(2)		--力犁荤蜡盒幅
	DECLARE @o_p_expire_time	datetime		--力犁父丰老磊
	DECLARE @v_lo_block_tag	varchar(1)		--肺弊牢陛瘤咯何
	DECLARE @o_wr_block_tag	varchar(1)		--静扁陛瘤咯何
	DECLARE @v_in_sp_rtn		int
	DECLARE @v_bigint_ip		bigint

	DECLARE @v_user_ip_addr	varchar(50)

	--// Email Settings
/*
	DECLARE @email_tag		varchar(1)
	DECLARE @email 		varchar(500)
	DECLARE @old_ip		varbinary(4)
	DECLARE @old_ip2		varchar(50)
	DECLARE @curr_ip		varchar(500)
*/
	
	

BEGIN

	SET LOCK_TIMEOUT 1000

	SET @v_bigint_ip	= CAST(@user_ip_addr as BIGINT)
	SET @ipt_time		= GetDate()
	SET @conn_rtn		= 0
	SET @user_no		= '0000000000'
	SET @session_id	= 0
	SET @teen_tag		= 0
	SET @ip_addr_tag	= 0
	SET @sp_rtn		= 0
	SET @o_ac_conn_no	= '0000000000000000'
	SET @o_pcbang_no	= ''
	SET @o_pc_agency_no	= ''


	BEGIN TRANSACTION	

	--************************************
	-- BEGINJanvier123 IP Block
	--************************************

	/*
	
	SELECT @v_user_ip_addr
	FROM	game.dbo.register_banned WITH(UPDLOCK)
	WHERE	ip = dbo.FN_IpBinToStr(@user_ip_addr)
	
	SET @rowcnt2 = @@ROWCOUNT

	
	
	IF @@ERROR <> 0
		BEGIN
			ROLLBACK TRANSACTION
			SET @sp_rtn = -11
			RETURN
		END

	IF @rowcnt2 = 1
		BEGIN
			ROLLBACK TRANSACTION
			SET @sp_rtn = -11			
			RETURN
		END	


	*/
	
	--************************************
	-- END Janvier123 IP Block
	--************************************

	
	SELECT	@v_user_no		= user_no, 
		   	@v_user_pwd		= isnull(user_pwd, ''), 
		   	@v_login_flag	= login_flag,
			@v_login_tag	= login_tag,
			@v_resident_no = resident_no
	FROM	dbo.user_profile WITH(UPDLOCK)
	WHERE	user_id = @user_id
	--AND	login_tag = 'Y'
	
	SET @rowcnt = @@ROWCOUNT

	
	
	IF @@ERROR <> 0
		BEGIN
			ROLLBACK TRANSACTION
			SET @sp_rtn = -10
			RETURN
		END


	--************************************
	-- Show msg when banned
	--************************************
	IF @v_login_tag = 'N'
		BEGIN
			ROLLBACK TRANSACTION
			SET @sp_rtn = -8		
			RETURN
		END


	--************************************
	-- 拌沥沥焊 Check
	--************************************
	--// 1. 蜡历沥焊 蜡公 眉农
	IF @rowcnt = 0
		BEGIN
			ROLLBACK TRANSACTION
			SET @sp_rtn = -1			
			RETURN
		END
	
	IF ISNULL(dbo.FN_CertifyIpPwd( @user_ip_addr, @user_pwd ), 0) <> 1	--GM : no password check.
	BEGIN
		--// 2. 菩胶况靛 老摹咯何 眉农
		SELECT @user_pwd = isnull(@user_pwd, '')
		IF @v_user_pwd <> @user_pwd or @user_pwd = ''
			BEGIN
				ROLLBACK TRANSACTION
				SET @sp_rtn = -2
				RETURN
			END
	END

	--// 3.1 昆其捞瘤俊辑 俺牢沥焊函版 救登绢乐绰 惑怕
	--// 3.2 昆其捞瘤俊辑 俺牢沥焊函版窍搁 login_tag啊 'Y'肺 官诧促.
	IF @v_login_tag = 'C'
		BEGIN
			ROLLBACK TRANSACTION
			SET @sp_rtn = -3
			RETURN
		END
	
	
	--// 4. 肺弊牢惑怕咯何 眉农
	IF ( (@v_login_flag <> 0) AND (@v_login_flag = @login_flag) ) BEGIN
		--// ROLLBACK TRANSACTION
		SET @session_id = @v_login_flag
		SET @sp_rtn = -4			
		--// RETURN
	END	
	
	IF ( (@v_login_flag <> 0) AND (@v_login_flag <> @login_flag) ) BEGIN
		ROLLBACK TRANSACTION
		SET @session_id = @v_login_flag
		SET @sp_rtn = -4
		RETURN
	END
	
	--************************************
	 -- 肺弊牢陛瘤(霸烙力犁) 八荤
	 --************************************
	 EXEC dbo.MB_USR_PUN_CheckBlock_R   @v_user_no               ,    --雀盔锅龋
	                                 	@o_p_step_no       OUTPUT,    --力犁窜拌
	                                 	@o_p_reason_sort   OUTPUT,    --力犁荤蜡盒幅
	                                 	@o_p_expire_time   OUTPUT,    --力犁父丰老矫
	                                 	@v_lo_block_tag    OUTPUT,    --肺弊牢陛瘤咯何(Y=陛瘤, N=肺弊牢啊瓷)
	                                 	@o_wr_block_tag    OUTPUT,    --静扁陛瘤(霸烙率俊辑 荤侩救窃)
	                                 	@v_in_sp_rtn       OUTPUT     --角青搬苞(0:己傍)
	 IF @v_in_sp_rtn <> 0 OR @@Error <> 0 
		 BEGIN
		    ROLLBACK TRANSACTION
			SET @sp_rtn = -7
		    RETURN
		 END

	 IF Upper(@v_lo_block_tag) = 'Y'  --肺弊牢陛瘤牢 版快.
		 BEGIN
		    ROLLBACK TRANSACTION
			SET @sp_rtn = -8
		    RETURN
		 END

	SET @user_no 		= @v_user_no
	SET @v_user_age 	= dbo.FN_ResidentNoToAge(@v_resident_no,getDate()) 	
	SET @v_server_id	= dbo.FN_LoginFlagToServerID(@login_flag)
	SET @v_user_sex		= dbo.FN_ResidentNoToSex(@v_resident_no)
	
	SET @teen_tag = CASE 
						WHEN @v_user_age < 18 THEN 1
						ELSE 0
	END




	--//BEGIN IP CHANGE EMAIL
	/*

	SET @email_tag = 0
	SET @email_tag = (SELECT ip_change_game FROM account.dbo.user_email WHERE user_no = @user_no)
	
	IF @email_tag = 1
	BEGIN
		SET @email = (SELECT email FROM account.dbo.user_data WHERE user_no = @user_no)		
		
		IF @email != ''
		BEGIN
			SET @curr_ip = account.dbo.FN_IpBinToStr(@user_ip_addr)
			SET @old_ip =  (SELECT user_ip_addr FROM account.dbo.user_profile WHERE user_no = @user_no)		
			SET @old_ip2 = account.dbo.FN_IpBinToStr(@old_ip)

			IF @old_ip2 != @curr_ip
			BEGIN
				INSERT INTO game.dbo.email_queue_g_ip_change
		 		(
				            user_no,
				            email,
				            old_ip,
				            new_ip,
				            is_send
				)
				values
				(
					@user_no,
					@email,
					@old_ip2,
					@curr_ip,
					0
				)
			END
		END
	END
*/
	
	
	--// 肺弊牢惑怕 函版
	UPDATE 	dbo.user_profile 
	SET 	login_flag	= @login_flag	,
			login_time 	= @ipt_time		,
			user_ip_addr= @user_ip_addr	,
			server_id 	= @v_server_id
	WHERE 	user_no 	= @user_no
	AND 	login_flag 	= @v_login_flag

	IF (@@ERROR <> 0 or @@ROWCOUNT <> 1) 
		BEGIN
			ROLLBACK TRANSACTION
			SET @sp_rtn = -5
			RETURN
		END
	
	--// IP林家备盒 怕弊 汲沥.
	EXEC dbo.SP_GET_PCBANG_INFO_R	
				@user_ip_addr			,	-- IP林家.
				@o_pcbang_no	OUTPUT	,	-- PC规 雀盔锅龋.
				@o_pc_agency_no	OUTPUT	,	-- PC规 醚魄锅龋.	
				@ip_addr_tag	OUTPUT	,	-- IP林家备盒怕弊(0:老馆, 1:PC规)
				NULL						-- @o_sp_rtn
	SELECT @ip_addr_tag = IsNull(@ip_addr_tag, 0)
	-------------------------------------------------------------------

	-- 霸烙拌沥 立加肺弊 殿废
	EXEC dbo.SP_ACNT_CONNLOG_C 
			@user_no				, 
			@login_flag				, 
			@user_ip_addr			, 
			@ipt_time				, 
			@o_pcbang_no			,
			@o_pc_agency_no			,
			@v_user_age				,
			@v_user_sex				,
			@o_ac_conn_no	OUTPUT	, 
			@conn_rtn		OUTPUT
	
	IF @@ERROR <> 0 OR @conn_rtn <> 0 BEGIN
		IF @@TRANCOUNT > 0 
			ROLLBACK TRANSACTION
		SET @sp_rtn = -20
		RETURN
	END	


	UPDATE  account.dbo.user_data  SET logins = logins + 1 WHERE user_no = @user_no;

	COMMIT TRANSACTION
	--//SET @sp_rtn = 0
	RETURN
	
END
GO
SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS ON 
GO

