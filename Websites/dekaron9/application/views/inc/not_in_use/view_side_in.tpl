<div class="top-menu-holder">
    <ul id="top_menu">
        <li><a href="{$SITE_URL}home" direct="0">Home</a></li>
        <li><a href="{$SITE_URL}connect" direct="0">How to connect</a></li>
        <li><a href="{$SITE_URL}myaccount" direct="0">User panel</a></li>
        <li><a href="{$SITE_URL}community" direct="0">Community</a></li>
        <li><a href="{$SITE_URL}forum" direct="0">Forums</a></li>
        <li><a href="{$SITE_URL}logout" direct="0">Log out</a></li>
    </ul>
    <div class="menu-image"></div>
</div> 
<div id="main">
    <aside id="left">
        <a class="sidebar-banner vote" href="{$SITE_URL}myaccount/vote" title="Vote"><h1>Vote Now</h1><h2>Vote 4 us and get coins!</h2></a>
        <article>
            <h1 class="top">My Account</h1>
            <section class="body">
                <section class="sidebox_info">
                    <center>
                    	<h3>{$welcome_time}, {$user_id}</h3>
                        <br />
                        <a href="{$SITE_URL}logout" class="nice_button">Log out</a>
                    </center>
                </section>
            </section>
        </article>
        <a class="sidebar-banner teamspeak" href="#" title="Teamspeak"><h1>TEAMSPEAK</h1><h2>Talk with other members!</h2></a>
        {include file="inc/view_left_menu.tpl"}
    </aside>