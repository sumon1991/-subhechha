
<?php
$bankId = $_GET['id'];
$bankDtl = mysql_fetch_assoc(mysql_query("select * from bank_details where id = '" . $bankId . "'"));

$transcationHistorySql = "SELECT bank_transfer_history.*,subhecha_vendor_master.name as vendor_name,subhecha_employee_master.name as employee_name,subhecha_customer.customer_name
                        FROM bank_transfer_history
                        LEFT JOIN subhecha_vendor_master ON bank_transfer_history.vendor_id = subhecha_vendor_master.id
                        LEFT JOIN subhecha_employee_master ON bank_transfer_history.employee_id = subhecha_employee_master.id
                        LEFT JOIN subhecha_customer ON bank_transfer_history.customer_id = subhecha_customer.id
                        WHERE bank_transfer_history.bank_id ='" . $bankId . "' 
                        ORDER BY bank_transfer_history.transcation_date DESC
                        ";

$transcationHistory = mysql_query($transcationHistorySql);

include('includes/header_after_login.php');
?>
<script type="text/javascript">
    try {
        ace.settings.check('breadcrumbs', 'fixed')
    } catch (e) {
    }
</script>
<script src="js/ajjquery.min.js"></script>
<!-- page content -->
<div class="right_col" role="main">
    <a href="?page=bank_lists"> Bank list</a>&nbsp;&nbsp;
    
    Bank Transaction History
    <br/><br/>
    <div class="">
        <div class="page-title">
            <div class="col-md-12">
                <div class="col-md-3">bank Name: <?php echo $bankDtl['bank_name']; ?></div>
                <div class="col-md-3">Branch Name: <?php echo $bankDtl['branch_name']; ?></div>
                <div class="col-md-3">Account No: <?php echo $bankDtl['acc_no']; ?></div>
                <div class="col-md-3">Balance (in Rs.): <?php echo $bankDtl['last_updated_balance']; ?></div>
            </div>
        </div>
        <br/><br/>
        <div class="x_title">
            <div align="left"><a href="?page=new_transact&bank_id=<?php echo base64_encode($bankId);?>" title="New transact">New Transaction &nbsp;<img src="images/add.png" height="25" width="25"/></a></div>
            <div class="clearfix"></div>
        </div>
        <hr/>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <h3>
            transaction History
        </h3>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        </code>
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr role="row">
                                <th>Date</th>
                                <th>Purpose</th>
                                <th>Transaction Type </th>
                                <th>Amount(Rs.)</th>
                                <th>Transact With</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <?php
                        if (mysql_num_rows($transcationHistory) > 0) {
                            while ($fetchTransaction = mysql_fetch_assoc($transcationHistory)) {
                                ?>
                                <tr>
                                    <td><?php echo date('F j,Y', strtotime($fetchTransaction['transcation_date']));
                        ; ?></td>
                                    <td><?php echo $fetchTransaction['purpose']; ?></td>
                                    <td><?php if ($fetchTransaction['transfer_type'] == 1) echo 'Debit';
                        else echo 'Credit'; ?></td>
                                    <td><?php echo $fetchTransaction['amount']; ?></td>
                                    <td>
                                        <?php
                                        if ($fetchTransaction['transact_with'] == 1) {
                                            echo $fetchTransaction['vendor_name'] . ' (Vendor)';
                                        } elseif ($fetchTransaction['transact_with'] == 2) {
                                            echo $fetchTransaction['employee_name'] . ' (Employee)';
                                        } elseif ($fetchTransaction['transact_with'] == 3) {
                                            echo 'Others';
                                        } elseif ($fetchTransaction['transact_with'] == 4) {
                                            echo $fetchTransaction['customer_name'] . ' (Customer)';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $fetchTransaction['note']; ?></td>
                                </tr>
                                    <?php }
                                } else { ?>
                            <tr>
                                <td colspan="6">No transaction found.</td>
                            </tr>
<?php } ?>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>   
</div>
</div>


<!-- pace -->
<script src="js/pace/pace.min.js"></script>
<script>
    var handleDataTableButtons = function () {
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
            TableManageButtons = function () {
                "use strict";
                return {
                    init: function () {
                        handleDataTableButtons()
                    }
                }
            }();
</script>
<?php include('includes/footer_after_login.php'); ?>
