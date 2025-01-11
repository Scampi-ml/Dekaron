{include file="inc/view_header.tpl"}
<aside id="right">
    <article class="subpage">
        <h1 class="top sub-header"><p>{$title} >> Pvp Lose <a href="{$SITE_URL}ranking" class="nice_button" style="float:right;"><- Back to ranking</a></p></h1>     
        <section class="body">
            <table width="100%">
                <thead>
                    <tr>
                        <th align="left"><b>Nr.</b></th>
                        <th align="left"><b>Character Name</b></th>
                        <th align="left"><b>Guild</b></th>
                        <th align="left"><b>Lose</b></th>
                        <th align="left"><b>Class</b></th>
                	</tr>
                </thead>
                <tbody>
                    <tr>
                    	<td>&nbsp;</td>
                    </tr>
                    {foreach from=$ranking item=rank}
                    <tr>
                        <td class="left" width="2%"><span style="color:#816537">{$rank.nr}</span> </td>
                        <td class="left" width="20%"><span style="color:#c59e4b">{$rank.character_name}</span> </td>
                        <td class="left" width="20%"><span style="color:#816537">{$rank.guild_name}</span></td>
                        <td class="left" width="20%"><span style="color:#816537">{$rank.wLoseRecord}</span></td>
                        <td class="left" width="20%"><span style="color:#816537">{$rank.byPCClass}</span></td>
                    </tr>                
                    {/foreach}                
                </tbody>
            </table>
        </section>                     
 	</article>    
</aside>      
{include file="inc/view_footer.tpl"}