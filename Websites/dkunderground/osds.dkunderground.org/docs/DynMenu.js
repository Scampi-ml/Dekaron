function getBrowserType()
{
	var BODY_EL = (document.compatMode && document.compatMode != "BackCompat")?
				 document.documentElement : 
				 document.body ? document.body : null;
	var user_Agent = navigator.userAgent.toLowerCase();
	var Agent_version = navigator.appVersion;
	var isOpera = !!(window.opera && document.getElementById);
	var isOpera6 = isOpera && !document.defaultView;
	var isOpera7 = isOpera && !isOpera6;
	var isMSIE = (user_Agent.indexOf("msie") != -1) && document.all && BODY_EL && !isOpera;
	var isMSIE6 = isMSIE && parseFloat(Agent_version.substring(Agent_version.indexOf("MSIE")+5)) >= 5.5;
	var isNN4 = (document.layers && typeof document.classes != "undefined");
	var isNN6 = (!isOpera && document.defaultView && typeof document.defaultView.getComputedStyle != "undefined");
	var isW3C_compatible = !isMSIE && !isNN6 && !isOpera && document.getElementById;
	if			 (isOpera6)	return "Opera6";
	if			 (isOpera7)	return "Opera7";
	if			 (isMSIE)	return "MSIE";
	if			 (isMSIE6)	return "MSIE6";
	if				(isNN4)	return "Nav4";
	if				(isNN6)	return "Nav6";
	if	 (isW3C_compatible) return "w3c";
	return null;
}
function Clps(obj){
  for (var i=0; i<GlChld[obj.id].length; i++)
   if (
	   ((getBrowserType() == "MSIE") && obj.opnd == 1) ||
               ((getBrowserType() != "MSIE")  && obj.attributes.opnd.value == 1)
	  )
    {

//    if (obj.attributes.opnd.value == 1){
	var nextobj = document.getElementById(GlChld[obj.id][i]);
	if (nextobj)
	 {
	  nextobj.className = "menu_topic_closed";
	  Clps(nextobj);
	 }
    }
}
function Expand(obj){
 var parName = obj.id;
 parName=parName.substring(0,parName.lastIndexOf("_"));
 var GP = document.getElementById(parName);
 if (   (GP==null) ||     (GP!=null)
  &&  (
        ((getBrowserType() == "MSIE") && GP.opnd == 1) ||
        ((getBrowserType() != "MSIE")  && GP.attributes.opnd.value == 1)
	  )
	)
  {
   obj.className = "menu_topic_opened";
     for (var i=0; i<GlChld[obj.id].length; i++)
      {
	 var nextobj = document.getElementById(GlChld[obj.id][i]);
	  if (nextobj)
	    Expand(nextobj);
	}
  }
  else obj.className = "menu_topic_closed";
}
function IsClosed(obj){
 var Closed =(obj.className=="menu_topic_closed");
  for (var i=0; i<GlChld[obj.id].length; i++){
	var nextchild = document.getElementById(GlChld[obj.id][i]);
	if (nextchild)
  	Closed = Closed && IsClosed(nextchild);
  }
 return Closed;
}
function TglState(img_name, lnkd_obj_id){
 var lnkd_obj = document.getElementById(lnkd_obj_id);
 if (!lnkd_obj) return;
 lnkd_obj.className = "menu_topic_closed";
 img_obj = document.getElementById(img_name);
 getstate = IsClosed(lnkd_obj); 
  if (!getstate){
   Clps(lnkd_obj);
   lnkd_obj.className = "menu_topic_opened";
   attachMyAttrib(lnkd_obj, "opnd", 0);
   img_obj.src = img_obj.src.substring(0,img_obj.src.lastIndexOf("_opened.gif"))+".gif";

   var predImage = img_obj.parentNode.getElementsByTagName("img")[0];
   predImage.src = predImage.src.substring(0, predImage.src.lastIndexOf("minus"))+"plus.gif";
  }
  else {
   lnkd_obj.className = "menu_topic_opened";
   attachMyAttrib(lnkd_obj, "opnd", 1);
   Expand(lnkd_obj);
   lnkd_obj.className = "menu_topic_opened";
   img_obj.src = img_obj.src.substring(0,img_obj.src.lastIndexOf(".gif"))+"_opened.gif";
   var predImage = img_obj.parentNode.getElementsByTagName("img")[0];
   predImage.src = predImage.src.substring(0, predImage.src.lastIndexOf("plus"))+"minus.gif";
  }
}
function OpnNxtPage(nextpage){
 var menuItems = document.getElementById("Table2").getElementsByTagName("tr");
 var paraString= "?MenuState=";
 var MyByte=0;
 var powers_of_2 = new Array(1,2,4,8,16,32);
 var Base64Chars= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789{}";
 var stepno = -1;
  for (var i=0; i<menuItems.length; i++){
	stepno++;
	if (menuItems[i].className=="menu_topic_opened")
	  MyByte += powers_of_2[stepno % 6];
	stepno++;
	if (
	    ((getBrowserType() == "MSIE") && menuItems[i].opnd == 1) ||
	    ((getBrowserType() != "MSIE")  && menuItems[i].attributes.opnd.value == 1)
		)
//	if (menuItems[i].attributes.opnd.value==1)
	  MyByte += powers_of_2[stepno % 6];
	if (stepno==5){
	  paraString += Base64Chars.charAt(MyByte);
	  MyByte = 0;
      stepno = -1;
      }
  }
 if (MyByte)
 paraString += Base64Chars.charAt(MyByte);
 window.open(nextpage+paraString, "_self");
}
function attachMyAttrib(anElement, aName, aValue)
{
 if (getBrowserType().indexOf("MSIE") != -1)
    anElement[aName] = aValue;
 else
 {
	var myNewAttr = document.createAttribute(aName);
	myNewAttr.value = aValue;
	var myOldAttr = anElement.setAttributeNode(myNewAttr);
 }
}
document.getElementsByClassName=function(tagName, clsName){ 
 var arr = new Array(); 
 var elems = document.getElementsByTagName(tagName);
  for ( var cls, i = 0; ( elem = elems[i] ); i++ ){
    if ( elem.className == clsName )
	arr[arr.length] = elem;
  }
 return arr;
}
function 
DrExplain_Menu_Init(){var localvars = document.getElementById("Table2").getElementsByTagName("tr");
TopicCnt = localvars.length;
var clsNames = new Array(TopicCnt);
var VarTOpnd = new Array(TopicCnt);
var Base64Chars= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789{}";
GlChld=new Array();

GlChld["e"] = new Array ("e_1","e_2","e_3","e_4","e_5","e_6","e_7","e_8");

GlChld["e_1"] = new Array ();

GlChld["e_2"] = new Array ();

GlChld["e_3"] = new Array ("e_3_1","e_3_2","e_3_3","e_3_4");

GlChld["e_3_1"] = new Array ("e_3_1_1");

GlChld["e_3_1_1"] = new Array ();

GlChld["e_3_2"] = new Array ("e_3_2_1");

GlChld["e_3_2_1"] = new Array ();

GlChld["e_3_3"] = new Array ();

GlChld["e_3_4"] = new Array ("e_3_4_1");

GlChld["e_3_4_1"] = new Array ();

GlChld["e_4"] = new Array ("e_4_1","e_4_2","e_4_3","e_4_4","e_4_5");

GlChld["e_4_1"] = new Array ();

GlChld["e_4_2"] = new Array ();

GlChld["e_4_3"] = new Array ();

GlChld["e_4_4"] = new Array ();

GlChld["e_4_5"] = new Array ();

GlChld["e_5"] = new Array ("e_5_1","e_5_2","e_5_3","e_5_4","e_5_5","e_5_6","e_5_7","e_5_8","e_5_9","e_5_10","e_5_11","e_5_12","e_5_13","e_5_14");

GlChld["e_5_1"] = new Array ("e_5_1_1","e_5_1_2");

GlChld["e_5_1_1"] = new Array ();

GlChld["e_5_1_2"] = new Array ();

GlChld["e_5_2"] = new Array ();

GlChld["e_5_3"] = new Array ("e_5_3_1","e_5_3_2","e_5_3_3","e_5_3_4");

GlChld["e_5_3_1"] = new Array ();

GlChld["e_5_3_2"] = new Array ();

GlChld["e_5_3_3"] = new Array ("e_5_3_3_1");

GlChld["e_5_3_3_1"] = new Array ();

GlChld["e_5_3_4"] = new Array ();

GlChld["e_5_4"] = new Array ();

GlChld["e_5_5"] = new Array ();

GlChld["e_5_6"] = new Array ("e_5_6_1","e_5_6_2");

GlChld["e_5_6_1"] = new Array ();

GlChld["e_5_6_2"] = new Array ();

GlChld["e_5_7"] = new Array ();

GlChld["e_5_8"] = new Array ();

GlChld["e_5_9"] = new Array ();

GlChld["e_5_10"] = new Array ();

GlChld["e_5_11"] = new Array ();

GlChld["e_5_12"] = new Array ();

GlChld["e_5_13"] = new Array ("e_5_13_1","e_5_13_2","e_5_13_3","e_5_13_4");

GlChld["e_5_13_1"] = new Array ();

GlChld["e_5_13_2"] = new Array ();

GlChld["e_5_13_3"] = new Array ("e_5_13_3_1","e_5_13_3_2");

GlChld["e_5_13_3_1"] = new Array ();

GlChld["e_5_13_3_2"] = new Array ();

GlChld["e_5_13_4"] = new Array ();

GlChld["e_5_14"] = new Array ("e_5_14_1","e_5_14_2","e_5_14_3","e_5_14_4","e_5_14_5","e_5_14_6");

GlChld["e_5_14_1"] = new Array ();

GlChld["e_5_14_2"] = new Array ();

GlChld["e_5_14_3"] = new Array ();

GlChld["e_5_14_4"] = new Array ();

GlChld["e_5_14_5"] = new Array ();

GlChld["e_5_14_6"] = new Array ();

GlChld["e_6"] = new Array ("e_6_1","e_6_2");

GlChld["e_6_1"] = new Array ();

GlChld["e_6_2"] = new Array ();

GlChld["e_7"] = new Array ();

GlChld["e_8"] = new Array ();
  if (!location.search.substring(1)){ 
	opndState = new Array (1,1,1,1,0,0,0,0,0,0,0,1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0
,0,0,0,1,0,0,1,1);
	for(var i=0; i<TopicCnt; i++)
	 clsNames[i] = (opndState[i]==1)?"menu_topic_opened":"menu_topic_closed";
   VarTOpnd = new Array (1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0
,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
 }
 else{
 var Params = location.search.substring(1).split("?"); 
 var estr = Params[0].split('=')[1];
 var MyByte = 0;
 var MyBB= new Array();
  for (var i = 0; i < estr.length; i++){ 
 	 MyByte = Base64Chars.lastIndexOf(estr.charAt(i));
   for (var j = 0; j< 6; j++) 
   
    if (getBrowserType() == "MSIE")
     MyBB[MyBB.length] = (( (MyByte >>> j) & 1)?1:0);
    else
	 MyBB.push(( (MyByte >>> j) & 1)?1:0);
	
  }
  for (var i=0; i<TopicCnt; i++){
  clsNames[i]=  (MyBB[i*2]==1)?"menu_topic_opened":"menu_topic_closed";
  VarTOpnd[i]= MyBB[i*2+1];
  }
 }

 var pagesToOpen = new Array();
 var pagesToExpand = new Array();
 
 if (document.getElementsByClassName('a','menu_active').length)
 {
   var curPageID = document.getElementsByClassName('a','menu_active')[0].parentNode.parentNode.parentNode.id;
   if (curPageID.lastIndexOf('_') != -1)
	curPageID = curPageID.substring(0, curPageID.lastIndexOf('_'));
   while (curPageID != 'e')
	{
		pagesToOpen[pagesToOpen.length] = curPageID;
		pagesToExpand[pagesToExpand.length] = curPageID;
        for (var i=0; i<GlChld[curPageID].length; i++)
        {
			pagesToOpen[pagesToOpen.length] = GlChld[curPageID][i];
	    }

		curPageID = curPageID.substring(0, curPageID.lastIndexOf('_'));
	}	
  }

 
 var menuItems = document.getElementById("Table2").getElementsByTagName("tr");
 for (var i=0; i<TopicCnt; i++){	
 var curvar = menuItems[i];
	if (curvar){

	var bToOpen = 0;

     for (var j =0;j<pagesToExpand.length;j++)
      {
        if (curvar.id == pagesToExpand[j])
	    {
            VarTOpnd[i] = 1;
            /* Expand(curvar); */
            bToOpen = 1;
          }

      }
 
     for (var j =0;j<pagesToOpen.length;j++)
      {
        if (curvar.id == pagesToOpen[j])
	    {
            bToOpen = 1;
          }

      }

	if (bToOpen == 0 && curvar.id != "e")
	 curvar.className	= clsNames[i];
	else
	 curvar.className	= "menu_topic_opened";

	 
	 attachMyAttrib(curvar, "opnd", VarTOpnd[i]);
	 var imgid = "imag"+curvar.id;
	 if (imgid == "image")
			imgid = "AppImage";
		if (VarTOpnd[i]==1)
		    if (getBrowserType() == "MSIE")
				document.getElementById(imgid).style.cursor = "hand";
			else
				document.getElementById(imgid).style.cursor = "pointer";
		else
			document.getElementById(imgid).style.cursor = "default";
	 var imgpath = document.getElementById(imgid).src;
	 var newpath=imgpath;
	 var indexNum = imgpath.lastIndexOf("_opened.gif");
	 if(indexNum >-1)
		newpath = imgpath.substring(0,indexNum)+".gif"
 	 var DivTag = curvar.getElementsByTagName("td")[0].getElementsByTagName("div")[0];
	 	 if (!GlChld[curvar.id].length && imgid != "AppImage")
		 if (DivTag.style.paddingLeft.length != 0){
		 var iPadding = parseInt(DivTag.style.paddingLeft.substring(0,DivTag.style.paddingLeft.length-2),10) + 15;
		 DivTag.style.paddingLeft = iPadding + "px";
		 }
		if (GlChld[curvar.id].length > 0)
			if (VarTOpnd[i] == 1){
 			 var sSRC = imgpath.substring(0, imgpath.lastIndexOf("bullet"))+"minus.gif";
			 var sStr = '<img style=\"cursor: pointer\" src=\"' + sSRC + '\" alt=\"-\" onclick=\"TglState(';
			 sStr += '\'' + imgid+'\',\''+curvar.id+'\')\" />';
 			 DivTag.innerHTML = sStr + DivTag.innerHTML;
			}
			else{
 			 var sSRC = imgpath.substring(0, imgpath.lastIndexOf("bullet"))+"plus.gif";
			 var sStr = '<img style=\"cursor: pointer\" src=\"' + sSRC + '\" alt=\"+\" onclick=\"TglState(';
			 sStr += '\'' + imgid+'\',\''+curvar.id+'\')\" />';
 			 DivTag.innerHTML = sStr + DivTag.innerHTML;
			};	

	 var chldNum = GlChld[menuItems[i].id].length;
	 if (
			(
			((getBrowserType() == "MSIE")  && (curvar.opnd == "0")) ||
			((getBrowserType() != "MSIE")  &&  (curvar.attributes.opnd.value == "0")) 
			)
		&& chldNum)

		 if (indexNum>-1)
		 document.getElementById(imgid).src = newpath;
	};
 }
 var MenuAncs = document.getElementsByClassName("a", "menu");
 for (var i=0; i<MenuAncs.length; i++)
	MenuAncs[i].href = "javascript:OpnNxtPage(\"" + MenuAncs[i].href + "\");";
 var ActAncs = document.getElementsByClassName("a","menu_active");
 for (var i=0; i<ActAncs.length; i++)
	ActAncs[i].href = "javascript:OpnNxtPage(\"" + ActAncs[i].href + "\");";
 var NavAnchor1 = document.getElementById("a1prev");
 if (NavAnchor1) NavAnchor1.href = "javascript:OpnNxtPage(\"" + NavAnchor1.href + "\");";
 var NavAnchor2 = document.getElementById("a1next");
 if (NavAnchor2) NavAnchor2.href = "javascript:OpnNxtPage(\"" + NavAnchor2.href + "\");";
 var NavAnchor3 = document.getElementById("a2prev");
 if (NavAnchor3) NavAnchor3.href = "javascript:OpnNxtPage(\"" + NavAnchor3.href + "\");";
 var NavAnchor4 = document.getElementById("a2next");
 if (NavAnchor4) NavAnchor4.href = "javascript:OpnNxtPage(\"" + NavAnchor4.href + "\");";
 
 if (document.getElementsByClassName('a','menu_active').length)
 {
 var curPageID = document.getElementsByClassName('a','menu_active')[0].parentNode.parentNode.parentNode.id;
 if (curPageID.lastIndexOf('_') != -1)
	curPageID = curPageID.substring(0, curPageID.lastIndexOf('_'));
 var pagesToOpen = new Array();
/*
	while (curPageID != 'e')
	{
		pagesToOpen[pagesToOpen.length] = curPageID;
		curPageID = curPageID.substring(0, curPageID.lastIndexOf('_'));
	}	

	if (!pagesToOpen.length)
		pagesToOpen[0] = document.getElementsByClassName('a','menu_active')[0].parentNode.parentNode.parentNode.id;

	for (i = pagesToOpen.length - 1; i>=0; i--)
	{
		curPageID = pagesToOpen[i];
			{
				img_name = document.getElementById('imag' + curPageID);
				lnkd_obj_id = curPageID;
				var lnkd_obj = document.getElementById(lnkd_obj_id);
				var getstate_local = IsClosed(lnkd_obj); 
					if (!getstate_local && GlChld[lnkd_obj_id].length || pagesToOpen.length == 1)
					{
						lnkd_obj.className = "menu_topic_opened";
						attachMyAttrib(lnkd_obj, "opnd", 1);
						Expand(lnkd_obj);
						lnkd_obj.className = "menu_topic_opened";
						if (img_name.src.lastIndexOf("_opened.gif") == -1 && img_name.src.lastIndexOf("_opened.gif") < img_name.src.length - 10)
							img_name.src = img_name.src.substring(0,img_name.src.lastIndexOf(".gif"))+"_opened.gif";
						var predImage = img_name.parentNode.getElementsByTagName("img")[0];
						if (predImage.src.lastIndexOf("plus.gif") != -1 && predImage.src.lastIndexOf("plus.gif") == predImage.src.length - 8)
							predImage.src = predImage.src.substring(0, predImage.src.lastIndexOf("plus"))+"minus.gif";
					}
			}
	}
*/
}

} 