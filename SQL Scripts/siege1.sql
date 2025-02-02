USE [Character]
GO

/****** Object:  UserDefinedFunction [dbo].[FN_BinDateToDateTime]    Script Date: 01/10/2010 19:35:14 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER OFF
GO




/******************************************************************************
   ?  ? : dbo.FN_BinDateToDateTime
   ?  ? : Binary Date? DateTime ???? ????.
   ??? : 
   ????:
   Ver        Date        Author           Description
   ---------  ----------  ---------------  ------------------------------------
   1.0        2006-05-05  Han Ji Wook      1. ????
   2.0        2010-01-10  ADM-Cyrax/Darth Nerd
 ******************************************************************************/
ALTER  FUNCTION [dbo].[FN_BinDateToDateTime] (
	@i_bin_time	binary(4)
) RETURNS datetime
AS
BEGIN
	DECLARE @v_datetime	datetime
	DECLARE @v_strAux varchar(20)
	DECLARE @v_strtime	varchar(20)
	SET @v_strAux = CAST(CAST(@i_bin_time as int) as varchar(20))
	IF len(@v_strAux) = 7	
		SELECT	@v_strtime	= '20100' + CAST(CAST(@i_bin_time as int) as varchar(20))
	ELSE
		IF len(@v_strAux) = 8 
			SELECT	@v_strtime	= '2010' + CAST(CAST(@i_bin_time as int) as varchar(20))
		ELSE
				SELECT	@v_strtime	= '201' + CAST(CAST(@i_bin_time as int) as varchar(20))

	
	SELECT	@v_strtime	= SUBSTRING(@v_strtime,1,4)
						+'-'+SUBSTRING(@v_strtime,5,2)
						+'-'+SUBSTRING(@v_strtime,7,2)
						+' '+SUBSTRING(@v_strtime,9,2)
						+':'+SUBSTRING(@v_strtime,11,2)	
	SELECT	@v_datetime = CAST(@v_strtime as datetime)
	RETURN @v_datetime
END