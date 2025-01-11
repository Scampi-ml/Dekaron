{$head}
	<body>
		<!--[if lte IE 8]>
			<style type="text/css">
				body {
					background-image:url(images/bg.jpg);
					background-position:top center;
				}
			</style>
		<![endif]-->
		<div id="popup_bg"></div>
		<div id="confirm" class="popup">
			<h1 class="popup_question" id="confirm_question"></h1>
			<div class="popup_links">
				<a href="javascript:void(0)" class="popup_button" id="confirm_button"></a>
				<a href="javascript:void(0)" class="popup_hide" id="confirm_hide" onClick="UI.hidePopup()">Cancel</a>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div id="alert" class="popup">
			<h1 class="popup_message" id="alert_message"></h1>
		
			<div class="popup_links">
				<a href="javascript:void(0)" class="popup_button" id="alert_button">Ok</a>
				<div style="clear:both;"></div>
			</div>
		</div>		
		<section id="wrapper">
            <div class="top-menu-holder">
                <ul id="top_menu">
                    {foreach from=$menu_top item=menu_1}
                        <li><a {$menu_1.link}>{$menu_1.name}</a></li>
                    {/foreach}
                </ul>
                <div class="menu-image"></div>
            </div>
			<div id="main">
				<aside id="left">
                                    
                    <a class="sidebar-banner register" href="/register/" title="Create new Account">
                    	<h1>CREATE NEW ACCOUNT</h1>
                        <h2>Become a part of our community!</h2>
                    </a>

					{foreach from=$sideboxes item=sidebox}
						<article>
							<h1 class="top">{$sidebox.name}</h1>
							<section class="body">
								{$sidebox.data}
							</section>
						</article>
					{/foreach}

                    <a class="sidebar-banner teamspeak" href="/page/ts/" title="Teamspeak">
                    	<h1>TEAMSPEAK</h1>
                        <h2>Talk with other members!</h2>
                    </a>

					<article>
						<h1 class="top">Main menu</h1>
						<ul id="left_menu">
							{foreach from=$menu_side item=menu_2}
								<li><a {$menu_2.link}><img src="{$image_path}bullet.png">{$menu_2.name}</a></li>
							{/foreach}
						</ul>
					</article>
					
				</aside>

				<aside id="right">

					{if $show_slider}
						<div class="right_box" id="sliderContainer" >
				            <div id="slider" class="nivoSlider">
				            	{foreach from=$slider item=image}
					                <a href="{$image.link}"><img src="{$image.image}" {if isset($image.text)}alt="{$image.text}"{/if} /></a>
				                {/foreach}
					        </div>
				        </div>
			        {/if}



					{$page}
				</aside>

				<div class="clear"></div>
			</div>
			<footer>
                <div class="center">
                	<p>
						<!-- DO NOT REMOVE THE COPYRIGHT, REMOVING IT WILL VIOLATE EULA! -->
		                &copy; Copyright {date("Y")} {$serverName} - Powerd By <a href="http://www.dekaroncms.com">DekaronCMS</a>	
                	</p>
                </div>
			</footer>
		</section>
	</body>
</html>