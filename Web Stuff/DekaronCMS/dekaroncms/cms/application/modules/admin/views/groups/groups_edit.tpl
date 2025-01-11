<form onSubmit="Groups.save(this, {$group.id}); return false" id="submit_form" class="form-horizontal">
<button class="btn btn-success" type="submit" value="Save account"><i class="fa fa-check"></i> Save Group</button>
    <div class="block block-tabs block-themed">
        <ul data-toggle="tabs" class="nav nav-tabs">
            <li class="active"><a href="#menu">Menu</a></li>
            <li><a href="#pages">Pages</a></li>
            <li><a href="#sideboxes">Sideboxes</a></li>
            <li><a href="#roles">Roles</a></li>  
        </ul>
        <div class="tab-content">
            <div id="menu" class="tab-pane active">{include file='modules/admin/views/groups/tab_menu.tpl'}</div>
            <div id="pages" class="tab-pane">{include file='modules/admin/views/groups/tab_pages.tpl'}</div>
            <div id="sideboxes" class="tab-pane">{include file='modules/admin/views/groups/tab_sideboxes.tpl'}</div>
            <div id="roles" class="tab-pane">{include file='modules/admin/views/groups/tab_roles.tpl'}</div>
        </div>
    </div>  
</form> 