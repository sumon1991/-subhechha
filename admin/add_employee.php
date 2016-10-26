<?php 
 
 error_reporting(0);
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


//FOLLOWING CODE WILL ADD THE EMPLOYEE TYPE INFORMATION
if(isset($_POST['submit']))
{
	$emp_type_id     = $_POST['emp_type_id'];
	$emp_type_cat_id = $_POST['emp_type_cat_id'];
	$name            = $_POST['name'];
	$contact_number  = $_POST['contact_number'];
	$phone_number    = $_POST['phone_number'];
	$emalid          = $_POST['emalid'];
	$address         = $_POST['address'];
	$description     = $_POST['description'];
	
	
	// FOR SEARCHING THE EMPLOYEE TYPE IS EXIST OR NOT
	$selec_typ   = "SELECT * FROM ".EMP_MASTER." WHERE contact_number = '".$contact_number."'";
	$selec_query =  mysql_query($selec_typ);
	$selec_rows = mysql_num_rows($selec_query);
	if($selec_rows > 0){
		$_SESSION['error'] = "Employee Type has been Already Added...";
        echo '<script>window.location="'.SITE_URL.'/?page=add_employee"</script>';
		}
	else{
	$sql_type = "INSERT INTO ".EMP_MASTER." 
	             SET
				         emp_type_id         = '".$emp_type_id."',
						 emp_type_cat_id     = '".$emp_type_cat_id."',
						 name                = '".$name."',
						 contact_number      = '".$contact_number."',
						 phone_number        = '".$phone_number."',
						 emalid              = '".$emalid."',
				         address             = '".$address."',  
						 description         = '".$description."'
						 ";
	 $sql_insert = mysql_query($sql_type);
	 
	 
	 
	if($sql_insert > 0){

		$_SESSION['success'] = "Employee has been Added successfully";
        echo '<script>window.location="'.SITE_URL.'/?page=list_employee"</script>';

	}else{

		$_SESSION['error'] = "Employee has been Already Added or Not Properly added..";
        echo '<script>window.location="'.SITE_URL.'/?page=add_employee"</script>';

	  }
 
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
       Employee Add
        <!-- top tiles -->
        <div class="row tile_count">
          
           <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Employee Add<small>For Employee Add</small></h2>
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
                     
                     <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Employee Type</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="emp_type_id" id="employee_type_id" data-style="input-sm btn-default" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12">
											<option value="">Choose Employee Type</option>
											<?php
												if($type_list_num > 0) {
													while($type_list_array = mysql_fetch_assoc($type_list_query)) 
													{
											?>
			<option value="<?php echo $type_list_array['id']; ?>"><?php echo $type_list_array['type_name']; ?></option>
											<?php	
													}
												}
												else {
											?>
												<option value="">No Type Available</option>
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
                  <div id="hide" style="display:none">
                  <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Employee Type Catagory</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="emp_type_cat_id" id="sub_cat" data-style="input-sm btn-default" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12">
											
											</select>
                      </div>
                    </div>
                  </div>
                  
                  
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Employee Name</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="name" placeholder="Employee Name" name="name" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Number</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="contact_number" placeholder="Contact Number" name="contact_number" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="phone_number" placeholder="Phone Number" name="phone_number" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email Id</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="email" id="emalid" placeholder="Email ID" name="emalid" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea  name="address" id="address" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12 col-md-7 col-xs-12" placeholder="Address" required></textarea>
                      </div>
                    </div> 
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea  name="description" id="description" class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12 col-md-7 col-xs-12" placeholder="Description" required></textarea>
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
