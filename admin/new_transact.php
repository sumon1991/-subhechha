<?php
//NOTIFICATION MESSAGE GENERATION ....
$bankId = base64_decode($_GET['bank_id']);

if ($bankId == '') {
    $_SESSION['error'] = "Bank Id you selected does not exists.";
    echo '<script>window.location="' . SITE_URL . '/?page=bank_lists"</script>';
}
$bankDtl = mysql_fetch_assoc(mysql_query("select * from bank_details where id = '" . $bankId . "'"));
if (count($bankDtl) == 0) {
    $_SESSION['error'] = "Bank Id you selected does not exists.";
    echo '<script>window.location="' . SITE_URL . '/?page=bank_lists"</script>';
}
if (isset($_POST['submit'])) {
    $transactionType = $_POST['transfer_type'];
    $transactWith = $_POST['transact_with'];
    $transact_with_id = $_POST['transact_with_id'];
    $amount = $_POST['amount'];
    $purpose = addslashes($_POST['purpose']);
    $note = addslashes($_POST['note']);
    $transcation_date = $_POST['datepicker'];
    if($transactWith==1)
    {
        $sqlToAppend = "`vendor_id` = '".$transact_with_id."' ,";
    }
    if($transactWith==2)
    {
        $sqlToAppend = "`employee_id` = '".$transact_with_id."' ,";
    }
    if($transactWith==3)
    {
        $sqlToAppend = "";
    }
    if($transactWith==4)
    {
        $sqlToAppend = "`customer_id` = '".$transact_with_id."' ,";
    }
    
    $sqlInsert = "INSERT INTO bank_transfer_history SET
                 bank_id = '".$bankId."',
                 transfer_type = '".$transactionType."',
                 amount = '".$amount."',
                 transact_with = '".$transactWith."',
                 $sqlToAppend 
                 date = '".date('Y-m-d H:i:s')."',
                 transcation_date  = '".$transcation_date."',  
                 purpose = '".$purpose."',
                 note = '".$note."'    
                ";
    mysql_query($sqlInsert);
    
    if($transactionType==1)
    {
        $newBalance = $bankDtl['last_updated_balance'] - $amount ;
    }
    if($transactionType==2)
    {
        $newBalance = $bankDtl['last_updated_balance'] + $amount ;
    }
    mysql_query("UPDATE bank_details SET last_updated_balance = '".$newBalance."' WHERE id = '" . $bankId . "'");
    
   $_SESSION['success'] = "Transaction addedd successfully";
   echo '<script>window.location="' . SITE_URL . '/?page=bank_transcation_history&id='.$bankId.'"</script>'; 
}

include('includes/header_after_login.php');
?>

<!-- page content -->
<div class="right_col" role="main">
     <a href="?page=bank_lists"> Bank list</a>&nbsp;&nbsp;<a href="?page=bank_transcation_history&id=<?php echo $bankId;?>"> Transaction History</a>&nbsp;&nbsp;New Transaction
    <!-- top tiles -->
    <div class="row tile_count">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Bank Transaction</h2>
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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" onsubmit="return formValidation();">


                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Bank Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="<?php echo $bankDtl['bank_name']; ?>" disabled="" readonly="" />
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Branch Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="<?php echo $bankDtl['branch_name']; ?>" disabled="" readonly="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Account No</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="<?php echo $bankDtl['acc_no']; ?>" disabled="" readonly="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">IFSC Code</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="<?php echo $bankDtl['ifsc_code']; ?>" disabled="" readonly="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Balance</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="<?php echo $bankDtl['last_updated_balance']; ?>" disabled="" readonly=""/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Transact Type</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="transfer_type" id="transfer_type" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required="">
                                    <option value="">Select</option>
                                    <option value="1">Debit</option>
                                    <option value="2">Credit</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Transact With</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="transact_with" id="transact_with" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required="">
                                    <option value="">Select</option>
                                    <option value="1">Vendor</option>
                                    <option value="2">Employee</option>
                                    <option value="4">Customer</option>
                                    <option value="3">Others</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Select User</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="transact_with_id" id="transact_with_id" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required="">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Amount</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="number" name="amount" id="amount" required="" min="100" step=".1" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="text" class="form-control" id="datepicker" name="datepicker" required="" placeholder="YYYY-MM-DD">
                            </div>
                        </div>
                
                <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Purpose</label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="text" name="purpose" id="purpose" required="" placeholder="purpose">
                    </div>
                </div>

                <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Note</label>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <textarea name="note" id="note" placeholder="Note here..."></textarea>
                    </div>
                </div>

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
<input type="hidden" id="balance" value="<?php echo $bankDtl['last_updated_balance']; ?>">


<?php include('includes/footer_after_login.php'); ?>
<script>
    $("#transact_with").change(function () {
        var type = $("#transact_with").val();
        $("#transact_with_id").html("<option value=''>Select</option>");
        if (type != 3)
        {
            $.ajax({
                url: 'get_users_list.php',
                data: 'type=' + type,
                success: function (data) {
                    $("#transact_with_id").append(data);
                }

            });
        }
    });

    //form validation start here
    function formValidation()
    {
        if ($("#transfer_type").val() == 1)
        {
            var remainingBalance = parseFloat($("#balance").val()) - parseFloat($("#amount").val());

            if (remainingBalance < 0)
            {
                alert("not enough balance !");
                $("#amount").focus();
                return false;
            }
        }
    }
</script>