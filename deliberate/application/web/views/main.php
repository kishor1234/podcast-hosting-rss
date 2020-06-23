<!-- Home -->
<?php
$resp = json_decode($main->jsonRespon(api_url . "/?r=userData", array("action" => "lastPost", "limit" => 1)), true);
//print_r($response);
$response = $resp[0];
?>
<div class="home">
    <div class="background_image" style="background-image:url(<?= $response["banner_url"] ?>)"></div>
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
                        <div class="button_border home_button trans_200"><a href="/in/episode/<?=str_replace(" ","-",$response["title"]);?>">More Info</a></div>
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
                            <a href="/in/episode/<?=str_replace(" ","-",$response["title"]);?>">
                                <img src="<?= $response["image_url"] ?>" class="imag-resp" alt="https://unsplash.com/@icons8">
                            </a>
                            <div class="show_tags">
                                <div class="tags">
                                    <ul class="d-flex flex-row align-items-start justify-content-start">
                                        <li><a href="/in/episode/<?=str_replace(" ","-",$response["title"]);?>"><?= $response["categories"] ?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="show_play_icon"><img src="/assets/website/images/play.svg" alt="https://www.flaticon.com/authors/cole-bemis"></div>
                        </div>
                        <div class="show_content">
                            <div class="show_date"><a href="/in/episode/<?=str_replace(" ","-",$response["title"]);?>"><?= date("M d, Y", strtotime($response["onCreate"])) ?></a></div>
                            <div class="show_title"><a href="episode.html"><?= $response["title"] ?></a></div>
                            <div class="show_info d-flex flex-row align-items-start justify-content-start">
                                <div class="show_fav d-flex flex-row align-items-center justify-content-start">
                                    <div class="show_fav_icon show_info_icon"><img class="svg" src="/assets//website/images/heart.svg" alt=""></div>
                                    <div class="show_fav_count"><?= $response["likes"] ?></div>
                                </div>
                                <div class="show_comments">
                                    <a href="#">
                                        <div class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="show_comments_icon show_info_icon"><img class="svg" src="/assets/website/images/speech-bubble.svg" alt=""></div>
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

