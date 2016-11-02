<?php
   // FOLLOWING CODE IS INVOLVED FOR NOTIFICATION MESSAGE GENERATION ....
   if(!empty($_SESSION['success']))
   {
    $success_msg = $_SESSION['success'];
    unset($_SESSION['success']);
   }
   else
   {
    $success_msg = '';
   }
   
   if(!empty($_SESSION['error']))
   {
    $error_message = $_SESSION['error'];
    unset($_SESSION['error']);
   }
   else
   {
    $error_message = '';
   }
   //FOLLOWING CODE WILL BE USED TO ADD IMPORTERS ....
   if(!empty($_REQUEST['id']))
       $id = $_REQUEST['id'];
   else
       $id = '';
   
   
   
   
   
   //CODE TO GET COMPANY DETAILS AT THE TIME OF EDIT COMPANY PROFILE ...
   $cust_sql = "SELECT * FROM ".CUSTOMER." WHERE id = '".$id."'"; 
   $cust_query = mysql_query($cust_sql); 
   $cust_fetch = mysql_fetch_assoc($cust_query);     
   
   
   
   //CODE TO CREATE OR UPDATE COMPANY DETAILS INCLUDING BANK DETAILS .....
   if(isset($_POST['submit']))
   {
      
    $customer_id             = $_POST['customer_id'];
    $time                    = $_POST['time'];
    $purpose                 = $_POST['purpose'];
    $date                    = $_POST['date'];
    $invitaion_person        = $_POST['invitaion_person'];
    $location_address        = $_POST['location_address'];
    $item_1                  = $_POST['item_1'];
    $item_2                  = $_POST['item_2'];
    $item_3                  = $_POST['item_3'];
    $item_4                  = $_POST['item_4'];
    $item_5                  = $_POST['item_5'];
    $item_6                  = $_POST['item_6'];
    $item_7                  = $_POST['item_7'];
    $item_8                  = $_POST['item_8'];
    $item_9                  = $_POST['item_9'];
    $item_10                 = $_POST['item_10'];
    $item_11                 = $_POST['item_11'];
    $item_12                 = $_POST['item_12'];
    $item_13                 = $_POST['item_13'];
    $item_14                 = $_POST['item_14'];
    $item_15                 = $_POST['item_15'];
    $item_16                 = $_POST['item_16'];
    $extra                   = $_POST['extra'];
    $total_payable_money     = $_POST['total_payable_money'];
    
    $sql_order    = "INSERT INTO ".CUSTOMER_ORDER." 
               SET
               customer_id       = '".$customer_id."',
               date              = '".$date."',
               time              = '".$time."',
               purpose           = '".$purpose."',
               invitaion_person  = '".$invitaion_person."',
               location_address  = '".$location_address."'
              ";
        $order_query  = mysql_query($sql_order);
     $od_id     = mysql_insert_id();
     
     $sql_order = "INSERT INTO ".ORDER_ITEM." 
                   SET
              order_id                = '".$od_id."',
              item_1                  = '".$item_1."',
                    item_2                  = '".$item_2."',
                    item_3                  = '".$item_3."',
                    item_4                  = '".$item_4."',
            item_5                  = '".$item_5."',
            item_6                  = '".$item_6."',
            item_7                  = '".$item_7."',
            item_8                  = '".$item_8."',
            item_9                  = '".$item_9."',
            item_10                 = '".$item_10."',
            item_11                 = '".$item_11."',
            item_12                 = '".$item_12."',
            item_13                 = '".$item_13."',
            item_14                 = '".$item_14."',
            item_15                 = '".$item_15."',
            item_16                 = '".$item_16."',
            extra                   = '".$extra."',
            total_payable_money     =  '".$total_payable_money."'
                  ";
        $order_query = mysql_query($sql_order);
     $_SESSION['success'] = "Customer Order has been Added successfully";
     echo '<script>window.location="'.SITE_URL.'/create_invoice_pdf.php?order_id='.$od_id.'"</script>';   
   }
   
   include('includes/header_after_login.php');
   ?>
<!-- page content -->
<div class="right_col" role="main">
   Add Customer Order
   <!-- top tiles -->
   <div class="row tile_count">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_title">
               <h2>Order Details<small>Details Of Customer order form</small></h2>
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
            <?php if(!empty($error_message)) { ?>
            <!-- BEGIN ERROR BOX -->
            <div class="alert alert-danger fade in" id="error">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <?php echo $error_message; ?>
            </div>
            <!-- END ERROR BOX -->  
            <?php } if(!empty($success_msg)) { ?> 
            <!-- BEGIN OF SUCCESS BOX -->
            <div class="alert alert-success fade in">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <strong>Well done!</strong> <?php echo $success_msg; ?>.
            </div>
            <!-- END OF SUCCESS BOX -->
            <?php } ?>
            <div class="x_content">
               <br />
               <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">
                  <input type="hidden" value="<?php echo $id;?>" name="customer_id" class="form-control col-md-7 col-xs-12" readonly="readonly">
                  <div class="form-group">
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Customer Name <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" value="<?php echo $cust_fetch['customer_name'];?>" class="form-control col-md-7 col-xs-12" readonly="readonly">
                     </div>
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Phone Number <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" value="<?php echo $cust_fetch['customer_phone'];?>" class="form-control col-md-7 col-xs-12" readonly="readonly">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Email ID <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" value="<?php echo $cust_fetch['customer_email'];?>" class="form-control col-md-7 col-xs-12" readonly="readonly">
                     </div>
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Address<span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <textarea class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12 col-md-7 col-xs-12" placeholder="Address" readonly="readonly"><?php echo $cust_fetch['customer_address'];?></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Purpose</label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="purpose" placeholder="Purpose" name="purpose" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="birthday" placeholder="Date" name="date" class="date-picker form-control col-md-7 col-xs-12 active" required />
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Time</label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="customer_phone" placeholder="Time" name="time" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="customer_phone" placeholder="Location" name="location_address" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Person Invitation</label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="customer_phone" placeholder="Person Invitation" name="invitaion_person" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 1 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_1" class="form-control col-md-7 col-xs-12" required="required">
                     </div>
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 2 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_2" class="form-control col-md-7 col-xs-12" required="required">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 3 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_3" class="form-control col-md-7 col-xs-12" required="required">
                     </div>
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 4 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_4" class="form-control col-md-7 col-xs-12" required="required">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 5 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_5" class="form-control col-md-7 col-xs-12">
                     </div>
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 6 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_6" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 7 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_7" class="form-control col-md-7 col-xs-12">
                     </div>
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 8 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_8" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 9 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_9" class="form-control col-md-7 col-xs-12">
                     </div>
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 10 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_10" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 11 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_11" class="form-control col-md-7 col-xs-12">
                     </div>
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 12 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_12" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 13 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_13" class="form-control col-md-7 col-xs-12">
                     </div>
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 14 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_14" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 15 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_15" class="form-control col-md-7 col-xs-12">
                     </div>
                     <label class="control-label col-md-2 col-sm-2 col-xs-6" for="first-name">Item 16 <span class="required"></span>
                     </label>
                     <div class="col-md-4 col-sm-4 col-xs-6">
                        <input type="text" name="item_16" class="form-control col-md-7 col-xs-12">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Raff Caculation<span class="required"></span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea name="extra" required="required" parsley-minwords="3" placeholder=""  class="form-control col-md-7 col-xs-12" rows="5"></textarea>      
                     </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total_payable_money">Total Payable Money:<span class="required"></span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <!-- <textarea name="total_payable_money" id="total_payable_money" required="required" parsley-minwords="3" placeholder=""  class="form-control col-md-7 col-xs-12" rows="5"></textarea>  -->
                        <input type="number" required="true" class="form-control" name="total_payable_money">     
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
<script type="text/javascript">
  $( function() {
    var dateToday = new Date();
    $( "#birthday" ).datepicker({
      minDate: dateToday
    });
    $( "#birthday" ).datepicker( "option" , "dateFormat", "dd/mm/yy");

  } );
</script>
<?php include('includes/footer_after_login.php'); ?>