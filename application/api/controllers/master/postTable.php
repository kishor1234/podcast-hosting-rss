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

class postTable extends CAaskController {

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

            $this->loadTablePodcast();
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

    function updatePersonal() {
        $where = array("id" => $_POST["id"]);
        unset($_POST["id"]);
        unset($_POST["action"]);
        $sql = $this->ask_mysqli->update($_POST, "user") . $this->ask_mysqli->whereSingle($where);
        if ($this->adminDB[$_SESSION["db_1"]]->query($sql)) {
            echo json_encode(array("toast" => array("success", "Personal Information ", "Update Success....."), "status" => 1, "message" => "Update Success"));
        } else {
            echo json_encode(array("toast" => array("danger", "Personal Information", "Update Failed..... " . $this->adminDB[$_SESSION["db_1"]]->error), "status" => 0, "message" => "Invalid college selected " . $this->adminDB[$_SESSION["db_1"]]->error));
        }
    }

    function newPodcast() {
        //upload image
        $this->cors();
        $data = array();
        $this->adminDB[$_SESSION["db_1"]]->autocommit(FALSE);
        $error = array();
        $data["userid"] = $_POST["userid"];
        $data["name"] = $_POST["name"];
        $data["email"] = $_POST["email"];
        $data["title"] = $_POST["title"];
        $data["tags"] = $_POST["tags"];
        $data["ip"] = $_SERVER["REMOTE_HOST"];
        $data["description"] = $_POST["description"];
        $uploadDir = "assets/upload/profile";
        $imageData = $this->uploadFiletoFileSystem('image', $uploadDir);
        //print_r($imageData);
        $sql = $this->ask_mysqli->insert("filesystem", $imageData);
        $this->adminDB[$_SESSION["db_1"]]->query($sql) == true ? true : array_push($error, "fileSystem query error image " . $this->adminDB[$_SESSION["db_1"]]->error);
        $imageid = $this->adminDB[$_SESSION["db_1"]]->insert_id;
        $data["image_id"] = $imageid;
        $data["image_url"] = $imageData["url"];
        //upload banner
        $bannerData = $this->uploadFiletoFileSystem('banner', $uploadDir);
        //print_r($bannerData);
        $sql = $this->ask_mysqli->insert("filesystem", $bannerData);
        $this->adminDB[$_SESSION["db_1"]]->query($sql) == true ? true : array_push($error, "fileSystem query error banner " . $this->adminDB[$_SESSION["db_1"]]->error);
        $bannerid = $this->adminDB[$_SESSION["db_1"]]->insert_id;
        $data["banner_url"] = $bannerData["url"];
        //upload file
        $fileData = $this->uploadAudioFiletoFileSystem('file', $uploadDir);
        //print_r($fileData);
        $duration = $fileData["duration"];
        $lenght = $fileData["length"];
        unset($fileData["duration"]);
        unset($fileData["length"]);
        $sql = $this->ask_mysqli->insert("filesystem", $fileData);
        $this->adminDB[$_SESSION["db_1"]]->query($sql) == true ? true : array_push($error, "fileSystem query error file " . $this->adminDB[$_SESSION["db_1"]]->error);
        $fileid = $this->adminDB[$_SESSION["db_1"]]->insert_id;
        $data["file_id"] = $fileid;
        $data["file_url"] = $fileData["url"];
        $data["file_type"] = $fileData["extension"];
        $data["file_lenght"] = $lenght;
        $data["duration"] = $duration;
        $data["categories"] = $_POST["categories"];
        //insertd post
        $sql = $this->ask_mysqli->insert("post", $data);
        $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : false;
        //response
        if (empty($error)) {
            $this->adminDB[$_SESSION["db_1"]]->commit();
            echo json_encode(array("toast" => array("success", "Podcast ", " Successfully post"), "status" => 1, "message" => "Post Success"));
        } else {
            $this->adminDB[$_SESSION["db_1"]]->rollback();
            echo json_encode(array("error" => $error, "toast" => array("danger", "Podcast", "Failed to post " . $this->adminDB[$_SESSION["db_1"]]->error), "status" => 0, "message" => "Postcard failed to post " . $this->adminDB[$_SESSION["db_1"]]->error));
        }
        //response
    }

    function myprofilepic($pid) {
        try {
            $data = array();
            $sql = $this->ask_mysqli->select("filesystem", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("id" => $pid));
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            if ($row = $result->fetch_assoc()) {
                $data = $row;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $data;
    }

    function myprofile() {
        try {
            $data = array();
            $sql = $this->ask_mysqli->select("user", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("id" => $_POST["id"]));
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            if ($row = $result->fetch_assoc()) {
                $data = $row;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $data;
    }

    function loadTablePodcast() {
        try {
            
            $request = $_REQUEST;
            $col = array(
                0 => 'id',
                1 => 'name',
                2 => 'email',
                3 => 'title',
                4 => 'description',
                5 => 'image_url',
                6 => 'onCreate',
                7 => 'action'
            );
            $sql = $this->ask_mysqli->select("post", $_SESSION["db_1"]); //. $this->ask_mysqli->whereSingle(array("userid" => $_SESSION["id"]));
            $sql .=$this->ask_mysqli->whereSingle(array("userid" => $_POST["id"]));
            $query = $this->executeQuery($_SESSION["db_1"], $sql);
            $totalData = $query->num_rows;
            $totalFilter = $totalData;
            /* Search */
            if (!empty($request['search']['value'])) {
                $sql.=" AND (name Like '%" . $request['search']['value'] . "%'";
                $sql.=" OR email Like '%" . $request['search']['value'] . "%' ";
                $sql.=" OR description Like '%" . $request['search']['value'] . "%' ";
                $sql.=" OR tags Like '%" . $request['search']['value'] . "%' ";
                $sql.=" OR title Like '%" . $request['search']['value'] . "%' )";
            }
            /* Order */
            $sql.=$this->ask_mysqli->orderBy($request['order'][0]['dir'], $col[$request['order'][0]['column']]) . $this->ask_mysqli->limitWithOffset($request['start'], $request['length']);
            $query = $this->executeQuery($_SESSION["db_1"], $sql);
            $totalData = $query->num_rows;
            while ($row = $query->fetch_assoc()) {
                $subdata = array();
                $subdata[] = $row['id'];
                $subdata[] = $row['title'];
                $subdata[] = $row['email'];
                $subdata[] = "<img src='{$row["image_url"]}' alt='image' style='widht:100%; height:auto;'>";
                $subdata[] = "<audio controls> <source src='{$row["file_url"]}' type='{$row["file_type"]}'></audio>";
                $subdata[] = $row['onCreate'];
                $subdata[] = ' <button onclick="deletebusiness(\"' . $row["id"] . '\",\"\")"  class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i> Delete</button>';
                $data[] = $subdata;
            }
            $json_data = array(
                "draw" => intval($request['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFilter),
                "data" => $data,
            );
            echo json_encode($json_data);
        } catch (Exception $ex) {
            error_log($ex, 3, "error.log");
        }
    }

}
