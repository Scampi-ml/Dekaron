<?php
/**
 * CoffeeCup Flash Form Builder: Form Results Handler
 *
 * This file is in charge of handling the form results
 * posted from the CoffeeCup Flash Form Builder SWF.  
 * It has several primary functions:
 *
 * - Assure that the user is running the proper version of
 *   PHP and has properly configured their server for
 *   CoffeeCup Flash Form Builder by uploading the provided
 *   files and assigning the appropriate server settings
 *   and permissions.
 * - Upload a file if the '$_FILES['Filedata']' variable is
 *   populated
 * - If the '$_POST' superglobal array has been populated,
 *   process the form by:
 *   - Reading the config file provided in the '$_POST['xmlfile']'
 *     variable.
 *   - Saving the form data to a file if the 'CC_FB_SAVE_FILE' constant
 *     has been populated.
 *   - Saving the form data to the database provided in 'CC_FB_DB_ADDRESS'
 *     if the 'CC_FB_DB_ADDRESS' constant is populated.
 *   - Emailing the form data to the form owner via the address provided
 *     in the '$_POST['_ALT_EMAIL']' variable or the '$_POST['mailto']'
 *     variable if the '$_POST['_ALT_EMAIL']' variable is not populated.
 *   - Emailing the form data to the form user via the address provided in
 *     the '$_POST['eM']' variable if the '$_POST['eM']' variable has been 
 *     populated and the 'emailuser' config option is set to 'true'.
 *   - Taking the form user to the landing page provided in the
 *     '$_POST['thankyoupage']' variable or to a default landing page
 *     if the '$_POST['thankyoupage']' is empty.
 * - Prints out an informational page with version numbers and release
 *   dates if an error occurs or if this script is called without
 *   the '$_POST' superglobal or the '$_FILES['Filedata']' variables
 *   being set.
 *
 * @license http://www.coffeecup.com/legal/eula.html  
 * @author Jeff Welch <jw@coffeecup.com>
 * @version 4.0
 * @package CC_FB
 */
  
   // Error reporting should be disabled in favor of
   // our customer error messages.
   error_reporting(0);
   
   /**
    * The version of CoffeeCup Flash Form Builder that
    * generated this script.
    */
   define('CC_FB_VERSION', '8.0');
   /**
    * The release date of the version of CoffeeCup Flash Form
    * Builder that generated this script.
    */
   define('CC_FB_LAST_UPDATED', '02/09/2010');
   
   /**
    * The version of this script.
    */
   define('CC_FB_SCRIPT_VERSION', '5.1');
   /**
    * The release date of this script.
    */
   define('CC_FB_SCRIPT_LAST_UPDATED', '02/09/2010');
   
   /**
    * Will the owner of this form be emailed the 
    * form data
    */
   define('CC_FB_DO_EMAIL',false);       
   /**
    * To default To address.
    */   
   define('CC_FB_TO_EMAIL', '');
   /**
    * The default CC address.
    */   
   define('CC_FB_CC_EMAIL', ''); 
   /**
    * The default BCC address.
    */   
   define('CC_FB_BCC_EMAIL', '');
   /**
    * The message to send to the form owner
    */  
   define('CC_FB_OWNER_MESSAGE', '[FORMOWNERMSG]');   
   
   /**
    * If we should send a message back to the user.
    */     
   define('CC_FB_AUTO_REPLY', false);
   /**
    * The subject of the message to be sent to the user.
    */  
   define('CC_FB_AUTO_REPLY_SUBJECT', '');   
   /**
    * If we should include the form results 
    * in the message we send to the user.
    */  
   define('CC_FB_AUTO_REPLY_FORM_RESULTS', false);
   /**
    * The position of the auto-reply message
    * in the email.
    */  
   define('CC_FB_AUTO_REPLY_POSITION', 'bottom');
   
   /**
    * The page to redirect to after the form is submitted.
    */  
   define('CC_FB_RESULTS_REDIRECT', '[RESULTSREDIRECT]');
   
   /**
    * The address of the database where the form results 
    * will be saved.
    */
   define('CC_FB_DB_ADDRESS', 'remote-mysql4.servage.net');
   /**
    * The port number of the database where the form results 
    * will be saved.
    */
   define('CC_FB_DB_PORT', '3306');     
   /**
    * The username for the database where the form results 
    *  will be saved.
    */
   define('CC_FB_DB_USERNAME', 'c0d3r3d10');
   /**
    * The password for the database where the form results
    * will be saved.
    */
   define('CC_FB_DB_PASSWORD', '7rutRUpH');
   /**
    * The name of the database where the form results
    * will be saved.
    */
   define('CC_FB_DB_NAME', 'c0d3r3d10');
   /**
    * The name of the database table where the form results
    * will be saved.
    */
   define('CC_FB_DB_TABLE', 'uninstall');      

   /**
    * The file to log the form results to if necessary.
    */   
   define('CC_FB_SAVE_FILE', '[FILENAME]');
   
   /**
    * The filetypes that are acceptable for file uploads.
    */
   define('CC_FB_ACCEPTABLE_FILE_TYPES', 'txt|gif|jpg|jpeg|zip|doc|png|pdf|rtf|html|docx|xslx');
   /**
    * The directory where files are uploaded
    */
   define('CC_FB_UPLOADS_DIRECTORY', 'files');
   /**
    * The extension that gets added to file uploads
    */
   define('CC_FB_UPLOADS_EXTENSION', '_fbu');   
   /**
    * Will we save the file uploads to the server
    */   
	define('CC_FB_ATTACHMENT_SAVETOSERVER',true); 
   /**
    * Will we save the file uploads to the db
    */   
   define('CC_FB_ATTACHMENT_SAVETODB',true);
   /**
    * Will we send the file upload as an attachment
    */   
   define('CC_FB_ATTACHMENT_ADDTOEMAIL',false);
   /**
    * Sendmail Message EOL's
    */   
   define('CC_FB_SENDMAIL_EOL',"\r\n");

   // Makes sure that the user is using the required version
   // of PHP as specified by {@link CC_FB_PHP_VERSION}.
   if(!version_compare(PHP_VERSION, CC_FB_PHP_VERSION, '>='))
   {
      printMessage('Invalid PHP Version',
         "We're sorry but CoffeeCup Form Builder requires PHP version " .
            CC_FB_PHP_VERSION . ' or greater.  Please contact your server ' .
            'administrator.');
   }
   // Strip slashes if the server has magic quotes enabled.
   if(get_magic_quotes_gpc()) 
   {
      $_POST = array_map("stripslashes", $_POST);
   }
   // John will need to fix this in the swf file.
   foreach($_POST as $key => $value)
   {
      $_POST[str_replace('_', ' ', $key)] = $value;
   }   
   // Let's sanitize some header fields before it gets us in any trouble.
   foreach(array('eM','_ALT_EMAIL','subject') as $key)
   {
      if(isset($_POST[$key]))
      {
         $_POST[$key] = headerEscape($_POST[$key]);
      }
   }
   // Let's make sure no one is trying to do anything funky with filenames.
   if(isset($_POST['Uploaded_File']))
   {
      $_POST['Uploaded_File'] = filenameEscape($_POST['Uploaded_File']);
   }
   if(isset($_FILES['Filedata']['name']))
   {
      $_FILES['Filedata']['name'] = filenameEscape($_FILES['Filedata']['name']);
   }
   
   // If the '$_FILES['Filedata']' is populated, process the
   // file upload.
   if(isset($_FILES['Filedata']))
   {
      processFileUpload();
   }
   // If the '$_POST' superglobal array is populated,
   // process the form results.
   elseif(is_array($_POST) && count($_POST) > 0)
   {
      processMailForm();
   }
   // If all else fails, print out a blank page with version
   // numbers and release dates.
   printMessage();


   /**
    * Process the mail form results.
    *
    * This method is in charge of processing the mail form which
    * is posted from the CoffeeCup Flash Form Builder SWF.  This
    * process includes:
    * 
    * - Retrieving the preferences from the included CoffeeCup Flash
    *   Form Builder XML preferences file.
    * - Formats output for file output as well as for an email to
    *   the form user and the form owner as necesarry.
    * - Writes output to a file and sends it to the form user and
    *   the form owner as necessary.
    * - Writes form results to a database if necesarry.
    */
   function processMailForm()
   {
      fixUploadedFileName();
      $preferences = getPreferences();

      foreach($preferences['form_fields'] as $key => $value)
      {
         if(trim($_POST[$key]) != '')
         {
            $owner_email_response .= "$key: {$_POST[$key]}\n\n";
            $txt_file .= "$key: {$_POST[$key]}|";
            
            // Make sure we aren't displaying hidden fields
            // to end-users
            if($value['type'] != 'hiddenfield')
            {
               $user_email_response .= "$key: {$_POST[$key]}\n\n";
               $form_response .= "$key: {$_POST[$key]}<br/>\n";
            }
         }
      }
      
      // If a file was uploaded, add the appropriate data to the response
      // fields
      if($_POST['Uploaded_File'] != "")
      {
         $owner_email_response .= "Uploaded File: {$_POST['Uploaded_File']}";
         $user_email_response .= "Uploaded File: {$_POST['Uploaded_File']}";
         
         $form_response .= "    Uploaded File: {$_POST['Uploaded_File']}" . 
            "<br/>\n";
         $txt_file .= "Uploaded File: {$_POST['Uploaded_File']}|";           
      }
      
      sendResponseEmails($owner_email_response, $user_email_response, 
         $preferences);
      writeResponseToFile($txt_file);
      writeResponseToDatabase($preferences);
      
      // Make sure we delete the file from the server if the user doesn't
      // want it
      if(!CC_FB_ATTACHMENT_SAVETOSERVER && $_POST['Uploaded_File'] != '')
      {
         @unlink(CC_FB_UPLOADS_DIRECTORY . "/{$_POST['Uploaded_File']}");
      }      
      
      printResponsePage($form_response, $preferences);
   }


   /**
    * Send response emails to the appropriate recipients.
    *
    * Sends an email to the scripts owner as well as the end-user
    * if appropriate.  If the sending of mail fails, an error
    * message will be printed out to the screen.
    * 
    * @param string $owner_email_response the message to mail to the owner.
    * @param string $user_email_response the message to mail to the user.
    * @param array $preferences the CoffeeCup Flash Form Builder Preferences.
    */      
   function sendResponseEmails($owner_email_response, $user_email_response, 
      $preferences)
   {      
      // If the program is unregistered, add the unregistered message.
      if($_POST['unreg'])
      {
         $unreg = "------------------------\n" .
            "This Form was sent to you using CoffeeCup Form Builder." . 
            "\nPlease tell a friend about us: " . 
            "http://www.coffeecup.com/form-builder/"; 
      }    
      
      // Set up the CC field if necessary
      if(CC_FB_CC_EMAIL != '')
      {
         $cc = 'Cc: ' . CC_FB_CC_EMAIL . CC_FB_SENDMAIL_EOL;
      }
      
      // Set up the BCC field if necessary 
      if(CC_FB_BCC_EMAIL != '')
      {
         $bcc = 'Bcc: ' . CC_FB_BCC_EMAIL . CC_FB_SENDMAIL_EOL;
      }
      
      // Use the alternative email if one is provided
      $mail_to = ($_POST['_ALT_EMAIL'] != '' ? $_POST['_ALT_EMAIL'] : 
         CC_FB_TO_EMAIL);
         
      // Set a default subject if one is not provided
      $subject = ($_POST['subject'] != '' ? parseMessage($_POST['subject'], $preferences) : 
         'Form Submission');   
                  
      // Set up the default mail headers   
      $headers = 'MIME-Version: 1.0' . CC_FB_SENDMAIL_EOL .
         'Content-Type: text/plain; charset=utf-8' . CC_FB_SENDMAIL_EOL .
         'Content-Transfer-Encoding: 7bit' . CC_FB_SENDMAIL_EOL;             
      
      // Set up the default owner message if on is not provided
      if(CC_FB_OWNER_MESSAGE == '[FORMOWNERMSG]')
      {
         $form_owner_msg =  
            'Here is the information submitted to ' . 
            "{$_SERVER['SERVER_NAME']}{$_SERVER['PHP_SELF']} from " .
            "{$_SERVER['REMOTE_ADDR']} on " . date("l, F dS, Y \a\\t g:i a") . 
            ".\n------------------------\n$owner_email_response$unreg";
      }
      else
      {
         $form_owner_msg = parseMessage(CC_FB_OWNER_MESSAGE, $preferences);
      }
            
      // Add the uploaded file as an attachment if the user has
      // request we do so
      if(CC_FB_ATTACHMENT_ADDTOEMAIL && $_POST['Uploaded_File'] != '')
      {
         if(!($contents = 
            file_get_contents(CC_FB_UPLOADS_DIRECTORY . 
               "/{$_POST['Uploaded_File']}")))
         {
            printMessage('Unable To Open Attachment File',"We're sorry but "  .
               'we were unable to open your uploaded file to attatch it for ' .
               'email. Please be sure that you have the proper permissions.');
         }
         
         $attachment = chunk_split(base64_encode($contents));
    
         // Setup the unique mime boundary
         $mime_boundary = md5(time());                 
    
         // Set up the form owner mail headers   
         $form_owner_headers = 'MIME-Version: 1.0' . CC_FB_SENDMAIL_EOL .
            'Content-Type: multipart/mixed; ' .
            "boundary=\"$mime_boundary\"" .
             CC_FB_SENDMAIL_EOL;                        
         
         // Set up the new form owner message
         $form_owner_msg = 
            CC_FB_SENDMAIL_EOL .
            "--$mime_boundary" . CC_FB_SENDMAIL_EOL .
            'Content-Type: text/plain; charset=utf-8' . CC_FB_SENDMAIL_EOL .
            'Content-Transfer-Encoding: 7bit' .
            CC_FB_SENDMAIL_EOL. CC_FB_SENDMAIL_EOL .  
            $form_owner_msg .
            CC_FB_SENDMAIL_EOL. CC_FB_SENDMAIL_EOL .
            "--$mime_boundary" . CC_FB_SENDMAIL_EOL .          
            'Content-Type: application/octet-stream ' .
            "name=\"{$_POST['Uploaded_File']}\"" . CC_FB_SENDMAIL_EOL . 
            "Content-Transfer-Encoding: base64" . CC_FB_SENDMAIL_EOL . 
            "Content-Description: {$_POST['Uploaded_File']}" . 
            CC_FB_SENDMAIL_EOL .  
            "Content-Disposition: attachment; " .
            "filename=\"{$_POST['Uploaded_File']}\"" . 
            CC_FB_SENDMAIL_EOL . CC_FB_SENDMAIL_EOL  .
            "$attachment" . CC_FB_SENDMAIL_EOL. CC_FB_SENDMAIL_EOL;             
            "--$mime_boundary--" .
            CC_FB_SENDMAIL_EOL . CC_FB_SENDMAIL_EOL;                  
      }
      else
      {
         $form_owner_headers = $headers;
      }
   
      // If we collected the end-user's email
      if($_POST['eM'])
      {      
         // Get all the headers without the From: portion
         // so that we can do something fancy if the first
         // attempt to send the message fails
         $headers_without_from = 
            "Reply-To: {$_POST['eM']}" . CC_FB_SENDMAIL_EOL .
            "Return-Path: {$_POST['eM']}" . CC_FB_SENDMAIL_EOL .           
            "$cc$bcc" .
            'Message-ID: <' . time() . "-{$_POST['eM']}>" . CC_FB_SENDMAIL_EOL .
            'X-Mailer: PHP v' . phpversion() . CC_FB_SENDMAIL_EOL .                  
            $form_owner_headers;
      
         // Send a message to the form's owner with the end-user's email
         // as the reply-to address.
         if(CC_FB_DO_EMAIL && 
            !(mail($mail_to,$subject, $form_owner_msg,
            "From: {$_POST['eM']}" . CC_FB_SENDMAIL_EOL .
            $headers_without_from)) && 
            !(mail($mail_to,$subject, $form_owner_msg,
            'From: CoffeeCup Flash Form Builder ' .
            "<formbuilder@{$_SERVER['SERVER_NAME']}>" . CC_FB_SENDMAIL_EOL .
            $headers_without_from)))
         {
            printMessage('Unable To Send E-Mail',
               "We're sorry but we were unable to send your e-mail. " .
                  'If you are sure that you entered all your email ' .
                  'addresses properly, you should contact your server ' .
                  'administrator.');         
         }
         
         // If necesarry, send a message to the end-user as well.
         if(CC_FB_AUTO_REPLY)
         {
            $form_user_msg = parseMessage('', $preferences);
            $form_user_subject = parseMessage(CC_FB_AUTO_REPLY_SUBJECT, $preferences);
         
            if(CC_FB_AUTO_REPLY_FORM_RESULTS)
            {
               $form_user_msg = CC_FB_AUTO_REPLY_POSITION == 'top' ? 
                  "$form_user_msg\n\n$user_email_response" : 
                  "$user_email_response\n\n$form_user_msg";
            }

            // Get all the headers without the From: portion
            // so that we can do something fancy if the first
            // attempt to send the message fails
            $headers_without_from = 
               "Reply-To: $mail_to" . CC_FB_SENDMAIL_EOL .
               "Return-Path: $mail_to" . CC_FB_SENDMAIL_EOL .
               'Message-ID: <' . time() . "-$mail_to>" . 
               CC_FB_SENDMAIL_EOL .
               'X-Mailer: PHP v' . phpversion() . CC_FB_SENDMAIL_EOL .                     
               $headers;

            mail($_POST['eM'],$form_user_subject,
               "$form_user_msg$unreg",
               "From: $mail_to" . CC_FB_SENDMAIL_EOL .
               $headers_without_from) ||
            mail($_POST['eM'],$form_user_subject,
               "$form_user_msg$unreg",
               "From: {$_SERVER['SERVER_NAME']} Form " .
               "<forms@{$_SERVER['SERVER_NAME']}>" . CC_FB_SENDMAIL_EOL .
               $headers_without_from);
         }
      }
      // Send a message to the form's owner.
      elseif(CC_FB_DO_EMAIL && !(mail($mail_to,$subject,
         $form_owner_msg,
            'From: CoffeeCup Flash Form Builder ' .
            "<formbuilder@{$_SERVER['SERVER_NAME']}>" . CC_FB_SENDMAIL_EOL .
            "$cc$bcc" .
            'Message-ID: <' . time() . 
            "-formbuilder@{$_SERVER['SERVER_NAME']}>" . CC_FB_SENDMAIL_EOL .
            'X-Mailer: PHP v' . phpversion() . CC_FB_SENDMAIL_EOL .                
            $form_owner_headers)))
	   {
         printMessage('Unable To Send E-Mail',
            "We're sorry but we were unable to send your e-mail. " .
               'If you are sure that you entered all your email ' .
               'addresses properly, you should contact your server ' .
               'administrator.');      	       
	   }   
   }
   

   /**
    * Parses owner-defined email message
    *
    * Loops through posted form values and replaces all form
    * elements in the $message with their corresponding values.
    * 
    * @param string $message an owner-defined email message
    * @param array $preferences the CoffeeCup Flash Form Builder Preferences.
    */     
   function parseMessage($message, $preferences)
   {
      foreach($preferences['form_fields'] as $key => $value)
      {
         $message = str_replace('[' . $key . ']', $_POST[$key], $message);
      }
      
      return $message;
   }


   /**
    * Gets the real name of the file that was uploaded.
    *
    * Since the file upload occurs in a different request,
    * this method helps us resolve what the name of the 
    * uploaded file was in case it was renamed.
    */ 
   function fixUploadedFileName()
   {
      if($_POST['Uploaded_File'] != '')
      {
         $extension = substr($_POST['Uploaded_File'], 
            strrpos($_POST['Uploaded_File'], '.'));
         $basename = basename($_POST['Uploaded_File'], $extension);
         
         while(file_exists(CC_FB_UPLOADS_DIRECTORY . "/$basename". 
            CC_FB_UPLOADS_EXTENSION . "$i$extension"))
         {
            $new_upload_name = "$basename". CC_FB_UPLOADS_EXTENSION . 
            "$i$extension";
            $i++;            
         }
         
      }
      $_POST['Uploaded_File'] = $new_upload_name;
   }
   
   
   /**
    * Write form response to a database.
    *
    * Writes the form response to the database specified at 'CC_FB_DB_ADDRESS'
    * if appropriate.  If the database doesn't it exist, the CC_FB_DB_TABLE
    * table doesn't exist or if the CC_FB_DB_TABLE table doesn't comply with
    * the structure of the current form then the database will be restructured
    * accordingly.
    * 
    * @param array $preferences the CoffeeCup Flash Form Builder Preferences.
    */       
   function writeResponseToDatabase($preferences)
   {
      // If the CC_FB_DB_ADDRESS constant has been populated, then
      // the user wants to write their data to a database.
      if(CC_FB_DB_ADDRESS != '[ADDRESS]')   
      {
         // First and foremost, lets make sure they have the mysql extension
         // loaded.
         if(!extension_loaded('mysql')) 
         {
            printMessage('Unable to use MySQL',
               "We're sorry but you must have the MySQL extensions loaded " .
                  'in your PHP configuration in order to save your form '.
                  'results to a MySQL database. Please contact your ' .
                  'server administrator.');  	       
         }
         // Secondly, lets make sure we can connect to their database.
         elseif(!($link = 
            mysql_connect(CC_FB_DB_ADDRESS . ':' . CC_FB_DB_PORT, 
               CC_FB_DB_USERNAME, CC_FB_DB_PASSWORD)))
         {
            printMessage('Unable to Connect to Database Server.',
               "We're sorry but we were unable to connect to your database " .
                  'server. Please be sure you have entered your database ' .
                  'settings correctly.');         
         }
         
         // Ensure that the connection is utf8 encoded
         @mysql_query("SET NAMES 'utf8'", $link);

         // If we can't select their DB, lets try to create our own.
         if(!mysql_select_db(CC_FB_DB_NAME, $link))
         {
            if(!mysql_query('CREATE DATABASE ' . CC_FB_DB_NAME, $link))
            {
               printMessage('Unable to Create Database.',
                  "We're sorry but we were unable to create your database. " .
                     'If you believe the database already exists, please ' .
                     'be sure that you have the proper permissions to ' .
                     'select it.  Otherwise, please be sure that you ' .
                     'have permissions to create databases.  If you ' .
                     'are still experiencing troubles, please contact ' .
                     'your server administrator.');              
            } 
            elseif(!mysql_select_db(CC_FB_DB_NAME, $link))
            {
               printMessage('Unable to select Database.',
                  "We're sorry but we were unable to select your database. " .
                     'Please be sure that you have the proper permissions to ' .
                     'select it.  If you are still experiencing trouble, ' .
                     'please contact your server administrator.');             
            }
         }
         
         // If a form_results table exists, make sure it is in the
         // proper format.
         if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '" . CC_FB_DB_TABLE . 
            "'", $link)) != 0)
         {
            if(!($results = mysql_query('SHOW COLUMNS FROM `' . CC_FB_DB_TABLE . 
               '`', $link)))
            {
                  printMessage('Unable to Query Database.',
                     "We're sorry but we were unable to query your database " .
                        'table. Please be sure that you have the proper ' .
                        'permissions to select from the ' . CC_FB_DB_TABLE .
                        ' table. If you are still experiencing trouble, ' .
                        'please contact your server administrator.');           
            }
         
            while($row = mysql_fetch_assoc($results))
            {
	            if($row['Field'] != 'id' && $row['Field'] != 'created_at')
	            {
                  $columns[$row['Field']] = $row;
               }
            }         

            if(!formFieldsEqualsTableFields($preferences['form_fields'], 
               $columns))
            {
               archiveOldTable($link);
               createTableFromFormFields($preferences['form_fields'], $link);            
            }
         }
         // Otherwise create the CC_FB_DB_TABLE table in the proper format.
         else
         {
            createTableFromFormFields($preferences['form_fields'], $link);         
         }
         
         // If all went well, lets attempt to write the form results to
         // the database.
         foreach($preferences['form_fields'] as $field_name => $field)
         {
            $query .= "`$field_name` = " . 
               mysqlEscape($_POST[$field_name], $link) . ',';
         }
         
         // Add the uploaded file to the query if necessary
         if(CC_FB_ATTACHMENT_SAVETODB)
         {
            if($_POST['Uploaded_File'] != '')
            {
               if(!($contents = 
                  file_get_contents(CC_FB_UPLOADS_DIRECTORY . 
                     "/{$_POST['Uploaded_File']}")))
               {
                  printMessage('Unable To Open Attachment File',"We're sorry " .
                     'but we were unable to open your uploaded file to ' .
                     'attach it for email. Please be sure that you have the ' .
                     'proper permissions.');
               }
            
               $query .= '`uploaded_file_name` = ' .
                         mysqlEscape($_POST['Uploaded_File'], $link) . ',' .
                         '`uploaded_file` = ' . mysqlEscape($contents, $link) .
                         ',';
            }
            else
            {
               $query .= "`uploaded_file_name` = '',`uploaded_file` = '',";
            }
         }

         if(!mysql_query('INSERT INTO `' . CC_FB_DB_TABLE . '` SET ' . 
            $query . "`created_at` = NOW()", $link))
         {
            printMessage('Unable to Insert Into Database Table.', 
               "We're sorry but we were unable to insert the form results " . 
                  'into your database table. Please be sure that you have ' .
                  'the proper permissions to insert data into the ' .
                  CC_FB_DB_TABLE . ' table. If you are still experiencing ' .
                  'trouble, please contact your server administrator.');                
         }
      }
   }


   /**
    * Archives an old `CC_FB_DB_TABLE` table.
    *
    * Renames a form results table to CC_FB_DB_TABLE_old or 
    * CC_FB_DB_TABLE_old with a numerical value on the end of it 
    * if appropriate.
    * 
    * @param resource $link a database resource  
    */     
   function archiveOldTable($link)
   {      
      while(mysql_num_rows(mysql_query("SHOW TABLES LIKE '" . CC_FB_DB_TABLE . 
         "_old$i'", $link)) != 0)
      {
         $i++;
      }
      
      if(!(mysql_query("RENAME TABLE `" . CC_FB_DB_TABLE . "` TO `" . 
         CC_FB_DB_TABLE . "_old$i`", $link)))
      {
         printMessage('Unable to Rename Database Table.', 
            "We're sorry but we were unable to rename your database " . 
               'table. Please be sure that you have the proper ' .
               'permissions to rename the ' . CC_FB_DB_TABLE . ' table' . 
               '. If you are still experiencing trouble, please contact your ' .
               'server administrator.');  
      }
   }


   /**
    * Escapes a value for MySQL.
    *
    * Prepares a value to be used safely in a MySQL query.  If the value is 
    * numeric, it is returned.  If the value is a string, it is quoted and
    * escaped using the mysql_real_escape_string function.
    * 
    * @param mixed $value the value to be escaped
    * @param resource $link a database resource  
    * @return mixed $value the escaped value   
    */     
   function mysqlEscape($value, $link)
   {
      return ("'" . mysql_real_escape_string($value, $link) . "'");
   }
   
   
   /**
    * Escapes a header value.
    *
    * Prepares a value to be used safely in an email header.
    * 
    * @param mixed $value the value to be escaped
    * @return mixed $value the escaped value   
    */ 
   function headerEscape($value)
   {
      return preg_replace("/(\n|\r|%0A|%0D)/i", '', $value);   
   }
   
   
   /**
    * Escapes a filename value.
    *
    * Prepares a filename to be used without the need to worry
    * about directory traversal exploits.
    * 
    * @param mixed $value the value to be escaped
    * @return mixed $value the escaped value   
    */ 
   function filenameEscape($value)
   {
      return preg_replace('/[^\w\d\.]+/', '', $value);
   }   


   /**
    * Checks if the columns from a table match the the structure
    * of the fields from a form.
    * 
    * @param array $form_fields the structure from the form
    * @param array $table_fields the structure from the table
    * @return boolean $value, true if the structures are the same,
    * false if the structures are not.
    */      
   function formFieldsEqualsTableFields($form_fields, $table_fields)
   {
      // Make sure we have the proper fields for saving uploaded
      // files to the database if the user has requested we do so
      if(CC_FB_ATTACHMENT_SAVETODB)
      {
         if(array_key_exists('uploaded_file', $table_fields) && 
            array_key_exists('uploaded_file_name', $table_fields))
         {
            unset($table_fields['uploaded_file_name']);
            unset($table_fields['uploaded_file']);
         }
         else
         {
            return false;
         }
      }
   
      if(count($form_fields) != count($table_fields))
      {
         return false;
      }
      
      foreach($form_fields as $field_name => $field)
      {
         if(!is_array($table_fields[$field_name]) ||
            !(($field['type'] == 'textarea' && 
               $table_fields[$field_name]['Type'] == 'text') || 
               $table_fields[$field_name]['Type'] == 'varchar(255)'))
         {         
            return false;
         }
      }
      
      return true;
   }


   /**
    * Create a MySQL table from the form structure.
    *
    * Uses the structure of the form, pulled from the XML preferences
    * file to create a database table to store the form results.
    * 
    * @param resource $form_fields the structure of the form    
    * @param resource $link a database resource  
    */      
   function createTableFromFormFields($form_fields, $link)
   {
      mysql_query("DROP TABLE IF EXISTS `" . CC_FB_DB_TABLE . "`", $link);
      
      $query = 'CREATE TABLE `' . CC_FB_DB_TABLE . '` (
         `id` int(11) NOT NULL auto_increment,
         `created_at` DATETIME NOT NULL';
      
      if(CC_FB_ATTACHMENT_SAVETODB)
      {
         $query .= ",`uploaded_file_name` varchar(255) NOT NULL DEFAULT ''
                    ,`uploaded_file` MEDIUMBLOB NOT NULL";
      }
      
      foreach($form_fields as $field_name => $field)
      {
         $query .= ",\n `$field_name` " .
            ($field['type'] == 'textarea' ? 'text' : 'varchar(255)') .
               " NOT NULL DEFAULT ''";
      }
            
      if(!(mysql_query("$query, PRIMARY KEY(`id`))", $link)))
      {
         printMessage('Unable to Create Table.', "We're sorry but we were " .
            'unable to create a database table for your form results. ' .
               'Please be sure that you have the proper permissions to ' .
               'create tables. If you are still experiencing trouble, ' .
               'please contact your server administrator.');             
      }   
   }
   
   
   /**
    * Write form response to a log file.
    *
    * Writes the form response to the log file specified at 'CC_FB_SAVE_FILE'
    * if appropriate.  If the file writing fails, an error message will be 
    * printed out to the screen.
    * 
    * @param string $txt_file the response to write to the log file.
    */      
   function writeResponseToFile($txt_file)
   {
      $txt_file = "{$_SERVER['SERVER_NAME']}{$_SERVER['PHP_SELF']}|" . 
         date("Y-m-d H:i:s") . "|{$_SERVER['REMOTE_ADDR']}|$txt_file\n";

      // If a log file location has been set
      if(CC_FB_SAVE_FILE != '[FILENAME]')
      {
         if($handle = fopen(CC_FB_SAVE_FILE, 'a'))
         {
            if(fwrite($handle, $txt_file) === false)
            {
               printMessage('Unable To Write To File',
                  "We're sorry but we were unable to write to ".CC_FB_SAVE_FILE.
                     '. Please contact your server administrator to be sure ' . 
                     'that you have the proper permissions.');            
            }
            fclose($handle);
         }
         else
         {
            printMessage('Unable To Open File',
               "We're sorry but we were unable to open " . CC_FB_SAVE_FILE .
                  '. Please contact your server administrator to be sure ' . 
                  'that you have the proper permissions.');
         }
      }   
   }


   /**
    * Prints the HTML-formatted, form response page for the end-user.
    *
    * Writes the form response to an HTML-formatted page for the end-user
    * or redirects the user to a thank you page if specified.
    * 
    * @param string $form_response the response to write to the page.
    * @param array $preferences the CoffeeCup Flash Form Builder Preferences.
    */    
   function printResponsePage($form_response, $preferences)
   {
      // Redirect to a thank you page if the user has created one.
      if(CC_FB_RESULTS_REDIRECT != '[RESULTSREDIRECT]')
      {
         die(header('Location: ' . CC_FB_RESULTS_REDIRECT));
      }
      // Otherwise create a thank you page.
      else
      {      
         $results_msg = '<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>Form Submitted</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="robots" content="noindex,nofollow" />
  <style type="text/css">
   <!--
    body
    {
       text-align: center;
    }
    #message
    {
       width:  720px;
       margin: 0 auto;
    }
   -->
  </style>
</head>

<body>
  <h2>Thank you for your form submission!</h2>
</body>';
         die(str_replace('$form_results', $form_response, 
            $results_msg));
      }    
   }        


   /**
    * Returns the CoffeeCup Flash Form Builder Preferences.
    *
    * Opens the CoffeeeCup Flash Form Builder XML preferences file
    * and retrieves the preferences and form fields from it.  If
    * the preferences file is not found or can not be opened, an
    * error message is printed to the screen.
    * 
    * @return array $preferences an array of preferences specified
    * in the CoffeeCup Flash Form Builder XML preferences file.
    */
   function getPreferences()
   {
      if(!($contents = file_get_contents($_POST['xmlfile'])))
      {
         printMessage('Unable To Open XML File',"We're sorry but we were "  .
            'unable to locate your XML file.  Please be sure that the \'' .
               "{$_POST['xmlfile']}' is on your server in the same directory " .
               'as your other form builder files.');
      }
      
      // Strips out all the XML nodes from the preferences file.
      preg_match_all('/<([a-z]+?)\s+(.*?)>/is', $contents, $nodes);
      
      foreach($nodes[1] as $node_key => $node_value)
      {
         // Skip over item, hidden, button and label nodes, as we're not 
         // interested in them.
         if($node_value != 'item' && $node_value != 'hidden' && 
            $node_value != 'submitbutton' && $node_value != 'browsebutton' &&
            $node_value != 'label' && $node_value != 'resetbutton')
         {
            $node_array = array();
         
            // For each node, we will strip out all of the attributes
            preg_match_all('/([a-z0-9]+?)="(.*?)"/is', 
               $nodes[2][$node_key], $attributes);
            foreach($attributes[2] as $attribute_key => $attribute_value)
            {
               $node_array[$attributes[1][$attribute_key]] = 
                  html_entity_decode($attribute_value);
            }
         
            // If the node has an attribute called 'name', it is a form field.
            if(isset($node_array['name']))
            {    
               $name = $node_array['name'] . ($node_array['label'] != '' ?
                  " - {$node_array['label']}" : '');
               $preferences['form_fields'][$name] = $node_array;
               $preferences['form_fields'][$name]['type'] = $node_value;
            }
            // If the node type is 'form', it is the form preferences
            elseif($node_value == 'form')
            {
               $preferences['form_preferences'] = $node_array;
            }
            // otherwise just dump everything into a general array depending
            // on its node type.
            else
            {
               $preferences[$node_value][] = $node_array;            
            }
         } 
      }
      
      return $preferences;      
   }


   /**
    * Uploads a user-submitted file.
    *
    * Attempts to upload a user-submitted file specified in 
    * '$_FILES['Filedata']' to the 'CC_FB_UPLOADS_DIRECTORY' directory.  If the
    * file already exists, append a numeric value to the end of
    * the file name.
    */
   function processFileUpload()
   {
	   if(!ini_get('file_uploads'))
	   {
         printMessage('File Uploads Disabled',
            "We're sorry but we were unable to upload your file because " .
               'your do not have file uploads enabled.  Please contact' .
               'your server administrator.');		
	   }
	
      // Make sure we have a directory to store the file uploads
      if(!is_dir(CC_FB_UPLOADS_DIRECTORY) && 
         !mkdir(CC_FB_UPLOADS_DIRECTORY,0755))
      {
         printMessage('Directory Creation Failed',
            "We're sorry but we were unable to create a directory for " .
               'your file uploads.  Please contact your server administrator.');       
      }	
      // Make sure the file upload is of an acceptable file type
      if(CC_FB_ACCEPTABLE_FILE_TYPES != "" &&
         !preg_match('/\.('.CC_FB_ACCEPTABLE_FILE_TYPES.')$/is', 
         $_FILES['Filedata']['name']))
      {
         printMessage('Invalid File Type',
            "We're sorry but we were unable to upload your file because " .
               'the file type is not acceptable.');          
      }
      
      // Seperate the file's basename and extension so that
      // we can append numeric values on the end of the basename
      // if the file already exists.
      $extension = substr($_FILES['Filedata']['name'], 
         strrpos($_FILES['Filedata']['name'], '.'));
      $basename = basename($_FILES['Filedata']['name'], $extension);
      
      // Append number values on the end of the file name
      // if the file already exists
      while(file_exists(CC_FB_UPLOADS_DIRECTORY . "/$basename" . 
         CC_FB_UPLOADS_EXTENSION . "$i$extension"))
      {
         $i++;
      }
      
      if(!move_uploaded_file($_FILES['Filedata']['tmp_name'],
         CC_FB_UPLOADS_DIRECTORY . "/$basename". CC_FB_UPLOADS_EXTENSION . 
         "$i$extension"))
      {
         printMessage('File Upload Failed',
            "We're sorry but we were unable to upload your file.  Please " .
               'contact your server administrator.');       
      }
      chmod(CC_FB_UPLOADS_DIRECTORY . "/$basename$i$extension", 0644);
   }


   /**
    * Prints a message to the screen.
    *
    * Prints an HTML-formatted message to the screen that also contains
    * the current PHP version number the server is running, the current
    * version number and release date of this script as well as the 
    * current version number and release date of the version of CoffeeCup 
    * Flash Form Builder that generated this script.
    *
    * NOTE: This function stops execution of the script.
    * 
    * @param string $title the title of the page
    * @param string $message the message to print to the screen
    */
   function printMessage($title = null, $message = null)
   {
      // If the user has provided a title, format it for HTML
      if($title !== null)
      {
         $title = htmlentities($title, ENT_QUOTES);
         $page_title = "$title - ";      
         $title = "<h1>$title</h1>";
      }
      
      // If the user has provided a message, formit it for HTML
      if($message !== null)
      {
         $message = '<p>' . htmlentities($message, ENT_QUOTES) . '</p>';
      }
      
      die( <<<EOHTML
<?xml version="1.0" encoding="utf-8"?>      
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">      
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>{$page_title}CoffeeCup Form Builder</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="robots" content="noindex,nofollow" />
  <style type="text/css">
   <!--
    div#script_info
    {
       border-top: 1px solid #666;
       font-size:  .85em;
    }
   -->
  </style>
</head>

<body>
  $title
  $message
  <div id="script_info">
    <p>
      PHP Version: 
EOHTML
      . PHP_VERSION . '
    </p>
    <p>
     Sendmail Path: ' . ini_get('sendmail_path') . '<br />
     Sendmail From: ' . ini_get('sendmail_from') . '<br />
     SMTP: ' . ini_get('SMTP') . '<br />
     SMTP Port: ' . ini_get('smtp_port') . '
    </p>
    <p>
     MySQL: ' . (extension_loaded('mysql') ? 'Installed' : 'Not Installed') . '
    </p>
    <p>
      File Uploads: ' . (ini_get('file_uploads') ? 'On' : 'Off') . '<br />
      File Uploads Max Size: ' . ini_get('upload_max_filesize') . '<br />
      Post Max Size: ' . ini_get('post_max_size') . '</p>
    <p>
      Software Version: ' . CC_FB_VERSION . '<br />
      Software Last Updated: ' . CC_FB_LAST_UPDATED . '
    </p>
    <p>
      Script Version: ' . CC_FB_SCRIPT_VERSION . '<br />
      Script Last Updated: ' . CC_FB_SCRIPT_LAST_UPDATED  . '
    </p>' .
      <<<EOHTML

  </div>
</body>

</html>      
EOHTML
      );
   }
?>