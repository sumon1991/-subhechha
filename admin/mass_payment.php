<?php

// Employee Category

if(isset($_REQUEST['emp_tp']) && $_REQUEST['emp_tp'] != ''){
    $emp_cat = $_REQUEST['emp_tp'];
    
    $emp_sal_sql = "SELECT em.name,em.id,es.gross,SUM(ep.paid_amount) as total_paid FROM subhecha_employee_master AS em LEFT JOIN emp_salary_details AS es ";
    $emp_sal_sql.= " ON em.id = es.emp_id JOIN employee_payment_history AS ep ON em.id = ep.emp_id WHERE em.emp_type_id = '".$emp_cat."' GROUP BY ep.emp_id";
    $emp_type_list_query = mysql_query($emp_sal_sql);
    //$emp_dtls	= mysql_fetch_array($type_list_query);
//    $all_emp_dtls = array();
//    if (mysql_num_rows($type_list_query) > 0) {
//        while ($emp_dtls = mysql_fetch_assoc($type_list_query)) {
//                    $all_emp_dtls[] = $emp_dtls;
//        }
//    }
}

// FOLOWING CODE IS FOR FETCHING THE RECORD
if(!empty($_REQUEST['id']))
    $id = $_REQUEST['id'];
else
    $id = '';

// Employee Details
$type_list_sql = "SELECT em.name,em.emp_type_id,es.gross FROM subhecha_employee_master as em LEFT JOIN emp_salary_details as es on em.id = es.emp_id WHERE em.id = ".$id;
$type_list_query = mysql_query($type_list_sql);
$emp_dtls	= mysql_fetch_array($type_list_query);

$sqlpaymentHistory = mysql_query("SELECT * FROM employee_payment_history WHERE emp_id = '" . $id . "'");

$totalPaid = 0.00;
if (mysql_num_rows($sqlpaymentHistory) > 0) {
        while ($fetchpaymentHistory = mysql_fetch_assoc($sqlpaymentHistory)) {
                    $totalPaid+= $fetchpaymentHistory['paid_amount'];
        }
    }

if (isset($_POST['submit'])) {
    $bankId = $_POST['bank'];
    $amount = $_POST['amount'];
    $paid_through = $_POST['paid_through'];
    $paid_date = date('Y-m-d', strtotime($_POST['paid_date']));

    $sqlChkBalance = mysql_fetch_assoc(mysql_query("select last_updated_balance from bank_details where id = '" . $bankId . "'"));
    if ($amount > $sqlChkBalance['last_updated_balance']) {
        $_SESSION['error'] = "Not enough balance on selected account.";
        echo '<script>window.location="' . SITE_URL . '/?page=list_vendor";</script>';
        exit;
    } else {
        mysql_query("insert into bank_transfer_history set
            bank_id = '" . $bankId . "',
            transfer_type ='1',
            amount = '" . $amount . "',
            transact_with = '1',
            employee_id = '" . $id . "',
            transcation_date = '" . $paid_date . "',
            date = '" . date('Y-m-d H:i:s') . "',
            purpose ='Paid to employee for Salary'    
            ");

        mysql_query("update bank_details set last_updated_balance = (last_updated_balance- $amount) where id= '" . $bankId . "'");

        mysql_query("INSERT INTO employee_payment_history SET
            emp_id = '" . $id . "',
            paid_amount =  '" . $amount . "',
            paid_date =  '" . $paid_date . "',
            paid_through ='" . $paid_through . "' ,
            creation_date = '" . date('Y-m-d H:i:s') . "'    
        ");

        $_SESSION['success_msg'] = "Transaction addedd successfully";
        echo '<script>window.location="' . SITE_URL . '/?page=list_employee";</script>';
        exit;
    }
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

                    Mass Payment 
                    <small>
                        <a href="?page=list_employee"> Employee list</a>&nbsp;&nbsp;Mass Payment 
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
                    <form method="post" class="form-horizontal form-label-left" onsubmit="return validation();">
                    <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Payment Option</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="emp_tp" id="emp_tp" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required="" onchange="selectPaymentOption(this.value)">
                                    <option value="">Select Payment Option</option>
                                    <?php
                                    $emp_tp = mysql_query("select * from subhecha_employee_type");
                                    while ($fetchEmpTp = mysql_fetch_assoc($emp_tp)) {
                                        ?>
                                    <option value="<?php echo $fetchEmpTp['id'] ?>" <?php if(isset($_REQUEST['emp_tp']) && $_REQUEST['emp_tp'] == $fetchEmpTp['id']) echo 'selected'; ?>> <?php echo $fetchEmpTp['type_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                                       
                    
                    <hr>
                    <?php if(mysql_num_rows($emp_type_list_query) > 0) { ?>
                    <h4>Employee Details to be Paid</h4>
                     <?php } ?>
                    <!-- Employee Details to be paid -->
                    <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <?php if(mysql_num_rows($emp_type_list_query) > 0) { ?>
                     <tr role="row">
                                                <th>SL.No.</th>
                                                <th>Name of Employee</th>
                                                <th>Due (if any)</th>
                                                <th>Amount to be paid</th>
                                            </tr>
                        <?php } ?>
                    </thead>


                    <tbody>
                      <?php
											if(mysql_num_rows($emp_type_list_query) > 0) {
												$c = 1;
                                                                                                $totalAmountToPaid = 0;
												while($col_list_array = mysql_fetch_assoc($emp_type_list_query)) {
                                                                                                    $totalAmountToPaid += $col_list_array['gross'];
										?>
                                           <tr>
                                                <td><?php echo $c++; ?></td>
						<td><?php echo $col_list_array['name']; ?></td>
                                                <td><?php echo (($col_list_array['gross'] - $col_list_array['total_paid'])>=0)?($col_list_array['gross'] - $col_list_array['total_paid']):0; ?></td>
                                                <td><?php echo $col_list_array['gross']; ?></td>
                                           
                                            </tr>
                    <?php
												}
											}else{
					?>
                                            <tr> No employee selected to be paid</tr>
                                                                                        <?php } ?>
                    </tbody>
                  </table>
                    
                    <!-- End of Employee details --->
                    
                    
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Select Bank Acc</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="bank" id="bank" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required="">
                                    <option value="">Select bank account</option>
                                    <?php
                                    $bankList = mysql_query("select * from bank_details where status=1 order by branch_name asc");
                                    while ($fetchBank = mysql_fetch_assoc($bankList)) {
                                        ?>
                                        <option value="<?php echo $fetchBank['id'] ?>"> <?php echo 'Bank--' . $fetchBank['bank_name'] . '--Branch--' . $fetchBank['branch_name'] . '--Acc No--' . $fetchBank['acc_no'] . '--Balance--' . $fetchBank['last_updated_balance'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Amount to be paid</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">

                                <input type="number" name="amount" id="amount" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required="" placeholder="Amount to be paid" step=".1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Pay though</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">

                                <input type="radio" name="paid_through" value="1" checked=""> Cheque
                                <input type="radio" name="paid_through" value="2"> Cash
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Paid Date</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="text" name="paid_date" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required="" placeholder="YYYY-MM-DD">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success" name="submit">Submit</button>
                            <button type="reset" class="btn btn-primary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>   
</div>
</div>
<!-- /page content -->
<?php include('includes/footer_after_login.php'); ?>

<script>
    function selectPaymentOption(val)
    {
        if(val != ''){
            window.location.href = '<?php echo SITE_URL.'/?page=mass_payment&emp_tp='; ?>'+val;
        }
    }
</script>
