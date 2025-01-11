<?php
include ('header.php');
include ('sidebar.php');
?>  
<section class="main-section grid_7">
    <div class="main-content">
        <header>
            <h2>Changelog</h2>
        </header>
        <section class="container_6 clearfix">
            <div class="grid_6">
            	<fieldset>
                	<legend><font color="#CCCCCC">Version 1.0 Beta [ 15 Feb 2012]</font></legend>
                	<ul>
                    	<li>Initial release</li>
                        <li>[FIXED] Players where able to double there tokens by sending tokens to them selfs.</li>
                    </ul>
                </fieldset>
            	<fieldset>
                	<legend><font color="#CCCCCC">Version 2.0 Beta [ 16 Feb 2012]</font></legend>
                	<ul>
                    	<li>[ADDED] Buy tokens <a href="buy_tokens.php"> View </a></li>
                    </ul>
                </fieldset>
            	<fieldset>
                	<legend><font color="#CCCCCC">Version 3.0 Beta [ 16 Feb 2012]</font></legend>
                	<ul>
                        <li>[ADDED] Changelog, you will be able to view all changes made on the Evo CP</li>
                    </ul>
                </fieldset>
            	<fieldset>
                	<legend><font color="#CCCCCC">Version 4.0 Beta [ 16 Feb 2012]</font></legend>
                	<ul>
                        <li>[ADDED] Friends, Show your characters fiends with online / offline status <a href="friends.php"> View </a></li>
                        <li>[CHANGED] font color (CCCCCC) on <a href="changelog.php"> changelog </a></li>
                        <li>[ADDED] Support topic link if you need any support, or have any suggestions & questions</li>
                        <li>[REMOVED] Character Logs</li>
                        <li>[REMOVED] EXP Progress</li> 
                    </ul>
                </fieldset>
              	<fieldset>
                	<legend><font color="#CCCCCC">Version 5.0 Beta [ 17 Feb 2012]</font></legend>
                	<ul>
                        <li>[FIXED] Send Tokens, where player could send more tokens then the player has</li>
                        <li>[FIXED] Bank, where players could widthdraw more dil then the player has</li>
                        <li>[REMOVED] Character Detail, removed various info (On admin request)</li>
                        <li>[REMOVED] Coins Log, removed various info (On admin request)</li>
                        <li>[TYPO] Unstuck page</li> 
                        <li>[CHANGED] Character Details, Free (Stat / Skills) Points is now called: Unused (Stat / Skill) Points </li> 
                        <li>[ADDED] Accounts will be checked if they visited the D-Shop, if not, this will be done for you</li> 
                        <li>[ADDED] Fancy style when server is down</li> 
                        <li>[ADDED] Fancy style when query error</li> 
                        <li>[ADDED] All error will be logged for the developer (Janvier123)</li>
                    </ul>
                </fieldset>
			<div>
        </section>
    </div>
</section>
<?php include ('footer.php'); ?>