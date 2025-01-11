unit Unit1;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, IdBaseComponent, IdComponent, IdTCPConnection,
  IdTCPClient, IdHTTP, INIFiles, ExtActns, ComCtrls, ExtCtrls, ShellAPI,
  IdAntiFreezeBase, IdAntiFreeze, ScktComp, OverbyteIcsMD5, jpeg, sLabel,
  Menus;

type
  TForm1 = class(TForm)
    IdHTTP1: TIdHTTP;
    ProgressBar1: TProgressBar;
    Image1: TImage;
    Memo1: TMemo;
    Button1: TButton;
    Button2: TButton;
    Button3: TButton;
    Button4: TButton;
    IdAntiFreeze1: TIdAntiFreeze;
    Socket: TClientSocket;
    Timer1: TTimer;
    Button5: TButton;
    sLabel1: TsLabel;
    procedure FormCreate(Sender: TObject);
    procedure Button4Click(Sender: TObject);
    procedure Button2Click(Sender: TObject);
    procedure Button3Click(Sender: TObject);
    procedure Timer1Timer(Sender: TObject);
    procedure Button5Click(Sender: TObject);
    procedure Button1Click(Sender: TObject);
  private
    { Private declarations }
  public
    procedure URL_OnDownloadProgress(Sender: TDownLoadURL; Progress, ProgressMax: Cardinal; StatusCode: TURLDownloadStatus; StatusText: String; var Cancel: Boolean);
    function DoDownload(const strWhichURL,strLocalFile:string): boolean;
    function DoReadINI(const strFile,strWhichSection,strString:string): string;
    procedure DoWriteINI(const strFileWRI,strWhichSectionWRI, strNameWRI, strStringWRI:string);
    procedure CompareStrings(const string1, string2, filename: string);
    procedure CheckMD5();
  end;

var
  Form1: TForm1;

implementation

uses Unit2;

{$R *.dfm}

procedure TForm1.URL_OnDownloadProgress;

begin

  ProgressBar1.Max:= ProgressMax;

  ProgressBar1.Position:= Progress;

end;
function TForm1.DoReadINI(const strFile,strWhichSection,strString:string): string;
 var
    ReadINI : TINIFile;
begin
try
    ReadINI := TINIFile.Create(strFile);
    result := ReadINI.ReadString(strWhichSection, strString, 'Default');
    finally
    ReadINI.Free;
end;
end;

procedure TForm1.DoWriteINI(const strFileWRI,strWhichSectionWRI,strNameWRI,strStringWRI:string);
 var
    WriteINI : TINIFile;
begin
try
    WriteINI := TINIFile.Create(strFileWRI);
    WriteINI.WriteString(strWhichSectionWRI, strNameWRI, strStringWRI);
    finally
    WriteINI.Free;
end;
end;

function TForm1.DoDownload(const strWhichURL,strLocalFile:string): boolean;

begin
    Result:=True;
  with TDownloadURL.Create(nil) do

  try

    URL := strWhichURL;

    FileName := strLocalFile;

    OnDownloadProgress := URL_OnDownloadProgress;
     try
     Application.ProcessMessages;
    ExecuteTarget(nil);
    except
    ShowMessage('Can not Download ' + strWhichURL);
    Result:=False
    end;


    finally

    Free;
    ProgressBar1.Position := 0;

  end;

end;

procedure TForm1.CompareStrings(const string1, string2, filename: string);
  var result : Integer;
  FiledownloadInet, FileDownloadName : string;

begin
  result := AnsiCompareStr(string1, string2);

  if result < 0 then
  begin

  //Different
  Button1.Enabled := false;
  //showmessage('Start Download');
  FileDownloadName :=  filename;
  Delete(FileDownloadName, 1,1);
  FiledownloadInet := DoReadINI('./updater.ini','Settings','UpdateHost')  + FileDownloadName;

  Application.ProcessMessages;

  DoDownload(FiledownloadInet,filename);
  //showmessage('DIFF String1:' + string1 + ' String2: ' + string2 + ' Filename: ' + filename);
  Button1.Enabled := true;

  end;
  if result = 0 then
  begin
  //Same
  { do nothing }
  //showmessage('==SAME ServMD5 ' + string1 + ' LocalMD5 ' + string2 + ' FileName ' + filename);

  end;
  if result > 0 then
  begin
  Button1.Enabled := false;
  //showmessage('Start Download');
  FileDownloadName :=  filename;
  Delete(FileDownloadName, 1,1);
  FiledownloadInet := DoReadINI('./updater.ini','Settings','UpdateHost')  + FileDownloadName;

  Application.ProcessMessages;

  DoDownload(FiledownloadInet,filename);
   //showmessage('String1:' + string1 + ' String2: ' + string2 + ' Filename: ' + filename);
  Button1.Enabled := true;
  //Error
  //showmessage('==ERROR ServMD5 ' + string1 + ' LocalMD5 ' + string2 + ' FileName ' + filename);
  //ShowMessage('Error In Version');
  end;
end;

procedure TForm1.CheckMD5();
var
  SomeTxtFile : TextFile;
  buffer, md5filename, md5var, SrvMD5 : string;
  Line : TStringList;
begin
  AssignFile(SomeTxtFile, './file.list') ;
  Reset(SomeTxtFile) ;
  while not EOF(SomeTxtFile) do
  begin
   ReadLn(SomeTxtFile, buffer) ;
   Line := TStringList.Create;
   Line.CommaText := buffer;
   SrvMD5 := AnsiUpperCase(Line[1]);
   md5filename := Line[0];
   md5var := FileMD5(md5filename);

   Application.ProcessMessages;

  CompareStrings(md5var, SrvMD5, Line[0]);
  //showmessage('ServMD5 ' + SrvMD5 + ' LocalMD5 ' + md5var + ' FileName ' + Line[0]);
	Screen.Cursor := crDefault;
  end;
  CloseFile(SomeTxtFile) ;
end;

procedure TForm1.FormCreate(Sender: TObject);
var
UpdaterTitle: string;
begin
//Center Form
Left:=(Screen.Width-Width)  div 2;
Top:=(Screen.Height-Height) div 2;
//Change Title
UpdaterTitle := DoReadINI('./updater.ini','Settings','UpdaterTitle');
sLabel1.caption := UpdaterTitle;

end;


procedure TForm1.Button4Click(Sender: TObject);
begin
Close;
end;

procedure TForm1.Button2Click(Sender: TObject);
begin
 ShellExecute(Form1.Handle, 'open', 'engine.exe', '/setup', nil, SW_SHOWNORMAL);
end;

procedure TForm1.Button3Click(Sender: TObject);
var
    SiteButtonURL: string;
begin
SiteButtonURL := DoReadINI('./updater.ini','Settings','WebsiteButtonURL');
ShellExecute(Form1.Handle, 'open', PChar(SiteButtonURL), nil, nil, SW_SHOWNORMAL);

end;

procedure TForm1.Timer1Timer(Sender: TObject);
var
NoticeLocalFile, NoticeInetFile, UpdateFileLocal, UpdateFileInet: string;
begin
Timer1.enabled:=false;

//Notice File

NoticeLocalFile := DoReadINI('./updater.ini','Settings','NoticeFile');
NoticeInetFile := DoReadINI('./updater.ini','Settings','UpdateHost') + '/' + DoReadINI('./updater.ini','Settings','NoticeFile');
DoDownload(NoticeInetFile,NoticeLocalFile);
if FileExists(NoticeLocalFile) then
   Memo1.Lines.LoadFromFile(NoticeLocalFile)
else
  ShowMessage('Can not Display Notice File');

  //Download Update List
UpdateFileLocal := DoReadINI('./updater.ini','Settings','UpdateFile');
UpdateFileInet := DoReadINI('./updater.ini','Settings','UpdateHost') + '/' + DoReadINI('./updater.ini','Settings','UpdateFile');

DoDownload(UpdateFileInet,UpdateFileLocal);
  CheckMD5();
end;

procedure TForm1.Button5Click(Sender: TObject);
begin
form1.visible := false;
form2.visible := true;
end;

procedure TForm1.Button1Click(Sender: TObject);
begin
ShellExecute(Form1.Handle, 'open', 'engine.exe', '/load /config debug', nil, SW_SHOWNORMAL);
close;
end;

end.
