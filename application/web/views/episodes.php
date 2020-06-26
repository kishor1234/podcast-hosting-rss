<link rel="stylesheet" type="text/css" href="/assets/website/styles/episodes.css">
<link rel="stylesheet" type="text/css" href="/assets/website/styles/episodes_responsive.css">
<!-- Home -->

<div class="home">
    <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="/assets/website/images/about.jpg" data-speed="0.8"></div>
    <div class="home_container d-flex flex-column align-items-center justify-content-center">
        <div class="home_content">
            <div class="home_title"><h1>episodes</h1></div>
        </div>
    </div>
</div>

<!-- Episodes -->

<div class="episodes">
    <div class="container">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="sidebar">

                    <!-- Search -->
                    <!--                    <div class="sidebar_search">
                                            <div class="sidebar_title">Search</div>
                                            <form action="#" class="search_form" id="search_form">
                                                <input type="text" class="search_input" placeholder="Search here" required="required">
                                                <button class="search_button"><img src="images/search.png" alt=""></button>
                                            </form>
                                        </div>-->

                    <!-- Categories -->
                    <div class="sidebar_list">
                        <div class="sidebar_title">Categories</div>
                        <ul>
                            <li><a href="/deliberatetalks/episodes/travel">Travel</a></li>
                            <li><a href="/deliberatetalks/episodes/music">Music</a></li>
                            <li><a href="/deliberatetalks/episodes/lifestyle">Lifestyle</a></li>
                            <li><a href="/deliberatetalks/socal media/">Social Media</a></li>
                            <li><a href="/deliberatetalks/episodes/art">Art</a></li>
                            <li><a href="/deliberatetalks/episodes/audiobooks">Audiobooks</a></li>
                            <li><a href="/deliberatetalks/episodes/documentaries">Documentaries</a></li>
                        </ul>
                    </div>

                    <!-- Tags -->
                    <div class="sidebar_tags">
                        <div class="sidebar_title">Tags</div>
                        <div class="tags">
                            <ul class="d-flex flex-row align-items-start justify-content-start flex-wrap">
                                <li><a href="/deliberatetalks/episodes/music">music</a></li>
                                <li><a href="/deliberatetalks/episodes/art">art</a></li>
                                <li><a href="/deliberatetalks/episodes/technology">technology</a></li>
                                <li><a href="/deliberatetalks/episodes/travel and food">travel & food</a></li>
                                <li><a href="/deliberatetalks/episodes/viral">viral</a></li>
                                <li><a href="/deliberatetalks/episodes/interview">interview</a></li>
                                <li><a href="/deliberatetalks/episodes/social media">social media</a></li>
                                <li><a href="/deliberatetalks/episodes/development">development</a></li>
                                <li><a href="/deliberatetalks/episodes/success">success</a></li>
                                <li><a href="/deliberatetalks/episodes/did you knwo">did you know?</a></li>
                                <li><a href="/deliberatetalks/episodes/live">live</a></li>
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
                                        <li><a href="/">August 2018</a></li>
                                        <li><a href="/">July 2018</a></li>
                                        <li><a href="/">June 2018</a></li>
                                        <li><a href="/">May 2018</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Episodes -->
            <div class="col-lg-9 episodes_col">
                <div class="episodes_container" >

                    <!-- Episode -->
                    <div class="list-wrapper">
                        <?php
                        if (empty($response)) {
                            echo "<h2>No data found</h2>";
                        }
                        foreach ($response as $key => $resp) {
                            ?>
                            <div class="list-item">
                                <div class="episode d-flex flex-row align-items-start justify-content-start s1">
                                    <div>
                                        <div class="episode_image">
                                            <img src="<?= $resp["image_url"] ?>" alt="">
                                            <div class="tags">
                                                <ul class="d-flex flex-row align-items-start justify-content-start">
                                                    <li><a href="/deliberatetalks/episode/<?= str_replace(" ", "-", $resp["title"]); ?>"><?= $resp["catefories"] ?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="episode_content">
                                        <div class="episode_name"><a href="/deliberatetalks/episode/<?= str_replace(" ", "-", $resp["title"]); ?>"><?= $resp["title"] ?></a></div>
                                        <div class="episode_date"><a href="/deliberatetalks/episode/<?= str_replace(" ", "-", $resp["title"]); ?>"><?= date("M d, Y", strtotime($resp["onCreate"])) ?></a></div>
                                        <div class="show_info d-flex flex-row align-items-start justify-content-start">
                                            <div class="show_fav d-flex flex-row align-items-center justify-content-start">
                                                <div class="show_fav_icon show_info_icon"><img class="svg" src="/assets/website/images/heart.svg" alt=""></div>
                                                <div class="show_fav_count"><?= $resp["likes"] ?></div>
                                            </div>
                                            <div class="show_comments">
                                                <a href="/deliberatetalks/episode/<?= str_replace(" ", "-", $resp["title"]); ?>">
                                                    <div class="d-flex flex-row align-items-center justify-content-start">
                                                        <div class="show_comments_icon show_info_icon"><img class="svg" src="/assets//website/images/speech-bubble.svg" alt=""></div>
                                                        <div class="show_comments_count"><?= $resp["comments"] ?> Comments</div>
                                                    </div>
                                                </a>	
                                            </div>
                                        </div>
                                        <!-- Player -->
                                        <div class="single_player_container">
                                            <audio controls class="audio-player">
                                                <source src="<?= $resp["file_url"] ?>" type="<?= $resp["file_type"] ?>">

                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row page_nav_row">
            <div class="col">
                <div id="pagination-container"></div>
            </div>
        </div>
    </div>
</div>
<style>
    .simple-pagination ul {
        margin: 0 0 20px;
        padding: 0;
        list-style: none;
        text-align: center;
    }

    .simple-pagination li {
        display: inline-block;
        margin-right: 5px;
    }

    .simple-pagination li a,
    .simple-pagination li span {
        color: #666;
        padding: 5px 10px;
        text-decoration: none;
        border: 1px solid #EEE;
        background-color: #FFF;
        box-shadow: 0px 0px 10px 0px #EEE;
    }

    .simple-pagination .current {
        color: #FFF;
        background-color: #FF7182;
        border-color: #FF7182;
    }

    .simple-pagination .prev.current,
    .simple-pagination .next.current {
        background: #e04e60;
    }
    .list-wrapper {
        padding: 15px;
        overflow: hidden;
    }

    .list-item {
        border: 1px solid #EEE;
        background: #FFF;
        margin-bottom: 10px;
        padding: 10px;
        box-shadow: 0px 0px 10px 0px #EEE;
    }

</style>
<script src="/assets/website/js/episodes.js"></script>
<script src="/assets/website/new plugins/jquery.simplePagination.js" type="text/javascript"></script>
<script>
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/
    $(document).ready(function () {
        var items = $(".list-wrapper .list-item");
        var numItems = items.length;
        var perPage = 10;

        items.slice(perPage).hide();

        $('#pagination-container').pagination({
            items: numItems,
            itemsOnPage: perPage,
            prevText: "&laquo;",
            nextText: "&raquo;",
            onPageClick: function (pageNumber) {
                var showFrom = perPage * (pageNumber - 1);
                var showTo = showFrom + perPage;
                items.hide().slice(showFrom, showTo).show();
            }
        });

    });
</script>