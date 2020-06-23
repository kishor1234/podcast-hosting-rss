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
        if (isset($_SESSION["loginEmail"])) {
            redirect(ASETS . "?r=" . $this->encript->encdata("C_Dashboard"));
        }
        return;
    }

    public function initialize() {
        parent::initialize();
        try {
            $response = array();
            switch ($_REQUEST["2"]) {
                case "episode":
                    $response = json_decode($this->jsonRespon(api_url . "/?r=userData", array("action" => "SinglePost", "limit" => 1, "title" => str_replace("-", " ", $_REQUEST["3"]))), true);
                    break;
            }
            $this->isLoadView(array("header" => "header", "main" => "{$_REQUEST["2"]}", "footer" => "footer", "error" => "page_404"), true, $response);
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
