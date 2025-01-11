
-------------------- GUILD RANKING --------------------
The Guild Ranking dont list all Guilds with Guild Level 99.
Go to your Query Analyser and Run this Query :

UPDATE character.dbo.GUILD_INFO SET guild_Level = '99'

ATTENTION : If the Database not new , than search an other way to set the guild_Level to 99


-------------------- REGISTER PAGE --------------------
To correct work of the Register script use the account.bak or edit the Table's Tbl_user and USER_PROFILE :

Go to Enterprise Manager --> Databases --> account --> Tables and make a right mouse click to Tbl_user and go to Design Table.

Change the Data Type of user_no to int than right click to user_no and press "Set Primary Key" , Save Table now.

Now make a right mouse click to USER_PROFILE and go again to Design Table.

Change the Date Type of user_no to int and set the "Set Primary Key" too. Save it and Ready.



-------------------- RANKING PAGE --------------------
To not see all Characters , open your Query Analyser and run this query :

UPDATE character.dbo.user_character SET user_no = '9999999999'

ATTENTION : If the Database not new , than search an other way to set the user_no to 9999999999






Script Pack written by Nicky @ AngelZ-World.com