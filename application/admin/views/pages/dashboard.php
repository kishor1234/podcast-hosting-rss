<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark breadcrumb"><?= $title ?></h1>
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
        #color-red{
            color: red;
        }
        #color-green{
            color:green;
        }
    </style>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title mb-2">
                                <!-- Button to Open the Modal -->
                                <button type="button" disabled="" class="btn btn-primary" onclick="clickOnLink('/?r=link&v=createpost', '#app-container', false)">
                                    Add New <i class="fas fa-plus"></i>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">


                            <div class="card-text">
                                <table class="stripe hover display responsive nowrap" id="myTable" cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th>Post ID</th>
                                            <th>Email</th>                                            
                                            <th>Name</th>
                                            <th>Comments</th>
                                            <th>Date</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Post ID</th>
                                            <th>Email</th>                                            
                                            <th>Name</th>
                                            <th>Comments</th>
                                            <th>Date</th>
                                            <th>Action</th>

                                        </tr>
                                    </tfoot>
                                </table>
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= $_SESSION["name"] ?> Replay Comment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" method="post" name="comment_form" id="comment_form">
                    <label>Message</label>
                    <textarea class="form-control" name="message" id="message" placeholder="Message here"></textarea>
                    <br>
                    <input type="hidden" name="name" value="<?= $_SESSION["name"] ?>">
                    <input type="hidden" name="email" value="<?= $_SESSION["email"] ?>">
                    <input type="hidden" name="comment_parent" id="id">
                    <input type="hidden" name="postid" id="postid">
                    <input type="hidden" name="isActive" value="1">
                    <input type="hidden" name="action" value="replaycomments">

                    <button class="btn btn-primary btn-sm">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- /.content-wrapper -->
<script type="text/javascript">
    var table;
    var edit;
    $(document).ready(function () {
        $("#comment_form").submit(function (e) {
            e.preventDefault();
            $("#submit").attr("disabled", true);
            var formdata = new FormData($("#comment_form")[0]);
            $.ajax({
                type: 'POST',
                url: '<?= api_url ?>/?r=userData',
                data: formdata,
                contentType: false,
                processData: false, xhr: function () {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (e) {
                        var progressbar = Math.round((e.loaded / e.total) * 100);
                    });
                    return xhr;
                },
                success: function (data) {
                    $("#submit").attr("disabled", false);
                    console.log(data);
                    var json = JSON.parse(data);
                    $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});
                    $("#comment_form")[0].reset();
                    table.ajax.reload(null, false);
                },
                error: function (request, status, error) {
                    //printMessage("Error on " + error, "danger", ".msg");
                    $("#comment_form")[0].reset();
                    //progressHide()
                }
            });
            console.log("Validation Success send form");

        });
        table = $('#myTable').DataTable({
            serverSide: true,
            Processing: true,
            order: [[0, "desc"]],
            ajax: {
                url: '<?= api_url ?>/?r=userData',
                type: "post", // method  , by default get
                dataType: "json",
                data: {action: "loadComments"},
                error: function () {  // error handling
                    $(".data-grid-error").html("");
                    $("#data-grid").append('<tbody class="data-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#data-grid_processing").css("display", "none");
                }
            },
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false
                }],
            lengthMenu: [[5, 25, 50, -1], [5, 25, 50, "All"]],
            language: {
                info: "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            }
        });


    });


    function approveComment(id, st)
    {
        swal({
            title: "Are you sure?",
            text: "want to Approve comment?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Approve it!",
            closeOnConfirm: true
        },
        function () {
            $.post('<?= api_url ?>/?r=userData', {id: id, st: st, action: 'approveComment', isActive: '1'}, function (data) {
                console.log(data);
                table.ajax.reload(null, false);
                var json = JSON.parse(data);
                $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});

            });

        });
    }
    function unapproveComment(id, st)
    {
        swal({
            title: "Are you sure?",
            text: "want to un-Approve comment?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, un-Approve it!",
            closeOnConfirm: true
        },
        function () {
            $.post('<?= api_url ?>/?r=userData', {id: id, st: st, action: 'approveComment', isActive: '0'}, function (data) {
                console.log(data);
                table.ajax.reload(null, false);
                var json = JSON.parse(data);
                $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});

            });

        });
    }
    function replayComment(id, postid)
    {
        $("#id").val(id);
        $("#postid").val(postid);
        $("#myModal").modal("show");

    }
</script>