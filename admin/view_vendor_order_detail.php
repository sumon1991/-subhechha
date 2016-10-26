<?php
//NOTIFICATION MESSAGE GENERATION ....
$orderId = ($_GET['orderid']);

$sqlOrder = mysql_query("SELECT vendor_orders.*,subhecha_vendor_master.name FROM vendor_orders INNER JOIN subhecha_vendor_master ON
       vendor_orders.vendor_id = subhecha_vendor_master.id
       where vendor_orders.order_id = '" . $orderId . "'");
$orderDetail = mysql_fetch_assoc($sqlOrder);

include('includes/header_after_login.php');
?>

<!-- page content -->
<div class="right_col" role="main">
    <a href="?page=list_vendor"> Vendor list</a>&nbsp;&nbsp; 
    <a href="?page=view_vendor_order&vendor_id=<?php echo base64_encode($orderDetail['vendor_id']); ?>"> Vendor order list</a>&nbsp;&nbsp; 
    Vendor Order item list
    <!-- top tiles -->
    <div class="row tile_count">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add New Vendor Order</h2>
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
                <div class="x_content">
                    <br />
                    <div class="form-group">

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            Vendor Name: <?php echo $orderDetail['name']; ?>
                        </div>


                        <div class="col-md-3 col-sm-6 col-xs-12">
                            Order Date: <?php echo date('F j,Y', strtotime($orderDetail['order_date'])); ?>
                        </div>
                         <div class="col-md-3 col-sm-6 col-xs-12">
                            Order Id: <?php echo $orderDetail['order_no']; ?>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <h4>Item List</h4>
                    <hr>
                    <?php
                    $orderDetail = (mysql_query("SELECT * from vendor_order_details where vendor_order_id = '" . $orderDetail['order_id'] . "'"));
                    $item = $amount = 0;
                    while ($items = mysql_fetch_assoc($orderDetail)) {
                        $item++;
                        ?>
                        <div class="appendAfter">
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Item Name</label>
                                <div class="col-md-2 col-sm-6 col-xs-12">
                                    <?php echo $items['item_name']; ?>
                                </div>

                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Amount</label>
                                <div class="col-md-2 col-sm-6 col-xs-12">
                                    <?php
                                    $amount+=$items['price'];
                                    echo $items['price'];
                                    ?>
                                </div>
                            </div>
                        </div>

                        <br/>
                    <?php } ?>
                                        <div class="ln_solid"></div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Total No. of Item</label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <?php echo $item; ?>
                        </div>

                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Total Amount</label>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <?php
                            echo number_format($amount,2);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /top tiles -->

</div>
</div>

<?php include('includes/footer_after_login.php'); ?>