 <div class="clearfix">
    <a class="btn btn-sm btn-success" href="{$url}admin/news/create"><i class="fa fa-pencil"></i> Create article</a>
</div>
<div class="block-selection">
	{if $news}
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Headline</th>
                <th>Author</th>
                <th>Posted on</th>
                <th></th>
            </tr>
        </thead>        
        <tbody>          
        {foreach from=$news item=article}
        	<tr>
                <td>{$article.headline}</td>
                <td>{$article.nickname}</td>
                <td>{date("Y/m/d H:i:s", $article.timestamp)}</td>
                <td class="text-right">
                    <div class="btn-group">
                    	<a class="btn btn-sm btn-success" href="{$url}admin/news/edit/{$article.id}">Edit</a>
                        &nbsp;
                    	<a class="btn btn-sm btn-danger" onClick="News.remove({$article.id}, this)">Delete</a>
                    </div>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>        
	{/if}
</div>
