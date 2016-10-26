<?php

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
    $order_id =$_POST['order_id'];
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
            order_id ='".$order_id."',   
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

                    Employee Payment 
                    <small>
                        <a href="?page=list_employee"> Employee list</a>&nbsp;&nbsp;Employee Payment
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
                    <p class="text-muted font-13 m-b-30">
                        </code>
                    </p>
                    Employee Name: <?php echo $emp_dtls['name'];?><br/>
                    <?php if(isset($emp_dtls['emp_type_id']) && $emp_dtls['emp_type_id'] == '2'){ ?>
                    <table class="table table-striped table-bordered">
                        
                        
                        
                        <tr>
                            <td class="pull-right">Gross Salary:</td>
                            <td> <strong><?php echo number_format($emp_dtls['gross'], 2); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="pull-right">Total Paid:</td>
                            <td> <?php echo number_format($totalPaid, 2); ?></td>
                        </tr>
                        <tr>
                            <td class="pull-right">Total Due:</td>
                            <td> <?php echo number_format(($emp_dtls['gross'] - $totalPaid), 2); ?></td>
                        </tr>
                    </table>
                    <?php }else{ ?>
                    <table class="table table-striped table-bordered">
                      <tr>
                          <th>Order date</th>
                          <th>Order Purpose</th>
                          <th>Contracted Amount</th>
                          <th>Amount Paid</th>
                        </tr>
                      <?php 
                      $contract = mysql_query("select emp_salary_details.order_id as orderId,emp_salary_details.*,subhecha_order_details.*,
                               (select coalesce(sum(paid_amount),0) from employee_payment_history where order_id = orderId and emp_id = $id) as totalPaid
                              from emp_salary_details inner join 
                              subhecha_order_details on emp_salary_details.order_id = subhecha_order_details.order_id 
                              inner join subhecha_customer on subhecha_customer.id = subhecha_order_details.customer_id 
                              where emp_salary_details.emp_id=$id
                                    ");
                      while($fetchContract = mysql_fetch_assoc($contract))
                      {
                      ?>  
                        <tr>
                          <td><?php echo date('F j, Y', strtotime($fetchContract['date']))?></td>
                          <td><?php echo $fetchContract['purpose']?></td>
                          <td><?php echo $fetchContract['gross']?></td>
                          <td><?php echo $fetchContract['totalPaid']?></td>
                        </tr>
                        
                      <?php }?>
                    </table>
                    <?php }?>
                   <hr>
                    <h4 style="text-align: center;">New Payment</h4>
                    <form method="post" class="form-horizontal form-label-left" onsubmit="return validation();">
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
                        <?php
                        $employee = mysql_fetch_assoc(mysql_query("select id,emp_type_id from subhecha_employee_master where id='".$id."'"));
                        if($employee['emp_type_id']==3)
                        {
                            ?>
                           
                        
                        
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Select Order</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="order_id" id="order_id" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required="">
                                    <option value="">Select Order</option>
                                    <?php
                                    $orderList = mysql_query("select subhecha_order_details.*,subhecha_customer.customer_name from subhecha_order_details
                                            inner join subhecha_customer on subhecha_customer.id =subhecha_order_details.customer_id
                                            inner join emp_salary_details on emp_salary_details.order_id = subhecha_order_details.order_id
                                            where emp_salary_details.emp_id = $id
                                            order by subhecha_order_details.date desc limit 0,10");
                                    while ($orderListDtl = mysql_fetch_assoc($orderList)) {
                                        ?>
                                        <option value="<?php echo $orderListDtl['order_id'] ?>"> <?php echo 'Date--' . date('F j ,Y', strtotime($orderListDtl['date'])) . '--Purpose--' . $orderListDtl['purpose'] . '--Customer Name--' . $orderListDtl['customer_name'] ;?></option>
                                    <?php } ?>
                                </select>
                                
                                
                            </div>
                        </div>
                        <?php }?>
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
    function validation()
    {
        var toBePaidAmount = $("#amount").val();
        var selectedBank = $("#bank option:selected").text();
        var textBank = selectedBank.split("Balance--");

        if (parseFloat(toBePaidAmount) > parseFloat(textBank[1]))
        {
            alert("This account has not enough balance for this payment");
            $("#amount").focus();
            return false;
        }
    }
</script>
