<?php 
// FOLOWING CODE IS FOR FETCHING THE RECORD
if(!empty($_REQUEST['id']))
    $id = $_REQUEST['id'];
else
    $id = ''; 
 
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

//FETCH THE EMPLOYEE TYPE DATA FOR EDITING
$select_cust  = "SELECT * FROM emp_salary_details WHERE emp_id = '".$id."'";
$query_select = mysql_query($select_cust);
$select_fetch = mysql_fetch_assoc($query_select); 


// Employee Details
$type_list_sql = "SELECT * FROM subhecha_employee_master WHERE id = ".$id;
$type_list_query = mysql_query($type_list_sql);
$emp_dtls	= mysql_fetch_array($type_list_query);

//FOLLOWING CODE WILL EDIT THE EMPLOYEE TYPE INFORMATION
if(isset($_POST['submit']))
{
	$emp_id = $_POST['emp_id'];
	$basic  = $_POST['basic'];
	$da     = $_POST['da'];
	$hra    = $_POST['hra'];
	$gross  = $_POST['gross'];
	
        if(!empty($select_fetch)){	
	$sql_cust = "UPDATE emp_salary_details SET emp_id = '".$emp_id."',basic = '".$basic."',". "da = '".$da."',hra = '".$hra."',"
                . "gross = '".$gross."' WHERE emp_id = '".$emp_id."'";	 
	 $sql_insert = mysql_query($sql_cust);
	 if($sql_insert > 0){
		  $_SESSION['success'] = "Salary configuration has been Update successfully";
        echo '<script>window.location="'.SITE_URL.'/?page=list_employee"</script>';
		}else{
			$_SESSION['error'] = "Vendor has been Already Added or Not Properly added..";
        echo '<script>window.location="'.SITE_URL.'/?page=list_employee"</script>';
	 }
        }else{
            //$sql_cust = "INSERT INTO `emp_salary_details` (`emp_id`, `basic`, `da`, `hra`, `gross`, `created_date`) VALUES ('".$emp_id."', '".$basic."', '".$da."', '".$hra."', '".$gross."', '".date('Y-m-d H:i:s').'")";	 
             $sql_cust = "INSERT INTO emp_salary_details 
	             SET emp_id = '" . $emp_id . "',basic = '" . $basic . "',da = '" . $da . "',hra = '" . $hra . "',gross = '" . $gross . "',created_date = '" . date('Y-m-d H:i:s') . "'";
            $sql_insert = mysql_query($sql_cust);
            $_SESSION['success'] = "Salary configuration has been added successfully";
            echo '<script>window.location="'.SITE_URL.'/?page=list_employee"</script>';
        }
}


if(isset($_POST['temp-submit']))
{
    $gross = $_POST['gross'];
    $order_id= $_POST['order_id'];
    
    $sql = "insert into emp_salary_details set
            emp_id = $id,
            gross = $gross,
            created_date = '".date('Y-m-d')."',
            order_id = '".$order_id."'    
            ";
    mysql_query($sql);
     $_SESSION['success'] = "Salary configuration has been added successfully";
     echo '<script>window.location="'.SITE_URL.'/?page=list_employee"</script>';
}

include('includes/header_after_login.php');

?>




    
      <!-- page content -->
      <div class="right_col" role="main">
         Salary Configuration
        <!-- top tiles -->
        <div class="row tile_count">
          
           <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Salary Configuration<small>For Salary Configuration</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                  
                    </li>
                    <li class="dropdown">
                       <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
                        <script src="js/ajjquery.min"></script> 
                         <script type="text/javascript">
            $(document).ready(function() {
              $('#birthday').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
              }, function(start, end, label) {
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
                  <?php if(!empty($error_message)) { ?>
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
                  <?php 
                    if($emp_dtls['emp_type_id']==2){
                    ?>
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

                   <input type="hidden" id="vend_id" placeholder="Customer Name" name="emp_id"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" value="<?php echo $emp_dtls['id']; ?>" required />
<!--                   <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Vendor Type</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="vender_type" data-style="input-sm btn-default" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12">
											<option value="">Choose Vendor Type</option>
											<?php
												if($type_list_num > 0) {
													while($type_list_array = mysql_fetch_assoc($type_list_query)) 
													{
											?>
			<option value="<?php echo $type_list_array['id']; ?>" <?php if(!empty($select_fetch['vender_type']) && $select_fetch['vender_type'] == $type_list_array['id']) { echo "selected"; } ?>><?php echo $type_list_array['vender_type']; ?></option>
											<?php	
													}
												}
												else {
											?>
												<option value="">No Type Available</option>
											<?php } ?>
											</select>
                      </div>
                    </div>-->
                    
                      <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Employee Name</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $emp_dtls['name'];?>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Basic</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="basic" autocomplete="off" placeholder="Basic Salary" value="<?php echo $select_fetch['basic'];?>" onkeyup="calculateGross();"  name="basic"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">DA</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="da" autocomplete="off" placeholder="DA" value="<?php echo $select_fetch['da'];?>"  name="da" onkeyup="calculateGross();"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">HRA</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="hra" autocomplete="off" placeholder="HRA" value="<?php echo $select_fetch['hra'];?>"  name="hra" onkeyup="calculateGross();"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gross</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <span id="gross_sal"><?php echo $select_fetch['gross'];?></span>
                          <input type="hidden" id="gross" value="<?php echo $select_fetch['gross'];?>" name="gross"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
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
                  
                  <?php }else {?>
                   <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

                   <input type="hidden" id="vend_id" placeholder="Customer Name" name="emp_id"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" value="<?php echo $emp_dtls['id']; ?>" required />
<!--                   <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Vendor Type</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="vender_type" data-style="input-sm btn-default" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12">
											<option value="">Choose Vendor Type</option>
											<?php
												if($type_list_num > 0) {
													while($type_list_array = mysql_fetch_assoc($type_list_query)) 
													{
											?>
			<option value="<?php echo $type_list_array['id']; ?>" <?php if(!empty($select_fetch['vender_type']) && $select_fetch['vender_type'] == $type_list_array['id']) { echo "selected"; } ?>><?php echo $type_list_array['vender_type']; ?></option>
											<?php	
													}
												}
												else {
											?>
												<option value="">No Type Available</option>
											<?php } ?>
											</select>
                      </div>
                    </div>-->
                    
                      <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Employee Name</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $emp_dtls['name'];?>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Select Order</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <span id="gross_sal"></span>
                          <select name="order_id" id="order_id" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required="">
                                    <option value="">Select Order</option>
                                    <?php
                                    $orderList = mysql_query("select subhecha_order_details.*,subhecha_customer.customer_name from subhecha_order_details inner join subhecha_customer on subhecha_customer.id =subhecha_order_details.customer_id   order by subhecha_order_details.date desc limit 0,10");
                                    while ($orderListDtl = mysql_fetch_assoc($orderList)) {
                                        ?>
                                        <option value="<?php echo $orderListDtl['order_id'] ?>"> <?php echo 'Date--' . date('F j ,Y', strtotime($orderListDtl['date'])) . '--Purpose--' . $orderListDtl['purpose'] . '--Customer Name--' . $orderListDtl['customer_name'] ;?></option>
                                    <?php } ?>
                                </select>
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gross</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <span id="gross_sal"></span>
                          <input type="text" id="gross" value="" name="gross"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                    
                                      
                   
                    <div class="ln_solid"></div>
                    <div class="form-group">

                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                           
                        <button type="submit" class="btn btn-success" name="temp-submit">Submit</button>
                        <button type="reset" class="btn btn-primary">Cancel</button>
                        
                      </div>
                    </div>

                  </form>
                  <?php }?>
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
       
       function calculateGross(){
           var basic = $.trim($('#basic').val());
           if (basic == ''){
               basic = 0;
           }
           var da = $.trim($('#da').val());
           if(da == ''){
               da = 0;
           }
           var hra = $.trim($('#hra').val());
           if(hra == ''){
               hra = 0;
           }
                      
           var gross = parseFloat(basic)+parseFloat(da)+parseFloat(hra);
           $('#gross_sal').html(gross);
           $('#gross').val(gross);
       }
       
      </script>
     

 <?php include('includes/footer_after_login.php'); ?>
