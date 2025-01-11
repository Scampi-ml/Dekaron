USE [account]
GO

/****** Object:  Table [dbo].[Tbl_user]    Script Date: 28/08/2014 10:19:43 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Tbl_user](
	[user_no] [varchar](16) NOT NULL,
	[user_id] [varchar](16) NULL,
	[user_pwd] [varchar](16) NULL,
	[user_mail] [varchar](50) NULL,
	[user_answer] [varchar](22) NULL,
	[user_question] [varchar](22) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


