@echo off
cls
echo #####################################################
echo #                 Dekaron Kill Tool                 # 
echo #                 !!  WARNING  !!                   #
echo #    This tool will forcefully close all dekaron    #
echo #                  server proceses!                 #
echo #  If you do not wish to do so, close this window!  #
echo #####################################################
pause
cls
echo 1.1 - Closing dbmon;
taskkill /f /im dbmon.exe
echo 1.2 - dbmon successfully closed;
echo 2.1 - Closing Cast Server;
taskkill /f /im CastServer[1.26.0].exe
echo 2.2 - Cast Server successfully closed;
echo 3.1 - Closing Dekaron Server;
taskkill /f /im DekaronServer.exe
echo 3.2 - Dekaron Server successfully closed;
echo 4.1 - Closing Login Server;
taskkill /f /im LoginServer.exe
echo 4.2 - Login Server successfully closed;
echo 5.1 - Closing Msg Server;
taskkill /f /im MsgServer[1.3.0].exe
echo 5.2 - Msg Server successfully closed;
echo 6.1 - Closing Session Server;
taskkill /f /im SessionServer[1.22.0].exe
echo 6.2 - Session Server successfully closed;
echo 7.1 - Closing WebMan;
taskkill /f /im WebMan.exe
echo 7.2 - WebMan Successfully Closed.
echo ##########################
echo #   Made by Janvier123   #
echo ##########################
pause