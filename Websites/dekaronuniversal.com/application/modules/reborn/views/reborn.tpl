<section id="teleport">
	<section id="select_character">
		{if $total}
				<table class="nice_table" width="100%">
                {foreach from=$characters item=character}
                <tr>
                	<td><img class="item_icon" width="72" height="60" src="{$url}application/images/avatars/{$character.byPCClass}.png" align="absmiddle" ></td>
				    {if $character.wLevel >= $RbLevel && $character.dwMoney >= $cost && $character.Reborn != $MaxRb}
				   		<td><a href="javascript:void(0)" class="nice_button" onClick="Reborn.doreborn('{$character.character_no}', '{$character.character_name}', this);">Reborn</a></td>
					{else}
						<td><a href="javascript:void(0)" class="nice_button">Cant Reborn</a></td>
					{/if}
                    <td><a class="character_name" >{$character.character_name}</a></td>
                    <td><img src="{$url}application/images/icons/coins.png" align="absmiddle"> {$character.dwMoney|number_format:0:",":"."} Dil</td>
                    <td>Lv {$character.wLevel}</td>
                    <td>Rb {$character.Reborn}</td>
                 </tr>    
				{/foreach}
                </table>
		{else}
			<center style="padding-top:10px;"><b>{lang("no_chars", "teleport")}</b></center>
		{/if}
	</section>
	<br>
	<div class="clear"></div>
    <section id="ucp_characters">
		<h1>Reborn Requirements</h1>
        <div class="clear"></div>
    </section> 	
		<table class="nice_table" width="100%">
			<tr>
				<td>Level</td>
				<td>{$RbLevel}</td>
			</tr>
			<tr>
				<td>Max Reborn</td>
				<td>{$MaxRb}</td>
			</tr>
			<tr>
				<td>Cost</td>
				<td>{$cost|number_format:0:",":"."} Dil</td>
			</tr>
		</table>
	<div class="clear"></div>
</section>