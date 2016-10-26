<?php
include('includes/function.php');
$em_id = $_REQUEST['em_id'];

$sql 	= "	SELECT 
				id, employee_type_id, employee_type_category_name
			 	FROM ".EMP_TYPE_CAT." WHERE employee_type_id = '".$em_id."'
		  ";
$query 	= mysql_query($sql);


$sub_cat_id = '';
$options	= '';
while($array = mysql_fetch_array($query))
{
	$options .= '<option value="'.$array['id'].'">'.$array['employee_type_category_name'].'</option>';	
}

echo $options;



 
?>