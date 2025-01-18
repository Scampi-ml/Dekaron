<?php $this->load->view('inc/view_header.php'); ?>
<aside id="right">
    <div id="content_ajax">
        <article class="subpage">
        	<h1 class="top sub-header"><p>Vote panel</p></h1>
            <section class="body">
                <table id="vote" class="nice_table" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td width="30%">Topsite</td>
                            <td width="30%">Value</td>
                            <td width="40%">&nbsp;</td>
                        </tr>
                        
                        
                        
                        <tr>
                            <td><img src="<?php echo base_url('assets/images/vote'); ?>/<IMG>"></td>
                            <td><img src="<?php echo base_url('assets/images/icons/coins.png'); ?>">&nbsp;&nbsp;&nbsp;2 voting points</td>
                            <td id="vote_field_1"><input onClick="Vote.open(1, 12);" value="Vote now!" type="submit"></td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo base_url('assets/images/vote'); ?>/<IMG>"></td>
                            <td><img src="<?php echo base_url('assets/images/icons/coins.png'); ?>">&nbsp;&nbsp;&nbsp;1 voting point</td>
                            <td id="vote_field_2"><input onClick="Vote.open(2, 12);" value="Vote now!" type="submit"></td>
                        </tr>
					</tbody>
				</table>
            </section>
        </article>
    </div>
</aside>
<?php $this->load->view('inc/view_footer.php'); ?>      