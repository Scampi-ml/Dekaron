<!--

{$updates|@var_dump}
-->
<h4 class="page-header"> Current Version {$current_version} <a title="" data-toggle="modal" href="#modal-regular" class="btn btn-option" href="javascript:void(0)" data-original-title="Help">Help</a></h4>
{if count($updates)}
    {foreach from=$updates item=update}
        {if $update.version > $current_version}
            <div class="block block-themed themed-fire">
                <div class="block-title">
                    <div class="block-options">
                        <a title="" data-toggle="block-collapse" class="btn btn-option enable-tooltip" href="javascript:void(0)" data-original-title="Toggle block's content"><i class="fa fa-arrow-up"></i></a>
                        <a title="" class="btn btn-option enable-tooltip" onClick="Update.delete('{$update.version}');" data-original-title="Delete Update {$update.version}"><i class="fa fa-times"></i></a>
                    </div>
                    <h4><code>{$update.version}</code></h4>
                </div>
        {else if $update.version == $current_version}
            <div class="block block-themed themed-night">
                <div class="block-title">
                    <div class="block-options">
                        <a title="" data-toggle="block-collapse" class="btn btn-option enable-tooltip" href="javascript:void(0)" data-original-title="Toggle block's content"><i class="fa fa-arrow-up"></i></a>
                        <a title="" class="btn btn-option enable-tooltip" onClick="Update.delete('{$update.version}');" data-original-title="Delete Update {$update.version}"><i class="fa fa-times"></i></a>
                    </div>
                    <h4><code>{$update.version}</code></h4>
                </div>
        {else}
            <div class="block block-themed themed-leaf">
                <div class="block-title">
                    <div class="block-options">
                        <a title="" data-toggle="block-collapse" class="btn btn-option enable-tooltip" href="javascript:void(0)" data-original-title="Toggle block's content"><i class="fa fa-arrow-up"></i></a>
                        <a title="" class="btn btn-option enable-tooltip" onClick="Update.delete('{$update.version}');" data-original-title="Delete Update {$update.version}"><i class="fa fa-times"></i></a>
                    </div>
                    <h4><code>{$update.version}</code></h4>
                </div>
        {/if}
            <div class="block-content" >
                {if $update.instructions}
                    <h2>Installation instructions</h2>
                    <p>{$update.instructions}</p>
                {/if}

                {if $update.changelog}
                    <h2>Changelog</h2>
                    <p>{$update.changelog}</p>
                {/if}  


                <h2>For you to do</h2>
                <ul>
                    {if $update.sql}
                        <p><a class="btn btn-sm btn-inverse" href="{$url}admin/update/UpdateSql/{$update.version}" >Click here to run database changes</a></p>
                    {/if}

                    {if $update.zip}
                        {foreach from=$update.zip item=zip}
                            <p><a class="btn btn-sm btn-inverse" href="{$url}admin/update/UpdateZip/{$update.version}/{$zip}">Extract {$zip|regex_replace:"/_/":" "}</a></p>
                        {/foreach}
                    {/if}

                    {if $update.tools}
                        {foreach from=$update.tools item=tool}
                            <p><a class="btn btn-sm btn-inverse" href="{$url}admin/update/UpdateTool/{$update.version}/{$tool}" >Click here to use tool: {$tool|regex_replace:"/_/":" "}</a></p>
                        {/foreach}
                    {/if}
                </ul>        
            </div>
        </div>
    {/foreach}
{else}
    <div class="alert alert-danger">
        <i class="fa fa-times-circle"></i> No updates found in the update folder 
    </div>
{/if}

<div class="modal fade" id="modal-regular" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h4>Update Help</h4></div>
            <div class="modal-body">
                <p>This page lists all updates in the <b>'application/updates'</b> folder. </p>
                <p>&nbsp;</p>
                <p><i class="fa fa-square text-danger"></i> = This update is lower then the current version you have. You should install this update.</p>
                <p><i class="fa fa-square text-success"></i> = This update is higher then your current version. There is no need to install this update, this can be removed from the updates folder.</p>
                <p><i class="fa fa-square text-black"></i> = This update is equal to your current version. This can happen if you installed the latest update. You can remove this from your update list.</p>
                <p>&nbsp;</p>
                <p>To install an update, follow the steps in the instructions. Once you have completed all the steps, you can delete the folder 'application/updates/<b>x.x.x</b>' from your installation.</p>
            </div>
            <div class="modal-footer"><button data-dismiss="modal" class="btn btn-danger">Close</button></div>
        </div>
    </div>
</div>