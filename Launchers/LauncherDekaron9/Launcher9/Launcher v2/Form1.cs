using System;
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
        public string ServerUpdate = "http://www.salvationdekaron.com/update9/"; // server url

        XDocument serverXml = null;
        Stopwatch sw1 = new Stopwatch();      

        //RSS STUFF
        XmlTextReader rssReader;
        XmlDocument rssDoc;
        XmlNode nodeRss;
        XmlNode nodeChannel;
        XmlNode nodeItem;
        ListViewItem rowNews;

        public const int WM_NCLBUTTONDOWN = 0xA1;
        public const int HT_CAPTION = 0x2;

        [DllImportAttribute("user32.dll")]
        public static extern int SendMessage(IntPtr hWnd, int Msg, int wParam, int lParam);
        [DllImportAttribute("user32.dll")]
        public static extern bool ReleaseCapture();
        public Form1()
        {
            InitializeComponent();
            debug("InitializeComponent");

            IsProcessRunning();       
            CheckDll();

            if (File.Exists("debug.txt"))
            {
                CheckWebsiteConn();
            }

            RunRss();
            CheckForRemoteMessage();

            string GetFrameWorkVersion = System.Runtime.InteropServices.RuntimeEnvironment.GetSystemVersion();
            debug("Get .NET framework: " + GetFrameWorkVersion);

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
                    debug("Updates.xml found");
                }
                catch
                {
                    MessageBox.Show("Error retriving the XML from the update server.", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                    debug("Updates.xml not found");
                }


                FileStream fs = null;
                if (!File.Exists("version"))
                {
                    debug("Version file not found, create one!");
                    using (fs = File.Create("version")) { } // create file
                    using (StreamWriter sw = new StreamWriter("version"))
                    {
                        sw.Write("1.0");
                        debug("Write version file to 1.0");
                    }
                }

                string lclVersion;
                using (StreamReader reader = new StreamReader("version"))
                {
                    lclVersion = reader.ReadLine();
                    lVersion = lclVersion;
                    debug("Local version found: " + lVersion); // Fixed remote to local
                }
                //decimal localVersion = decimal.Parse(lclVersion);
                Version localVersion = new Version(lclVersion);

                debug("Start Foreach loop");

                foreach (XElement update in serverXml.Descendants("update"))
                {
                    string version = update.Element("version").Value;
                    string file = update.Element("file").Value;

                    //decimal serverVersion = decimal.Parse(version);
                    Version serverVersion = new Version(version);
                    string sUrlToReadFileFrom = ServerUpdate + file;
                    string sFilePathToWriteFileTo = Root + file;

                    sVersion = version;

                    debug("version: " + version);
                    debug("file: " + file);
                    debug("sUrlToReadFileFrom: " + sUrlToReadFileFrom);
                    debug("sFilePathToWriteFileTo: " + sFilePathToWriteFileTo);
                    debug("ServVer" + serverVersion + " | LocVer" + localVersion);

                    if (serverVersion > localVersion)
                    {
                        debug("-----> version does not match, update!");
                        Uri url = new Uri(sUrlToReadFileFrom);
                        System.Net.HttpWebRequest request = (System.Net.HttpWebRequest)System.Net.WebRequest.Create(url);
                        System.Net.HttpWebResponse response = (System.Net.HttpWebResponse)request.GetResponse();
                        response.Close();

                        Int64 iSize = response.ContentLength;
                        Int64 iRunningByteTotal = 0;

                        debug("response.ContentLength: " + iSize);

                        using (System.Net.WebClient client = new System.Net.WebClient())
                        {
                            debug("WebClient Active");
                            using (System.IO.Stream streamRemote = client.OpenRead(new Uri(sUrlToReadFileFrom)))
                            {
                                debug("streamRemote Active");

                                //FileStream class cannot deal with files on Internet. Per my understanding, you want to download server file to local. 
                                //So you need to define a local file path and then use this path in FileStream.
 
                                //private string localfilepath = AppDomain.CurrentDomain.BaseDirectory + "\\hello.zip";
                                //using (Stream streamLocal = new FileStream(localfilepath, FileMode.Create, FileAccess.Write, FileShare.ReadWrite))

                                using (Stream streamLocal = new FileStream(sFilePathToWriteFileTo, FileMode.Create, FileAccess.Write, FileShare.None))
                                {
                                    debug("streamLocal Active");
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

                        //unzip
                        using (ZipFile zip = ZipFile.Read(file))
                        {
                            debug("Extract zip file: " + file);
                            debug("----------------------------");
                            zip.ExtractProgress += ExtractProgress;
                            
                            foreach (ZipEntry zipFiles in zip)
                            {
                                zipFiles.Extract(Root, true);
                                downloadLbl.Text = "Updating client files...";
                            }
                            debug("----------------------------");
                        }

                        //write new version to file
                        using (StreamWriter sw = new StreamWriter("version"))
                        {
                            sw.Write(sVersion);
                            lVersion = sVersion;
                            debug("Write version file: " + sVersion);
                            downloadLbl.Text = "Updating version file...";
                        }

                        //Delete Zip File
                        deleteFile(file);
                        debug("Delete file: " + file);
                        downloadLbl.Text = "Cleaning update files...";
                    }
                    else
                    {
                        debug("-----> version does match, DONT update!");
                    }

                }// end foreach 
                debug("Stop Foreach loop");
                debug("Update Check Done");
            }
            catch(Exception ex)
            {
                MessageBox.Show(ex.Message, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                debug("!!!!! ERROR !!!!! " + "  " + ex);
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
            debug("backgroundWorker1_RunWorkerCompleted");
            
            // update launcher AFTER updates
            if (File.Exists(Root + "Dekaron9Launcher_new.exe"))
            {
                downloadLbl.Text = "New Launcher found...";

                MessageBox.Show("New Launcher found!" + "\n" + "The launcher will now close and try update.","New Launcher Update",MessageBoxButtons.OK,MessageBoxIcon.Asterisk);
                if (!File.Exists(Root + "launcher_helper.exe"))
                {
                    MessageBox.Show("launcher_helper.exe not found!" + "\n" + "Please download the launcher_helper.exe from the website and try again.","Error",MessageBoxButtons.OK,MessageBoxIcon.Error);
                }
                else
                {
                    Process.Start(Root + "\\launcher_helper.exe");
                    System.Environment.Exit(1);
                }
            }

            strtGameBtn.Image = global::Launcher.Properties.Resources.start_normal;
            strtGameBtn.Enabled = true;
            strtGameBtn.Cursor = System.Windows.Forms.Cursors.Default;
            downloadLbl.Text = "Client is updated! You can play!";
        }
        private void Form1_Load(object sender, EventArgs e)
        {
            debug("form load done");
        }
        private void strtGameBtn_Click_1(object sender, EventArgs e)
        {
            if (!File.Exists(Root + "\\bin\\dekaron9.exe"))
            {
                MessageBox.Show("bin/dekaron9.exe not found! " + "\n" + "Please make sure you have 'dekaron9.exe' in the bin folder.", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            else
            {               
                if( MultiCheckBox.Checked )
                {
                    Form2 f2 = new Form2();
                    f2.ShowDialog(); // Shows Form2
                }
                else
                {
                    Process.Start(Root + "\\bin\\dekaron9.exe");
                    System.Environment.Exit(1);
                }
            }
        }
        private void pictureBox1_Click(object sender, EventArgs e)
        {
            Process.Start("https://www.facebook.com/dekaron9");
        }
        private void pictureBox2_Click(object sender, EventArgs e)
        {
            Process.Start("https://twitter.com/dekaron9");
        }
        private void pictureBox4_Click(object sender, EventArgs e)
        {
            Process.Start("http://www.xtremetop100.com/in.php?site=1132349109");
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
            strtGameBtn.Image = global::Launcher.Properties.Resources.start_hover;
        }
        private void button1_MouseLeave(object sender, EventArgs e)
        {
            strtGameBtn.Image = global::Launcher.Properties.Resources.start_normal;
        }
        private void lstNews_Click(object sender, EventArgs e)
        {
            if (lstNews.SelectedItems.Count > 0)
            {
                Process.Start(lstNews.SelectedItems[0].SubItems[1].Text);
            }
        }
        static string EscapeXMLCharacters(string txt)
        {
            string _txt = txt.Replace("&amp;", "&").Replace("&lt;", "<").Replace("&gt;", ">").Replace("&quot;", "\"").Replace("&apos;", "'").Replace("&#38;", "&").Replace("&#60;", "<").Replace("&#62;", ">").Replace("&#34;", "\\").Replace("&#39;", "'");
            return _txt;
        }
        private void button1_Click(object sender, EventArgs e)
        {
            Process.Start("http://www.dekaron9.com/register");
            // Open register form instead of the website
            //Form3 f3 = new Form3();
            //f3.ShowDialog(); // Shows Form3
        }
        private void button2_Click(object sender, EventArgs e)
        {
            Process.Start("http://www.dekaron9.com/forums/");
        }
        private void button3_Click(object sender, EventArgs e)
        {
            Process.Start("http://www.dekaron9.com/donate");
        }
        private void button4_Click(object sender, EventArgs e)
        {
            Process.Start("http://www.dekaron9.com/account");
        }
        private void button9_Click(object sender, EventArgs e)
        {
            Process.Start("http://www.dekaron9.com");            
        }
        private void button8_Click(object sender, EventArgs e)
        {
            Process.Start("http://www.dekaron9.com/rankings");
        }
        private void button7_Click(object sender, EventArgs e)
        {
            Process.Start("http://www.dekaron9.com/");
        }
        private void button6_Click(object sender, EventArgs e)
        {
            Process.Start("http://dekaron9.com/index.php?/topic/459-dedicated-team-speak-server/");        
        }
        public void ExtractProgress(object sender, ExtractProgressEventArgs e)
        {
            if (e.EventType == ZipProgressEventType.Extracting_BeforeExtractEntry)
            {
                //filename of current extracted file
                debug(e.CurrentEntry.FileName);         
            }
        }
        public void debug(string msg)
        {
            if (File.Exists("debug.txt"))
            {          
                StreamWriter sw = File.AppendText(Root + "debug.txt");
                try
                {
                    string logLine = String.Format("{0:G}: {1}", DateTime.Now, msg);
                    sw.WriteLine(logLine);
                }
                finally
                {
                    sw.Close();
                }
            }
        }
        private void IsProcessRunning()
        {
            string sProcessName = "dekaron9";            
            System.Diagnostics.Process[] proc = System.Diagnostics.Process.GetProcessesByName(sProcessName);
            if (proc.Length > 0)
            {
                MessageBox.Show("dekaron9.exe is running!" + "\n" + "Please close your client, and run the launcher again.", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                System.Environment.Exit(1);
            }
        }
        private void CheckDll()
        {
            if (!File.Exists("Ionic.Zip.dll"))
            {
                MessageBox.Show("Ionic.Zip.dll not found!" + "\n" + "Please put 'Ionic.Zip.dll' in the same folder as launcher.exe", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                System.Environment.Exit(1);
            }
        }
        private void CheckWebsiteConn()
        {
            var url = ServerUpdate + "Updates.xml";
            try
            {
                var myRequest = (HttpWebRequest)WebRequest.Create(url);
                var response = (HttpWebResponse)myRequest.GetResponse();

                if (response.StatusCode == HttpStatusCode.OK)
                {
                    debug(string.Format("{0} is available", url));
                    MessageBox.Show(string.Format("DEBUG: {0} is available", url), "Success", MessageBoxButtons.OK, MessageBoxIcon.Asterisk);
                }
                else
                {
                    debug(string.Format("{0} Returned, but with status: {1}", url, response.StatusDescription));
                    MessageBox.Show(string.Format("DEBUG: {0} Returned, but with status: {1}", url, response.StatusDescription), "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                }
            }
            catch (Exception ex)
            {
                debug(string.Format("{0} unavailable: {1}", url, ex.Message));
                MessageBox.Show(string.Format("DEBUG: {0} unavailable: {1}", url, ex.Message), "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
        }
        private void RunRss()
        {
            lstNews.Items.Clear();
            rssReader = new XmlTextReader("http://dekaron9.com/index.php?/index/rss/forums/1-launcher/");
            rssDoc = new XmlDocument();
            rssDoc.Load(rssReader);

            for (int i = 0; i < rssDoc.ChildNodes.Count; i++)
            {
                if (rssDoc.ChildNodes[i].Name == "rss")
                {
                    nodeRss = rssDoc.ChildNodes[i];
                }
            }

            for (int i = 0; i < nodeRss.ChildNodes.Count; i++)
            {
                if (nodeRss.ChildNodes[i].Name == "channel")
                {
                    nodeChannel = nodeRss.ChildNodes[i];
                }
            }

            for (int i = 0; i < nodeChannel.ChildNodes.Count; i++)
            {
                if (nodeChannel.ChildNodes[i].Name == "item")
                {
                    nodeItem = nodeChannel.ChildNodes[i];
                    String decoded = EscapeXMLCharacters(nodeItem["title"].InnerText);
                    rowNews = new ListViewItem();
                    rowNews.Text = decoded;
                    rowNews.SubItems.Add(nodeItem["link"].InnerText);
                    lstNews.Items.Add(rowNews);
                }
            }
        }
        private void CheckForRemoteMessage()
        {
            WebClient client2 = new WebClient();
            Stream stream = client2.OpenRead(ServerUpdate + "message.txt");
            StreamReader reader2 = new StreamReader(stream);
            String content = reader2.ReadToEnd();
            String message = content.Replace("<br>", Environment.NewLine);
            MessageBox.Show(message, "Important Notice!", MessageBoxButtons.OK, MessageBoxIcon.Asterisk);
            debug("Remote message found");
        }
    }
}