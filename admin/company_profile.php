<?php
//FOLLOWING CODE WILL BE USED TO ADD IMPORTERS ....
if(!empty($_REQUEST['userId']))
    $userId = $_REQUEST['userId'];
else
    $userId = '';
	
//GENERATING SUCCESS MESSAGES AS FOLLOWS ...
if(isset($_REQUEST['msg']))
{
	if($_REQUEST['msg'] == 'ins')
		$_SESSION['success'] = "Company profile has been added successfully";
	
	if($_REQUEST['msg'] == 'update')
		$_SESSION['success'] = "Company profile has been updated successfully";		
}
else
{
	$_SESSION['success'] = '';
}


//CODE TO GET COUNTRY LIST FOR COMPANY ...
$country_list_sql = "SELECT  
						id, country_name 
					 FROM ".LOCATION." 
					 WHERE 1";

$country_list_query = mysql_query($country_list_sql);
$country_list_num	= mysql_num_rows($country_list_query);

//CODE TO GET COMPANY DETAILS AT THE TIME OF EDIT COMPANY PROFILE ...
$importer_det_sql = "SELECT * FROM ".COMPANY_MASTER." WHERE company_type = 1"; 
$importer_det_query = mysql_query($importer_det_sql); 
$importer_det_array = mysql_fetch_assoc($importer_det_query);     



//CODE TO CREATE OR UPDATE COMPANY DETAILS INCLUDING BANK DETAILS .....
if(isset($_POST['submit']))
{
    ## Generating values to all variables ##
    $first_name         = $_POST['full_name'];
    $email              = $_POST['email'];
    $phone              = $_POST['phone'];
	$mobile             = $_POST['mobile'];
    $company_name       = $_POST['company_name'];
	$company_address    = $_POST['company_address'];
	
	$company_vat_reg    = $_POST['vat_reg_no'];
	$company_vat_tin    = $_POST['vat_tin_no'];
	$company_pan_no		= $_POST['company_pan'];
	$irc_no				= $_POST['irc_no'];
	$comp_code			= $_POST['comp_code'];
	$country       		= $_POST['country'];
    ## Generating values to all variables ##
	
	$check_empty_primary_sql = "SELECT COUNT(id) AS TotalNo FROM ".COMPANY_MASTER." WHERE company_type = 1";
	$check_empty_primary_que = mysql_query($check_empty_primary_sql);
	$check_empty_primary_arr = mysql_fetch_assoc($check_empty_primary_que);
	
    
    if((int)$check_empty_primary_arr['TotalNo'] === 0)
    {
        $importer_sql = "INSERT INTO ".COMPANY_MASTER." 
                            SET 
                            contact_person = '".$first_name."',email = '".$email."', phone = '".$phone."', 
							mobile = '".$mobile."', company_name = '".$company_name."', company_pan = '".$company_pan_no."', 
							company_vat = '".$company_vat_reg."', company_vat_tin = '".$company_vat_tin."', 
							irc_no = '".$irc_no."', company_code = '".$comp_code."', company_address = '".$company_address."', 
							country_id = '".$country."', reg_date = '".date("Y-m-d H:i:s")."', company_type = 1 
                        ";
        $importer_sql_qu = mysql_query($importer_sql);
		 
		 echo '<script>window.location="'.SITE_URL.'/?page=company_profile&msg=ins&action=edit";</script>';                                                   
    }
    else
    {
        $importer_sql = "UPDATE ".COMPANY_MASTER." 
                         SET 
                            contact_person = '".$first_name."',email = '".$email."', phone = '".$phone."', 
							mobile = '".$mobile."', company_name = '".$company_name."', company_pan = '".$company_pan_no."', 
							company_vat = '".$company_vat_reg."', company_vat_tin = '".$company_vat_tin."', 
							irc_no = '".$irc_no."', company_code = '".$comp_code."', company_address = '".$company_address."', 
							country_id = '".$country."'
                         WHERE 
                            company_type = 1    
                        ";
        $importer_sql_qu = mysql_query($importer_sql);

		 echo '<script>window.location="'.SITE_URL.'/?page=company_profile&msg=update&action=edit";</script>';                     
    }
    
}

 
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

include('includes/header_after_login.php');
?>




              
      <!-- page content -->
      <div class="right_col" role="main">
        Add Company Information
        <!-- top tiles -->
        <div class="row tile_count">
          
           <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Company Information<small>Details Of Company Information</small></h2>
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" name="company_name" id="company_name" value="<?php if(!empty($importer_det_array['company_name'])) echo $importer_det_array['company_name']; ?>" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Address <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <textarea name="company_address" required="required" parsley-minwords="3" placeholder=""  class="form-control col-md-7 col-xs-12" rows="5"><?php if(!empty($importer_det_array['company_address'])) echo $importer_det_array['company_address']; ?></textarea>			
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Choose Country <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                       <select name="country" class="form-control col-md-7 col-xs-12">
											<option value="">Choose country</option>
											<?php
												if($country_list_num > 0) {
													while($country_list_array = mysql_fetch_assoc($country_list_query)) 
													{
											?>
												<option value="<?php echo $country_list_array['id']; ?>" <?php if(!empty($importer_det_array['country_id']) && $importer_det_array['country_id'] == $country_list_array['id']) { echo "selected"; } ?>><?php echo $country_list_array['country_name']; ?></option>
											<?php	
													}
												}
												else {
											?>
												<option value="">No Country Available</option>
											<?php } ?>	
											</select>
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Code <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                       <input type="text" name="comp_code" required="required" value="<?php if(!empty($importer_det_array['company_code'])) echo $importer_det_array['company_code']; ?>"  class="form-control col-md-7 col-xs-12" > 
                      </div>
                    </div>
                    
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vat Registration No <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="vat_reg_no" class="form-control col-md-7 col-xs-12"  value="<?php if(!empty($importer_det_array['company_vat'])) echo $importer_det_array['company_vat']; ?>" required>
                      </div>
                    </div>
                    
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vat Tin No<span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                       <input type="text" name="vat_tin_no" class="form-control col-md-7 col-xs-12" value="<?php if(!empty($importer_det_array['company_vat_tin'])) echo $importer_det_array['company_vat_tin']; ?>" required>
                      </div>
                    </div>
                    
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">IRC Number <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="irc_no" class="form-control col-md-7 col-xs-12" value="<?php if(!empty($importer_det_array['irc_no'])) echo $importer_det_array['irc_no']; ?>" required> 
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Pan Number<span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="company_pan" class="form-control col-md-7 col-xs-12" value="<?php if(!empty($importer_det_array['company_pan'])) echo $importer_det_array['company_pan']; ?>" required>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name<span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" name="full_name" class="form-control col-md-7 col-xs-12" value="<?php if(!empty($importer_det_array['contact_person'])) echo $importer_det_array['contact_person']; ?>" required>
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email ID:<span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="email" name="email" class="form-control col-md-7 col-xs-12"  value="<?php if(!empty($importer_det_array['email'])) echo $importer_det_array['email']; ?>" required>
                      </div>
                    </div>
                    
                    
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Phone Number <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="phone" value="<?php if(!empty($importer_det_array['phone'])) echo $importer_det_array['phone']; ?>" class="form-control col-md-7 col-xs-12" required>
                      </div>
                    </div>
                    
                    
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mobile Number <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="mobile" value="<?php if(!empty($importer_det_array['mobile'])) echo $importer_det_array['mobile']; ?>" class="form-control col-md-7 col-xs-12" re>
                      </div>
                    </div>
                    
                                   
                   
                   
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <?php if(empty($_GET['mode'])) { ?>
						<button type="submit" class="btn btn-success" name="submit">Submit</button>
                        <button type="reset" class="btn btn-primary">Cancel</button>
                                   <?php } if(!empty($userId)) { ?> 
                                <input type="hidden" name="userId" value="<?php echo $userId; ?>" /> 
                                <?php } ?>
                        
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
