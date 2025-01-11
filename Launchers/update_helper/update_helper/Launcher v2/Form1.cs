using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Diagnostics;
using System.IO;
using System.Text;
using System.Windows.Forms;

namespace Launcher_v2
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
            backgroundWorker1.RunWorkerAsync();
        }

        private void backgroundWorker1_DoWork(object sender, DoWorkEventArgs e)
        {
            if (!File.Exists("UniversalLauncher_new.exe"))
            {
                Application.Exit();
            }
            else
            {
                System.Threading.Thread.Sleep(2000);

                string Root = AppDomain.CurrentDomain.BaseDirectory;
                string OldExe = Root + "UniversalLauncher.exe";
                string NewExe = Root + "UniversalLauncher_new.exe";

                File.Delete(OldExe);
                File.Move(NewExe, OldExe);
                label1.Text = "Launcher successfully updated!";

                System.Threading.Thread.Sleep(2000);

                System.Diagnostics.Process.Start(OldExe);
                Application.Exit();
            }
        }
    }
}
