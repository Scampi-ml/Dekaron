

<html>
<head>

<Title>KalOnline</Title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="http://web.archive.org/web/20071207145051cs_/http://www.kalonline.com/Common/Style.css" rel="stylesheet" type="text/css">


<Script Language="javascript">

function sendform(){
	form = document.Search;
	if(form.SearchStr.value == ""){
		alert("Blank");
		form.SearchStr.focus();
	return false;
	}
}

</Script>

</head>

<body style="margin:0px 0px 0px 0px; " background="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Community/bg.gif">
<!-- BEGIN WAYBACK TOOLBAR INSERT -->

<script type="text/javascript" src="http://staticweb.archive.org/js/disclaim-element.js" ></script>
<script type="text/javascript" src="http://staticweb.archive.org/js/graph-calc.js" ></script>
<script type="text/javascript" src="http://staticweb.archive.org/jflot/jquery.min.js" ></script>
<script type="text/javascript">
//<![CDATA[
var firstDate = 820454400000;
var lastDate = 1325375999999;
var wbPrefix = "http://web.archive.org/web/";
var wbCurrentUrl = "http:\/\/www.kalonline.com\/Community\/Notice_View.asp?IDX=632";

var curYear = -1;
var curMonth = -1;
var yearCount = 16;
var firstYear = 1996;
var imgWidth=400;
var yearImgWidth = 25;
var monthImgWidth = 2;
var trackerVal = "none";
var displayDay = "7";
var displayMonth = "dec";
var displayYear = "2007";
var prettyMonths = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

function showTrackers(val) {
	if(val == trackerVal) {
		return;
	}
	if(val == "inline") {
		document.getElementById("displayYearEl").style.color = "#ec008c";
		document.getElementById("displayMonthEl").style.color = "#ec008c";
		document.getElementById("displayDayEl").style.color = "#ec008c";		
	} else {
		document.getElementById("displayYearEl").innerHTML = displayYear;
		document.getElementById("displayYearEl").style.color = "#ff0";
		document.getElementById("displayMonthEl").innerHTML = displayMonth;
		document.getElementById("displayMonthEl").style.color = "#ff0";
		document.getElementById("displayDayEl").innerHTML = displayDay;
		document.getElementById("displayDayEl").style.color = "#ff0";
	}
   document.getElementById("wbMouseTrackYearImg").style.display = val;
   document.getElementById("wbMouseTrackMonthImg").style.display = val;
   trackerVal = val;
}
function getElementX2(obj) {
	var thing = jQuery(obj);
	if((thing == undefined) 
			|| (typeof thing == "undefined") 
			|| (typeof thing.offset == "undefined")) {
		return getElementX(obj);
	}
	return Math.round(thing.offset().left);
}
function trackMouseMove(event,element) {

   var eventX = getEventX(event);
   var elementX = getElementX2(element);
   var xOff = eventX - elementX;
	if(xOff < 0) {
		xOff = 0;
	} else if(xOff > imgWidth) {
		xOff = imgWidth;
	}
   var monthOff = xOff % yearImgWidth;

   var year = Math.floor(xOff / yearImgWidth);
	var yearStart = year * yearImgWidth;
   var monthOfYear = Math.floor(monthOff / monthImgWidth);
   if(monthOfYear > 11) {
       monthOfYear = 11;
   }
   // 1 extra border pixel at the left edge of the year:
   var month = (year * 12) + monthOfYear;
   var day = 1;
	if(monthOff % 2 == 1) {
		day = 15;
	}
	var dateString = 
		zeroPad(year + firstYear) + 
		zeroPad(monthOfYear+1,2) +
		zeroPad(day,2) + "000000";

	var monthString = prettyMonths[monthOfYear];
	document.getElementById("displayYearEl").innerHTML = year + 1996;
	document.getElementById("displayMonthEl").innerHTML = monthString;
	// looks too jarring when it changes..
	//document.getElementById("displayDayEl").innerHTML = zeroPad(day,2);

	var url = wbPrefix + dateString + '/' +  wbCurrentUrl;
	document.getElementById('wm-graph-anchor').href = url;

   //document.getElementById("wmtbURL").value="evX("+eventX+") elX("+elementX+") xO("+xOff+") y("+year+") m("+month+") monthOff("+monthOff+") DS("+dateString+") Moy("+monthOfYear+") ms("+monthString+")";
   if(curYear != year) {
       var yrOff = year * yearImgWidth;
       document.getElementById("wbMouseTrackYearImg").style.left = yrOff + "px";
       curYear = year;
   }
   if(curMonth != month) {
       var mtOff = year + (month * monthImgWidth) + 1;
       document.getElementById("wbMouseTrackMonthImg").style.left = mtOff + "px";
       curMonth = month;
   }
}
//]]>
</script>

<style type="text/css">body{margin-top:0!important;padding-top:0!important;min-width:800px!important;}#wm-ipp a:hover{text-decoration:underline!important;}</style>
<div id="wm-ipp" style="display:none; position:relative;padding:0 5px;min-height:70px;min-width:800px; z-index:9000;">
<div id="wm-ipp-inside" style="position:fixed;padding:0!important;margin:0!important;width:97%;min-width:780px;border:5px solid #000;border-top:none;background-image:url(http://staticweb.archive.org/images/toolbar/wm_tb_bk_trns.png);text-align:center;-moz-box-shadow:1px 1px 3px #333;-webkit-box-shadow:1px 1px 3px #333;box-shadow:1px 1px 3px #333;font-size:11px!important;font-family:'Lucida Grande','Arial',sans-serif!important;">
   <table style="border-collapse:collapse;margin:0;padding:0;width:100%;"><tbody><tr>
   <td style="padding:10px;vertical-align:top;min-width:110px;">
   <a href="http://wayback.archive.org/web/" title="Wayback Machine home page" style="background-color:transparent;border:none;"><img src="http://staticweb.archive.org/images/toolbar/wayback-toolbar-logo.png" alt="Wayback Machine" width="110" height="39" border="0"/></a>
   </td>
   <td style="padding:0!important;text-align:center;vertical-align:top;width:100%;">

       <table style="border-collapse:collapse;margin:0 auto;padding:0;width:570px;"><tbody><tr>
       <td style="padding:3px 0;" colspan="2">
       <form target="_top" method="get" action="http://wayback.archive.org/web/form-submit.jsp" name="wmtb" id="wmtb" style="margin:0!important;padding:0!important;"><input type="text" name="url" id="wmtbURL" value="http://www.kalonline.com/Community/Notice_View.asp?IDX=632" style="width:400px;font-size:11px;font-family:'Lucida Grande','Arial',sans-serif;" onfocus="javascript:this.focus();this.select();" /><input type="hidden" name="type" value="replay" /><input type="hidden" name="date" value="20071207145051" /><input type="submit" value="Go" style="font-size:11px;font-family:'Lucida Grande','Arial',sans-serif;margin-left:5px;" /><span id="wm_tb_options" style="display:block;"></span></form>
       </td>
       <td style="vertical-align:bottom;padding:5px 0 0 0!important;" rowspan="2">
           <table style="border-collapse:collapse;width:110px;color:#99a;font-family:'Helvetica','Lucida Grande','Arial',sans-serif;"><tbody>
			
           <!-- NEXT/PREV MONTH NAV AND MONTH INDICATOR -->
           <tr style="width:110px;height:16px;font-size:10px!important;">
           	<td style="padding-right:9px;font-size:11px!important;font-weight:bold;text-transform:uppercase;text-align:right;white-space:nowrap;overflow:visible;" nowrap="nowrap">
               
		                <a href="http://web.archive.org/web/20071102035341/http://www.kalonline.com/Community/Notice_View.asp?IDX=632" style="text-decoration:none;color:#33f;font-weight:bold;background-color:transparent;border:none;" title="2 nov 2007"><strong>NOV</strong></a>
		                
               </td>
               <td id="displayMonthEl" style="background:#000;color:#ff0;font-size:11px!important;font-weight:bold;text-transform:uppercase;width:34px;height:15px;padding-top:1px;text-align:center;" title="You are here: 14:50:51 dec 7, 2007">DEC</td>
				<td style="padding-left:9px;font-size:11px!important;font-weight:bold;text-transform:uppercase;white-space:nowrap;overflow:visible;" nowrap="nowrap">
               
		                <a href="http://web.archive.org/web/20080122035217/http://www.kalonline.com/Community/Notice_View.asp?IDX=632" style="text-decoration:none;color:#33f;font-weight:bold;background-color:transparent;border:none;" title="22 jan 2008"><strong>JAN</strong></a>
		                
               </td>
           </tr>

           <!-- NEXT/PREV CAPTURE NAV AND DAY OF MONTH INDICATOR -->
           <tr>
               <td style="padding-right:9px;white-space:nowrap;overflow:visible;text-align:right!important;vertical-align:middle!important;" nowrap="nowrap">
               
		                <a href="http://web.archive.org/web/20071123034757/http://www.kalonline.com/Community/Notice_View.asp?IDX=632" title="3:47:57 nov 23, 2007" style="background-color:transparent;border:none;"><img src="http://staticweb.archive.org/images/toolbar/wm_tb_prv_on.png" alt="Previous capture" width="14" height="16" border="0" /></a>
		                
               </td>
               <td id="displayDayEl" style="background:#000;color:#ff0;width:34px;height:24px;padding:2px 0 0 0;text-align:center;font-size:24px;font-weight: bold;" title="You are here: 14:50:51 dec 7, 2007">7</td>
				<td style="padding-left:9px;white-space:nowrap;overflow:visible;text-align:left!important;vertical-align:middle!important;" nowrap="nowrap">
               
		                <a href="http://web.archive.org/web/20071222145504/http://www.kalonline.com/Community/Notice_View.asp?IDX=632" title="14:55:04 dec 22, 2007" style="background-color:transparent;border:none;"><img src="http://staticweb.archive.org/images/toolbar/wm_tb_nxt_on.png" alt="Next capture" width="14" height="16" border="0"/></a>
		                
			    </td>
           </tr>

           <!-- NEXT/PREV YEAR NAV AND YEAR INDICATOR -->
           <tr style="width:110px;height:13px;font-size:9px!important;">
				<td style="padding-right:9px;font-size:11px!important;font-weight: bold;text-align:right;white-space:nowrap;overflow:visible;" nowrap="nowrap">
               
                       2006
                       
               </td>
               <td id="displayYearEl" style="background:#000;color:#ff0;font-size:11px!important;font-weight: bold;padding-top:1px;width:34px;height:13px;text-align:center;" title="You are here: 14:50:51 dec 7, 2007">2007</td>
				<td style="padding-left:9px;font-size:11px!important;font-weight: bold;white-space:nowrap;overflow:visible;" nowrap="nowrap">
               
                       2008
                       
				</td>
           </tr>
           </tbody></table>
       </td>

       </tr>
       <tr>
       <td style="vertical-align:middle;padding:0!important;">
           <a href="http://wayback.archive.org/web/20071207145051*/http://www.kalonline.com/Community/Notice_View.asp?IDX=632" style="color:#33f;font-size:11px;font-weight:bold;background-color:transparent;border:none;" title="See a list of every capture for this URL"><strong>13 captures</strong></a>
           <div style="margin:0!important;padding:0!important;color:#666;font-size:9px;padding-top:2px!important;white-space:nowrap;" title="Timespan for captures of this URL">1 nov 07 - 3 okt 08</div>
       </td>
       <td style="padding:0!important;">
       <a style="position:relative; white-space:nowrap; width:400px;height:27px;" href="" id="wm-graph-anchor">
       <div id="wm-ipp-sparkline" style="position:relative; white-space:nowrap; width:400px;height:27px;background-color:#fff;cursor:pointer;border-right:1px solid #ccc;" title="Explore captures for this URL">
			<img id="sparklineImgId" style="position:absolute; z-index:9012; top:0px; left:0px;"
				onmouseover="showTrackers('inline');" 
				onmouseout="showTrackers('none');"
				onmousemove="trackMouseMove(event,this)"
				alt="sparklines"
				width="400"
				height="27"
				border="0"
				src="http://wayback.archive.org/jsp/graph.jsp?graphdata=400_27_1996:-1:000000000000_1997:-1:000000000000_1998:-1:000000000000_1999:-1:000000000000_2000:-1:000000000000_2001:-1:000000000000_2002:-1:000000000000_2003:-1:000000000000_2004:-1:000000000000_2005:-1:000000000000_2006:-1:000000000000_2007:11:000000000042_2008:-1:111111000100_2009:-1:000000000000_2010:-1:000000000000_2011:-1:000000000000"></img>
			<img id="wbMouseTrackYearImg" 
				style="display:none; position:absolute; z-index:9010;"
				width="25" 
				height="27"
				border="0"
				src="http://staticweb.archive.org/images/toolbar/transp-yellow-pixel.png"></img>
			<img id="wbMouseTrackMonthImg"
				style="display:none; position:absolute; z-index:9011; " 
				width="2"
				height="27" 
				border="0"
				src="http://staticweb.archive.org/images/toolbar/transp-red-pixel.png"></img>
       </div>
		</a>

       </td>
       </tr></tbody></table>
   </td>
   <td style="text-align:right;padding:5px;width:65px;font-size:11px!important;">
       <a href="javascript:;" onclick="document.getElementById('wm-ipp').style.display='none';" style="display:block;padding-right:18px;background:url(http://staticweb.archive.org/images/toolbar/wm_tb_close.png) no-repeat 100% 0;color:#33f;font-family:'Lucida Grande','Arial',sans-serif;margin-bottom:23px;background-color:transparent;border:none;" title="Close the toolbar">Close</a>
       <a href="http://faq.web.archive.org/" style="display:block;padding-right:18px;background:url(http://staticweb.archive.org/images/toolbar/wm_tb_help.png) no-repeat 100% 0;color:#33f;font-family:'Lucida Grande','Arial',sans-serif;background-color:transparent;border:none;" title="Get some help using the Wayback Machine">Help</a>
   </td>
   </tr></tbody></table>

</div>
</div>
<script type="text/javascript">
 var wmDisclaimBanner = document.getElementById("wm-ipp");
 if(wmDisclaimBanner != null) {
   disclaimElement(wmDisclaimBanner);
 }
</script>
<!-- END WAYBACK TOOLBAR INSERT -->

<table width="1004" border="0" cellspacing="0" cellpadding="0" id="table1">
  <tr>
    <td height="25" align="left"><table width="860" height="25" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right" background="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/top.gif"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/index.asp" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/home_1.gif" onMouseOver="src='http://img.kalonline.com/EKal_0511/Common/home_01.gif'" onMouseOut="src='http://img.kalonline.com/EKal_0511/Common/home_1.gif'" border="0"></a><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/User/Login.asp" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/login_1.gif" onMouseOver="src='http://img.kalonline.com/EKal_0511/Common/login_01.gif'" onMouseOut="src='http://img.kalonline.com/EKal_0511/Common/login_1.gif'" border="0"></a><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/User/Agreement.asp" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/join_1.gif" onMouseOver="src='http://img.kalonline.com/EKal_0511/Common/join_01.gif'" onMouseOut="src='http://img.kalonline.com/EKal_0511/Common/join_1.gif'" border="0"></a></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td height="225"><script language="javascript" type="text/javascript" src="http://web.archive.org/web/20071207145051js_/http://www.kalonline.com/Common/flashobj.js"></script> 
<script language="javascript" type="text/javascript"> 
<!--
function objCall(strpath,strwid,strhei){
var fla = new FlashObject(strpath, strwid, strhei); 
fla.wmode = "transparent"; 
fla.Render(); 
}
//-->
</script>


<SCRIPT LANGUAGE="JavaScript">
<!--
objCall("http://web.archive.org/web/20071207145051/http://img.kalonline.com//EKal_0511/Flash/com_070817.swf","1004","225");
//-->
</SCRIPT></td>
  </tr>
  <tr>
    <td align="right">
	
	<table width="979" border="0" cellspacing="0" cellpadding="0" id="table2">
      <tr>
        <td width="180" rowspan="2" valign="top" background="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/menu_bg.gif">
<table width="180" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="73"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Community/title.jpg" border="0"></td>
  </tr>
  <tr>
    <td height="37"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Community/Notice_List.asp?btn=1" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Community/menu_05.gif" onMouseOver="src='http://img.kalonline.com/EKal_0511/Community/menu_05.gif';" onMouseOut="src='http://img.kalonline.com/EKal_0511/Community/menu_05.gif';" border="0"></a></td>
  </tr>
    <tr>
    <td height="30"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Community/Update_List.asp?btn=7" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Community/menu_8.gif" onMouseOver="src='http://img.kalonline.com/EKal_0511/Community/menu_08.gif';" onMouseOut="src='http://img.kalonline.com/EKal_0511/Community/menu_8.gif';" border="0"></a></td>
  </tr>
      <tr>
    <td height="37"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Community/KalWorld_List.asp?btn=11" onfocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Community/menu_11.gif" onmouseover="src='http://img.kalonline.com/EKal_0511/Community/menu_011.gif';" onmouseout="src='http://img.kalonline.com/EKal_0511/Community/menu_11.gif';" border="0"></a></td>
  </tr>
  <tr>
    <td height="37"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Community/FreeBoard.asp?BoardType=List&btn=2" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Community/menu_1.gif" onMouseOver="src='http://img.kalonline.com/EKal_0511/Community/menu_01.gif';" onMouseOut="src='http://img.kalonline.com/EKal_0511/Community/menu_1.gif';" border="0"></a></td>
  </tr>
  <tr>
    <td height="30"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Community/Fansite.asp?btn=3" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Community/menu_2.gif" onMouseOver="src='http://img.kalonline.com/EKal_0511/Community/menu_02.gif';" onMouseOut="src='http://img.kalonline.com/EKal_0511/Community/menu_2.gif';" border="0"></a></td>
  </tr>
  <tr>
    <td height="30"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Community/Ranking.asp?btn=4" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Community/menu_7.gif" onMouseOver="src='http://img.kalonline.com/EKal_0511/Community/menu_07.gif';" onMouseOut="src='http://img.kalonline.com/EKal_0511/Community/menu_7.gif';" border="0"></a></td>
  </tr>
  <!--tr>
    <td height="30"><a href="/Community/Email.asp?btn=5" onFocus="blur();"><img src="http://img.kalonline.com/EKal_0511/Community/menu_4.gif" onMouseOver="src='http://img.kalonline.com/EKal_0511/Community/menu_04.gif';" onMouseOut="src='http://img.kalonline.com/EKal_0511/Community/menu_4.gif';" border="0"></a></td>
  </tr>
    <tr>
    <td height="30"><a href="/Community/Poll_List.asp?btn=6" onFocus="blur();"><img src="http://img.kalonline.com/EKal_0511/Community/menu_6.gif" onMouseOver="src='http://img.kalonline.com/EKal_0511/Community/menu_06.gif';" onMouseOut="src='http://img.kalonline.com/EKal_0511/Community/menu_6.gif';" border="0"></a></td>
  </tr-->
  <tr>
    <td height="30"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Event/Event_List.asp?btn=8" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Community/menu_9.gif" onMouseOver="src='http://img.kalonline.com/EKal_0511/Community/menu_09.gif';" onMouseOut="src='http://img.kalonline.com/EKal_0511/Community/menu_9.gif';" border="0"></a></td>
  </tr>
</table>
</td>
        <td rowspan="3" width="5"></td>
        <td valign="top"><table background="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/c_mid.gif" width="650" border="0" cellspacing="0" cellpadding="0" id="table3">
          <tr>
            <td height="15" valign="top"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Community/c_top.gif"></td>
          </tr>
          <tr>
            <td align="center"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Community/ne_title.gif"></td>
          </tr>
          <tr>
            <td height="20">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">


						  <table width="100%" border="0" cellpadding="0" cellspacing="0">

                          <tr> 
                            <td align="center">
							  <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td height="2" bgcolor="87633F"></td>
                                </tr>
                                <tr> 
                                  <td height="40" align="center">
								    <table width="99%" height="30" border="0" cellpadding="0" cellspacing="0" bgcolor="efefef">
                                      <tr> 
                                        <td width="20">&nbsp;</td>
                                        <td width="468"><font color="401f18">Notice for Event 'Get 10,000 Kal Points'</font><br></td>
                                        <td width="100" align="center">2007-10-31 11:59:22 </td>
                                        <td width="100" align="center">4304</td>
                                      </tr>
                                    </table>
								  </td>
                                </tr>
                                <tr> 
                                  <td align="center" class="board">
								    <table width="99%" border="0" cellpadding="0" cellspacing="0" class="line_ALL">
                                      <tr> 
                                        <td width="25">&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr> 
                                        <td>&nbsp;</td>
                                        <td width="600" style="word-break:break-all">Hello.<br>
<br>
This is KalOnline.<br>
<br>
We are very grateful to KalOnline players using KalCash shop.<br>
<br>
We are proudly hosting KalCash Event go give Kal Point away.<br>
<br>
Please refer to our event page (http://www.kalonline.com/Event/Event071030.asp?btn=8).<br>
<br>
Do not miss out on hot event.<br>
<br>
We will make every effort to meet your needs and provide you with satisfactory services.<br>
<br>
Thank you.</td>
                                      </tr>
                                      <tr> 
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td height="5"></td>
                                </tr>
                                <tr> 
                                  <td height="1" bgcolor="#A65700"></td>
                                </tr>
                                <tr> 
                                  <td height="10"></td>
                                </tr>
                                <tr>
                                  <td>
			

								    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td width="100">&nbsp;</td>
                                        <td align="right">
										
											<a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Community/Notice_View.asp?StartPage=&PageNo=&IDX=621&SearchField=&SearchStr=" class="link_black_1" border=0><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/KalEng/ContactUs/b_prev.gif" border="0"></a>
										 </td>
                                        <td width="15">&nbsp;</td>
                                        <td>
										
										  <a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Community/Notice_View.asp?StartPage=&PageNo=&IDX=634&SearchField=&SearchStr=" class="link_black_1" border=0><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/KalEng/ContactUs/b_next.gif" border="0"></a>
										  		
																				</td>
                                        <td width="100" align="center"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Community/Notice_List.asp"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/KalEng/ContactUs/b_list.gif" border="0"></a></td>
                                      </tr>
                                    </table>

								  </td>
                                </tr>
                              </table>
							</td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                        </table>

			
			

	
			
			
			</td>
          </tr>
          <tr>
            <td><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/c_bottom.gif"></td>
          </tr>
        </table>
          </td>
        <td width="5" rowspan="3"></td>
        <td width="139" rowspan="3" valign="top">          <table width="190" border="0" cellspacing="0" cellpadding="0">
		  <!--tr>
		    <td valign="top"><a href="/GameInfo/Emokdo.asp?btn=1" onfocus="blur();">
			<img src="http://img.kalonline.com/EKal_0511/NewMain_/Banner_Emokdo.gif" border="0"></a></td>
          </tr-->
		  <tr>
		    <td valign="top"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Intermediate/CatchingDream.asp?btn=3" onFocus="blur();">
			<img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/NewMain_/Banner_Up_071108.gif" border="0"></a></td>
          </tr>
  		  <tr>
		    <td height="5"></td>
		  </tr>
		  <tr>
		    <td valign="top"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/GameInfo/Weapon01_51-70.asp?btn=3#65" onFocus="blur();">
			<img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/NewMain_/Banner_Up_071130.gif" border="0"></a></td>
          </tr>
  		  <tr>
		    <td height="5"></td>
		  </tr>
		  <tr>
		    <td valign="top"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/ItemShop/CashChargeSelect_Bronze.asp?btn=5" onFocus="blur();">
			<img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/NewMain_/Banner_Up_Attendance.gif" border="0"></a></td>
          </tr>
  		  <tr>
		    <td height="5"></td>
		  </tr>
		  <tr>
		    <td valign="top"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/ItemShop/CashChargeSelect_Bronze.asp?btn=5" onfocus="blur();">
			<img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/NewMain_/Banner_KalW.jpg" border="0"></a></td>
          </tr>
  		  <tr>
		    <td height="5"></td>
		  </tr>
		  <tr>
		    <td valign="top"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Customer/Comic6.asp?btn=10" onfocus="blur();">
			<img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/NewMain_/Banner_Comic_061128.jpg" border="0"></a></td>
          </tr>




  <!--tr>
    <td><a href="http://www.kalonline.co.kr" onFocus="blur();" target="_blank"><img src="http://img.kalonline.com/EKal_0511/Common/banner_01.jpg" border="0"></a></td>
  </tr>

  <tr>
    <td height="2"></td>
  </tr>
  <tr>
    <td><a href="http://eng.inixsoft.co.kr" onFocus="blur();" target="_blank"><img src="http://img.kalonline.com/EKal_0511/Common/banner_02.jpg" border="0"></a></td>
  </tr>
  <tr>
    <td height="2"></td>
  </tr>
  <tr>
    <td><a href="http://eng.shinru.co.kr" onFocus="blur();" target="_blank"><img src="http://img.kalonline.com/EKal_0511/Common/banner_03.jpg" border="0"></a></td>
  </tr>

  <tr>
    <td height="2"></td>
  </tr>
  <tr>
    <td align=center><script src="https://siteseal.thawte.com/cgi/server/thawte_seal_generator.exe"></script></td>
  </tr-->



 



</table>
 <Script Language="javascript">
function OpenSystem1()
		{
			window.open("http://web.archive.org/web/20071207145051/http://www.kalonline.com//Vbv_1.asp","popup","toolbar=0,menubar=0,scrollbars=no,resizable=no,width=555,height=361");
		}

</Script></td>
      </tr>
      <tr>
        <td height="5"></td>
        </tr>
      <tr>
        <td align="left" valign="bottom" background="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/menu_bg.gif" bgcolor="#EFEFE7"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/menu_bgb.gif"></td>
        <td align="left" valign="top"><table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="650" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" bgcolor="E0DED7"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/cp_l.gif"></td>
        <td width="80"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Customer/Stipulation.asp?btn=1" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/cpb_01.gif" border="0"></a></td>
        <td width="215"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Customer/CashStipulation.asp?btn=2" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/cpb_02.gif" border="0"></a></td>
        <td width="87"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Customer/Policy01.asp" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/cpb_03.gif" border="0"></a></td>
        <td width="66"><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Customer/SiteMap.asp" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/cpb_04.gif" border="0"></a></td>
        <td align="right" bgcolor="E0DED7"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/cp_r.gif"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/copyright.gif"></td>
  </tr>
</table>
<div id=divMenu style="LEFT: 858px; WIDTH: 22px; POSITION: absolute; TOP: 496px">
<TABLE cellSpacing=0 cellPadding=0 width=22 height="30" border=0>
  <TBODY>
  <TR>
    <TD><a href="http://web.archive.org/web/20071207145051/http://www.kalonline.com/Community/Notice_View.asp?IDX=632#" onFocus="blur();"><img src="http://web.archive.org/web/20071207145051im_/http://img.kalonline.com/EKal_0511/Common/b_top.gif" border="0"></a></TD></TR></TBODY></TABLE></DIV>
	<script language=javascript>
<!--
var bNetscape4plus = (navigator.appName == "Netscape" && navigator.appVersion.substring(0,1) >= "4");
var bExplorer4plus = (navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.substring(0,1) >= "4");
function CheckUIElements(){
        var yMenuFrom, yMenuTo, yButtonFrom, yButtonTo, yOffset, timeoutNextCheck;

        if ( bNetscape4plus ) { 
                yMenuFrom   = document["divMenu"].top;
                yMenuTo     = top.pageYOffset + 600; // ⓒøY¨o¨￢￠?e ¡¤ⓒoAI¨ui Y AAC¡I
        }
        else if ( bExplorer4plus ) {
                yMenuFrom   = parseInt (divMenu.style.top, 10);
                yMenuTo     = document.body.scrollTop + 600; // AI¨o¨￢￠?e ¡¤ⓒoAI¨ui Y AAC¡I
        }

        timeoutNextCheck = 500;

        if ( Math.abs (yButtonFrom - (yMenuTo + 152)) < 6 && yButtonTo < yButtonFrom ) {
                setTimeout ("CheckUIElements()", timeoutNextCheck);
                return;
        }

        if ( yButtonFrom != yButtonTo ) {
                yOffset = Math.ceil( Math.abs( yButtonTo - yButtonFrom ) / 10 );
                if ( yButtonTo < yButtonFrom )
                        yOffset = -yOffset;

                if ( bNetscape4plus )
                        document["divLinkButton"].top += yOffset;
                else if ( bExplorer4plus )
                        divLinkButton.style.top = parseInt (divLinkButton.style.top, 10) + yOffset;

                timeoutNextCheck = 10;
        }
        if ( yMenuFrom != yMenuTo ) {
                yOffset = Math.ceil( Math.abs( yMenuTo - yMenuFrom ) / 20 );
                if ( yMenuTo < yMenuFrom )
                        yOffset = -yOffset;

                if ( bNetscape4plus )
                        document["divMenu"].top += yOffset;
                else if ( bExplorer4plus )
                        divMenu.style.top = parseInt (divMenu.style.top, 10) + yOffset;

                timeoutNextCheck = 10;
        }

        setTimeout ("CheckUIElements()", timeoutNextCheck);
}

function OnLoad()
{
        var y;
        if ( top.frames.length )
        if ( bNetscape4plus ) {
                document["divMenu"].top = top.pageYOffset + 600;  //ⓒøY¨o¨￢￠?e ¡¤ⓒoAI¨ui Y AAC¡I

                document["divMenu"].visibility = "visible";
        }
        else if ( bExplorer4plus ) {
                divMenu.style.top = document.body.scrollTop + 600;  //AI¨o¨￢￠?e ¡¤ⓒoAI¨ui Y AAC¡I

                divMenu.style.visibility = "visible";
        }
        CheckUIElements();
        return true;
}
OnLoad();
//-->
</script>



<script src="http://web.archive.org/web/20071207145051js_/http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-810656-1";
urchinTracker();
</script></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>





<!--
     FILE ARCHIVED ON 14:50:51 dec 7, 2007 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 12:35:14 nov 30, 2011.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
-->
