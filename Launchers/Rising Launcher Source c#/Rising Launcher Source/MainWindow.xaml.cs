// Decompiled with JetBrains decompiler
// Type: LauncherV2.app.MainWindow
// Assembly: RisingLauncher, Version=1.2.0.0, Culture=neutral, PublicKeyToken=null
// MVID: 849712C9-9869-4AEB-B80F-D71CC2A385A1
// Assembly location: C:\Documents and Settings\Dekaron\Meus documentos\Downloads\ManualPatch8.71\RisingLauncher.exe

using fastJSON;
using LauncherV2.Core;
using LauncherV2.Core.Common;
using LauncherV2.Core.Concurrency;
using LauncherV2.Core.Http;
using LauncherV2.Core.JSONObjects;
using LauncherV2.Core.Protocol;
using LauncherV2.Core.Repair;
using MahApps.Metro.Controls;
using SevenZip;
using System;
using System.CodeDom.Compiler;
using System.Collections;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.ComponentModel;
using System.Configuration;
using System.Diagnostics;
using System.IO;
using System.Reflection;
using System.Security.Cryptography;
using System.Text;
using System.Threading;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Documents;
using System.Windows.Markup;
using System.Windows.Media;
using System.Windows.Threading;

namespace LauncherV2.app
{
  public partial class MainWindow : MetroWindow, IComponentConnector
  {
    private static System.Windows.Forms.Timer refreshTimer = new System.Windows.Forms.Timer();
    private const double Version = 0.7;
    private MainWindow.PatchState patcherState;
    private Thread[] threads;
    private Color lightBlue;
    private volatile Downloader primaryDownload;
    private volatile Patch currentPatch;
    private Hashtable patchToDownloadMap;
    private Hashtable downloadToPatchMap;
    private volatile bool _clearToExtract;
    private string error;
    private double patchId;
    private volatile Queue<Downloader> extractQ;
    internal System.Windows.Controls.TabControl TabControl;
    internal TabItem TabNews;
    internal ScrollViewer scrollViewer1;
    internal StackPanel NewsPanel;
    internal ProgressRing NewsProgress;
    internal TabItem TabRegister;
    internal System.Windows.Controls.Button BtnRegister;
    internal ProgressRing RegProgress;
    internal System.Windows.Controls.TextBox TxtUserName;
    internal PasswordBox TxtPassword;
    internal PasswordBox TxtPasswordConfirm;
    internal System.Windows.Controls.TextBox TxtEmail;
    internal TextBlock LabelError;
    internal TextBlock LabelUserName;
    internal TextBlock LabelPassword;
    internal TextBlock LabelPasswordConfirm;
    internal TextBlock LabelEmail;
    internal TabItem TabUserCP;
    internal TextBlock cpError;
    internal System.Windows.Controls.TextBox tbcpUserName;
    internal TextBlock textBlock3;
    internal TextBlock txt234;
    internal PasswordBox tbCPOldPass;
    internal PasswordBox tbcpNewPass;
    internal TextBlock textBlock2;
    internal PasswordBox tbcpConfirmPass;
    internal TextBlock textBlock6;
    internal System.Windows.Controls.Button btnChangePass;
    internal ProgressRing cpProgress;
    internal TabItem TabVote;
    internal System.Windows.Controls.Button BtnVote;
    internal TextBlock TxtVote;
    internal TextBlock TxtLastVoteTime;
    internal TextBlock TxtVoteAvailable;
    internal ProgressRing VoteProgress;
    internal TabItem TabSettings;
    internal TabItem TabSettings_Launcher;
    internal TabItem TabSettings_Game;
    internal StackPanel GameSettingsPanel;
    internal ProgressRing GameSettingsProgress;
    internal TabItem TabInfo;
    internal TextBlock textBlock4;
    internal TextBlock textBlock5;
    internal Grid grid1;
    internal TextBlock txtMicroStatus;
    internal System.Windows.Controls.Button BtnPlay;
    internal System.Windows.Controls.ProgressBar PBMicro;
    internal TextBlock textBlock1;
    internal System.Windows.Controls.Label LblExtractStatus;
    internal System.Windows.Controls.ProgressBar PBMicroExtract;
    private bool _contentLoaded;

    public MainWindow()
    {
      base.\u002Ector();
      this.InitializeComponent();
    }

    private void MetroWindow_Loaded(object sender, RoutedEventArgs e)
    {
      this.InitApplication();
    }

    public void Info_Click(object sender, RoutedEventArgs e)
    {
      this.TabControl.SelectedIndex = 5;
    }

    private void VoteBrowser_Initialized(object sender, EventArgs e)
    {
    }

    private void BtnPlay_Click(object sender, RoutedEventArgs e)
    {
      this.BtnPlay.IsEnabled = false;
      new Thread(new ThreadStart(this.StartGame))
      {
        Name = "Start",
        IsBackground = true
      }.Start();
    }

    private void StartGame()
    {
      new Process()
      {
        StartInfo = {
          FileName = (Directory.GetCurrentDirectory() + "/bin/dkrising.exe")
        }
      }.Start();
      Thread.Sleep(2000);
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.BtnPlay, "IsEnabled", (object) true);
    }

    private void InitApplication()
    {
      this.InitializeProtocols();
      this.UpdateVoteString();
      this.SetupThreads();
      this.threads[0].Start();
      MainWindow.refreshTimer.Tick += new EventHandler(this.Tick);
      MainWindow.refreshTimer.Interval = 500;
      MainWindow.refreshTimer.Start();
    }

    private void CheckRisingRunning()
    {
      if (!this.isProcessRunning("dkrising"))
        return;
      int num = (int) System.Windows.MessageBox.Show("Please close any running instances of Dekaron Rising to update!", "Dekaron Rising running", MessageBoxButton.OK, MessageBoxImage.Hand);
      this.SHUTDOWN();
    }

    private bool isProcessRunning(string process)
    {
      Process.GetProcessesByName(process);
      foreach (Process process1 in Process.GetProcesses())
      {
        if (process1.ProcessName.Contains(process))
          return true;
      }
      return false;
    }

    private void SetupThreads()
    {
      this.threads[0] = new Thread(new ThreadStart(this.VersionCheckWorker))
      {
        Name = "Version Check",
        IsBackground = true
      };
      Thread thread = new Thread(new ThreadStart(this.NewsWorker));
      thread.Name = "Get News";
      thread.IsBackground = true;
      thread.SetApartmentState(ApartmentState.STA);
      this.threads[1] = thread;
      this.threads[2] = new Thread(new ThreadStart(this.PatchRunner))
      {
        Name = "Patch",
        IsBackground = true
      };
      this.threads[4] = new Thread(new ThreadStart(this.SevenZCheckWorker))
      {
        Name = "SevenZ",
        IsBackground = true
      };
      this.threads[5] = new Thread(new ThreadStart(this.GetGameSettingsWorker))
      {
        Name = "Game Settings",
        IsBackground = true
      };
    }

    private void SHUTDOWN()
    {
      ((DispatcherObject) this).Dispatcher.BeginInvoke((Delegate) (() => System.Windows.Application.Current.Shutdown()));
    }

    private void VersionOK()
    {
      this.threads[1].Start();
      this.threads[2].Start();
      this.threads[4].Start();
    }

    private void InitializeProtocols()
    {
      ProtocolProviderFactory.RegisterProtocolHandler("http", typeof (HttpProtocolProvider));
      ProtocolProviderFactory.RegisterProtocolHandler("https", typeof (HttpProtocolProvider));
      ProtocolProviderFactory.RegisterProtocolHandler("ftp", typeof (FtpProtocolProvider));
    }

    private void SevenZCheckWorker()
    {
      if (!File.Exists("7z.dll"))
      {
        Stream manifestResourceStream = Assembly.GetExecutingAssembly().GetManifestResourceStream("LauncherV2.app.Resources.7z.dll");
        FileStream fileStream = File.Create("7z.dll", (int) manifestResourceStream.Length);
        byte[] buffer = new byte[manifestResourceStream.Length];
        manifestResourceStream.Read(buffer, 0, buffer.Length);
        fileStream.Write(buffer, 0, buffer.Length);
        fileStream.Close();
      }
      if (File.Exists("SevenZipSharp.dll"))
        return;
      Stream manifestResourceStream1 = Assembly.GetExecutingAssembly().GetManifestResourceStream("LauncherV2.app.Resources.SevenZipSharp.dll");
      FileStream fileStream1 = File.Create("SevenZipSharp.dll", (int) manifestResourceStream1.Length);
      byte[] buffer1 = new byte[manifestResourceStream1.Length];
      manifestResourceStream1.Read(buffer1, 0, buffer1.Length);
      fileStream1.Write(buffer1, 0, buffer1.Length);
      fileStream1.Close();
    }

    private void Tick(object obj, EventArgs e)
    {
      this.UpdateDownloadProgress();
    }

    public void VersionCheckWorker()
    {
      if (((Version) JSON.get_Instance().ToObject(Get.GetMessage(Settings.get_Default().get_PatchUrl() + "version.json", (NameValueCollection) null), typeof (Version))).get_version() > 0.7)
      {
        ProcessStartInfo startInfo = new ProcessStartInfo();
        startInfo.FileName = Environment.CurrentDirectory + "/LauncherUpdate.exe";
        if (Environment.OSVersion.Version.Major >= 6)
          startInfo.Verb = "runas";
        Process.Start(startInfo);
        System.Windows.Application.Current.Shutdown();
      }
      else
        this.VersionOK();
    }

    public void PatchRunner()
    {
      this.CheckRisingRunning();
      Patches patches = (Patches) JSON.get_Instance().ToObject(Get.GetMessage(Settings.get_Default().get_PatchUrl() + "patches.json", (NameValueCollection) null), typeof (Patches));
      Queue<Patch> queue = new Queue<Patch>();
      using (List<Patch>.Enumerator enumerator = patches.get_patches().GetEnumerator())
      {
        while (enumerator.MoveNext())
        {
          Patch current = enumerator.Current;
          if (current.get_id() > Settings.get_Default().get_CurrentPatch())
          {
            Settings.get_Default().set_CurrentPatch(current.get_id());
            ResourceLocation resourceLocation = new ResourceLocation();
            resourceLocation.set_URL(current.get_url());
            if (current.get_authenticate())
            {
              resourceLocation.set_Authenticate(true);
              resourceLocation.set_Login(current.get_user());
              resourceLocation.set_Password(current.get_password());
            }
            resourceLocation.BindProtocolProviderType();
            if (resourceLocation.get_ProtocolProviderType() == null)
            {
              if (System.Windows.MessageBox.Show("Update Failure::Invalid Protocol\nLauncher will now close. Please try again.\n\n\nWould you like to send an error report to DKRising?", "FATAL ERROR", MessageBoxButton.YesNo, MessageBoxImage.Hand) == MessageBoxResult.Yes)
              {
                int num = (int) System.Windows.MessageBox.Show("sent");
              }
              this.SHUTDOWN();
              return;
            }
            else
            {
              Downloader downloader = new Downloader(resourceLocation, (ResourceLocation[]) null, "patch/" + current.get_name() + ".rpa", Settings.get_Default().get_MaxSegments());
              this.patchToDownloadMap[(object) current] = (object) downloader;
              this.downloadToPatchMap[(object) downloader] = (object) current;
              queue.Enqueue(current);
            }
          }
        }
      }
      Thread thread = new Thread(new ThreadStart(this.ExtractWorker));
      thread.Name = "Extract";
      thread.IsBackground = true;
      while (queue.Count > 0)
      {
        this.currentPatch = queue.Dequeue();
        this.primaryDownload = (Downloader) this.patchToDownloadMap[(object) this.currentPatch];
        this.primaryDownload.add_Ending((EventHandler) ((obj, e) => this.extractQ.Enqueue(this.primaryDownload)));
        this.primaryDownload.Start();
        this.ChangeState(MainWindow.PatchState.patching);
        this.primaryDownload.WaitForConclusion();
        if (!thread.IsAlive)
          thread.Start();
      }
      this.SetReady();
      ((SettingsBase) Settings.get_Default()).Save();
    }

    private void ExtractWorker()
    {
      do
        ;
      while (this.threads[4].IsAlive);
      Downloader downloader = (Downloader) null;
      while (this.patcherState != MainWindow.PatchState.done)
      {
        while (this.extractQ.Count > 0)
        {
          if (this._clearToExtract)
          {
            if (downloader != null)
            {
              try
              {
                File.Delete(downloader.get_LocalFile());
              }
              catch (Exception ex)
              {
              }
            }
            ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.LblExtractStatus, "Visibility", (object) Visibility.Visible);
            ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.PBMicroExtract, "Visibility", (object) Visibility.Visible);
            this._clearToExtract = false;
            downloader = this.extractQ.Dequeue();
            this.patchId = ((Patch) this.downloadToPatchMap[(object) downloader]).get_id();
            SevenZipBase.SetLibraryPath("7z.dll");
            SevenZipExtractor sevenZipExtractor = new SevenZipExtractor(downloader.get_LocalFile());
            sevenZipExtractor.Extracting += new EventHandler<ProgressEventArgs>(this.extractor_Extracting);
            sevenZipExtractor.ExtractionFinished += new EventHandler<EventArgs>(this.extractor_ExtractionFinished);
            sevenZipExtractor.BeginExtractArchive(".\\");
          }
        }
        Thread.Sleep(500);
      }
    }

    private void extractor_Extracting(object sender, ProgressEventArgs e)
    {
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.LblExtractStatus, "Content", (object) ("Extracting...\t" + e.PercentDone.ToString()));
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.PBMicroExtract, "Value", (object) e.PercentDone);
    }

    private void extractor_ExtractionFinished(object sender, EventArgs e)
    {
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.LblExtractStatus, "Content", (object) "Extracting...");
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.PBMicroExtract, "Value", (object) 0);
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.LblExtractStatus, "Visibility", (object) Visibility.Hidden);
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.PBMicroExtract, "Visibility", (object) Visibility.Hidden);
      Settings.get_Default().set_CurrentPatch(this.patchId);
      ((SettingsBase) Settings.get_Default()).Save();
      this._clearToExtract = true;
    }

    private void ChangeState(MainWindow.PatchState state)
    {
      this.patcherState = state;
    }

    public void UpdateDownloadProgress()
    {
      switch (this.patcherState)
      {
        case MainWindow.PatchState.preparing:
          this.txtMicroStatus.Text = "preparing";
          break;
        case MainWindow.PatchState.patching:
          this.txtMicroStatus.Text = "Downloading " + this.currentPatch.get_name() + "\t Rate: " + string.Format("{0:0.##}", (object) (this.primaryDownload.get_Rate() / 1024.0)) + "KB/s  Left: " + TimeSpanFormatter.ToString(this.primaryDownload.get_Left()) + "  Progress: " + string.Format("{0:0.##}%", (object) this.primaryDownload.get_Progress());
          this.PBMicro.Value = this.primaryDownload.get_Progress();
          break;
        case MainWindow.PatchState.done:
          this.txtMicroStatus.Text = "Downloads complete";
          this.PBMicro.Value = 100.0;
          break;
      }
    }

    private void DownloadFiles(Queue<Patch> q)
    {
    }

    public void SetReady()
    {
      MainWindow.refreshTimer.Stop();
      while (this.extractQ.Count > 0)
        Thread.Sleep(1000);
      if (this.patchToDownloadMap.Count > 0)
      {
        try
        {
          Directory.Delete("patch", true);
        }
        catch (Exception ex)
        {
        }
      }
      ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.txtMicroStatus, "Text", (object) "Client is up to date");
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.PBMicro, "Value", (object) 100.0);
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.LblExtractStatus, "Visibility", (object) Visibility.Hidden);
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.PBMicroExtract, "Visibility", (object) Visibility.Hidden);
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.BtnPlay, "IsEnabled", (object) true);
    }

    public void Repair_Click(object sender, RoutedEventArgs e)
    {
      if (this.threads[2].IsAlive)
      {
        int num = (int) System.Windows.MessageBox.Show("Can not repair while a patch is in progress!", "Client Repair", MessageBoxButton.OK, MessageBoxImage.Exclamation);
      }
      else
      {
        if (System.Windows.MessageBox.Show("Would you like to repair your client?\n\nThis process can take anywhere from 3-15 minutes.", "Client Repair?", MessageBoxButton.YesNo, MessageBoxImage.Question) != MessageBoxResult.Yes)
          return;
        this.BtnPlay.IsEnabled = false;
        new Thread(new ThreadStart(((Action) (() =>
        {
          Repairer.SetProgressBarControl(this.PBMicro);
          Repairer.SetProgressTextControl(this.txtMicroStatus);
          Repairer.OnFinished = (__Null) Delegate.Combine((Delegate) Repairer.OnFinished, (Delegate) (() =>
          {
            ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.BtnPlay, "IsEnabled", (object) true);
            ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.txtMicroStatus, "Text", (object) "Client repair complete!");
            ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.PBMicro, "Value", (object) 100.0);
          }));
          Repairer.Repair((Action) null);
        })).Invoke))
        {
          Name = "Repair",
          IsBackground = true
        }.Start();
      }
    }

    public void NewsWorker()
    {
      int num = 0;
      NewsCollection newsCollection = (NewsCollection) null;
      string message;
      do
      {
        message = Get.GetMessage(Settings.get_Default().get_NewsUrl(), (NameValueCollection) null);
        try
        {
          newsCollection = (NewsCollection) JSON.get_Instance().ToObject(message, typeof (NewsCollection));
        }
        catch (Exception ex)
        {
        }
        ++num;
      }
      while (newsCollection == null && num < Settings.get_Default().get_MaxRetries() && message != null);
      if (message == null)
        this.NewsPanel.Dispatcher.Invoke(DispatcherPriority.Normal, (Delegate) (() =>
        {
          UIElementCollection children = this.NewsPanel.Children;
          TextBlock textBlock = new TextBlock()
          {
            Text = "Error Retrieving News : Invalid URL",
            FontSize = 18.0,
            Foreground = (Brush) Brushes.Red,
            TextAlignment = TextAlignment.Center,
            Margin = new Thickness(0.0, 15.0, 0.0, 0.0)
          };
          children.Add((UIElement) textBlock);
        }));
      else if (newsCollection == null)
      {
        this.NewsPanel.Dispatcher.Invoke(DispatcherPriority.Normal, (Delegate) (() =>
        {
          UIElementCollection children = this.NewsPanel.Children;
          TextBlock textBlock = new TextBlock()
          {
            Text = "Error Retrieving News : Invalid Response",
            FontSize = 18.0,
            Foreground = (Brush) Brushes.Red,
            TextAlignment = TextAlignment.Center,
            Margin = new Thickness(0.0, 15.0, 0.0, 0.0)
          };
          children.Add((UIElement) textBlock);
        }));
      }
      else
      {
        // ISSUE: object of a compiler-generated type is created
        // ISSUE: variable of a compiler-generated type
        MainWindow.\u003C\u003Ec__DisplayClass18 cDisplayClass18 = new MainWindow.\u003C\u003Ec__DisplayClass18();
        // ISSUE: reference to a compiler-generated field
        cDisplayClass18.linkOrange = new Color()
        {
          A = byte.MaxValue,
          R = byte.MaxValue,
          G = (byte) 127,
          B = (byte) 30
        };
        using (List<NewsObject>.Enumerator enumerator = newsCollection.get_news().GetEnumerator())
        {
          // ISSUE: object of a compiler-generated type is created
          // ISSUE: variable of a compiler-generated type
          MainWindow.\u003C\u003Ec__DisplayClass1d cDisplayClass1d = new MainWindow.\u003C\u003Ec__DisplayClass1d();
          // ISSUE: reference to a compiler-generated field
          cDisplayClass1d.CS\u0024\u003C\u003E8__locals19 = cDisplayClass18;
          // ISSUE: reference to a compiler-generated field
          cDisplayClass1d.\u003C\u003E4__this = this;
          while (enumerator.MoveNext())
          {
            // ISSUE: reference to a compiler-generated field
            cDisplayClass1d.n = enumerator.Current;
            // ISSUE: reference to a compiler-generated method
            this.NewsPanel.Dispatcher.Invoke(DispatcherPriority.Normal, (Delegate) new Action(cDisplayClass1d.\u003CNewsWorker\u003Eb__11));
            // ISSUE: reference to a compiler-generated field
            if (cDisplayClass1d.n.get_title() != string.Empty)
            {
              // ISSUE: reference to a compiler-generated method
              this.NewsPanel.Dispatcher.Invoke(DispatcherPriority.Normal, (Delegate) new Action(cDisplayClass1d.\u003CNewsWorker\u003Eb__12));
            }
            // ISSUE: reference to a compiler-generated field
            if (cDisplayClass1d.n.get_message() != string.Empty)
            {
              // ISSUE: reference to a compiler-generated method
              this.NewsPanel.Dispatcher.Invoke(DispatcherPriority.Normal, (Delegate) new Action(cDisplayClass1d.\u003CNewsWorker\u003Eb__13));
            }
            this.NewsPanel.Dispatcher.Invoke(DispatcherPriority.Normal, (Delegate) (() =>
            {
              UIElementCollection children = this.NewsPanel.Children;
              Separator separator = new Separator()
              {
                Height = 1.0,
                Margin = new Thickness(0.0, 10.0, 0.0, 0.0)
              };
              children.Add((UIElement) separator);
            }));
          }
        }
      }
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.NewsProgress, "IsActive", (object) false);
    }

    public void Hyperlink_Nav(object sender, RoutedEventArgs e)
    {
      Process.Start(new ProcessStartInfo((sender as Hyperlink).NavigateUri.ToString()));
      e.Handled = true;
    }

    private void Hyperlink_OnMouseEnter(object sender, EventArgs e)
    {
      (sender as Hyperlink).TextDecorations = TextDecorations.Underline;
    }

    private void Hyperlink_OnMouseLeave(object sender, EventArgs e)
    {
      (sender as Hyperlink).TextDecorations = (TextDecorationCollection) null;
    }

    private void BtnVote_Click(object sender, RoutedEventArgs e)
    {
      if (!(Settings.get_Default().get_LastVoteTime().AddHours(12.0) < DateTime.Now))
        return;
      this.VoteProgress.set_IsActive(true);
      new Thread(new ThreadStart(this.VoteThreadWorker))
      {
        Name = "Vote",
        IsBackground = true
      }.Start();
    }

    private void VoteThreadWorker()
    {
      try
      {
        Post.PostMessage(Settings.get_Default().get_VoteLink(), new NameValueCollection()
        {
          {
            "site",
            Settings.get_Default().get_VoteLink().Split('=')[1]
          }
        });
        ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.TxtVote, "Text", (object) "Success, Thank you for your support!");
        Settings.get_Default().set_LastVoteTime(DateTime.Now);
        ((SettingsBase) Settings.get_Default()).Save();
        ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.VoteProgress, "IsActive", (object) false);
        this.UpdateVoteString();
      }
      catch (Exception ex)
      {
      }
    }

    private void UpdateVoteString()
    {
      if (Settings.get_Default().get_LastVoteTime() == DateTime.MinValue)
      {
        ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.TxtLastVoteTime, "Text", (object) "You have not yet voted");
        ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.TxtVoteAvailable, "Text", (object) "Vote now to support the server!");
        ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.BtnVote, "IsEnabled", (object) true);
      }
      else
      {
        ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.TxtLastVoteTime, "Text", (object) ("Last Voted: " + Settings.get_Default().get_LastVoteTime().ToLongDateString() + " at " + Settings.get_Default().get_LastVoteTime().ToLongTimeString()));
        DateTime dateTime = Settings.get_Default().get_LastVoteTime().AddHours(12.0);
        if (dateTime > DateTime.Now)
        {
          ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.BtnVote, "IsEnabled", (object) false);
          ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.TxtVoteAvailable, "Text", (object) ("You can vote next on: " + dateTime.ToLongDateString() + " at " + dateTime.ToLongTimeString()));
        }
        else
        {
          ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.BtnVote, "IsEnabled", (object) true);
          ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.TxtVoteAvailable, "Text", (object) "You can vote now!");
        }
      }
    }

    private void BtnRegister_Click(object sender, RoutedEventArgs e)
    {
      this.RegProgress.set_IsActive(true);
      new Thread(new ThreadStart(this.RegisterWorker))
      {
        Name = "Register",
        IsBackground = true
      }.Start();
    }

    private bool VerifyInput(string user, string pass, string passConfirm, string email)
    {
      if (user.Length < 4 || user.Length > 12)
      {
        MainWindow mainWindow = this;
        string str = mainWindow.error + "Username must be between 4 and 12 characters\n";
        mainWindow.error = str;
        return false;
      }
      else if (pass.Length < 4 || pass.Length > 12)
      {
        this.error = "Password must be between 4 and 12 characters\n";
        return false;
      }
      else if (string.Compare(pass, passConfirm) != 0)
      {
        this.error = "Passwords do not match\n";
        return false;
      }
      else
      {
        if (string.Compare(user, pass) != 0)
          return true;
        this.error = "Username must difer from password\n";
        return false;
      }
    }

    private void ClearInput()
    {
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.TxtUserName, "Text", (object) "");
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.TxtEmail, "Text", (object) "");
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.TxtPassword, "Password", (object) "");
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.TxtPasswordConfirm, "Password", (object) "");
    }

    private void RegisterWorker()
    {
      string userName = "";
      System.Windows.Application.Current.Dispatcher.Invoke(DispatcherPriority.Send, (Delegate) (() => userName = this.TxtUserName.Text));
      string pass = "";
      System.Windows.Application.Current.Dispatcher.Invoke(DispatcherPriority.Send, (Delegate) (() => pass = this.TxtPassword.Password));
      string passConfirm = "";
      System.Windows.Application.Current.Dispatcher.Invoke(DispatcherPriority.Send, (Delegate) (() => passConfirm = this.TxtPasswordConfirm.Password));
      string email = "";
      System.Windows.Application.Current.Dispatcher.Invoke(DispatcherPriority.Send, (Delegate) (() => email = this.TxtEmail.Text));
      if (this.VerifyInput(userName, pass, passConfirm, email))
      {
        string @string = Encoding.UTF8.GetString(Post.PostMessage("http://50.115.121.228/registera99test.php", new NameValueCollection()
        {
          {
            "accname",
            userName
          },
          {
            "accpass1",
            pass
          },
          {
            "accpass2",
            pass
          },
          {
            "accmail",
            email
          }
        }));
        if (@string.Contains("Error"))
        {
          ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.LabelError, "Foreground", (object) Brushes.Red);
          ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.LabelError, "Text", (object) @string);
        }
        else
        {
          ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.LabelError, "Text", (object) "Success, Account created!");
          ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.LabelError, "Foreground", (object) Brushes.Chartreuse);
          this.ClearInput();
        }
      }
      else
      {
        ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.LabelError, "Foreground", (object) Brushes.Yellow);
        ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.LabelError, "Text", (object) this.error);
      }
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.RegProgress, "IsActive", (object) false);
    }

    private void Settings_Click(object sender, RoutedEventArgs e)
    {
      this.TabControl.SelectedIndex = 4;
    }

    private void GetGameSettingsWorker()
    {
    }

    private TextBlock CreateTextBlockLabel(string value)
    {
      TextBlock textBlock = new TextBlock();
      textBlock.Text = value;
      textBlock.FontSize = 18.0;
      textBlock.TextAlignment = TextAlignment.Right;
      textBlock.Margin = new Thickness(0.0, 0.0, 25.0, 0.0);
      return textBlock;
    }

    private System.Windows.Controls.TextBox CreateStringInput(string value)
    {
      System.Windows.Controls.TextBox textBox = new System.Windows.Controls.TextBox();
      textBox.Text = value;
      textBox.MinWidth = 150.0;
      textBox.Margin = new Thickness(10.0, 0.0, 0.0, 0.0);
      return textBox;
    }

    private System.Windows.Controls.CheckBox CreateOnOffSwitch(bool setting)
    {
      System.Windows.Controls.CheckBox checkBox = new System.Windows.Controls.CheckBox();
      checkBox.IsChecked = new bool?(setting);
      checkBox.Style = ((FrameworkElement) this).Resources[(object) "SwitchStyle"] as Style;
      return checkBox;
    }

    private void btnChangePass_Click(object sender, RoutedEventArgs e)
    {
      this.cpProgress.set_IsActive(true);
      new Thread(new ThreadStart(this.ChangePassWorker))
      {
        Name = "Change Pass",
        IsBackground = true
      }.Start();
    }

    private bool cpVerifyInput(string user, string oldpass, string pass, string passConfirm)
    {
      if (user.Length < 4 || user.Length > 12)
      {
        MainWindow mainWindow = this;
        string str = mainWindow.error + "Username must be between 4 and 12 characters\n";
        mainWindow.error = str;
        return false;
      }
      else if (oldpass.Length < 4 || pass.Length > 12)
      {
        this.error = "Password must be between 4 and 12 characters\n";
        return false;
      }
      else if (pass.Length < 4 || pass.Length > 12)
      {
        this.error = "Password must be between 4 and 12 characters\n";
        return false;
      }
      else if (string.Compare(pass, passConfirm) != 0)
      {
        this.error = "Passwords do not match\n";
        return false;
      }
      else
      {
        if (string.Compare(user, pass) != 0)
          return true;
        this.error = "Username must difer from password\n";
        return false;
      }
    }

    private void cpClearInput()
    {
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.tbcpUserName, "Text", (object) "");
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.tbcpNewPass, "Password", (object) "");
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.tbcpConfirmPass, "Password", (object) "");
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.tbCPOldPass, "Password", (object) "");
    }

    private void ChangePassWorker()
    {
      string userName = "";
      System.Windows.Application.Current.Dispatcher.Invoke(DispatcherPriority.Send, (Delegate) (() => userName = this.tbcpUserName.Text));
      string oldpass = "";
      System.Windows.Application.Current.Dispatcher.Invoke(DispatcherPriority.Send, (Delegate) (() => oldpass = this.tbCPOldPass.Password));
      string pass = "";
      System.Windows.Application.Current.Dispatcher.Invoke(DispatcherPriority.Send, (Delegate) (() => pass = this.tbcpNewPass.Password));
      string passConfirm = "";
      System.Windows.Application.Current.Dispatcher.Invoke(DispatcherPriority.Send, (Delegate) (() => passConfirm = this.tbcpConfirmPass.Password));
      if (this.cpVerifyInput(userName, oldpass, pass, passConfirm))
      {
        using (MD5 md5Hash = MD5.Create())
        {
          string @string = Encoding.UTF8.GetString(Post.PostMessage("http://72.8.157.174:8889/api/accounts/changepass", new NameValueCollection()
          {
            {
              "user_id",
              userName
            },
            {
              "currentpass",
              MainWindow.GetMd5Hash(md5Hash, oldpass)
            },
            {
              "newpass",
              MainWindow.GetMd5Hash(md5Hash, pass)
            }
          }));
          if (!@string.Contains("Success"))
          {
            ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.cpError, "Foreground", (object) Brushes.Red);
            ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.cpError, "Text", (object) ("ERROR : " + @string));
          }
          else
          {
            ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.cpError, "Text", (object) "Success, Pass changed!");
            ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.cpError, "Foreground", (object) Brushes.Chartreuse);
            this.ClearInput();
          }
        }
      }
      else
      {
        ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.cpError, "Foreground", (object) Brushes.Yellow);
        ThreadSafe.SetControlPropertyThreadSafe((FrameworkElement) this.cpError, "Text", (object) ("ERROR : " + this.error));
      }
      ThreadSafe.SetControlPropertyThreadSafe((System.Windows.Controls.Control) this.cpProgress, "IsActive", (object) false);
    }

    private static string GetMd5Hash(MD5 md5Hash, string input)
    {
      byte[] hash = md5Hash.ComputeHash(Encoding.UTF8.GetBytes(input));
      StringBuilder stringBuilder = new StringBuilder();
      for (int index = 0; index < hash.Length; ++index)
        stringBuilder.Append(hash[index].ToString("x2"));
      return ((object) stringBuilder).ToString();
    }

    [GeneratedCode("PresentationBuildTasks", "4.0.0.0")]
    [DebuggerNonUserCode]
    public void InitializeComponent()
    {
      if (this._contentLoaded)
        return;
      this._contentLoaded = true;
      System.Windows.Application.LoadComponent((object) this, new Uri("/RisingLauncher;component/mainwindow.xaml", UriKind.Relative));
    }

    [EditorBrowsable(EditorBrowsableState.Never)]
    [DebuggerNonUserCode]
    [GeneratedCode("PresentationBuildTasks", "4.0.0.0")]
    void IComponentConnector.Connect(int connectionId, object target)
    {
      switch (connectionId)
      {
        case 1:
          ((FrameworkElement) target).Loaded += new RoutedEventHandler(this.MetroWindow_Loaded);
          break;
        case 2:
          ((System.Windows.Controls.Primitives.ButtonBase) target).Click += new RoutedEventHandler(this.Info_Click);
          break;
        case 3:
          ((System.Windows.Controls.Primitives.ButtonBase) target).Click += new RoutedEventHandler(this.Repair_Click);
          break;
        case 4:
          ((System.Windows.Controls.Primitives.ButtonBase) target).Click += new RoutedEventHandler(this.Settings_Click);
          break;
        case 5:
          this.TabControl = (System.Windows.Controls.TabControl) target;
          break;
        case 6:
          this.TabNews = (TabItem) target;
          break;
        case 7:
          this.scrollViewer1 = (ScrollViewer) target;
          break;
        case 8:
          this.NewsPanel = (StackPanel) target;
          break;
        case 9:
          this.NewsProgress = (ProgressRing) target;
          break;
        case 10:
          this.TabRegister = (TabItem) target;
          break;
        case 11:
          this.BtnRegister = (System.Windows.Controls.Button) target;
          this.BtnRegister.Click += new RoutedEventHandler(this.BtnRegister_Click);
          break;
        case 12:
          this.RegProgress = (ProgressRing) target;
          break;
        case 13:
          this.TxtUserName = (System.Windows.Controls.TextBox) target;
          break;
        case 14:
          this.TxtPassword = (PasswordBox) target;
          break;
        case 15:
          this.TxtPasswordConfirm = (PasswordBox) target;
          break;
        case 16:
          this.TxtEmail = (System.Windows.Controls.TextBox) target;
          break;
        case 17:
          this.LabelError = (TextBlock) target;
          break;
        case 18:
          this.LabelUserName = (TextBlock) target;
          break;
        case 19:
          this.LabelPassword = (TextBlock) target;
          break;
        case 20:
          this.LabelPasswordConfirm = (TextBlock) target;
          break;
        case 21:
          this.LabelEmail = (TextBlock) target;
          break;
        case 22:
          this.TabUserCP = (TabItem) target;
          break;
        case 23:
          this.cpError = (TextBlock) target;
          break;
        case 24:
          this.tbcpUserName = (System.Windows.Controls.TextBox) target;
          break;
        case 25:
          this.textBlock3 = (TextBlock) target;
          break;
        case 26:
          this.txt234 = (TextBlock) target;
          break;
        case 27:
          this.tbCPOldPass = (PasswordBox) target;
          break;
        case 28:
          this.tbcpNewPass = (PasswordBox) target;
          break;
        case 29:
          this.textBlock2 = (TextBlock) target;
          break;
        case 30:
          this.tbcpConfirmPass = (PasswordBox) target;
          break;
        case 31:
          this.textBlock6 = (TextBlock) target;
          break;
        case 32:
          this.btnChangePass = (System.Windows.Controls.Button) target;
          this.btnChangePass.Click += new RoutedEventHandler(this.btnChangePass_Click);
          break;
        case 33:
          this.cpProgress = (ProgressRing) target;
          break;
        case 34:
          this.TabVote = (TabItem) target;
          break;
        case 35:
          this.BtnVote = (System.Windows.Controls.Button) target;
          this.BtnVote.Click += new RoutedEventHandler(this.BtnVote_Click);
          break;
        case 36:
          this.TxtVote = (TextBlock) target;
          break;
        case 37:
          this.TxtLastVoteTime = (TextBlock) target;
          break;
        case 38:
          this.TxtVoteAvailable = (TextBlock) target;
          break;
        case 39:
          this.VoteProgress = (ProgressRing) target;
          break;
        case 40:
          this.TabSettings = (TabItem) target;
          break;
        case 41:
          this.TabSettings_Launcher = (TabItem) target;
          break;
        case 42:
          this.TabSettings_Game = (TabItem) target;
          break;
        case 43:
          this.GameSettingsPanel = (StackPanel) target;
          break;
        case 44:
          this.GameSettingsProgress = (ProgressRing) target;
          break;
        case 45:
          this.TabInfo = (TabItem) target;
          break;
        case 46:
          this.textBlock4 = (TextBlock) target;
          break;
        case 47:
          this.textBlock5 = (TextBlock) target;
          break;
        case 48:
          this.grid1 = (Grid) target;
          break;
        case 49:
          this.txtMicroStatus = (TextBlock) target;
          break;
        case 50:
          this.BtnPlay = (System.Windows.Controls.Button) target;
          this.BtnPlay.Click += new RoutedEventHandler(this.BtnPlay_Click);
          break;
        case 51:
          this.PBMicro = (System.Windows.Controls.ProgressBar) target;
          break;
        case 52:
          this.textBlock1 = (TextBlock) target;
          break;
        case 53:
          this.LblExtractStatus = (System.Windows.Controls.Label) target;
          break;
        case 54:
          this.PBMicroExtract = (System.Windows.Controls.ProgressBar) target;
          break;
        default:
          this._contentLoaded = true;
          break;
      }
    }

    public enum ThreadType
    {
      VersionCheck,
      GetNews,
      Patch,
      Download,
      SevenZ,
      GetGameSettings,
      WriteGameSettings,
      Max,
    }

    private enum PatchState
    {
      preparing,
      patching,
      done,
    }
  }
}
