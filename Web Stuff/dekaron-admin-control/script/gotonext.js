function gotoNext()
{
	thisForm = document.accentForm;
	if( thisForm.confirmchk.checked == false )
	{
		alert("You should read and agree with the terms to continue!");
	}
	else
	{
		document.accentForm.submit();
	}
}
