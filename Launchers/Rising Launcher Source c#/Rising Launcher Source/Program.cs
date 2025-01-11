// Decompiled with JetBrains decompiler
// Type: LauncherV2.app.Program
// Assembly: RisingLauncher, Version=1.2.0.0, Culture=neutral, PublicKeyToken=null
// MVID: 849712C9-9869-4AEB-B80F-D71CC2A385A1
// Assembly location: C:\Documents and Settings\Dekaron\Meus documentos\Downloads\ManualPatch8.71\RisingLauncher.exe

using System;
using System.CodeDom.Compiler;
using System.Diagnostics;
using System.IO;
using System.Reflection;
using System.Windows;

namespace LauncherV2.app
{
  public class Program : Application
  {
    private static string _settings = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n<configuration>\n\t<configSections>\n\t<sectionGroup name=\"userSettings\" type=\"System.Configuration.UserSettingsGroup, System, Version=4.0.0.0, Culture=neutral, PublicKeyToken=b77a5c561934e089\" >\n\t<section name=\"LauncherV2.Core.Settings\" type=\"System.Configuration.ClientSettingsSection, System, Version=4.0.0.0, Culture=neutral, PublicKeyToken=b77a5c561934e089\" allowExeDefinition=\"MachineToLocalUser\" requirePermission=\"false\" />\n\t<section name=\"LauncherV2.core.Settings\" type=\"System.Configuration.ClientSettingsSection, System, Version=4.0.0.0, Culture=neutral, PublicKeyToken=b77a5c561934e089\" allowExeDefinition=\"MachineToLocalUser\" requirePermission=\"false\" />\n    </sectionGroup>\n  </configSections>\n  <userSettings>\n    <LauncherV2.Core.Settings>\n\t<setting name=\"MinSegmentSize\" serializeAs=\"String\">\n\t<value>200000</value>\n      </setting>\n      <setting name=\"MinSegmentLeftToStartNewSegment\" serializeAs=\"String\">\n\t<value>30</value>\n      </setting>\n      <setting name=\"RetryDelay\" serializeAs=\"String\">\n\t<value>5</value>\n      </setting>\n      <setting name=\"MaxRetries\" serializeAs=\"String\">\n\t<value>10</value>\n      </setting>\n      <setting name=\"MaxSegments\" serializeAs=\"String\">\n\t<value>5</value>\n      </setting>\n      <setting name=\"DownloadFolder\" serializeAs=\"String\">\n\t<value>./patch/</value>\n      </setting>\n      <setting name=\"VoteLink\" serializeAs=\"String\">\n\t<value>http://www.xtremetop100.com/in.php?site=1132306386</value>\n      </setting>\n      <setting name=\"LastVoteTime\" serializeAs=\"String\">\n\t<value />\n      </setting>\n      <setting name=\"NewsUrl\" serializeAs=\"String\">\n\t<value>http://dekaronuprising.net/update9ob2/news.json</value>\n      </setting>\n      <setting name=\"LauncherVersion\" serializeAs=\"String\">\n\t<value>0.1</value>\n      </setting>\n      <setting name=\"CurrentPatch\" serializeAs=\"String\">\n\t<value>0.1</value>\n      </setting>\n      <setting name=\"PatchUrl\" serializeAs=\"String\">\n\t<value>http://dekaronuprising.net/update9ob2/</value>\n      </setting>\n      <setting name=\"TimeServer\" serializeAs=\"String\">\n\t<value>time-a.nist.gov</value>\n      </setting>\n      <setting name=\"UpdateSystemTime\" serializeAs=\"String\">\n\t<value>True</value>\n      </setting>\n      <setting name=\"ProxyAddress\" serializeAs=\"String\">\n\t<value />\n      </setting>\n      <setting name=\"ProxyUserName\" serializeAs=\"String\">\n\t<value />\n      </setting>\n      <setting name=\"ProxyDomain\" serializeAs=\"String\">\n\t<value />\n      </setting>\n      <setting name=\"UseProxy\" serializeAs=\"String\">\n\t<value>False</value>\n      </setting>\n      <setting name=\"ProxyByPassOnLocal\" serializeAs=\"String\">\n\t<value>False</value>\n      </setting>\n      <setting name=\"ProxyPort\" serializeAs=\"String\">\n\t<value>0</value>\n      </setting>\n      <setting name=\"RequestTimeout\" serializeAs=\"String\">\n\t<value>30000</value>\n      </setting>\n      <setting name=\"SpeedLimitEnabled\" serializeAs=\"String\">\n\t<value>False</value>\n      </setting>\n      <setting name=\"MaxRate\" serializeAs=\"String\">\n\t<value>0</value>\n      </setting>\n      <setting name=\"ProxyPassword\" serializeAs=\"String\">\n\t<value />\n      </setting>\n      <setting name=\"RegUrl\" serializeAs=\"String\">\n\t<value>http://50.115.121.228/registera99test.php</value>\n      </setting>\n      <setting name=\"RepairUrl\" serializeAs=\"String\">\n\t<value>http://dekaronuprising.net/update9ob2/repair/</value>\n      </setting>\n    </LauncherV2.Core.Settings>\n  </userSettings>\n</configuration>";

    [DebuggerNonUserCode]
    [GeneratedCode("PresentationBuildTasks", "4.0.0.0")]
    public void InitializeComponent()
    {
      this.StartupUri = new Uri("MainWindow.xaml", UriKind.Relative);
    }

    private void InitEmbeddedDllLoading()
    {
      AppDomain.CurrentDomain.AssemblyResolve += (ResolveEventHandler) ((sender, args) =>
      {
        string str = new AssemblyName(args.Name).Name;
        if (str.Contains("PresentationFramework"))
        {
          str = "PresentationFramework.Classic.resources";
          string name = "LauncherV2.app.Resources.PresentationFramework.Classic.dll";
          if (Environment.OSVersion.Version.Major < 6)
            name = "LauncherV2.app.Resources.PresentationFramework.Classic.XP.dll";
          Stream manifestResourceStream = Assembly.GetExecutingAssembly().GetManifestResourceStream(name);
          FileStream fileStream = File.Create("PresentationFramework.Classic.dll", (int) manifestResourceStream.Length);
          byte[] buffer = new byte[manifestResourceStream.Length];
          manifestResourceStream.Read(buffer, 0, buffer.Length);
          fileStream.Write(buffer, 0, buffer.Length);
          fileStream.Close();
        }
        using (Stream manifestResourceStream = Assembly.GetExecutingAssembly().GetManifestResourceStream("LauncherV2.app.Resources." + str + ".dll"))
        {
          byte[] numArray = new byte[manifestResourceStream.Length];
          manifestResourceStream.Read(numArray, 0, numArray.Length);
          return Assembly.Load(numArray);
        }
      });
    }

    protected override void OnStartup(StartupEventArgs e)
    {
      AppDomain.CurrentDomain.UnhandledException += new UnhandledExceptionEventHandler(this.CurrentDomain_UnhandledException);
      base.OnStartup(e);
    }

    private void CurrentDomain_UnhandledException(object sender, UnhandledExceptionEventArgs e)
    {
      int num = (int) MessageBox.Show(e.ExceptionObject.ToString());
    }

    [GeneratedCode("PresentationBuildTasks", "4.0.0.0")]
    [STAThread]
    [DebuggerNonUserCode]
    public static void Main()
    {
      Program.writeSettings();
      Program program = new Program();
      program.InitEmbeddedDllLoading();
      program.InitializeComponent();
      program.Run();
    }

    public static void writeSettings()
    {
      if (File.Exists("RisingLauncher.exe.config"))
        return;
      File.WriteAllText("RisingLauncher.exe.config", Program._settings);
    }
  }
}
