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
            <td width="20%">Website</td>
            <td width="20%" id="row_item">{$website.files}</td>
            <td>{$website.sizeString}</td>
        </tr>
        <tr>
            <td width="20%">Template</td>
            <td width="20%" id="row_item">{$template.files}</td>
            <td>{$template.sizeString}</td>
        </tr>
        <tr>
            <td width="20%">&nbsp;</td>
            <td width="20%">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>        
        <tr>
            <td width="20%"><strong>Total</strong></td>
            <td width="20%" id="row_item"><strong>{$total.files}</strong></td>
            <td><strong>{$total.size}</strong></td>
        </tr>                                                                
    </tbody>
</table>




