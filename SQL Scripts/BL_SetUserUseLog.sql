if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[BL_SetUserUseLog]') and OBJECTPROPERTY(id, N'IsProcedure') = 1)
drop procedure [dbo].[BL_SetUserUseLog]
GO

SET QUOTED_IDENTIFIER ON 
GO
SET ANSI_NULLS ON 
GO


/****** Object:  Stored Procedure dbo.BL_SetUserUseLog    Script Date: 2006-5-25 13:03:40 ******/

CREATE PROCEDURE  dbo.BL_SetUserUseLog
	@i_user_no		varchar(20)				,	--// 会员连续号码
	@i_group_id		varchar(2)				,	--// 服务器01
	@i_service_no		char(3)					,	--// 服务code (001)
	@i_item_sn		BINARY(16)				,	--// 道具连续号码(dwSerialNumber)
	@i_item_index		INT					,	--// 道具索引(wIndex)  
	@i_product		varchar(50)				,	--// 商品(道具名)
	@i_product_amt		int					,	--// 商品购买价格
	@i_bill_gds_cd		varchar(10)				,	--// 收费制code
	@i_period		INT					,	--// 道具有效时间
	--//@i_bill_pwd		varchar(20)				,	--// 裁决密码
	@i_character_name	varchar(40)				,	--// 人物名
	@i_ip_addr		varbinary(4)				,	--// 人物连接IP
	@i_charge_amt		int					,
	@i_free_amt		int					,
	@o_result		int		output
AS
	BEGIN
		DECLARE @tab_id_code 	varchar(20)
		DECLARE @error_msg		varchar(200)
		DECLARE @retry_times		int
		DECLARE @email		varchar(500)
		DECLARE @email_tag		int

		SET @retry_times = 0

		BEGIN TRANSACTION
			WHILE @retry_times < 5
			BEGIN
				EXEC dbo.BL_CreateIdCode  @tab_id_code output
				IF EXISTS( select * from user_use_log where id = @tab_id_code )
					SET @retry_times =  @retry_times + 1
				ELSE
					SET @retry_times = 10
			END

			IF  @retry_times = 5
				BEGIN
					ROLLBACK TRANSACTION
					SET @error_msg	=  '超过最大重试次数，用户 ' +@i_user_no + '，服务器组' + @i_group_id
					EXEC dbo.BL_SetErrorLog 'BL_SetUserUseLog', @error_msg, @o_result output
					SET @o_result = -2					--//	超过最大重试次数
					RETURN
				END	
			--//
			insert into user_use_log (
						id,
						user_no,
						group_id,
						service_no,
						character_name,
						ip_address,
						bill_gds_cd,
						item_sn,
						item_index,
						product,
						product_amt,
						period,
						charge_amt,
						free_amt,
						intime
						)
						values
						(
						@tab_id_code,
						@i_user_no,
						@i_group_id,
						@i_service_no,
						@i_character_name,
						 dbo.FN_IpBinToStr(@i_ip_addr),
						@i_bill_gds_cd,	
						@i_item_sn,	
						@i_item_index,
						@i_product,	
						@i_product_amt,
						@i_period,
						@i_charge_amt,
						@i_free_amt,
						GetDate()
						)
			IF @@ERROR <> 0
				BEGIN
					ROLLBACK TRANSACTION
					SET @error_msg	=  'USER_USE_LOG创建日志失败，用户 ' +@i_user_no + '，服务器组' + @i_group_id
					EXEC dbo.BL_SetErrorLog 'BL_SetUserUseLog', @error_msg, @o_result output
					SET @o_result = -1					--//	-1 USER_USE_LOG创建日志失败
					RETURN
				END	
			SET @o_result 	= 0
		COMMIT TRANSACTION	
		

		SET @email = (SELECT email FROM account.dbo.user_data WHERE user_no = @i_user_no)		
			
		IF @email != ''
		BEGIN
			INSERT INTO game.dbo.email_queue_dshop
			(
			            user_no,
			            email,
			            dshop_id,
			            is_send
			)
			values
			(
				@i_user_no,
				@email,
				@tab_id_code,
				0
			)
		END
		
	
	END
GO
SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS ON 
GO

