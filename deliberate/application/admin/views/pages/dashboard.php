<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <?= $main->isLoadView(array("header" => "webheader", "main" => "banner", "footer" => "webfooter", "error" => "page_404"), false, array("title" => $title, "link" => $link)); ?>
    <!-- /.content-header -->
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
               
            </div>
            <div class="row">
                <style>
                    #center{
                        text-align: center;
                        margin-left: auto;
                        margin-right: auto;
                    }
                </style>
                <div class="col-8 offset-2">
                    <div id="center">
                        
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<div class="modal fade preview-modal" data-backdrop="" id="myMain" role="dialog" aria-labelledby="preview-modal" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Result Percentage</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="#" method="post" id="myMainResultPer">
                            <div class="form-group">
                                <label class="form-control-label">Result Percentage <span class="text-danger">*</span></label>
                                <input type="text" name="resultper" id="resultper" placeholder="Enter Message" title="Message" required autocomplete="off" class="form-control">
                                <span id="error_name" class=""></span>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="action" id="action" value="updateper">
                                <input type="hidden" id="id" name="id" value="<?= $_SESSION["id"] ?>">
                                <button class="btn btn-primary btn-sm form-control" id="myMainSubmitPer">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <br>
                <div class="progress" id="progress">
                    <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" id="inner-progress mainpro1">Please wait....</div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<script>
//    $("document").ready(function () {
//        //report();
//        $("#myMainResultPer").submit(function () {
//            $("#myMainSubmitPer").attr("disabled", true);
//            var formdata = new FormData($("#myMainResultPer")[0]);
//            $.ajax({
//                url: '<?= api_url ?>/?r=CAddUser',
//                type: 'post',
//                data: formdata,
//                enctype: "multipart/form-data",
//                contentType: false,
//                cache: false,
//                processData: false,
//                xhr: function () {
//                    $("#mainloadimg").show();
//                    $("#progress").show();
//                    var xhr = new XMLHttpRequest();
//                    xhr.upload.addEventListener('progress', function (e) {
//                        var progressbar = Math.round((e.loaded / e.total) * 100);
//                        $("#mainpro1").css('width', progressbar + '%');
//                        $("#mainpro1").html(progressbar + '%');
//                    });
//                    return xhr;
//                },
//                success: function (data) {
//                    console.log(data);
//                    $("#myMainSubmit").attr("disabled", false);
//                    $("#mainloadimg").hide();
//                    var json = JSON.parse(data);
//                    if (json.status === 1) {
//                        swal("Success", json.message, "success");
//
//
//                    } else {
//                        swal("Error", json.message, "error");
//                    }
//                    $('#myMainResultPer')[0].reset();
//                    $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});
//                    $("#mainpro1").css('width', '0%');
//                    $("#mainpro1").html('0%');
//                    $("#progress").hide();
//                    report();
//                },
//                error: function (xhr, error, code)
//                {
//                    console.log(xhr);
//                    console.log(code);
//                }
//            });
//            return false;
//        });
//    });
//    function report() {
//        $.post("<?= api_url ?>?r=CAddUser", {action: "adminBalance"}, function (data) {
//            console.log(data);
//            var js = JSON.parse(data);
//            $("#compaines").html(js[1]);
//            $("#colleges").html(js[0]);
//            $("#students").html(js[2]);
//            $("#exams").html(js[3]);
//            $("#per").html(js[4] + "%");
//        });
//    }
//    function ResultServices(id)
//    {
//        $.post("<?= api_url ?>?r=CStartorStop", {cron: id}, function (data) {
//            $("#center").html(data);
//        });
//    }
</script>
