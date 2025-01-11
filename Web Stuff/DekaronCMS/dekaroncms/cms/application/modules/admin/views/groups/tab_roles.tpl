<table width="100%" class="table table-condensed">
    <thead>
        <tr>
            <th>Access</th>
            <th>Module</th>   
            <th>Role</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$modules key=name item=module}
            {if $module.db || $module.manifest}

                {if $module.manifest}
                    {foreach from=$module.manifest key=roleName item=role}
                        <tr>
                            <td><input type="checkbox" name="{$name}-{$roleName}" id="{$name}-{$roleName}" {if $role.has}checked="checked"{/if}></td>
                            <td>{ucfirst($module.name)}</td>
                            <td><label style="{if isset($role.color)}color:{$role.color};{/if}">{$roleName}</label></td>
                            <td>{$role.description}</td>
                        </tr>
                    {/foreach}
                {/if}
            {/if}
        {/foreach}
    </tbody>
</table>