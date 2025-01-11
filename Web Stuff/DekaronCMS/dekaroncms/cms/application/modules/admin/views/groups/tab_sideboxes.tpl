{if $sideboxes}
    <h3>Sideboxes</h3>
    <table width="100%" class="table table-condensed">
        {foreach from=$sideboxes item=sidebox}                                
            {if $sidebox.permission}
                <tr>
                    <td width="5%" style="text-align:center;"><input type="checkbox" name="SIDEBOX_{$sidebox.id}" id="SIDEBOX_{$sidebox.id}" {if $sidebox.has}checked="checked"{/if}></td>
                    <td width="25%">{$sidebox.displayName}</td>
                    <td >{$sidebox.type}</td>
                </tr>
            {else}
                <tr style="opacity:0.6">
                    <td width="5%" ><input type="checkbox" disabled="disabled" checked="checked"></td>
                    <td width="25%">{$sidebox.displayName}</td>
                    <td >{$sidebox.type}</td>
                </tr>
            {/if}		
        {/foreach}
    </table>
{else}
<p>No sideboxes found!</p>
{/if}