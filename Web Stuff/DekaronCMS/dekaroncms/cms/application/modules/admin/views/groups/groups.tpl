<div class="block block-themed">
    <div class="block-title">
        <h4>What group do you want to manage?</h4>
    </div>
    <div class="block-content">
        <table class="table">
            <tr>
                {foreach from=$groups item=group}
                    <td width="50%" class="text-center"><a href="{$url}admin/groups/editGroup/{$group.id}" class="btn btn-lg btn-info" ><i class="fa fa-users"></i> {$group.name}</a><br />{$group.description}</td>
                {/foreach}
            </tr>
        </table>
    </div>
</div>
