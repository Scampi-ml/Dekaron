<table class="table">
    <thead>
        <tr>
            <th>Favicon</th>
            <th>Screenshot</th>
            <th>Theme Name</th>
            <th>Version</th>
            <th>Folder</th>
            <th>Author</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$themes item=manifest key=id}
            <tr>
                <td class="text-center"><img src="{$url}application/themes/{strtolower($manifest.folderName)}/images/{$manifest.favicon}" /></td>
                <td><img alt="image" src="{$url}application/themes/{$manifest.folderName}/images/screenshot.jpg"></td>
                <td>{$manifest.name}</td>
                <td>{$manifest.version}</td>
                <td>application/themes/{strtolower($manifest.folderName)}/</td>
                <td><a target="_blank" href="{$manifest.website}">{$manifest.author}</a></td>
                <td>
                    {if strtolower($manifest.folderName) == strtolower($theme)}
                        Current Active theme
                    {else}
                        <a class="btn btn-default" href="javascript:void(0)" onClick="Settings.saveTheme('{strtolower($manifest.folderName)}')">Activate theme</a>
                    {/if}            
                </td>
            </tr>            
        {/foreach} 
    </tbody>  
</table> 