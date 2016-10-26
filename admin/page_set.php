
<?php 
 
//NOTIFICATION MESSAGE GENERATION ....
if(isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
}
else {
	$id = '';	
}

if(!empty($_SESSION['success']))
{
	$success_msg = $_SESSION['success'];
    unset($_SESSION['success']);
}	

//THIS CODE IS USED FOR EDIT OPTION OF SITE SETTINGS ..
  $page_det_sql = "SELECT 
						id, site_name, meta_title, meta_description, base_url, base_path, Result_per_page
						FROM ".SITE_SETTING." 
						WHERE type = 1"; 
     
    $page_det_query = mysql_query($page_det_sql); 
    $page_det_array = mysql_fetch_assoc($page_det_query);     

	
	

//FOLLOWING CODE WILL ADD / EDIT SITE INFORMATION
if(isset($_POST['submit']))
{
	## Generating values to all variables ##
	$site_name 	      = $_POST['site_name'];
	$meta_title	      = $_POST['meta_title'];
	$meta_description = $_POST['meta_description'];
	$base_url	      = $_POST['base_url'];
	$base_path        = $_POST['base_path'];
	$Result_per_page  = $_POST['Result_per_page'];
	
	
	 ## Generating values to all variables ##
	
	$check_empty_primary_sql = "SELECT COUNT(id) AS TotalNo FROM ".SITE_SETTING." WHERE type = 1";
	$check_empty_primary_que = mysql_query($check_empty_primary_sql);
	$check_empty_primary_arr = mysql_fetch_assoc($check_empty_primary_que);
	
    
    if((int)$check_empty_primary_arr['TotalNo'] === 0)
    {
		$setting_sql = "INSERT INTO ".SITE_SETTING."
						 SET 
						 site_name        = '".$site_name."',
						 meta_title       = '".$meta_title."',
						 meta_description = '".$meta_description."',
						 base_url         = '".$base_url."',
						 base_path        = '".$base_path."',
						 Result_per_page  = '".$Result_per_page."'
						 ";
		mysql_query($setting_sql);
		$_SESSION['success'] = " Site settings has been created successfully";
        echo '<script>window.location="'.SITE_URL.'/?page=page_set"</script>';
	}
	else
	{
		$setting_sql = "UPDATE ".SITE_SETTING." 
						SET 
						 site_name        = '".$site_name."',
						 meta_title       = '".$meta_title."',
						 meta_description = '".$meta_description."',
						 base_url         = '".$base_url."',
						 base_path        = '".$base_path."',
						 Result_per_page  = '".$Result_per_page."'
						 WHERE type = '1'";
		mysql_query($setting_sql);
		$_SESSION['success'] = "Site Settings has been updated successfully";
        echo '<script>window.location="'.SITE_URL.'/?page=page_set&action=edit"</script>';		
	}
	
}
 
include('includes/header_after_login.php');

?>




    
      <!-- page content -->
      <div class="right_col" role="main">
        Site Setting
        <!-- top tiles -->
        <div class="row tile_count">
          
           <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Site Setting<small>For Config the Page</small></h2>
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Name <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" id="site_name" placeholder="Site Name" name="site_name"  value="<?php if(!empty($page_det_array['site_name'])) echo $page_det_array['site_name']; ?>" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Meta Title <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" id="meta_title" placeholder="Meta Title" name="meta_title" value="<?php if(!empty($page_det_array['meta_title'])) echo $page_det_array['meta_title']; ?>" class="form-control col-md-7 col-xs-12" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Meta Description</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="meta_description" placeholder="Meta Description" name="meta_description" value="<?php if(!empty($page_det_array['meta_description'])) echo $page_det_array['meta_description']; ?>" class="form-control col-md-7 col-xs-12" required="required" >
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Base Url</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="base_url" placeholder="Base Url" name="base_url" value="<?php if(!empty($page_det_array['base_url'])) echo $page_det_array['base_url']; ?>" class="form-control col-md-7 col-xs-12" required="required">
                      </div>
                    </div>
                       <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Base Path</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control col-md-7 col-xs-12" id="base_path" placeholder="Base Path" name="base_path"  value="<?php if(!empty($page_det_array['base_path'])) echo $page_det_array['base_path']; ?>" required="required">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Result Per Page</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control col-md-7 col-xs-12" id="Result_per_page" placeholder="Result Per Page" name="Result_per_page"  value="<?php if(!empty($page_det_array['Result_per_page'])) echo $page_det_array['Result_per_page']; ?>" required="required">
                      </div>
                    </div>
                   
                   
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <?php if(!empty($countryId)) { ?> 
			                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
			                                <?php } ?>
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
