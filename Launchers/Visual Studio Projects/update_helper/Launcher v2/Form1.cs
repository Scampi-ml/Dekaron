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
            if (!File.Exists("EarlyLauncher_new.exe"))
            {
                MessageBox.Show("EarlyLauncher_new.exe not found! Cannot update it.", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                Application.Exit();
            }
            else
            {
                System.Threading.Thread.Sleep(2000);

                string Root = AppDomain.CurrentDomain.BaseDirectory;
                string OldExe = Root + "EarlyLauncher.exe";
                string NewExe = Root + "EarlyLauncher_new.exe";

                try
                {
                    File.Delete(OldExe);
                }
                catch
                {
                    MessageBox.Show("Cannot delete the old launcher.", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                    Application.Exit();
                }

                try
                {
                    File.Move(NewExe, OldExe);
                }
                catch
                {
                    MessageBox.Show("Cannot rename the new launcher.", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                    Application.Exit();
                }

                label1.Text = "Launcher successfully updated!";

                System.Threading.Thread.Sleep(2000);

                System.Diagnostics.Process.Start(OldExe);
                Application.Exit();
            }
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }
    }
}
