        <div id="slider_box">
            <div id="home_main_cluster">
                <div class="main_cluster_content">
                    <div id="main_cluster_scroll" class="cluster_scroll_area" style="width: 9300px; left: 0px; ">
                            <a class="cluster_capsule" href="#">
                                <img class="cluster_capsule_image" id="1" src="img/slider/1.jpg" >
                                <div class="main_cap_desc">
                                    <div class="desc_overlay"></div>
                                    <div class="main_cap_content">
                                        <h1>Lorem ipsum</h1>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                                    </div>
                                </div>
                            </a>
                            <a class="cluster_capsule" href="#">
                                <img class="cluster_capsule_image" id="2" src="img/slider/2.jpg" >
                                <div class="main_cap_desc">
                                    <div class="desc_overlay"></div>
                                    <div class="main_cap_content">
                                        <h1>Lorem ipsum</h1>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                                    </div>
                                </div>
                            </a>
                            <a class="cluster_capsule" href="#">
                                <img class="cluster_capsule_image" id="3" src="img/slider/3.jpg" >
                                <div class="main_cap_desc">
                                    <div class="desc_overlay"></div>
                                    <div class="main_cap_content">
                                        <h1>Lorem ipsum</h1>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                                    </div>
                                </div>
                            </a>
                            <a class="cluster_capsule" href="#">
                                <img class="cluster_capsule_image" id="4" src="img/slider/4.jpg" >
                                <div class="main_cap_desc">
                                    <div class="desc_overlay"></div>
                                    <div class="main_cap_content">
                                        <h1>Lorem ipsum</h1>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                                    </div>
                                </div>
                            </a>
            
                        <div style="clear: left;"></div>
                        <script type="text/javascript">
                            var rgImageURLs = {
                                '1': 'img/slider/1.jpg',
                                '2': 'img/slider/2.jpg',
                                '3': 'img/slider/3.jpg',
                                '4': 'img/slider/4.jpg'
                            }
                        </script>
                    </div>
                    <div class="cluster_control_left" style="display: none; ">
                        <h5><img src="img/slider/arrow_blue_left.gif">&nbsp;&nbsp;Prev</h5>
                    </div>
                    <div class="cluster_control_right" style="display: none; ">
                        <h5>Next&nbsp;&nbsp;<img src="img/slider/arrow_blue_right.gif"></h5>
                    </div>
                </div>
                <div id="main_cluster_control_ctn">
                  <div class="slider" id="main_cluster_control">
                        <div class="img/slider/slider_bg"></div>
                        <div class="handle selected" style="left: 0px; "></div>
                    </div>
                </div>
                    <script type="text/javascript">
                        var ClusterHandler = new Cluster( {
                            cCapCount: 3, 
                            nCapWidth: 550 + 4,
                            elClusterArea: $('home_main_cluster'),
                            elSlider: $('main_cluster_control'),
                            rgImageURLs: rgImageURLs
                        } );
                    </script>
                </div>
            </div>
        </div>                     