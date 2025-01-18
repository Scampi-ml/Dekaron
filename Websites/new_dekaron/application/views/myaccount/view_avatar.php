<?php $this->load->view('inc/view_header.php'); ?>
<aside id="right">
    <div id="content_ajax">
        <article class="subpage">
            <h1 class="top sub-header"><p>Change avatar</p></h1>
            <section class="body">
                <section id="avatar_page">
                    <h2>We make use of <a href="http://gravatar.com/" target="_blank">Gravatar</a> which provides an easy way to maintain your avatars across the web.</h2>
                    <br>
                    <h3>To change your avatar you need to <a href="http://gravatar.com/site/signup/" target="_blank">sign up for</a> or <a href="http://gravatar.com/site/login/" target="_blank">log into</a> Gravatar using the following email:</h3>
                    <br />
                    <center>
                        <h2><?php echo $this->session->userdata('email'); ?></h2>
                    </center>
                </section>
            </section>
        </article>
    </div>      
</aside>
<?php $this->load->view('inc/view_footer.php'); ?>      