<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author asksoft
 */
//die(APPLICATION);
//require_once getcwd() . '/' . APPLICATION . "/controllers/Crout.php";
require_once controller;

class deliberatetalks extends CAaskController {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function create() {
        parent::create();

        return;
    }

    public function initialize() {
        parent::initialize();
        try {
            $response = array();

            switch ($_REQUEST["2"]) {
                case "episode":
                    $response = json_decode($this->jsonRespon(api_url . "/?r=userData", array("action" => "SinglePost", "limit" => 1, "title" => str_replace("-", " ", $_REQUEST["3"]))), true);
                    $r = json_decode($this->jsonRespon(api_url . "/?r=userData", array("action" => "ViewCount", "limit" => 1, "title" => str_replace("-", " ", $_REQUEST["3"]))), true);
                    $this->isLoadView(array("header" => "header", "main" => "{$_REQUEST["2"]}", "footer" => "footer", "error" => "page_404"), true, $response);
                    break;
                case "episodes":
                    $response = json_decode($this->jsonRespon(api_url . "/?r=userData", array("action" => "AllPost", "tags" => "{$_REQUEST["3"]}", "title" => str_replace("-", " ", $_REQUEST["3"]))), true);
                    $this->isLoadView(array("header" => "header", "main" => "{$_REQUEST["2"]}", "footer" => "footer", "error" => "page_404"), true, array("response" => $response));
                    break;
                case "about":
                    $this->isLoadView(array("header" => "header", "main" => "{$_REQUEST["2"]}", "footer" => "footer", "error" => "page_404"), true, $response);
                    break;
                case "feed.xml":
                    $resp = json_decode($this->jsonRespon(api_url . "/?r=userData", array("action" => "feeHead", "limit" => 1)), true);
                    $resppons = json_decode($this->jsonRespon(api_url . "/?r=userData", array("action" => "feePost", "userid" => $resp["id"])), true);
                    header('Content-Type: text/xml');
                    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" . PHP_EOL;
                    echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:googleplay="http://www.google.com/schemas/play-podcasts/1.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:content="http://purl.org/rss/1.0/modules/content/">' . PHP_EOL;
                    //echo "<atom:link href=\"http://pixelatedegg.com/deliberatetalks/feed.xml\" rel=\"self\" type=\"application/rss+xml\" />".PHP_EOL;
                    echo '<channel>' . PHP_EOL;
                    echo "<title>{$resp["title"]}</title>" . PHP_EOL;
                    echo "<link>{$resp["link"]}</link>" . PHP_EOL;
                    echo "<language>en-us</language>" . PHP_EOL;
                    echo "<itunes:subtitle>{$resp["title"]}</itunes:subtitle>" . PHP_EOL;
                    echo "<itunes:author>{$resp["name"]}</itunes:author>" . PHP_EOL;
                    echo "<itunes:summary>" . substr($resp["description"], 0, 300) . "</itunes:summary>" . PHP_EOL;
                    //echo "<description>" . substr($resp["description"], 0, 300) . "</description>" . PHP_EOL;
                    echo "<itunes:owner> <itunes:name>{$resp["name"]}</itunes:name>" . PHP_EOL;
                    echo "<itunes:email>{$resp["email"]}</itunes:email>" . PHP_EOL;
                    echo "</itunes:owner>" . PHP_EOL;
                    echo "<itunes:explicit>no</itunes:explicit>" . PHP_EOL;
                    echo "<itunes:image href = \"{$resp["image_url"]}\"/>" . PHP_EOL;
                    //echo "<itunes:category text = \"{$resp["categories"]}\">".PHP_EOL;
                    //echo "<itunes:category text = \"{$resp["categories"]}\"/>" . PHP_EOL;
                    //echo "<itunes:type>serial</itunes:type>" . PHP_EOL;
                    echo "<itunes:category text=\"Business\">" . PHP_EOL;
                    echo "<itunes:category text=\"Careers\"/>" . PHP_EOL;
                    echo "</itunes:category>" . PHP_EOL;
                    //end apple

                    echo "<copyright>℗ {$resp["cp"]}</copyright>" . PHP_EOL;
                    echo "<googleplay:author>{$resp["name"]}</googleplay:author>" . PHP_EOL;
                    //echo "<item>".PHP_EOL;
                    echo "<googleplay:description>" . substr($resp["description"], 0, 300) . "</googleplay:description>" . PHP_EOL;
                    echo "<description>" . substr($resp["description"], 0, 300) . "</description>" . PHP_EOL;
                    echo "<googleplay:email>{$resp["email"]}</googleplay:email>" . PHP_EOL;
                    echo "<googleplay:image href = \"{$resp["image_url"]}\" />" . PHP_EOL;
                    echo "<googleplay:category text = \"{$resp["categories"]}\"/>" . PHP_EOL;

                    foreach ($resppons as $key => $response) {
                        echo "<item>" . PHP_EOL;
                        echo "<title>{$response["title"]}</title>" . PHP_EOL;
                        echo "<itunes:subtitle>{$response["title"]}</itunes:subtitle>" . PHP_EOL;
                        echo "<itunes:summary>" . substr($response["description"], 0, 300) . "</itunes:summary>" . PHP_EOL;
                        echo "<description>" . substr($response["description"], 0, 300) . "</description>" . PHP_EOL;
                        echo "<itunes:image href = \"{$response["image_url"]}\"/>" . PHP_EOL;
                        echo "<link>http://pixelatedegg.com/deliberatetalks</link>" . PHP_EOL;
                        //echo "<itunes:episodeType>trailer</itunes:episodeType>" . PHP_EOL;
                        echo "<itunes:author>{$response["name"]}</itunes:author>" . PHP_EOL;
                        echo "<itunes:title>{$response["title"]}</itunes:title>" . PHP_EOL;
                        //echo "<description>".substr($response["description"], 0, 300)."</description>".PHP_EOL;
                        echo "<itunes:duration>{$response["duration"]}</itunes:duration>" . PHP_EOL;
                        echo "<itunes:keywords>{$response["tags"]}</itunes:keywords>" . PHP_EOL;
                        //echo "<itunes:category text = \"{$resp["categories"]}\"/>" . PHP_EOL;
                        echo "<itunes:explicit>no</itunes:explicit>" . PHP_EOL;
                        //echo "<content:encoded>" . PHP_EOL;
                        //echo "<![CDATA[" . substr($response["description"], 0, 300) . " <a href = \"https://www.apple.com/itunes/podcasts/\">Apple Podcasts</a>.]]>".PHP_EOL;
                        //echo "</content:encoded>" . PHP_EOL;
                        echo "<googleplay:author>{$response["name"]}</googleplay:author>" . PHP_EOL;
                        echo "<googleplay:description>" . substr($response["description"], 0, 300) . "</googleplay:description>" . PHP_EOL;
                        echo "<googleplay:image href = \"{$response["image_url"]}\" />" . PHP_EOL;
                        echo "<enclosure url = \"{$response["file_url"]}\" length = \"{$response["file_lenght"]}\" type = \"{$response["file_type"]}\" />" . PHP_EOL;
                        echo "<guid>{$response["file_url"]}</guid>" . PHP_EOL;
                        echo "<pubDate>" . date("D, d M Y H:s:i T", strtotime($response["onCreate"])) . " </pubDate>" . PHP_EOL;
                        echo "</item>" . PHP_EOL;
                    }
                    echo "</channel>" . PHP_EOL;
                    echo "</rss>" . PHP_EOL;
                    break;
                case "feed":
                    $resp = json_decode($this->jsonRespon(api_url . "/?r=userData", array("action" => "feeHead", "limit" => 1)), true);
                    $resppons = json_decode($this->jsonRespon(api_url . "/?r=userData", array("action" => "feePost", "userid" => $resp["id"])), true);
                    header('Content-Type: text/xml');
                    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" . PHP_EOL;
                    echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:googleplay="http://www.google.com/schemas/play-podcasts/1.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:content="http://purl.org/rss/1.0/modules/content/">' . PHP_EOL;
                    //echo "<atom:link href=\"http://pixelatedegg.com/deliberatetalks/feed.xml\" rel=\"self\" type=\"application/rss+xml\" />".PHP_EOL;
                    echo '<channel>' . PHP_EOL;
                    echo "<title>{$resp["title"]}</title>" . PHP_EOL;
                    echo "<link>{$resp["link"]}</link>" . PHP_EOL;
                    echo "<language>en-us</language>" . PHP_EOL;
                    echo "<itunes:subtitle>{$resp["title"]}</itunes:subtitle>" . PHP_EOL;
                    echo "<itunes:author>{$resp["name"]}</itunes:author>" . PHP_EOL;
                    echo "<itunes:summary>" . substr($resp["description"], 0, 300) . "</itunes:summary>" . PHP_EOL;
                    //echo "<description>" . substr($resp["description"], 0, 300) . "</description>" . PHP_EOL;
                    echo "<itunes:owner> <itunes:name>{$resp["name"]}</itunes:name>" . PHP_EOL;
                    echo "<itunes:email>{$resp["email"]}</itunes:email>" . PHP_EOL;
                    echo "</itunes:owner>" . PHP_EOL;
                    echo "<itunes:explicit>no</itunes:explicit>" . PHP_EOL;
                    echo "<itunes:image href = \"{$resp["image_url"]}\"/>" . PHP_EOL;
                    //echo "<itunes:category text = \"{$resp["categories"]}\">".PHP_EOL;
                    //echo "<itunes:category text = \"{$resp["categories"]}\"/>" . PHP_EOL;
                    //echo "<itunes:type>serial</itunes:type>" . PHP_EOL;
                    echo "<itunes:category text=\"Business\">" . PHP_EOL;
                    echo "<itunes:category text=\"Careers\"/>" . PHP_EOL;
                    echo "</itunes:category>" . PHP_EOL;
                    //end apple

                    echo "<copyright>℗ {$resp["cp"]}</copyright>" . PHP_EOL;
                    echo "<googleplay:author>{$resp["name"]}</googleplay:author>" . PHP_EOL;
                    //echo "<item>".PHP_EOL;
                    echo "<googleplay:description>" . substr($resp["description"], 0, 300) . "</googleplay:description>" . PHP_EOL;
                    echo "<description>" . substr($resp["description"], 0, 300) . "</description>" . PHP_EOL;
                    echo "<googleplay:email>{$resp["email"]}</googleplay:email>" . PHP_EOL;
                    echo "<googleplay:image href = \"{$resp["image_url"]}\" />" . PHP_EOL;
                    echo "<googleplay:category text = \"{$resp["categories"]}\"/>" . PHP_EOL;

                    foreach ($resppons as $key => $response) {
                        echo "<item>" . PHP_EOL;
                        echo "<title>{$response["title"]}</title>" . PHP_EOL;
                        echo "<itunes:subtitle>{$response["title"]}</itunes:subtitle>" . PHP_EOL;
                        echo "<itunes:summary>" . substr($response["description"], 0, 300) . "</itunes:summary>" . PHP_EOL;
                        echo "<description>" . substr($response["description"], 0, 300) . "</description>" . PHP_EOL;
                        echo "<itunes:image href = \"{$response["image_url"]}\"/>" . PHP_EOL;
                        echo "<link>http://pixelatedegg.com/deliberatetalks</link>" . PHP_EOL;
                        //echo "<itunes:episodeType>trailer</itunes:episodeType>" . PHP_EOL;
                        echo "<itunes:author>{$response["name"]}</itunes:author>" . PHP_EOL;
                        echo "<itunes:title>{$response["title"]}</itunes:title>" . PHP_EOL;
                        //echo "<description>".substr($response["description"], 0, 300)."</description>".PHP_EOL;
                        echo "<itunes:duration>{$response["duration"]}</itunes:duration>" . PHP_EOL;
                        echo "<itunes:keywords>{$response["tags"]}</itunes:keywords>" . PHP_EOL;
                        //echo "<itunes:category text = \"{$resp["categories"]}\"/>" . PHP_EOL;
                        echo "<itunes:explicit>no</itunes:explicit>" . PHP_EOL;
                        //echo "<content:encoded>" . PHP_EOL;
                        //echo "<![CDATA[" . substr($response["description"], 0, 300) . " <a href = \"https://www.apple.com/itunes/podcasts/\">Apple Podcasts</a>.]]>".PHP_EOL;
                        //echo "</content:encoded>" . PHP_EOL;
                        echo "<googleplay:author>{$response["name"]}</googleplay:author>" . PHP_EOL;
                        echo "<googleplay:description>" . substr($response["description"], 0, 300) . "</googleplay:description>" . PHP_EOL;
                        echo "<googleplay:image href = \"{$response["image_url"]}\" />" . PHP_EOL;
                        echo "<enclosure url = \"{$response["file_url"]}\" length = \"{$response["file_lenght"]}\" type = \"{$response["file_type"]}\" />" . PHP_EOL;
                        echo "<guid>{$response["file_url"]}</guid>" . PHP_EOL;
                        echo "<pubDate>" . date("D, d M Y H:s:i T", strtotime($response["onCreate"])) . " </pubDate>" . PHP_EOL;
                        echo "</item>" . PHP_EOL;
                    }
                    echo "</channel>" . PHP_EOL;
                    echo "</rss>" . PHP_EOL;
                    break;
                case "applefeed":
$resp = json_decode($this->jsonRespon(api_url . "/?r=userData", array("action" => "feeHead", "limit" => 1)), true);
                    $resppons = json_decode($this->jsonRespon(api_url . "/?r=userData", array("action" => "feePost", "userid" => $resp["id"])), true);
                    header('Content-Type: text/xml');
                    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" . PHP_EOL;
                    echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:googleplay="http://www.google.com/schemas/play-podcasts/1.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:content="http://purl.org/rss/1.0/modules/content/">' . PHP_EOL;
                    //echo "<atom:link href=\"http://pixelatedegg.com/deliberatetalks/feed.xml\" rel=\"self\" type=\"application/rss+xml\" />".PHP_EOL;
                    echo '<channel>' . PHP_EOL;
                    echo "<title>{$resp["title"]}</title>" . PHP_EOL;
                    echo "<link>{$resp["link"]}</link>" . PHP_EOL;
                    echo "<language>en-us</language>" . PHP_EOL;
                    echo "<itunes:subtitle>{$resp["title"]}</itunes:subtitle>" . PHP_EOL;
                    echo "<itunes:author>{$resp["name"]}</itunes:author>" . PHP_EOL;
                    echo "<itunes:summary>" . substr($resp["description"], 0, 300) . "</itunes:summary>" . PHP_EOL;
                    //echo "<description>" . substr($resp["description"], 0, 300) . "</description>" . PHP_EOL;
                    echo "<itunes:owner> <itunes:name>{$resp["name"]}</itunes:name>" . PHP_EOL;
                    echo "<itunes:email>{$resp["email"]}</itunes:email>" . PHP_EOL;
                    echo "</itunes:owner>" . PHP_EOL;
                    echo "<itunes:explicit>no</itunes:explicit>" . PHP_EOL;
                    echo "<itunes:image href = \"{$resp["image_url"]}\"/>" . PHP_EOL;
                    //echo "<itunes:category text = \"{$resp["categories"]}\">".PHP_EOL;
                    //echo "<itunes:category text = \"{$resp["categories"]}\"/>" . PHP_EOL;
                    //echo "<itunes:type>serial</itunes:type>" . PHP_EOL;
                    echo "<itunes:category text=\"Business\">" . PHP_EOL;
                    echo "<itunes:category text=\"Careers\"/>" . PHP_EOL;
                    echo "</itunes:category>" . PHP_EOL;
                    //end apple

                    echo "<copyright>℗ {$resp["cp"]}</copyright>" . PHP_EOL;
                    echo "<googleplay:author>{$resp["name"]}</googleplay:author>" . PHP_EOL;
                    //echo "<item>".PHP_EOL;
                    echo "<googleplay:description>" . substr($resp["description"], 0, 300) . "</googleplay:description>" . PHP_EOL;
                    echo "<description>" . substr($resp["description"], 0, 300) . "</description>" . PHP_EOL;
                    echo "<googleplay:email>{$resp["email"]}</googleplay:email>" . PHP_EOL;
                    echo "<googleplay:image href = \"{$resp["image_url"]}\" />" . PHP_EOL;
                    echo "<googleplay:category text = \"{$resp["categories"]}\"/>" . PHP_EOL;

                    foreach ($resppons as $key => $response) {
                        echo "<item>" . PHP_EOL;
                        echo "<title>{$response["title"]}</title>" . PHP_EOL;
                        echo "<itunes:subtitle>{$response["title"]}</itunes:subtitle>" . PHP_EOL;
                        echo "<itunes:summary>" . substr($response["description"], 0, 300) . "</itunes:summary>" . PHP_EOL;
                        echo "<description>" . substr($response["description"], 0, 300) . "</description>" . PHP_EOL;
                        echo "<itunes:image href = \"{$response["image_url"]}\"/>" . PHP_EOL;
                        echo "<link>http://pixelatedegg.com/deliberatetalks</link>" . PHP_EOL;
                        //echo "<itunes:episodeType>trailer</itunes:episodeType>" . PHP_EOL;
                        echo "<itunes:author>{$response["name"]}</itunes:author>" . PHP_EOL;
                        echo "<itunes:title>{$response["title"]}</itunes:title>" . PHP_EOL;
                        //echo "<description>".substr($response["description"], 0, 300)."</description>".PHP_EOL;
                        echo "<itunes:duration>{$response["duration"]}</itunes:duration>" . PHP_EOL;
                        echo "<itunes:keywords>{$response["tags"]}</itunes:keywords>" . PHP_EOL;
                        //echo "<itunes:category text = \"{$resp["categories"]}\"/>" . PHP_EOL;
                        echo "<itunes:explicit>no</itunes:explicit>" . PHP_EOL;
                        //echo "<content:encoded>" . PHP_EOL;
                        //echo "<![CDATA[" . substr($response["description"], 0, 300) . " <a href = \"https://www.apple.com/itunes/podcasts/\">Apple Podcasts</a>.]]>".PHP_EOL;
                        //echo "</content:encoded>" . PHP_EOL;
                        echo "<googleplay:author>{$response["name"]}</googleplay:author>" . PHP_EOL;
                        echo "<googleplay:description>" . substr($response["description"], 0, 300) . "</googleplay:description>" . PHP_EOL;
                        echo "<googleplay:image href = \"{$response["image_url"]}\" />" . PHP_EOL;
                        echo "<enclosure url = \"{$response["file_url"]}\" length = \"{$response["file_lenght"]}\" type = \"{$response["file_type"]}\" />" . PHP_EOL;
                        echo "<guid>{$response["file_url"]}</guid>" . PHP_EOL;
                        echo "<pubDate>" . date("D, d M Y H:s:i T", strtotime($response["onCreate"])) . " </pubDate>" . PHP_EOL;
                        echo "</item>" . PHP_EOL;
                    }
                    echo "</channel>" . PHP_EOL;
                    echo "</rss>" . PHP_EOL;
                    break;
                default:
                    $_REQUEST["2"] = "main";
                    $this->isLoadView(array("header" => "header", "main" => "{$_REQUEST["2"]}", "footer" => "footer", "error" => "page_404"), true, $response);
                    break;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            error_log($ex, 3, "error.log");
        }
        return;
    }

    public function execute() {
        //parent::execute();
        return;
    }

    public function finalize() {
        //parent::finalize();
        return;
    }

    public function reader() {
        //parent::reader();
        return;
    }

    public function distory() {
        //parent::distory();
        return;
    }

}
