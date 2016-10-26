<?php //echo $class_name.'---'.$index_name; ?>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <h3>&nbsp;</h3>
        <ul class="nav side-menu">
            <li <?php if (isset($class_name) && $class_name == 'dashboard') { ?> class="current" <?php } ?>>
                <a href="?page=index"><i class="fa fa-dashboard"></i> Dashboard</a>

            </li>
            <!--<li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" style="display: none">
                <li><a href="index.html">Dashboard</a>
                </li>
                <li><a href="index2.html">Dashboard2</a>
                </li>
                <li><a href="index3.html">Dashboard3</a>
                </li>
              </ul>
            </li>-->
            <li <?php if (isset($class_name) && $class_name == 'settings') { ?> class="current active" <?php } ?>>
                <a><i class="fa fa-cog"></i></i>Setting<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: <?php if (isset($class_name) && $class_name == 'settings') echo 'block;';
else echo 'none;'; ?>">
                    <li <?php if (isset($index_name) && $index_name == 'page_config') { ?> class="active" <?php } ?>><a href="?page=page_set">Site Settings</a>
                    </li>
                    <li <?php if (isset($index_name) && $index_name == 'pass_reset') { ?> class="active" <?php } ?>><a href="?page=reset_password">Reset Password</a>
                    </li>
                    <li <?php if (isset($index_name) && $index_name == 'comp_prof') { ?> class="active" <?php } ?>><a href="?page=company_profile">Company Profile</a>
                    </li>

                    <li <?php if (isset($index_name) && $index_name == 'bank_lists') { ?> class="active" <?php } ?>><a href="?page=bank_lists">Bank list</a>
                    </li>
                    <li <?php if (isset($index_name) && $index_name == 'item_lists') { ?> class="active" <?php } ?>><a href="?page=item_lists">Item management</a>
                    </li>
                    <li <?php if (isset($index_name) && $index_name == 'grocery_lists') { ?> class="active" <?php } ?>><a href="?page=grocery_lists">Grocery management</a>
                    </li>
                    <li <?php if (isset($index_name) && $index_name == 'veg_lists') { ?> class="active" <?php } ?>><a href="?page=veg_lists">Vegetables management</a>
                    </li>

                </ul>
            </li> 
            <li <?php if (isset($class_name) && $class_name == 'employee_management') { ?> class="current" <?php } ?>>
                <a><i class="fa fa-user-plus"></i></i>Employee Management<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li <?php if (isset($index_name) && $index_name == 'emp_type') { ?> class="active" <?php } ?>><a href="?page=list_employee_type">Employee Category</a>
                    </li>
                    <li <?php if (isset($index_name) && $index_name == 'employee_type_cat') { ?> class="active" <?php } ?>><a href="?page=list_employee_type_cat">Employee Sub-Category</a>
                    </li>
                    <li <?php if (isset($index_name) && $index_name == 'employee') { ?> class="active" <?php } ?>><a href="?page=list_employee">Employee List</a>
                    </li>
                    <li <?php if (isset($index_name) && $index_name == 'mass_payment') { ?> class="active" <?php } ?>><a href="?page=mass_payment">Mass Payment</a>
                    </li>
                </ul>
            </li> 
            <li <?php if (isset($class_name) && $class_name == 'vendor_management') { ?> class="current active" <?php } ?>>
                <a><i class="fa fa-users"></i></i>Vendor Management<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: <?php if (isset($class_name) && $class_name == 'vendor_management') echo 'block;';
else echo 'none;'; ?>">
                    <li <?php if (isset($index_name) && $index_name == 'vend_type') { ?> class="active" <?php } ?>><a href="?page=list_vendor_type">Vendor Type</a>
                    </li>
                    <li <?php if (isset($index_name) && $index_name == 'vend_list') { ?> class="active" <?php } ?>><a href="?page=list_vendor">Vendor List</a>
                    </li>

                    <li <?php if (isset($index_name) && $index_name == 'vend_order') { ?> class="active" <?php } ?>><a href="?page=view_vendor_order">Vendors Orders List</a>
                    </li>

                </ul>
            </li> 

            <li <?php if (isset($class_name) && $class_name == 'customer') { ?> class="current" <?php } ?>>
                <a><i class="fa fa-book"></i> Customer <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li <?php if (isset($index_name) && $index_name == 'list_cust') { ?> class="active" <?php } ?>><a href="?page=customer_list">Customer List</a>
                    </li>

                </ul>
            </li>
            <li <?php if (isset($class_name) && $class_name == 'order') { ?> class="current" <?php } ?>>
                <a><i class="fa fa-calculator"></i> Order <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="?page=order_list">Order List</a>
                    </li>

                </ul>
            </li>

        </ul>
        </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="?page=logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
<!-- /menu footer buttons -->