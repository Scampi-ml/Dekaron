USE [account];
GO

ALTER TABLE [dbo].[Tbl_user] ADD [loggedin] [smallint] DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [lastlogin] [varchar] (50) DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [birthday] [varchar] (50) DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [banned] [smallint] DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [gm] [smallint] DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [ip] [varchar] (50) DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [style] [smallint] DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [webadmin] [smallint] DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [sitelogged] [smallint] DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [sex] [varchar] (50) DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [name] [varchar] (50) DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [lastname] [varchar] (50) DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [country] [varchar] (50) DEFAULT (0) NOT NULL;
ALTER TABLE [dbo].[Tbl_user] ADD [secretnr] [varchar] (50) DEFAULT (0) NOT NULL;
