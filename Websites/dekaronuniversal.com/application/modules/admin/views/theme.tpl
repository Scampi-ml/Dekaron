<table class="table table-condensed">
    {foreach from=$themes item=manifest key=id}
        <tr>
            <td><img src="{$url}application/themes/{strtolower($manifest.folderName)}/images/{$manifest.favicon}" /></td>
            <td>
                <div class="col-sm-2 gallery-image">
                    <img alt="image" src="{$url}application/themes/{$manifest.folderName}/{$manifest.screenshot}">
                </div>            
            </td>
            <td>{$manifest.name}<br /> by <a target="_blank" href="{$manifest.website}">{$manifest.author}</a></td>
            <td>
                {if $manifest.folderName == $current_theme}
                    Active theme
                {else}
                    <a class="btn btn-default" href="javascript:void(0)" onClick="Theme.select('{strtolower($manifest.folderName)}')">Activate theme</a>
                {/if}            
            </td>
        </tr>            
    {/foreach}   
</table> 





