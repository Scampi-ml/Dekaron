<div class="block block-tiles block-tiles-animated clearfix">
    <a href="javascript:void(0)" class="tile tile-width-2x tile-themed themed-background-default">
        <i class="fa fa-gears"></i>
        <div class="tile-info">
            <div class="pull-left">PHP version</div>
            <div class="pull-right"><strong>{$php_version}</strong></div>
        </div>
    </a>
    <a href="javascript:void(0)" class="tile tile-width-2x tile-themed themed-background-leaf">
        <i class="fa fa-check"></i>
        <div class="tile-info">
            <div class="pull-left">CMS version</div>
            <div class="pull-right"><strong>{$version}</strong></div>
        </div>
    </a>   
    <a href="javascript:void(0)" class="tile tile-width-2x tile-themed themed-background-tulip">
        <i class="fa fa-tint"></i>
        <div class="tile-info">
            <div class="pull-left">Theme</div>
            <div class="pull-right"><strong>{$theme_value}</strong></div>
        </div>
    </a>  
</div>

{if $checkVersion === 'false'}
    <div class="alert alert-warning">
    	<i class="fa fa-exclamation-triangle"></i> 
    	There is a version of DekaronCMS available.
        <a class="btn btn-sm btn-success" href="http://updates.dekaroncms.com/?version={$version}">Download now</a>
    </div>
{/if}

{if $checkUpdates > 0}
    <div class="alert alert-warning">
        <i class="fa fa-exclamation-triangle"></i> 
        There are new updates available! <a class="btn btn-sm btn-success" href="{$url}admin/update">Update now</a>
    </div>
{/if}

<div class="block block-themed themed-default">
	<div class="block-title"><h4>Admin Notes</h4></div>
	<div class="block-content full">
		<form onSubmit="Admin.saveNotes(); return false">
		<textarea placeholder="You can use this section to keep notes for all members who access the Admin CP. It is globally editable by all admins who have access to the dashboard." rows="10" class="form-control" name="notes" id="notes">{$notes}</textarea>
		<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save</button>
		</form>
	</div>
</div>