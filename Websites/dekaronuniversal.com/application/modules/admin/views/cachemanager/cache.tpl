<script type="text/javascript">
	$(document).ready(function(){
		function checkIfLoaded(){
			if(typeof Cache != "undefined"){
				Cache.load();
			}else{
				setTimeout(checkIfLoaded, 50);
			}
		}
		checkIfLoaded();
	});
</script>
<p>You can manually clear cache to force database a reload of certain data. To minimize the server load, we recommended you to keep item cache intact no matter how big it becomes.</p>
<div id="cache_data"><span class="loader-01"></span> Loading, please wait</div>
{if hasPermission("emptyCache")}
    <p>
        <a class="btn btn-danger" href="javascript:void(0)" onClick="Cache.clear('website')">Clear website cache</a>&nbsp;
        <a class="btn btn-danger" href="javascript:void(0)" onClick="Cache.clear('template')">Clear Template cache</a>&nbsp;
        <a class="btn btn-danger" href="javascript:void(0)" onClick="Cache.clear('all')">Clear cache</a>
    </p>
{/if}
