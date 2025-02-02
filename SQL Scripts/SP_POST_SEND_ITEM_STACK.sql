if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SP_POST_SEND_ITEM_STACK]') and OBJECTPROPERTY(id, N'IsProcedure') = 1)
drop procedure [dbo].[SP_POST_SEND_ITEM_STACK]
GO

SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS OFF 
GO

CREATE     PROCEDURE SP_POST_SEND_ITEM_STACK
	@i_character_no	VARCHAR(18),				--// 캐릭터번호
	@i_from_char_nm	VARCHAR(40),				--// 보낸사람
	@i_post_sort		TINYINT,					--// 우편물분류
	@i_post_title		VARCHAR(50),				--// 제목
	@i_body_text		VARCHAR(500),				--// 본문
	@i_wIndex		INT,						--// 아이템인덱스
	@i_include_dil		BIGINT,						--// 포함딜
	@o_sp_rtn		INT				OUTPUT		--// 반환값
AS
	DECLARE @v_post_no			varchar(18)			--// 우편물일련번호
	DECLARE @v_state_tag		tinyint				--// 상태구분
	DECLARE @v_byHeader			smallint			--// 아이템헤더
	DECLARE @v_dwSerialNumber	binary(16)			--// 아이템시리얼넘버
	DECLARE @v_expire_day		int					--// 만료기간
	DECLARE @v_character_no		varchar(20)			--// 받는사람 캐릭터번호
	DECLARE @v_info				varbinary(25)		--// 아이템정보
	DECLARE @v_item_tag			tinyint				--// 아이템상태값
	DECLARE @v_dil_tag			tinyint				--// DIL 상태값
	
	DECLARE	@v_tab_nm			varchar(20)
	DECLARE @v_m_date			varchar(6)
	DECLARE @v_spid				varchar(4)
	DECLARE @v_regdate			varchar(8)
	DECLARE @v_seq_no			int
	
	--// SerialNumber Info
	DECLARE @v_wLinear			int
	DECLARE @v_dwRandom			int
	DECLARE @v_curr_date		varchar(10)
	
	DECLARE @v_curr_time		datetime						--// 현재일시
	DECLARE @v_expire_time		datetime						--// 만료일시
	
BEGIN
	SET @o_sp_rtn			= 0
	SET @v_state_tag		= 0									--// 미확인
	SET @v_byHeader			= 1
	SET @v_dwSerialNumber	= 0x00000000000000000000000000000000
	SET @v_info				= dbo.HexToBin('0x000A')
	SET @v_item_tag			= 1
	SET @v_dil_tag			= 1
	
	SET @v_curr_time		= GetDate()							--// 현재일시
	SET @v_expire_day		= 30								--// 만료기간
	SET @v_expire_time		= @v_curr_time + @v_expire_day		--// 만료일시
	
	--****************************************************************
	-- 우편물일련번호 생성규칙
	-- 형식 : char(18) - 일자[YYMMDD] + 일련번호(8) + SPID(4)
	--****************************************************************
	SET @v_spid = CAST(dbo.FN_GetAutoNo(@@spid,4) as varchar(4))
	
	--// 관리코드 테이블네임 설정 (테이블명_캐릭터구분)
	SET @v_tab_nm = 'USER_POSTBOX'
	SET @v_regdate = SUBSTRING(CONVERT(varchar(10),GetDate(),112),1,6)+'01'
	--// 우편물일련번호 체번
	EXEC sp_com_seqno @v_tab_nm, @v_regdate, @v_seq_no OUTPUT
	IF @v_seq_no < 1 BEGIN			--// 일련번호 체번오류
		SELECT	@o_sp_rtn = -1
		RETURN
	END	
	
	--// post_no 생성
	SET @v_m_date = SUBSTRING(CONVERT(varchar(10),GetDate(),112),3,6)
	SET @v_post_no = @v_m_date + dbo.FN_GetAutoNo(@v_seq_no,8) + @v_spid
	
	--// 관리코드 테이블네임 설정 (테이블명 >> 아이템시리얼)
	SELECT	@v_tab_nm		= 'ITEM_SERIALNUMBER'
	SELECT	@v_curr_date	= CONVERT(varchar(10),GetDate(),112)
	--// 아이템시리얼 일련번호 체번
	EXEC sp_com_seqno @v_tab_nm, @v_curr_date, @v_wLinear OUTPUT
	IF @v_wLinear < 1 			-- 일련번호 체번오류
		BEGIN
			SELECT	@o_sp_rtn = -2
			RETURN
		END	
	--// 아이템시리얼 랜덤번호 생성 (아이템시리얼 중복방지)
	SELECT	@v_dwRandom = CAST(10000*Rand()+1 as INT)
	--// 아이템시리얼번호 생성
	SELECT	@v_dwSerialNumber = dbo.FN_GetSerialNumber(@v_curr_time, @v_wLinear, @v_dwRandom) 
	
	IF @i_wIndex = 0
		BEGIN
			SET @v_byHeader			= NULL
			SET @v_dwSerialNumber	= NULL
			SET @v_info				= NULL
			SET @v_item_tag			= 0
		END
	
	IF @i_include_dil = 0
		BEGIN
			SET @v_dil_tag = 0
		END
	
	BEGIN TRANSACTION
	--****************************************************************
	-- 1. insert into user_postbox(우편함)  table
	--****************************************************************
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
		@i_post_sort,
		@i_post_title,
		@i_body_text,
		@v_state_tag,
		@v_item_tag,
		@v_byHeader,
		@i_wIndex,
		@v_dwSerialNumber,
		@v_info,
		@v_dil_tag,
		@i_include_dil,
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

