{include file="header.tpl" title="Example Smarty Page" }

<h1>
{* capitalize the first letters of each word of the title *}
Title: {$title|capitalize}
{if $bold}</b>{/if}
</h1>

{include file="footer.tpl"}
