<!-- Home -->
<link rel="stylesheet" type="text/css" href="<?= base_url ?>/assets/website/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="<?= base_url ?>/assets/website/styles/responsive.css">

<?php
$resp = json_decode($main->jsonRespon(api_url . "/?r=userData", array("action" => "lastPost", "limit" => 1)), true);
//print_r($response);
$response = $resp[0];
?>
<div class="home">
    <div class="background_image" style="background:url('<?= $response["banner_url"] ?>')  no-repeat center fixed; background-size: cover;"></div>
    <div class="home_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content">
                        <div class="tags">
                            <ul class="d-flex flex-row align-items-start justify-content-start">
                                <?php
                                $tags = explode(",", $response["tags"]);
                                for ($i = 0; $i < count($tags); $i++) {
                                    echo "<li><a href='#'>{$tags[$i]}</a></li>";
                                }
                                ?>
                                <!--                                <li><a href="#">lifestyle</a></li>
                                                                <li><a href="#">interview</a></li>
                                                                <li><a href="#">last episode</a></li>-->
                            </ul>
                        </div>
                        <div class="home_title"><h1><?= $response["title"] ?></h1></div>
                        <div class="home_subtitle"><?= substr($response["description"], 0, 300) ?></div>
                        <div class="track_info">
                            <ul class="d-flex flex-row align-items-start justify-content-start">
                                <li><a href="#"><?= date("M d, Y", strtotime($response["onCreate"])) ?></a></li>
                                <li><a href="#"><?= $response["categories"] ?></a></li>
                                <li><?= $response["duration"] ?></li>
                                <li><a href="#"><?= $response["likes"] ?> Likes</a></li>
                                <li><a href="#"><?= $response["comments"] ?> Comments</a></li>
                            </ul>
                        </div>

                        <div class="track track_home" >
                            <audio controls class="audio-player">
                                <source src="<?= $response["file_url"] ?>" type="<?= $response["file_type"] ?>">

                                Your browser does not support the audio element.
                            </audio>
                        </div>
                        <div class="button_border home_button trans_200"><a href="/deliberatetalks/episode/<?= str_replace(" ", "-", $response["title"]); ?>">More Info</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shows -->

<div class="shows">
    <div class="container">
        <div class="row shows_row">
            <?php
            $resp = json_decode($main->jsonRespon(api_url . "/?r=userData", array("action" => "lastPost", "limit" => 3)), true);
            //print_r($response);
            foreach ($resp as $key => $response) {
                ?>
                <div class="col-lg-4">
                    <div class="show">
                        <div class="show_image">
                            <a href="/deliberatetalks/episode/<?= str_replace(" ", "-", $response["title"]); ?>">
                                <img src="<?= $response["image_url"] ?>" class="imag-resp" alt="https://unsplash.com/@icons8">
                            </a>
                            <div class="show_tags">
                                <div class="tags">
                                    <ul class="d-flex flex-row align-items-start justify-content-start">
                                        <li><a href="/deliberatetalks/episode/<?= str_replace(" ", "-", $response["title"]); ?>"><?= $response["categories"] ?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="show_play_icon"><img src="<?= base_url ?>/assets/website/images/play.svg" alt="https://www.flaticon.com/authors/cole-bemis"></div>
                        </div>
                        <div class="show_content">
                            <div class="show_date"><a href="/deliberatetalks/episode/<?= str_replace(" ", "-", $response["title"]); ?>"><?= date("M d, Y", strtotime($response["onCreate"])) ?></a></div>
                            <div class="show_title"><a href="/deliberatetalks/episode/<?= str_replace(" ", "-", $response["title"]); ?>"><?= $response["title"] ?></a></div>
                            <div class="show_info d-flex flex-row align-items-start justify-content-start">
                                <div class="show_fav d-flex flex-row align-items-center justify-content-start">
                                    <div class="show_fav_icon show_info_icon"><img class="svg" src="<?= base_url ?>/assets//website/images/heart.svg" alt=""></div>
                                    <div class="show_fav_count"><?= $response["likes"] ?></div>
                                </div>
                                <div class="show_comments">
                                    <a href="#">
                                        <div class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="show_comments_icon show_info_icon"><img class="svg" src="<?= base_url ?>/assets/website/images/speech-bubble.svg" alt=""></div>
                                            <div class="show_comments_count"><?= $response["comments"] ?> Comments</div>
                                        </div>
                                    </a>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <!-- Show -->

        </div>
        <div class="row">
            <div class="col text-center">
                <div class="button_fill shows_button"><a href="#">browse shows</a></div>
            </div>
        </div>
    </div>
</div>

<!-- About -->
<style>
    #overlay {

        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #cccccc;
        opacity:0.2;
        background:url('<?= base_url ?>/assets/website/images/YTC.jpg')  no-repeat center fixed; 
        background-size: cover;
        cursor: pointer;
    }
</style>
<div class="intro">
    <div class="background_image" id="overlay"></div>

    <div class="container" >
        <div class="row">
            <div class="col">
                <div class="intro_content text-center">
                    <div class="section_title text-center"><h1>ABOUT DE<span>LIBERATE</span></h1></div>
                    <div class="intro_text text-center">
                        <p>Deliberate Talks is a weekly podcast that highlights conversations about Digital Marketing, Entrepreneurship, Evolved work goals, new age opportunities and unconventional stories. Tune in every Monday for a new episode with our Host Dakshin Adyanthaya, the founder and director at Pixelated Egg Digital Ventures for a solo narrative or a conversation for two with his guests from different parts of the world.
                            You can also follow / download the content on Spotify, Google Podcast, Apple Podcast, Stitcher, Jio Savvn or Youtube or engage with us on <a href="https://instagram.com/deliberatetalks">instagram.com/deliberatetalks</a> or email at <a href="mailto:deliberatetalks@gmail.com">deliberatetalks@gmail.com</a></p>
                    </div>
                    <div class="button_fill intro_button"><a href="#">read more</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end about-->

<!-- newsletter-->
<div class="newsletter">
    <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="<?= base_url ?>/assets/website/images/newsletter.jpg" data-speed="0.8"></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title light text-center"><h1>Join my Newsletter</h1></div>
                <div class="newsletter_text text-center">
                    <p>Stay on track with the latest information about our podcasts, guests, special guest and giveaways.</p>
                </div>
            </div>
        </div>
        <div class="row newsletter_row">
            <div class="col-lg-10 offset-lg-1">
                <div class="newsletter_form_container">
                    <form action="javascript:void(0)" class="newsletter_form d-flex flex-md-row flex-column align-items-md-start align-items-center justify-content-md-between justify-content-start" id="newsletter_form">
                        <input type="email" class="newsletter_input" id="email" name='email' placeholder="Enter email here." required="required">
                        <button id="submit"  class="newsletter_button button_fill">subscribe now!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end newsletter-->
<style>
    .section_title{
        color:#000;
    }
    .intro_text p{
        color:#000;
    }
    .intro
    {
        background: #FFFFFF;
        padding-top: 97px;
        padding-bottom: 92px;
    }
    .intro_text
    {
        margin-top: 13px;
    }
    .intro_text p
    {

    }
    .intro_button
    {
        width: 161px;
        margin-top: 29px;
    }
    .newsletter
    {
        padding-top: 74px;
        padding-bottom: 166px;
    }
    .newsletter_text
    {
        max-width: 510px;
        margin-left: auto;
        margin-right: auto;
        margin-top: 18px;
    }
    .newsletter_text p
    {
        font-size: 16px;
        font-weight: 300;
        color: #FFFFFF;
        line-height: 1.5;
    }
    .newsletter_row
    {
        margin-top: 63px;
    }
    .newsletter_form_container
    {
        width: 100%;
    }
    .newsletter_form
    {
        display: block;
    }
    .newsletter_input
    {
        display: block;
        width: calc(100% - 260px);
        height: 54px;
        background: #FFFFFF;
        border: none;
        outline: none;
        border-radius: 27px;
        font-size: 18px;
        color: #1f2128;
        padding-left: 30px;
    }
    .newsletter_button
    {
        width: 230px;
        height: 54px;
        border: none;
        outline: none;
        border-radius: 27px;
        color: #FFFFFF;
        font-size: 18px;
        font-weight: 500;
        text-transform: uppercase;
        cursor: pointer;
    }

    @media only screen and (max-width: 991px)
    {

        .about_content
        {
            width: 100%;
            margin-top: 0;
        }

        .newsletter_input
        {
            width: calc(100% - 220px);
        }
        .newsletter_button
        {
            width: 190px;
            font-size: 14px;
        }

    }
    @media only screen and (max-width: 767px)
    {

        .newsletter_input
        {
            width: 100%;
        }
        .newsletter_button
        {
            width: 190px;
            font-size: 14px;
            margin-top: 15px;
        }
    }
    @media only screen and (max-width: 575px)
    {

        .button_fill,
        .button_border
        {
            height: 38px;
        }
        .button_border a
        {
            font-size: 12px;
            line-height: 36px;
        }
        .button_fill a
        {
            font-size: 12px;
            line-height: 38px;
        }
        .newsletter_input
        {
            height: 44px;
        }
    }

</style>
<script src="<?= base_url ?>/assets/website/js/custom.js"></script>
<script>
    $("document").ready(function () {
        $("#newsletter_form").submit(function (e) {
            e.preventDefault();
            $("#submit").attr("disabled",true);
            var formdata = new FormData($("#newsletter_form")[0]);
            $.ajax({
                type: 'POST',
                url: '<?= api_url ?>/?r=website',
                data: formdata,
                contentType: false,
                processData: false, xhr: function () {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (e) {
                        var progressbar = Math.round((e.loaded / e.total) * 100);
                    });
                    return xhr;
                },
                success: function (data) {
                    $("#submit").attr("disabled",false);
                    console.log(data);
                    var json = JSON.parse(data);
                    $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});
                    $("#newsletter_form")[0].reset();
                },
                error: function (request, status, error) {
                    //printMessage("Error on " + error, "danger", ".msg");
                    $("#newsletter_form")[0].reset();
                    //progressHide()
                }
            });
            console.log("Validation Success send form");

        });
    });
</script>