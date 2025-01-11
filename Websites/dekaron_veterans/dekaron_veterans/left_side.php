<table cellspacing="0" cellpadding="0"  width="190">
	<?php include "logged_in.php"; ?>
                        <tr>
                      <td height="10"></td>
                    </tr>

  <tr>
    <td width="190" height="235"><table cellspacing="0" cellpadding="0"  background="img/ser_bg.gif" width="190" id="m_server">
        <tr>
          <td><img  width="190" height="23" src="img/title_servercondition.png"></td>
        </tr>
        <tr>
          <td background="img/bg_box01.gif" align="center" height="8"></td>
        </tr>
        <tr>
          <td background="img/bg_box01.gif" align="center"><table cellspacing="0" cellpadding="0"  width="170">
              <tr>
                <td align="left" width="68"><img  width="58" height="21" src="img/server_login.png"></td>
                <td background="img/bg_box02_hamin.gif" align="center" height="21" style="color: #0c3231"><?php include "server_status/server1.php"; ?></td>
              </tr>
              <tr>
                <td height="3" colspan="2"></td>
              </tr>
              <tr>
                <td align="left" width="62"><img  width="58" height="21" src="img/server_game.png"></td>
                <td background="img/bg_box02_hamin.gif" align="center" height="21" style="color: #0c3231"><?php include "server_status/server2.php"; ?></td>
              </tr>
              <tr>
                <td height="3" colspan="2"></td>
              </tr>
              <tr>
                <td align="left" width="62"><img  width="58" height="21" src="img/server_account.png"></td>
                <td background="img/bg_box02_hamin.gif" align="center" height="21" style="color: #0c3231"><?php include "server_status/server3.php"; ?></td>
              </tr>
              <tr>
                <td height="3" colspan="2"></td>
              </tr>
              <tr>
                <td align="left" width="62"><img  width="58" height="21" src="img/server_char.png"></td>
                <td background="img/bg_box02_hamin.gif" align="center" height="21" style="color: #0c3231"><?php include "server_status/server4.php"; ?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td background="img/bg_box01.gif" height="1"></td>
        </tr>
        <tr>
          <td background="img/bg_box01.gif" align="center"class="d_gary" style="padding-bottom: 5px; line-height: 16px; padding-left: 0px; padding-right: 0px; padding-top: 3px"> Server maintenance<br>
            Every 
            monday<br>
            09:00 AM ~ 11:00 AM</td>
        </tr>
        <tr>
          <td background="img/bg_box01.gif" height="2"></td>
        </tr>
        <tr>
          <td background="img/bg_box01.gif" align="center" valign="top"><img  width="170" height="20" src="img/title_current_time.png"></td>
        </tr>
        <tr>
          <td background="img/bg_box03_current.png" align="center" height="40" style="color: #0c3231"><b><span id="tick2"></span></b></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td width="190" height="90"><table cellspacing="0" cellpadding="0"  background="img/ser_bg.gif" width="190" id="m_server">
        <tr>
          <td><img  width="190" height="23" src="img/title_castle.png"></td>
        </tr>
        <tr>
          <td background="img/bg_box03_current.png" height="40" width="190" align="center" style="color: #0c3231"><b><?php include "castle_owner.php"; ?></b></td>
        </tr>
      </table></td>
  </tr>
  <!-- VOTE -->
  
    <tr>
    <td width="190">
    <table cellspacing="0" cellpadding="0"  background="img/ser_bg.gif" width="190" id="m_server">
        <tr>
          <td><img  width="190" height="23" src="img/title_vote.png"></td>
        </tr>
        <tr>
          <td  background="img/bg_box01.gif"  width="190" style="color: #0c3231"><?php include "vote_for_us.php"; ?></td>
        </tr>
        <tr>
          <td height="5"><img width="190" height="10" src="img/bg_box01_bottom.gif"></td>
        </tr>
      </table></td>
  </tr>
                      <tr>
                      <td height="10"></td>
                    </tr>

  <!-- /VOTE -->

  
  
  <tr>
    <td valign="top"><table cellspacing="0" cellpadding="0"  background="img/ser_bg.gif" width="190" id="m_server">
        <tr>
          <td><img  width="190" height="23" src="img/title_poll.png"></td>
        </tr>
        <tr>
          <td background="img/bg_box01.gif" align="center" height="8"></td>
        </tr>
        <tr>
          <td background="img/bg_box01.gif" align="center" height="10"><table cellspacing="0" cellpadding="0"  width="170">
              <tr>
                <td><table cellspacing="0" cellpadding="0" >
                    <tr>
                      <td width="15" height="20"><img width="15" height="15" src="img/icon_green.gif"></td>
                      <td width="145" valign="top" rowspan="2" class="d_gary"><strong>Which page content have 
                        you used most frequently?</strong></td>
                    </tr>
                    <tr>
                      <td height="30"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="10"><table cellspacing="0" cellpadding="0"  width="160">
                    <tr>
                      <td width="25" height="22"><input type="radio" name="vreq" value="1"></td>
                      <td width="135" class="d_gary">introduction</td>
                    </tr>
                    <tr>
                      <td width="25" height="22"><input type="radio" name="vreq" value="2"></td>
                      <td width="135" class="d_gary">game guide</td>
                    </tr>
                    <tr>
                      <td width="25" height="22"><input type="radio" name="vreq" value="3"></td>
                      <td width="135" class="d_gary">community</td>
                    </tr>
                    <tr>
                      <td width="25" height="22"><input type="radio" name="vreq" value="4"></td>
                      <td width="135" class="d_gary">itemshop</td>
                    </tr>
                    <tr>
                      <td width="25" height="22"><input type="radio" name="vreq" value="5"></td>
                      <td width="135" class="d_gary">c/s 
                        center</td>
                    </tr>
                    <input type="hidden" name="pollid" value="37">
                    <input type="hidden" name="ptarget" value="mem">
                  </table></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td align="center" height="10"><table cellspacing="0" cellpadding="0"  width="130">
                    <tr>
                      <td align="center" width="65"><a href=""><img  width="59" height="17" src="img/btn_vote.gif"></a></td>
                      <td align="center" width="65"><a href="http://www.inixgame.com/kalonline/community/poll_list.asp?btn=6"><img  width="59" height="17" src="img/btn_result.gif"></a></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td align=center height=50><a href="/kalonline/community/poll_list.asp"><img src="img/btn_vote2.gif"  border=0></a></td>
              </tr>
              <tr>
                <td></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td background="img/bg_box01.gif" align="center"></td>
        </tr>
        <tr>
          <td><img  width="190" height="10" src="img/bg_box01_bottom.gif"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td width="190" height="8"></td>
  </tr>
  <tr>
    <td valign="top"><table cellspacing="0" cellpadding="0"  background="img/ser_bg(1).gif" width="190" id="m_server">
        <tr>
          <td><img  width="190" height="23" src="img/title_prosvscons.gif"></td>
        </tr>
        <tr>
          <td background="img/bg_box01(1).gif" align="center" valign="center" height="15"><table cellspacing="0" cellpadding="0"  width="170">
              <tr>
                <td><table cellspacing="0" cellpadding="0" >
                    <tr>
                      <td width="15" valign="top"><img align="absmiddle" width="15" height="15" src="img/icon_green(1).gif"></td>
                      <td width="145" height="25" class="d_gary"><table cellspacing="0" cellpadding="0"  width="140">
                          <tr>
                            <td width="140" height="22" class="d_gary"><b>&nbsp;what about item rental system 
                              by kalcashshop 
                              ?</b></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="5"></td>
              </tr>
              <tr>
                <td align="center" height="10"><img  src="img/btn_pvc_go.gif"></td>
              </tr>
              <tr>
                <td height="15"></td>
              </tr>
              <tr>
                <td height="5"><table cellspacing="0" cellpadding="0"  width="170">
                    <tr>
                      <td bgcolor="#2e85fa" width="14%" height="5"></td>
                      <td bgcolor="#ec6206" width="86%" height="5"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td height="10"><table cellspacing="0" cellpadding="0"  width="170">
                    <tr>
                      <td width="85"><img  src="img/btn_pvc_pros.gif">&nbsp;</td>
                      <td align="right" width="85"><img  src="img/btn_pvc_cons.gif"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td height="10"><table cellspacing="0" cellpadding="0"  width="170">
                    <tr>
                      <td width="85" style="color: #0066cc"><b>14%</b></td>
                      <td align="right" width="85" style="color: #ff6600"><b>86%</b></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td background="img/bg_box01(1).gif" align="center" valign="top"></td>
        </tr>
        <tr>
          <td background="img/bg_box01(1).gif" align="center"></td>
        </tr>
        <tr>
          <td><img  width="190" height="10" src="img/bg_box01_bottom(1).gif"></td>
        </tr>
      </table></td>
  </tr>
</table>
