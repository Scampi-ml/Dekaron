if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SP_POST_SEND_MAVRIC]') and OBJECTPROPERTY(id, N'IsProcedure') = 1)
drop procedure [dbo].[SP_POST_SEND_MAVRIC]
GO

SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS OFF 
GO

CREATE     PROCEDURE SP_POST_SEND_MAVRIC
	@i_character_no	VARCHAR(18),				
	@i_from_char_nm	VARCHAR(40),				
	@i_post_title		VARCHAR(50),				
	@i_body_text		VARCHAR(500),				
	@i_wIndex		INT,					
	@i_byHeader		SMALLINT,				
	@i_info			VARCHAR(1000),
	@o_sp_rtn		INT				OUTPUT		
AS
	DECLARE @v_post_no			varchar(18)		
	DECLARE @v_state_tag		tinyint			
	DECLARE @v_byHeader		smallint			
	DECLARE @v_dwSerialNumber		binary(16)		
	DECLARE @v_expire_day		int			
	DECLARE @v_character_no		varchar(20)		
	DECLARE @v_info			varbinary(25)		
	DECLARE @v_item_tag			tinyint			
	DECLARE @v_dil_tag			tinyint			
	DECLARE @v_tab_nm			varchar(20)
	DECLARE @v_m_date			varchar(6)
	DECLARE @v_spid			varchar(4)
	DECLARE @v_regdate			varchar(8)
	DECLARE @v_seq_no			int
	DECLARE @v_include_dil		int
	DECLARE @v_post_sort			tinyint		
	DECLARE @v_wLinear			int
	DECLARE @v_dwRandom		int
	DECLARE @v_curr_date		varchar(10)
	DECLARE @v_curr_time			datetime		
	DECLARE @v_expire_time		datetime		
	
BEGIN
	SET @o_sp_rtn			= 0
	SET @v_state_tag		= 0				
	SET @v_byHeader		= @i_byHeader
	SET @v_dwSerialNumber	= 0x00000000000000000000000000000000
	SET @v_info			= dbo.HexToBin(@i_info)
	SET @v_item_tag		= 1
	SET @v_dil_tag			= 0
	SET @v_curr_time		= GetDate()			
	SET @v_expire_day		= 30				
	SET @v_expire_time		= @v_curr_time + @v_expire_day
	SET @v_include_dil		= 0
	SET @v_post_sort		= 0
 	SET @v_item_tag		= 0
	


	SET @v_spid = CAST(dbo.FN_GetAutoNo(@@spid,4) as varchar(4))
	SET @v_tab_nm = 'USER_POSTBOX'
	SET @v_regdate = SUBSTRING(CONVERT(varchar(10),GetDate(),112),1,6)+'01'


	EXEC sp_com_seqno @v_tab_nm, @v_regdate, @v_seq_no OUTPUT
	IF @v_seq_no < 1 BEGIN		
		SELECT	@o_sp_rtn = -1
		RETURN
	END	
	
	SET @v_m_date = SUBSTRING(CONVERT(varchar(10),GetDate(),112),3,6)
	SET @v_post_no = @v_m_date + dbo.FN_GetAutoNo(@v_seq_no,8) + @v_spid
	
	SELECT	@v_tab_nm		= 'ITEM_SERIALNUMBER'
	SELECT	@v_curr_date	= CONVERT(varchar(10),GetDate(),112)


	EXEC sp_com_seqno @v_tab_nm, @v_curr_date, @v_wLinear OUTPUT
	IF @v_wLinear < 1 	
		BEGIN
			SELECT	@o_sp_rtn = -2
			RETURN
		END	

	SELECT	@v_dwRandom = CAST(10000*Rand()+1 as INT)
	SELECT	@v_dwSerialNumber = dbo.FN_GetSerialNumber(@v_curr_time, @v_wLinear, @v_dwRandom) 


	SET @v_info = CONVERT(varbinary(25), @v_info, 2)
	
	BEGIN TRANSACTION
	INSERT INTO USER_POSTBOX
	(
		character_no,
		post_no,
		from_char_nm,
		post_sort,
		post_title,
		body_text,
		state_tag,
		item_tag,
		byHeader,
		wIndex,
		dwSerialNumber,
		info,
		dil_tag,
		include_dil,
		ipt_time,
		expire_time
	)
	VALUES
	(	
		@i_character_no,
		@v_post_no,
		@i_from_char_nm,
		@v_post_sort,
		@i_post_title,
		@i_body_text,
		@v_state_tag,
		@v_item_tag,
		@v_byHeader,
		@i_wIndex,
		@v_dwSerialNumber,
		@v_info,
		@v_dil_tag,
		@v_include_dil,
		@v_curr_time,
		@v_expire_time
	)

	IF @@ERROR <> 0 OR @@ROWCOUNT <> 1
		-- USER_POSTBOX 등록실패
		BEGIN
			ROLLBACK TRANSACTION
			SET @o_sp_rtn = -3
			RETURN
		END

	COMMIT TRANSACTION
	SET @o_sp_rtn = 0
	RETURN
END
GO
SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS ON 
GO

