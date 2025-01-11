<div class="block block-tabs block-themed">
    <ul data-toggle="tabs" class="nav nav-tabs">
        <li class="active"><a href="#website">Website</a></li>
        <li><a href="#theme">Theme</a></li>
        <li><a href="#email">Email</a></li>
        <li><a href="#cache">Cache</a></li>
        <li><a href="#api">API</a></li>
        <li><a href="#mssql">SQL Server</a></li>
        <li><a href="#login">Admin Login</a></li>
        <li><a href="#slider">Slider</a></li>
    </ul>
    <div class="tab-content">
        <div id="website" class="tab-pane active">{include file='modules/admin/views/settings/tab_website.tpl'}</div>
        <div id="theme" class="tab-pane">{include file='modules/admin/views/settings/tab_theme.tpl'}</div>
        <div id="email" class="tab-pane">{include file='modules/admin/views/settings/tab_email.tpl'}</div>
        <div id="cache" class="tab-pane">{include file='modules/admin/views/settings/tab_cache.tpl'}</div>
        <div id="api" class="tab-pane">{include file='modules/admin/views/settings/tab_api.tpl'}</div>
        <div id="mssql" class="tab-pane">{include file='modules/admin/views/settings/tab_mssql.tpl'}</div>
        <div id="login" class="tab-pane">{include file='modules/admin/views/settings/tab_login.tpl'}</div>
        <div id="slider" class="tab-pane">{include file='modules/admin/views/settings/tab_slider.tpl'}</div>
    </div>
</div>