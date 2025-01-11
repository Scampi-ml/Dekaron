X - POLL 2.30 by X-Scripts
______________________________________________

TESTED OFFLINE ON: PHP 4.3.9 & MySQL 4.0.13
TESTED ONLINE ON: PHP 4.3.2 & MySQL 3.23.57

USER TESTS: PHP 5 & MySQL 4.1
______________________________________________

Version 2.30: Added X-Install to ease the setting up of the database.

Version 2.25: Added the option to prevent the user from seeing the results even if they
have voted. Also added the option to choose whether users can vote on the poll at all.

I received a lot of requests asking if an archive of previous polls could be made. I simply
replicated archives which I had seen on other websites and introduced it to X-Poll. The
result is archive.php.

Also in the admin area, template.php has been created (thanks to Martin for the idea) to
create a single navigation system. This is a single page which is included in all the admin
files, which is a template for navigating around the admin area.

Version 2.00: A complete overhaul. The script has been completely rewritten in the space of
a week. Many new features have been added (see below) and the overall coding practice has
been improved.

It has been throughly tested on and offline and promises to build upon X-Poll 1.X.
There are plenty of new features and this version will deliver everything completely. With
the last script I received a lot of praise and a lot of flack. For some it worked yet for
others it didn't. After testing, I am confident this will be the perfect poll script.

Version 1.50: Big changes! The script has been made much faster. I have tidied up the SQL 
queries and made general speed improvements. Added a new column in the admin/index.php 
page so you can see if a poll is visible to the public or not. The IP protection has been 
greatly improved and it now expires as cookies do. More images for the graph have been
added and they appear randomly. As always these can be customised. General code tidying
has been added too and a few bug fixes.

Version 1.10: Minor bug fixes.

Version 1.00: I have finally finished the release of X-POLL despite the fact I had been 
advertising on the old website about how it would soon be out. Well for the millions who 
waited, it is here. I am pretty pleased with it because like with X-Pagination I couldn't 
really get a decent poll script. Just have a look at all the features!!!

Why choose this?
______________________________________________

Adding a poll to your website definately has massive benefits. It gives you the chance to
ask your visitors what they truly think of your website. It also allows you to ask them
questions which shape the way your website is produced.

X-Poll has a massive feature list which ensure the poll can be integrated into your website
quickly and effectively. Below is a complete fixture list:

	* Unlimited option choices for Polls.
	* Choose from protecting your polls with IP and/or Cookie Protection.
	* NEW! The new IP BLOCKER ensures that certain visitors can be blocked from voting
	  on certain polls.
	* NEW! Choose the images that are displayed for each option when displaying a polls
	  result. Even get X-Poll to randomise them each time.
	* Choose when the poll starts.
	* Choose when the poll expires.
	* Choose how often (years/months/days/hours/minutes/seconds) the user can vote on
	  the same poll.
	* Decide if users can view results before they vote.

	ADMIN AREA:

	* Add/Edit/Delete/View Polls
	* NEW! Use the IP Blocker to prevent malicious users from voting.
	* NEW! Upload/Rename/Delete images that can be used in poll results.

Install
______________________________________________

1. Read the USER GUIDE.

2. To INCLUDE INTO YOUR WEBSITE:

	* Add the following line to the VERY top of your webpage:
	  <?php include ("top.php"); ?>
	  Where the path to top.php is correct.

	* Add the following line to where you want your poll to be on your webpage:
	  <?php include ("polls.php"); ?>
	  Where the path to polls.php is correct.

	* If you wish to display a specific poll on a page (for example a poll with ID 2)
	  Then use this code at the VERY top of your webpage:
	  <?php $_REQUEST['poll'] = 2; include ("top.php"); ?>
	  Where the path to top.php is correct.

3. View archive.php for a list of polls (with results) that have been created and have a
   start date which has passed.

Contact Us
______________________________________________

As always please tell us what you think. Good or bad, your opinions shape the way we 
produce scripts. Email us at xscripts@f2s.com with X-Poll in the subject line.

Copyright
______________________________________________

All scripts copyright of X-Scripts 2003 - 2005. If you edit my scripts please credit me 
after all it was my hard work in the first place. Also please review me at hotscripts.com
so other users can see my work - http://www.hotscripts.com/Detailed/41118.html?RID=388