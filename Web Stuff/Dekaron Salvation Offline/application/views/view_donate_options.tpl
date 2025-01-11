{include file="inc/view_header.tpl"}
<aside id="right">
    <div id="content_ajax">
        <article class="subpage">
            <h1 class="top sub-header"><p>STEP 2: Payment Option</p></h1>
            {if isset($donate_for)}<div class="boxinfo">You will donate for: <b>{$donate_for}</b></div>{/if}
            {$form_open2}
            {if isset($validation_errors)}<div class="boxerror">{$validation_errors}</div>{/if} 
            <br />              
                <article class="main_box">
                    <div class="main_box_body" >
                        <div class="avatar90"><img src="{$BASE_URL}assets/images/paypal.png"  ></div>
                            <br />
                            <h2><input type="radio" name="option" value="paypal" checked="checked"/>&nbsp;&nbsp; PayPal</a></h2>
                            <p>Donate with credits card or back account.</p>
                        <div class="clear"></div>
                    </div>
                </article>
                <br />
                <article class="main_box">
                    <div class="main_box_body" >
                        <div class="avatar90"><img src="{$BASE_URL}assets/images/paymentwall.png" ></div>
                            <br />
                            <h2><input type="radio" name="option" value="paymentwall"/>&nbsp;&nbsp; Paymentwall</a></h2>
                            <p>Currently over 95 payment options which include ewallets, credit cards, mobile and land-line payments, prepaid cards, payment kiosks, debit cards, bank transfers and more. </p>
                        <div class="clear"></div>
                    </div>
                </article>
                <center style="margin-bottom:10px;">
                    <input type="submit" name="submit" value="continue to step 3 ..." />
                </center>
            </form>
            <br />             
        </article>        
    </div>
</aside>      
{include file="inc/view_footer.tpl"}