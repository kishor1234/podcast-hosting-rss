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
                                <button type="button" class="btn btn-primary" onclick="clickOnLink('/?r=link&v=createpost', '#app-container', false)">
                                    Add New <i class="fas fa-plus"></i>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            $response = json_decode($main->jsonRespon(api_url . "/?r=userData", array("action" => "loadTablePodcast", "id" => $_SESSION["id"])), true);
                           // print_r($response["data"]);
                            ?>

                            <div class="card-text">
                                <table class="stripe hover display responsive nowrap" id="myTable" cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>                                            
                                            <th>Email</th>
                                            <th>Image</th>
                                            <th>Audio</th>
                                            <th>Date</th>
                                            <th class="datatable-nosort">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($response["data"] as $ke => $val) {
                                            echo "<tr>";
                                            echo "<td>" . $val[0] . "</td>";
                                            echo "<td>" . $val[1] . "</td>";
                                            echo "<td>" . $val[2] . "</td>";
                                            echo "<td>" . $val[3] . "</td>";
                                            echo "<td>" . $val[4] . "</td>";
                                            echo "<td>" . $val[5] . "</td>";
                                            echo "<td>" . $val[6] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        forea
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>                                            
                                            <th>Email</th>
                                            <th>Image</th>
                                            <th>Audio</th>
                                            <th>Date</th>
                                            <th class="datatable-nosort">Action</th>

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
<datalist id="slist">

</datalist>
<!-- /.content-wrapper -->
<script type="text/javascript">
    var table;
    var edit;
    $(document).ready(function () {
        $('table').DataTable();
    });

    $(document).ready(function () {

//        table = $('#myTable').DataTable({
//            serverSide: true,
//            Processing: true,
//            order: [[0, "desc"]],
//            ajax: {
//                url: '<?= api_url ?>/?r=userData',
//                type: "post", // method  , by default get
//                dataType: "json",
//                data: {action: "loadTablePodcast", id:<?= $_SESSION["id"] ?>},
//                error: function () {  // error handling
//                    $(".data-grid-error").html("");
//                    $("#data-grid").append('<tbody class="data-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
//                    $("#data-grid_processing").css("display", "none");
//                }
//            },
//            scrollCollapse: true,
//            autoWidth: false,
//            responsive: true,
//            columnDefs: [{
//                    targets: "datatable-nosort",
//                    orderable: false
//                }],
//            lengthMenu: [[1, 25, 50, -1], [1, 25, 50, "All"]],
//            language: {
//                info: "_START_-_END_ of _TOTAL_ entries",
//                searchPlaceholder: "Search"
//            }
//        });


    });


    function deletebusiness(id, st)
    {
        swal({
            title: "Are you sure?",
            text: "want to delete PodCast?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Delete it!",
            closeOnConfirm: true
        },
        function () {
            $.post('<?= api_url ?>/?r=userData', {id: id, st: st, action: 'delete'}, function (data) {
                console.log(data);
                table.ajax.reload(null, false);
                var json = JSON.parse(data);
                $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});

            });

        });
    }

</script>