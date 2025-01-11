{include file="inc/view_header.tpl"}
<aside id="right">
    <article class="subpage">
        <h1 class="top sub-header"><p>STEP 1: Character Name</p></h1>
        <section class="body">
            	{$form_open}
                {if isset($validation_errors)}<div class="boxerror">{$validation_errors}</div>{/if}   
                <table style="width:100%" cellspacing="10">
                    <tr>
                        <td width="30%"><label for="register_username">Character Name <span style="color:#FF0000">*</span></label></td>
                        <td width="70%">
                            <input required="required" placeholder="Enter Character Name" tabindex="1" type="text" name="charname" id="charname" value=""/>
                            <br />
                            &nbsp;&nbsp; Letters and numbers only. <span style="color:#FF0000;">This is case sensitive !!!</span>
                        </td>
                    </tr>
                </table>
                <center style="margin-bottom:10px;">
                    <input type="submit" name="submit" value="continue to step 2 ..." />
                </center>
            </form>
        </section>
    </article>
</aside>
{include file="inc/view_footer.tpl"}