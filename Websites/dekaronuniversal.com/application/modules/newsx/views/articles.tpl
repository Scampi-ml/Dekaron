{foreach from=$articles item=article}
	<article class="main_box">
		<a href="{$url}news/view/{$article.id}" class="main_box_top">{langColumn($article.headline)}</a>
		<div class="main_box_body">
			{langColumn($article.content)}
			<div class="clear"></div>
		</div>
		<div class="main_box_bottom">
			{lang("posted_by", "news")} <b><a href="{$url}profile/{$article.author_id}">{$article.author}</a></b> {lang("on", "news")} <b>{$article.date}</b>
        </div>
	</article>
{/foreach}
{$pagination}