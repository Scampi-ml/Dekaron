{include file="inc/view_header.tpl"}
<aside id="right">
    <div id="content_ajax">
        <article class="subpage">
            <h1 class="top sub-header"><p>Deadfront</p></h1>
            <section class="body">
            	<script type="text/javascript">countdown_x1500 = "{$deadfront_time}";</script> 
            	<center>
                	<h3>The next Deadfront will be in </h3>
                	<br />
                    <br />
                	<span id="nationwarx1500" style="font-size:40px; font-weight:bold;"></span>
                    <br />
                    <br />
                    Current time is now: <span id="footerClock" style="font-size:20px; font-weight:bold;"></span>
                </center>
                <br />
                <br />
                <table width="100%">
                  <thead>
                    <tr>
                      <th align="center" width="33%"><b>Deadront Time <span style="color:#FF0000;">*</span></b></th>
                      <th align="center" width="33%"><b>Min Level ~ Max Level</b></th>
                      <th align="center" width="33%"><b>Required Players</b></th>
                    </tr>
                  </thead>                
                    <tbody>
                    	<tr>
                        	<td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
						{$deadfront_list}             
                    </tbody>
                </table>                 
                <br />
                <p><i><center>Please make sure you are atleast 30 minutes before deadfront time at the NPCs!</center></i></p>
                <p><center><span style="color:#FF0000;">*</span><i> Times are in <b>"UTC/GMT +4 hours"</b></center></i></p>
                <!--
                // Explain why you need to be there //
                <ul>
                	<li>30 Min before time => Announcemnt of Deadfront</li>
                    <li>30 Min before time => Announcemnt of Deadfront</li>
                    <li>30 Min before time => Announcemnt of Deadfront</li>
                    <li>30 Min before time => Announcemnt of Deadfront</li>
                    <li>30 Min before time => Announcemnt of Deadfront</li>
                    <li>30 Min before time => Announcemnt of Deadfront</li>
                </ul>
               	--> 
            </section>
        </article>
    </div>
</aside>      
{include file="inc/view_footer.tpl"}