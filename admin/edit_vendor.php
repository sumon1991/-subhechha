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
$select_cust  = "SELECT * FROM ".VEND_MASTER." WHERE id = '".$id."'";
$query_select = mysql_query($select_cust);
$select_fetch = mysql_fetch_assoc($query_select); 

//FOLLOWING CODE WILL EDIT THE EMPLOYEE TYPE INFORMATION
if(isset($_POST['submit']))
{
	$vend_id           = $_POST['vend_id'];
	$vender_type       = $_POST['vender_type'];
	$name              = $_POST['name'];
	$contact_number    = $_POST['contact_number'];
	$phone_number      = $_POST['phone_number'];
	$email             = $_POST['email'];
	$address           = $_POST['address'];
	$description       = $_POST['description'];
	
	
	$sql_cust = "UPDATE ".VEND_MASTER." 
	             SET
				         vender_type         = '".$vender_type."',
						 name                = '".$name."',
						 contact_number      = '".$contact_number."',
						 phone_number        = '".$phone_number."',
						 email               = '".$email."',
				         address             = '".$address."',  
						 description         = '".$description."'
	             WHERE 
				         id                      = '".$vend_id."' 
				     					 
				 ";	 
	 $sql_insert = mysql_query($sql_cust);
	 if($sql_insert > 0){
		  $_SESSION['success'] = "Vendor has been Update successfully";
        echo '<script>window.location="'.SITE_URL.'/?page=list_vendor"</script>';
		}else{
			$_SESSION['error'] = "Vendor has been Already Added or Not Properly added..";
        echo '<script>window.location="'.SITE_URL.'/?page=list_vendor"</script>';
	 }	
}


// Following code is for Employee type fetching
$type_list_sql = "SELECT * 
					 FROM ".VEND_TYPE." 
					 WHERE 1";

$type_list_query = mysql_query($type_list_sql);
$type_list_num	= mysql_num_rows($type_list_query);

include('includes/header_after_login.php');

?>




    
      <!-- page content -->
      <div class="right_col" role="main">
         Vendor Edit
        <!-- top tiles -->
        <div class="row tile_count">
          
           <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Vendor Edit<small>For vendor Type Edit</small></h2>
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

                   <input type="hidden" id="vend_id" placeholder="Customer Name" name="vend_id"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" value="<?php echo $id;?>" required />
                   <div class="form-group">
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
                    </div>
                    
                      <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="name" placeholder="Employee Category Name" value="<?php echo $select_fetch['name'];?>" name="name"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Number</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="contact_number" placeholder="Contact Number" value="<?php echo $select_fetch['contact_number'];?>" name="contact_number"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="phone_number" placeholder="Phone Number" value="<?php echo $select_fetch['phone_number'];?>" name="phone_number"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="email" placeholder="Email" value="<?php echo $select_fetch['email'];?>" name="email"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="address" placeholder="Address" value="<?php echo $select_fetch['address'];?>" name="address"  class="form-control col-md-7 col-xs-12 col-md-7 col-xs-12" required />
                      </div>
                    </div>
                    
                    
                   
                    
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Description</label>
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
