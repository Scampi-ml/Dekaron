/* 
Name: Remote-Reborn 

Description 
1: Reborns a character. Duh. 

Author: Zombe and janvier123 :) 
*/ 

CREATE PROCEDURE RemoteReborn 
@character_name varchar(50) 
AS 
UPDATE dbo.user_character 
SET wLevel = 1, dwExp = 0, wStatPoint = 250 * (Reborn + 1), nHP=106, nMP=16, dwMoney = dwMoney - (50000000), wStr = 6, wDex = 3, wCon = 4, wSpr = 2, wPosX = 336, wPosY = 366, Reborn = Reborn + 1, wMapIndex = 7, wSkillPoint = 0 
WHERE (byPCClass = 0) AND (wlevel >= 170) AND (dwMoney >= (50000000)) AND (Reborn < 50) AND (character_name = @character_name); 

UPDATE dbo.user_character 
SET wLevel = 1, dwExp = 0, wStatPoint = 250 * (Reborn + 1), nHP=106, nMP=16, dwMoney = dwMoney - (50000000), wStr = 6, wDex = 3, wCon = 4, wSpr = 2, wPosX = 336, wPosY = 366, Reborn = Reborn + 1, wMapIndex = 7, wSkillPoint = 0 
WHERE (byPCClass = 1) AND (wlevel >= 170) AND (dwMoney >= (50000000)) AND (Reborn < 50) AND (character_name = @character_name); 

UPDATE dbo.user_character 
SET wLevel = 1, dwExp = 0, wStatPoint = 250 * (Reborn + 1), nHP=106, nMP=16, dwMoney = dwMoney - (50000000), wStr = 6, wDex = 3, wCon = 4, wSpr = 2, wPosX = 336, wPosY = 366, Reborn = Reborn + 1, wMapIndex = 7, wSkillPoint = 0 
WHERE (byPCClass = 2) AND (wlevel >= 170) AND (dwMoney >= (50000000)) AND (Reborn < 50) AND (character_name = @character_name); 

UPDATE dbo.user_character 
SET wLevel = 1, dwExp = 0, wStatPoint = 250 * (Reborn + 1), nHP=106, nMP=16, dwMoney = dwMoney - (50000000), wStr = 6, wDex = 3, wCon = 4, wSpr = 2, wPosX = 336, wPosY = 366, Reborn = Reborn + 1, wMapIndex = 7, wSkillPoint = 0 
WHERE (byPCClass = 3) AND (wlevel >= 170) AND (dwMoney >= (50000000)) AND (Reborn < 50) AND (character_name = @character_name); 

UPDATE dbo.user_character 
SET wLevel = 1, dwExp = 0, wStatPoint = 250 * (Reborn + 1), nHP=106, nMP=16, dwMoney = dwMoney - (50000000), wStr = 6, wDex = 3, wCon = 4, wSpr = 2, wPosX = 336, wPosY = 366, Reborn = Reborn + 1, wMapIndex = 7, wSkillPoint = 0 
WHERE (byPCClass = 4) AND (wlevel >= 170) AND (dwMoney >= (50000000)) AND (Reborn < 50) AND (character_name = @character_name); 

UPDATE dbo.user_character 
SET wLevel = 1, dwExp = 0, wStatPoint = 250 * (Reborn + 1), nHP=106, nMP=16, dwMoney = dwMoney - (50000000), wStr = 6, wDex = 3, wCon = 4, wSpr = 2, wPosX = 336, wPosY = 366, Reborn = Reborn + 1, wMapIndex = 7, wSkillPoint = 0 
WHERE (byPCClass = 5) AND (wlevel >= 170) AND (dwMoney >= (50000000)) AND (Reborn < 50) AND (character_name = @character_name); 

UPDATE dbo.user_character 
SET wLevel = 1, dwExp = 0, wStatPoint = 250 * (Reborn + 1), nHP=106, nMP=16, dwMoney = dwMoney - (50000000), wStr = 6, wDex = 3, wCon = 4, wSpr = 2, wPosX = 336, wPosY = 366, Reborn = Reborn + 1, wMapIndex = 7, wSkillPoint = 0 
WHERE (byPCClass = 6) AND (wlevel >= 170) AND (dwMoney >= (50000000)) AND (Reborn < 50) AND (character_name = @character_name); 


GO  
