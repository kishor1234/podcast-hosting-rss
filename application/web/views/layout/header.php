<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Deliberate Talks</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="My Podcast template project">
        <base href="<?=base_url?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?=base_url?>/assets/website/styles/bootstrap-4.1.2/bootstrap.min.css">
        <link href="<?=base_url?>/assets/website/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url?>/assets/website/plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
        <script src="<?=base_url?>/assets/website/js/jquery-3.3.1.min.js"></script>
        <script src="<?=base_url?>/assets/plugins/jquerytoast/jquery.toaster.js" type="text/javascript"></script>
        <style>
            .audio-player{
                width: 100% !important;
                color: red;
            }
            .imag-resp{
                width:100%; height: auto;
            }
        </style>
    </head>
    <body>

        <div class="super_container">

            <!-- Header -->

            <header class="header trans_400">

                <!-- Logo -->
                <div class="logo">
                    <a href="/deliberatetalks"><img src="<?=base_url?>/assets/website/images/logo.png" alt=""></a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="header_content d-flex flex-row align-items-center justify-content-start trans_400">
                                <nav class="main_nav">
                                    <ul class="d-flex flex-row align-items-start justify-content-start">
                                        <!--<li><a href="/deliberatetalks">Home</a></li>
                                        <li><a href="/deliberatetalks/about/">About</a></li>
                                                                              <li><a href="episodes.html">Episodes</a></li>
                                                                                <li><a href="blog.html">Blog</a></li>-->
                                        <!--                                        <li><a href="contact.html">Contact</a></li>-->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit & Social -->
                <div class="header_right d-flex flex-row align-items-start justify-content-start">

                    <!-- Submit -->
                    <div class="submit"><a href="https://calendly.com/dakshinadyanthaya">Book An Appointment</a></div>

                    <!-- Social -->
                    <div class="social">
                        <ul class="d-flex flex-row align-items-start justify-content-start">
                            <li><a href="https://www.facebook.com/deliberatetalks"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.instagram.com/deliberatetalks/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
<!--                            <li><a href="#"><i class="fa fa-soundcloud" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.youtube.com/pixelatedegg"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>-->
                            <li><a href="/deliberatetalks/feed.xml"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>

                    <!-- Hamburger -->
                    <div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>

                </div>
            </header>

            <!-- Menu -->

            <div class="menu">
                <div class="menu_content d-flex flex-column align-items-end justify-content-start">
                    <ul class="menu_nav_list text-right">
                        <!--<li><a href="/deliberatetalks">Home</a></li>
                        <li><a href="/deliberatetalks/about/">About</a></li>
                                                <li><a href="episodes.html">Episodes</a></li>
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="contact.html">Contact</a></li>-->
                    </ul>
                    <div class="menu_extra d-flex flex-column align-items-end justify-content-start">
                        <div class="menu_submit"><a href="https://calendly.com/dakshinadyanthaya">Book An Appointment</a></div>
                        <div class="social">
                            <ul class="d-flex flex-row align-items-start justify-content-start">
                                <li><a href="https://www.facebook.com/deliberatetalks"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.instagram.com/deliberatetalks/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
<!--                                <li><a href="#"><i class="fa fa-soundcloud" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>-->
                                <li><a href="https://www.youtube.com/pixelatedegg"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                <li><a href="/deliberatetalks/feed.xml"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Home -->