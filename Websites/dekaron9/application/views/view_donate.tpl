{include file="inc/view_header.tpl"}
<aside id="right">
    <article class="subpage">
        <h1 class="top sub-header"><p>Donate</p></h1>
        <section class="body">
        	<h2>Paypal</h2>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="3MRMUPK37JFN6">
                    <input type="hidden" name="currency_code" value="USD">
                    
                    
                    <table style="width:100%" cellspacing="10">
                        <tr>
                            <td><input type="hidden" name="on0" value="Amount">Amount</td>
                            <td>
                                <select name="os0" style="width: 300px;">
                                    <option value="10,000">10,000 Coins - $10.00 USD</option>
                                    <option value="33,000 Coins (3,000 Bonus!)">33,000 Coins (3,000 Bonus) - $30.00 USD</option>
                                    <option value="65,000 Coins (5,000 Bonus!)">65,000 Coins (5,000 Bonus) - $60.00 USD</option>
                                    <option value="110,000 Coins (10,000 Bonus!)">110,000 Coins (10,000 Bonus) - $100.00 USD</option>
                                </select>
                            </td>
                        </tr>                       
                        <tr>
                            <td><input type="hidden" name="on1" value="Character Name">Character Name</td>
                            <td><input type="text" name="custom" maxlength="200"></td>
                        </tr>
                    </table>
                    <center style="margin-bottom:10px;">
                        <input type="submit" name="submit" value="Buy Now!" alt="PayPal - The safer, easier way to pay online!" />
                    </center>                    
                </form>  
        </section>
    </article>
</aside> 
{include file="inc/view_footer.tpl"}