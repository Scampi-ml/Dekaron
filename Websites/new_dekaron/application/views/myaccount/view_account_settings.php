<?php $this->load->view('inc/view_header.php'); ?>
<aside id="right">
    <div id="content_ajax">
        <article class="subpage">
            <h1 class="top sub-header"><p>Account Settings</p></h1>
            <section class="body">
				<?php echo form_open('myaccount/account_settings/save'); ?>
                
                
                    <section class="">
                        <label for="sort_by">
                            <select style="width:50px; margin-left:50px;"  id="sort_by" name="character">
                                <option value="">Yes</option>
                                <option value="">No</option>
                            </select>
                        </label>Allow Private Messages?
                    </section> 
                    <section class="">
                        <label for="sort_by">
                            <select style="width:50px; margin-left:50px;"  id="sort_by" name="character">
                                <option value="">Yes</option>
                                <option value="">No</option>
                            </select>
                        </label>
                        Character Name &  refgreg
                    </section>    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                                     
                    <br />
                    <center><input type="submit" class="nice_button" name="submit" value="Save Settings!" /></center>            
                <?php echo form_close(); ?>   
            </section>
        </article>
    </div>
</aside>
<?php $this->load->view('inc/view_footer.php'); ?>      