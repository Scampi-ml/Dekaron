if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SP_CHAR_MOVE_BANNED]') and OBJECTPROPERTY(id, N'IsProcedure') = 1)
drop procedure [dbo].[SP_CHAR_MOVE_BANNED]
GO

SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS OFF 
GO

CREATE PROCEDURE dbo.SP_CHAR_MOVE_BANNED
	@character_no			varchar(50)			,
	@sp_rtn					INT			OUTPUT
AS
BEGIN
	
	BEGIN TRANSACTION		

	/*	user_character_secede	1	*/
	INSERT INTO user_character_banned 
		(
			character_no		,	 
			character_name		, 
			user_no				, 
			dwAdv				,
			dwPeerage			,
			dwExp				, 
			dwMoney				, 
			dwStoreMoney		, 
			dwStorageMoney		,
			nHP					, 
			nMP					, 
			wStr				, 
			wDex				, 
			wCon				, 
			wSpr				, 
			wPosX				, 
			wPosY				, 
			wRetPosX			, 
			wRetPosY			, 
			wMapIndex			, 
			wRetMapIndex		, 
			wStatPoint			, 
			wSkillPoint			, 
			wLevel				, 
			byPCClass			, 
			byDirection			, 
			byRetDirection		,
			bySkillClearCount	,
			byStatClearCount	,
			wPKCount			,
			wChaoticLevel		,
			nShield				,
			dwFlag				,
			login_flag			, 
			ipt_date			, 
			ipt_time			, 
			upt_time			, 
			login_time			, 
			logout_time			, 
			user_ip_addr		, 
			dwPVPPoint			,		
			wWinRecord			,
			wLoseRecord			,
			wDrawRecord			,
			dwSupplyPoint
	)
	SELECT	character_no		, 
			character_name		, 
			user_no				, 
			dwAdv				,
			dwPeerage			,
			dwExp				, 
			dwMoney				, 
			dwStoreMoney		, 
			dwStorageMoney		, 
			nHP					, 
			nMP					, 
			wStr				, 
			wDex				, 
			wCon				, 
			wSpr				, 
			wPosX				, 
			wPosY				, 
			wRetPosX			, 
			wRetPosY			, 
			wMapIndex			, 
			wRetMapIndex		, 
			wStatPoint			, 
			wSkillPoint			, 
			wLevel				, 
			byPCClass			, 
			byDirection			, 
			byRetDirection		,
			bySkillClearCount	,
			byStatClearCount	,
			wPKCount			,
			wChaoticLevel		,
			nShield				,
			dwFlag				,
			login_flag			, 
			ipt_date			, 
			ipt_time			, 
			upt_time			, 
			login_time			, 
			logout_time			, 
			user_ip_addr		, 
			dwPVPPoint			,		
			wWinRecord			,
			wLoseRecord			,
			wDrawRecord			,
			dwSupplyPoint		
	FROM	user_character
	WHERE	character_no = @character_no


	-- Start deleting
	DELETE FROM  user_bag
	WHERE character_no = @character_no

	DELETE FROM  user_character
	WHERE character_no = @character_no

	DELETE FROM  USER_POSTBOX
	WHERE character_no = @character_no

	DELETE FROM  User_Quest_Doing
	WHERE character_no = @character_no

	DELETE FROM  User_Quest_Done
	WHERE character_no = @character_no

	DELETE FROM  user_skill
	WHERE character_no = @character_no

	DELETE FROM  user_slot
	WHERE character_no = @character_no

	DELETE FROM  user_storage
	WHERE character_no = @character_no

	DELETE FROM  USER_STORE
	WHERE character_no = @character_no

	DELETE FROM  user_suit
	WHERE character_no = @character_no



	
	COMMIT TRANSACTION
	SET @sp_rtn = @@error
	RETURN  @@error
	
END
GO
SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS ON 
GO

