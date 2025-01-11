<div class="alert alert-warning">
    <i class="fa fa-exclamation-triangle"></i> 
    You can manually clear cache to force database a reload of certain data. To minimize the server load, we recommended you to keep item cache intact no matter how big it becomes.
</div>
<table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <th>Cache Name</th>
            <th>Files</th>
            <th>Size</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="20%">Template</td>
            <td width="20%" id="row_template">{$template.files}</td>
            <td id="row_template_size">{$template.sizeString}</td>
        </tr>
        <tr>
            <td width="20%">Characters</td>
            <td width="20%" id="">N/A</td>
            <td id="">N/A</td>
        </tr>  
        <tr>
            <td width="20%">Nicknames</td>
            <td width="20%" id="">N/A</td>
            <td id="">N/A</td>
        </tr> 
        <tr>
            <td width="20%">Searches</td>
            <td width="20%" id="">N/A</td>
            <td id="">N/A</td>
        </tr>         
        <tr>
            <td width="20%">&nbsp;</td>
            <td width="20%">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>        
        <tr>
            <td width="20%"><strong>Total</strong></td>
            <td width="20%" id="row_total"><strong>{$total.files}</strong></td>
            <td id="row_total_size"><strong>{$total.size}</strong></td>
        </tr>                                                                
    </tbody>
</table>
<p>
    <a class="btn btn-danger" href="javascript:void(0)" onClick="Settings.clearCache('template')">Clear Template cache</a>
</p>

