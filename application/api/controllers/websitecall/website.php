<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of C_Newsletter
 *
 * @author asksoft
 */
require_once controller;

class website extends CAaskController {

    //put your code here
    public $visState = false;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();

        return;
    }

    public function initialize() {
        parent::initialize();
        try {
            if (isset($_POST)) {
                $data = array("email" => $this->filterPost("email"), "ip" => $_SERVER["REMOTE_ADDR"]);
                $error = array();
                $this->adminDB[$_SESSION["db_1"]]->query($this->ask_mysqli->insert("newsletter", $data)) != true ? array_push($error, $this->adminDB[$_SESSION]->error) : true;
                if (empty($error)) {
                    ob_start();
                    $this->mailObject->sendmailWithoutAttachment($this->filterPost("email"), noreplayid, "Pixelatedegg", "<p> Thanks ofr subscribing </p>", "Thanks for subscribing", array());
                    ob_end_clean();
                    echo json_encode(array("toast" => array("success", "Newsletter", "{$this->filterPost("email")} subscribe success."), "status" => 1, "message" => "Newsletter subscribe Success"));
                } else {

                    echo json_encode(array("toast" => array("danger", "Newsletter", "{$this->filterPost("email")} subscribe failed. {$error[0]} " . $this->adminDB[$_SESSION["db_1"]]->error), "status" => 0, "message" => "Newsletter subscribe Failed " . $this->adminDB[$_SESSION["db_1"]]->error));
                }
            } else {
                echo $this->printMessage("Faild...!", "danger");
            }
        } catch (Exception $ex) {
            
        }
        return;
    }

    public function execute() {
        parent::execute();
        return;
    }

    public function finalize() {
        parent::finalize();
        return;
    }

    public function reader() {
        parent::reader();
        return;
    }

    public function distory() {
        parent::distory();
        return;
    }

}
