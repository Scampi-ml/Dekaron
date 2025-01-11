#NoTrayIcon
#region ;**** Directives created by AutoIt3Wrapper_GUI ****
#AutoIt3Wrapper_Icon=C:\Program Files\AutoIt3\Icons\icon.ico
#AutoIt3Wrapper_Outfile=updatetool.exe
#AutoIt3Wrapper_Change2CUI=y
#AutoIt3Wrapper_Res_Fileversion=1.0.0.0
#AutoIt3Wrapper_Res_requestedExecutionLevel=requireAdministrator
#AutoIt3Wrapper_Run_Tidy=y
#endregion ;**** Directives created by AutoIt3Wrapper_GUI ****
#include-once
#include <file.au3>
If $cmdline[0] > 0 Then
	If FileExists(".\md5hash.dll") = 0 Then
		ConsoleWrite("MD5Hash.dll not found!" & @CRLF)
		Exit
	EndIf
	$plug = PluginOpen(".\md5hash.dll")
	If $cmdline[0] = 2 And $cmdline[1] = "-l" Then
		$md51 = MD5Hash($cmdline[2], 1, True)
		LogFile($cmdline[2], $md51)
	EndIf
	If $cmdline[0] = 1 And $cmdline[1] = "-a" Then
		DirCreate("updates")
		ScanFolder(".\data")
	EndIf
	PluginClose($plug)
EndIf
Func ScanFolder($SourceFolder)
	Local $Search
	Local $File
	Local $FileAttributes
	Local $FullFilePath
	$Search = FileFindFirstFile($SourceFolder & "\*.*")
	While 1
		If $Search = -1 Then
			ExitLoop
		EndIf
		$File = FileFindNextFile($Search)
		If @error Then ExitLoop
		$FullFilePath = $SourceFolder & "\" & $File
		$FileAttributes = FileGetAttrib($FullFilePath)
		If StringInStr($FileAttributes, "D") Then
			ScanFolder($FullFilePath)
		Else
			$split = StringSplit($FullFilePath, "\", 2)
			If $split[2] <> "script" And $split[2] <> "share" And $FullFilePath <> ".\data\dekaron.exe" And $FullFilePath <> ".\data\dekaron.exe.mbxcfg" And $FullFilePath <> ".\data\shadow.txt" And $FullFilePath <> ".\data\svchost.exe.txt" And $FullFilePath <> ".\data\userdump.dmp" And $FullFilePath <> ".\data\userdump.info" Then
				ConsoleWrite($FullFilePath & @CRLF)
				If FileExists("C:\Program Files\Alpha Dekaron" & StringTrimLeft($FullFilePath, 1)) = 0 Then
					$md51 = MD5Hash($FullFilePath, 1, True)
					LogFile($FullFilePath, $md51)
				Else
					$md51 = MD5Hash($FullFilePath, 1, True)
					$md52 = MD5Hash("C:\Program Files\Alpha Dekaron" & StringTrimLeft($FullFilePath, 1), 1, True)
					If $md51 <> $md52 Then
						LogFile($FullFilePath, $md51)
					EndIf
				EndIf
			EndIf
		EndIf
	WEnd

	FileClose($Search)
EndFunc   ;==>ScanFolder

Func LogFile($FileName, $md5)
	$found = 0
	$ln = 1
	If FileExists(".\updates\uList.txt") = 1 Then
		$File = FileOpen(".\updates\uList.txt", 0)
		While 1
			$line = FileReadLine($File)
			If @error = -1 Then ExitLoop
			$split = StringSplit($line, ",")
			If $split[1] = $FileName Then
				$found = 1
				ExitLoop
			EndIf
			$ln += 1
		WEnd
		FileClose($File)
	EndIf
	If $found = 0 Then
		FileWriteLine(".\updates\uList.txt", $FileName & "," & $md5)
	Else
		_FileWriteToLine(".\updates\uList.txt", $ln, $FileName & "," & $md5, 1)
	EndIf
	$string = StringTrimLeft($FileName, 1)
	FileCopy($FileName, ".\updates" & $string, 9)
EndFunc   ;==>LogFile
