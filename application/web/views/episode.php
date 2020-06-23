<!-- Home -->
<link rel="stylesheet" type="text/css" href="<?=base_url?>/assets/website/styles/episode.css">
<link rel="stylesheet" type="text/css" href="<?=base_url?>/assets/westyles/episode_responsive.css">
<div class="home">
    <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="<?= $banner_url ?>" data-speed="0.8"></div>
    <div class="home_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content text-center">
                        <div class="home_title"><h1><?= $title ?></h1></div>
                        <div class="home_subtitle text-center"><?= date("M d, Y", strtotime($onCreate)) ?></div>
                    </div>
                </div>
            </div>
        </div>		
    </div>
    <div class="home_player_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-3">

                    <!-- Episode -->
                    <div class="player d-flex flex-row align-items-start justify-content-start s1">
                        <div class="player_content">

                            <audio controls class="audio-player">
                                <source src="<?= $file_url ?>" type="<?= $file_type ?>">

                                Your browser does not support the audio element.
                            </audio>

                            <div class="show_info d-flex flex-row align-items-start justify-content-start">
                                <div class="show_fav d-flex flex-row align-items-center justify-content-start">
                                    <div class="show_fav_icon show_info_icon"><img class="svg" src="<?=base_url?>/assets/website/images/heart.svg" alt=""></div>
                                    <div class="show_fav_count"><?= $likes ?></div>
                                </div>
                                <div class="show_comments">
                                    <a href="#">
                                        <div class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="show_comments_icon show_info_icon"><img class="svg" src="<?=base_url?>/assets/website/images/speech-bubble.svg" alt=""></div>
                                            <div class="show_comments_count"><?= $comments ?> Comments</div>
                                        </div>
                                    </a>	
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Episode -->

<div class="episode_container">

    <!-- Episode Image -->
    <div class="episode_image_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Episode Image -->
                    <div class="episode_image"><img src="<?=$image_url?>" alt=""></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-lg-3 order-lg-1 order-2 sidebar_col">
                <div class="sidebar">

                    <!-- Categories -->
                    <div class="sidebar_list">
                        <div class="sidebar_title">Categories</div>
                        <ul>
                            <li><a href="#">Travel</a></li>
                            <li><a href="#">Music</a></li>
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">Social Media</a></li>
                            <li><a href="#">Art</a></li>
                            <li><a href="#">Audiobooks</a></li>
                            <li><a href="#">Documentaries</a></li>
                        </ul>
                    </div>

                    <!-- Tags -->
                    <div class="sidebar_tags">
                        <div class="sidebar_title">Tags</div>
                        <div class="tags">
                            <ul class="d-flex flex-row align-items-start justify-content-start flex-wrap">
                                <li><a href="#">music</a></li>
                                <li><a href="#">art</a></li>
                                <li><a href="#">technology</a></li>
                                <li><a href="#">travel & food</a></li>
                                <li><a href="#">viral</a></li>
                                <li><a href="#">interview</a></li>
                                <li><a href="#">social media</a></li>
                                <li><a href="#">development</a></li>
                                <li><a href="#">success</a></li>
                                <li><a href="#">did you know?</a></li>
                                <li><a href="#">live</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Archive -->
                    <div class="sidebar_archive">
                        <div class="sidebar_title">Archive</div>
                        <div class="dropdown">
                            <ul>
                                <li class="dropdown_selected d-flex flex-row align-items-center justify-content-start"><span>September 2018</span><i class="fa fa-chevron-down ml-auto" aria-hidden="true"></i>
                                    <ul>
                                        <li><a href="#">August 2018</a></li>
                                        <li><a href="#">July 2018</a></li>
                                        <li><a href="#">June 2018</a></li>
                                        <li><a href="#">May 2018</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Episode -->
            <div class="col-lg-9 episode_col order-lg-2 order-1">
                <div class="intro">
                    <div class="section_title"><?=$title?></div>
                    <div class="intro_text">
                        <p><?=$description?></p>
                    </div>
                </div>
<!--                <div class="guests">
                    <div class="section_title">Guests</div>
                    <div class="guests_container d-flex flex-md-row flex-column align-items-md-start align-items-center justify-content-start">

                         Guest 
                        <div class="guest_container">
                            <div class="guest">
                                <div class="guest_image"><img src="images/guest_1.jpg" alt="https://unsplash.com/@stairhopper"></div>
                                <div class="guest_content text-center">
                                    <div class="guest_name"><a href="#">Michael Smith</a></div>
                                    <div class="guest_title">Developer</div>
                                </div>
                            </div>
                        </div>

                         Guest 
                        <div class="guest_container">
                            <div class="guest">
                                <div class="guest_image"><img src="images/guest_2.jpg" alt="https://unsplash.com/@eyeforebony"></div>
                                <div class="guest_content text-center">
                                    <div class="guest_name"><a href="#">Samantha Doe</a></div>
                                    <div class="guest_title">Developer</div>
                                </div>
                            </div>
                        </div>

                         Guest 
                        <div class="guest_container">
                            <div class="guest">
                                <div class="guest_image"><img src="images/guest_3.jpg" alt="https://unsplash.com/@onurozkardes"></div>
                                <div class="guest_content text-center">
                                    <div class="guest_name"><a href="#">James Williams</a></div>
                                    <div class="guest_title">Developer</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>-->

                <!-- Comments -->
                <div class="comments">
                    <div class="section_title">Comments</div>
                    <div class="comments_container">
<!--                        <ul>

                             Comment 
                            <li class="d-flex flex-row">
                                <div>
                                    <div class="comment_image"><img src="images/user_1.jpg" alt=""></div>
                                </div>
                                <div class="comment_content">
                                    <div class="user_name"><a href="#">Michael Smith</a></div>
                                    <div class="comment_text">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec bibendum malesuada tellus a pretium. Proin quam nisi, maximus in pulvinar sed, viverra vitae es.</p>
                                    </div>
                                </div>
                            </li>

                             Comment 
                            <li class="d-flex flex-row">
                                <div>
                                    <div class="comment_image"><img src="images/user_2.jpg" alt=""></div>
                                </div>
                                <div class="comment_content">
                                    <div class="user_name"><a href="#">Christinne Doe</a></div>
                                    <div class="comment_text">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec bibendum malesuada tellus a pretium. Proin quam nisi, maximus in pulvinar sed, viverra vitae es.</p>
                                    </div>
                                </div>
                            </li>

                        </ul>-->
                    </div>
                </div>

                <!-- Leave a Comment -->
                <div class="comment_form_container">
                    <div class="section_title">Leave a comment</div>
                    <form action="#" id="comment_form" class="comment_form">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="comment_input" placeholder="Name" required="required">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="comment_input" placeholder="E-mail" required="required">
                            </div>
                        </div>
                        <div><input type="text" class="comment_input" placeholder="Subject"></div>
                        <div><textarea class="comment_input comment_textarea" placeholder="Message" required="required"></textarea></div>
                        <button class="comment_button button_fill">send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
