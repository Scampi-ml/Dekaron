<div class="block block-themed themed-default">
    <div class="block-title"><h4>Create Download</h4></div>
    <div class="block-content full">
        <form onSubmit="Downloads.create(); return false" id="submit_form" class="form-horizontal">
            <div class="form-group">
                <label for="name" class="control-label col-md-2">Title</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="My Download Name" />
                </div>
            </div>        
             <div class="form-group">
                <label for="name" class="control-label col-md-2">Link</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="link" id="link" placeholder="http://" />
                    <span class="help-block">External links must begin with http://</span>
                </div>
            </div>         
            <div class="form-group form-actions">
                <div class="col-md-10 col-md-offset-2">
                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save Download</button>
                </div>
            </div>
        </form>
    </div>
</div>