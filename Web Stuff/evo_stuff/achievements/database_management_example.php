<?php
/**
 * CoffeeCup Flash Form Builder: Database Management Example
 *
 * @author Jeff Welch <jw@coffeecup.com>
 * @version 2.1
 * @package CC_FB
 */

   // EDIT YOUR DATABASE FIELDS HERE
   //-------------------------------
   $database_host = 'xxxxxxx';
   $database_port = '3306';
   $database_username = 'xxxxxxx';
   $database_password = 'xxxxxxx';
   $database_name = 'xxxxxxx';
   $database_table = 'xxxxxxx';      
   
   // DO NOT EDIT ANYTHING BELOW THIS LINE
   //-------------------------------------
   // Error reporting should be disabled in favor of
   // our customer error messages.
   error_reporting(0);
      
   // Let's make sure they are running PHP version 4.3.0 or greater. 
   if(!version_compare(PHP_VERSION, '4.3.0', '>='))
   {
      printMessage('Invalid PHP Version',
         "We're sorry but this script requires PHP version 4.3.0 " .
            'or greater.  Please contact your server administrator.');
   }   
      
   // Let's make sure they actually have mysql loaded.
   if(!extension_loaded('mysql'))
   {
      printMessage('Unable to use MySQL',
         "We're sorry but you must have the MySQL extensions loaded " .
            'in your PHP configuration in order to use this script. ' .
            'Please contact your server administrator.');     
   }
   
   // Take care of magic quotes.
   if(get_magic_quotes_gpc()) 
   {
       function extended_stripslashes($value)
       {
           return is_array($value) ? 
             array_map('extended_stripslashes', $value) : stripslashes($value);
       }
       
       $_POST = array_map('extended_stripslashes', $_POST);
       $_GET = array_map('extended_stripslashes', $_GET);
   }      
   
   session_start();
   
   // Lets make sure we can start the session.
   if(!isset($_GET['start_session']) && !isset($_SESSION['logged_in']))
   {
      $_SESSION['logged_in'] = false;
      die(header("Location: {$_SERVER['SCRIPT_NAME']}?start_session"));
   }
   elseif(isset($_GET['start_session']))
   {
      if(!isset($_SESSION['logged_in']))
      {
         $error_message = "\n        <p class=\"error\">You must have " . 
            "cookies enable to use this script.</p>\n";      
      }
      else
      {      
         die(header("Location: {$_SERVER['SCRIPT_NAME']}"));
      }
   }  
   
   // If $_SESSION['logged_in'] isn't set, allow the user to login
   if($_SESSION['logged_in'] !== true)
   {
      if(isset($_POST['login']))
      {
         if($_POST['username'] == $database_username &&
            $_POST['password'] == $database_password)
         {
            $_SESSION['logged_in'] = true;
            die(header("Location: {$_SERVER['REQUEST_URI']}"));
         }
         else
         {
            $error_message = "\n        <p class=\"error\">Invalid username/" . 
               "password combination</p>\n";
            $username = htmlentities($_POST['username'], ENT_QUOTES);
         }
      }
      
      printMessage('Please Login',
         <<<EOHTML
         
    <!-- Start Login Form -->         
    <form method="post" action="" id="loginform">
    
      <fieldset>  
        
        <legend>Login Credentials</legend>
        $error_message
        <label for="username"><span>Username:</span>
           <input type="text" name="username" id="username" 
              value="$username" size="28" tabindex="1" />
        </label>

        <label for="password"><span>Password:</span>         
           <input type="password" name="password" id="password" 
              size="28" tabindex="2" />
        </label>
        
      </fieldset>

      <div>
         <input name="login" id="login" tabindex="3" 
            value="Login" type="submit" />
      </div>

    </form>
    <!-- End Login Form -->

EOHTML
         , false);
   }   
   
   // Let's make sure we can connect to their database.
   if(!($link = mysql_connect("$database_host:$database_port",
      $database_username, $database_password)))
   {
      printMessage('Unable to Connect to Database Server.',
         "We're sorry but we were unable to connect to your database " .
            'server. Please be sure you have entered your database ' .
            'settings correctly.');         
   }
   // Let's make sure we can select their database.
   // Ensure that the connection is utf8 encoded
   @mysql_query("SET NAMES 'utf8'", $link);

   // Let's make sure we can select their database.
   if(!mysql_select_db($database_name, $link))  
   {
      printMessage('Unable to select Database.',
         "We're sorry but we were unable to select your database. " .
            'Please be sure that you have the proper permissions to ' .
            'select it.  If you are still experiencing trouble, ' .
            'please contact your server administrator.');    
   }
   // Download the file if the user requested it.
   if($_GET['action'] == 'download' && trim($_GET['file']) != '')
   {
      // Make sure we can select.
      if(!($results = mysql_query('SELECT `uploaded_file` FROM ' .
         " `$database_table` WHERE `uploaded_file_name` = \"" .
            mysql_real_escape_string($_GET['file'], $link) . 
            '" LIMIT 1', $link)))
      {
         printMessage('Unable to Query Database.',
            "We're sorry but we were unable to query your database " .
               'table. Please be sure that you have the proper ' .
               "permissions to select from the $database_table " .
               'table. If you are still experiencing trouble, ' .
               'please contact your server administrator.');           
      }
      
      // If the file doesn't exist, let the user know.
      if(mysql_num_rows($results) == 0)
      {
         printMessage('Unknown File.',
            "We're sorry but the file you have requested does not exist.");         
      }
      else
      {
         $row = mysql_fetch_assoc($results);
         
         header("Content-length: " . strlen($row['uploaded_file']));
         header("Content-type: application/octet-stream");
         header("Content-Disposition: attachment; filename=" . $_GET['file']);   
         die($row['uploaded_file']);
      }
   }
   
   // Process any mass actions
   if($_POST['mass_action'] == 'Go' && count((array)$_POST['fields']) > 0)
   {
      // Escape the keys
      $keys = implode(',', array_map('intval', $_POST['fields']));
   
      switch($_POST['action'])
      {
         case 'Delete':
            // Make sure we can delete
            if(!($results = mysql_query("DELETE FROM `$database_table` WHERE" .
               " `id` IN ($keys)", $link)))
            {
               printMessage('Unable to Delete From Database.',
                  "We're sorry but we were unable to deelte from your " .
                  'database table. Please be sure that you have the proper ' .
                  "permissions to delete from the $database_table " .
                  'table. If you are still experiencing trouble, ' .
                  'please contact your server administrator.');           
            }
            
            $rows_affected = mysql_affected_rows($link);
            $extra_message = $rows_affected . ' row' . 
               ($rows_affected != '1' ? 's were ' : ' was ') . 
               'successfully deleted';
            break;
      }
   }
   
   // Make sure we can show columns.
   if(!($results = mysql_query("SHOW COLUMNS FROM `$database_table`", 
      $link)))
   {
      printMessage('Unable to Query Database.',
         "We're sorry but we were unable to query your database " .
            'table. Please be sure that you have the proper ' .
            "permissions to select from the $database_table " .
             'table. If you are still experiencing trouble, ' .
            'please contact your server administrator.');           
   }
   
   // Get the field names.
   $columns = array();
   while($row = mysql_fetch_assoc($results))
   {
      if($row['Field'] == 'uploaded_file')
      {
         $columns[] = 'filesize';      
         $sql .= 'length(`uploaded_file`) AS filesize,';
      }
	   else
	   {
         $columns[] = $row['Field'];
         $sql .= "`{$row['Field']}`,";
      }
   }
   
   // Get the number of results to show per page
   $per_page = in_array($_GET['per_page'], array(10,20,50,100,150,200,300,500)) 
      ? $_GET['per_page'] : 10;
      
   // Get the current page in pagination
   $page = $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
   
   // Get the sort order
   if(in_array($_GET['order_by'], $columns))
   {
      $order_by = $_GET['order_by'];
      $sort_order = $_GET['sort_order'] == 'desc' ? 'DESC' : 'ASC';
      $order_by_sql = " ORDER BY `$order_by` $sort_order";
   }

   // Get the number of results.
   $results = mysql_query("SELECT COUNT(1) FROM `$database_table`", $link);
   $record_count = mysql_result($results, 0);
   $last_page = ($record_count > 0 ? ceil($record_count / $per_page) : 1);

   // Catch invalid page requests
   $page = $page > $last_page ? $last_page : $page;
   $offset = ($page - 1) * $per_page;

   // Get the form results.   
   $results = mysql_query('SELECT ' . substr($sql, 0, -1) . 
      " FROM `$database_table`$order_by_sql LIMIT $offset, $per_page", $link);
      
   printMessage("Form Results", getTable($results, $columns, $order_by, 
      $sort_order, $page, $per_page, $last_page), false, $extra_message);
   
   /**
    * Creates a results table.
    * 
    * @param resource $results the results resource
    * @param array $columns the database columns
    * @param string $order_by the column to order by
    * @param string $sort_order the order to sort by
    * @param integer $page the current page in pagination
    * @param integer $per_page the number of results to display per page
    * @param integer $last_page the last page in pagination
    * @return string
    */   
   function getTable($results, $columns, $order_by = null, $sort_order = null,
      $page = null, $per_page = null, $last_page = null)
   {      
      $table = "<form class=\"flush\">\n".
         "      <input type=\"hidden\" name=\"order_by\" value=\"" . 
            htmlentities($order_by, ENT_QUOTES) . "\" />\n" .
         "      <input type=\"hidden\" name=\"page\" value=\"$page\" />\n" .            
         "      <label><span>Sort Order:</span>\n" .
         "        <select name=\"sort_order\">\n" .
         "          <option>asc</option>\n" .          
         "          <option" . ($sort_order == 'DESC' ? 
         ' selected="selected"' : '') . ">desc</option>\n" .
         "        </select>\n" .
         "      </label>\n" .         
         "      <label><span>Per Page:</span>\n" .         
         "        <select name=\"per_page\">\n";
         
      foreach(array(10,20,50,100,150,200,300,500) as $number)
      {
         $table .= "          <option " . ($per_page == $number ?
            ' selected="selected"' : '') . ">$number</option>\n";
      }
         
      $table .= "        </select>\n" .
         "      </label>\n" .
         "      <input class=\"button\" type=\"submit\" name=\"format\" " .
         "value=\"Go\" />\n    </form>\n\n" .
         "    <form id=\"action_form\" method=\"post\" action=\"\">\n\n" .
         getPagination($page, $per_page, $last_page) .
         "\n\n    <table id=\"results_table\">\n      <tr>\n        <th>" . 
         "<input id=\"select_all\" type=\"checkbox\" name=\"select_all\" " . 
         "value=\"y\"/></th>";
         
      foreach($columns as $column)
      {
         $table .= "\n        <th>" . ($order_by != $column ?
            "<a href=\"?order_by=" . 
            htmlentities(urlencode($column), ENT_QUOTES) 
            . "&amp;per_page=$per_page&amp;sort_order=" . 
            strtolower($sort_order) . "&amp;page=$page" .
            "\">" . htmlentities($column, ENT_QUOTES) . "</a>" : 
            htmlentities($column, ENT_QUOTES)) . '</th>';
      }
      
      $rows = mysql_num_rows($results);
      $fields = mysql_num_fields($results);
      
      while($row = mysql_fetch_assoc($results))
      {
         $table .= "\n      <tr class=\"" . (++$i % 2 != 0 ? 'odd' : 'even') . 
            "\">\n        <td><input type=\"checkbox\" name=\"fields[]\" " .
            "value=\"{$row['id']}\" /></td>";
            
         foreach($row as $key => $value)
         {
            $table .= "\n        <td>";
            if($value == '')
            {
               $table .= '&nbsp;';
            }
            else
            {
               if($key == 'uploaded_file_name')
               {
                  $table .= 
                     '<a href="?action=download&amp;file=' . 
                     htmlentities(urlencode($value), ENT_QUOTES) .
                     '">' . htmlentities($value, ENT_QUOTES) . '</a>';
               } 
               elseif($key == 'filesize')
               {
                  $table .= htmlentities(humanSize($value), ENT_QUOTES);               
               }
               else
               {
                  $table .= htmlentities($value, ENT_QUOTES);
               }
            }
            $table .= '</td>';
         }
         $table .= "\n      </tr>";
      }
      
      // If we have rows, add mass actions
      if($rows > 0)
      {
         $table .= "\n      <tr class=\"action_row\">\n" .
            "        <td colspan=\"" . ($fields + 1) . "\">\n" .
            "          <label><span>Mass Action:</span>\n" .
            "            <select name=\"action\">\n" .
            "              <option>-- Choose One --</option>\n" .         
            "              <option>Delete</option>\n" .                  
            "            </select>\n" .
            "          </label>\n          " .
            "<input type=\"submit\" name=\"mass_action\" value=\"Go\" />\n" .
            "        </td>\n      </tr>\n    ";
      }

      return $table . "</table>\n\n" . 
         getPagination($page, $per_page, $last_page) . " \n\n   </form>\n";
   }
   
   /**
    * Gets the human-readable size for a size in bytes.
    * 
    * @param int $size the size in bytes
    * @return string
    */   
   function humanSize($size)
   {
      if(($human_size = $size / 1048576) > 1) 
      { 
         return round($human_size, 1) . ' MB'; 
      }
      elseif(($human_size = $size / 1024) > 1) 
      {
         return round($human_size, 1) . ' KB'; 
      }
      else 
      {
         return round($size, 1) . ' Bytes';
      }
   }
   
   /**
    * Creates pagination for the results
    * 
    * @param integer page the current page in pagination
    * @param integer perPage the number of results to display per page
    * @param integer lastPage the last page in pagination   
    * @return string
    */   
   function getPagination($page = null, $per_page = null, $last_page = null)
   {   
      // Remove the page portion from the url
      $base_url = htmlentities(preg_replace("/(\?|\&)page=\d+/", 
         '', $_SERVER['REQUEST_URI']), ENT_QUOTES);
      $base_url .= (strpos($base_url,'?') !== false ? '&amp;' : '?');
    
      // Calculate the previous and next pages
      $previous_page = $page - 1;
      $next_page = $page != $last_page ? $page + 1 : false;
    
      $return = "<div class=\"page_information\">\n" .
         "<p class=\"current\">Page: $page</p>\n";
    
      // Don't display pagination if there is only one page
      if($last_page == 1)
      {
         return $return . '</div>';
      }
    
      $return .= "<span class=\"pagination\">\n";
      $return .= ($previous_page ? "<a href=\"{$base_url}page=1\" " .
         "class=\"first_page\">&laquo;</a>" : 
         "<span class=\"first_page\">&laquo;</span>") . "\n";
      $return .= ($previous_page ? "<a href=\"{$base_url}page=$previous_page\"". 
         " class=\"previous_page\">Prev</a>" : 
         "<span class=\"previous_page\">Prev</span>") . "\n";

      if($page > 1)
      {
         foreach(range(($page > 2 ? $page - 2 : 1),$page - 1) as $value)
         {
            $return .= "<a href=\"{$base_url}page=$value\" " .
               "class=\"page_{$value}\">$value</a>\n";
         }
      }

      $return .= "<span class=\"current_page\">$page</span>\n";

      if($page < $last_page)
      {
         foreach(range($page + 1, ($page + 2 > $last_page ? 
            $last_page : $page + 2)) as $value)
         {
            $return .= "<a href=\"{$base_url}page=$value\" " .
               "class=\"page_{$value}\">$value</a>\n";
         }          
      }

      $return .= ($next_page ? "<a href=\"{$base_url}page=$next_page\" " .
         "class=\"next_page\">Next</a>" : 
         "<span class=\"next_page\">Next</span>");
      $return .= "\n" . ($next_page ? "<a href=\"{$base_url}page=$last_page\"" . 
         " class=\"last_page\">&raquo;</a>" : 
         "<span class=\"last_page\">&raquo;</span>");
      return "{$return}\n</span>\n</div>";
   }

   /**
    * Prints a message to the screen.
    *
    * NOTE: This function stops execution of the script.
    * 
    * @param string $title the title of the page
    * @param string $message the message to print to the screen
    * @param boolean $html_encode whether or not to encode the message
    * @param string $extra_message an extra message
    */
   function printMessage($title = null, $message = null, $html_encode = true,
      $extra_message = null)
   {
      // Html-encode if necessary
      if($html_encode)
      {
         $message = '<p>' . htmlentities($message, ENT_QUOTES) . '</p>';
      }   
   
      // If the user has provided a title, format it for HTML
      if($title !== null)
      {
         $title = htmlentities($title, ENT_QUOTES);      
         $page_title = "$title - ";      
         $title = "<h1>$title</h1>";
      }
      
      if($extra_message !== null)
      {
         $extra_message = "<p class=\"extra_message\">$extra_message</p>";
      }
           
      die( <<<EOHTML
<?xml version="1.0" encoding="utf-8"?>      
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">      
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>{$page_title}CoffeeCup Form Builder Manager</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="robots" content="noindex,nofollow" />
  <style type="text/css">
   <!--
    table 
    {
       border-collapse: collapse;  
       clear:           both;
    }
    
    th
    {
       background-color: #d3dce3;    
    }
    
    th, td
    {
       padding:    .5em;
       border:     1px solid #fff;    
       text-align: left;
    } 
    
    tr.odd
    {
       background-color: #e5e5e5;
    }
    
    tr.even
    {
       background-color: #d5d5d5;
    }
    
    tr:hover
    {
       background-color: #cfc;
    }
    
    tr.action_row, tr.action_row:hover
    {
       background-color: #eee;
    }    
    
    tr.action_row form
    {
       padding: 10px;
    }
    
    label span
    {
       display:        block;
       padding-bottom: 5px;       
       font-weight:    bold;
    }
    
    #loginform
    {
       padding-top: 10px;
       margin-top:  -10px;
       border-top:  1px #ccc solid;
    }
    
    #loginform p.error
    {
       padding:          1em;
       margin-top:       0;       
       color:            #600;
       border:           1px solid #600;
       background-color: #fee;
    }
    
    #loginform fieldset
    {
       border: 0;
    }
    
    #loginform fieldset label span
    {
       display: block;
    }
    
    #loginform fieldset input
    {
       display: block;
       margin:  .5em 0 1em;
    }
    
    #loginform fieldset legend
    {
       display: none;
    }
    
    .extra_message
    { 
       padding:          25px 10px 25px; 
       margin:           20px 0 10px; 
       border:           1px solid #006600; 
       background-color: #cfc;
       font-weight:      bold; 
       font-size:        1.5em; 
       color:            #060; 
    } 
    
    .flush
    { 
       height:           50px; 
       padding:          10px; 
       margin:           10px 0; 
       background-color: #f2f2f2; 
       border-bottom:    1px #999 solid; 
       border-top:       1px #999 solid;
    }
    
    .flush label
    { 
       float:        left; 
       display:      block; 
       font-weight:  bold; 
       margin-right: 20px; 
       color:        #444; 
    }
    
    .flush span           
    { 
       display:       block; 
       padding-right: 5px; 
    }
    
    .flush input, .flush select, .flush textarea              
    { 
       display: inline; 
       width:   auto; 
       margin:  0 10px 0 0; 
    }
    
    .flush .button
    { 
       margin: 23px 0 0 0;
    }
    
    .pagination
    {
       float:   right; 
       display: block; 
       padding: 10px 5px 20px;    
    }
    
    .pagination * 
    { 
       border:    solid 1px #dedede; 
       font-size: .9em;
    }
    
    .pagination span             
    { 
       color:   #999; 
       padding: 6px; 
    }

    .pagination .current_page    
    { 
       color:       #000; 
       font-size:   1em;  
       font-weight: bold; 
       border:0; 
    }

    .pagination a:link, .pagination a:visited        
    { 
       color:     #444; 
       padding:   6px; 
    }
    
    .pagination a:hover
    { 
       background:#ff9; 
    }
    
    .page_information .current    
    { 
       float:       left; 
       margin:      0; 
       font-weight: bold; 
       padding:     10px 5px;
    }
   -->
  </style>  
  <script type="text/javascript">
  //<![CDATA[  

  window.onload = function() 
  {
    if(document.getElementById && document.getElementsByTagName)
    {
       // Add functionality for select_all checkbox
       document.getElementById('select_all').onclick = function() 
       {
          var inputs = document.getElementsByTagName('input');

          for(var i = 0; i < inputs.length; i++)
          {
             if(inputs[i].getAttribute('type') == 'checkbox')
             {
                inputs[i].checked = this.checked;
             }
          }
       }
       
       // Make sure users are warned before a mass action
       document.getElementById('action_form').onsubmit = function() 
       {
          return confirm('Are you sure you want to take this action?');
       }
    }
  }

  //]]>
  </script>    
</head>

<body>
  <div id="wrapper">
    $title
    $extra_message
    $message
  </div>
</body>

</html>      
EOHTML
      );
   }
?>