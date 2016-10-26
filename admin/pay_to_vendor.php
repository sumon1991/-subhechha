<?php
$vendorId = base64_decode($_GET['vendorid']);
$orderId = base64_decode($_GET['orderid']);

$sqlpaymentHistory = mysql_query("SELECT * FROM vendor_payment_history WHERE vendor_order_id = '" . $orderId . "' AND vendor_id = '" . $vendorId . "'");

$totalBill = mysql_fetch_assoc(mysql_query("SELECT SUM(price) as total_price from vendor_order_details where vendor_order_id = '" . $orderId . "'"));

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
            vendor_id = '" . $vendorId . "',
            transcation_date = '" . $paid_date . "',
            date = '" . date('Y-m-d H:i:s') . "',
            purpose ='Paid to vendor for order $orderId'    
            ");

        mysql_query("update bank_details set last_updated_balance = (last_updated_balance- $amount) where id= '" . $bankId . "'");

        mysql_query("INSERT INTO vendor_payment_history SET
            vendor_order_id = '" . $orderId . "',
            vendor_id = '" . $vendorId . "',
            paid_amount =  '" . $amount . "',
            paid_date =  '" . $paid_date . "',
            paid_through ='" . $paid_through . "' ,
            creation_date = '" . date('Y-m-d H:i:s') . "'    
        ");

        $_SESSION['success_msg'] = "Transaction addedd successfully";
        echo '<script>window.location="' . SITE_URL . '/?page=list_vendor";</script>';
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

                    Vendor Payment 
                    <small>
                        <a href="?page=list_vendor"> Vendor list</a>&nbsp;&nbsp;Vendor Payment
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
                    <?php
                    $sqlVendOrd = mysql_fetch_assoc(mysql_query("select vendor_orders.order_no,subhecha_vendor_master.name from vendor_orders inner join subhecha_vendor_master
                                    on vendor_orders.vendor_id = subhecha_vendor_master.id where vendor_orders.order_id = '".$orderId."'
                                    "));
                    ?>
                    Vendor Name: <?php echo $sqlVendOrd['name'];?><br/>
                    Order Id:<?php echo $sqlVendOrd['order_no'];?><br/>

                    Payment History For this Order:

                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Paid Date</th>
                            <th>amount</th>
                        </tr>
                        <?php
                        $totalPaid = 0.00;
                        if (mysql_num_rows($sqlpaymentHistory) > 0) {
                            while ($fetchpaymentHistory = mysql_fetch_assoc($sqlpaymentHistory)) {
                                ?>
                                <tr>
                                    <td><?php echo date('F j,Y', strtotime($fetchpaymentHistory['paid_date'])); ?></td>
                                    <td><?php
                                        echo $fetchpaymentHistory['paid_amount'];
                                        $totalPaid+= $fetchpaymentHistory['paid_amount'];
                                        ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="2">No payment made yet for this order!</td>

                            </tr>
                        <?php } ?>
                        <tr>
                            <td class="pull-right">Total Billed mount:</td>
                            <td> <strong><?php echo number_format($totalBill['total_price'], 2); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="pull-right">Total Paid:</td>
                            <td> <?php echo number_format($totalPaid, 2); ?></td>
                        </tr>

                        <tr>
                            <td class="pull-right">Total Due:</td>
                            <td> <?php echo number_format(($totalBill['total_price'] - $totalPaid), 2); ?></td>
                        </tr>
                    </table>
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
