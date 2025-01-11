{foreach from=$articles item=article}

	<article>
		<h1 class="news-head">
        	<a {$article.link} class="top">{$article.headline}</a>
            <p>{$article.date}</p>
        </h1>
		<section class="body">
			{$article.content}
			<div class="clear"></div>
			<div class="news_bottom">
				Posted by <a href="{$url}profile/{$article.author_id}" data-tip="View profile">{$article.author}</a>
			</div>
		</section>
	</article>

{/foreach}
{$pagination}