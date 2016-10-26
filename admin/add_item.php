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


//FOLLOWING CODE WILL ADD THE CUSTOMER INFORMATION
if (isset($_POST['submit'])) {
    $post = array_map('addslashes', $_POST);
    $post = array_map('trim', $_POST);
    $post = array_map('mysql_real_escape_string', $_POST);


    $sql_cust = "INSERT INTO menu_item_details 
	             SET
				         item_name           = '" . $post['item_name'] . "',   
						 create_date        = '" . date('Y-m-d H:i:s') . "'
				 ";
    mysql_query($sql_cust);
    
    $_SESSION['success'] = "Manu item addedd successfully.";
    echo '<script>window.location="' . SITE_URL . '/?page=item_lists"</script>';
}

include('includes/header_after_login.php');
?>

<!-- page content -->
<div class="right_col" role="main">
    <a href="?page=item_lists"> Menu item list</a>&nbsp;&nbsp;Menu Item Add
    <!-- top tiles -->
    <div class="row tile_count">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> Item Add<small>For Item Add</small></h2>
                    <ul class="nav navbar-right panel_toolbox">

                        </li>
                        <li class="dropdown">
                            <script type="text/javascript">
                                try {
                                    ace.settings.check('breadcrumbs', 'fixed')
                                } catch (e) {
                                }
                            </script>
                            <script src="js/ajjquery.min"></script> 
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $('#birthday').daterangepicker({
                                        singleDatePicker: true,
                                        calender_style: "picker_4"
                                    }, function (start, end, label) {
                                        console.log(start.toISOString(), end.toISOString(), label);
                                    });
                                });
                            </script>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>

                        </li>
                    </ul>
                    <div class="clearfix"></div>

                </div>
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
                <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">


                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Item Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="item_name" placeholder="Item Name" name="item_name"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                            </div>
                        </div>


<!--                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Branch Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="branch_name" placeholder="Branch Name" name="branch_name" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Account No</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="acc_no" placeholder="Account No" name="acc_no" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">IFSC Code</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="ifsc_code" placeholder="IFSC Code" name="ifsc_code" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Opening Balance</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last_updated_balance" placeholder="Opening Balance" name="last_updated_balance" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                            </div>
                        </div>-->


                        <div class="ln_solid"></div>
                        <div class="form-group">

                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                <button type="submit" class="btn btn-success" name="submit">Submit</button>
                                <button type="reset" class="btn btn-primary">Cancel</button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /top tiles -->

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">


                </div>


                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">


                    <div class="col-md-12 col-sm-12 col-xs-6">


                    </div>



                </div>

                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <br />

    <div class="row">




        <div class="row">

        </div>


        <div class="col-md-8 col-sm-8 col-xs-12">



            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">

                </div>

            </div>
            <div class="row">




                <!-- start of weather widget -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">


                    </div>
                </div>

            </div>
            <!-- end of weather widget -->
        </div>
    </div>
</div>
</div>
<!-- /page content -->



<?php include('includes/footer_after_login.php'); ?>
