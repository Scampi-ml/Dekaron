{include file="inc/view_header.tpl"}
<aside id="right">
    <article class="subpage">
        <h1 class="top sub-header"><p>STEP 3: Select</p></h1>
        <section class="body">
        		{if isset($donate_for)}<div class="boxinfo">You will donate for: <b>{$donate_for}</b> using <b>{$donate_option}</b></div>{/if}
                 <form action="https://www.paypal.com/cgi-bin/webscr" id="paypal-form" method="post" class="page_form">
                	<br />
                	<center>
                        <input type="hidden" value="_s-xclick" 					name="cmd">
                        <input type="hidden" value="PFULPKHT2Q44J" 				name="hosted_button_id">
                        <input type="hidden" value="D-Shop Coins" 				name="on0">
                        <input type="hidden" value="Enter Your Character Name"	name="on1">
                        <input type="hidden" value="{$custom}" 					name="os1" maxlength="200" >
                        <input type="hidden" value="USD" 						name="currency_code">
                    	<input type="hidden" value="{$SITE_URL}"				name="return"/>
                        
                        <select style="width:300px;"  id="sort_by" name="os0">
                            <option value="10,500 D-Shop Coins">10,500 D-Shop Coins $10.00 USD</option>
                            <option value="22,000 D-Shop Coins">22,000 D-Shop Coins $20.00 USD</option>
                            <option value="34,500 D-Shop Coins">34,500 D-Shop Coins $30.00 USD</option>
                            <option value="48,000 D-Shop Coins">48,000 D-Shop Coins $40.00 USD</option>
                            <option value="62,500 D-Shop Coins">62,500 D-Shop Coins $50.00 USD</option>
                            <option value="130,000 D-Shop Coins">130,000 D-Shop Coins $100.00 USD</option>
                            <option value="275,000 D-Shop Coins">275,000 D-Shop Coins $200.00 USD</option>
                            <option value="415,000 D-Shop Coins">415,000 D-Shop Coins $300.00 USD</option>
                            <option value="950,000 D-Shop Coins">950,000 D-Shop Coins $575.00 USD</option>
                        </select>
                    </center>
                    <br />
                    <center style="margin-bottom:10px;">
                        <input type="submit" name="submit" value="Donate with paypal..." />
                    </center>
				</form>                
        </section>
    </article>
</aside>
{include file="inc/view_footer.tpl"}


