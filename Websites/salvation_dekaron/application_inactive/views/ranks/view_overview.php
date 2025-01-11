<?php $this->load->view('./inc/top.php'); ?>
<?php $this->load->view('./inc/topbar.php'); ?>
<?php $this->load->view('./inc/section.php'); ?>
<?php $this->load->view('./inc/header.php'); ?>
<?php $this->load->view('./inc/navigation.php'); ?>
<div class="container content">
  <div id="pages">
    <div class="pages-inner">
      <div class="arsenal">
      	<!--
        <div class="arsenal-searcharea">
          <form name="searchbox" class="normal" accept-charset="utf-8" method="post" action="/arsenal/characters/search">
            <dl class="clearfix">
              <dt class="clearfix">
                <label for="suche">Search</label>
                :</dt>
              <dd class="clearfix">
                <input class="input" name="character" id="suche" maxlength="18" size="32" placeholder="Character Search" type="text">
                <select name="selectsearch" id="selectsearch" class="select">
                  <option selected="selected" value="0">Character</option>
                  <option value="1">Guild</option>
                </select>
                <button name="character_search" type="submit" class="button"> <span class="button"> <span class="button-inner">Search</span> </span> </button>
              </dd>
            </dl>
          </form>
        </div>
        -->
        <div class="list-column clearfix">
          <div class="list list-first">
            <h4>PvP Ranking</h4>
            <span class="list-subtitle">See the current rankings</span>
            <div class="group"> 
                <a href="<?php echo site_url('ranks/ranking_level'); ?>"> <span class="group-icon pvp-icon"></span> <span class="group-text">Level Ranking</span> </a> 
                <a href="<?php echo site_url('ranks/ranking_exp'); ?>"> <span class="group-icon pvp-icon"></span> <span class="group-text">EXP Ranking</span> </a> 
                <a href="<?php echo site_url('ranks/ranking_dil'); ?>"> <span class="group-icon pvp-icon"></span> <span class="group-text">Dil Ranking</span> </a> 
                <a href="<?php echo site_url('ranks/ranking_pvp_win'); ?>"> <span class="group-icon pvp-icon"></span> <span class="group-text">PVP Win Ranking</span> </a> 
                <a href="<?php echo site_url('ranks/ranking_pvp_lose'); ?>"> <span class="group-icon pvp-icon"></span> <span class="group-text">PVP Lose Ranking</span> </a> 
                <a href="<?php echo site_url('ranks/ranking_pk'); ?>"> <span class="group-icon pvp-icon"></span> <span class="group-text">PK Ranking</span> </a> 
                <a href="<?php echo site_url('ranks/ranking_ip'); ?>"> <span class="group-icon pvp-icon"></span> <span class="group-text">IP Ranking</span> </a> 
                <a href="<?php echo site_url('ranks/ranking_guild'); ?>"> <span class="group-icon pvp-icon"></span> <span class="group-text">Guild Ranking</span> </a> 
            </div>
          </div>
          <div class="list list-second">
            <h4>Community & Server</h4>
            <span class="list-subtitle">Get a view into on the Community and server info</span>
            <div class="group">
            	<a href="<?php echo site_url('ranks/online'); ?>"> <span class="group-icon ppl-icon"></span> <span class="group-text">Player Online List</span> </a> 
                <a href="<?php echo site_url('ranks/siege'); ?>"> <span class="group-icon siege-icon"></span> <span class="group-text">Siege Info</span> </a> 
                <a href="<?php echo site_url('ranks/deadfront'); ?>"> <span class="group-icon rms-icon"></span> <span class="group-text">Deadfront</span> </a>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('./inc/footer.php'); ?>