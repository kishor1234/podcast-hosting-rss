<style>
    /*                            body {
                                    background: whitesmoke;
                                    font-family: 'Open Sans', sans-serif;
                                }
                                .container {
                                    max-width: 960px;
                                    margin: 30px auto;
                                    padding: 20px;
                                }*/
    .h1 {
        font-size: 20px;
        text-align: center;
        margin: 20px 0 20px;
    }
    .h1 small {
        display: block;
        font-size: 15px;
        padding-top: 8px;
        color: gray;
    }
    .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: 50px auto;
    }
    .avatar-upload .avatar-edit {
        position: absolute;
        right: 12px;
        z-index: 1;
        top: 10px;
    }
    .avatar-upload .avatar-edit input {
        display: none;
    }
    .avatar-upload .avatar-edit input + label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }
    .avatar-upload .avatar-edit input + label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }
    .avatar-upload .avatar-edit input + label:after {
        /*        content: "\f040";
                font-family: 'FontAwesome';*/
        color: #757575;
        position: absolute;
        top: 10px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }
    .avatar-upload .avatar-preview {
        width: 192px;
        height: 192px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }
    .avatar-upload .avatar-preview > div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    .label{
        font-size: 22px;
        text-align: center;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <?php
                        foreach ($link as $key => $val) {
                            echo "<li class=\"breadcrumb-item active\"><a href=\"{$val}\">$key</a></li>";
                        }
                        ?>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    $response = json_decode($main->jsonRespon(api_url . "/?r=userData", array("id" => $_SESSION["id"], "action" => "myprofile")), true);
                    //print_r($response);
                    ?>
                </div>
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-lg-3">
                            <div class="card card-gray">
                                <div class="card-header">
                                    <h6 class="card-title">Profile Picture</h6>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 offset-3">
                                            <div class="msg">
                                            </div>
                                            <div class="progress" id="progress">
                                                <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" id="inner-progress">Please wait....</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <form action="#" method="post" id="registerForm">
                                                <input type="hidden" name="email" id="email" value="<?= $main->encript->encTxt($_SESSION["email"]) ?>">
                                                <input type="hidden" name="id" id="id" value="<?= $main->encript->encTxt($_SESSION["id"]) ?>">

                                                <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                                <label for="imageUpload" class="label"><i class="fas fa-camera"></i></label>
                                            </form>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url(<?= $response["image_url"] ?>);">
                                            </div>
                                        </div>
                                        <!--                                        <div class="profile" id="center">
                                                                                    <img src="" class="profile-user-img img-radius50-profile" alt="User Image">
                                                                                </div>-->
                                        <div id="center">
                                            <h1 class="h1"><?= $response["name"] ?></h1>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card card-gray">
                                <div class="card-header">
                                    <h6 class="card-title">Profile</h6>
                                    <a href="#" onclick="clickOnLink('/?r=dashboard&v=VEditPersonal&id=<?= $_SESSION["id"] ?>', '#app-container', false)" style="float:right;"><i class="fa fa-pencil"></i> Edit Profile</a>
                                    <?php
                                    $personal = $response["personal"];
                                    //print_r($personal);
                                    ?>

                                </div>
                                <div class="card-body">
                                    <table class="table-borderless">
                                        <tr>
                                            <th>Full Name</th>
                                            <th>:</th>
                                            <td><?= $response["name"] ?></td>
                                        </tr>

                                        <tr>
                                            <th>Email</th>
                                            <th>:</th>
                                            <td><?= $response["email"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <th>:</th>
                                            <td><?= $response["title"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Link</th>
                                            <th>:</th>
                                            <td><?= $response["link"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Copyright</th>
                                            <th>:</th>
                                            <td><?= $response["cp"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <th>:</th>
                                            <td><?= $response["description"] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Categories</th>
                                            <th>:</th>
                                            <td><?= $response["categories"] ?></td>
                                        </tr>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<datalist id="ulist">

</datalist>
<!-- /.content-wrapper -->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function () {
        readURL(this);
        $("#registerForm").submit();
    });
    $("#registerForm").submit(function (e) {
        e.preventDefault();
        var formdata = new FormData($("#registerForm")[0]);
        $.ajax({
            type: 'POST',
            url: '<?= api_url ?>/?r=userUploadProfilePhoto',
            data: formdata,
            contentType: false,
            processData: false,
            xhr: function () {
                progressShow();
                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (e) {
                    var progressbar = Math.round((e.loaded / e.total) * 100);
                    $("#inner-progress").css('width', progressbar + '%');
                    $("#inner-progress").html("Please Wait... " + progressbar + '%');
                });
                return xhr;
            },
            success: function (data) {
                console.log(data);
                var json = JSON.parse(data);
                if (json.status === 1)
                {
                    $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});

                    //printMessage(obj.message, "success", ".msg");
                    $("#registerForm")[0].reset();
                    progressHide();
                    //window.location.replace("/");
                } else {
                    //printMessage(obj.message, "danger", ".msg");
                    $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});

                    $("#registerForm")[0].reset();
                    progressHide();
                }
            },
            error: function (request, status, error) {
                printMessage("Error on " + error, "danger", ".msg");
                $("#loginForm")[0].reset();
                progressHide()
            }
        });
    });
    function progressShow()
    {
        $("#btn_submit").attr("disabled", true);
        $("#progress").show();
    }
    function progressHide()
    {
        $("#btn_submit").attr("disabled", false);
        $("#progress").hide();
    }
    function printMessage(message, clas, display)
    {
        $(display).html("<div class='alert alert-dismissible alert-" + clas + "'><button type='button' class='close' data-dismiss='alert'>&times;</button>" + message + "</div>");
    }
</script>