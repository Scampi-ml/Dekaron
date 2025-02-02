if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SP_CHAR_EDIT_RECOVER2]') and OBJECTPROPERTY(id, N'IsProcedure') = 1)
drop procedure [dbo].[SP_CHAR_EDIT_RECOVER2]
GO

SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS OFF 
GO

CREATE PROCEDURE dbo.SP_CHAR_EDIT_RECOVER2
	@i_user_no			varchar(14)			,
	@i_character_no		varchar(20)			,
	@i_character_name		varchar(40)			,
	@o_sp_rtn			INT			OUTPUT
AS
	DECLARE @v_reg_date		datetime	
	DECLARE @v_char_cnt		INT
BEGIN
	

SET @v_char_cnt = dbo.FN_GetCharCnt(@i_user_no)
	
	IF @v_char_cnt > 5
		BEGIN
			SET @o_sp_rtn = -1
			RETURN
		END	
	
	
	-- 캐릭터명 체크 (중복체크 / 필터링체크)
	EXEC SP_CHAR_NAME_CHECK @i_character_name, @o_sp_rtn OUTPUT
	
	IF @o_sp_rtn < 0 			-- 캐릭터명 오류
		BEGIN
			RETURN
		END	
	
	BEGIN TRANSACTION
	-------------------------------------------------------------------
	-- insert into user_character(캐릭터기본정보)  table
	-------------------------------------------------------------------
	INSERT INTO user_character
		( 							
			character_no	,
			character_name	,
			user_no			,
			dwAdv			,
			dwPeerage		,
			dwExp			,
			dwMoney			,
			dwStoreMoney	,
			dwStorageMoney	,
			nHP				,
			nMP				,
			wStr			,
			wDex			,
			wCon			,
			wSpr			,
			wPosX			,
			wPosY			,
			wRetPosX		,
			wRetPosY		,
			wMapIndex		,
			wRetMapIndex	,
			wStatPoint		,
			wSkillPoint		,
			wLevel			,
			byPCClass		,
			byDirection		,
			byRetDirection	,
			bySkillClearCount,
			byStatClearCount,
			wPKCount		,
			wChaoticLevel	,
			nShield			,
			dwFlag			,
			login_flag		,
			ipt_date		,
			ipt_time		,
			upt_time		,
			login_time		,
			logout_time		,
			user_ip_addr	,
			dwPVPPoint		,
			wWinRecord		,
			wLoseRecord		,
			wDrawRecord		,
			dwSupplyPoint	
		)
	SELECT	character_no	,
			@i_character_name,
			user_no			,
			dwAdv			,
			dwPeerage		,
			dwExp			,
			dwMoney			,
			dwStoreMoney	,
			dwStorageMoney	,
			nHP				,
			nMP				,
			wStr			,
			wDex			,
			wCon			,
			wSpr			,
			wPosX			,
			wPosY			,
			wRetPosX		,
			wRetPosY		,
			wMapIndex		,
			wRetMapIndex	,
			wStatPoint		,
			wSkillPoint		,
			wLevel			,
			byPCClass		,
			byDirection		,
			byRetDirection	,
			bySkillClearCount,
			byStatClearCount,
			wPKCount		,
			wChaoticLevel	,
			nShield			,
			dwFlag			,
			'Y'				,
			ipt_date		,
			ipt_time		,
			GetDate()		,
			GetDate()		,
			GetDate()		,
			user_ip_addr	,
			dwPVPPoint		,
			wWinRecord		,
			wLoseRecord		,
			wDrawRecord		,
			dwSupplyPoint	
	FROM	char2.dbo.user_character
	WHERE	character_no = @i_character_no			
	
	IF @@ERROR <> 0 OR @@ROWCOUNT <> 1
		-- user_character 등록실패
		BEGIN
			ROLLBACK TRANSACTION
			SET @o_sp_rtn = -2
			RETURN
		END

	
	-------------------------------------------------------------------
	-- insert into suit(캐릭터착용정보) table
	-------------------------------------------------------------------
	INSERT INTO USER_SUIT 
		( 
			character_no	,
			line_no			,
			byHeader		,
			wIndex			,
			dwSerialNumber	,
			info			,
			upt_time		,
			reg_bindate		,
			exp_bindate
		)
	SELECT	character_no	,
			line_no			,
			byHeader		,
			wIndex			,
			dwSerialNumber	,
			info			,
			upt_time		,
			0x00000000		,
			0x00000000
	FROM	char2.dbo.user_suit
	WHERE	character_no = @i_character_no

	IF @@ERROR <> 0
		-- user_suit 등록실패
		BEGIN
			ROLLBACK TRANSACTION
			SET @o_sp_rtn = -3
			RETURN
		END
	
	-------------------------------------------------------------------
	-- insert into bag(캐릭터인벤토리정보) table
	-------------------------------------------------------------------
	INSERT INTO USER_BAG 
		( 
			character_no	,
			line_no			,
			byHeader		,
			wIndex			,
			dwSerialNumber	,
			info			,
			upt_time		,
			reg_bindate		,
			exp_bindate
		)
	SELECT	character_no	,
			line_no			,
			byHeader		,
			wIndex			,
			dwSerialNumber	,
			info			,
			upt_time		,
			0x00000000		,
			0x00000000
	FROM	char2.dbo.user_bag
	WHERE	character_no = @i_character_no

	IF @@ERROR <> 0
		-- user_bag 등록실패
		BEGIN
			ROLLBACK TRANSACTION
			SET @o_sp_rtn = -4
			RETURN
		END

	-------------------------------------------------------------------
	-- insert into User_Storage(캐릭터창고정보) Table
	-------------------------------------------------------------------
	INSERT INTO USER_STORAGE
		( 
			character_no	,
			line_no			,
			byHeader		,
			wIndex			,
			dwSerialNumber	,
			info			,
			upt_time		,
			reg_bindate		,
			exp_bindate
		)
	SELECT	character_no	,
			line_no			,
			byHeader		,
			wIndex			,
			dwSerialNumber	,
			info			,
			upt_time		,
			0x00000000		,
			0x00000000
	FROM	char2.dbo.user_storage
	WHERE	character_no = @i_character_no

	IF @@ERROR <> 0
		-- user_bag 등록실패
		BEGIN
			ROLLBACK TRANSACTION
			SET @o_sp_rtn = -5
			RETURN
		END

	-------------------------------------------------------------------
	-- insert into User_Store(캐릭터개인상점) Table
	-------------------------------------------------------------------
	INSERT INTO USER_STORE
		( 
			character_no	,
			line_no			,
			dwPrice			,
			byHeader		,
			wIndex			,
			dwSerialNumber	,
			info			,
			upt_time		,
			reg_bindate		,
			exp_bindate
		)
	SELECT	character_no	,
			line_no			,
			dwPrice			,
			byHeader		,
			wIndex			,
			dwSerialNumber	,
			info			,
			upt_time		,
			0x00000000		,
			0x00000000
	FROM	char2.dbo.USER_STORE
	WHERE	character_no = @i_character_no

	IF @@ERROR <> 0
		-- user_bag 등록실패
		BEGIN
			ROLLBACK TRANSACTION
			SET @o_sp_rtn = -6
			RETURN
		END
	
	-------------------------------------------------------------------
	-- insert into skill (캐릭터스킬정보) table
	-------------------------------------------------------------------
	INSERT INTO USER_SKILL 
		(	
			character_no,
			line_no		,
			info		,
			ipt_time	,
			upt_time
		)
	SELECT	character_no,
			line_no		,
			info		,
			ipt_time	,
			upt_time
	FROM	char2.dbo.USER_SKILL
	WHERE	character_no = @i_character_no

	IF @@ERROR <> 0
		-- user_skill 등록실패
		BEGIN
			ROLLBACK TRANSACTION
			SET @o_sp_rtn = -7
			RETURN
		END

	-------------------------------------------------------------------
	-- insert into slot (캐릭터슬롯정보) table
	-------------------------------------------------------------------
	INSERT INTO USER_SLOT 
		(	
			character_no,
			line_no		,
			info		,
			ipt_time	,
			upt_time
		)
	SELECT	character_no,
			line_no		,
			info		,
			ipt_time	,
			upt_time
	FROM	char2.dbo.USER_SLOT
	WHERE	character_no = @i_character_no

	IF @@ERROR <> 0
		-- user_slot 등록실패
		BEGIN
			ROLLBACK TRANSACTION
			SET @o_sp_rtn = -8
			RETURN
		END

	-------------------------------------------------------------------
	-- insert into User_Quest_Doing (캐릭터퀘스트진행정보) Table
	-------------------------------------------------------------------
	INSERT INTO User_Quest_Doing 
		(	
			character_no	,
			q_index			,
			q_count_0		,
			q_count_1		,
			q_count_2		,
			q_count_3		,
			q_start_time	,
			upt_time
		)
	SELECT	character_no	,
			q_index			,
			q_count_0		,
			q_count_1		,
			q_count_2		,
			q_count_3		,
			q_start_time	,
			upt_time
	FROM	char2.dbo.User_Quest_Doing
	WHERE	character_no = @i_character_no

	IF @@ERROR <> 0
		-- User_Quest_Doing 등록실패
		BEGIN
			ROLLBACK TRANSACTION
			SET @o_sp_rtn = -9
			RETURN
		END
		
	-------------------------------------------------------------------
	-- insert into User_Quest_Done (캐릭터퀘스트완료정보) Table
	-------------------------------------------------------------------
	INSERT INTO User_Quest_Done
		(	
			character_no,
			q_index		,
			upt_time
		)
	SELECT	character_no,
			q_index		,
			upt_time
	FROM	char2.dbo.User_Quest_Done
	WHERE	character_no = @i_character_no

	IF @@ERROR <> 0
		-- User_Quest_Done 등록실패
		BEGIN
			ROLLBACK TRANSACTION
			SET @o_sp_rtn = -10
			RETURN
		END
	
	-------------------------------------------------------------------
	-- Delete User_Character_Secede (캐릭터삭제기본정보) Table
	-------------------------------------------------------------------

	-- DO NOT DELETE

	COMMIT TRANSACTION
	SET @o_sp_rtn = 0
	RETURN
END
GO
SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS ON 
GO

