{if $characters > 0}
    <div class="ucp_divider"></div>
    <section id="ucp_characters">
		<h1>Characters</h1>
        <div class="clear"></div>
    </section>    
    <table class="nice_table" width="100%">
        {foreach from=$characters item=character}
            <tr>
                <td><img width="50" height="45" src='{$url}application/images/avatars/{$character.byPCClass}.png' align='absbottom'/></td>
                <td><a href="{$url}character/{$character.character_name}" >{$character.character_name}</a></td>
                <td>Lv{$character.wLevel}</td>
            </tr>        
        {/foreach}     
    </table>    
{/if}