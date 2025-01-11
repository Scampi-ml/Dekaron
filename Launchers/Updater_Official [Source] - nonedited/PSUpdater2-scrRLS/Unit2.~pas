unit Unit2;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, jpeg, ExtCtrls, sLabel;

type
  TForm2 = class(TForm)
    Image1: TImage;
    Image2: TImage;
    sLabel1: TsLabel;
    procedure Button1Click(Sender: TObject);
    procedure FormCreate(Sender: TObject);
    procedure Image2Click(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form2: TForm2;

implementation

uses Unit1;

{$R *.dfm}

procedure TForm2.Button1Click(Sender: TObject);
begin
form1.visible := true;
Close;
end;

procedure TForm2.FormCreate(Sender: TObject);
begin
//Center Form
Left:=(Screen.Width-Width)  div 2;
Top:=(Screen.Height-Height) div 2;
end;

procedure TForm2.Image2Click(Sender: TObject);
begin
form1.visible := true;
Close;
end;

end.
