{if $links}
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Access</th>
                <th>Menu Location</th>
                <th>Menu Name</th>
                <th>Menu Module</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$links item=link}
                    {if $link.permission}
                        <tr>
                            <td><input type="checkbox" name="MENU_{$link.id}" id="MENU_{$link.id}" {if $link.has}checked="checked"{/if}></td>
                            <td>{$link.side}</td>
                            <td>{$link.name}</td>
                            <td>{$link.link}</td>
                        </tr>
                    {else}
                        <tr style="opacity:0.6">
                            <td><input type="checkbox" disabled="disabled" checked="checked"></td>
                            <td>{$link.side}</td>
                            <td>{$link.name}</td>
                            <td>{$link.link}</td>
                        </tr>
                    {/if}		
            {/foreach}
        </tbody>
    </table>
    <div class="alert alert-warning">
        <i class="fa fa-exclamation-triangle"></i> 
        Disabled checkboxes = Visible to everyone
        <br>
        These permissions can be set by changing the settings in <a href="{$url}admin/menu">Menu Links</a>
    </div>
{else}
<p>No Menu links found!</p>
{/if}