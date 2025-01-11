{foreach from=$articles item=article}
	<article class="main_box">
		<a href="{$article.link}" class="main_box_top">{langColumn($article.headline)}</a>
		<div class="main_box_body">
			{langColumn($article.content)}
			<div class="clear"></div>
		</div>
		<div class="main_box_bottom">
        </div>
	</article>
{/foreach}
