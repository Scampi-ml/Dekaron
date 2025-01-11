
if(!Curse)
{var Curse={};}
Curse.Browser={ie:navigator.appName.indexOf("Microsoft")!=-1,ie7:this.ie&&navigator.appVersion.indexOf("MSIE 7")!=-1,ie6:this.ie&&navigator.appVersion.indexOf("MSIE 6")!=-1,opera:!!window.opera,safari:navigator.userAgent.indexOf("Safari")!=-1,gecko:navigator.userAgent.indexOf("Gecko")!=-1&&navigator.userAgent.indexOf("KHTML")==-1};Curse.Client={viewportWidth:function(){return self.innerWidth||(document.documentElement.clientWidth||document.body.clientWidth);},viewportHeight:function(){return self.innerHeight||(document.documentElement.clientHeight||document.body.clientHeight);},viewportSize:function(){return{width:this.viewportWidth(),height:this.viewportHeight()};},scrollTop:function()
{if(self.pageYOffset)
{return self.pageYOffset;}
else if(document.documentElement&&!document.documentElement.scrollTop)
{return 0;}
else if(document.documentElement&&document.documentElement.scrollTop)
{return document.documentElement.scrollTop;}
else if(document.body&&document.body.scrollTop)
{return document.body.scrollTop;}}};function cg_args(a)
{var r=[];for(var i=0,len=a.length;i<len;++i)
{r.push(a[i]);}
return r;}
function cg_indexOfAll(str,find){var indices=[];var current=0;while(str.indexOf(find,current)>=0){current=str.indexOf(find,current);indices.push(current);current++;}
return indices;}
if(!Array.indexOf)
{Array.prototype.indexOf=function(obj)
{for(var i=0;i<this.length;i++)
{if(this[i]==obj)
{return i;}}
return-1;}}
if(!Curse.Browser.ie)
{HTMLElement.prototype.contains=function(oEl){if(oEl==this)return true;if(oEl==null)return false;try{return this.contains(oEl.parentNode)}
catch(err){}};}
Function.prototype.bindAsEventListener=function(object){var __method=this;return function(event){return __method.call(object,event||window.event);}}
Function.prototype.bind=function()
{var ref=this;var args=cg_args(arguments);var object=args.shift();return function()
{return ref.apply(object,args.concat(cg_args(arguments)));};};function cg_iterateArray(arr,func,ud)
{var res;for(var i=0,len=arr.length;i<len;++i)
{res=func(arr[i],ud,arr,i);if(res!=null)
{arr[i]=res;}}}
function cg_inArray(a,r,f,s)
{if(a==null)
{return-1;}
if(f)
{return cg_inArrayF(a,r,f);}
for(var i=s||0,len=a.length;i<len;++i)
{if(a[i]==r)
{return i;}}
return-1;}
function cg_inArrayF(a,b,c,d)
{for(var i=d||0,len=a.length;i<len;++i)
{if(c(a[i])==b)
{return i;}}
return-1;}
function cg_de(a)
{if(a)
{a.parentNode.removeChild(a);}}
function cg_strcmp(a,b)
{if(a==b)
{return 0;}
if(a==null)
{return-1;}
if(b==null)
{return 1;}
return a<b?-1:1;}
function cg_cOr(a,b)
{for(var p in b)
{if(typeof b[p]=="object")
{if(!a[p])
{a[p]={};}
cg_cOr(a[p],b[p]);}
else
{a[p]=b[p];}}}
function cg_ce(a,b)
{var r=document.createElement(a);if(b)
{cg_cOr(r,b);}
return r;}
function cg_ae(a,b)
{return a.appendChild(b);}
function cg_ge(a)
{return document.getElementById(a);}
function cg_ia(parent,node,referenceNode){parent.insertBefore(node,referenceNode.nextSibling);}
function cg_df()
{this.blur();}
function cg_gebt(a,b)
{return a.getElementsByTagName(b);}
function cg_ct(a)
{return document.createTextNode(a);}
function cg_rf()
{return false;}
function cg_ds(a)
{a.onmousedown=cg_rf;a.onselectstart=cg_rf;if(Curse.Browser.ie){a.onfocus=cg_df;}}
function cg_cO(a,b)
{for(var p in b)
{a[p]=b[p];}}
function cg_getShadowText(text,className)
{var shadowText=cg_ce("span");for(var i=-1;i<=1;++i)
{for(var j=-1;j<=1;++j)
{var d=cg_ce("div");d.style.position="absolute";d.style.whiteSpace="nowrap";d.style.left=i+"px";d.style.top=j+"px";if(i==0&&j==0)
{d.style.zIndex=4;}
else
{d.style.color="black";d.style.zIndex=2;}
cg_ae(d,cg_ct(text));cg_ae(shadowText,d);}}
shadowText.style.position="relative";shadowText.className="glow"+(className!=null?" "+className:"");var s=cg_ce("span");s.style.visibility="hidden";cg_ae(s,cg_ct(text));cg_ae(shadowText,s);return shadowText;}
function cg_getLookupsFromCookie(name,delim1,delim2)
{var lookupList=[];var cookieList=cg_getCookie("Login."+name);cookieList=cg_utf8Decode(cookieList);if(!delim1)
{delim1=",";}
if(!delim2)
{delim2="^";}
if(cookieList)
{cookieList=cookieList.split(delim1);for(var i=0;i<cookieList.length;i++)
{lookupList.push(cookieList[i].split(delim2));}}
return lookupList;}
function cg_getLookupSelectBox(lookupName,selectName,container,hideEmpty,onchange,fromCookie,delim1,delim2,emptyLabel)
{if(fromCookie)
{var lookupList=cg_getLookupsFromCookie(lookupName,delim1,delim2);if(lookupList.length==0){lookupList=Curse.Lookup[lookupName];fromCookie=false;}}
else
{var lookupList=Curse.Lookup[lookupName];}
var objSelect=document.createElement("select");if(selectName)
{objSelect.name=selectName;objSelect.id="fi_"+selectName;}
if(onchange)
{objSelect.onchange=function(){eval(onchange);};}
if(!hideEmpty)
{var objOption=document.createElement("option");if(!emptyLabel)
{emptyLabel="";}
objOption.text=emptyLabel;objOption.value="";objSelect.options.add(objOption)}
if(!fromCookie)
{for(var p in lookupList)
{if(typeof p=='string'&&p!="indexOf")
{var objOption=document.createElement("option");objOption.text=lookupList[p].replace("<br>"," - ");objOption.value=p;objSelect.options.add(objOption)}}}
else
{for(var i=0;i<lookupList.length;i++)
{var objOption=document.createElement("option");objOption.text=lookupList[i][1].replace("<br>"," - ");objOption.value=lookupList[i][0];objSelect.options.add(objOption)}}
if(container)
{container.appendChild(objSelect);return objSelect}
else
{return objSelect;}}
function cg_scrollTo(element,padding)
{var pos=cg_getPosition(element)
scrollTo(0,pos.y-padding);}
function cg_scrollTop()
{if(self.pageYOffset)
{return self.pageYOffset;}
else if(document.documentElement&&!document.documentElement.scrollTop)
{return 0;}
else if(document.documentElement&&document.documentElement.scrollTop)
{return document.documentElement.scrollTop;}
else if(document.body&&document.body.scrollTop)
{return document.body.scrollTop;}}
function cg_addEventListener(eventSource,eventName,eventHandler)
{if(eventSource.addEventListener){eventSource.addEventListener(eventName,eventHandler,false);}
else if(eventSource.attachEvent){eventName="on"+eventName;eventSource.attachEvent(eventName,eventHandler);}}
function cg_removeEventListener(eventSource,eventName,eventHandler)
{if(eventSource.addEventListener){eventSource.removeEventListener(eventName,eventHandler,false);}
else if(eventSource.detachEvent)
{eventSource.detachEvent("on"+eventName);}}
function cg_hasClass(pElem,pClassName)
{if(!pElem.className)
{return;}
if(pElem.className==pClassName)
{return true;}
if(pElem.className.split(" ").indexOf(pClassName)>=0)
{return true;}
return false;}
function cg_removeClass(pElem,pClassName)
{if(!pElem.className)
{return;}
var classArray=pElem.className.split(" ");for(var i=0;i<classArray.length;i++)
{if(classArray[i]==pClassName)
{classArray.splice(i,1);break;}}
pElem.className=classArray.join(" ");}
function cg_addClass(pElem,pClassName)
{var classArray=pElem.className.split(" ");for(var i=0;i<classArray.length;i++)
{if(classArray[i]==pClassName)
{return;}}
classArray.push(pClassName);pElem.className=classArray.join(" ");}
function cg_isArray(obj){if(obj.constructor.toString().toLowerCase().indexOf("function")==-1&&obj.constructor.toString().toLowerCase().indexOf("array")==-1)
{return false;}
else
{if(!obj.length)
{return false;}
return true;}}
function cg_getPosition(pElem)
{var left=0;var top=0;while(pElem.offsetParent){left+=pElem.offsetLeft;if(pElem.clientLeft)
{left+=pElem.clientLeft;}
top+=pElem.offsetTop;if(pElem.clientTop)
{top+=pElem.clientTop;}
pElem=pElem.offsetParent;}
left+=pElem.offsetLeft;top+=pElem.offsetTop;return{x:left,y:top};}
function cg_getScroll()
{var x=0,y=0;if(typeof(window.pageYOffset)=="number")
{x=window.pageXOffset;y=window.pageYOffset;}
else
{if(document.body&&(document.body.scrollLeft||document.body.scrollTop)){x=document.body.scrollLeft;y=document.body.scrollTop;}
else
{if(document.documentElement&&(document.documentElement.scrollLeft||document.documentElement.scrollTop))
{x=document.documentElement.scrollLeft;y=document.documentElement.scrollTop;}}}
return{x:x,y:y};}
function cg_setTextNodes(n,b)
{if(a.nodeType==3)
{a.nodeValue=b;}
else
{for(var i=0;i<a.childNodes.length;++i){cg_setTextNodes(a.childNodes[i],b);}}}
function cg_deleteCookie(name,path,domain)
{var curVal=cg_getCookie(name);if(curVal)
{document.cookie=name+"="+curVal+";expires=Thu, 01-Jan-1970 00:00:01 GMT;path=/";}}
function cg_setCookie(name,value,exp_y,exp_m,exp_d,path,domain,secure)
{var cookie_string=name+"="+escape(value);var expires=new Date();if(exp_y)
{if(exp_m=null)
{exp_m=1;}
if(exp_d=null)
{exp_m=1;}
expires.setTime(expires.getTime()+(1000*60*60*24*31));}
else
{expires.setDate(expires.getDate()+365);}
cookie_string+="; expires="+expires.toGMTString();if(path)
cookie_string+="; path="+escape(path);if(domain)
cookie_string+="; domain="+escape(domain);if(secure)
cookie_string+="; secure";document.cookie=cookie_string;}
function cg_getCookie(cookie_name)
{var results=document.cookie.match(cookie_name+'=(.*?)(;|$)');if(results)
return(unescape(results[1]));else
return null;}
function cg_getElementsByClassName(sClassName,sTag,oContainer,returnFirst){var searchObj;var results=new Array();if(!oContainer){oContainer=document;}
if(sTag=="*"||!sTag){if(document.all){searchObj=oContainer.all;}
else{searchObj=oContainer.getElementsByTagName("*");}}
else
{searchObj=oContainer.getElementsByTagName(sTag);}
for(var i=0,el;((searchObj.all&&!neo.bw.isIE6up)?el=searchObj(i):el=searchObj.item(i));i++){if(el.className==sClassName){if(returnFirst)
{return el;}
results.push(el);}}
return results;}
function cg_getQueryStringParam(param){var begin,end;if(self.location.search.length>1)
{begin=self.location.search.indexOf(param)
if(begin==-1)
{return"";}
begin=begin+param.length+1;end=self.location.search.indexOf("&",begin);if(end==(-1))end=self.location.search.length;return(self.location.search.substring(begin,end));}
else if(self.location.hash.length>1)
{begin=self.location.hash.indexOf(param)+param.length+1;end=self.location.hash.indexOf("&",begin);if(end==(-1))end=self.location.hash.length;return(self.location.hash.substring(begin,end));}
else return("");}
function cg_getEvent(e){if(!Curse.Browser.ie&&!e)
{return null;}
if(!e)
{e=window.event;if(!e)
{return null;}}
e._button=e.which?e.which:e.button;e._target=e.target?e.target:e.srcElement;e._relatedTarget=e.relatedTarget?e.relatedTarget:e.toElement;return e;}
function cg_getEventTarget(e){e=cg_getEvent(e);if(!e)
{return null;}
return e._target;}
function cg_formatNumber(num)
{num=""+parseInt(num);if(num.length<=3)
{return num;}
return cg_formatNumber(num.substr(0,num.length-3))+","+num.substr(num.length-3);}
function cg_commify(nStr)
{nStr+='';x=nStr.split('.');x1=x[0];x2=x.length>1?'.'+x[1]:'';var rgx=/(\d+)(\d{3})/;while(rgx.test(x1)){x1=x1.replace(rgx,'$1'+','+'$2');}
return x1+x2;}
function cg_getTextValue(a)
{if(Curse.Browser.ie)
{return a.innerText;}
else
{return a.textContent;}}
function cg_toggleDisplay(a)
{if(a.style.display=="none")
{a.style.display="";return true;}
else
{a.style.display="none";return false;}}
function cg_cancelBubbling(e)
{if(Curse.Browser.ie)
{e=window.event;e.cancelBubble=true;}
else
{e=cg_getEvent(e);if(!e)
{return;}
e.stopPropagation();}}
var cg_localTime;function cg_refreshDate()
{cg_localTime=new Date().getTime();}
cg_refreshDate();function cg_mod(divisee,base)
{return Math.round(divisee-(Math.floor(divisee/base)*base));}
function cg_getLocalDateFromTime(time)
{return time;}
function cg_getShortFriendlyTime(epoch,excludeTime)
{localDate=new Date(epoch);function getPlural(value,ifSingular,ifPlural)
{if(value==1)
{return ifSingular;}
return ifPlural;}
var shortFriendlyTime;var timeDifferenceMinutes=parseInt((cg_localTime-localDate.getTime())/1000/60);var timeDifferenceHours=parseInt(timeDifferenceMinutes/60);if(timeDifferenceMinutes<=1)
{return Localization.time_last_minute;}
if(timeDifferenceHours<1)
{return Localization.replace("time_minute",timeDifferenceMinutes);}
if(timeDifferenceHours<24)
{var extraMins=cg_mod(timeDifferenceMinutes,60);shortFriendlyTime=parseInt(timeDifferenceHours,null)+" hr";if(extraMins>0)
{return Localization.replace("time_hour_minute",timeDifferenceHours,extraMins);}
else
{return Localization.replace("time_hour",timeDifferenceHours);}}
var timeDifferenceDays=parseInt(timeDifferenceHours/24);if(timeDifferenceDays<7)
{var extraHours=cg_mod(timeDifferenceHours,24);if(extraHours>0)
{if(timeDifferenceDays>1)
{return Localization.replace("time_days_hour",timeDifferenceDays,extraHours);}
else
{return Localization.replace("time_day_hour",timeDifferenceDays,extraHours);}}
else
{if(timeDifferenceDays>1)
{return Localization.replace("time_days",timeDifferenceDays,extraHours);}
else
{return Localization.replace("time_day",timeDifferenceDays,extraHours);}}}
if(excludeTime)
{return localDate.getMonth()+1+"/"+localDate.getDate()+"/"+localDate.getFullYear();}
else
{return Localization.replace("time_full",localDate.getMonth()+1,localDate.getDate(),localDate.getFullYear(),localDate.toLocaleTimeString());}}
function cg_trim(a)
{return a.replace(/^\s+/,'').replace(/\s+$/,'');}
function cg_addOrReplace(a,b,c)
{if(b)
{cg_de(b);}
cg_ae(a,c);}
function cg_dbg(text)
{if(!cg_ge("debugPanel"))
{return;}
if(cg_ge("debugPanel").style.display=="none")
{return;}
cg_ge("debugPanel").appendChild(document.createElement("br"));cg_ge("debugPanel").appendChild(document.createTextNode(text));}
function cg_getRelativeLocation(ignoreEscape)
{var relativeLocation=self.location.href;var arrRelativeLocation=relativeLocation.split("/");relativeLocation=arrRelativeLocation[arrRelativeLocation.length-1];if(!ignoreEscape)
{relativeLocation=escape(relativeLocation);}
return relativeLocation;}
function cg_isDefined(object,variable)
{return(typeof(eval(object)[variable])!="undefined");}
function cg_cookiesDisabled()
{cg_setCookie("_cookieTest",true);return cg_getCookie("_cookieTest")==null;}
if(typeof deconcept=="undefined"){var deconcept=new Object();}if(typeof deconcept.util=="undefined"){deconcept.util=new Object();}if(typeof deconcept.SWFObjectUtil=="undefined"){deconcept.SWFObjectUtil=new Object();}deconcept.SWFObject=function(_1,id,w,h,_5,c,_7,_8,_9,_a){if(!document.getElementById){return;}this.DETECT_KEY=_a?_a:"detectflash";this.skipDetect=deconcept.util.getRequestParameter(this.DETECT_KEY);this.params=new Object();this.variables=new Object();this.attributes=new Array();if(_1){this.setAttribute("swf",_1);}if(id){this.setAttribute("id",id);}if(w){this.setAttribute("width",w);}if(h){this.setAttribute("height",h);}if(_5){this.setAttribute("version",new deconcept.PlayerVersion(_5.toString().split(".")));}this.installedVer=deconcept.SWFObjectUtil.getPlayerVersion();if(!window.opera&&document.all&&this.installedVer.major>7){deconcept.SWFObject.doPrepUnload=true;}if(c){this.addParam("bgcolor",c);}var q=_7?_7:"high";this.addParam("quality",q);this.setAttribute("useExpressInstall",false);this.setAttribute("doExpressInstall",false);var _c=(_8)?_8:window.location;this.setAttribute("xiRedirectUrl",_c);this.setAttribute("redirectUrl","");if(_9){this.setAttribute("redirectUrl",_9);}};deconcept.SWFObject.prototype={useExpressInstall:function(_d){this.xiSWFPath=!_d?"expressinstall.swf":_d;this.setAttribute("useExpressInstall",true);},setAttribute:function(_e,_f){this.attributes[_e]=_f;},getAttribute:function(_10){return this.attributes[_10];},addParam:function(_11,_12){this.params[_11]=_12;},getParams:function(){return this.params;},addVariable:function(_13,_14){this.variables[_13]=_14;},getVariable:function(_15){return this.variables[_15];},getVariables:function(){return this.variables;},getVariablePairs:function(){var _16=new Array();var key;var _18=this.getVariables();for(key in _18){_16[_16.length]=key+"="+_18[key];}return _16;},getSWFHTML:function(){var _19="";if(navigator.plugins&&navigator.mimeTypes&&navigator.mimeTypes.length){if(this.getAttribute("doExpressInstall")){this.addVariable("MMplayerType","PlugIn");this.setAttribute("swf",this.xiSWFPath);}_19="<embed type=\"application/x-shockwave-flash\" src=\""+this.getAttribute("swf")+"\" width=\""+this.getAttribute("width")+"\" height=\""+this.getAttribute("height")+"\" style=\""+this.getAttribute("style")+"\"";_19+=" id=\""+this.getAttribute("id")+"\" name=\""+this.getAttribute("id")+"\" ";var _1a=this.getParams();for(var key in _1a){_19+=[key]+"=\""+_1a[key]+"\" ";}var _1c=this.getVariablePairs().join("&");if(_1c.length>0){_19+="flashvars=\""+_1c+"\"";}_19+="/>";}else{if(this.getAttribute("doExpressInstall")){this.addVariable("MMplayerType","ActiveX");this.setAttribute("swf",this.xiSWFPath);}_19="<object id=\""+this.getAttribute("id")+"\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" width=\""+this.getAttribute("width")+"\" height=\""+this.getAttribute("height")+"\" style=\""+this.getAttribute("style")+"\">";_19+="<param name=\"movie\" value=\""+this.getAttribute("swf")+"\" />";var _1d=this.getParams();for(var key in _1d){_19+="<param name=\""+key+"\" value=\""+_1d[key]+"\" />";}var _1f=this.getVariablePairs().join("&");if(_1f.length>0){_19+="<param name=\"flashvars\" value=\""+_1f+"\" />";}_19+="</object>";}return _19;},write:function(_20){if(this.getAttribute("useExpressInstall")){var _21=new deconcept.PlayerVersion([6,0,65]);if(this.installedVer.versionIsValid(_21)&&!this.installedVer.versionIsValid(this.getAttribute("version"))){this.setAttribute("doExpressInstall",true);this.addVariable("MMredirectURL",escape(this.getAttribute("xiRedirectUrl")));document.title=document.title.slice(0,47)+" - Flash Player Installation";this.addVariable("MMdoctitle",document.title);}}if(this.skipDetect||this.getAttribute("doExpressInstall")||this.installedVer.versionIsValid(this.getAttribute("version"))){var n=(typeof _20=="string")?document.getElementById(_20):_20;n.innerHTML=this.getSWFHTML();return true;}else{if(this.getAttribute("redirectUrl")!=""){document.location.replace(this.getAttribute("redirectUrl"));}}return false;}};deconcept.SWFObjectUtil.getPlayerVersion=function(){var _23=new deconcept.PlayerVersion([0,0,0]);if(navigator.plugins&&navigator.mimeTypes.length){var x=navigator.plugins["Shockwave Flash"];if(x&&x.description){_23=new deconcept.PlayerVersion(x.description.replace(/([a-zA-Z]|\s)+/,"").replace(/(\s+r|\s+b[0-9]+)/,".").split("."));}}else{if(navigator.userAgent&&navigator.userAgent.indexOf("Windows CE")>=0){var axo=1;var _26=3;while(axo){try{_26++;axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash."+_26);_23=new deconcept.PlayerVersion([_26,0,0]);}catch(e){axo=null;}}}else{try{var axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");}catch(e){try{var axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");_23=new deconcept.PlayerVersion([6,0,21]);axo.AllowScriptAccess="always";}catch(e){if(_23.major==6){return _23;}}try{axo=new ActiveXObject("ShockwaveFlash.ShockwaveFlash");}catch(e){}}if(axo!=null){_23=new deconcept.PlayerVersion(axo.GetVariable("$version").split(" ")[1].split(","));}}}return _23;};deconcept.PlayerVersion=function(_29){this.major=_29[0]!=null?parseInt(_29[0]):0;this.minor=_29[1]!=null?parseInt(_29[1]):0;this.rev=_29[2]!=null?parseInt(_29[2]):0;};deconcept.PlayerVersion.prototype.versionIsValid=function(fv){if(this.major<fv.major){return false;}if(this.major>fv.major){return true;}if(this.minor<fv.minor){return false;}if(this.minor>fv.minor){return true;}if(this.rev<fv.rev){return false;}return true;};deconcept.util={getRequestParameter:function(_2b){var q=document.location.search||document.location.hash;if(_2b==null){return q;}if(q){var _2d=q.substring(1).split("&");for(var i=0;i<_2d.length;i++){if(_2d[i].substring(0,_2d[i].indexOf("="))==_2b){return _2d[i].substring((_2d[i].indexOf("=")+1));}}}return"";}};deconcept.SWFObjectUtil.cleanupSWFs=function(){var _2f=document.getElementsByTagName("OBJECT");for(var i=_2f.length-1;i>=0;i--){_2f[i].style.display="none";for(var x in _2f[i]){if(typeof _2f[i][x]=="function"){_2f[i][x]=function(){};}}}};if(deconcept.SWFObject.doPrepUnload){if(!deconcept.unloadSet){deconcept.SWFObjectUtil.prepUnload=function(){__flash_unloadHandler=function(){};__flash_savedUnloadHandler=function(){};window.attachEvent("onunload",deconcept.SWFObjectUtil.cleanupSWFs);};window.attachEvent("onbeforeunload",deconcept.SWFObjectUtil.prepUnload);deconcept.unloadSet=true;}}if(!document.getElementById&&document.all){document.getElementById=function(id){return document.all[id];};}var getQueryParamValue=deconcept.util.getRequestParameter;var FlashObject=deconcept.SWFObject;var SWFObject=deconcept.SWFObject;var cg_reverseAlphaArray=["z","y","x","w","v","u","t","s","r"];function cg_navToLogin()
{var relativeLocation=cg_getRelativeLocation();if(relativeLocation.toLowerCase().indexOf("login.aspx")>=0)
{self.location="login.aspx";}
else
{self.location="login.aspx?referrer="+relativeLocation;}}
function cg_centerElement(oElement)
{var viewportHeight=Curse.Client.viewportHeight();var viewportWidth=Curse.Client.viewportWidth();var newTop=(viewportHeight/2)-(oElement.offsetHeight/2);var newLeft=(viewportWidth/2)-(oElement.offsetWidth/2);oElement.style.top=(newTop+cg_scrollTop())+"px";oElement.style.left=newLeft+"px";}
function cg_getFormAsString(formObject){returnString=formObject.action;formElements=formObject.elements;for(var i=formElements.length-1;i>=0;--i){if(i==formElements.length-1)
{returnString=returnString+"?";}
else
{returnString=returnString+"&";}
returnString=returnString+encodeURI(formElements[i].name)+"="+encodeURIComponent(formElements[i].value.replace(/</g,"&lt;").replace(/>/g,"&gt;"));}
return returnString;}
function cg_getViewState(index)
{var currentHashArray=self.location.hash.substring(1).split(":");if(currentHashArray.length<index+1)
{return null;}
return currentHashArray[index];}
function cg_replace()
{var args=cg_replace.arguments;var str=args[0];for(i=1;i<args.length;i++)
{str=str.replace(eval("/\\%"+i+"/g"),args[i]);}
return str;}
function cg_getStyle(elem,cssRule){var value="";if(document.defaultView&&document.defaultView.getComputedStyle){value=document.defaultView.getComputedStyle(elem,"").getPropertyValue(cssRule);}
else if(elem.currentStyle){cssRule=cssRule.replace(/\-(\w)/g,function(match,p1){return p1.toUpperCase();});value=elem.currentStyle[cssRule];}
return value;}
function cg_endsWith(str,s){var reg=new RegExp(s+"$");return reg.test(str);}
function cg_utf8Decode(utftext)
{if(utftext==null)
{return"";}
var string="";var i=0;var c=c1=c2=0;while(i<utftext.length){c=utftext.charCodeAt(i);if(c<128){string+=String.fromCharCode(c);i++;}
else if((c>191)&&(c<224)){c2=utftext.charCodeAt(i+1);string+=String.fromCharCode(((c&31)<<6)|(c2&63));i+=2;}
else{c2=utftext.charCodeAt(i+1);c3=utftext.charCodeAt(i+2);string+=String.fromCharCode(((c&15)<<12)|((c2&63)<<6)|(c3&63));i+=3;}}
return string;}
function cg_getString(val)
{if(val==null)
{return"";}
return val;}
function cg_getBits(val)
{var bits=[];if(!val||val==0)
{return bits;}
var dblFeatureCode=parseInt(val);var decFeatureCode=parseFloat(0.0);var bytFeatureId=1;while(dblFeatureCode>0)
{dblFeatureCode=dblFeatureCode/2;decFeatureCode=parseInt(dblFeatureCode);if(dblFeatureCode>decFeatureCode)
{bits.push(bytFeatureId);}
dblFeatureCode=parseFloat(decFeatureCode);bytFeatureId=bytFeatureId+1}
return bits;}
function cg_isNumeric(str){return str.toString().match(/[0-9]+$/)!=null;}
function cg_getLookupValue(lookupName,lookupLabel){for(var k in Curse.Lookup[lookupName]){if(Curse.Lookup[lookupName][k].toLowerCase()==lookupLabel.toLowerCase()){return k;}}
return"";}
if(!Curse)
{Curse={};}
Curse.Ajax={http:false,format:'text',callback:function(data){},handler:false,error:false,opt:new Object(),getHTTPObject:function(){var http=false;if(typeof ActiveXObject!='undefined'){try{http=new ActiveXObject("Msxml2.XMLHTTP");}
catch(e){try{http=new ActiveXObject("Microsoft.XMLHTTP");}
catch(E){http=false;}}}else if(XMLHttpRequest){try{http=new XMLHttpRequest();}
catch(e){http=false;}}
return http;},load:function(url,callback,format,method,allowCache,queueFunction,queueFunctionArgs,callbackHost){this.init();if(!this.http||!url)return;if(this.http.overrideMimeType)this.http.overrideMimeType('text/xml');this.callback=callback;this.callbackHost=callbackHost;this.queueFunction=queueFunction;this.queueFunctionArgs=queueFunctionArgs;if(!method)var method="GET";if(!format)var format="text";this.format=format.toLowerCase();method=method.toUpperCase();var ths=this;if(!allowCache)
{var now="uid="+new Date().getTime();url+=(url.indexOf("?")+1)?"&":"?";url+=now;}
var parameters=null;if(method=="POST"){var parts=url.split("\?");url=parts[0];parameters=parts[1];}
this.http.open(method,url,true);if(method=="POST"){this.http.setRequestHeader("Content-type","application/x-www-form-urlencoded");this.http.setRequestHeader("Content-length",parameters.length);if(!Curse.Browser.ie)
{this.http.setRequestHeader("Connection","close");}}
if(this.handler)
{this.http.onreadystatechange=this.handler;}
else{this.http.onreadystatechange=function()
{if(!ths)return;var http=ths.http;if(http.readyState==4){if(http.status==200){var result="";if(http.responseText)result=http.responseText;if(ths.format.charAt(0)=="j")
{result=result.replace(/[\n\r]/g,"");result=eval('('+result+')');}
else if(ths.format.charAt(0)=="x"){result=http.responseXML;}
if(ths.queueFunction)
{ths.queueFunction(result,ths.callback,ths.queueFunctionArgs);}
else if(ths.callback)
{if(ths.callbackHost){ths.callback.bind(ths.callbackHost,result)();}
else{ths.callback(result);}}}
else{if(ths.opt.loadingIndicator)document.getElementsByTagName("body")[0].removeChild(ths.opt.loadingIndicator);if(ths.opt.loading)document.getElementById(ths.opt.loading).style.display="none";if(ths.error)ths.error(http.status);}}}}
this.http.send(parameters);},bind:function(user_options){var opt={'url':'','onSuccess':false,'onError':false,'format':"text",'method':"GET",'update':"",'loading':"",'loadingIndicator':""}
for(var key in opt){if(user_options[key]){opt[key]=user_options[key];}}
this.opt=opt;if(!opt.url)return;if(opt.onError)this.error=opt.onError;var div=false;if(opt.loadingIndicator){div=document.createElement("div");div.setAttribute("style","position:absolute;top:0px;left:0px;");div.setAttribute("class","loading-indicator");div.innerHTML=opt.loadingIndicator;document.getElementsByTagName("body")[0].appendChild(div);this.opt.loadingIndicator=div;}
if(opt.loading)document.getElementById(opt.loading).style.display="block";this.load(opt.url,function(data){if(opt.onSuccess)opt.onSuccess(data);if(opt.update)document.getElementById(opt.update).innerHTML=data;if(div)document.getElementsByTagName("body")[0].removeChild(div);if(opt.loading)document.getElementById(opt.loading).style.display="none";},opt.format,opt.method);},init:function(){this.http=this.getHTTPObject();}};var cg_ajaxQueue=[];var cg_ajaxProcessing=false;function cg_queueAjaxRequest(url,callbackFunction,format,method,callbackArgs,allowCache)
{if(!isNewRequest())
{return;}
var ajaxRequest={};ajaxRequest.url=url;ajaxRequest.callback=callbackFunction;ajaxRequest.callbackArgs=callbackArgs;ajaxRequest.format=format;ajaxRequest.method=method;ajaxRequest.allowCache=allowCache;cg_ajaxQueue.push(ajaxRequest);cg_processAjaxQueue();function isNewRequest()
{if(cg_ajaxQueue.length==0)
{return true;}
for(var i=0,len=cg_ajaxQueue.length;i<len;i++)
{if(cg_ajaxQueue[i].url==url)
{return false;}}
return true;}}
function cg_completeAjaxQueue(data,callback,callbackArgs)
{cg_ajaxProcessing=false;callback(data,callbackArgs);cg_processAjaxQueue();}
function cg_processAjaxQueue()
{if(cg_ajaxProcessing||cg_ajaxQueue.length==0)
{return;}
cg_ajaxProcessing=true;var ajaxRequest=cg_ajaxQueue[0];cg_ajaxQueue.splice(0,1);Curse.Ajax.load(ajaxRequest.url,ajaxRequest.callback,ajaxRequest.format,ajaxRequest.method,ajaxRequest.allowCache,cg_completeAjaxQueue,ajaxRequest.callbackArgs);}
if(!Curse)
{var Curse={};}
Curse.Mouse={x:0,y:0,initialize:function()
{cg_addEventListener(document,"mousemove",this.update);cg_addEventListener(document,"mouseout",this.update);},update:function(e)
{if(window.event)
{Curse.Mouse.x=window.event.clientX;Curse.Mouse.y=window.event.clientY;Curse.Mouse.y+=cg_scrollTop();}
else
{Curse.Mouse.x=e.pageX;Curse.Mouse.y=e.pageY;}}};Curse.Mouse.initialize();if(!Curse){var Curse={};}
Curse.Icon=function(size,id,link,relatedID,elementID,overFn,overArgs,outFn,outArgs,num,quantity,showNum,spritePath,spritePosition,baseUrl)
{return this.initialize(size,id,link,relatedID,elementID,overFn,overArgs,outFn,outArgs,num,quantity,showNum,spritePath,spritePosition,baseUrl);}
Curse.Icon.prototype={sizes:["small","medium","large"],paths:["s","m","l"],initialize:function(size,id,link,relatedID,elementID,overFn,overArgs,outFn,outArgs,num,quantity,showNum,spritePath,spritePosition,baseUrl)
{var icon=cg_ce("div");icon.className="icon"+this.sizes[size];var tile=cg_ce("div");tile.className="tile";if(!baseUrl)
{baseUrl="";}
if(elementID)
{icon.id=elementID;}
if(spritePath!=null)
{var sprite=cg_ce("div");sprite.className="sprite";sprite.style.backgroundImage="url("+spritePath+")";if(spritePosition)
{sprite.style.backgroundPosition=spritePosition;}
cg_ae(icon,sprite);var border=cg_ce("var");cg_ae(tile,border);icon.divSprite=sprite;icon.varBorder=border;}
else
{icon.style.backgroundImage="url("+baseUrl+"icons/"+this.paths[size]+"/"+id+"."+Curse.Icon.fileFormat+")";}
if(link||overFn)
{var a=cg_ce("a");if(relatedID)
{a._relatedID=relatedID;icon.aLink=a;}
if(overFn)
{a.onmouseover=overFn.bind(this,a,overArgs);}
if(outFn)
{a.onmouseout=outFn.bind(this,a,outArgs);}
if(link){a.href=link;}
else
{a.href="javascript:;";cg_ds(a);}
cg_ae(tile,a);}
if(showNum||(num!=null&&(num>1||num.length))){var shadowText=cg_getShadowText(num,"r1");shadowText.style.right="0";shadowText.style.bottom="0";shadowText.style.position="absolute";cg_ae(tile,shadowText);}
if(quantity!=null&&quantity>0){var shadowText=cg_getShadowText("("+quantity+")","r");shadowText.style.left="0";shadowText.style.top="0";shadowText.style.position="absolute";cg_ae(tile,shadowText);}
cg_ae(icon,tile);return icon;},over:function(){if(this.relatedTooltip!=null){Tooltip.show(this,this.relatedTooltip,0,0);}},out:function(){Tooltip.hide();}};Curse.Icon.fileFormat="gif";Curse.Tooltip={gameContainers:[],gameTooltips:[],gameIcons:[],currentGame:"none",getCurrentGame:function(){return this.currentGame;},getGame:function(game){if(Curse.WOWDB){if(Curse.WOWDB.Site){return"wow";}}
if(Curse.WHO){if(Curse.WHO.Site){return"war";}}
if(Curse.ROM){if(Curse.ROM.Site){return"rom";}}
if(Curse.AION){if(Curse.AION.Site){return"aion";}}
if(game==null){return this.currentGame;}
if(game.clientX!=null){return this.currentGame;}
this.currentGame=game;return game;},getPrefix:function(game){if(game=="none"){return"";}
else{return game+"_";}},initialize:function(game){var currentContainer;var currentPrefix="";var currentTooltips;var currentIcons;if(game==null){game="none";}
if(Curse.Tooltip.gameContainers[game]){return;}
if(game!="none"){currentPrefix=game+"_";}
Curse.Tooltip.gameContainers[game]=cg_ce("div");Curse.Tooltip.gameContainers[game].className=currentPrefix+"tooltip-container";Curse.Tooltip.gameIcons[game]=[];Curse.Tooltip.gameTooltips[game]=[];for(var i=0;i<3;i++){Curse.Tooltip.gameIcons[game][i]=cg_ce("div");Curse.Tooltip.gameIcons[game][i].className=currentPrefix+"tooltip-icon";var iconFrame=cg_ce("div");cg_ae(Curse.Tooltip.gameIcons[game][i],iconFrame);cg_ae(Curse.Tooltip.gameContainers[game],Curse.Tooltip.gameIcons[game][i]);Curse.Tooltip.gameTooltips[game][i]=cg_ce("div");Curse.Tooltip.gameTooltips[game][i].className=currentPrefix+"tooltip";var td;Curse.Tooltip.gameTooltips[game][i]._text=td=cg_ce("td");var t=cg_ce("table"),tb=cg_ce("tbody"),tr1=cg_ce("tr"),tr2=cg_ce("tr"),th1=cg_ce("th"),th2=cg_ce("th"),th3=cg_ce("th");th1.style.backgroundPosition="top right";th2.style.backgroundPosition="bottom left";th3.style.backgroundPosition="bottom right";cg_ae(tr1,td);cg_ae(tr1,th1);cg_ae(tb,tr1);cg_ae(tr2,th2);cg_ae(tr2,th3);cg_ae(tb,tr2);cg_ae(t,tb);cg_ae(Curse.Tooltip.gameTooltips[game][i],t);cg_ae(Curse.Tooltip.gameContainers[game],Curse.Tooltip.gameTooltips[game][i]);}
cg_ae(document.body,Curse.Tooltip.gameContainers[game]);},showTip:function(text,className,game){game=Curse.Tooltip.getGame(game);currentGame=game;if(typeof(className)=="object"||className==null){className="r";}
text="<span class="+className+">"+text+"</span>";Curse.Tooltip.show(text,null,null,game);Curse.Tooltip.updateSize(game);Curse.Tooltip.updatePosition(game);},hide:function(){Curse.Tooltip.currentTooltipId=null;for(var p in Curse.Tooltip.gameContainers){if(p=="indexOf"||p=="$family"||Curse.Tooltip.gameContainers[p].style==null){continue;}
if(Curse.Tooltip.gameContainers[p]){Curse.Tooltip.hideIcons(p);Curse.Tooltip.gameContainers[p].style.display="none";Curse.Tooltip.gameContainers[p].style.width="auto";for(var i=0;i<Curse.Tooltip.gameTooltips[p].length;i++){Curse.Tooltip.gameTooltips[p][i]._text.innerHTML="";Curse.Tooltip.gameTooltips[p][i].style.display="none";}}}},hideIcons:function(game){game=Curse.Tooltip.getGame(game);for(var i=0,len=Curse.Tooltip.gameIcons[game].length;i<len;i++){Curse.Tooltip.gameIcons[game][i].style.backgroundImage="";Curse.Tooltip.gameIcons[game][i].style.display="none";}},show:function(text1,text2,text3,game){game=Curse.Tooltip.getGame(game);currentGame=game;if(Curse.Tooltip.gameContainers[game]==null){Curse.Tooltip.initialize(game);}
Curse.Tooltip.gameTooltips[game][0]._text.innerHTML=text1;Curse.Tooltip.gameTooltips[game][0].style.display="block";if(text2!=null){Curse.Tooltip.gameTooltips[game][1]._text.innerHTML=text2;Curse.Tooltip.gameTooltips[game][1].style.display="block";}
if(text3!=null){Curse.Tooltip.gameTooltips[game][2]._text.innerHTML=text3;Curse.Tooltip.gameTooltips[game][2].style.display="block";}
Curse.Tooltip.gameContainers[game].style.visibility="hidden";Curse.Tooltip.gameContainers[game].style.display="block";Curse.Tooltip.updateSize(game);Curse.Tooltip.updatePosition(game);Curse.Tooltip.gameContainers[game].style.visibility="visible";},updatePosition:function(game){game=Curse.Tooltip.getGame(game);if(!Curse.Tooltip.gameContainers[game]){return;}
if(Curse.Tooltip.gameContainers[game].style.display!="block"){return;}
var paddingWidth=15,paddingHeight=20,scrollPad=20,viewportHeight=Curse.Client.viewportHeight(),viewportWidth=Curse.Client.viewportWidth()-scrollPad,boundTop=Curse.Client.scrollTop(),boundBottom=viewportHeight+boundTop,tooltipHeight=Curse.Tooltip.gameContainers[game].offsetHeight,tooltipWidth=Curse.Tooltip.gameContainers[game].offsetWidth,boundLeft=0,boundRight=viewportWidth,mousePos={x:Curse.Mouse.x,y:Curse.Mouse.y},newTop=mousePos.y+paddingHeight,newLeft=mousePos.x+paddingWidth,inversePosition=false;Curse.Tooltip.orientation="bottom";if(Curse.Tooltip.inversed){Curse.Tooltip.orientation="top";paddingWidth=10;}
if(Curse.Tooltip.inversed||(newTop+tooltipHeight)>=boundBottom){Curse.Tooltip.orientation="top";newTop=mousePos.y-tooltipHeight-paddingHeight;if(newTop<0){newTop=(viewportHeight-tooltipHeight)/2;}}
else{newTop=mousePos.y+paddingHeight;}
if(Curse.Tooltip.inversed||(newLeft+tooltipWidth)>=boundRight){newLeft=boundRight-Curse.Tooltip.gameContainers[game].offsetWidth;newLeft=mousePos.x-paddingWidth-Curse.Tooltip.gameContainers[game].offsetWidth;}
if(newTop<boundTop){newTop=boundTop;Curse.Tooltip.orientation="top";}
if(newLeft<boundLeft){newLeft=boundLeft;}
Curse.Tooltip.gameContainers[game].style.top=newTop+"px";Curse.Tooltip.gameContainers[game].style.left=newLeft+"px";Curse.Tooltip.updateOrientation(game);},updateOrientation:function(game){game=Curse.Tooltip.getGame(game);if(Curse.Tooltip.orientation=="top"&&Curse.Tooltip.gameContainers[game].offsetHeight>Curse.Tooltip.gameTooltips[game][0].offsetHeight){for(var i=0,len=Curse.Tooltip.gameTooltips[game].length;i<len;i++){if(Curse.Tooltip.gameTooltips[game][i].style.display=="block"){Curse.Tooltip.gameTooltips[game][i].style.top="auto";Curse.Tooltip.gameTooltips[game][i].style.bottom=(Curse.Tooltip.gameTooltips[game][i].offsetHeight-Curse.Tooltip.gameTooltips[game].offsetHeight)+"px";}}}
else{for(var i=0,len=Curse.Tooltip.gameTooltips[game].length;i<len;i++){Curse.Tooltip.gameTooltips[game][i].style.top=Curse.Tooltip.gameTooltips[game][i].style.bottom="auto";}}},updateSize:function(game){game=Curse.Tooltip.getGame(game);var width=0;for(var i=0;i<3;i++){width+=Curse.Tooltip.gameTooltips[game][i].offsetWidth+Curse.Tooltip.gameIcons[game][i].offsetWidth;}
Curse.Tooltip.gameContainers[game].style.width=width+5+"px";},setIcons:function(args,game){game=Curse.Tooltip.getGame(game);var prefix=this.getPrefix(game);Curse.Tooltip.initialize(game);for(var i=0,len=args.length;i<len;i++){if(args[i]==null){continue;}
if(args[i].customClass){Curse.Tooltip.gameIcons[game][args[i].index].className="tooltip-icon "+args[i].customClass;}
else{Curse.Tooltip.gameIcons[game][args[i].index].className="tooltip-icon";}
Curse.Tooltip.gameIcons[game][args[i].index].style.backgroundImage="url("+args[i].image+")";Curse.Tooltip.gameIcons[game][args[i].index].style.display="block";}},updateTooltip:function(index,text,game){game=Curse.Tooltip.getGame(game);Curse.Tooltip.gameTooltips[game][index]._cell.innerHTML=text;},setCurrentTooltip:function(id){Curse.Tooltip.currentTooltipId=id;},getCurrentTooltip:function(){return Curse.Tooltip.currentTooltipId;},setCurrentTooltipLink:function(link){Curse.Tooltip.CurrentTooltipLink=link;},getCurrentTooltipLink:function(){return Curse.Tooltip.CurrentTooltipLink;}};cg_addEventListener(document,"mousemove",Curse.Tooltip.updatePosition);function makeTooltipBorder(div){div.className="tooltip-container";var tooltip=cg_ce("div");tooltip.className="tooltip";tooltip.style.display="block";var td;tooltip._text=td=cg_ce("td");var t=cg_ce("table"),tb=cg_ce("tbody"),tr1=cg_ce("tr"),tr2=cg_ce("tr"),th1=cg_ce("th"),th2=cg_ce("th"),th3=cg_ce("th");th1.style.backgroundPosition="top right";th2.style.backgroundPosition="bottom left";th3.style.backgroundPosition="bottom right";cg_ae(tr1,td);cg_ae(tr1,th1);cg_ae(tb,tr1);cg_ae(tr2,th2);cg_ae(tr2,th3);cg_ae(tb,tr2);cg_ae(t,tb);cg_ae(tooltip,t);cg_ae(div,tooltip);return tooltip._text;}
if(!Curse.AION){Curse.AION={};}
if(!Curse.AION.Tooltip){Curse.AION.Tooltip={};}
Curse.AION.Tooltip.baseURL="";Curse.AION.FileFormat="gif";function roundNumber(num,decimals){var result=Math.round(num*Math.pow(10,decimals))/Math.pow(10,decimals);return result;}
function roundperc(val){return roundNumber((val*100.0)/100,2);}
Curse.AION.Tooltip.handleItemLinkOver=function(link,args,e){if(!link._relatedID){var lpattern=new RegExp("(item|spell)\\.aspx\\?id=(\\d+)");var match=lpattern.exec(link.href);if(!match){return;}
link._relatedID=match[2];}
var item=cg_aion_items[link._relatedID];if(!item||!item.tooltip){Curse.Tooltip.setCurrentTooltip(link._relatedID);Curse.AION.Tooltip.loadAsync(link._relatedID,link,Curse.AION.Tooltip.handleAjaxItem);return;}
var hideIcon,character,isEquipped;if(args){hideIcon=args["hideIcon"];character=args["relatedCharacter"];isEquipped=args["isEquipped"];}
var cids=Curse.AION.Tooltip.getComparisonItems(item.id,item.slot,character,isEquipped);if(!args){args={};}
args.relatedLink=link;Curse.AION.Tooltip.showItemTooltip(cids,args);}
Curse.AION.Tooltip.handleQuestLinkOver=function(link,e){Curse.AION.Tooltip.showQuestTooltip(link._relatedID,link);}
Curse.AION.Tooltip.showQuestTooltip=function(questid,link){var quest=cg_aion_quests[questid];if(quest!=null&&quest.tooltip){Curse.Tooltip.show(quest.tooltip,null,null,"aion");}
else{Curse.Tooltip.setCurrentTooltip(link._relatedID);Curse.AION.Tooltip.loadAsync(questid,link,Curse.AION.Tooltip.handleAjaxQuest);}};Curse.AION.Tooltip.handleAjaxQuest=function(data,link){var newQuest=eval('('+data+')');cg_aion_quests.addData(newQuest);if(Curse.Tooltip.getCurrentTooltip()==link._relatedID){link.onmouseover();}
return;}
Curse.AION.Tooltip.handleRecipeLinkOver=function(link,args,e){if(args==null){args={};}
if(!link._relatedID){var lpattern=new RegExp("(item|spell|recipe)\\.aspx\\?id=(\\d+)");var match=lpattern.exec(link.href);if(!match){return;}
link._relatedID=match[2];}
args.relatedLink=link;Curse.AION.Tooltip.showRecipeTooltip(link._relatedID,args,e);}
Curse.AION.Tooltip.showRecipeTooltip=function(id,args,e){var recipe=cg_aion_recipes[id];if(!recipe||!recipe.tooltip){Curse.Tooltip.setCurrentTooltip(id);Curse.AION.Tooltip.loadAsync(id,args.relatedLink,Curse.AION.Tooltip.handleAjaxRecipe);return;}
if(args){var hideIcon=args["hideIcon"];}
else{args={};}
if(!hideIcon){Curse.Tooltip.setIcons([{index:0,customClass:args.customClass,image:Curse.AION.Tooltip.baseURL+"icons/m/"+recipe.icon+"."+Curse.AION.FileFormat}],"aion");}
Curse.Tooltip.show(recipe.tooltip,null,null,"aion");}
Curse.AION.Tooltip.handleAjaxRecipe=function(data,link){cg_aion_recipes.addData(eval("("+data+")"));if(Curse.Tooltip.getCurrentTooltip()==link._relatedID){link.onmouseover();}
return;}
Curse.AION.Tooltip.handleSpellLinkOver=function(link,args,e){if(args==null){args={};}
if(!link._relatedID){var lpattern=new RegExp("(item|spell)\\.aspx\\?id=(\\d+)");var match=lpattern.exec(link.href);if(!match){return;}
link._relatedID=match[2];}
args.relatedLink=link;Curse.AION.Tooltip.showSpellTooltip(link._relatedID,args,e);}
Curse.AION.Tooltip.showSpellTooltip=function(id,args,e){var spell=cg_aion_spells[id];if(!spell||!spell.tooltip){Curse.Tooltip.setCurrentTooltip(id);Curse.AION.Tooltip.loadAsync(id,args.relatedLink,Curse.AION.Tooltip.handleAjaxSpell);return;}
if(args){var hideIcon=args["hideIcon"];}
else{args={};}
if(!hideIcon){Curse.Tooltip.setIcons([{index:0,customClass:args.customClass,image:Curse.AION.Tooltip.baseURL+"icons/m/"+spell.icon+"."+Curse.AION.FileFormat}],"aion");}
Curse.Tooltip.show(spell.tooltip,null,null,"aion");}
Curse.AION.Tooltip.handleAjaxSpell=function(data,link){cg_aion_spells.addData(eval("("+data+")"));if(Curse.Tooltip.getCurrentTooltip()==link._relatedID){link.onmouseover();}
return;}
Curse.AION.Tooltip.handleAjaxItem=function(data,link){if(data=="")
return;var newItem=eval('('+data+')');cg_aion_items.addData(newItem);if(Curse.Tooltip.getCurrentTooltip()==link._relatedID){link.onmouseover();}
return;}
Curse.AION.Tooltip.loadAsync=function(id,relatedLink,handler){if(cg_isDefined(window,'cg_aiondbsyndication')){cg_aiondbsyndication.addExternalReference(id,relatedLink,handler,true);return;}
var url="ajaxTooltip.aspx?id="+id;if(handler==Curse.AION.Tooltip.handleAjaxQuest){url+="&type=4";}
else if(handler==Curse.AION.Tooltip.handleAjaxSpell){url+="&type=6";}
else if(handler==Curse.AION.Tooltip.handleAjaxRecipe){url+="&type=131";}
cg_queueAjaxRequest(url,handler,"text","get",relatedLink,true);}
Curse.AION.Tooltip.getComparisonItems=function(itemID,itemSlot,character,isEquippedItem){var cids=new Array(3);cids[0]=itemID;if(isEquippedItem!=null||cg_isDefined(window,'cg_aiondbsyndication')){return cids;}
if(cg_isDefined(window,'cg_profileEditor')){character=cg_profileEditor.character;}
if(character){var itSlot=character.itemsByCSlot[cg_profileEditor.currentSlot];if(itSlot!=null){cids[1]=itSlot.id;return cids;}
else{cids[1]=null;}
return cids;}
else{var citem=cg_buildTooltipIds(itemID,itemSlot)+"";cids=citem.split("|");if(cids[1]&&cids[1]=="null"){cids[1]=null;}
if(cids[2]&&cids[2]=="null"){cids[2]=null;}
return cids;}
return cids;}
function cg_buildWeaponTooltipIds(id,slot){var txt=id;if((cg_getCookie("Settings.PinnedItem.item_"+slot)!=null)&&(cg_getCookie("Settings.PinnedItem.item_"+slot)!="null")){vals=cg_getCookie("Settings.PinnedItem.item_"+slot).split("|");if((vals[0]!=null)&&(vals[0]!="")&&(vals[0]!="null"))
txt+="|"+vals[0];if((vals[1]!=null)&&(vals[1]!="")&&(vals[1]!="null"))
txt+="|"+vals[1];}
if(slot=="9"){if(cg_getCookie("Settings.PinnedItem.item_1")!=null){vals=cg_getCookie("Settings.PinnedItem.item_1").split("|");if((vals[1]!=null)&&(vals[1]!="")&&(vals[1]!="null"))
txt+="|"+vals[1];}
return txt;}
else if(slot=="2")
{if(cg_getCookie("Settings.PinnedItem.item_1")!=null){vals=cg_getCookie("Settings.PinnedItem.item_1").split("|");if((vals[0]!=null)&&(vals[0]!="")&&(vals[0]!="null"))
txt+="|"+vals[0];}
return txt;}
else if(slot=="1")
{if(cg_getCookie("Settings.PinnedItem.item_2")!=null){vals=cg_getCookie("Settings.PinnedItem.item_2").split("|");if((vals[0]!=null)&&(vals[0]!="")&&(vals[0]!="null"))
txt+="|"+vals[0];}
if(cg_getCookie("Settings.PinnedItem.item_9")!=null){vals=cg_getCookie("Settings.PinnedItem.item_9").split("|");if((vals[0]!=null)&&(vals[0]!="")&&(vals[0]!="null"))
txt+="|"+vals[0];}
return txt;}}
function cg_buildTooltipIds(id,slot){if((slot=="1")||(slot=="2")||(slot=="9")){return cg_buildWeaponTooltipIds(id,slot);}
if((cg_getCookie("Settings.PinnedItem.item_"+slot)!=null)&&(cg_getCookie("Settings.PinnedItem.item_"+slot)!="null")){var txt=id;vals=cg_getCookie("Settings.PinnedItem.item_"+slot).split("|");if((vals[0]!=null)&&(vals[0]!="")&&(vals[0]!="null"))
txt+="|"+vals[0];if((vals[1]!=null)&&(vals[1]!="")&&(vals[1]!="null"))
txt+="|"+vals[1];return txt;}
else{return id;}}
Curse.AION.Tooltip.showItemTooltip=function(itemids,args){var item,desc2,desc3;if(args==null){args={};}
if(args.relatedCharacter!=null){var item=args.relatedCharacter.itemsById[itemids[0]];}
else{var item=cg_aion_items[itemids[0]];if(!item||!item.tooltip){args.relatedLink._relatedID=itemids[0];Curse.Tooltip.setCurrentTooltip(args.relatedLink._relatedID);Curse.AION.Tooltip.loadAsync(args.relatedLink._relatedID,args.relatedLink,Curse.AION.Tooltip.handleAjaxItem);return;}}
if(item==null){return;}
var icons=[];var text=[];for(var i=0,len=itemids.length;i<len;i++){if(itemids[i]==null){continue;}
if(i>0&&args.noCompare){continue;}
if(i==0&&args.relatedCharacter!=null){var item=args.relatedCharacter.itemsById[itemids[i]];}
else{var item=cg_aion_items[itemids[i]];}
if(item!=null&&item.tooltip){if(i>0||!args.hideIcon){icons[i]={index:i,image:Curse.AION.Tooltip.baseURL+"icons/m/"+item.icon+"."+Curse.AION.FileFormat}}
text[i]=item.tooltip;if(i>0){text[i]+=Curse.AION.Tooltip.getStatDiffsHTML(cg_aion_items[itemids[0]],item);}}
else{Curse.AION.Tooltip.loadAsync(itemids[i],args.relatedLink,Curse.AION.Tooltip.handleAjaxItem);}}
if(icons.length>0){Curse.Tooltip.setIcons(icons,"aion");}
Curse.Tooltip.show(text[0],text[1],text[2],"aion");};Curse.AION.Tooltip.getStatDiffs=function(compareToItem,masterItem){function calculateStatDiffs(stat1,stat2){function getCStat(stat,id){for(var i=0;i<stat.length;i++){if(stat[i].id==id)
return stat[i].val;}
return 0;}
var sdifs=[];var sdone=[];for(var i=0;i<stat1.length;i++){var stat=stat1[i];if(stat.id==0)
continue;if(!sdone[stat.id]){var val=0;var sname;var compVal=getCStat(stat2,stat.id);val=roundperc(stat.val-compVal);sname=Curse.Lookup.stat_id[stat.id];sdifs.push({name:sname,val:val});sdone[stat.id]=true;}}
for(var i=0;i<stat2.length;i++){var stat=stat2[i];if(stat.id==0)
continue;if(sdone[stat.id]==null){var val=getCStat(stat1,stat.id)-stat.val;sdifs.push({name:Curse.Lookup.stat_id[stat.id],val:val});sdone[stat.id]=1;}}
return sdifs;}
var masterStats=masterItem.stats;if(!masterStats){return;}
var compareToStats=compareToItem.stats;if(!compareToStats){return;}
if(masterStats==null||compareToStats==null){return null;}
return calculateStatDiffs(masterStats,compareToStats);};Curse.AION.Tooltip.getStatDiffsHTML=function(masterItem,compareToItem){if(masterItem.id==compareToItem.id){return"";}
var arrStatDiffs=Curse.AION.Tooltip.getStatDiffs(compareToItem,masterItem);if(arrStatDiffs==null){return"";}
var tooltipHTML="<div class=\"itemTooltipStatChangeList\">"+Localization.if_equip+" "+masterItem.getNameWithStyle();var statGainsHTML=[];var statLossesHTML=[];for(var j=0;j<arrStatDiffs.length;j++){var sdif=arrStatDiffs[j];if(sdif.val<=0)
continue;statGainsHTML.push("<span class=r"+((sdif.val>0)?('2'):('ed'))+">"+((sdif.val>0)?('+'):(''))+sdif.val+" "+sdif.name+"</span>");}
var ret=false;for(var j=0;j<arrStatDiffs.length;j++){var sdif=arrStatDiffs[j];if(sdif.val>=0)
continue;statLossesHTML.push("<span class=r"+((sdif.val>0)?('2'):('ed'))+">"+((sdif.val>0)?('+'):(''))+(sdif.val*-1)+" "+sdif.name+"</span>");}
if(statGainsHTML.length>0){ret=true;tooltipHTML+="<br>"+Localization.you_will_gain+" "+statGainsHTML.join(", ");}
if(statLossesHTML.length>0){ret=true;tooltipHTML+="<br>"+Localization.you_will_lose+" "+statLossesHTML.join(", ");}
tooltipHTML+="</div>";if(ret)
return tooltipHTML;else
return"";};var cg_aion_items={};cg_aion_items.addData=function(data){if(data.length==null){dataArray=[];dataArray[0]=data;}
else{dataArray=data;}
for(var i=0,len=dataArray.length;i<len;i++){cg_aion_items[dataArray[i].id]=dataArray[i];cg_aion_items[dataArray[i].id].getName=Curse.AION.Item.getName;cg_aion_items[dataArray[i].id].createIcon=Curse.AION.Item.createIcon;cg_aion_items[dataArray[i].id].getNameWithRarity=Curse.AION.Item.getNameWithRarity;cg_aion_items[dataArray[i].id].getNameWithStyle=Curse.AION.Item.getNameWithStyle;cg_aion_items[dataArray[i].id].getStat=Curse.AION.Item.getStat;}}
if(!Curse.AION){Curse.AION={};}
Curse.AION.Item={};Curse.AION.Item.createIcon=function(size,num,showNum,baseURL){if(!baseURL){baseURL="";}
return new Curse.Icon(size,this.icon,baseURL+"item.aspx?id="+this.id,this.id,null,Curse.Tooltip.handleItemLinkOver,{hideIcon:true},Curse.Tooltip.hide,null,num,null,showNum,null,null,baseURL);};Curse.AION.Item.getStat=function(statid){if(this.stats==null){return 0;}
for(var i=0;i<this.stats.length;i++){if(this.stats[i].id==statid)
return this.stats[i].val;}
return 0;};Curse.AION.Item.getName=function(){if(this.name){return this.name;}
var name=this.tooltip.substring(52,this.tooltip.indexOf("</span>"))
name=name.substring(name.indexOf(">")+1);this.name=name;return this.name;};Curse.AION.Item.getNameWithRarity=function(){if(!this.name){name=this.getName();}
if(!this.rarity){var rindex=this.tooltip.indexOf('class="r');this.rarity=this.tooltip.substring(rindex+8,rindex+9);}
return{name:this.name,rarity:this.rarity};};Curse.AION.Item.getNameWithStyle=function(){if(this.nameWithStyle){return this.nameWithStyle;}
var name="<span "+this.tooltip.substring(this.tooltip.indexOf("class"),this.tooltip.indexOf("</span>"))+"</span>";this.nameWithStyle=name;return this.nameWithStyle;};if(Curse.AION.Site){cg_items=cg_aion_items;}
var cg_aion_quests={};Curse.AION.Quest={};cg_aion_quests.addData=function(data){if(data.length==null){dataArray=[];dataArray[0]=data;}
else{dataArray=data;}
for(var i=0,len=dataArray.length;i<len;i++){cg_aion_quests[dataArray[i].id]=dataArray[i];cg_aion_quests[dataArray[i].id].getName=Curse.AION.Quest.getName;}}
Curse.AION.Quest.getName=function(){if(this.name){return this.name;}
var name=this.tooltip.substring(52,this.tooltip.indexOf("</span>"))
name=name.substring(name.indexOf(">")+1);this.name=name;return this.name;};if(Curse.AION.Site){cg_quests=cg_aion_quests;}
var cg_aion_spells={};cg_aion_spells.addData=function(data){var dataArray;if(data.length==null){dataArray=[];dataArray[0]=data;}
else{dataArray=data;}
for(var i=0,len=dataArray.length;i<len;i++){cg_aion_spells[dataArray[i].id]=dataArray[i];cg_aion_spells[dataArray[i].id].getName=Curse.AION.Spell.getName;cg_aion_spells[dataArray[i].id].createIcon=Curse.AION.Spell.createIcon;}}
if(!Curse.AION)
Curse.AION={};Curse.AION.Spell={};Curse.AION.Spell.createIcon=function(size,baseURL,url){if(!baseURL){baseURL="";}
if(!url){url=baseURL+"spell.aspx?id="+this.id;}
return new Curse.Icon(size,this.icon,url,this.id,null,Curse.Tooltip.handleSpellLinkOver,{hideIcon:true},Curse.Tooltip.hide,null,null,null,null,null,null,baseURL);};Curse.AION.Spell.getName=function(){if(this.name){return this.name;}
var name=this.tooltip.substring(this.tooltip.indexOf("spell-name")+12,this.tooltip.indexOf("</span>"));this.name=name;return this.name;};if(Curse.AION.Site){cg_spells=cg_aion_spells;}
var cg_aion_recipes={};Curse.AION.Recipe={};cg_aion_recipes.addData=function(data){if(data.length==null){dataArray=[];dataArray[0]=data;}
else{dataArray=data;}
for(var i=0,len=dataArray.length;i<len;i++){cg_aion_recipes[dataArray[i].id]=dataArray[i];cg_aion_recipes[dataArray[i].id].getName=Curse.AION.Recipe.getName;cg_aion_recipes[dataArray[i].id].createIcon=Curse.AION.Recipe.createIcon;}}
Curse.AION.Recipe={};Curse.AION.Recipe.createIcon=function(size,baseURL,url){if(!baseURL){baseURL="";}
if(!url){url=baseURL+"recipe.aspx?id="+this.id;}
return new Curse.Icon(size,this.icon,url,this.id,null,Curse.Tooltip.handleRecipeLinkOver,{hideIcon:true},Curse.Tooltip.hide,null,null,null,null,null,null,baseURL);};Curse.AION.Recipe.getName=function(){if(this.name){return this.name;}
var name=this.tooltip.substring(this.tooltip.indexOf("item-name")+11,this.tooltip.indexOf("</span>"));this.name=name;return this.name;};if(Curse.AION.Site){cg_recipes=cg_aion_recipes;}
if(!Curse.AION){Curse.AION={};}
Curse.AION.Syndication=function(){this.initialize();}
Curse.AION.Syndication.prototype={uniqueID:0,baseURL:"http://www.aionarmory.com/",bindEvents:function(){var closure=this.parseLinks.bindAsEventListener(this);cg_addEventListener(window,"load",closure)},getUniqueID:function(){return this.uniqueID++;},initialize:function(){if(this.baseURL.indexOf("$siteurl")==0){this.baseURL="http://localhost/aiondb/";}
Curse.AION.Tooltip.baseURL=this.baseURL;this.insertStyleSheet();this.bindEvents();this.loadedObjects={};this.links={};this.externalReferences=[];},hasLoadedObject:function(type,id){if(this.loadedObjects[type+"_"+id]==true){return true;}
return false;},insertStyleSheet:function(){var hd=document.getElementsByTagName("head")[0];var css=document.createElement("link");css.rel="stylesheet";css.type="text/css";css.href=this.baseURL+"tooltips.css?072";hd.appendChild(css);},addExternalReference:function(id,relatedLink,handler,loadNow){var type=null;if(handler==Curse.AION.Tooltip.handleAjaxItem){type="1";}
else if(handler==Curse.AION.Tooltip.handleAjaxQuest){type="4";}
else if(handler==Curse.AION.Tooltip.handleAjaxSpell){type="6";}
else if(handler==Curse.AION.Tooltip.handleAjaxRecipe){type="131";}
if(relatedLink.uniqueID==null&&type=="1"&&(relatedLink.runes!=null)){relatedLink.uniqueID=this.getUniqueID();}
if(relatedLink.uniqueID!=null){if(this.loadedObjects["500_"+relatedLink.uniqueID]){return;}
this.loadedObjects["500_"+relatedLink.uniqueID]=true;}
else{if(this.loadedObjects[type+"_"+id]){return;}
this.loadedObjects[type+"_"+id]=true;}
this.loadedObjects[type+"_"+id]=true;var url="ExTooltips.aspx?id="+id+"&type="+type;if(type=="1"&&relatedLink.runes!=null){if(relatedLink.runes.length>0){var runeString="";for(var i=0;i<relatedLink.runes.length;i++){runeString+="|"+relatedLink.runes[i];}
url+="&runes="+runeString.substring(1,runeString.length);}}
if(loadNow){var hd=document.getElementsByTagName("head")[0];var oscript=document.createElement("script");oscript.type="text/javascript";oscript.src=this.baseURL+url;hd.appendChild(oscript);}
else{this.externalReferences.push(url);}},addObject:function(type,data){var link=null;switch(type){case 1:this.handleItemLoad(data);break;case 4:this.handleQuestLoad(data);break;case 6:this.handleSpellLoad(data);break;case 131:this.handleRecipeLoad(data);break;}},parseLinks:function(){var linksCol=document.getElementsByTagName("a");var lpattern=new RegExp("aionarmory.*?com.*?(item|spell|quest|recipe).*?aspx.*?id[=|%|3|D]+(\\d+)");for(var i=0;i<linksCol.length;i++){var match=lpattern.exec(linksCol[i].href);if(match){var entityTypeID=1;var entityType=match[1];var entityID=match[2];linksCol[i].id=entityType+"_"+entityID;linksCol[i]._relatedID=entityID;if(this.links[linksCol[i].id]==null){this.links[linksCol[i].id]=[];}
this.links[linksCol[i].id].push(linksCol[i]);if(entityType=="item"){this.setItemLink(linksCol[i]);}
else if(entityType=="spell"){this.setSpellLink(linksCol[i]);}
else if(entityType=="recipe"){this.setRecipeLink(linksCol[i]);}
else if(entityType=="quest"){linksCol[i].onmouseover=Curse.AION.Tooltip.handleQuestLinkOver.bind(this,linksCol[i]);}
linksCol[i].onmouseout=Curse.Tooltip.hide;}}
var hd=document.getElementsByTagName("head")[0];for(var i=0;i<this.externalReferences.length;i++){var oscript=document.createElement("script");oscript.type="text/javascript";oscript.src=this.baseURL+this.externalReferences[i];hd.appendChild(oscript);}
this.externalReferences=[];},handleSpellLoad:function(data){cg_aion_spells.addData(data);var linkArray=this.links["spell_"+data.id];var id=data.id;for(var i=0;i<linkArray.length;i++){var link=linkArray[i];if(link.className.indexOf("aiondb-spell-full")==0){var arrLinkStyle=link.className.split("-");if(arrLinkStyle.length==4){iconSize=arrLinkStyle[3];}
var fullSpell=this.getFullSpell(cg_aion_spells[id],null,iconSize,null);oReplace=link.parentNode.replaceChild(fullSpell,link);}
else if(link.className.indexOf("aiondb-spell-icon")==0){var arrLinkStyle=link.className.split("-");if(arrLinkStyle.length==4){iconSize=arrLinkStyle[3];}
var fullSpell=this.getFullSpell(cg_aion_spells[id],null,iconSize,true);oReplace=link.parentNode.replaceChild(fullSpell,link);}
else if(link.className.indexOf("aiondb-spell-text")==0){var spellLink=this.getSpellLink(cg_aion_spells[id],null);oReplace=link.parentNode.replaceChild(spellLink,link);}
else{if(Curse.Tooltip.getCurrentTooltip()==link._relatedID){link.onmouseover();}}}},handleRecipeLoad:function(data){cg_aion_recipes.addData(data);var linkArray=this.links["recipe_"+data.id];var id=data.id;for(var i=0;i<linkArray.length;i++){var link=linkArray[i];if(link.className.indexOf("aiondb-recipe-full")==0){var arrLinkStyle=link.className.split("-");if(arrLinkStyle.length==4){iconSize=arrLinkStyle[3];}
var fullRecipe=this.getFullRecipe(cg_aion_recipes[id],null,iconSize,null);oReplace=link.parentNode.replaceChild(fullRecipe,link);}
else if(link.className.indexOf("aiondb-recipe-icon")==0){var arrLinkStyle=link.className.split("-");if(arrLinkStyle.length==4){iconSize=arrLinkStyle[3];}
var fullRecipe=this.getFullRecipe(cg_aion_recipes[id],null,iconSize,true);oReplace=link.parentNode.replaceChild(fullRecipe,link);}
else if(link.className.indexOf("aiondb-recipe-text")==0){var recipeLink=this.getRecipeLink(cg_aion_recipes[id],null);oReplace=link.parentNode.replaceChild(recipeLink,link);}
else{if(Curse.Tooltip.getCurrentTooltip()==link._relatedID){link.onmouseover();}}}},handleQuestLoad:function(data){cg_aion_quests.addData(data);var linkArray=this.links["quest_"+data.id];var id=data.id;for(var i=0;i<linkArray.length;i++){var link=linkArray[i];if(Curse.Tooltip.getCurrentTooltip()==link._relatedID){link.onmouseover();}}},handleItemLoad:function(data){cg_aion_items.addData(data);var linkArray=this.links["item_"+data.id];var id=data.id;for(var i=0;i<linkArray.length;i++){var link=linkArray[i];if(link.className.indexOf("aiondb-item-full")==0){var arrLinkStyle=link.className.split("-");if(arrLinkStyle.length==4){iconSize=arrLinkStyle[3];}
var fullItem=this.getFullItem(cg_aion_items[id],null,iconSize,null);if(link.parentNode){oReplace=link.parentNode.replaceChild(fullItem,link);}}
else if(link.className.indexOf("aiondb-item-text")==0){var textItem=this.getItemLink(cg_aion_items[id],null);if(link.parentNode){oReplace=link.parentNode.replaceChild(textItem,link);}}
else if(link.className.indexOf("aiondb-item-icon")==0){var arrLinkStyle=link.className.split("-");if(arrLinkStyle.length==4){iconSize=arrLinkStyle[3];}
var fullItem=this.getFullItem(cg_aion_items[id],null,iconSize,true);if(link.parentNode){oReplace=link.parentNode.replaceChild(fullItem,link);}}
else{if(Curse.Tooltip.getCurrentTooltip()==link._relatedID){link.onmouseover();}}}},getSpellLink:function(spell,tooltipLabel){if(!tooltipLabel){tooltipLabel=spell.getName();}
var a=cg_ce("a");cg_ae(a,cg_ct(tooltipLabel));a.href=this.baseURL+"spell.aspx?id="+spell.id;a._relatedID=spell.id;a.onmouseover=Curse.AION.Tooltip.handleSpellLinkOver.bind(this,a);a.onmouseout=Curse.Tooltip.hide;return a;},getRecipeLink:function(recipe,tooltipLabel){if(!tooltipLabel){tooltipLabel=recipe.getName();}
var a=cg_ce("a");cg_ae(a,cg_ct(tooltipLabel));a.href=this.baseURL+"recipe.aspx?id="+recipe.id;a._relatedID=recipe.id;a.onmouseover=Curse.AION.Tooltip.handleRecipeLinkOver.bind(this,a);a.onmouseout=Curse.Tooltip.hide;return a;},getItemLink:function(item,tooltipLabel){if(!tooltipLabel){tooltipLabel=item.getNameWithRarity().name;}
var a=cg_ce("a");a.className="aion_r"+item.getNameWithRarity().rarity;cg_ae(a,cg_ct(tooltipLabel));a.href=this.baseURL+"item.aspx?id="+item.id;a._relatedID=item.id;a.onmouseover=Curse.AION.Tooltip.handleItemLinkOver.bind(this,a);a.onmouseout=Curse.Tooltip.hide;return a;},getFullItem:function(item,tooltipLabel,iconSize,iconOnly){if(iconOnly==null){iconOnly=false;}
if(!iconOnly){var a=this.getItemLink(item,tooltipLabel);}
if(!iconSize){iconSize=1;}
else{switch(iconSize){case"small":iconSize=0;break;case"medium":iconSize=1;break;case"large":iconSize=2;break;}}
var tbl=document.createElement("TABLE");tbl.className="aiondb-table";var tbody=cg_ce('tbody');var row=cg_ce('tr');var oIconCell=cg_ce('td');var oLinkCell=cg_ce('td');var ic=item.createIcon(iconSize,0,0,this.baseURL);cg_ae(oIconCell,ic);if(!iconOnly){cg_ae(oLinkCell,a);}
row.appendChild(oIconCell);if(!iconOnly){row.appendChild(oLinkCell);}
tbody.appendChild(row);tbl.appendChild(tbody);return tbl;},getRunes:function(link){var runes=new Array();for(var i=0;i<link.attributes.length;i++){var attr=link.attributes[i];if(attr.nodeName=="runes"){runes.push(attr.nodeValue);}}
return runes;},getFullSpell:function(spell,tooltipLabel,iconSize,iconOnly){if(iconOnly==null){iconOnly=false;}
if(!iconOnly){var a=this.getSpellLink(spell,tooltipLabel);}
if(!iconSize){iconSize=1;}
else{switch(iconSize){case"small":iconSize=0;break;case"medium":iconSize=1;break;case"large":iconSize=2;break;}}
var tbl=document.createElement("TABLE");tbl.className="aiondb-table";var tbody=cg_ce('tbody');var row=cg_ce('tr');var oIconCell=cg_ce('td');var oLinkCell=cg_ce('td');cg_ae(oIconCell,spell.createIcon(iconSize,this.baseURL));if(!iconOnly){cg_ae(oLinkCell,a);}
row.appendChild(oIconCell);row.appendChild(oLinkCell);tbody.appendChild(row);tbl.appendChild(tbody);return tbl;},getFullRecipe:function(recipe,tooltipLabel,iconSize,iconOnly){if(iconOnly==null){iconOnly=false;}
if(!iconOnly){var a=this.getRecipeLink(recipe,tooltipLabel);}
if(!iconSize){iconSize=1;}
else{switch(iconSize){case"small":iconSize=0;break;case"medium":iconSize=1;break;case"large":iconSize=2;break;}}
var tbl=document.createElement("TABLE");tbl.className="aiondb-table";var tbody=cg_ce('tbody');var row=cg_ce('tr');var oIconCell=cg_ce('td');var oLinkCell=cg_ce('td');cg_ae(oIconCell,recipe.createIcon(iconSize,this.baseURL));if(!iconOnly){cg_ae(oLinkCell,a);}
row.appendChild(oIconCell);row.appendChild(oLinkCell);tbody.appendChild(row);tbl.appendChild(tbody);return tbl;},setItemLink:function(link){var runes=this.getRunes(link);if(runes.length<1){runes=[];}
link.runes=runes;if(link.className.indexOf("aiondb-item")<0){link.onmouseover=Curse.AION.Tooltip.handleItemLinkOver.bind(this,link);return;}
this.addExternalReference(link._relatedID,link,Curse.AION.Tooltip.handleAjaxItem);},setSpellLink:function(link){if(link.className.indexOf("aiondb-spell")<0){link.onmouseover=Curse.AION.Tooltip.handleSpellLinkOver.bind(this,link);return;}
this.addExternalReference(link._relatedID,link,Curse.AION.Tooltip.handleAjaxSpell);},setRecipeLink:function(link){if(link.className.indexOf("aiondb-recipe")<0){link.onmouseover=Curse.AION.Tooltip.handleRecipeLinkOver.bind(this,link);return;}
this.addExternalReference(link._relatedID,link,Curse.AION.Tooltip.handleAjaxRecipe);},detectDoctype:function(){var re=/\s+(X?HTML)\s+([\d\.]+)\s*([^\/]+)*\//gi;var res=false;if(typeof document.namespaces!="undefined"){res=document.all[0].nodeType==8?re.test(document.all[0].nodeValue):false;}
else{res=document.doctype!=null?re.test(document.doctype.publicId):false;}
if(res){res=new Object();res['xhtml']=RegExp.$1;res['version']=RegExp.$2;res['importance']=RegExp.$3;return res;}
else{return null;}},useFixedWidths:function(){if(!Curse.Browser.ie){return false;}
if(Curse.Browser.ie6){return true;}
if(Curse.Browser.ie7){var doctype=this.detectDoctype();if(doctype==null){return true;}
else{if(doctype.version&&doctype.version=="4.0"){return true}
return false;}}}}
var cg_aiondbsyndication=new Curse.AION.Syndication();