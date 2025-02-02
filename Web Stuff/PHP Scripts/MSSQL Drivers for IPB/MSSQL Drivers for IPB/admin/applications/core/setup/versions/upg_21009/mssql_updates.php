<?php
/*
+--------------------------------------------------------------------------
|   IP.Board v3.1.4
|   ========================================
|   by Matthew Mecham
|   (c) 2001 - 2004 Invision Power Services
|   http://www.invisionpower.com
|   ========================================
|   Web: http://www.invisionboard.com
|   Email: matt@invisionpower.com
|   Licence Info: http://www.invisionboard.com/?license
+---------------------------------------------------------------------------
*/

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$SQL[] = "UPDATE task_manager SET task_log=1 WHERE task_key='rssimport'";
$DB->addField('forums', 'topicfilter', 'varchar(32)', 'all');
$SQL[] = "UPDATE forums SET topicfilter='all' WHERE topicfilter != 'all'";

$DB->addField('message_topics', 'mt_addtosent', 'tinyint' ,'0');
$SQL[] = "UPDATE conf_settings_titles SET conf_title_title='IPB License Settings', conf_title_desc='This section will allow you to edit your IPB registered license settings.' WHERE conf_title_keyword='ipbreg'";

$DB->addField('cal_events', 'event_timeset', 'varchar(6)', '0');
$DB->addField('rss_import', 'rss_import_auth', 'tinyint', '0');
$DB->addField('rss_import', 'rss_import_auth_user', 'varchar(255)', 'Not Needed');
$DB->addField('rss_import', 'rss_import_auth_pass', 'varchar(255)', 'Not Needed');

$UPDATES[] = "UPDATE faq SET title='Registration benefits', text='To be able to use all the features on this board, the administrator will probably require that you register for a member account. Registration is free and only takes a moment to complete.
<br>
<br>During registration, the administrator requires that you supply a valid email address. This is important as the administrator may require that you validate your registration via an email. If this is the case, you will be notified when registering. If your e-mail does not arrive, then on the member bar at the top of the page, there will be a link that will allow you to re-send the validation e-mail.
<br>
<br>In some cases, the administrator will need to approve your registration before you can use your member account fully. If this is the case you will be notified during registration.
<br>
<br>Once you have registered and logged in, you will have access to your personal messenger and your control panel.
<br>
<br>For more information on these items, please see the relevant sections in this documentation.', description='How to register and the added benefits of being a registered member.' WHERE id=1";
$UPDATES[] = "UPDATE faq SET title='Cookies and cookie usage', text='Using cookies is optional, but strongly recommended. Cookies are used to track topics, showing you which topics have new replies since your last visit and to automatically log you in when you return.
<br>
<br>If your computer is unable to use the cookie system to browse the board correctly, then the board will automatically add in a session ID to each link to track you around the board.
<br>
<br><b>Clearing Cookies</b>
<br>
<br>You can clear the cookies at any time by clicking on the link found at the bottom of the main board page (the first page you see when returning to the board). If this does not work for you, you may need to remove the cookies manually.
<br>
<br><u>Removing Cookies in Internet Explorer for Windows</u>
<br>
<br><ul>
<br><li> Close all open Internet Explorer Windows
<br><li> Click on the ''start'' button
<br><li> Move up to ''Find'' and click on ''Files and Folders''
<br><li> When the new window appears, type in the domain name of the board you are using into the ''containing text'' field. (If the boards address was ''http://www.invisionboard.com/forums/index.php'' you would enter ''invisionboard.com'' without the quotes)
<br><li> In the ''look in'' box, type in <b>C:WindowsCookies</b> and press ''Find Now''
<br><li> After it has finished searching, highlight all files (click on a file then press CTRL+A) and delete them.
<br></ul>
<br>
<br><u>Removing Cookies in Internet Explorer for Macintosh</u>
<br>
<br><ul>
<br><li> With Internet Explorer active, choose ''Edit'' and then ''Preferences'' from the Macintosh menu bar at the top of the screen
<br><li> When the preferences panel opens, choose ''Cookies'' found in the ''Receiving Files'' section.
<br><li> When the cookie pane loads, look for the domain name of the board (If the boards address was ''http://www.invisionboard.com/forums/index.php'' look for ''invisionboard.com'' or ''www.invisionboard.com''
<br><li> For each cookie, click on the entry and press the delete button.
<br></ul>
<br>
<br>Your cookies should now be removed. In some cases you may need to restart your computer for the changes to take effect.', description='The benefits of using cookies and how to remove cookies set by this board.' WHERE id=2";
$UPDATES[] = "UPDATE faq SET title='Recovering lost or forgotten passwords', text='Security is a big feature on this board, and to that end, all passwords are encrypted when you register.
<br>This means that we cannot email your password to you as we hold no record of your ''uncrypted'' password. You can however, apply to have your password reset.
<br>
<br>To do this, click on the <a href=''index.php?act=Reg&do=10''>Lost Password link</a> found on the log in page.
<br>
<br>Further instruction is available from there.', description='How to reset your password if you''ve forgotten it.' WHERE id=3";
$UPDATES[] = "UPDATE faq SET title='Your Control Panel (My Controls)', text='Your control panel is your own private board console. You can change how the board looks and feels as well as your own information from here.
<br>
<br><b>Subscriptions</b>
<br>
<br>This is where you manage your topic and forums subscriptions. Please see the help file ''Email Notification of new messages'' for more information on how to subscribe to topics.
<br>
<br><b>Edit Profile Info</b>
<br>
<br>This section allows you to add or edit your contact information and enter some personal information if you choose.
<br>
<br><b>Edit Signature</b>
<br>
<br>A board ''signature'' is very similar to an email signature. This signature is attached to the foot of every message you post unless you choose to check the box that allows you to ommit the signature in the message you are posting. You may use BB Code if available and in some cases, pure HTML (if the board administrator allows it).
<br>
<br><b>Edit Avatar Settings</b>
<br>
<br>An avatar is a little image that appears under your username when you view a topic or post you authored. If the administrator allows, you may either choose from the board gallery, enter a URL to an avatar stored on your server or upload an avatar to use. You may also set the width of the avatar to ensure that it''s sized in proportion.
<br>
<br><b>Change Personal Photo</b>
<br>
<br>This section will allow you to add a photograph to your profile. This will be displayed when a user clicks to view your profile, on the mini-profile screen and will also be linked to from the member list.
<br>
<br><b>Email Settings</b>
<br>
<br><u>Hide my email address</u> allows you to deny the ability for other users to send you an email from the board.
<br><u>Send me updates sent by the board administrator</u> will allow the administrator to include your email address in any mailings they send out - this is used mostly for important updates and community information.
<br><u>Include a copy of the post when emailing me from a subscribed topic</u>, this allows you to have the new post included in any reply to topic notifications.
<br><u>Send a confirmation email when I receive a new private message</u>, this will send you an e-mail notification to your registered e-mail address each time you receive a private message on the board.
<br><u>Enable ''Email Notification'' by default?</u>, this will automatically subscribe you to any topic that you make a reply to. You may unsubscribe from the ''Subscriptions'' section of My Controls if you wish.
<br>
<br><b>Board Settings</b>
<br>
<br>From this section, you can set your time zone, choose to not see users signatures, avatars and posted images.
<br>You can choose to get a pop up window informing you when you have a new message and choose to show or hide the ''Fast Reply'' box where it is enabled.
<br>You are also able to choose display preferences for the number of topics/posts shown per page on the board.
<br>
<br><b>Change Email Address</b>
<br>
<br>At any time, you can change the email address that is registered to your account. In some cases, you will need to revalidate your account after changing your email address. If this is the case, you will be notified before your email address change is processed.
<br>
<br><b>Change Password</b>
<br>
<br>You may change your password from this section. Please note that you will need to know your current password before you can change your password.', description='Editing contact information, personal information, avatars, signatures, board settings, languages and style choices.' WHERE id=4";
$UPDATES[] = "UPDATE faq SET title='Email Notification of new messages', text='This board can notify you when a new reply is added to a topic. Many users find this useful to keep up to date on topics without the need to view the board to check for new messages.
<br>
<br>There are three ways to subscribe to a topic:
<br><ul>
<br><li>Click the ''Track This Topic'' link at the top of the topic that you wish to track</li>
<br><li> On the posting screen when replying to or creating a topic, check the ''Enable email notification of replies?'' checkbox</li>
<br><li> From the E-Mail settings section of your User CP (My Controls) check the ''Enable Email Notification by default?'' option, this will automatically subscribe you to any topic that you make a reply to</li>
<br></ul>Please note that to avoid multiple emails being sent to your email address, you will only get one e-mail for each topic you are subscribed to until the next time you visit the board.
<br>
<br>You are also able to subscribe to each individual forum on the board, to be notified when a new topic is created in that particular forum. To enable this, click the ''Subscribe to this forum'' link at the bottom of the forum that you wish to subscribe to.
<br>
<br>To unsubscribe from any forums or topics that you are subscribed to - just go to the ''Subscriptions'' section of ''My Controls'' and you can do thi from there.', description='How to get emailed when a new reply is added to a topic.' WHERE id=5";
$UPDATES[] = "UPDATE faq SET title='Your Personal Messenger', text='Your personal messenger acts much like an email account in that you can send and receive messages and store messages in folders.
<br>
<br><b>Compose a New PM</b>
<br>
<br>This will allow you to send a message to another member. If you have names in your contact list, you can choose a name from it - or you may choose to enter a name in the relevant form field. This will be automatically filled in if you clicked a ''PM'' button on the board (from the member list or a post). If allowed, you may also be able to enter in multiple names in the box provided, will need to add one username per line.
<br>If the administrator allows, you may use BB Code and HTML in your private message. If you choose to check the ''Add a copy of this message to you sent items folder'' box, a copy of the message will be saved for you for later reference. If you tick the ''Track this message?'' box, then the details of the message will be available in your ''Message Tracker'' where you will be able to see if/when it has been read.
<br>
<br><bInbox</b>
<br>
<br>Your inbox is where all new messages are sent to. Clicking on the message title will show you the message in a similar format to the board topic view. You can also delete or move messages from your inbox.
<br>
<br><b>Empty PM Folders</b>
<br>
<br>This option provides you with a quick and easy way to clear out all of your PM folders.
<br>
<br><b>Edit Storage Folders</b>
<br>
<br>You may rename, add or remove folders to store messages is, allowing you to organise your messages to your preference. You cannot remove ''Sent Items'' or ''Inbox''.
<br>
<br><b>PM Buddies/Block List</b>
<br>
<br>You may add in users names in this section, or edit any saved entries. You can also use this as a ban list, denying the named member the ability to message you.
<br>Names entered in this section will appear in the drop down list when sending a new PM, allowing you to quickly choose the members name when sending a message.
<br>
<br><b>Archive Messages</b>
<br>
<br>If your messenger folders are full and you are unable to receive new messages, you can archive them off. This compiles the messages into a single HTML page or Microsoft � Excel Format. This page is then emailed to your registered email address for your convenience.
<br>
<br><b>Saved (Unsent) PMs</b>
<br>
<br>This area will allow you to go back to any PM''s that you have chosen to save to be sent later.
<br>
<br><b>Message Tracker</B>
<br>
<br>This is the page that any messages that you have chosen to track will appear. Details of if and when they have been read by the recipient will appear here. This also gives you the chance to delete any messages that you have sent and not yet been read by the intended recipient.', description='How to send personal messages, track them, edit your messenger folders and archive stored messages.' WHERE id=6";
$UPDATES[] = "UPDATE faq SET title='Contacting the moderating team & reporting posts', text='<b>Contacting the moderating team</b>
<br>
<br>If you need to contact a moderator or simply wish to view the complete administration team, you can click the link ''The moderating team'' found at the bottom of the main board page (the first page you see when visiting the board), or from ''My Assistant''.
<br>
<br>This list will show you administrators (those who have administration control panel access), global moderators (those who can moderate in all forums) and the moderators of the individual forums.
<br>
<br>If you wish to contact someone about your member account, then contact an administrator - if you wish to contact someone about a post or topic, contact either a global moderator or the forum moderator.
<br>
<br><b>Reporting a post</b>
<br>
<br>If the administrator has enabled this function on the board, you''ll see a ''Report'' button in a post, next to the ''Quote'' button. This function will let you report the post to the forum moderator (or the administrator(s), if there isn''t a specific moderator available). You can use this function when you think the moderator(s) should be aware of the existance of that post. However, <b>do not use this to chat with the moderator(s)!</b>. You can use the email function or the Personal Messenger function for that.', description='Where to find a list of the board moderators and administrators.' WHERE id=7";
$UPDATES[] = "UPDATE faq SET title='Viewing members profile information', text='You can view a members profile at any time by clicking on their name when it is underlined (as a link) or by clicking on their name in a post within a topic.
<br>
<br>This will show you their profile page which contains their contact information (if they have entered some) and their ''active stats''.
<br>
<br>You can also click on the ''Mini Profile'' button underneath their posts, this will show up a mini ''e-card'' with their contact information and a photograph if they have chosen to have one.', description='How to view members contact information.' WHERE id=8";
$UPDATES[] = "UPDATE faq SET title='Viewing active topics and new posts', text='You can view which new topics have new replies today by clicking on the ''Today''s Active Topics'' link found at the bottom of the main board page (the first page you see when visiting the board). You can set your own date criteria, choosing to view all topics  with new replies during several date choices.
<br>
<br>The ''View New Posts'' link in the member bar at the top of each page, will allow you to view all of the topics which have new replies in since your last visit to the board.', description='How to view all the topics which have a new reply today and the new posts made since your last visit.' WHERE id=9";
$UPDATES[] = "UPDATE faq SET title='Searching Topics and Posts', text='The search feature is designed to allow you to quickly find topics and posts that contain the keywords you enter.
<br>
<br>There are two types of search form available, simple search and advanced search. You may switch between the two using the ''More Options'' and ''Simple Mode'' buttons.
<br>
<br><b>Simple Mode</b>
<br>
<br>All you need to do here is enter in a keyword into the search box, and select a forum(s) to search in. (to select multiple forums, hold down the control key on a PC, or the Shift/Apple key on a Mac) choose a sorting order and search.
<br>
<br><b>Advanced Mode</b>
<br>
<br>The advanced search screen, will give you a much greater range of options to choose from to refine your search. In addition to searching by keyword, you are able to search by a members username or a combination of both. You can also choose to refine your search by selecting a date range, and there are a number of sorting options available. There are also two ways of displaying the search results, can either show the post text in full or just show a link to the topic, can choose this using the radio buttons available.
<br>
<br>If the administrator has enabled it, you may have a minimum amount of time to wait between searches, this is known as search flood control.
<br>
<br>There are also search boxes available at the bottom of each forum, to allow you to carry out a quick search of all of the topics within that particular forum.', description='How to use the search feature.' WHERE id=10";
$UPDATES[] = "UPDATE faq SET title='Logging in and out', text='If you have chosen not to remember your log in details in cookies, or you are accessing the board on another computer, you will need to log into the board to access your member profile and post with your registered name.
<br>
<br>When you log in, you have the choice to save cookies that will log you in automatically when you return. Do not use this option on a shared computer for security.
<br>
<br>You can also choose to hide - this will keep your name from appearing in the active users list.
<br>
<br>Logging out is simply a matter of clicking on the ''Log Out'' link that is displayed when you are logged in. If you find that you are not logged out, you may need to manually remove your cookies. See the ''Cookies'' help file for more information.', description='How to log in and out from the board and how to remain anonymous and not be shown on the active users list.' WHERE id=11";
$UPDATES[] = "UPDATE faq SET title='Posting', text='There are three different posting screens available. The new topic button, visible in forums and in topics allows you to add a new topic to that particular forum. The new poll button (if the admin has enabled it) will also be viewable in topics and forums allowing you to create a new poll in the forum. When viewing a topic, there will be an add reply button, allowing you to add a new reply onto that particular topic.
<br>
<br><b>Posting new topics and replying</b>
<br>
<br>When making a post, you will most likely have the option to use IBF code when posting. This will allow you to add various types of formatting to your messages. For more information on this, click the ''BB Code Help'' link under the emoticon box to launch the help window.
<br>
<br>On the left of the text entry box, there is the clickable emoticons box - you can click on these to add them to the content of your message (these are sometimes known as ''smilies'').
<br>
<br>There are three options available when making a post or a reply. ''Enable emoticons?'' if this is unchecked, then any text that would normally be converted into an emoticon will not be. ''Enable signature?'' allows you to choose whether or not you would like your signature to appear on that individual post. ''Enable email notification of replies?'' ticking this box will mean that you will receive e-mail updates to the topic, see the ''Email Notification of new messages'' help topic for more information on this.
<br>
<br>You also have the option to choose a post icon for the topic/post when creating one. This icon will appear next to the topic name on the topic listing in that forum, or will appear next to the date/time of the message if making a reply to a topic.
<br>
<br>If the admin has enabled it, you will also see a file attachments option, this will allow you to attach a file to be uploaded when making a post. Click the browse button to select a file from your computer to be uploaded. If you upload an image file, it may be shown in the content of the post, all other file types will be linked to.
<br>
<br><b>Poll Options</b>
<br>
<br>If you have chosen to post a new poll, there will be an extra two option boxes at the top of the help screen. The first input box will allow you to enter the question that you are asking in the poll. The text field underneath is where you will input the choices for the poll. Simply enter a different option on each line. The maximum number of choices is set by the board admin, and this figure is displayed on the left.
<br>
<br><b>Quoting Posts</b>
<br>
<br>Displayed below each post in a topic, there is a ''Quote'' button. Pressing this button will allow you to reply to a topic, and have the text from a particular reply quoted in your own reply. When you choose to do this, an extra text field will appear below the main text input box to allow you to edit the content of the post being quoted.
<br>
<br><b>Editing Posts</b>
<br>
<br>Above any posts that you have made, you may see an ''Edit'' button. Pressing this will allow you to edit the post that you had previously made.
<br>
<br>When editing you may see an option to ''Add the ''Edit by'' line in this post?''. If you tick this then it will show up in the posts that it has been edited and the time at which it was edited. If this option does not appear, then the edit by line will always be added to the post.
<br>
<br>If you are unable to see the edit button displayed on each post that you have made, then the administrator may have prevented you from editing posts, or the time limit for editing may have expired.
<br>
<br><b>Fast Reply</b>
<br>
<br>Where it has been enabled, there will be a fast reply button on each topic. Clicking this will open up a posting box on the topic view screen, cutting down on the time required to load the main posting screen. Click the fast reply button to expand the reply box and type the post inside of there. Although the fast reply box is not expanded by default, you can choose the option to have it expanded by default, from the board settings section of your control panel. Pressing the ''More Options'' button will take you to the normal posting screen.', description='A guide to the features avaliable when posting on the boards.' WHERE id=12";
$UPDATES[] = "UPDATE faq SET title='My Assistant', text='This feature is sometimes referred to as a ''Browser Buddy''.
<br>
<br>At the top it tells you how many posts have been made since you last visited the board.. Also underneath this the number of posts with replies that have been made in topics that the individual has also posted in.
<br>Click on the ''View'' link on either of the two sentences to see the posts.
<br>
<br>The next section is five links to useful features:
<br><ul>
<br><li>The link to the moderating team is basically a quick link to see all those that either administrate or moderate certain forums on the message board.</li>
<br><li> The link to ''Today''s Active Topics'' shows you all the topics that have been created in the last 24 hours on the board.</li>
<br><li>Today''s Top 10 Posters link shows you exactly as the name suggests. It shows you the amount of posts by the members and also their total percentage of the total posts made that day.</li>
<br><li>The overall Top 10 Posters link shows you the top 10 posters for the whole time that the board has been installed.</li>
<br><li>My last 10 posts links to the latest topics that you have made on the board. These are shortened on the page, to save space, and are linked to if you require to read more of them.</li>
<br></ul>The two search features allow you to search the whole board for certain words in a whole topic. It isn''t as featured as the normal search option so it is not as comprehensive.
<br>
<br>The Help Search is just as comprehensive as the normal help section''s search function and allows for quick searching of all the help topics on the board.', description='A comprehensive guide to use this handy little feature.' WHERE id=13";
$UPDATES[] = "UPDATE faq SET title='Member List', text='The member list, accessed via the ''Members'' link at the top of each page, is basically a listing of all of the members that have registered on the board.
<br>
<br>If you are looking to search for a particular member by all/part of their username, then in the drop down box at the bottom of the page, change the selection from ''Search All Available'' to ''Name Begins With'' or ''Name Contains'' and input all/part of their name in the text input field and press the ''Go!'' button.
<br>
<br>Also, at the bottom of the member list page, there are a number of sorting options available to alter the way in which the list is displayed.
<br>
<br>If a member has chosen to add a photo to their profile information, then a camera icon will appear next to their name, and you may click this to view the photo.', description='Explaining the different ways to sort and search through the list of members.' WHERE id=14";
$UPDATES[] = "UPDATE faq SET title='Topic Options', text='At the bottom of each topic, there is a ''Topic Options'' button. Pressing this button will expand the topic options box.
<br>
<br>From this box, you can select from the following options:
<br><ul>
<br><li>Track this topic - this option will allow you to receive e-mail updates for the topic, see the ''Email Notification of new messages'' help file for more information on this</li>
<br><li>Subscribe to this forum - will allow you to receive e-mail updates for any new topics posted in the forum, see the Notification of new messages'' help file for more information on this</li>
<br><li>Download / Print this Topic - will show the topic in a number of different formats. ''Printer Friendly Version'' will display a version of the topic that is suitable for printing out. ''Download HTML Version'' will download a copy of the topic to your hard drive, and this can then be viewed in a web browser, without having to visit the board. ''Download Microsoft Word Version'' will allow you to download the file to your hard drive and open it up in the popular word processing application, Microsoft Word, for viewing offline.</li>
<br></ul>', description='A guide to the options avaliable when viewing a topic.' WHERE id=15";
$UPDATES[] = "UPDATE faq SET title='Calendar', text='This board features it''s very own calendar feature, which can be accessed via the calendar link at the top of the board.
<br>
<br>You are able to add your own personal events to the calendar - and these are only viewable by yourself. To add a new event, use the ''Add New Event'' button to be taken to the event posting screen. There are three types of events that you can now add:
<br><ul>
<br><li>A single day/one off event can be added using the first option, by just selecting the date for it to appear on.</li>
<br><li>Ranged Event - is an event that spans across multiple days, to do this in addition to selecting the start date as above, will need to add the end date for the event. There are also options available  to highlight the message on the calendar, useful if there is more than one ranged event being displayed at any one time.</li>
<br><li>Recurring Event - is a one day event, that you can set to appear at set intervals on the calendar, either weekly, monthly or yearly.</li>
<br></ul>If the admistrator allows you, you may also be able to add a public event, that will not just be shown to yourself, but will be viewable by everyone.
<br>
<br>Also, if the admistrator has chosen,  there will be a link to all the birthdays happening on a particular day displayed on the calendar, and your birthday will appear if you have chosen to enter a date of birth in the Profile Info section of your control panel.', description='More information on the boards calendar feature.' WHERE id=16";

