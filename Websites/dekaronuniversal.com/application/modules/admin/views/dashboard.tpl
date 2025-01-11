<div class="block block-tiles block-tiles-animated clearfix">
    <a href="javascript:void(0)" class="tile tile-width tile-themed themed-background-default">
        <i class="fa fa-gears"></i>
        <div class="tile-info">
            <div class="pull-left">PHP version</div>
            <div class="pull-right"><strong>{$php_version}</strong></div>
        </div>
    </a>
    <a href="javascript:void(0)" class="tile tile-width tile-themed themed-background-leaf">
        <i class="fa fa-check"></i>
        <div class="tile-info">
            <div class="pull-left">CMS version</div>
            <div class="pull-right"><strong>{$version}</strong></div>
        </div>
    </a> 
    <a {if hasPermission("changeTheme")}href="{$url}admin/theme"{else}href="javascript:void(0)"{/if} class="tile tile-width tile-themed themed-background-city">
        <i class="fa fa-picture-o"></i>
        <div class="tile-info">
            <div class="pull-left">Theme</div>
            <div class="pull-right"><strong>{$theme.name}</strong></div>
        </div>
    </a>     
</div>