<footer class="footer">
    <div class="container">
        <div class="row footer_logo_row">
            <div class="col d-flex flex-row align-items-center justify-content-center">
                <div class="logo">
                    <a href="#"><span>my</span>podcast<img src="/assets/website/images/play.png" alt=""></a>
                </div>
            </div>
        </div>
        <div class="row footer_content_row">

            <!-- Tags -->
            <div class="col-lg-4">
                <div class="footer_title">Tags</div>
                <div class="footer_list">
                    <div><div><a href="#">music</a></div></div>
                    <div><div><a href="#">art</a></div></div>
                    <div><div><a href="#">technology</a></div></div>
                    <div><div><a href="#">travel & food</a></div></div>
                    <div><div><a href="#">viral</a></div></div>
                    <div><div><a href="#">social media</a></div></div>
                    <div><div><a href="#">interview</a></div></div>
                    <div><div><a href="#">developement</a></div></div>
                    <div><div><a href="#">success</a></div></div>
                    <div><div><a href="#">live</a></div></div>
                    <div><div><a href="#">did you know?</a></div></div>
                    <div><div><a href="#">health</a></div></div>
                </div>
            </div>

            <!-- Latest Episodes -->
            <div class="col-lg-4">
                <div class="footer_title">Latest Episodes</div>
                <div class="latest_container">
                    <?php
                    $resp = json_decode($main->jsonRespon(api_url . "/?r=userData", array("action" => "lastPost", "limit" => 3)), true);
                    //print_r($response);
                    foreach ($resp as $key => $response) {
                        ?>
                        <!-- Latest -->
                        <div class="latest">
                            <div class="latest_title_container d-flex flex-row align-items-start justify-content-start">
                                <a href="/in/episode/<?= str_replace(" ", "-", $response["title"]); ?>">
                                    <div class="d-flex flex-row align-items-start justify-content-start">
                                        <div class="latest_play">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 714 714" style="enable-background:new 0 0 714 714;" xml:space="preserve">
                                            <g id="Play">
                                            <path d="M641.045,318.521L102,0C73.822,0,51,22.822,51,51v612c0,28.178,22.822,51,51,51l539.045-318.521      C654.661,387.422,663,372.81,663,357C663,341.19,654.661,326.579,641.045,318.521z M153,565.386V148.614L505.665,357      L153,565.386z" fill="#FFFFFF"/>
                                            </g>
                                            </svg>
                                        </div>
                                        <div class="latest_title_content">
                                            <div class="latest_title"><?= $response["title"] ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="latest_episode_info">
                                <ul class="d-flex flex-row align-items-start justify-content-start">
                                    <li><a href="#"><?= date("M d, Y", strtotime($response["onCreate"])) ?></a></li>
                                    <li><a href="#"><?= $response["categories"] ?></a></li>
                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                    ?>


                </div>
            </div>

            <!-- Gallery -->
            <div class="col-lg-4">
                <div class="footer_title">Instagram</div>
                <div class="gallery d-flex flex-row align-items-start justify-content-start flex-wrap">

                    <!-- Gallery Item -->
                    <div class="gallery_item">
                        <a class="colorbox" href="/assets/website/images/gallery_1_large.jpg"><img src="/assets/website/images/gallery_1.jpg" alt=""></a>
                    </div>

                    <!-- Gallery Item -->
                    <div class="gallery_item">
                        <a class="colorbox" href="/assets/website/images/gallery_2_large.jpg"><img src="/assets/website/images/gallery_2.jpg" alt=""></a>
                    </div>

                    <!-- Gallery Item -->
                    <div class="gallery_item">
                        <a class="colorbox" href="/assets/website/images/gallery_3_large.jpg"><img src="/assets/website/images/gallery_3.jpg" alt=""></a>
                    </div>

                    <!-- Gallery Item -->
                    <div class="gallery_item">
                        <a class="colorbox" href="/assets/website/images/gallery_4_large.jpg"><img src="/assets/website/images/gallery_4.jpg" alt=""></a>
                    </div>

                    <!-- Gallery Item -->
                    <div class="gallery_item">
                        <a class="colorbox" href="/assets/website/images/gallery_5_large.jpg"><img src="/assets/website/images/gallery_5.jpg" alt=""></a>
                    </div>

                </div>
            </div>
        </div>
        <div class="row footer_social_row">
            <div class="col">
                <div class="footer_social">
                    <ul class="d-flex flex-row align-items-center justify-content-center">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-soundcloud" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                        <li><a href="/in/feed/"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        </br></br>
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved  <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="http://aasksoft.com" target="_blank">@askSoft</a>

    </div>
</footer>
</div>


<script src="/assets/website/styles/bootstrap-4.1.2/popper.js"></script>
<script src="/assets/website/styles/bootstrap-4.1.2/bootstrap.min.js"></script>
<script src="/assets/website/plugins/greensock/TweenMax.min.js"></script>
<script src="/assets/website/plugins/greensock/TimelineMax.min.js"></script>
<script src="/assets/website/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="/assets/website/plugins/greensock/animation.gsap.min.js"></script>
<script src="/assets/website/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="/assets/website/plugins/easing/easing.js"></script>
<script src="/assets/website/plugins/colorbox/jquery.colorbox-min.js"></script>
<script src="/assets/website/plugins/progressbar/progressbar.min.js"></script>
<script src="/assets/website/plugins/parallax-js-master/parallax.min.js"></script>
<script src="/assets/website/js/custom.js"></script>
</body>
</html>