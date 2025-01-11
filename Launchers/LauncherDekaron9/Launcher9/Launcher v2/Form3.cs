using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Diagnostics;
using System.Net;
using System.IO;

namespace Launcher
{
    public partial class Form3 : Form
    {
        public Form3()
        {
            InitializeComponent();
        }

        private void linkLabel1_LinkClicked(object sender, LinkLabelLinkClickedEventArgs e)
        {
            Process.Start("http://www.salvationdekaron.com/forums/index.php?app=tos");   
        }

        private void button1_Click(object sender, EventArgs e)
        {
            var POSTaccname = accname.Text;
            var POSTaccpasw1 = accpasw1.Text;
            var POSTaccpasw2 = accpasw2.Text;
            var POSTaccemail = accemail.Text;

            if(String.IsNullOrEmpty(POSTaccname))
            {
              MessageBox.Show("Account Name cannot be empty!","Error",MessageBoxButtons.OK,MessageBoxIcon.Error);
            }
            else if (String.IsNullOrEmpty(POSTaccpasw1))
            {
                MessageBox.Show("Password cannot be empty!", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            else if (String.IsNullOrEmpty(POSTaccpasw2))
            {
                MessageBox.Show("Confirm Password cannot be empty!", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            else if (String.IsNullOrEmpty(POSTaccemail))
            {
                MessageBox.Show("Email cannot be empty!", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            else if (!tos.Checked)
            {
                MessageBox.Show("You must agree with the terms of use!", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            else
            {
                button1.Text = "Please wait...";
                
                var request = (HttpWebRequest)WebRequest.Create("http://50.115.121.228/salvation/registera99testSalvation.php");

                var postData = "accname=" + accname.Text;
                postData += "&accpass1=" + accpasw1.Text;
                postData += "&accpass2=" + accpasw2.Text;
                postData += "&accmail=" + accemail.Text;

                var data = Encoding.ASCII.GetBytes(postData);

                request.Method = "POST";
                request.ContentType = "application/x-www-form-urlencoded";
                request.ContentLength = data.Length;

                using (var stream = request.GetRequestStream())
                {
                    stream.Write(data, 0, data.Length);
                }

                var response = (HttpWebResponse)request.GetResponse();
                var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();

                if (responseString == "Success ")
                {
                    // Close box to prevent spamming
                    this.Close();
                    MessageBox.Show(
                        "Your account was successfully created!\nYou can now login with your account.",
                        "Success",
                        MessageBoxButtons.OK,
                        MessageBoxIcon.Information
                    );
                }
                else
                {
                    MessageBox.Show(
                        responseString,
                        "Register Error",
                        MessageBoxButtons.OK,
                        MessageBoxIcon.Error
                    );
                    button1.Text = "Create Account";
                }   
            }
        }

        private void button3_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}
