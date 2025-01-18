<?php $this->load->view('inc/view_header.php'); ?>
<aside id="right">
    <section id="slider_bg" >
        <div class="slider-overlay"></div>
            <div id="slider" class="nivoSlider">
            <?php
				$sliders = $this->config->item('slider');
				for($i = 0; $i < count($sliders); ++$i)
				{
					echo '<a href="'.$sliders[$i][0].'"><img src="'.base_url('assets/images/slider/'.$sliders[$i][1]).'" alt="'.$sliders[$i][2].'" target="'.$sliders[$i][3].'" /></a>';
				}					
            ?>
        </div> 
    </section>
    <div id="content_ajax">
        <article>
            <h1 class="news-head"><a class="top">Happy new year!</a><p>2013/12/31</p></h1>
            <section class="body">
            	Ironwow team wishes everyone a Happy new year in 2014! Thanks for playing on our server.<br>
            	<div class="clear"></div>
            	<div class="news_bottom"> Posted by <a href="profile/10.htm" data-tip="View profile">Iron</a> </div>
            	<div class="comments" id='comments_18'></div>
            </section>
        </article>
        <article>
            <h1 class="news-head"><a  class="top">Recruiting new GM's</a><p>2013/08/20</p></h1>
            <section class="body">
                Hello, we are increasing our staff team. To apply for GM position please visit our forums. Don't forget to specify the realm you want to be active on.<br>
                We also done a few improvements in management, hopping to resolve players issues more quickly. To make a ticket outside the game use Contact Us from side menu.<br>
                Thanks for choosing IronWow.<br>
                <div class="clear"></div>
                <div class="news_bottom"> Posted by <a href="profile/10.htm" data-tip="View profile">Iron</a> </div>
                <div class="comments" id='comments_17'></div>
            </section>
        </article>
        <div id="news_pagination">&nbsp;<a href="news/5.htm">Older posts &rarr;</a>&nbsp;&nbsp;<a href="news/15.htm"></a></div>
    </div>
</aside>
<?php $this->load->view('inc/view_footer.php'); ?>