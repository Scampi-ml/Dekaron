{foreach from=$articles item=article}
	<article class="right_box">
		<a href="{$article.link}" class="right_box_top">{$article.headline}</a>
			<div style="padding:5px;">{$article.content}</div>			
			<div class="clear"></div>
		<div class="right_box_bottom">{if isset($article.author) && !empty($article.author) }Posted by <b>{$article.author}{/if}</b></div>
	</article>
{/foreach}
{$pagination}