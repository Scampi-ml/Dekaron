if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SP_ACC_MAIL]') and OBJECTPROPERTY(id, N'IsProcedure') = 1)
drop procedure [dbo].[SP_ACC_MAIL]
GO

SET QUOTED_IDENTIFIER ON 
GO
SET ANSI_NULLS ON 
GO

CREATE PROCEDURE dbo.SP_ACC_MAIL
@i_user_no varchar(50), 
@i_service_no varchar(50)
AS
DECLARE @v_email	varchar(40)
BEGIN  

	SET @v_email = 0


		SELECT 	@v_email = email
		FROM 	account.dbo.USER_DATA WITH(NOLOCK)
		WHERE 	user_no = @i_user_no



  INSERT INTO game.dbo.email_queue_dshop
        (
            user_no,
            template,
            email,
            dshop_id,
            is_send
        )
        values
        (
            
            @i_service_no,
            'dshop',
         @v_email,
            @i_user_no,
            0
        )
	
  
       
END

GO
SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS ON 
GO

