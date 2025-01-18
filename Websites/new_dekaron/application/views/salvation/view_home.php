<?php $this->load->view('inc/top.php'); ?>
<?php $this->load->view('inc/topbar.php'); ?>
<?php $this->load->view('inc/section.php'); ?>
<?php $this->load->view('inc/header.php'); ?>
<?php $this->load->view('inc/navigation.php'); ?>
<script type="text/javascript">countdown_x1500 = '<?php print $this->config->item('deadfront_time'); ?>';</script>  
<div class="container content">
  <div class="row clearfix">
    <div class="content-left">
      <section class="teaser">
        <div id="wrapper">
          <div class="slider-wrapper">
            <div id="slider" class="nivoSlider">
            	<?php
				$sliders = $this->config->item('slider');
				for($i = 0; $i < count($sliders); ++$i)
				{
					echo '<a href="'.$sliders[$i][0].'"><img src="'.base_url('assets/images/slider/'.$sliders[$i][1]).'" alt="'.$sliders[$i][2].'" target="'.$sliders[$i][3].'" /></a>';
				}					
				?>
            </div>
          </div>
        </div>
      </section>
      <section class="ui-tabs ui-widget ui-widget-content ui-corner-all" id="news">
        <div class="news-header">
          <div class="news-header-inner">
            <div class="news-header-title">
              <h2 class="portal-heading"> <img src="<?php echo base_url('assets/images/news-headline-title-en.png'); ?>" alt="Announcements" title="Announcements"> </h2>
            </div>
            <div class="news-header-options">
              <ul role="tablist" class="news-selection ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                <li role="tab" class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a id="ui-id-1" class="ui-tabs-anchor" href="#news-1">All</a></li>
                <li role="tab" class="ui-state-default ui-corner-top"><a id="ui-id-2" class="ui-tabs-anchor" href="#news-2">News</a></li>
                <li role="tab" class="ui-state-default ui-corner-top"><a id="ui-id-3" class="ui-tabs-anchor" href="#news-3">Events</a></li>
                <li role="tab" class="ui-state-default ui-corner-top"><a id="ui-id-4" class="ui-tabs-anchor" href="#news-4">Notice</a></li>
                <li role="tab" class="ui-state-default ui-corner-top"><a id="ui-id-5" class="ui-tabs-anchor" href="#news-5">Updates</a></li>
              </ul>
            </div>
          </div>
        </div>
		<div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="news-1"><span id="forums_all"></span></div>    
        <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="news-2"><span id="forums_news"></span></div>  
        <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="news-3"><span id="forums_event"></span></div>  
        <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="news-4"><span id="forums_notice"></span></div>  
        <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="news-5"><span id="forums_update"></span></div>      
      </section>
      <div id="ranking">
        <section id="players">
        	<?php $this->load->view('view_ranking1.php'); ?>
        </section>
        <section id="legions">
        	<?php $this->load->view('view_ranking2.php'); ?>
        </section>
      </div>
    </div>
    <div class="content-right">
      <div class="sidebar-buttons"> <a id="download" class="banner" href="<?php echo site_url('download'); ?>"></a> </div>
      <div class="sidebar-buttons"> <a id="vote" class="banner" href="<?php echo site_url('myaccount/vote'); ?>"></a> </div>
      <section id="server-status">
        <div class="server-status-inner">
          <div id="login" class="status-offline"> <a style="display: block; height: 100%;" href="<?php echo site_url('server'); ?>"></a> </div>
          <div id="ariel" class="status-offline"> </div>
          <section id="server-info-container">
            <div class="server-info-inner"> <strong><span id="playersonline"></span> Players are Online!</strong><br>
              <strong>Next Dead Front in<br /></strong> <span id='nationwarx1500'>Loading...</span> <br>
          </section>
          <div id="test" class="status-offline"> </div>
          <div id="ts" class="status-offline"> <a style="display: block; height: 100%;" href="#"></a> </div>
        </div>
      </section>
      <div class="sidebar-buttons"> <a id="donate" class="banner" href="<?php echo site_url('myaccount/donate'); ?>"></a> </div>
      <div class="sidebar-buttons"> <a id="ranks" class="banner"  href="<?php echo site_url('ranks'); ?>"></a> </div>
      <div class="sidebar-buttons"> <a id="refer" class="banner" href="<?php echo site_url('myaccount/referafriend'); ?>"></a> </div>
      <div class="sidebar-buttons"> <a id="support" class="banner" href="<?php echo $template['support_url']; ?>"></a> </div>
    </div>
  </div>
</div>
<span id="CheckRefferal"></span>
<?php $this->load->view('inc/footer.php'); ?>