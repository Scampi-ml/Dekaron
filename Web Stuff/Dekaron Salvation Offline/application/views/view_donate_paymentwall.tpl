{include file="inc/view_header.tpl"}
<aside id="right">
    <article class="subpage">
        <h1 class="top sub-header"><p>STEP 3: Select</p></h1>
        <section class="body">
                {if isset($donate_for)}<div class="boxinfo">You will donate for: <b>{$donate_for}</b> using <b>{$donate_option}</b></div>{/if}
                {if isset($validation_errors)}<div class="boxerror">{$validation_errors}</div>{/if} 
            	<iframe 
                	frameborder="0" 
                    height="600" 
                    scrolling="auto" 
                    src="https://api.paymentwall.com/api/subscription/?{$paymentwall_url}" 
                    allowtransparency="true" 
                    width="652"
				></iframe>       
                
                <!--<iframe src="https://api.paymentwall.com/api/subscription/?key=369fa9913ef007e6c7bf9f9752e71e50&uid=[USER_ID]&widget=p10_1" width="750" height="800" frameborder="0"></iframe>      -->   

        </section>
    </article>
</aside>
{include file="inc/view_footer.tpl"}