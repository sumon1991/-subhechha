<?php
include('includes/function.php');
$itemCount = $_GET['itemCount'];


?>

<div class="form-group" id="<?php echo $itemCount;?>">
    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Item Name</label>
    <div class="col-md-2 col-sm-6 col-xs-12">
        <input type="text" name="item_name[]" required="" placeholder="Item Name">
    </div>

    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Amount</label>
    <div class="col-md-2 col-sm-6 col-xs-12">
        <input type="number" name="amount[]" placeholder="120.00" required="" min="10" step=".1">

    </div>


    <div class="col-md-2 col-sm-6 col-xs-12">
        <a href="javascript:;" onclick="removeItemArea('<?php echo $itemCount;?>');">remove Item</a>
    </div>
</div>