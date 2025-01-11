{include file="inc/view_header.tpl"}
<aside id="right">
    <section id="slider_bg" >
        <div class="slider-overlay"></div>
        <div id="slider" class="nivoSlider">{$nivoSlider}</div> 
    </section>
    {$articles}   
    <div id="news_pagination">&nbsp;<a href="{$more_news}">More News &rarr;</a>&nbsp;&nbsp;</div>
</aside>
{include file="inc/view_footer.tpl"}