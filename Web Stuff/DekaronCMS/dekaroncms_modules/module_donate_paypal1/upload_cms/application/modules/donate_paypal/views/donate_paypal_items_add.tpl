<div class="block block-themed themed-default">
    <div class="block-title"><h4>Add Item</h4></div>
    <div class="block-content full">
        <form onSubmit="Donate_paypal.add(); return false" id="submit_form" class="form-horizontal">
            <div class="form-group">
                <label for="name" class="control-label col-md-2">Price</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="price" id="price" placeholder="0" />
                </div>
            </div>  
            <div class="form-group">
                <label for="name" class="control-label col-md-2">Coins</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="coins" id="coins" placeholder="0" />
                    <span class="help-block">Numbers Only</span>
                </div>
            </div>  
            <div class="form-group form-actions">
                <div class="col-md-10 col-md-offset-2">
                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save Item</button>
                </div>
            </div>
        </form>
    </div>
</div>