﻿using System;
using System.ComponentModel;
using System.Diagnostics;
using System.IO;
using System.Net;
using System.Runtime.InteropServices;
using System.Windows.Forms;
using System.Xml.Linq;
using System.Xml;
using System.Threading;
using Ionic.Zip;


namespace Launcher
{
    public partial class Form1 : Form
    {
        public string sVersion; // server launcher version
        public string lVersion; // client launcher version
        public string Root = AppDomain.CurrentDomain.BaseDirectory; // root to current dir
        public string ServerUpdate = "http://xtremedekarononline.com/update/"; // server url

        XDocument serverXml = null;
        Stopwatch sw1 = new Stopwatch();      

        public const int WM_NCLBUTTONDOWN = 0xA1;
        public const int HT_CAPTION = 0x2;

        [DllImportAttribute("user32.dll")]
        public static extern int SendMessage(IntPtr hWnd, int Msg, int wParam, int lParam);
        [DllImportAttribute("user32.dll")]
        public static extern bool ReleaseCapture();
        public Form1()
        {
            InitializeComponent();
            IsProcessRunning();       
            CheckDll();
            this.strtGameBtn.MouseLeave += new System.EventHandler(this.button1_MouseLeave);
            this.strtGameBtn.MouseEnter += new System.EventHandler(this.button1_MouseEnter);

            backgroundWorker1.RunWorkerAsync();
            strtGameBtn.Enabled = false;
        }
        private void backgroundWorker1_DoWork(object sender, DoWorkEventArgs e)
        {
            System.Windows.Forms.Form.CheckForIllegalCrossThreadCalls = false;
            try
            {
                // Try loading the xml file
                try
                {
                    serverXml = XDocument.Load(ServerUpdate + "Updates.xml");
                }
                catch
                {
                    MessageBox.Show("Error retriving the XML from the update server.", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                }


                FileStream fs = null;
                if (!File.Exists("version"))
                {
                    using (fs = File.Create("version")) { } // create file
                    using (StreamWriter sw = new StreamWriter("version"))
                    {
                        sw.Write("1.0");
                    }
                }

                string lclVersion;
                using (StreamReader reader = new StreamReader("version"))
                {
                    lclVersion = reader.ReadLine();
                    lVersion = lclVersion;

                }
                Version localVersion = new Version(lclVersion);

                foreach (XElement update in serverXml.Descendants("update"))
                {
                    string version = update.Element("version").Value;
                    string file = update.Element("file").Value;

                    //decimal serverVersion = decimal.Parse(version);
                    Version serverVersion = new Version(version);
                    string sUrlToReadFileFrom = ServerUpdate + file;
                    string sFilePathToWriteFileTo = Root + file;

                    sVersion = version;

                    if (serverVersion > localVersion)
                    {
                        Uri url = new Uri(sUrlToReadFileFrom);
                        System.Net.HttpWebRequest request = (System.Net.HttpWebRequest)System.Net.WebRequest.Create(url);
                        System.Net.HttpWebResponse response = (System.Net.HttpWebResponse)request.GetResponse();
                        response.Close();

                        Int64 iSize = response.ContentLength;
                        Int64 iRunningByteTotal = 0;


                        using (System.Net.WebClient client = new System.Net.WebClient())
                        {
                            using (System.IO.Stream streamRemote = client.OpenRead(new Uri(sUrlToReadFileFrom)))
                            {
                                using (Stream streamLocal = new FileStream(sFilePathToWriteFileTo, FileMode.Create, FileAccess.Write, FileShare.None))
                                {

                                    int iByteSize = 0;
                                    byte[] byteBuffer = new byte[iSize];
                                    while ((iByteSize = streamRemote.Read(byteBuffer, 0, byteBuffer.Length)) > 0)
                                    {
                                        streamLocal.Write(byteBuffer, 0, iByteSize);
                                        iRunningByteTotal += iByteSize;

                                        double dIndex = (double)(iRunningByteTotal);
                                        double dTotal = (double)byteBuffer.Length;
                                        double dProgressPercentage = (dIndex / dTotal);
                                        int iProgressPercentage = (int)(dProgressPercentage * 100);

                                        backgroundWorker1.ReportProgress(iProgressPercentage);
                                    }
                                    streamLocal.Close();
                                }
                                streamRemote.Close();
                            }
                        }

                        using (ZipFile zip = ZipFile.Read(file))
                        {                         
                            foreach (ZipEntry zipFiles in zip)
                            {
                                zipFiles.Extract(Root, true);
                                downloadLbl.Text = "Updating client files...";
                            }
                        }


                        using (StreamWriter sw = new StreamWriter("version"))
                        {
                            sw.Write(sVersion);
                            lVersion = sVersion;
                            downloadLbl.Text = "Updating version file...";
                        }

                        deleteFile(file);
                        downloadLbl.Text = "Cleaning update files...";
                    }
                }// end foreach 
            }
            catch(Exception ex)
            {
                MessageBox.Show(ex.Message, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                return;
            }
        }
        private void backgroundWorker1_ProgressChanged(object sender, ProgressChangedEventArgs e)
        {
            progressBar1.Value = e.ProgressPercentage;
            downloadLbl.Text = "Downloading v" + sVersion + " ... " + e.ProgressPercentage + "% completed";
        }
        private void backgroundWorker1_RunWorkerCompleted(object sender, RunWorkerCompletedEventArgs e)
        {
            if (File.Exists(Root + "xtremeLauncher_new.exe"))
            {
                downloadLbl.Text = "New Launcher found...";

                MessageBox.Show("New Launcher found!" + "\n" + "The launcher will now close and try update.","New Launcher Update",MessageBoxButtons.OK,MessageBoxIcon.Asterisk);
                if (!File.Exists(Root + "updater.exe"))
                {
                    MessageBox.Show("updater.exe not found!" + "\n" + "Please download the updater.exe from the website and try again.", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                }
                else
                {
                    Process.Start(Root + "\\updater.exe");
                    System.Environment.Exit(1);
                }
            }

            strtGameBtn.Image = global::Launcher.Properties.Resources.button_play_normal;
            strtGameBtn.Enabled = true;
            strtGameBtn.Cursor = System.Windows.Forms.Cursors.Default;
            downloadLbl.Text = "Client updated!";
        }
        private void Form1_Load(object sender, EventArgs e)
        {
        }
        private void strtGameBtn_Click_1(object sender, EventArgs e)
        {
            if (!File.Exists(Root + "\\bin\\dekaron.exe"))
            {
                MessageBox.Show("bin/dekaron.exe not found! " + "\n" + "Please make sure you have 'dekaron.exe' in the bin folder.", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            else
            {
                Process.Start(Root + "\\bin\\dekaron.exe", "m_cher sel0");
                System.Environment.Exit(1);
            }
        }

        private void Form1_MouseDown(object sender, System.Windows.Forms.MouseEventArgs e)
        {
            if (e.Button == MouseButtons.Left)
            {
                ReleaseCapture();
                SendMessage(Handle, WM_NCLBUTTONDOWN, HT_CAPTION, 0);
            }
        }
        private void closeBtn_Click(object sender, EventArgs e)
        {
            this.Close();
        }
        private void minimizeBtn_Click(object sender, EventArgs e)
        {
            this.WindowState = FormWindowState.Minimized;
        }
        static bool deleteFile(string f)
        {
            try
            {
                File.Delete(f);
                return true;
            }
            catch (IOException)
            {
                return false;
            }
        }
        private void button1_MouseEnter(object sender, EventArgs e)
        {
            strtGameBtn.Cursor = System.Windows.Forms.Cursors.Hand;
            strtGameBtn.Image = global::Launcher.Properties.Resources.button_play_hover;
        }
        private void button1_MouseLeave(object sender, EventArgs e)
        {
            strtGameBtn.Image = global::Launcher.Properties.Resources.button_play_normal;
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Process.Start("http://xtremedekarononline.com");
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Process.Start("http://xtremedekarononline.com/registro.php");

        }

        private void IsProcessRunning()
        {
            string sProcessName = "universal";            
            System.Diagnostics.Process[] proc = System.Diagnostics.Process.GetProcessesByName(sProcessName);
            if (proc.Length > 0)
            {
                MessageBox.Show("universal.exe is running!" + "\n" + "Please close your client, and run the launcher again.", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                System.Environment.Exit(1);
            }
        }
        private void CheckDll()
        {
            if (!File.Exists("Ionic.Zip.dll"))
            {
                MessageBox.Show("Ionic.Zip.dll not found!", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                System.Environment.Exit(1);
            }
        }



    }
}