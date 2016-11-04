<?php
//NOTIFICATION MESSAGE GENERATION ....
if(!empty($_SESSION['success']))
{
  $success_msg = $_SESSION['success'];
    unset($_SESSION['success']);
} 
else
{
  $success_msg = '';
}

if(isset($_SESSION['error']))
{
  $error_message = $_SESSION['error'];
  unset($_SESSION['error']);
}
else
{
  $error_message = '';
}


//FOLLOWING CODE WILL BE USED TO ADD IMPORTERS ....
/*if(!empty($_REQUEST['order_id']))
    $order_id = $_REQUEST['order_id'];
else
    $order_id = '';*/
  
if(!empty($_REQUEST['oid']))
    $order_id = $_REQUEST['oid'];
else
    $order_id = ''; 
//CODE TO GET COUSTOMER ORDER DETAILS ...
$cust_sql = "SELECT * FROM ".CUSTOMER_ORDER." WHERE order_id = '".$order_id."'"; 
$cust_query = mysql_query($cust_sql); 
$cust_fetch = mysql_fetch_assoc($cust_query); 

//die();

//CODE TO GET COUSTOMER ITEM ORDER DETAILS ...
$cust_ite_sql = "SELECT * FROM ".ORDER_ITEM." WHERE order_id = '".$order_id."'"; 
$cust_ite_query = mysql_query($cust_ite_sql); 
$cust_ite_fetch = mysql_fetch_assoc($cust_ite_query);   

$table_data = "SELECT * FROM ".PAYMENT_LOG." WHERE customer_id = ".$cust_fetch['customer_id']." AND order_id = ".$cust_fetch['order_id']."";

$table_data = mysql_query($table_data);
/*$rows = array();
while ($table_data = mysql_fetch_array($table_data)) {
  array_push($rows, $table_data);
} */

function whoIsCustomer($cus_id, $email_flag = null) {
  
  $cus_details_sql = "SELECT * FROM ".CUSTOMER." WHERE id = '".$cus_id."'"; 
  $cus_details = mysql_query($cus_details_sql); 
  $cus_details = mysql_fetch_assoc($cus_details);
  if ($email_flag != null && $email_flag == 1) {
    print_r($cus_details['customer_email']);
  }
  else
  {
    print_r($cus_details['customer_name']);
  }
}
$newURL = $_SERVER['REQUEST_URI'];
//CODE TO CREATE OR UPDATE COMPANY DETAILS INCLUDING BANK DETAILS .....
if(isset($_POST['btn_update']))
{
  $customer_id         = $cust_fetch['customer_id'];
  $order_id            = $cust_fetch['order_id'];
  $rough_price         = $cust_ite_fetch['extra'];
  $total_price_payable = $cust_ite_fetch['total_payable_money'];
  $upadated_discount  = $_POST['Update_amount'];
  $final_carry_forward = $total_price_payable - $upadated_discount;
  /*echo "<pre>";
  echo $total_price_payable;
  echo $upadated_discount;
  exit();*/
  if ($total_price_payable < $upadated_discount) {
   $_SESSION['error'] = "Updated discount should be less than or equals to total price payable";
   header('Location: '.$newURL);
   exit(); 
  }
  else
  {
    $sql_type = "INSERT INTO ".PAYMENT_LOG." (`customer_id`, `order_id`, `rough_price`, `total_price_payable`, `updated_discount`, `final_carry_forward`) VALUES ($customer_id, $order_id, '$rough_price', '$total_price_payable', '$upadated_discount', '$final_carry_forward')";
    $sql_insert = mysql_query($sql_type);


    $update_details_table = "UPDATE ".ORDER_ITEM." SET
      total_payable_money  = '".$final_carry_forward."' WHERE order_id = '".$order_id ."'";
     
    $sql_update = mysql_query($update_details_table);
  }
  
  $_SESSION['success'] = "Customer Order has been update successfully";
  if ($_SESSION['success']) {
    header('Location: '.$newURL);
  }
  echo '<script>window.location="'.SITE_URL.'/create_invoice_pdf.php?order_id='.$order_id.'"</script>';
      
}

include('includes/header_after_login.php');
?>




              
      <!-- page content -->
      <div class="right_col" role="main">
        Edit/View Customer Order
        <!-- top tiles -->
        <div class="row tile_count">
          
           <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Payment Log<small>Details Of Customer order form</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                  
                    </li>
                    <li class="dropdown">
                      
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
                <?php 
          if(!empty($error_message)) 
          { 
        ?>
          <!-- BEGIN ERROR BOX -->
          <div class="alert alert-danger fade in" id="error">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $error_message; ?>
          </div>
          <!-- END ERROR BOX -->  
          <?php } if(!empty($success_msg)) { ?> 
          <!-- BEGIN OF SUCCESS BOX -->
          <div class="alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Well done!</strong> <?php echo $success_msg; ?>.
          </div>                  
          <!-- END OF SUCCESS BOX -->
        <?php } ?>
                <div class="x_content">
                  <br />
                  <!-- <div align="right" style="padding-bottom:30px; padding-right:20px"><a target="_blank" href="order_invoice_pdf.php?oid=<?php echo $order_id;?>"><img src="images/ads_pdf.png" width="30" height="30" /></a></div> -->
                  <form role="form" method="post">
                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="form-group col-md-6 col-sm-6 col-xs-6">Customer Name</label>
                        <input type="text" readonly="true" name="customer_name" class="form-control" value=<?php whoIsCustomer($cust_fetch['customer_id']);?>>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="form-group col-md-6 col-sm-6 col-xs-6">Purpose</label>
                        <input type="text" readonly="true" name="purpose" class="form-control" value=<?php print_r($cust_fetch['purpose']);?>>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="form-group col-md-6 col-sm-6 col-xs-6">Total Payable Amount</label>
                        <input type="text" readonly="true" name="payable_amount" class="form-control" id="payable_amount" value=<?php print_r($cust_ite_fetch['total_payable_money']);?>>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="form-group col-md-6 col-sm-6 col-xs-6">Update Amount</label>
                          <input type="number" name="Update_amount" id="updt_amount" class="form-control" required="true" step="any">
                          <div id="updt_error_js"></div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-5"></div>
                      <div class="col-md-3"><button type="submit" id="btn_update_amount" class="btn btn-primary" style="border-radius: 0px;background: #26B99A;border-color: #fff;width: 167px;" name="btn_update">Update</button></div>
                      <div class="col-md-4"></div>
                    </div>
                  </form>
                  <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Previous Cost</th>
                      <th>Charged Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($populate_data = mysql_fetch_assoc($table_data)) {?>
                    <tr>
                      <td><?php echo $populate_data['date']; ?></td>
                      <td><?php echo $populate_data['total_price_payable'];?></td>
                      <td><?php echo $populate_data['updated_discount'];?></td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
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
     
 <script type="text/javascript">
   $(function(){
    //console.log($('#payable_amount').val());
    //console.log($('#updt_amount').val());
    if (<?php print_r($cust_ite_fetch['total_payable_money']);?> <= 0) {
      $('#updt_amount').attr('disabled', 'true');
    }
    $('#btn_update_amount').click(function(){
      var payable_amount = $('#payable_amount').val();
      var updt_amount = $('#updt_amount').val();
      payable_amount = parseFloat(payable_amount);
      updt_amount = parseFloat(updt_amount);
      if ($.trim(updt_amount)) {
        if (payable_amount > updt_amount || payable_amount == updt_amount) {
          $('#updt_amount').attr('style', '');
          $('#updt_error_js').html('');
          $('#btn_update_amount').attr('type', 'submit');
        }
        else
        {
          $('#updt_amount').attr('style', 'border-style: solid;border-color: red;');
          $('#btn_update_amount').attr('type', 'button');
          $('#updt_error_js').html('<p style="color:red;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Update amount should not be greater than payable amount</p>');
          //return;
        }
      }
      else{
        $('#updt_amount').attr('style', 'border-style: solid;border-color: red;');
        $('#btn_update_amount').attr('type', 'button');
        $('#updt_error_js').html('<p style="color:red;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Update amount should not be empty!</p>');
        //return;
      }

    });
   });
 </script>
 <?php include('includes/footer_after_login.php'); ?>
