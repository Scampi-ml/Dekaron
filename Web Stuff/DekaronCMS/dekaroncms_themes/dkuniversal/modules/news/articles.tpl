{foreach from=$articles item=article}

	<article>
		<h1 class="news-head">
        	<a href="{$article.link}" class="top">{$article.headline}</a>
            <p>{$article.date}</p>
        </h1>
		<section class="body">
			{$article.content}
			<div class="clear"></div>
			<div class="news_bottom">
			</div>
		</section>
	</article>

{/foreach}
