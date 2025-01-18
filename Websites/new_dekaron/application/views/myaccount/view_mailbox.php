<?php $this->load->view('inc/view_header.php'); ?>
<aside id="right">
    <div id="content_ajax">
        <article class="subpage">
            <h1 class="top sub-header"><p>Mailbox</p></h1>
            <section class="body">
            	<form method="post" accept-charset="utf-8"  >
                    <section class="filter_field">
                        <label for="sort_by">Character Name</label>
                        <select style="width:450px" onchange="location.href=this.options[this.selectedIndex].value;"  id="sort_by" name="sort_by">
                            <?php
                            
                                if($this->uri->segment(4) == '')
                                {
                                    echo '<option value="" selected="selected">Select Character ...</option>';
                                }
                                else
                                {
                                    echo '<option value="">Select Character ...</option>';
                                }							
                            
                                $ListCharacters = $template['ListCharacters'];
                                foreach($ListCharacters as $character)
                                {					
                                    if($this->uri->segment(4) == $character['character_no'])
                                    {
                                        echo '<option value="'.site_url().'/myaccount/mailbox/view/'.$character['character_no'].'" selected="selected">'.$character['character_name'].'</option>';
                                    }
                                    else
                                    {
                                        echo '<option value="'.site_url().'/myaccount/mailbox/view/'.$character['character_no'].'">'.$character['character_name'].'</option>';
                                    }
                                }                        
                            ?>
                        </select>
                    </section> 
                </form> 
                <?php if($template['display'] === TRUE) { ?>
                <table width="100%" style="margin-top: 20px;">
                  <thead>
                    <tr>
                      <th align="left">From</th>
                      <th align="left">Title</th>
                      <th align="right">Recieved Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $mailbox_items = $template['viewall'];
                        if($mailbox_items)
                        {
                            foreach($mailbox_items as $item)
                            {
                                ?>
                                <tr>
                                    <td align="left"><?php echo $item['from_char_nm']; ?></td>
                                    <td align="left"><?php echo $item['post_title']; ?></td>
                                    <td align="right"><?php echo $item['ipt_time']; ?></td>
                                </tr>					
                                <?php
                            }					
                        }
                    ?>
                  </tbody>
                </table>
                <?php } ?>           
            </section>
        </article>
    </div>
</aside>
<?php $this->load->view('inc/view_footer.php'); ?>      