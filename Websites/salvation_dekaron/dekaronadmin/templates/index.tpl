{include file="html_head.tpl"}
{include file="header.tpl"}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="230" valign="top">{include file="navigation.tpl"}</td>
<td valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td valign="top"><div align="center" style="">{if $POST != ''}{$POST}{else}{include file="{$m_am}.tpl"}{/if}</div></td>
</tr>
</table></td>
<td valign="top" bgcolor="#465786" width="5">&nbsp;</td>
</tr>
</table>
{include file="html_footer.tpl"}