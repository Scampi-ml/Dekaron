<div class="block block-themed">
    <div class="block-title">
        <h4>Supported languages {if !$languages}0{else}{count($languages)}{/if}</h4>
    </div>
    <div class="block-content">
        {if $languages}
        	<table width="100%" class="table table-condensed">
            	{foreach from=$languages item=language key=flag}
                    <tr>
                        <td width="2%"><img src="{$url}application/images/flags/{$flag}.png" alt="{$flag}"></td>
                        <td width="9%">{ucfirst($language)}</td>
                        <td width="89%">
                            {if $language == $default}
                          <div style="color:green">Default language</div>
                            {elseif hasPermission("changeDefaultLanguage")}
                                <a class="btn btn-default" href="javascript:void(0)" onClick="Languages.set('{$language}')">Set as default</a>
                            {/if}                                        
                      </td>
              </tr>
            	{/foreach}
        	</table> 
        {/if}
    </div>
</div>
<div class="alert alert-info">
	<b>Want more?</b> Get more languages from the <a href="#" target="_blank">localization GitHub repository</a>
</div>        