
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

// FOLLOWING CODE IS FOR SUCCESS MESSAGE
if(isset($_GET['msg']))
{
	if($_GET['msg'] == 'deleted')
	{
		$success_msg = $_SESSION['success'];
		unset($_SESSION['success']);
	}
	else
    {
	$success_msg = '';
    }
}
else{
	unset($_SESSION['success']);
	}
// FOLLOWING CODE WILL DELETE THE CATEGORY ....
if(!empty($_REQUEST['id']))
    $id = $_REQUEST['id'];
else
    $id = '';


// FOLLOWING CODE IS FOR FETCHING THE DATA OF CATEGORY
 
$use_list_sql = "SELECT * FROM ".CUSTOMER_ORDER." WHERE 1";
$use_list_query = mysql_query($use_list_sql);

if($use_list_query)
{
	$use_list_rows = mysql_num_rows($use_list_query);
}
else
{
	$use_list_rows = 0;
} 

if(isset($_GET['action']) && $_GET['action'] == 'delete')
{
    $sql1 = "DELETE FROM ".USER_DETAILS." WHERE user_id = '".$id."'";  
    $ret1 = mysql_query($sql1);
  
    $sql12 = "DELETE FROM ".USER_MASTER." WHERE user_id = '".$id."'";  
    $ret12 = mysql_query($sql12);
	
	$_SESSION['success'] = "Employee has been deleted successfully";
    echo '<script>window.location="'.SITE_URL.'/?page=employee_list&msg=deleted";</script>';
}
 
 
include('includes/header_after_login.php');
 
 ?>
     <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
                        
                    
                      <script src="js/ajjquery.min.js"></script>
                             <script>
									$(document).ready(function() {
		                              $("#sele").on("change", function () { 
		                                var id = $(this).val();
	                               // alert("Hiiii...");
	                                     $.ajax({
											    type : 'post',
                                                 url: 'get_value_ajax.php',	          
		                                         data: 'vval='+id,
                                               success: function (data) {
												   if(data == 'YES'){
                                               		//$('#cust').html(data);
													//$("#sele option:selected" ).text();
													$('#cust').show();
												   }else if(data == 'NO'){
													   //$("#sele option:selected" ).text();
													   $('#cust').hide();
													   }
	                                             }
                                                });			
			
		                                    });
	                                    });

									</script>
                         <!-- <script type="text/javascript">
                               function ShowHideDiv() {
                                var dd = document.getElementById("sele");
                                var dv = document.getElementById("cust");
								dt.style.display = dd.value == "NO" ? "block" : "none";
                                 }
                          </script>-->
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>
                    Order List
                    <small>
                        All Order List
                    </small>
                </h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Customer<small>Order List</small></h2>
                   
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <p class="text-muted font-13 m-b-30">
                    </code>
                  </p>
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                     <tr role="row">
                                                <th>SL.No.</th>
												<th>Customer Name</th>
                                                <th>Date.</th>
                                                <th>Time</th> 
                                                <th>Action</th>
                                            </tr>
                    </thead>


                    <tbody>
                      <?php
											if($use_list_rows > 0) {
												$c = 1;
												while($col_list_array = mysql_fetch_assoc($use_list_query)) {
										?>
                                           <tr>
                                                <td><?php echo $c++; ?></td>
												<td><?php $cust_id = $col_list_array['customer_id']; 
												$co_list_sql = "SELECT customer_name, customer_phone FROM ".CUSTOMER." WHERE id = '".$cust_id."'";
                                                $co_list_query = mysql_query($co_list_sql);
                                                $co_fetch = mysql_fetch_assoc($co_list_query);
												$phn  = $co_fetch['customer_phone'];
												$name = $co_fetch['customer_name'];
											    $dfd  = $name ."- ".$phn ;
												echo $dfd;
												?></td>
                                                <td><?php echo $col_list_array['date']; ?></td>
                                                <td><?php echo $col_list_array['purpose']; ?></td>
                                           <td class="text-center">
                 <a class="btn btn-dark" title="Order" href="?page=view_customer_order&oid=<?php echo $col_list_array['order_id'];?>&action=order"><i class="fa fa-circle"></i></a>
               
                    <a class="btn btn-dark" title="Payment_log"href="?page=view_payment_log&oid=<?php echo $col_list_array['order_id'];?>&action=order"><i class="fa fa-circle"></i></a>
                                                </td>
                                            </tr>
                    <?php
												}
											}
					?>
                     <tr role="row">
                                                <th>SL.No.</th>
												<th>Customer Name</th>
                                                <th>Date</th>
                                                <th>Time</th> 
                                                <th>Action</th>
                                            </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              </div>
             </div>
             </div>   
            </div>
          </div>
            <!-- /page content 
             <script src="js/bootstrap.min.js"></script>-->

        <!-- bootstrap progress js 
        <script src="js/progressbar/bootstrap-progressbar.min.js"></script>-->
        <!-- icheck 
        <script src="js/icheck/icheck.min.js"></script>

        <script src="js/custom.js"></script>-->


        <!-- Datatables -->
        <!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

        <!-- Datatables-->
        <script src="js/datatables/jquery.dataTables.min.js"></script>
        <script src="js/datatables/dataTables.bootstrap.js"></script>
        <script src="js/datatables/dataTables.buttons.min.js"></script>
        <script src="js/datatables/buttons.bootstrap.min.js"></script>
        <script src="js/datatables/jszip.min.js"></script>
        <script src="js/datatables/pdfmake.min.js"></script>
        <script src="js/datatables/vfs_fonts.js"></script>
        <script src="js/datatables/buttons.html5.min.js"></script>
        <script src="js/datatables/buttons.print.min.js"></script>
        <script src="js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="js/datatables/dataTables.keyTable.min.js"></script>
        <script src="js/datatables/dataTables.responsive.min.js"></script>
        <script src="js/datatables/responsive.bootstrap.min.js"></script>
        <script src="js/datatables/dataTables.scroller.min.js"></script>

            <!-- pace -->
        <script src="js/pace/pace.min.js"></script>
        <script>
          var handleDataTableButtons = function() {
              "use strict";
              0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
                responsive: !0
              })
            },
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
        </script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
          TableManageButtons.init();
        </script>

     

 <?php include('includes/footer_after_login.php'); ?>
