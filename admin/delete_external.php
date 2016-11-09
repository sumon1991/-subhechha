<?php
	require_once('includes/function.php');
	// $sql = "DELETE FROM ".CUSTOMER_ORDER." WHERE order_id="."'".$_POST['id']."'";
	$sql = "UPDATE ".CUSTOMER_ORDER." SET `is_archive` = '1' WHERE order_id="."'".$_POST['id']."'";
	$executed = mysql_query($sql);
	if ($executed) {
		//$sql_order_item = "DELETE FROM ".ORDER_ITEM." WHERE order_id="."'".$_POST['id']."'";
		$sql_order_item = "UPDATE ".ORDER_ITEM." SET `is_archive` = '1' WHERE order_id="."'".$_POST['id']."'";
		$executed_order_item = mysql_query($sql_order_item);
		if ($executed_order_item) {
			//$sql_payment_log = "DELETE FROM ".PAYMENT_LOG." WHERE order_id="."'".$_POST['id']."'";
			$sql_payment_log = "UPDATE ".PAYMENT_LOG." SET `is_archive` = '1' WHERE order_id="."'".$_POST['id']."'";
			// echo $sql_payment_log;
			// die;
			$executed_payment_log = mysql_query($sql_payment_log);
			if ($executed_payment_log) {
				echo 1;
			}
			else
			{
				echo mysql_error();
			}
		}
		else
		{
			echo mysql_error();
		}
	}
	else
	{
		echo mysql_error();
	}

?>