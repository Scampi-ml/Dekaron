{include file="inc/view_header.tpl"}
<aside id="right">
    <section id="slider_bg" >
        <div class="slider-overlay"></div>
        <div id="slider" class="nivoSlider">{$nivoSlider}</div> 
    </section>
    
    
    {if $articles == 'nonews'}
    	<div id="news_pagination">No News</div>
    {else}
        {foreach from=$articles item=article}
            <article>
                <h1 class="news-head"><a class="top" href="{$article.link}">{$article.headline}</a><p>{$article.date}</p></h1>
                <section class="body">
                    {$article.content}
                    <div class="clear"></div>
                </section>
                <div class="news_bottom"> Posted by <a href="{$SITE_URL}community/profile/{$article.author}" data-tip="View profile">{$article.author}</a> </div>
            </article>    
        {/foreach}  
    {/if}
    
</aside>
{include file="inc/view_footer.tpl"}