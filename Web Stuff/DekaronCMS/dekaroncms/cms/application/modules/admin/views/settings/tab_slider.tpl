<form onSubmit="Settings.saveSlider(this); return false" class="form-horizontal">
    <div class="form-group">
        <label for="name" class="control-label col-md-2">Slider Status</label>
        <div class="col-md-10">
            <select name="slider" id="slider" size="1" class="form-control">
                <option value="true" {if $slider == 'true'}selected='selected'{/if}>Enabled</option>
                <option value="false" {if $slider == 'false'}selected='selected'{/if}>Disabled</option>
            </select>
            <span class="help-block"><i>Displays an image slider</i></span>
        </div>
    </div>  
    <div class="form-group">
        <label for="name" class="control-label col-md-2">Visibility</label>
        <div class="col-md-10">
            <select name="slider_home" id="slider_home" size="1" class="form-control">
                <option value="home" {if $slider_home == 'home'}selected{/if}>Only on homepage</option>
                <option value="always" {if $slider_home == 'always'}selected{/if}>Always</option>
            </select>                   
        </div>
    </div>          
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Slider interval (in miliseconds)</label>
        <div class="col-md-10">         
            <input type="text" name="slider_interval" class="form-control" id="slider_interval" value="{$slider_interval}"/>
            <span class="help-block">How long each slide will show | Numbers only!</span>
        </div>
    </div> 
    <div class="form-group">
        <label for="slider_style" class="control-label col-md-2">Slider transition style</label>
        <div class="col-md-10">
            <select name="slider_style" id="slider_style" class="form-control">
                <option value="sliceDown"           {if $slider_style == "sliceDown"}selected{/if}          >sliceDown</option>
                <option value="sliceDownLeft"       {if $slider_style == "sliceDownLeft"}selected{/if}      >sliceDownLeft</option>
                <option value="sliceUp"             {if $slider_style == "sliceUp"}selected{/if}            >sliceUp</option>
                <option value="sliceUpLeft"         {if $slider_style == "sliceUpLeft"}selected{/if}        >sliceUpLeft</option>
                <option value="sliceUpDown"         {if $slider_style == "sliceUpDown"}selected{/if}        >sliceUpDown</option>
                <option value="sliceUpDownLeft"     {if $slider_style == "sliceUpDownLeft"}selected{/if}    >sliceUpDownLeft</option>
                <option value="fold"                {if $slider_style == "fold"}selected{/if}               >fold</option>
                <option value="fade"                {if $slider_style == "fade"}selected{/if}               >fade (Recommended)</option>
                <option value="random"              {if $slider_style == "random"}selected{/if}             >random</option>
                <option value="slideInRight"        {if $slider_style == "slideInRight"}selected{/if}       >slideInRight</option>
                <option value="slideInLeft"         {if $slider_style == "slideInLeft"}selected{/if}        >slideInLeft</option>
                <option value="boxRandom"           {if $slider_style == "boxRandom"}selected{/if}          >boxRandom</option>
                <option value="boxRain"             {if $slider_style == "boxRain"}selected{/if}            >boxRain</option>
                <option value="boxRainReverse"      {if $slider_style == "boxRainReverse"}selected{/if}     >boxRainReverse</option>
                <option value="boxRainGrow"         {if $slider_style == "boxRainGrow"}selected{/if}        >boxRainGrow</option>
                <option value="boxRainGrowReverse"  {if $slider_style == "boxRainGrowReverse"}selected{/if} >boxRainGrowReverse</option>
            </select>               
        </div>
    </div>  
    <div class="form-group form-actions">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save Settings</button>
        </div>
    </div>              
</form>