#NoTrayIcon
#RequireAdmin
#Region ;**** Directives created by AutoIt3Wrapper_GUI ****
#AutoIt3Wrapper_Icon=C:\Program Files\AutoIt3\Icons\icon.ico
#AutoIt3Wrapper_Outfile=Alpha Autopatch.exe
#AutoIt3Wrapper_Compression=4
#AutoIt3Wrapper_Res_Comment=alphaclient
#AutoIt3Wrapper_Res_Description=alphaclient
#AutoIt3Wrapper_Res_Fileversion=2.0.0.0
#AutoIt3Wrapper_Tidy_Stop_OnError=n
#EndRegion ;**** Directives created by AutoIt3Wrapper_GUI ****
#include <ButtonConstants.au3>
#include <GUIConstantsEx.au3>
#include <ProgressConstants.au3>
#include <StaticConstants.au3>
#include <WindowsConstants.au3>
#include <IE.au3>
#include <String.au3>
#include <WinAPI.au3>
#Include <Misc.au3>
#region ### START Koda GUI section ### Form=

;Check if required files are in the directory
If FileExists(".\md5hash.dll") = 0 Then
	MsgBox(0, "File not found!", "MD5Hash.dll not found!")
	Exit
EndIf
If FileExists(".\patchsettings.ini") = 0 Then
	MsgBox(0, "File not found!", "patchsettings not found!")
	Exit
EndIf

;Initialize program
readsettings()
clientTCP()
selfModify()
$Form1 = GUICreate("Alpha Autopatch " & $pversion, 305, 375, 192, 114)
GUISetFont(8, 400, 0, "Arial")
$Label1 = GUICtrlCreateLabel("Checking for updates...", 0, 320, 304, 17, $SS_CENTER, $WS_EX_STATICEDGE)
$Button1 = GUICtrlCreateButton("Play", 112, 344, 75, 25, 0, $WS_EX_CLIENTEDGE)
GUICtrlSetState($Button1, $GUI_DISABLE)
$Label2 = GUICtrlCreateLabel("Version:", 0, 296, 304, 17, $SS_CENTER, $WS_EX_STATICEDGE)
$oIE = _IECreateEmbedded()
$Obj1_ctrl = GUICtrlCreateObj($oIE, 0, 0, 304, 292)
GUISetState(@SW_SHOW)
#endregion ### END Koda GUI section ###

;Navigate the patcher page to the correct location
_IENavigate($oIE, $notice, 0)

;Check for any available updates
checkUpdates()

#cs
Function to preform the self-modify

Algorithm:
check if the current running binary is not named named "patched.temp"
	-check if client version is equal to patch version
		-wait for "patch.temp" to exit
		-delete "patch.temp"
	-check if client version is less than the server patch version
		-Download new patcher as "patch.temp"
		-execute "patch.temp"
	-check if the client version is greater than server version
		-Throw error
		-Exit
else
	-wait for autopatcher to clsoe
	-delete autopatcher
	-copy Self as autopatcher
	-run autopatcher
	-exit
#ce
Func selfModify()
	If @AutoItExe <> @ScriptDir & "\patch.temp" Then ;		Select
			Case $pVersion = $sVersionP
				ProcessWaitClose("patch.temp")
				FileDelete("patch.temp")
			Case $sVersionP > $pVersion
				ProgressOn("Patcher update", "Alpha patcher updating...")
				Local $pget = InetGet($basepath & "patch.temp", "patch.temp", 1, 1)
				$psize = InetGetSize($basepath & "patch.temp", 1)
				Do
					$nMsg = GUIGetMsg()
					Switch $nMsg
						Case $GUI_EVENT_CLOSE
							Exit
					EndSwitch
					ProgressSet(Round((InetGetInfo($pget, 0) / $psize) * 100, 0), Round((InetGetInfo($pget, 0) / $psize) * 100, 0) & "%")
					Sleep(20)
				Until InetGetInfo($pget, 2)
				InetClose($pget)
				ProgressOff()
				Run("patch.temp")
				Exit
			Case $pVersion > $sVersionP
				MsgBox(0, "Error", "Client patcher version is newer than server!")
				Exit
		EndSelect
	Else
		ProcessWaitClose("Alpha Autopatch.exe")
		FileDelete("Alpha Autopatch.exe") 
		FileCopy(@AutoItExe, "Alpha Autopatch.exe", 9) ;Copy self as new patcher
		Run("Alpha Autopatch.exe")
		Exit
	EndIf
EndFunc   ;==>selfModify

#cs
Function to load the game and preform loader functions

Arguments:
	$process	The process to execute
	$address	The address to start writing data at
	$data		The data to write in hexidecimal form
	$type		The type of data to write. Refer to AutoIt help for DLL struct datatype usage
#ce
Func loader($process, $address=0, $data=0, $type="byte[1]")
	$tProcess = DllStructCreate($tagPROCESS_INFORMATION)
	$tStartup = DllStructCreate($tagSTARTUPINFO)
	If _WinAPI_CreateProcess($process, 0, 0, 0, False, 0x04, 0, 0, DllStructGetPtr($tStartup), DllStructGetPtr($tProcess)) Then
		if $address<>0 and $data<>0 then
			$pid = DllStructGetData($tProcess, "ProcessId")
			$open = _WinAPI_OpenProcess(0x20, False, $pid)
			$buffer = DllStructCreate($type)
			DllStructSetData($buffer, 1, $data)
			$addr = DllStructCreate("INT_PTR")
			DllStructSetData($addr, 1, $address)
			$write = _WinAPI_WriteProcessMemory(DllStructGetData($tProcess, "hProcess"), DllStructGetData($addr, 1), DllStructGetPtr($buffer), DllStructGetSize($buffer), 2)
			_WinAPI_CloseHandle($open)
		endif
		DllCall("ntdll.dll", "int", "NtResumeProcess", "int", DllStructGetData($tProcess, "hProcess"))
	EndIf
EndFunc   ;==>loader

;Function to read ini settings
Func readsettings()
	Global $pversion = number(FileGetVersion(@AutoItExe, "FileVersion"))
	Global $basepath = IniRead("patchsettings.ini", "settings", "basepath", "")
	Global $cVersionG = IniRead("patchsettings.ini", "version", "client", "")
	Global $cPort = IniRead("patchsettings.ini", "settings", "port", "")
	If $cPort = "" Then
		$cPort = "999"
	EndIf
	Global $uFile
EndFunc   ;==>readsettings

#cs
Function to check for updates

Algorithm:
check if the client version is equal to the server version
	-enable play button
else
	-download uList.txt from the server
	-run extractUpdate()
#ce
Func checkUpdates()
	GUICtrlSetData($Label2, "Version: " & $cVersionG)
	Select
		Case $sVersionG = $cVersionG
			GUICtrlSetData($Label1, "Update complete! Press Play!")
			FileDelete(".\updates.txt")
			GUICtrlSetState($Button1, $GUI_ENABLE)
		Case Else
			GUICtrlSetData($Label1, "Downloading update list...")
			FileDelete(".\updates.txt")
			$size = InetGetSize($basepath & "uList.txt")
			$uGet = InetGet($basepath & "uList.txt", "updates.txt", 1, 1)
			Do
				$nMsg = GUIGetMsg()
				Switch $nMsg
					Case $GUI_EVENT_CLOSE
						Exit
				EndSwitch
			Until InetGetInfo($uGet, 2)
			extractUpdate()
	EndSelect
EndFunc   ;==>checkUpdates


;Function to extract updates
Func extractUpdate()
	GUICtrlSetData($Label1, "Downloading and Installing updates...")
	$updateF = FileOpen(".\updates.txt", 0)
	$plugin = PluginOpen(".\md5hash.dll")
	While 1
		$nMsg = GUIGetMsg()
		Switch $nMsg
			Case $GUI_EVENT_CLOSE
				Exit
		EndSwitch
		$lineF = FileReadLine($updateF)

		If $lineF = "" Then ExitLoop
		$splitF = StringSplit($lineF, ",")
		If FileExists($splitF[1]) Then
			$FileMD5 = MD5Hash($splitF[1], 1, True)
			If $FileMD5 <> $splitF[2] Then
				$trimmed = StringTrimLeft($splitF[1], 2)
				$trimmed = StringReplace($trimmed, "\", "/")
				GUICtrlSetData($Label1, "Downloading " & $splitF[1])
				FileDelete("temp")
				Local $iFile = InetGet($basepath & $trimmed, "temp", 1, 1)
				$iSize = InetGetSize($basepath & $trimmed, 1)
				Do
					$nMsg = GUIGetMsg()
					If $nMsg = $GUI_EVENT_CLOSE Then
						Exit
					EndIf
					GUICtrlSetData($Label1, "Downloading " & $splitF[1] & " " & Round((InetGetInfo($iFile, 0) / $iSize) * 100, 0) & "%")
					Sleep(20)
				Until InetGetInfo($iFile, 2)
				InetClose($iFile)
				GUICtrlSetData($Label1, "Installing " & $splitF[1])
				FileCopy("temp", $splitF[1], 9)
				FileDelete("temp")
			EndIf
		Else
			$trimmed = StringTrimLeft($splitF[1], 2)
			$trimmed = StringReplace($trimmed, "\", "/")
			FileDelete("temp")
			GUICtrlSetData($Label1, "Downloading " & $splitF[1])
			Local $iFile = InetGet($basepath & $trimmed, "temp", 1, 1)
			$iSize = InetGetSize($basepath & $trimmed, 1)
			Do
				$nMsg = GUIGetMsg()
				If $nMsg = $GUI_EVENT_CLOSE Then
					Exit
				EndIf
				GUICtrlSetData($Label1, "Downloading " & $splitF[1] & " " & Round((InetGetInfo($iFile, 0) / $iSize) * 100, 0) & "%")
				Sleep(20)
			Until InetGetInfo($iFile, 2)
			InetClose($iFile)
			GUICtrlSetData($Label1, "Installing " & $splitF[1])
			FileCopy("temp", $splitF[1], 9)
			FileDelete("temp")
		EndIf
	WEnd
	PluginClose($plugin)
	FileClose($updateF)
	IniWrite("patchsettings.ini", "version", "client", $sVersionG)
	$cVersionG = $sVersionG
	checkUpdates()
EndFunc   ;==>extractUpdate

;Function to connect to the server and receive update information
Func clientTCP()
	tcpstartup()
	$IP = StringReplace($basepath, "http://", "")
	$IP = StringSplit($IP, "/")
	$IP[1] = TCPNameToIP($IP[1])
	Global $done = 0
	Global $client = -1
	$client = TCPConnect($IP[1], $cPort)
	if $client = -1 Then
		tcpclosesocket($client)
		tcpshutdown()
		MsgBox(0, "Offline", "Update server appears to be offline. Please try again later.")
		Exit
	endif
	tcpsend($client, "Req")
	$recv = tcprecv($client, 2048)
	while($recv="" or $client=-1)
		$recv = tcprecv($client, 2048)
	wend
	$info = StringSplit($recv, ",")
	If $info[0] = 4 Then
		$basepath = $info[1]
		Global $sVersionG = $info[2]
		Global $sVersionP = $info[3]
		global $notice = $info[4]
		$done = 1
	Else
		MsgBox(0, "Error", "Unable to connect to update server. Please try again.")
		tcpclosesocket($client)
		tcpshutdown()
		Exit
	EndIf
			tcpclosesocket($client)
		tcpshutdown()
EndFunc   ;==>clientTCP

While 1
	$nMsg = GUIGetMsg()
	Switch $nMsg
		Case $GUI_EVENT_CLOSE
			Exit
		Case $Button1
			;Loader example
			;loader(".\data\bin\dekaron.exe", 0xB8BBD8, 0x60, "byte[1]")
			Exit
	EndSwitch
WEnd
