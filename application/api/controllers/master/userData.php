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

class userData extends CAaskController {

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
            switch ($_POST["action"]) {
                case "loadTablePodcast":
                    $this->loadTablePodcast();
                    break;
                case "newPodcast":
                    $this->newPodcast();
                    break;
                case "editPodcast":
                    $this->editPodcast();
                    break;
                case "myprofile":
                    $array = $this->myprofile();

                    echo json_encode($array);
                    break;

                case "updatePersonal":
                    $this->updatePersonal();
                    break;
                case "delete":
                    $this->delete();
                    break;
                case "lastPost":
                    $this->lastPost();
                    break;
                case "SinglePost":
                    $this->SinglePost();
                    break;
                case "feeHead":
                    $this->feeHead();
                    break;
                case "feePost":
                    $this->feePost();
                    break;
                case "loadSubscriber":
                    $this->loadSubscriber();
                    break;
                case "ViewCount":
                    $this->ViewCount();
                    break;
                case "comments":
                    $this->comments();
                    break;
                case "loadComments":
                    $this->loadComments();
                    break;
                case "replaycomments":
                    $this->replaycomments();
                    break;
                case "approveComment":
                    $this->approveComment();
                    break;
                case "AllPost":
                    $this->AllPost();
                    break;
                case "SinglePostEdit":
                    $this->SinglePostEdit();
                    break;
                default :
                    //$this->lastPost();
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

    function feePost() {
        $sql = $this->ask_mysqli->select("post", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("userid" => $_POST["userid"])); // . $this->ask_mysqli->orderBy("DESC", "postid") . $this->ask_mysqli->limitwithoutoffset($_POST["limit"]);
        $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
        $array = array();
        while ($row = $result->fetch_assoc()) {
            array_push($array, $row);
        }
        echo json_encode($array);
    }

    function feeHead() {
        $sql = $this->ask_mysqli->select("user", $_SESSION["db_1"]);
        $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
        $array = array();
        if ($row = $result->fetch_assoc()) {
            echo json_encode($row);
        }
    }

    function lastPost() {

        $sql = $this->ask_mysqli->select("post", $_SESSION["db_1"]) . $this->ask_mysqli->orderBy("DESC", "postid") . $this->ask_mysqli->limitwithoutoffset($_POST["limit"]);
        $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
        $array = array();
        while ($row = $result->fetch_assoc()) {
            array_push($array, $row);
        }
        echo json_encode($array);
    }

    function approveComment() {
        $error = array();
        $this->adminDB[$_SESSION["db_1"]]->autocommit(false);
        if (isset($_POST)) {
            unset($_POST["action"]);
            $sql = $this->ask_mysqli->update(array("isActive" => $_POST["isActive"]), "comment") . $this->ask_mysqli->whereSingle(array("id" => $this->filterPost("id")));
            $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, "Error CT ", $this->adminDB[$_SESSION["db_1"]]->error) : true;
        } else {
            array_push($error, "invalid post");
        }
        if (empty($error)) {
            $this->adminDB[$_SESSION["db_1"]]->commit();
            echo json_encode(array("toast" => array("success", "Post Comment ", "Success....."), "status" => 1, "message" => "Success"));
        } else {
            $this->adminDB[$_SESSION["db_1"]]->rolback();
            echo json_encode(array("toast" => array("danger", "Post Comment", "Failed..... " . $error), "status" => 0, "message" => "Failed " . $error));
        }
    }

    function replaycomments() {
        $error = array();
        $this->adminDB[$_SESSION["db_1"]]->autocommit(false);
        if (isset($_POST)) {
            unset($_POST["action"]);
            $data = array_merge($_POST, array("ip" => $_SERVER["REMOTE_ADDR"]));
            $sql = $this->ask_mysqli->insert("comment", $data);
            $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, "Error ", $this->adminDB[$_SESSION["db_1"]]->error) : true;
            $tid = $this->adminDB[$_SESSION["db_1"]]->insert_id;
            $sql = $this->ask_mysqli->updateINC(array("comments" => 1), "post") . $this->ask_mysqli->whereSingle(array("postid" => $this->filterPost("postid")));
            $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, "Error CT ", $this->adminDB[$_SESSION["db_1"]]->error) : true;
        } else {
            array_push($error, "invalid post");
        }
        if (empty($error)) {
            $this->adminDB[$_SESSION["db_1"]]->commit();
            echo json_encode(array("toast" => array("success", "Post Comment ", "Success....."), "status" => 1, "message" => "Success"));
        } else {
            $this->adminDB[$_SESSION["db_1"]]->rolback();
            echo json_encode(array("toast" => array("danger", "Post Comment", "Failed..... " . $error), "status" => 0, "message" => "Failed " . $error));
        }
    }

    function comments() {
        $error = array();
        $this->adminDB[$_SESSION["db_1"]]->autocommit(false);
        if (isset($_POST)) {
            unset($_POST["action"]);
            $data = array_merge($_POST, array("ip" => $_SERVER["REMOTE_ADDR"]));
            $sql = $this->ask_mysqli->insert("comment", $data);
            $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, "Error ", $this->adminDB[$_SESSION["db_1"]]->error) : true;
            $tid = $this->adminDB[$_SESSION["db_1"]]->insert_id;
            $sql = $this->ask_mysqli->updateINC(array("comments" => 1), "post") . $this->ask_mysqli->whereSingle(array("postid" => $this->filterPost("postid")));
            $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, "Error CT ", $this->adminDB[$_SESSION["db_1"]]->error) : true;
        } else {
            array_push($error, "invalid post");
        }
        if (empty($error)) {
            $this->adminDB[$_SESSION["db_1"]]->commit();
            echo json_encode(array("toast" => array("success", "Post Comment ", "Success....."), "status" => 1, "message" => "Success"));
        } else {
            $this->adminDB[$_SESSION["db_1"]]->rolback();
            echo json_encode(array("toast" => array("danger", "Post Comment", "Failed..... " . $error), "status" => 0, "message" => "Failed " . $error));
        }
    }

    function ViewCount() {
        $sql = $this->ask_mysqli->updateINC(array("likes" => 1), "post") . $this->ask_mysqli->whereSingle(array("title" => $_POST["title"]));
        echo json_encode(array($sql));
        $this->adminDB[$_SESSION["db_1"]]->query($sql);
    }

    function AllPost() {
        $sql = $this->ask_mysqli->select("post", $_SESSION["db_1"]) . $this->ask_mysqli->orderBy("DESC", "postid");
        if (empty($_POST["tags"])) {
            $sql = $this->ask_mysqli->select("post", $_SESSION["db_1"]) . $this->ask_mysqli->orderBy("DESC", "postid");
        } else {
            $sql = $this->ask_mysqli->select("post", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingleLike(array("tags" => $_POST["tags"])) . $this->ask_mysqli->orderBy("DESC", "postid");
        }
        $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
            $sql = $this->ask_mysqli->select("comment", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("postid" => $row["postid"])) . $this->ask_mysqli->orderBy("DESC", "postid") . $this->ask_mysqli->limitwithoutoffset(10);
        }
        echo json_encode($data);
    }

    function SinglePost() {

        $sql = $this->ask_mysqli->select("post", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("title" => $_POST["title"])) . $this->ask_mysqli->orderBy("DESC", "postid") . $this->ask_mysqli->limitwithoutoffset($_POST["limit"]);
        $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
        $array = array();
        if ($row = $result->fetch_assoc()) {
            $data = $row;
            $sql = $this->ask_mysqli->select("comment", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("postid" => $row["postid"])) . $this->ask_mysqli->orderBy("DESC", "postid") . $this->ask_mysqli->limitwithoutoffset(10);
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            $comment = array();
            while ($row = $result->fetch_assoc()) {
                array_push($comment, $row);
            }
            $data["comment"] = $comment;
            echo json_encode($data);
        }
        // echo json_encode($array);
    }

    function SinglePostEdit() {

        $sql = $this->ask_mysqli->select("post", $_SESSION["db_1"]) . $this->ask_mysqli->where(array("postid" => $_POST["postid"], "userid" => $_POST["userid"]), "AND") . $this->ask_mysqli->limitwithoutoffset(1);
        $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
        $array = array();
        if ($row = $result->fetch_assoc()) {
            $data = $row;

            echo json_encode($data);
        }
        // echo json_encode($array);
    }

    function delete() {
        $sql = $this->ask_mysqli->select("post", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("postid" => $_POST["id"]));
        $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
        $this->adminDB[$_SESSION["db_1"]]->autocommit(false);
        if ($row = $result->fetch_assoc()) {
            $sql = $this->ask_mysqli->select("filesystem", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("id" => $_POST["file_id"]));
            $resultFile = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            $rowFile = $resultFile->fetch_assoc();
            unlink($rowFile["path"]);
            $this->adminDB[$_SESSION["db_1"]]->query($this->ask_mysqli->delete("filesystem") . $this->ask_mysqli->whereSingle(array("id" => $row["file_id"]))) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
            $sql = $this->ask_mysqli->select("filesystem", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("id" => $_POST["image_id"]));
            $resultFile = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            $rowFile = $resultFile->fetch_assoc();
            unlink($rowFile["path"]);
            $this->adminDB[$_SESSION["db_1"]]->query($this->ask_mysqli->delete("filesystem") . $this->ask_mysqli->whereSingle(array("id" => $row["image_id"]))) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
            $sql = $this->ask_mysqli->select("filesystem", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("id" => $_POST["banner_id"]));
            $resultFile = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            $rowFile = $resultFile->fetch_assoc();
            unlink($rowFile["path"]);
            $this->adminDB[$_SESSION["db_1"]]->query($this->ask_mysqli->delete("filesystem") . $this->ask_mysqli->whereSingle(array("id" => $row["banner_id"]))) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;

            $this->adminDB[$_SESSION["db_1"]]->query($this->ask_mysqli->delete("post") . $this->ask_mysqli->whereSingle(array("postid" => $row["postid"]))) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
            if (empty($error)) {
                $this->adminDB[$_SESSION["db_1"]]->commit();
                echo json_encode(array("toast" => array("success", "Podcast", "Delete Success....."), "status" => 1, "message" => "Delete Success"));
            } else {
                $this->adminDB[$_SESSION["db_1"]]->rolback();
                echo json_encode(array("toast" => array("danger", "Podcast", "Delete Failed..... " . $this->adminDB[$_SESSION["db_1"]]->error), "status" => 0, "message" => "Delete Failed " . $this->adminDB[$_SESSION["db_1"]]->error));
            }
        } else {
            $this->adminDB[$_SESSION["db_1"]]->rolback();
            echo json_encode(array("toast" => array("danger", "Podcast", "Delete Failed..... " . $this->adminDB[$_SESSION["db_1"]]->error), "status" => 0, "message" => "Delete Failed " . $this->adminDB[$_SESSION["db_1"]]->error));
        }
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
        $data["banner_id"] = $bannerid;
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

    function editPodcast() {
        $this->cors();
        $data = array();
        $this->adminDB[$_SESSION["db_1"]]->autocommit(FALSE);
        $error = array();
//        $data["userid"] = $_POST["userid"];
//        $data["name"] = $_POST["name"];
//        $data["email"] = $_POST["email"];
        $data["title"] = $_POST["title"];
        $data["tags"] = $_POST["tags"];
        $data["ip"] = $_SERVER["REMOTE_HOST"];
        $data["description"] = $_POST["description"];
        $data["categories"] = $_POST["categories"];
        if (!empty($_FILES["image"]["name"])) {
            $uploadDir = "assets/upload/profile";
            $imageData = $this->uploadFiletoFileSystem('image', $uploadDir);
            //print_r($imageData);
            $sql = $this->ask_mysqli->insert("filesystem", $imageData);
            $this->adminDB[$_SESSION["db_1"]]->query($sql) == true ? true : array_push($error, "fileSystem query error image " . $this->adminDB[$_SESSION["db_1"]]->error);
            $imageid = $this->adminDB[$_SESSION["db_1"]]->insert_id;
            $data["image_id"] = $imageid;
            $data["image_url"] = $imageData["url"];
        }
        //upload banner
        if (!empty($_FILES["banner"]["name"])) {
            $bannerData = $this->uploadFiletoFileSystem('banner', $uploadDir);
            //print_r($bannerData);
            $sql = $this->ask_mysqli->insert("filesystem", $bannerData);
            $this->adminDB[$_SESSION["db_1"]]->query($sql) == true ? true : array_push($error, "fileSystem query error banner " . $this->adminDB[$_SESSION["db_1"]]->error);
            $bannerid = $this->adminDB[$_SESSION["db_1"]]->insert_id;
            $data["banner_url"] = $bannerData["url"];
            $data["banner_id"] = $bannerid;
        }
        //upload file
        if (!empty($_FILES["file"]["name"])) {
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
        }
        //insertd post
        $sql = $this->ask_mysqli->update($data, "post") . $this->ask_mysqli->whereSingle(array("postid" => $_POST["postid"]));
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

    function loadComments() {
        try {
            $request = $_REQUEST;
            $col = array(
                0 => 'id',
                1 => 'postid',
                2 => 'email',
                3 => 'name',
                4 => 'message'
            );
            $sql = $this->ask_mysqli->select("comment", $_SESSION["db_1"]);
            //$sql .=$this->ask_mysqli->whereSingle(array("userid" => $_POST["id"]));
            $query = $this->executeQuery($_SESSION["db_1"], $sql);
            $totalData = $query->num_rows;
            $totalFilter = $totalData;
            // $sql .=$this->ask_mysqli->whereSingle(array("1" => "1"));
            /* Search */
            if (!empty($request['search']['value'])) {
                $sql.=" AND (id Like '%" . $request['search']['value'] . "%'";
                $sql.=" OR name Like '%" . $request['search']['value'] . "%' ";
                $sql.=" OR email Like '%" . $request['search']['value'] . "%' )";
            }
            /* Order */
            $sql.=$this->ask_mysqli->orderBy($request['order'][0]['dir'], $col[$request['order'][0]['column']]) . $this->ask_mysqli->limitWithOffset($request['start'], $request['length']);
            $query = $this->executeQuery($_SESSION["db_1"], $sql);
            $totalData = $query->num_rows;
            while ($row = $query->fetch_assoc()) {
                $subdata = array();
                $subdata[] = $row['postid'];
                $subdata[] = $row['email'];
                $subdata[] = $row['name'];
                $subdata[] = $row['message'];
                $subdata[] = $row['isDate'];
                if ($row["isActive"] == 1) {
                    $active = '<button onclick="unapproveComment(' . $row["id"] . ',0)" class="btn btn-danger btn-xs"> <i class="fa fa-thumbs-down"></i> </button> &nbsp;';
                } else {
                    $active = '<button onclick="approveComment(' . $row["id"] . ',0)" class="btn btn-success btn-xs"> <i class="fa fa-thumbs-up"></i> </button> &nbsp;';
                }
                $active .= '<button onclick="replayComment(' . $row["id"] . ',' . $row["postid"] . ')" class="btn btn-primary btn-xs"> <i class="fa fa-reply"></i> </button>';

                $subdata[] = $active;
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

    function loadSubscriber() {
        try {
            $request = $_REQUEST;
            $col = array(
                0 => 'id',
                1 => 'email',
                2 => 'ip',
                3 => 'isDate'
            );
            $sql = $this->ask_mysqli->select("newsletter", $_SESSION["db_1"]);
            //$sql .=$this->ask_mysqli->whereSingle(array("userid" => $_POST["id"]));
            $query = $this->executeQuery($_SESSION["db_1"], $sql);
            $totalData = $query->num_rows;
            $totalFilter = $totalData;
            // $sql .=$this->ask_mysqli->whereSingle(array("1" => "1"));
            /* Search */
            if (!empty($request['search']['value'])) {
                $sql.=" AND (id Like '%" . $request['search']['value'] . "%'";
                $sql.=" OR ip Like '%" . $request['search']['value'] . "%' ";
                $sql.=" OR email Like '%" . $request['search']['value'] . "%' )";
            }
            /* Order */
            $sql.=$this->ask_mysqli->orderBy($request['order'][0]['dir'], $col[$request['order'][0]['column']]) . $this->ask_mysqli->limitWithOffset($request['start'], $request['length']);
            $query = $this->executeQuery($_SESSION["db_1"], $sql);
            $totalData = $query->num_rows;
            while ($row = $query->fetch_assoc()) {
                $subdata = array();
                $subdata[] = $row['id'];
                $subdata[] = $row['email'];
                $subdata[] = $row['ip'];
                $subdata[] = $row['isDate'];
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

    function loadTablePodcast() {
        try {
            $request = $_REQUEST;
            $col = array(
                0 => 'id',
                1 => 'title',
                2 => 'email',
                3 => 'image_url',
                4 => 'file_url',
                5 => 'onCreate',
                6 => 'action'
            );
            $sql = $this->ask_mysqli->select("post", $_SESSION["db_1"]);
            $sql .=$this->ask_mysqli->whereSingle(array("userid" => $_POST["id"]));
            $query = $this->executeQuery($_SESSION["db_1"], $sql);
            $totalData = $query->num_rows;
            $totalFilter = $totalData;
            // $sql .=$this->ask_mysqli->whereSingle(array("1" => "1"));
            /* Search */
            if (!empty($request['search']['value'])) {
                $sql.=" AND (email Like '%" . $request['search']['value'] . "%'";
                $sql.=" OR title Like '%" . $request['search']['value'] . "%' ";
                $sql.=" OR name Like '%" . $request['search']['value'] . "%' ";
                $sql.=" OR tags Like '%" . $request['search']['value'] . "%' ";
                $sql.=" OR description Like '%" . $request['search']['value'] . "%' )";
            }
            /* Order */
            //$sql.=$this->ask_mysqli->orderBy($request['order'][0]['dir'], $col[$request['order'][0]['column']]) . $this->ask_mysqli->limitWithOffset($request['start'], $request['length']);
            $query = $this->executeQuery($_SESSION["db_1"], $sql);
            $totalData = $query->num_rows;
            while ($row = $query->fetch_assoc()) {
                $subdata = array();
                $subdata[] = $row['postid'];
                $subdata[] = $row['title'];
                $subdata[] = $row['email'];
                $subdata[] = "<img src='{$row["image_url"]}' alt='image' style='widht:50px; height:50px;'>";
                $subdata[] = "<audio controls> <source src='{$row["file_url"]}' type='{$row["file_type"]}'></audio>";
                $subdata[] = $row['onCreate'];
                $active = '<button onclick="deletebusiness(' . $row["postid"] . ',0)" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i></button>';
                $subdata[] = $active . ' <button onclick="clickOnLink(\'/?r=dashboard&v=editpost&id=' . $row["postid"] . '\', \'#app-container\', false)" class="btn btn-warning btn-xs"> <i class="fa fa-edit"></i></button>';
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
