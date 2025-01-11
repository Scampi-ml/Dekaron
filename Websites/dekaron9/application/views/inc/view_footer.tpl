            	<div class="clear"></div>
            </div>            
            <footer>
                <div class="left-side">
                    <p>All righs reserved &copy; <a href="http://www.janvier123.be">Janvier123.be</a> <br/></p>
                    <!--
                    <div class="site-credits"> 
                        <a href="#" rel="nofollow" target="_blank" ></a>
                	</div>
                    -->
                </div>
                <div class="right-side">
                    <ul>
                        <li><a href="#">Footer Link 1</a></li>
                        <li><a href="#">Footer Link 2</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Footer Link 3</a></li>
                        <li><a href="#">Footer Link 4</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Footer Link 5</a></li>
                        <li><a href="#">Footer Link 6</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Footer Link 7</a></li>
                        <li><a href="#">Footer Link 8</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Footer Link 9</a></li>
                        <li><a href="#">Footer Link 10</a></li>
                    </ul>                                                                                                   
                </div>
            </footer>
        </section>
    </body>
    <script type="text/javascript" src="{$BASE_URL}assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="{$BASE_URL}assets/js/ui.js"></script>
    <script type="text/javascript" src="{$BASE_URL}assets/js/main.js"></script>          

    {if isset($push_js)} 
        {foreach from=$push_js item=foo}
             <script type="text/javascript" src="{$BASE_URL}assets/js/{$foo}"></script>
        {/foreach}  
    {/if}      
</html>
