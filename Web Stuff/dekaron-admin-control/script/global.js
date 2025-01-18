function ask_url(ask,url)
{
	var detStatus=confirm(ask);
	if (detStatus)
	{
		    location.href = url;
	}
	else
	{
		return false;
	}
}
function ask_action(url)
{
	location.href = url;
}

function url(url)
{
	location.href = url;
}

function CheckAll(form,field)
{
	var t=0;
	var c=form[field];
	for(var i=0;i<c.length;i++)
	{
		c[i].checked = true;
	}
}

function UnCheckAll(form,field)
{
	var t=0;
	var c=form[field];
	for(var i=0;i<c.length;i++)
	{
	c[i].checked = false;
	}
}

function cCheck(form,field,rID,text) {
	var t=0;
	var c=form[field];
	for(var i=0;i<c.length;i++)
	{
		c[i].checked?t++:null;
	}
	
	if(text)
	{
		document.getElementById(rID).value=  text+" ("+t+")";
	}
	else
	{
		document.getElementById(rID).value= "Delete Selected ("+t+")";
	}
}

function ask_form(ask,form_name)
{
	var detStatus=confirm(ask);
	if (detStatus){
		return true;
	}else{
		return false;
	}
}

function MM_jumpMenu(targ,selObj,restore)
{
	eval("self"+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	if (restore) selObj.selectedIndex=0;
}

function md5passw()
{
	window.open("script/md5_password.php","Create MD5 Password","menubar=0,resizable=0,left=500,top=500,width=280,height=130");
}

function guildemblem()
{
	window.open("script/emblem/index.php","Create Emblem","menubar=0,resizable=0,left=500,top=400,width=570,height=420");
}

