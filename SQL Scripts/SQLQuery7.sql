USE [character]
GO
/****** Object:  StoredProcedure [dbo].[SP_SIEGE_INFO_R]    Script Date: 06/21/2014 06:57:54 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO



/*****************************************************************************
 Name 	:	dbo.SP_SIEGE_INFO_R
 Desc 	:	Read siege info.
			@o_entryGuildInfo 형식(직인길드 리스트)
			Header 	: Total size[2] + Total count[1]
			Detail 	: Guild name size[1] + Guild name[Max 30] + Guild master size[1] + Guild master name[Max40] +
					  Guild mark[2] + Guild mark background[2] + Guild mark effect[2] + Guild channel[1][N] 
 Object : dbo.SP_SIEGE_INFO_R
 Return	: @o_sp_rtn
			0   : OK.
			1	: 채널에 공성정보 없음
			-1	: 입력값 오류
			-2	: 길드정보 Read 오류
			-3	: 공성정보 Read 오류
			-4	: 직인길드 Read 오류
 Ver	Date			Author          Description
 ----  	---------------	--------------  ------------------------------
 1.0	2006-05-05(FRI) Han Ji-Wook		1. Create
 1.1	2006-05-11(THU) Han Ji-Wook		1. 인던퀘스트 남은 시간 추가
										2. 인던퀘스트 공성전하는주 수요일 0시
 1.2	2006-05-15(MON) Han Ji-Wook		1. 인던퀘스트 남은시간 파라미터 이름변경
											(@o_dwSealRegistTime -> @o_dwDungeonRegistTime)
										2. 수성 길드마스터명 추가 (@o_guild_master)
										3. 공성시작시간 등록가능기간 추가 
											(@o_dwRegistTimeStart, @o_dwRegistTimeEnd)
										4. 공성시작 등록여부 추가 (@o_byRegistTimeFlag)
										5. @o_entryGuildInfo >> 길드마스터명 추가
 1.3	2006-05-30(TUE) Han Ji-Wook		1. 공성정보가 없으면 << 1 >> Return
 1.4	2006-06-14(WED) Han Ji-Wook		1. 세금필드 변경[10억카운트, 잔여세금]
 1.5	2006-07-31(MON) Han Ji-Wook		1. 공성직인등록가능시간, 다음공성선포기간 변경
 1.6	2006-08-09(WED) Han Ji-Wook		1. 공성직인등록가능시간, 다음공성선포기간 변경
 1.7	2006-09-05(TUE) Han Ji-Wook		1. 세금 (billion_cnt, remain_tax) Data Type 변경
 1.8	2007-01-03(WED) Choi Ji-Hwan	1. 데드프론트 시간정보(@o_DeadFrontTimeInfo) 추가.
 1.9	2007-01-05(WED) Choi Ji-Hwan	1. 데드프론트 시간정보 순서 맨위로.
 2.0	2007-10-16(TUE) HAN JIWOOK		1. Delete DeadFront Time Info
******************************************************************************/
ALTER PROCEDURE [dbo].[SP_SIEGE_INFO_R]
	@i_byChannel			tinyint					,	--// 
	@o_guild_code			varchar(10)		OUTPUT	,	--// 
	@o_guild_name			varchar(30)		OUTPUT	,	--// 
	@o_guild_master			varchar(40)		OUTPUT	,	--// 
	@o_dwStartTime			varbinary(4)	OUTPUT	,	--// 
	@o_dwRegistTime			varbinary(4)	OUTPUT	,	--// 
	@o_dwTaxRegistTime		varbinary(4)	OUTPUT	,	--// 
	@o_dwDungeonRegistTime	varbinary(4)	OUTPUT	,	--// 
	@o_dwRegistTimeStart	varbinary(4)	OUTPUT	,	--// 
	@o_dwRegistTimeEnd		varbinary(4)	OUTPUT	,	--// 
	@o_byRegistTimeFlag		varbinary(1)	OUTPUT	,	--// (0:no-regist, 1:regist)
	@o_guild_mark1 			varbinary(2)	OUTPUT	,	--// Guild mark
	@o_guild_mark2 			varbinary(2)	OUTPUT	,	--// Guild mark background
	@o_guild_effect			varbinary(2)	OUTPUT	,	--// Guild mark effect
	@o_billion_cnt			tinyint			OUTPUT	,	--// billion count
	@o_remain_tax			bigint			OUTPUT	,	--// Tax.
	@o_byStartTime			varbinary(1)	OUTPUT	,	--// Start time
	@o_defenderInfo			varbinary(1000)	OUTPUT	,	--// Defender info.
	@o_entryGuildInfo		varbinary(1000)	OUTPUT	,	--// Guild info.
	@o_deadFrontTimeInfo	varbinary(1000)	OUTPUT	,	--// Dead front time info.
	@o_sp_rtn				int				OUTPUT		--// return (0:ok)
AS
	DECLARE @v_tax_bindate	varbinary(4)
	DECLARE @v_seal_bindate	varbinary(4)
	DECLARE @v_rowcnt		int
BEGIN		
	SET @o_sp_rtn = 0
	--//get dead front time info.
	/*
	SET @o_DeadFrontTimeInfo	= 0x000300
	EXEC dbo.SP_DEADFRONT_GET_TIMEINFO 	@o_deadFrontTimeInfo 	OUTPUT
									,	@o_sp_rtn		 		OUTPUT
	*/
	IF LEN(@i_byChannel) < 1 OR @i_byChannel IS NULL BEGIN
		SET @o_sp_rtn = -1
		RETURN
	END
	--// dbo.Guild_Info
	SET @o_guild_code			= 'NODATA'
	SET @o_guild_name			= 'NODATA'
	SET @o_guild_master			= 'NODATA'
	SET @o_guild_mark1 			= 0x0000
	SET @o_guild_mark2 			= 0x0000
	SET @o_guild_effect			= 0x0000
	--// dbo.Siege_Info
	SET @o_dwStartTime			= 0x00000000
	SET @o_billion_cnt			= 0x0000
	SET	@o_remain_tax			= 0x00000000
	SET @o_defenderInfo			= 0x00000000
	SET @o_dwRegistTime			= 0x00000000
	SET @o_dwDungeonRegistTime 	= 0x00000000
	SET @o_dwRegistTimeStart	= 0x00000000
	SET @o_dwRegistTimeEnd		= 0x00000000
	SET @o_byRegistTimeFlag		= 0x01

	SET @o_byStartTime			= 0x00
	SET @o_entryGuildInfo		= 0x00000000
	
	SET @o_sp_rtn				= -1

	SET @v_tax_bindate			= dbo.FN_GetTaxBinTime(GetDate())
	SET @o_dwTaxRegistTime		= CAST(dbo.FN_GetRemainTimeSec(GetDate(), dbo.FN_BinDateToDateTime(@v_tax_bindate)) as varbinary(4))	
	
	SELECT	@o_guild_code 	= guild_code
		,	@o_guild_name	= guild_name
		,	@o_guild_master	= dbo.FN_GetGuildMasterName(guild_code)
		,	@o_guild_mark1	= ISNULL(CAST(guild_mark1 as varbinary(2)), 0x0000)
		,	@o_guild_mark2	= ISNULL(CAST(guild_mark2 as varbinary(2)), 0x0000)
		,	@o_guild_effect = CAST(guild_effect as varbinary(2))
	FROM	dbo.GUILD_INFO WITH(NOLOCK)
	WHERE	byState = 1
	AND		byChannel = @i_byChannel
	
	SET @v_rowcnt = @@ROWCOUNT	

	IF @v_rowcnt < 1 BEGIN
		SET @o_sp_rtn = 1
		RETURN
	END

	IF (@@ERROR <> 0) BEGIN
		SET @o_sp_rtn = -2
		RETURN
	END
	
	SELECT	@o_dwStartTime			= dwStartTime
		,	@o_dwRegistTimeStart	= CAST(dbo.FN_GetSiegeRemainTimeSec(dwStartTime, -13, '12', GetDate()) as varbinary(4))
		,	@o_dwRegistTimeEnd		= CAST(dbo.FN_GetSiegeRemainTimeSec(dwStartTime, -11, '05', GetDate()) as varbinary(4))
		,	@o_byRegistTimeFlag 	= CAST(byregisttimeflag as varbinary(1))
		,	@o_dwRegistTime			= CAST(dbo.FN_GetRemainTimeSec(GetDate(), dbo.FN_BinDateToDateTime(dwStartTime)) as varbinary(4))
		,	@o_billion_cnt			= billion_cnt
		,	@o_remain_tax			= remain_tax
		,	@o_defenderInfo			= defender_info
		,	@o_byStartTime 			= CAST(CAST(SUBSTRING(CONVERT(varchar(20), dbo.FN_BinDateToDateTime(dwStartTime), 120), 12,2) as smallint) as varbinary(1))
	FROM	dbo.SIEGE_INFO WITH(NOLOCK)
	WHERE	channel_no = @i_byChannel
	AND		siege_tag = 'Y'

	SET @v_rowcnt = @@ROWCOUNT	

	IF @v_rowcnt < 1 BEGIN
		SET @o_sp_rtn = 1
		RETURN
	END	

	IF @@ERROR <> 0 BEGIN
		SET @o_sp_rtn = -3
		RETURN
	END	

	SET	@o_dwDungeonRegistTime	= dbo.FN_GetDungeonRegistTime(@o_dwStartTime, GetDate())

	EXEC dbo.SP_SEAL_GUILD_LIST
						@i_byChannel
					,	@o_entryGuildInfo	OUTPUT
					,	@o_sp_rtn		 	OUTPUT

	IF @o_sp_rtn < 0 BEGIN
		SET @o_sp_rtn = -4
		RETURN
	END	

	SET @o_sp_rtn = 0
	RETURN
END



