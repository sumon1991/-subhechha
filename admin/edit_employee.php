<?php 
error_reporting(0);
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
$select_cust  = "SELECT * FROM ".EMP_MASTER." WHERE id = '".$id."'";
$query_select = mysql_query($select_cust);
$select_fetch = mysql_fetch_assoc($query_select); 

//FOLLOWING CODE WILL EDIT THE EMPLOYEE TYPE INFORMATION
if(isset($_POST['submit']))
{
	$emp_id      = $_POST['emp_id'];
	$emp_type_id     = $_POST['emp_type_id'];
	$emp_type_cat_id = $_POST['emp_type_cat_id'];
	$name            = $_POST['name'];
	$contact_number  = $_POST['contact_number'];
	$phone_number    = $_POST['phone_number'];
	$emalid          = $_POST['emalid'];
	$address         = $_POST['address'];
	$description     = $_POST['description'];
	
	
	
	$sql_cust = "UPDATE ".EMP_MASTER." 
	             SET
				         emp_type_id         = '".$emp_type_id."',
						 emp_type_cat_id     = '".$emp_type_cat_id."',
						 name                = '".$name."',
						 contact_number      = '".$contact_number."',
						 phone_number        = '".$phone_number."',
						 emalid              = '".$emalid."',
				         address             = '".$address."',  
						 description         = '".$description."'
	             WHERE 
				         id                      = '".$emp_id."' 
				     					 
				 ";	 
	 $sql_insert = mysql_query($sql_cust);
	 if($sql_insert > 0){
		  $_SESSION['success'] = "Employee has been Update successfully";
        echo '<script>window.location="'.SITE_URL.'/?page=list_employee"</script>';
		}else{
			$_SESSION['error'] = "Employee has been Already Added or Not Properly added..";
        echo '<script>window.location="'.SITE_URL.'/?page=list_employee"</script>';
	 }	
}


// Following code is for Employee type fetching
$type_list_sql = "SELECT * 
					 FROM ".EMP_TYPE." 
					 WHERE 1";

$type_list_query = mysql_query($type_list_sql);
$type_list_num	= mysql_num_rows($type_list_query);




include('includes/header_after_login.php');

?>




    
      <!-- page content -->
      <div class="right_col" role="main">
        Employee Type Name Edit
        <!-- top tiles -->
        <div class="row tile_count">
          
           <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Employee Type Edit<small>For Employee Type Edit</small></h2>
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
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

                   <input type="hidden" id="emp_id" placeholder="Customer Name" name="emp_id"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" value="<?php echo $id;?>" required />
                     <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Employee Category</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="emp_type_id" id="employee_type_id" data-style="input-sm btn-default" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12">
											<option value="">Choose Employee Category</option>
											<?php
												if($type_list_num > 0) {
													while($type_list_array = mysql_fetch_assoc($type_list_query)) 
													{
											?>
			<option value="<?php echo $type_list_array['id']; ?>" <?php if(!empty($select_fetch['emp_type_id']) && $select_fetch['emp_type_id'] == $type_list_array['id']) { echo "selected"; } ?>><?php echo $type_list_array['type_name']; ?></option>
											<?php	
													}
												}
												else {
											?>
												<option value="">No Category Available</option>
											<?php } ?>
											</select>
                      </div>
                    </div>
                     <script>
									$(document).ready(function() {
		                              $("#employee_type_id").on("change", function () { 
		                                var id = $(this).val();
	                              // alert("Hiiii..."+id);
	                                     $.ajax({
                                                 url: 'get_sub_cat_ajax.php',	          
		                                         data: 'em_id='+id,
                                               success: function (data) {
												   if(data != ''){
                                               		$('#sub_cat').html(data);
													$('#hide').show();
													
												   }else{
													   $('#hide').hide();
													  
													   }
	                                             }
                                                });			
			
		                                    });
	                                    });

									</script>
            
                <?php
				     $subcat  = $select_fetch['emp_type_cat_id'];
					 $sql_cat = "SELECT id, employee_type_category_name FROM ".EMP_TYPE_CAT." WHERE id = '".$subcat."'";
					 $que_cat = mysql_query($sql_cat);
					 $fet_cat = mysql_fetch_assoc($que_cat);  
				?>                    
                
                  <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Employee Sub-Catagory</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="emp_type_cat_id" id="sub_cat" data-style="input-sm btn-default" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12">
										<option value="<?php echo $fet_cat['id']; ?>"><?php echo $fet_cat['employee_type_category_name']; ?></option>	
											</select>
                      </div>
                    </div>
                  
                  
                  
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Employee Name</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="name" placeholder="Employee Name" name="name" value="<?php echo $select_fetch['name'];?>" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Number</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="contact_number" placeholder="Contact Number" name="contact_number" value="<?php echo $select_fetch['contact_number'];?>" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="phone_number" placeholder="Phone Number" name="phone_number" value="<?php echo $select_fetch['phone_number'];?>" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Id</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="email" id="emalid" placeholder="Email ID" name="emalid" value="<?php echo $select_fetch['emalid'];?>" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea  name="address" id="address" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12 col-md-7 col-xs-12" placeholder="Address" required><?php echo $select_fetch['address'];?></textarea>
                      </div>
                    </div> 
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea  name="description" id="description" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12 col-md-7 col-xs-12" placeholder="Description" required><?php echo $select_fetch['description'];?></textarea>
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

     

 <?php include('includes/footer_after_login.php'); ?>
