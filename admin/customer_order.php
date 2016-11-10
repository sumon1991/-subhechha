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
   
   
   
   
   
    //CODE TO GET CUSTOMER DETAILS AT THE TIME OF EDIT COMPANY PROFILE ...
    $cust_sql = "SELECT * FROM ".CUSTOMER." WHERE id = '".$id."'"; 
    $cust_query = mysql_query($cust_sql); 
    $cust_fetch = mysql_fetch_assoc($cust_query); 

    $sql = "SELECT * FROM ".CUSTOMER_ORDER." WHERE is_archive = '0' AND customer_id = '".$id."'";
    $res = mysql_query($sql);
    $num_rows = mysql_num_rows($res);
   
   include('includes/header_after_login.php');
   ?>
<!-- page content -->
<div class="right_col" role="main">
   Customer Order List
   <!-- top tiles -->
   <div class="row tile_count">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_title">
               <h2>Order List For <?php echo $cust_fetch['customer_name'];?> </h2>
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
               <strong>Success!</strong> <?php echo $success_msg; ?>.
            </div>
            <!-- END OF SUCCESS BOX -->
            <?php } ?>
            <div class="x_content">
              <p class="text-muted font-13 m-b-30">
                </code>
              </p>
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr role="row">
                    <th>SL.No.</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Occation</th> 
                    <th>Invited person</th> 
                    <th>Location</th> 
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      if($num_rows > 0) {
                        $c = 1;
                        while($col_list_array = mysql_fetch_assoc($res)) {
                    ?>
                          <tr>
                            <td><?php echo $c++; ?></td>
                            <td><?php echo $col_list_array['date']; ?></td>
                            <td><?php echo $col_list_array['time']; ?></td>
                            <td><?php echo $col_list_array['purpose']; ?></td>
                            <td><?php echo $col_list_array['invitaion_person']; ?></td>
                            <td><?php echo $col_list_array['location_address']; ?></td>
                            <td class="text-center">
                              <a class="btn btn-dark" title="Edit Or View Order" href="?page=view_order&oid=<?php echo $col_list_array['order_id'];?>"><i class="fa fa-pencil-square-o"></i></a>
                              <!-- <a class="btn btn-danger" disabled="true" title="delete_order" onclick="return _deleteOrder('<?php echo $col_list_array['order_id'];?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
                              <?php 
                                $money_payable = "SELECT total_payable_money FROM ".ORDER_ITEM." WHERE order_id = ".$col_list_array['order_id'];
                                $ress = mysql_query($money_payable);
                                $total_money = mysql_fetch_assoc($ress);
                                if (strtotime(date('d/m/Y')) > strtotime($col_list_array['date']) && $total_money['total_payable_money'] <= 0) { 
                              ?>
                                  <a class="btn btn-danger" title="delete_order" onclick="return _deleteOrder('<?php echo $col_list_array['order_id'];?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                              <?php }
                              else
                              { echo $date_today;?>
                                  <a class="btn btn-danger" disabled="true" title="delete_order" onclick="return _deleteOrder('<?php echo $col_list_array['order_id'];?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                             <?php }
                            ?>
                            </td>
                          </tr>
                    <?php
                        }
                      } else {
                    ?>
                    <tr>
                      <td colspan="7"> No data to show</td>
                    </tr>
                    <?php
                      }
                    ?>
                    <tr role="row">
                      <th>SL.No.</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Occation</th> 
                      <th>Invited person</th> 
                      <th>Location</th> 
                      <th>Action</th>
                    </tr>
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
   function loader() {
    $(this).attr('disabled', 'true');
   }
   function _deleteOrder(id) {
    //alert(id);
    var isConfirm = confirm("Are You Sure ?");
    if (isConfirm) {
      $.ajax({
        url: 'delete_external.php',
        type: "post",
        data: {id: id},
        success: function(data) {
          if (data == 1) {
            location.reload();
          }
          else
          {
            alert(data);
          }
        }
      });
    }
    else
    {
      
    }
   }
</script>
<?php include('includes/footer_after_login.php'); ?>