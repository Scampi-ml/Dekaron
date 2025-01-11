<div class="block block-themed">
    <div class="block-title">
    	<h4>Search</h4>
    </div>
    <div class="block-content">
        <form onSubmit="Accounts.searchAccount(); return false;" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-2">Search by username</label>
                <div class="col-md-9 ">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search_accounts" id="search_accounts" >
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" value="Search" >Search</button>
                        </span>                        
                    </div>
                </div>
            </div>    
        </form>    
        <div id="form_accounts_search">
            <!-- results -->
        </div>
    </div>
</div>        