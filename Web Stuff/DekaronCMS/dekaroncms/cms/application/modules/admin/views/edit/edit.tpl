{foreach from=$configs item=config key=title}
    <div class="block block-themed themed-default">
        <div class="block-title"><h4>/config/{$title}.php</h4></div>
        <div class="block-content full">
            {if array_key_exists('force_code_editor', $config) && $config['force_code_editor']}
                <form onSubmit="Settings.submitConfigSource('{$moduleName}', '{$title}');return false" id="advanced_{$title}" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-12">
                            <textarea rows="30" class="form-control" name="source_{$title}" id="source_{$title}">{$config.source}</textarea>
                        </div>
                    </div>                
                    <div class="form-group form-actions">
                        <div class="col-md-10 col-md-offset-2">
                            <button class="btn btn-success" type="submit">Save config</button>
                        </div>
                    </div>                
                </form>
            {else}
                <h4 class="sub-header">
                	<a class="btn btn-default" href="javascript:void(0)" onClick="Settings.toggleSource('{$title}', this)">Edit source code (advanced)</a>
                </h4>
                <form onSubmit="Settings.submitConfigSource('{$moduleName}', '{$title}');return false" id="advanced_{$title}" class="form-horizontal" style="display:none;">
                    <div class="form-group">    
                        <div class="col-md-2">
                            <textarea rows="30" class="form-control" name="source_{$title}" id="source_{$title}">{$config.source}</textarea>
                        </div>
                    </div>                
                    <div class="form-group form-actions">
                        <div class="col-md-10 col-md-offset-2">
                            <button class="btn btn-success" type="submit">Save config</button>
                        </div>
                    </div>                   
                </form>
                <form onSubmit="Settings.submitConfig(this, '{$moduleName}', '{$title}');return false" id="gui_{$title}" class="form-horizontal">
                    {foreach from=$config item=option key=label}
                        {if $label != "source"}
                            {if is_array($option) && ctype_digit(implode('', array_keys($option)))}
                                <div class="form-group">
                                    <label for="{$label}" class="control-label col-md-2">{ucfirst(preg_replace("/_/", " ", $label))}</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" value="{foreach from=$option item=value}{$value},{/foreach}" id="{$label}" name="{$label}" >
                                    </div>
                                </div>                   
                            {elseif is_array($option)}	
                                <label for="{$label}"><b>{ucfirst(preg_replace("/_/", " ", $label))}</b></label>
                                {foreach from=$option item=sub_option key=sub_label}		
                                    {if is_array($sub_option) && ctype_digit(implode('', array_keys($sub_option)))}
                                        <div class="form-group">
                                            <label for="{$label}-{$sub_label}" class="control-label col-md-2">{ucfirst(preg_replace("/_/", " ", $sub_label))}</label>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" value="{foreach from=$sub_option item=value}{$value},{/foreach}" id="{$label}-{$sub_label}" name="{$label}-{$sub_label}" >
                                            </div>
                                        </div>                                
                                    {elseif is_array($sub_option)}
                                        <label for="{$label}-{$sub_label}"><b>{ucfirst(preg_replace("/_/", " ", $sub_label))}</b></label>
                                        test
                                    {elseif $sub_option === true}
                                        <div class="form-group">
                                            <label for="{$label}-{$sub_label}" class="control-label col-md-2">{ucfirst(preg_replace("/_/", " ", $sub_label))}</label>
                                            <div class="col-md-3">
                                                <select size="1" class="form-control" id="{$label}-{$sub_label}" name="{$label}-{$sub_label}">
                                                    <option selected value="true">Yes</option>
                                                    <option value="false">No</option>
                                                </select>
                                            </div>
                                        </div>                                    
                                    {elseif $sub_option === false}
                                        <div class="form-group">
                                            <label for="{$label}-{$sub_label}" class="control-label col-md-2">{ucfirst(preg_replace("/_/", " ", $sub_label))}</label>
                                            <div class="col-md-3">
                                                <select size="1" class="form-control" id="{$label}-{$sub_label}" name="{$label}-{$sub_label}">
                                                    <option value="true">Yes</option>
                                                    <option selected value="false">No</option>
                                                </select>
                                            </div>
                                        </div>                                      
                                    {else}
                                        <div class="form-group">
                                            <label for="{$label}-{$sub_label}" class="control-label col-md-2">{ucfirst(preg_replace("/_/", " ", $sub_label))}</label>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" value="{$sub_option}" id="{$label}-{$sub_label}" name="{$label}-{$sub_label}" >
                                            </div>
                                        </div>                                     
                                    {/if}
                                {/foreach}
                            {elseif $option === true}
                                <div class="form-group">
                                    <label for="{$label}" class="control-label col-md-2">{ucfirst(preg_replace("/_/", " ", $label))}</label>
                                    <div class="col-md-3">
                                        <select size="1" class="form-control" id="{$label}" name="{$label}">
                                            <option selected value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                </div>  
                            {elseif $option === false}
                                <div class="form-group">
                                    <label for="{$label}" class="control-label col-md-2">{ucfirst(preg_replace("/_/", " ", $label))}</label>
                                    <div class="col-md-3">
                                        <select size="1" class="form-control" id="{$label}" name="{$label}">
                                            <option value="true">Yes</option>
                                            <option selected value="false">No</option>
                                        </select>
                                    </div>
                                </div>                             
                            {else}
                                <div class="form-group">
                                    <label for="{$label}" class="control-label col-md-2">{ucfirst(preg_replace("/_/", " ", $label))}</label>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" value="{$option}" id="{$label}" name="{$label}" >
                                    </div>
                                </div>                         
                            {/if}
                        {/if}
                    {/foreach}
                    <input type="hidden" name="dzda" value="ezf">
                    <div class="form-group form-actions">
                        <div class="col-md-10 col-md-offset-2">
                            <button class="btn btn-success" type="submit">Save config</button>
                        </div>
                    </div>                      
                </form>
            {/if}
        </div>
    </div>
{/foreach}