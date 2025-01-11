{TinyMCE()}
<div class="block block-themed">
    <div class="block-title">
        <div class="block-options">
            {if hasPermission("canAddArticle")}
                <a class="btn btn-option enable-tooltip" href="javascript:void(0)" data-original-title="Create article"  onClick="News.show()"><i class="fa fa-plus"></i></a>
            {/if}                
        </div>
        <h4>Articles ({if !$news}0{else}{count($news)}{/if})</h4>
    </div>
    <div class="block-content">
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
                            {if hasPermission("canEditArticle")}
                            	<a class="btn btn-sm btn-success" href="{$url}news/admin/edit/{$article.id}">Edit</a>
                            {/if}
                            &nbsp;
                            {if hasPermission("canRemoveArticle")}
                            	<a class="btn btn-sm btn-danger" onClick="News.remove({$article.id}, this)">Delete</a>
                            {/if}
                        </div>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>        
		{/if}
    </div>
</div>

<div id="add_news" style="display:none;">
	<section class="box big">
		<h2><a href='javascript:void(0)' onClick="News.show()" data-tip="Return to articles">Articles</a> &rarr; New article</h2>

		<form onSubmit="News.send(); return false">
			<label for="headline">Headline</label>
			<input type="hidden" id="headline" />
			
			<label for="news_content">
				Content
			</label>
		</form>
			<div style="padding:10px;">
				<textarea name="news_content" class="tinymce" id="news_content" cols="30" rows="10"></textarea>
			</div>
		<form onSubmit="News.send(); return false">
			<input type="submit" value="Submit article" />
		</form>
	</section>
</div>