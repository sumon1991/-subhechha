
<?php 
include('includes/header_after_login.php');
?>
<?php

  // FOLLOWING CODE IS FOR FETCHING THE DATA OF CATEGORY
   
  $use_list_sql = "SELECT * FROM ".CUSTOMER." WHERE status = '1' ORDER BY id DESC LIMIT 5";
  $use_list_query = mysql_query($use_list_sql);

  if($use_list_query)
  {
    $use_list_rows = mysql_num_rows($use_list_query);
  }
  else
  {
    $use_list_rows = 0;
  }

  $order_list_sql = "SELECT * FROM `subhechha_payment_log` WHERE `total_price_payable` > 0 AND  is_archive = '0' Limit 10";
  $order_list_query = mysql_query($order_list_sql);

  if($order_list_query)
  {
    $order_list_rows = mysql_num_rows($order_list_query);
    $order_list_array = [];
    $count = 0;
    while($value = mysql_fetch_assoc($order_list_query)) {
      $order_sql = "SELECT * FROM ".CUSTOMER_ORDER." WHERE order_id = '".$value['order_id']."' AND  is_archive = '0'";
      $order_query = mysql_query($order_sql);
      $nr = mysql_num_rows($order_query);
      if($nr){
        $order_list_array[$count] = mysql_fetch_assoc($order_query);
        $count++;
      }
    }

  }
  else
  {
    $order_list_rows = 0;
  }
?>




      <!-- page content -->
      <div class="right_col" role="main">

        <!-- top tiles -->
        <div class="row tile_count">
          Dashboard
         

        </div>
        <!-- /top tiles -->

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

              <!-- <div class="row x_title">
                
                dsadsadasd
              </div> -->

             
              <!-- <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                

                <div class="col-md-12 col-sm-12 col-xs-6">
                 
                  sdsadsadasd
                </div>
                
                  

              </div> -->

              <div class="col-md-6 col-sm-6 col-xs-6" style="float:left;">
                <div class="x_panel">
                  <div class="x_title">
                     <h2>Newly Added Customer List</h2>
                     <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      </code>
                    </p>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr role="row">
                          <th>SL.No.</th>
                          <th>Name</th>
                          <th>Phone No.</th>
                          <th>Email-ID</th>
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
                                <td><?php echo $col_list_array['customer_name']; ?></td>
                                <td><?php echo $col_list_array['customer_phone']; ?></td>
                                <td><?php echo $col_list_array['customer_email']; ?></td>
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
                          <th>Name</th>
                          <th>Phone No.</th>
                          <th>Email-ID</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6" style="float:left;">
                <div class="x_panel">
                  <div class="x_title">
                     <h2>Order List(Due) </h2>
                     <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      </code>
                    </p>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr role="row">
                          <th>SL.No.</th>
                          <th>Customer Name</th>
                          <th>Phone</th>
                          <th>Date</th>
                          <th>Purpose</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          if(count($order_list_array) > 0) {
                            $c = 1;
                            foreach ($order_list_array as $key => $value) {

                              $user_sql = "SELECT * FROM ".CUSTOMER." WHERE status = '1' AND id = '".$value['customer_id']."'";
                              $use_list_query = mysql_query($user_sql);
                              $user_array = mysql_fetch_assoc($use_list_query);
                        ?>
                              <tr>
                                <td><?php echo $c++; ?></td>
                                <td>
                                  <?php 
                                    echo $user_array['customer_name']; 
                                  ?>
                                </td>
                                <td>
                                  <?php 
                                    echo $user_array['customer_phone']; 
                                  ?>
                                </td>
                                <td><?php echo $value['date']; ?></td>
                                <td><?php echo $value['purpose']; ?></td>
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
                          <th>Customer Name</th>
                          <th>Phone</th>
                          <th>Date</th>
                          <th>Purpose</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <!-- <div class="col-md-6 col-sm-6 col-xs-6" style="float:left;">
                <div class="x_panel">
                  <div class="x_title">
                     <h2>Order List </h2>
                     <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      </code>
                    </p>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr role="row">
                          <th>SL.No.</th>
                          <th>Name</th>
                          <th>Phone No.</th>
                          <th>Email-ID</th>
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
                                <td><?php echo $col_list_array['customer_name']; ?></td>
                                <td><?php echo $col_list_array['customer_phone']; ?></td>
                                <td><?php echo $col_list_array['customer_email']; ?></td>
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
                          <th>Name</th>
                          <th>Phone No.</th>
                          <th>Email-ID</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6" style="float:left;">
                <div class="x_panel">
                  <div class="x_title">
                     <h2>Order List </h2>
                     <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      </code>
                    </p>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr role="row">
                          <th>SL.No.</th>
                          <th>Name</th>
                          <th>Phone No.</th>
                          <th>Email-ID</th>
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
                                <td><?php echo $col_list_array['customer_name']; ?></td>
                                <td><?php echo $col_list_array['customer_phone']; ?></td>
                                <td><?php echo $col_list_array['customer_email']; ?></td>
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
                          <th>Name</th>
                          <th>Phone No.</th>
                          <th>Email-ID</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div> -->
            </div>
          </div>

        </div>
        <br />

        <div class="row">


         

        <!-- <div class="row">
          dsdsadsdsad
          </div>


          <div class="col-md-8 col-sm-8 col-xs-12">



            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                sadsadsad
              </div>

            </div>
            <div class="row"> -->


             
              
              <!-- start of weather widget -->
              <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  sadsadsadsa
                  </div>
                </div>

              </div> -->
              <!-- end of weather widget -->
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

     

 <?php include('includes/footer_after_login.php'); ?>
