USE [Character];
GO

DECLARE @v_siege_no char(10)
DECLARE @guild_code varchar(10)
DECLARE @guild_name varchar(30)
DECLARE @v_strDate varchar(10)
DECLARE @v_regdate varchar(10)
DECLARE @v_strChannel varchar(2)
DECLARE @i_bychannel tinyint
DECLARE @o_dwDungeonRegistTime varbinary(4)
DECLARE @o_DeadFrontTimeInfo varbinary(1000)
DECLARE @o_sp_rtn int
DECLARE @o_dwRegistTimeStart varbinary(4)
DECLARE @o_dwRegistTimeEnd varbinary(4)
DECLARE @o_dwTaxRegistTime varbinary(4)
DECLARE @o_dwStartTime varbinary(4)
DECLARE @o_dwRegistTime varbinary(4)
DECLARE @v_strDate1 varchar(10)
DECLARE @i_GetDate datetime
DECLARE @v_siege_start_date varchar(14)
DECLARE @v_siege_start_time varbinary(4)

SET @i_GetDate=getdate()

-- Siege War Every Saturday:

SELECT @v_siege_start_date = CONVERT(VARCHAR(10), DATEADD(d, 7-DATEPART(dw, @i_GetDate), @i_GetDate), 112) + '210000'

--

SELECT @v_siege_start_time = SUBSTRING(@v_siege_start_date,4,1) * 100000000
+ SUBSTRING(@v_siege_start_date,5,2) * 1000000
+ SUBSTRING(@v_siege_start_date,7,2) * 10000
+ SUBSTRING(@v_siege_start_date,9,2) * 100
+ SUBSTRING(@v_siege_start_date,11,2)

SET @guild_code = '001'
SET @guild_name = 'FIRSTGUILD'
SET @v_siege_no = SUBSTRING(dbo.FN_DateToShortStrDate(GetDate()), 3, 4) + '0001'
/*
INSERT
INTO GUILD_INFO(guild_code, guild_name, guild_Level, bystate, bychannel)
VALUES (@guild_code, @guild_name, 3, 1, 1)
INSERT
INTO SIEGE_INFO(SIEGE_NO, CHANNEL_NO, GUILD_CODE, GUILD_NAME, DWSTARTTIME, BYREGISTTIMEFLAG, DEFENDER_INFO, SIEGE_TAG)
VALUES (@v_siege_no, 1, @guild_code, @guild_name,@v_siege_start_time, 1, 0X0000, 'Y')
*/

EXEC SP_SIEGE_START_TIME_U @guild_code,1,0x01,@v_siege_start_time output,@o_dwRegistTime output,@o_sp_rtn output

SET @v_strDate1=dbo.FN_BinDateToDateTime(@v_siege_start_time)

DECLARE @P1 varchar(13)
SET @P1=NULL
DECLARE @P2 varchar(33)
SET @P2=NULL
DECLARE @P3 varchar(25)
SET @P3=NULL
DECLARE @P4 varbinary(4)
SET @P4=NULL
DECLARE @P5 varbinary(4)
SET @P5=NULL
DECLARE @P6 varbinary(4)
SET @P6=NULL
DECLARE @P7 varbinary(4)
SET @P7=NULL
DECLARE @P8 varbinary(4)
SET @P8=NULL
DECLARE @P9 varbinary(4)
SET @P9=NULL
DECLARE @P10 varbinary(4)
SET @P10=NULL
DECLARE @P11 varbinary(2)
SET @P11=NULL
DECLARE @P12 varbinary(2)
SET @P12=NULL
DECLARE @P13 varbinary(2)
SET @P13=NULL
DECLARE @P14 int
SET @P14=NULL
DECLARE @P15 int
SET @P15=NULL
DECLARE @P16 varbinary(4)
SET @P16=NULL
DECLARE @P17 varbinary(996)
SET @P17=NULL
DECLARE @P18 varbinary(996)
SET @P18=NULL
DECLARE @P19 varbinary(1000)
SET @P19=NULL
DECLARE @P20 int
SET @P20=NULL
EXEC SP_SIEGE_INFO_R 1, @P1 output, @P2 output, @P3 output, @P4 output, @P5 output, @P6 output, @P7 output, @P8 output, @P9 output, @P10 output, @P11 output, @P12 output, @P13 output, @P14 output, @P15 output, @P16 output, @P17 output, @P18 output, @P19 output
SELECT @P1, @P2, @P3, @P4, @P5, @P6,@v_strDate1