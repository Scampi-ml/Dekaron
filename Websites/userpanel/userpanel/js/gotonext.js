function gotoNext()
{
	thisForm = document.accentForm;
	if( thisForm.confirmchk.checked == false )
	{
		alert("Please check the amount, and check the checkbox.");
	}
	else
	{
		document.accentForm.submit();
	}
}
