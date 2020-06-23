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

class feed extends CAaskController {

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
            $resp = json_decode($this->jsonRespon(api_url . "/?r=userData", array("action" => "feeHead", "limit" => 1)), true);
           
            $resppons = json_decode($this->jsonRespon(api_url . "/?r=userData", array("action" => "feePost", "userid" => $resp["id"])), true);
           
            header('Content-Type: text/xml');
            echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" . PHP_EOL;
            echo '<rss xmlns:googleplay="http://www.google.com/schemas/play-podcasts/1.0" version="2.0">' . PHP_EOL;
            echo '<channel>' . PHP_EOL;
            echo "<title>{$resp["title"]}</title>" . PHP_EOL;
            echo "<link>{$resp["link"]}</link>" . PHP_EOL;
            echo "<language>en-us</language>" . PHP_EOL;
            echo "<copyright>℗ {$resp["cp"]}</copyright>" . PHP_EOL;
            echo "<googleplay:author>{$resp["name"]}</googleplay:author>" . PHP_EOL;
            echo "<googleplay:description>" . substr($resp["description"], 0, 300) . "</googleplay:description>" . PHP_EOL;
            echo "<description>" . substr($resp["description"], 0, 300) . "</description>" . PHP_EOL;
            echo "<googleplay:email>{$resp["email"]}</googleplay:email>" . PHP_EOL;
            echo "<googleplay:image href = \"{$resp["image_url"]}\" />" . PHP_EOL;
            echo "<googleplay:category text = \"{$resp["categories"]}\"/>" . PHP_EOL;
            foreach ($resppons as $key => $response) {
                echo "<item>" . PHP_EOL;
                echo "<title>{$response["title"]}</title>" . PHP_EOL;
                echo "<googleplay:author>{$response["name"]}</googleplay:author>" . PHP_EOL;
                echo "<googleplay:description>" . substr($response["description"], 0, 300) . "</googleplay:description>" . PHP_EOL;
                echo "<googleplay:image href = \"{$response["image_url"]}\" />" . PHP_EOL;
                echo "<enclosure url = \"{$response["file_url"]}\" length = \"2320111\" type = \"audio/mpeg\" />" . PHP_EOL;
                echo "<guid>{$response["file_url"]}</guid>" . PHP_EOL;
                echo "<pubDate>" . date("D, M d, Y H:s:i T", strtotime($response["onCreate"])) . "</pubDate>" . PHP_EOL;
                echo "</item>" . PHP_EOL;
            }
            echo "</channel>" . PHP_EOL;
            echo "</rss>" . PHP_EOL;
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
