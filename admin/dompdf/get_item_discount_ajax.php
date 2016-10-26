<?php
include('includes/function.php');

$itm_id = $_REQUEST['itm_id'];


$sql 	= "	SELECT 
				discount
			 	FROM ".ITEM." WHERE itm_id = '".$itm_id."'
		  ";
$query 	= mysql_query($sql);

$discount = '';




while($array = mysql_fetch_array($query))
{
	if($discount == '')
		$discount = $array['discount'];
	else
		$discount = $discount.", ".$array['discount'];
  
}

echo $discount;
 
?>