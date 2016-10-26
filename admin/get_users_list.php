<?php
include('includes/function.php');
$type = $_GET['type'];

if($type==1)
{
    $sql = "select id,name from subhecha_vendor_master";
}
if($type==2)
{
    $sql = "select id,name from subhecha_employee_master";
}
if($type==4)
{
    $sql = "select id,customer_name as name from subhecha_customer";
}
if($type==3) {echo '1'; exit;}
?>

<?php 
$qry = mysql_query($sql);
while($fetchUser = mysql_fetch_assoc($qry))
{?>
<option value="<?php echo $fetchUser['id'];?>"><?php echo $fetchUser['name'];?></option>
<?php }
?>
