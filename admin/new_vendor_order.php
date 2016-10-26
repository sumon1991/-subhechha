<?php
//NOTIFICATION MESSAGE GENERATION ....
$vendorId = base64_decode($_GET['vendor_id']);
function generateBill()
{
	$today = date("Ymd");
$rand = strtoupper(substr(uniqid(sha1(time())),0,6));
return $unique = $today . $rand;
}

if(isset($_POST['submit']))
{
    $vendorId =$_POST['vendor_id'];
    $orderDate = $_POST['order_date'];
    $itemNames= $_POST['item_name'];
    $amount = $_POST['amount']; 

    
    $orderDate =  date('Y-m-d' , strtotime($orderDate));
    
    $sqlNewOrder = "INSERT INTO vendor_orders SET
                    order_no = '".generateBill()."',
                    vendor_id = '".$vendorId."',
                    order_date = '".$orderDate."',
                    creation_date = '".date('Y-m-d H:i:s')."'    
                    ";
    mysql_query($sqlNewOrder);
    $orderVendorId = mysql_insert_id();
    
    foreach($itemNames as $key => $val):
        $sqlItem = "INSERT INTO vendor_order_details SET
                    vendor_order_id = '".$orderVendorId."',
                    item_name = '".$val."',
                    price = '".$amount[$key]."'    
                    ";
    mysql_query($sqlItem);
    endforeach;
    
    $_SESSION['success_msg'] = "Bill has been uploaded successfully";
    echo '<script>window.location="'.SITE_URL.'/?page=list_vendor"</script>';
    exit;
}
include('includes/header_after_login.php');
?>

<!-- page content -->
<div class="right_col" role="main">
    <a href="?page=list_vendor"> Vendor list</a>&nbsp;&nbsp; New Vendor Order
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
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Vendor</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <select name="vendor_id" id="vendor_id" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required="" <?php if($vendorId!='') echo 'readonly';?>>
                                    <option value="">Select</option>
                                    <?php
                                    $vendors = mysql_query("SELECT id,name from subhecha_vendor_master order by name asc");
                                    while ($vendorList = mysql_fetch_assoc($vendors)) {
                                        ?>
                                        <option value="<?php echo $vendorList['id']; ?>" <?php if ($vendorList['id'] == $vendorId) echo 'selected'; ?>><?php echo $vendorList['name']; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>

                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Order Date</label>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <input type="date" name="order_date" id="order_date" placeholder="YYYY-MM-DD" required="">

                            </div>
                        </div>
                        <div class="ln_solid"></div>

                        <div class="appendAfter">
                            <div class="form-group" id="1">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Item Name</label>
                                <div class="col-md-2 col-sm-6 col-xs-12">
                                    <input type="text" name="item_name[]" required="" placeholder="Item Name">
                                </div>

                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Amount</label>
                                <div class="col-md-2 col-sm-6 col-xs-12">
                                    <input type="number" name="amount[]" placeholder="120.00" required="" min="10" step=".1">

                                </div>


                                <div class="col-md-2 col-sm-6 col-xs-12">
                                    <a href="javascript:;" onclick="addAddItemArea();">Add Item</a>
                                </div>
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
        <input type="hidden" id="count_item" value="1">
    </div>
    <!-- /top tiles -->

</div>
</div>

<?php include('includes/footer_after_login.php'); ?>
<script>

    function addAddItemArea()
    {
        $("#count_item").val(parseInt($("#count_item").val()) + parseInt(1));
        var itemCount = $("#count_item").val();
        $.ajax({
            url: 'add_area_to_new_item.php',
            data: 'itemCount=' + itemCount,
            success: function (data) {
                $(".appendAfter").append(data);
            }

        });

    }
    function removeItemArea(id)
    {
        $("#" + id).remove();
    }
</script>