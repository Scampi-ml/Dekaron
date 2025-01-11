using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Diagnostics;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace Launcher
{
    public partial class Form2 : Form
    {
        public string Root = AppDomain.CurrentDomain.BaseDirectory; // root to current dir

        public Form2()
        {
            InitializeComponent();
        }

        private void Form2_Load(object sender, EventArgs e)
        {
        }

        private void button1_Click(object sender, EventArgs e)
        {
         
            // Compare the previous loop to a similar for loop. 
            for (int i = 0; i < numericUpDown1.Value; i++)
            {
                Process.Start(Root + "\\bin\\dekaron9.exe");  
            }

            if( checkBox1.Checked )
            {
                System.Environment.Exit(1);
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}
