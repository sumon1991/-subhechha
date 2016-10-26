<?php
if($_SERVER['HTTP_HOST'] == 'localhost')
{
// DEFININF BASIC ESSENTIAL CONSTANTS ....
define('SITE_URL', 'http://localhost/subhechha/admin');
define('CRYPTKEY', 'qJB0rGtIn5UB1xG03efyCp');
define('SERVER_NAME', 'localhost');
define('USER_NAME', 'root');
define('PASSWORD', 'tier5');
define('DATABASE', 'subhecha');
}
else
{
// DEFININF BASIC ESSENTIAL CONSTANTS ....
define('SITE_URL', 'http://sunmobileservice.com/subhechha/admin');
define('CRYPTKEY', 'qJB0rGtIn5UB1xG03efyCp');
define('SERVER_NAME', 'localhost');
define('USER_NAME', 'subhechha');
define('PASSWORD', 'dev@subhechha#$19');
define('DATABASE', 'subhechha');	
}


// DEFINING DATABASE TABLE NAMES ....

define("LOCATION", "subhecha_location_master");
define("USER_MASTER", "subhecha_user_master");
define("COMPANY_MASTER", "subhecha_company_master");
define("USER_DETAILS", "subhecha_userinfo_master");
define("SITE_SETTING", "subhecha_site_setting");
define("STATUS", "subhecha_status");
define("CUSTOMER", "subhecha_customer");
define("CUSTOMER_ORDER", "subhecha_order_details");
define("ORDER_ITEM", "subhecha_order_item_details");
define("EMP_TYPE", "subhecha_employee_type");
define("EMP_TYPE_CAT", "subhecha_employee_type_category");
define("EMP_MASTER", "subhecha_employee_master");
define("VEND_TYPE", "subhecha_vendor_type");
define("VEND_MASTER", "subhecha_vendor_master");
define("PAYMENT_LOG", "subhechha_payment_log");


//define("TEST", "care_test");


 


?>