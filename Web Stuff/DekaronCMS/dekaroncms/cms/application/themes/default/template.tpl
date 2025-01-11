{$head}
	<body>
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
		<div id="wrapper">
			<div id="header"></div>
			<div id="menu">
				<ul>
					{foreach from=$menu_top item=menu_1}
						<li><a {$menu_1.link}>{$menu_1.name}</a></li>
					{/foreach}
				</ul>
			</div>
			<div id="body">
            	<div id="space"></div>
				<div id="left">
					<div class="left_box">
						<div class="left_box_top">Site menu</div>
						<ul>
                        	{foreach from=$menu_side item=menu_2}
								<li><a {$menu_2.link}>{$menu_2.name}</a></li>
							{/foreach}
                        </ul>
					</div>
                    {foreach from=$sideboxes item=sidebox}
                    <div class="left_box">
						<div class="left_box_top">{$sidebox.name}</div>
						<div style="padding:5px;">
								{$sidebox.data}
							</div>
					</div>
					{/foreach}
				</div>
				<div id="right">
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
				</div>    
                <div class="clear"></div>
			</div>			
			<div id="footer">
				<!-- DO NOT REMOVE THE COPYRIGHT, REMOVING IT WILL VIOLATE EULA! -->
                &copy; Copyright {date("Y")} {$serverName} - Powerd By <a href="http://www.dekaroncms.com">DekaronCMS</a>
            </div>
		</div>
	</body>
</html>


		