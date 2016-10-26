<?php

//NOTIFICATION MESSAGE GENERATION ....
if (!empty($_SESSION['success'])) {
    $success_msg = $_SESSION['success'];
    unset($_SESSION['success']);
} else {
    $success_msg = '';
}

if (isset($_SESSION['error'])) {
    $error_message = $_SESSION['error'];
    unset($_SESSION['error']);
} else {
    $error_message = '';
}


// FOLLOWING CODE WILL DELETE THE CATEGORY ....
if (!empty($_REQUEST['id']))
    $id = $_REQUEST['id'];
else
    $id = '';


// FOLLOWING CODE IS FOR FETCHING THE DATA OF CATEGORY

$use_list_sql = "SELECT * FROM grocery_details WHERE status = '1'";
$use_list_query = mysql_query($use_list_sql);

if ($use_list_query) {
    $use_list_rows = mysql_num_rows($use_list_query);
} else {
    $use_list_rows = 0;
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sql1 = "UPDATE grocery_details 
	          SET
			    status = '-1'
		     WHERE id = '" . $id . "'";
    $ret1 = mysql_query($sql1);


    $_SESSION['success'] = "Grocery item has been deleted successfully";
    echo '<script>window.location="' . SITE_URL . '/?page=grocery_lists&msg=deleted";</script>';
}


include('includes/header_after_login.php');
?>
<script type="text/javascript">
    try {
        ace.settings.check('breadcrumbs', 'fixed')
    } catch (e) {
    }
</script>


<script src="js/ajjquery.min.js"></script>
<script>
    $(document).ready(function () {
        $("#sele").on("change", function () {
            var id = $(this).val();
            // alert("Hiiii...");
            $.ajax({
                type: 'post',
                url: 'get_value_ajax.php',
                data: 'vval=' + id,
                success: function (data) {
                    if (data == 'YES') {
                        //$('#cust').html(data);
                        //$("#sele option:selected" ).text();
                        $('#cust').show();
                    } else if (data == 'NO') {
                        //$("#sele option:selected" ).text();
                        $('#cust').hide();
                    }
                }
            });

        });
    });

</script>
<!-- <script type="text/javascript">
function ShowHideDiv() {
var dd = document.getElementById("sele");
var dv = document.getElementById("cust");
dt.style.display = dd.value == "NO" ? "block" : "none";
}
</script>-->
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Grocery Item List
                    <small>
                        All Grocery List
                    </small>
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
<?php if (!empty($error_message)) { ?>
        <!-- BEGIN ERROR BOX -->
        <div class="alert alert-danger fade in" id="error">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $error_message; ?>
        </div>
        <!-- END ERROR BOX -->	
<?php } if (!empty($success_msg)) { ?>	
        <!-- BEGIN OF SUCCESS BOX -->
        <div class="alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Well done!</strong> <?php echo $success_msg; ?>.
        </div>									
        <!-- END OF SUCCESS BOX -->
<?php } ?>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div align="left"><a href="?page=add_grocery" title="Add New Grocery Item">&nbsp;<img src="images/add.png" height="25" width="25"/></a></div>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        </code>
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr role="row">
                                <th>SL.No.</th>
                                <th>Item Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
<?php
if ($use_list_rows > 0) {
    $c = 1;
    while ($col_list_array = mysql_fetch_assoc($use_list_query)) {
        ?>
                                    <tr>
                                        <td><?php echo $c++; ?></td>
                                        <td><?php echo $col_list_array['grocery_name']; ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-dark" title="Edit" href="?page=edit_grocery&id=<?php echo $col_list_array['id']; ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-dark" title="Delete" href="?page=grocery_lists&id=<?php echo $col_list_array['id']; ?>&action=delete" onclick="javascript:return confirm('Are you sure you want to delete this grocery item?');"><i class="fa fa-times-circle"></i></a>

                                        </td>
                                    </tr>
        <?php
    }
} else {
    ?>
                                <tr role="row">
                                    <td colspan=5>No grocery item added yet.</td>
                                </tr>
<?php }
?>
<!--                            <tr role="row">
                                <th>SL.No.</th>
                                <th>Bank Name</th>
                                <th>Branch Name</th>
                                <th>Account No</th>
                                <th>Balance</th>
                                <th>IFSC Code</th> 
                                <th>Action</th>
                            </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>   
</div>
</div>
<!-- /page content 
 <script src="js/bootstrap.min.js"></script>-->

<!-- bootstrap progress js 
<script src="js/progressbar/bootstrap-progressbar.min.js"></script>-->
<!-- icheck 
<script src="js/icheck/icheck.min.js"></script>

<script src="js/custom.js"></script>-->


<!-- Datatables -->
<!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
<script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

<!-- Datatables-->
<script src="js/datatables/jquery.dataTables.min.js"></script>
<script src="js/datatables/dataTables.bootstrap.js"></script>
<script src="js/datatables/dataTables.buttons.min.js"></script>
<script src="js/datatables/buttons.bootstrap.min.js"></script>
<script src="js/datatables/jszip.min.js"></script>
<script src="js/datatables/pdfmake.min.js"></script>
<script src="js/datatables/vfs_fonts.js"></script>
<script src="js/datatables/buttons.html5.min.js"></script>
<script src="js/datatables/buttons.print.min.js"></script>
<script src="js/datatables/dataTables.fixedHeader.min.js"></script>
<script src="js/datatables/dataTables.keyTable.min.js"></script>
<script src="js/datatables/dataTables.responsive.min.js"></script>
<script src="js/datatables/responsive.bootstrap.min.js"></script>
<script src="js/datatables/dataTables.scroller.min.js"></script>

<!-- pace -->
<script src="js/pace/pace.min.js"></script>
<script>
                                        var handleDataTableButtons = function () {
                                            "use strict";
                                            0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                                                dom: "Bfrtip",
                                                buttons: [{
                                                        extend: "copy",
                                                        className: "btn-sm"
                                                    }, {
                                                        extend: "csv",
                                                        className: "btn-sm"
                                                    }, {
                                                        extend: "excel",
                                                        className: "btn-sm"
                                                    }, {
                                                        extend: "pdf",
                                                        className: "btn-sm"
                                                    }, {
                                                        extend: "print",
                                                        className: "btn-sm"
                                                    }],
                                                responsive: !0
                                            })
                                        },
                                                TableManageButtons = function () {
                                                    "use strict";
                                                    return {
                                                        init: function () {
                                                            handleDataTableButtons()
                                                        }
                                                    }
                                                }();
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
            keys: true
        });
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });
    });
    TableManageButtons.init();
</script>



<?php include('includes/footer_after_login.php'); ?>
