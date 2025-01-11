USE [account]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE                PROCEDURE [dbo].[sp_create_account]
	@user_id			varchar(40),		
	@user_pwd			varchar(60),
	@sp_rtn				int		OUTPUT		
AS
	DECLARE @ipt_time	datetime
	DECLARE @seq_no 	numeric
	DECLARE @user_no	varchar(14)
	DECLARE @m_date		varchar(6)
	DECLARE @md5_pasw	varchar(60)
BEGIN
	SET @ipt_time = GetDate()
	
	SET @md5_pasw = LOWER(CONVERT(NVARCHAR(32),HashBytes('MD5', @user_pwd),2));

	EXEC sp_com_seqno 'USER_PROFILE', @ipt_time, @seq_no OUTPUT
	
	IF @seq_no < 1
		BEGIN
			SET @sp_rtn = -1
			RETURN
		END	

	SELECT @m_date = SUBSTRING(CONVERT(varchar(10),@ipt_time,112),3,6)
	SELECT @user_no = @m_date + '999' + dbo.FN_GetAutoNo(@seq_no,5)
	
	BEGIN TRANSACTION	
						 
						 
		INSERT INTO USER_PROFILE
		(
			user_no,
			user_id,
			user_pwd,
			gmtag,
			user_country,
			user_gender,
			user_gm,
			user_admin,
			user_reg_date,
			user_age,
			user_sn,
			user_mail	
		) 
		VALUES 
		(
			@user_no,
			@user_id,
			@md5_pasw,
			'0x99',
			'0',
			'0',
			'0',
			'0',
			'0',
			'0',
			'0',
			'0'
		)						 
	
	IF ( @@error <> 0 or @@rowcount <>1 ) 
		BEGIN
			ROLLBACK TRANSACTION
			SET @sp_rtn = -2			
			RETURN
		END
	
	SET @sp_rtn = 0
	COMMIT TRANSACTION
	RETURN
END
GO


