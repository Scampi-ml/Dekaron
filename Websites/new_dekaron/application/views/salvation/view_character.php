<?php $this->load->view('inc/top.php'); ?>
<?php $this->load->view('inc/topbar.php'); ?>
<?php $this->load->view('inc/section.php'); ?>
<?php $this->load->view('inc/header.php'); ?>
<?php $this->load->view('inc/navigation.php'); ?>
<link href="<?php echo base_url('assets/css/tooltips.css'); ?>" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url('assets/js/extooltips.js'); ?>"></script>
<div class="container content">
  <div id="pages">
    <div class="pages-inner">
      <div class="character">
      	<!-- FALSE OR NOT -->
        <?php
			$char = $template['DisplayCharacter'];
		?>
        <div id="info">
          <div class="info-inner">
            <div class="avatar"> <img alt="Avatar" src="<?php echo base_url('assets/images/class/'.$char['byPCClass'].'.png'); ?>"> </div>
            <div class="info-container">
              <div class="info-head">
                <h2> <span class="icon-class icon-warrior"></span> <span class="info-name"><?php echo $char['character_name']; ?></span> <span class="info-level">Level <?php echo $char['wLevel']; ?></span></h2>
              </div>
              <div class="info-table">
                <table>
                  <tbody>
                    <tr>
                      <td class="player-class">Class: <span><?php echo $this->l_pcclass->class2name($char['byPCClass']); ?></span></td>
                      <td class="player-race">Race: <span>Asmodians</span></td>
                    </tr>
                    <tr>
                      <td class="player-titel">Title: <span></span></td>
                      <td class="player-last-online player-"> Last login: <span>16.11.13</span> </td>
                    </tr>
                    <tr>
                      <td class="player-legion">Legion: </td>
                      <td class="player-creation-date">Created: <span>16.11.13</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div id="equipments">
          <h3>Equipment</h3>
          <div class="equipments-inner">
            <div class="left-col">
              <table class="eq">
                <tbody>
                  <tr>
                    <td class="item-icon"><div class="icon-armor mainhand">
                        <table class="aiondb-table">
                          <tbody>
                            <tr>
                              <td><div style="background-image: url(&quot;http://www.aionarmory.com/icons/m/350718.gif&quot;);" class="iconmedium">
                                  <div class="tile"><a href="http://www.aionarmory.com/item.aspx?id=100000094"></a></div>
                                </div></td>
                              <td><a href="http://www.aionarmory.com/item.aspx?id=100000094" class="aion_r1">Sword for Training</a></td>
                            </tr>
                          </tbody>
                        </table>
                      </div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a href="http://www.aionarmory.com/item.aspx?id=100000094" class="aion_r1">Sword for Training</a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor offhand"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor head"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor jacket">
                        <table class="aiondb-table">
                          <tbody>
                            <tr>
                              <td><div style="background-image: url(&quot;http://www.aionarmory.com/icons/m/350803.gif&quot;);" class="iconmedium">
                                  <div class="tile"><a href="http://www.aionarmory.com/item.aspx?id=110500003"></a></div>
                                </div></td>
                              <td><a href="http://www.aionarmory.com/item.aspx?id=110500003" class="aion_r1">Hauberk for Training</a></td>
                            </tr>
                          </tbody>
                        </table>
                      </div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a href="http://www.aionarmory.com/item.aspx?id=110500003" class="aion_r1">Hauberk for Training</a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor shoulder"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor glove"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor leg">
                        <table class="aiondb-table">
                          <tbody>
                            <tr>
                              <td><div style="background-image: url(&quot;http://www.aionarmory.com/icons/m/350861.gif&quot;);" class="iconmedium">
                                  <div class="tile"><a href="http://www.aionarmory.com/item.aspx?id=113500001"></a></div>
                                </div></td>
                              <td><a href="http://www.aionarmory.com/item.aspx?id=113500001" class="aion_r1">Chausses for Training</a></td>
                            </tr>
                          </tbody>
                        </table>
                      </div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a href="http://www.aionarmory.com/item.aspx?id=113500001" class="aion_r1">Chausses for Training</a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor foot"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="right-col">
              <table class="eq">
                <tbody>
                  <tr>
                    <td class="item-icon"><div class="icon-armor mainhand_change"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor offhand-change"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor ear-left"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor ear-right"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor neck"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor finger-left"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor finger-right"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                  <tr>
                    <td class="item-icon"><div class="icon-armor waist"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div></td>
                    <td class="item-stones"></td>
                    <td class="item-text"><div class="item-text-inner"> <a class="aiondb-item-text" href="http://www.aionarmory.com/item.aspx?id="></a> </div></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="container-wrapper">
          <div id="stigma">
            <h4>Stigma</h4>
            <div class="stigma-inner">
              <div class="stigma-cell">
                <div class="stigma-cell-inner"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div>
              </div>
              <div class="stigma-cell">
                <div class="stigma-cell-inner"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div>
              </div>
              <div class="stigma-cell">
                <div class="stigma-cell-inner advanced"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div>
              </div>
              <div class="stigma-cell">
                <div class="stigma-cell-inner advanced"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div>
              </div>
              <div class="stigma-cell">
                <div class="stigma-cell-inner"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div>
              </div>
              <div class="stigma-cell">
                <div class="stigma-cell-inner"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div>
              </div>
              <div class="stigma-cell">
                <div class="stigma-cell-inner advanced"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div>
              </div>
              <div class="stigma-cell">
                <div class="stigma-cell-inner advanced"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div>
              </div>
              <div class="stigma-cell">
                <div class="stigma-cell-inner"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div>
              </div>
              <div class="stigma-cell">
                <div class="stigma-cell-inner"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div>
              </div>
              <div class="stigma-cell">
                <div class="stigma-cell-inner advanced"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div>
              </div>
              <div class="stigma-cell">
                <div class="stigma-cell-inner advanced"><a class="aiondb-item-full-medium" href="http://www.aionarmory.com/item.aspx?id="></a></div>
              </div>
            </div>
          </div>
          <div id="abyss">
            <h4>Abyss Status</h4>
            <div class="abyss-inner">
              <table>
                <tbody>
                  <tr>
                    <td>Rank:</td>
                    <td colspan="2">Soldier, Rank 9</td>
                  </tr>
                  <tr>
                    <td>Total:</td>
                    <td>0 <img alt="All Kills" class="image-kills" src="<?php echo base_url('assets/images/icon/icon-kills.png'); ?>"></td>
                    <td>0 <img alt="All AP" class="image-ap" src="<?php echo base_url('assets/images/icon/icon-ap.png'); ?>"></td>
                  </tr>
                  <tr>
                    <td>Today:</td>
                    <td>0 <img alt="Daily Kills" class="image-kills" src="<?php echo base_url('assets/images/icon/icon-kills.png'); ?>"></td>
                    <td>0 <img alt="Daily AP" class="image-ap" src="<?php echo base_url('assets/images/icon/icon-ap.png'); ?>"></td>
                  </tr>
                  <tr>
                    <td>Week:</td>
                    <td>0 <img alt="Weekly Kills" class="image-kills" src="<?php echo base_url('assets/images/icon/icon-kills.png'); ?>"></td>
                    <td>0 <img alt="Weekly AP" class="image-ap" src="<?php echo base_url('assets/images/icon/icon-ap.png'); ?>"></td>
                  </tr>
                  <tr>
                    <td>Last week:</td>
                    <td>0 <img alt="Last Kill" class="image-kills" src="<?php echo base_url('assets/images/icon/icon-kills.png'); ?>"></td>
                    <td>0 <img alt="Last Ap" class="image-ap" src="<?php echo base_url('assets/images/icon/icon-ap.png"'); ?>></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>