
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
    <style>
        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;

        }

    </style>
    <?php
    $response = json_decode($main->jsonRespon(api_url . "/?r=userData", array("id" => $_SESSION["id"], "action" => "myprofile")), true);
    //$persola = $response["personal"];
    ?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-10 offset-lg-1 col-sm-12 col-xs-12">

                    <div class="card card-gray">
                        <div class="card-header">
                            <h6 class="card-title">Post Podcast</h6>
                        </div>
                        <div class="card-body">
                            <form action="#" method="post" name="registerForm" id="registerForm" enctype="multipart/form-data"> 
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <label class="form-control-label"> Podcast Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"  required name="title" id="title" autocomplete="off" title="Podcast profile title" placeholder="Podcast profile title">
                                        <div class="input-group-append">
                                            <span id="error_title">

                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-control-label"> Description <span class="text-danger">*</span></label>
                                        <textarea  class="form-control"  required name="description" id="description" autocomplete="off" title="Description" placeholder="Description"></textarea>
                                        <div class="input-group-append">
                                            <span id="error_desctiption">

                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-control-label"> Podcast Image <span class="text-danger">*</span></label>
                                        <input type="file"  class="form-control"  required name="image" id="image" accept="image/*" capture autocomplete="off" title="Image File for Podcast" placeholder="Image File for Podcast">
                                        <div class="input-group-append">
                                            <span id="error_image">

                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-control-label"> Podcast Banner Image <span class="text-danger">*</span></label>
                                        <input type="file"  class="form-control"  required name="banner" id="banner" accept="image/*"  autocomplete="off" title="Banner File for Podcast" placeholder="Banner File for Podcast">
                                        <div class="input-group-append">
                                            <span id="error_image">

                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-control-label"> Podcast Audio File <span class="text-danger">*</span></label>
                                        <input type="file"  class="form-control"  required name="file" id="file" accept="audio/*" capture  autocomplete="off" title="Audio File for Podcast" placeholder="Audio File for Podcast">
                                        <div class="input-group-append">
                                            <span id="error_file">

                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <label class="form-control-label"> Categories <span class="text-danger">*</span></label>
                                        <input type="text" value="<?= $response["categories"] ?>" class="form-control"  required name="categories" id="categories" autocomplete="off" title="Type and select categories" placeholder="Type and select categories">
                                        <div class="input-group-append">
                                            <span id="error_categories">

                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-control-label"> Tags <span class="text-danger">*</span></label>
                                        <input type="text"  class="form-control"  required name="tags" id="tags" autocomplete="off" title="Podcast tags" placeholder="Podcast tags">
                                        <div class="input-group-append">
                                            <span id="error_fn">

                                            </span>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group mb-3">
                                    <div class="progress" id="progress">
                                        <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" id="inner-progress">Please wait....</div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">


                                    <input type="hidden"  value="<?= $_SERVER["REMOTE_ADDR"] ?>" name="ip">
                                    <input type="hidden"  value="newPodcast" name="action">
                                    <input type="hidden" value="<?= $response["id"] ?>" name="userid">
                                    <input type="hidden" value="<?= $response["name"] ?>" name="name">
                                    <input type="hidden" value="<?= $response["email"] ?>" name="email">

                                    <div class="msg">

                                    </div>
                                    <button class="btn btn-primary form-control bg-white">Create PodCast </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script>
    $("document").ready(function () {


        $("#registerForm").submit(function (e) {
            e.preventDefault();
            swal({
                title: "Please check all details filled is corrent,",
                text: "this podcast not editable",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, Post it!",
                closeOnConfirm: true
            },
            function () {
                if (checkForm())
                {
                    var formdata = new FormData($("#registerForm")[0]);
                    $.ajax({
                        type: 'POST',
                        url: '<?= api_url ?>/?r=userData',
                        data: formdata,
                        contentType: false,
                        processData: false, xhr: function () {
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
                            var obj = JSON.parse(data);
                            if (obj.status === 1)
                            {
                                //printMessage(obj.message, "success", ".msg");
                                //$("#registerForm")[0].reset();
                                progressHide();
                                //window.location.replace("/");
                            } else {
                                //printMessage(obj.message, "danger", ".msg");
                                $("#registerForm")[0].reset();
                                progressHide();
                            }
                            var json = JSON.parse(data);
                            $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});

                        },
                        error: function (request, status, error) {
                            printMessage("Error on " + error, "danger", ".msg");
                            $("#loginForm")[0].reset();
                            progressHide()
                        }
                    });
                    console.log("Validation Success send form");
                    return true;
                } else {
                    console.log("Validation Failed");
                    return false;
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

        function checkForm() {
            return true;
        }
        $("#pwd").keyup(function () {
            checkPassword();
        });
        $("#mobile").keypress(function (event) {
            $("#mobile").attr("maxlength", "10");
            return checkMobile(event);
        });
        $("#location").keypress(function () {
            return location();
        });
        $("#name").keypress(function (event) {
            return fullName(event);
        });
        $("#middlename").keydown(function (event) {
            // $("#firstname").attr("onkeyup","validateFirstName(event)");
            return validateMiddleName(event);

        });
        $("#lastname").keydown(function (event) {
            // $("#firstname").attr("onkeyup","validateFirstName(event)");
            return validateLastName(event);

        });

        $("#firstname").keydown(function (event) {
            // $("#firstname").attr("onkeyup","validateFirstName(event)");
            return validateFirstName(event);

        });
        $("#dob").blur(function () {
            validateDOB();
        });
        $("#gender").blur(function () {
            validateGender();
        });
        $("#address").blur(function () {
            validateAddress();
        });
        $("#dist").keydown(function (event) {
            return validateDist(event);
        });
        $("#city").keydown(function (event) {
            return validateCity(event);
        });
        $("#state").keydown(function (event) {
            return validateState(event);
        });
        $("#pin").keydown(function (event) {
            $("#pin").attr("maxlength", "6");
            return validatePin(event);
        });
        function validatePin(e) {
            var firstname = $("#pin").val();
            if (firstname === "")
            {
                msg('#pin', "#error_pin", false, "PIN  required.. Alphabets, Symbol is not allowd");
                return isNumber('#pin', "#error_pin", "PIN  required.. Alphabets, Symbol is not allowd", "", e);
            } else {
                msg('#pin', "#error_pin", true, "");
                return isNumber('#pin', "#error_pin", "PIN  required.. Alphabets, Symbol is not allowd", "", e);
            }
        }
        function validateState(e) {
            var firstname = $("#state").val();
            if (firstname === "")
            {
                msg('#state', "#error_state", false, "State name required.. Number, Symbol is not allowd");
            }
            return onlyAlp('#state', "#error_state", "State name required.. Number, Symbol is not allowd", "", e);
        }
        function validateCity(e) {
            var firstname = $("#city").val();
            if (firstname === "")
            {
                msg('#city', "#error_city", false, "City name required.. Number, Symbol is not allowd");
            }
            return onlyAlp('#city', "#error_city", "City name required.. Number, Symbol is not allowd", "", e);
        }
        function validateDist(e) {
            var firstname = $("#dist").val();
            if (firstname === "")
            {
                msg('#dist', "#error_dist", false, "District name required.. Number, Symbol is not allowd");
            }
            return onlyAlp('#dist', "#error_dist", "District name required.. Number, Symbol is not allowd", "", e);
        }
        function validateAddress()
        {
            var dob = $("#address").val();
            if (dob === "")
            {
                msg('#address', "#error_address", false, "Address is required..");
            } else {
                msg('#address', "#error_address", true, "");
            }
        }
        function validateGender()
        {
            var dob = $("#gender").val();
            if (dob === "")
            {
                msg('#gender', "#error_gender", false, "Gender is required..");
            } else {
                msg('#gender', "#error_gender", true, "");
            }
        }
        function validateDOB()
        {
            var dob = $("#dob").val();
            if (dob === "")
            {
                msg('#dob', "#error_dob", false, "Date of Birth required..");
            } else {
                msg('#dob', "#error_dob", true, "");
            }
        }

        function validateFirstName(e)
        {
            var firstname = $("#firstname").val();
            if (firstname === "")
            {
                msg('#firstname', "#error_fn", false, "first name required.. Number, Symbol is not allowd");
            }
            return onlyAlp('#firstname', "#error_fn", "first name required.. Number, Symbol is not allowd", "", e);

        }
        function validateMiddleName(e)
        {
            var firstname = $("#middlename").val();
            if (firstname === "")
            {
                msg('#middlename', "#error_mn", false, "middle name required.. Number, Symbol is not allowd");
            }
            return onlyAlp('#middlename', "#error_mn", "middle name required.. Number, Symbol is not allowd", "", e);

        }
        function validateLastName(e)
        {
            var firstname = $("#lastname").val();
            if (firstname === "")
            {
                msg('#lastname', "#error_ln", false, "last name required.. Number, Symbol is not allowd");
            }
            return onlyAlp('#lastname', "#error_ln", "last name required.. Number, Symbol is not allowd", "", e);
        }
        function msg(base, error, hide, html)
        {
            if (!hide)
            {
                $(base).addClass("is-invalid");
                $(base).removeClass("is-valid");
                $(error).removeClass("valid-feedback");
                $(error).addClass("invalid-feedback");
                $(error).show();
                $(error).html(html);
            } else {
                $(base).removeClass("is-invalid");
                $(base).addClass("is-valid");
                $(error).removeClass("invalid-feedback");
                $(error).addClass("valid-feedback");
                $(error).show();
                $(error).html(html);
            }
        }
        function isNumber(base, error, ehtml, shtml, evt) {
//            evt = (evt) ? evt : window.event;
//            var charCode = (evt.which) ? evt.which : evt.keyCode;
//            console.log(charCode);
//            if ((charCode < 7 || charCode > 10)&& charCode > 31 && (charCode < 48 || charCode > 57)) {
//                msg(base, error, true, shtml);
//                return true;
//            }
            //            msg(base, error, false, ehtml);
            //            return false;
        }
        function onlyAlp(base, error, ehtml, shtml, e)
        {
            if (window.event) {
                var charCode = window.event.keyCode;
            } else if (e) {
                var charCode = e.which;
            } else {
                msg(base, error, true, shtml);
                return true;
            }

            if (charCode == 8 || charCode == 9 || (charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
            {
                msg(base, error, true, shtml);

                return true;
            } else {
                msg(base, error, false, ehtml);
                return false;
            }
        }
        function fullName(e)
        {
            if (window.event) {
                var charCode = window.event.keyCode;
            } else if (e) {
                var charCode = e.which;
            } else {
                $("#name").removeClass("is-invalid");
                $("#name").addClass("is-valid");
                $("#error_n").removeClass("invalid-feedback");
                $("#error_n").addClass("valid-feedback");
                $("#error_n").show();
                $("#error_n").html("");
                return true;
            }
            if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32)
            {
                $("#name").removeClass("is-invalid");
                $("#name").addClass("is-valid");
                $("#error_n").removeClass("invalid-feedback");
                $("#error_n").addClass("valid-feedback");
                $("#error_n").show();
                $("#error_n").html("");
                return true;
            }
            else
            {
                $("#name").addClass("is-invalid");
                $("#name").removeClass("is-valid");
                $("#error_n").removeClass("valid-feedback");
                $("#error_n").addClass("invalid-feedback");
                $("#error_n").show();
                $("#error_n").html("Full name does not have spechial charactor or number");
                return false;
            }
        }
        function checkMobile(evt) {

            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;

            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                $("#mobile").addClass("is-invalid");
                $("#mobile").removeClass("is-valid");
                $("#error_m").removeClass("valid-feedback");
                $("#error_m").addClass("invalid-feedback");
                $("#error_m").show();
                $("#error_m").html("Alphabet not allowed.");
                return false;
            }
            $("#mobile").removeClass("is-invalid");
            $("#mobile").addClass("is-valid");
            $("#error_m").removeClass("invalid-feedback");
            $("#error_m").addClass("valid-feedback");
            $("#error_m").show();
            $("#error_m").html("");
            return true;
        }
        function checkPassword()
        {
            var pwd = $("#pwd").val();
            var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            if (!re.test(pwd)) {
                $("#pwd").addClass("is-invalid");
                $("#pwd").removeClass("is-valid");
                $("#error_c").removeClass("valid-feedback");
                $("#error_c").addClass("invalid-feedback");
                $("#error_c").show();
                $("#error_c").html("at least one number, one lowercase and one uppercase letter and minimum 8 characters");
                return false;
            } else {
                $("#pwd").removeClass("is-invalid");
                $("#pwd").addClass("is-valid");
                $("#error_c").removeClass("invalid-feedback");
                $("#error_c").addClass("valid-feedback");
                $("#error_c").show();
                $("#error_c").html("Success..!");
                return true;
            }
        }
        function location(e)
        {
            if (window.event) {
                var charCode = window.event.keyCode;
            } else if (e) {
                var charCode = e.which;
            } else {
                $("#location").removeClass("is-invalid");
                $("#location").addClass("is-valid");
                $("#error_l").removeClass("invalid-feedback");
                $("#error_l").addClass("valid-feedback");
                $("#error_l").show();
                $("#error_l").html("SAuccess..!");

                return true;
            }
            if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
            {
                $("#location").removeClass("is-invalid");
                $("#location").addClass("is-valid");
                $("#error_l").removeClass("invalid-feedback");
                $("#error_l").addClass("valid-feedback");
                $("#error_l").show();
                $("#error_l").html("Success..!");
                return true;
            } else {
                $("#location").addClass("is-invalid");
                $("#location").removeClass("is-valid");
                $("#error_l").removeClass("valid-feedback");
                $("#error_l").addClass("invalid-feedback");
                $("#error_l").show();
                $("#error_l").html("Number not allowed..");
                return false;
            }
        }

    });
    function printMessage(message, clas, display)
    {
        $(display).html("<div class='alert alert-dismissible alert-" + clas + "'><button type='button' class='close' data-dismiss='alert'>&times;</button>" + message + "</div>");
    }
</script>