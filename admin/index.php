<?php
// include file //
include('includes/function.php');

if(isset($_REQUEST['page']))
	$action = $_REQUEST['page'];
else
	$action = '';	

if(!empty($_SESSION['login_status']) && $_SESSION['login_status']=='yes')
{
   $return_check = securityCheck($_SESSION['login_id']);
	
	if($return_check)
	{ 
	
		switch($action){
			case '':
			$class_name = "dashboard";
			include('dashboard.php');
			break;
						
			case 'logout':
			logout();
			redirect('/');   
			break;
	
			case 'reset_password':
			$class_name = "settings";
			$index_name = "pass_reset";
			include('reset_password.php');
			break;
			
			case 'page_set':
			$class_name = "settings";
			$index_name = "page_config";
			include('page_set.php');
			break;
			
			
			case 'company_profile':
			$class_name = "settings";
			$index_name = "comp_prof";
			include('company_profile.php');
			break;	
			
			case 'bank_lists':
			$class_name = "settings";
			$index_name = "bank_lists";
			include('bank_lists.php');
			break;
			
			case 'add_bank':
			$class_name = "settings";
                        $index_name = "bank_lists";
			include('add_bank.php');
			break;
			
			
			case 'edit_bank':
			$class_name = "settings";
                        $index_name = "bank_lists";    
			include('edit_bank.php');
			break;	
                    
                        case 'bank_transcation_history':
			$class_name = "settings";
                        $index_name = "bank_lists";    
			include('bank_transcation_history.php');
			break;	
                    
                        case 'new_transact':
			$class_name = "settings";
                        $index_name = "bank_lists";    
			include('new_transact.php');
			break;
                    
                        case 'item_lists':
			$class_name = "settings";
			$index_name = "item_lists";
			include('item_lists.php');
			break;
			
			case 'add_item':
			$class_name = "settings";
                        $index_name = "item_lists";
			include('add_item.php');
			break;			
			
			case 'edit_item':
			$class_name = "settings";
                        $index_name = "item_lists";    
			include('edit_item.php');
			break;
                    
                        case 'grocery_lists':
			$class_name = "settings";
			$index_name = "grocery_lists";
			include('grocery_lists.php');
			break;
			
			case 'add_grocery':
			$class_name = "settings";
                        $index_name = "grocery_lists";
			include('add_grocery.php');
			break;			
			
			case 'edit_grocery':
			$class_name = "settings";
                        $index_name = "grocery_lists";    
			include('edit_grocery.php');
			break;
                    
                        case 'veg_lists':
			$class_name = "settings";
			$index_name = "veg_lists";
			include('veg_lists.php');
			break;
			
			case 'add_veg':
			$class_name = "settings";
                        $index_name = "veg_lists";
			include('add_veg.php');
			break;			
			
			case 'edit_veg':
			$class_name = "settings";
                        $index_name = "veg_lists";    
			include('edit_veg.php');
			break;
			
			case 'customer_list':
			$class_name = "customer";
			$index_name = "list_cust";
			include('customer_list.php');
			break;	
			
			case 'add_customer':
			$class_name = "customer";
			include('add_customer.php');
			break;
			
			case 'edit_customer':
			$class_name = "customer";
			include('edit_customer.php');
			break;	
		    
			case 'add_customer_order':
			$class_name = "customer";
			include('add_customer_order.php');
			break;	
			
			case 'view_customer_order':
			$class_name = "customer";
			include('view_customer_order.php');
			break;

			case 'customer_order':
			$class_name = "customer";
			include('customer_order.php');
			break;
			
			case 'view_payment_log':
			$class_name = "payment_log";
			include("view_payment_log.php");
			break;

			case 'create_invoice_pdf':
			$class_name = "customer";
			include('create_invoice_pdf.php');
			break;

			
			case 'order_list':
			$class_name = "order";
			include('order_list.php');
			break;
			
			case 'list_employee_type':
			$class_name = "employee_management";
			$index_name = "emp_type";
			include('list_employee_type.php');
			break;	
			
			case 'add_employee_type':
			$class_name = "employee_management";
			$index_name = "emp_type";
			include('add_employee_type.php');
			break;
			
			case 'edit_employee_type':
			$class_name = "employee_management";
			$index_name = "emp_type";
			include('edit_employee_type.php');
			break;	
		    
			case 'list_employee_type_cat':
			$class_name = "employee_management";
			$index_name = "employee_type_cat";
			include('list_employee_type_cat.php');
			break;	
			
			case 'add_employee_type_cat':
			$class_name = "employee_management";
			$index_name = "employee_type_cat";
			include('add_employee_type_cat.php');
			break;
			
			case 'edit_employee_type_cat':
			$class_name = "employee_management";
			$index_name = "employee_type_cat";
			include('edit_employee_type_cat.php');
			break;
			
			case 'list_employee':
			$class_name = "employee_management";
			$index_name = "employee";
			include('list_employee.php');
			break;	
			
			case 'add_employee':
			$class_name = "employee_management";
			$index_name = "employee";
			include('add_employee.php');
			break;
			
			case 'edit_employee':
			$class_name = "employee_management";
			$index_name = "employee";
			include('edit_employee.php');
			break;
                    
                        case 'sal_con_pm_employee':
			$class_name = "employee_management";
			$index_name = "sal_con_pm_employee";
			include('sal_con_pm_employee.php');
			break;
                    
                        case 'payment_pm_employee':
			$class_name = "employee_management";
			$index_name = "payment_pm_employee";
			include('payment_pm_employee.php');
			break;
                    
                        case 'sal_hist_pm_employee':
			$class_name = "employee_management";
			$index_name = "sal_hist_pm_employee";
			include('sal_hist_pm_employee.php');
			break;
                    
                        case 'mass_payment':
			$class_name = "employee_management";
			$index_name = "mass_payment";
			include('mass_payment.php');
			break;
			
			case 'list_vendor_type':
			$class_name = "vendor_management";
			$index_name = "vend_type";
			include('list_vendor_type.php');
			break;	
			
			case 'add_vendor_type':
			$class_name = "vendor_management";
			$index_name = "vend_type";
			include('add_vendor_type.php');
			break;
			
			case 'edit_vendor_type':
			$class_name = "vendor_management";
			$index_name = "vend_type";
			include('edit_vendor_type.php');
			break;	
			
			case 'list_vendor':
			$class_name = "vendor_management";
			$index_name = "vend_list";
			include('list_vendor.php');
			break;	
			
			case 'add_vendor':
			$class_name = "vendor_management";
			$index_name = "vend_list";
			include('add_vendor.php');
			break;
			
			case 'edit_vendor':
			$class_name = "vendor_management";
			$index_name = "vend_list";
			include('edit_vendor.php');
			break;
                    
                        case 'new_vendor_order':
			$class_name = "vendor_management";
			$index_name = "vend_list";
			include('new_vendor_order.php');
			break;
                    
                        case 'view_vendor_order':
			$class_name = "vendor_management";
			$index_name = "vend_order";
			include('view_vendor_order.php');
			break;
                    
                        case 'view_vendor_order_detail':
			$class_name = "vendor_management";
			$index_name = "vend_list";
			include('view_vendor_order_detail.php');
			break;
                    
                        case 'pay_to_vendor':
			$class_name = "vendor_management";
			$index_name = "vend_list";
			include('pay_to_vendor.php');
			break;
                    
			case 'view_order':
				$class_name = "view_order";
				include("view_order.php");
				break;
			
			default:
			$class_name = "dashboard";
			include('dashboard.php');
			break;
		}
	}
	else
		{
			session_destroy();
			echo '<script>window.location.href="'.SITE_URL.'/?page=";</script>';
		}
	
	}
	else
	{
		include('login.php');
	}

?>