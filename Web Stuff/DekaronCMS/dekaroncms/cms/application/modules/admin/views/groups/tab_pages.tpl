{if $pages}
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Access</th>
                <th>Page Name</th>
                <th>Link Identifier</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$pages item=page}         
                    {if $page.permission}
                        <tr>
                            <td><input type="checkbox" name="PAGE_{$page.id}" id="PAGE_{$page.id}" {if $page.has}checked="checked"{/if}></td>
                            <td>{$page.name}</td>
                            <td>pages/{$page.identifier}</td>
                        </tr>
                    {else}
                        <tr style="opacity:0.6">
                            <td><input type="checkbox" disabled="disabled" checked="checked"></td>
                            <td>{$page.name}</td>
                            <td>pages/{$page.identifier}</td>
                        </tr>
                    {/if}		
            {/foreach}
        </tbody>
    </table>
    <div class="alert alert-warning">
        <i class="fa fa-exclamation-triangle"></i> 
        Disabled checkboxes = Visible to everyone
        <br>
        These permissions can be set by changing the settings in <a href="{$url}admin/page">Custom Pages</a>
    </div>
{else}
<p>No pages found!</p>
{/if}