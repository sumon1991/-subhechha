<?php
//include('includes/function.php');
								 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice</title>
 
</head>

<body>
<center>
<div style=" background-color:#FFF;
    width: 1100px;
    height:250px;
    padding: 30px;
    border: 2px solid navy;
    margin: 25px;
    border-bottom-right-radius:1em;
    border-bottom-left-radius:1em;
    border-top-left-radius:1em;
    border-top-right-radius:1em;
    ">
    
<table align="center" border="0">
    <tr>
        <td colspan="12" align="center"><b><u><font size="+2"> Tax Invoice</font></u></b></td>
    </tr>
    <tr>
        <td colspan="6" align="center">
           <div style="color:#009;"><font size="+3"> <b> SANTOSH FASHION </b></font></div>
          <div style="background:#009;"> <div style="color:#FFF; padding-top:10px;"><font size="+1"> <b> All Kind of Readymade Garments & Wholeseller</b></font></div><br /></div>
          <div style="color:#009; padding-top:10px;"><font size="+1"> <b>19 A/4, Dum Dum Road, Kolkata - 700030</b></font></div>
          <div style="color:#009; padding-top:10px;"><font size="+1"> <b>Ph. : 033-2558 4472, Mobile : 9830711240 / 9830017660</b></font></div>
          <div style="color:#009; padding-top:10px;"><font size="+1"> <b>Vat No. : 19323972080 CST No. : 19323972080</b></font></div><br />
          
        </td>
        <td colspan="6" align="left">
            <div style="color:#009;"> <b><table><tr><td style="font-size:17px"> Buyer's Name:</td><td style="font-size:11px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $cust_view_arr['customer_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<hr /></td></tr></table> </b></div><br />
             <div style="color:#009;" > <b><table><tr><td style="font-size:17px">Address:</td><td style="font-size:11px"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $cust_view_arr['customer_address']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<hr /></td></tr></table> </b></div><br />
             <div style="color:#009;"> <b>....................................................................................................................... </b></div><br />
              <div style="color:#009;"> <b>Vat NO. ..........................................&nbsp;Transport............................................ </b></div><br />
        </td>
      
        
    </tr>
    <tr>
         <td colspan="12">
          
           <font size="+1" color="#0000CC"><b>Tax Invoice No.</b></font><font size="+1" color="#000"><b> <?php //echo $order_view_arr['bill_no']; ?> </b></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <font size="+3" color="#0000CC"><b>Invoice </b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            <font size="+1" color="#0000CC"><b>Date: &nbsp;&nbsp;&nbsp;</b></font><font size="+1" color="#000"><b> <?php //echo $date; ?>&nbsp;&nbsp;&nbsp; </b></font>
         </td>
    </tr>
     <tr>
        <td>
          <font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
        <font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
 <font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
        <font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
        <font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
        <font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
       
        
    </tr>
    
</table>
</div>
<div style=" background-color:#FFF;
    width: 1100px;
    height:400px;
    padding: 30px;
    border: 2px solid navy;
    margin: 25px;
    border-bottom-right-radius:1em;
    border-bottom-left-radius:1em;
    border-top-left-radius:1em;
    border-top-right-radius:1em;
    ">
 <table>
       <tr bgcolor="#000099">
           <td>
          <div align="center"><font color="#FFFFFF" size="+2"> Sl.No</font></div>
          </td>
           <td colspan="6">
          <div align="center"><font color="#FFFFFF" size="+2"> Particulars</font></div>
          </td>
           <td colspan="2">
          <div align="center"><font color="#FFFFFF" size="+2">Pcs</font></div>
          </td>
           <td colspan="3">
          <div align="center"><font color="#FFFFFF" size="+2">Rate</font></div>
          </td>
          <td colspan="4">
          <div align="center"><font color="#FFFFFF" size="+2">Amount<br /> Rs. &nbsp;|&nbsp;&nbsp;&nbsp; P. </font></div>
          </td>
       </tr>
        <?php
											
//	                if($order_list_arr > 0){
//						$c=1;
//						$totalAmount=0.00;
//						while($order_list_fetch = mysql_fetch_assoc($order_list_query)) {
//							
//						
						?>
       
        <tr bgcolor="#CCCCCC" >
           <td>
          <div align="center"><font color="#0000CC"><?php //echo $c++; ?></font></div>
          </td>
           <td colspan="6">
          <div align="center"><font color="#0000CC"><?php 
				  //echo $order_list_fetch['itm_name']; 
				  ?> </font></div>
          </td>
           <td colspan="2">
          <div align="center"><font color="#0000CC"><?php //echo $order_list_fetch['item_quantity'];?></font></div>
          </td>
           <td colspan="3">
          <div align="center"><font color="#0000CC"><?php //echo $order_list_fetch['price_per_item']; ?></font></div>
          </td>
          <td colspan="1">
          <div align="center"><font color="#0000CC"><?php 
		  //$totalAmount+= $order_list_fetch['price_per_item']*$order_list_fetch['item_quantity'];
		  //echo $order_list_fetch['price_per_item']*$order_list_fetch['item_quantity']; ?></font></div>
          </td>
           <td colspan="1">
          <div align="center"><font color="#0000CC">00</font></div>
          </td>
       </tr>
        <?php
											//	}
											//}
		                              ?>   
        <tr>
        
           
          <td colspan="12" bgcolor="#DFDFDF">
          <div align="right"><font color="#0000CC" size="+2"><b>Gross Total</b></font></div>
          </td>
           <td colspan="2" bgcolor="#DFDFDF">
          <div align="left"><font color="#0000CC">&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $totalAmount;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;00</font></div>
          </td>
       </tr>
       
    
       
       <tr>
        <td>
          <font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
        <font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
 <font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
        <font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
        <font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
        <font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td>
        <font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td>
        <font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
       
        
    </tr>
 
 </table>   

</div>
<div style=" background-color:#FFF;
    width: 1100px;
    height:230px;
    padding: 30px;
    border: 2px solid navy;
    margin: 25px;
    border-bottom-right-radius:1em;
    border-bottom-left-radius:1em;
    border-top-left-radius:1em;
    border-top-right-radius:1em;
    ">
    
<table align="center">
  
    <tr>
        <td colspan="5" align="center">
        <div style="color:#009;" align="left"> <b> Rupees &nbsp;&nbsp;&nbsp;
<?php
/** 
*  Function:   convert_number 
*
*  Description: 
*  Converts a given integer (in range [0..1T-1], inclusive) into 
*  alphabetical format ("one", "two", etc.)
*
*  @int
*
*  @return string
*
*/ 
function convert_number($number) 
{ 
    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 
     $Cr = floor($number / 10000000);  /* crore (jiga) */ 
    $number -= $Cr * 10000000;
    $Gn = floor($number / 100000);  /* lakhs (giga) */ 
    $number -= $Gn * 100000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = "";
	
	 if ($Cr) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Cr) . " crore";
    } 

    if ($Gn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Gn) . " Lakhs";
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
} 
//$cheque_amt = $fetch_amt['sum(item_amt)']; 

try
    {
    echo convert_number($cheque_amt);
    }
catch(Exception $e)
    {
    echo $e->getMessage();
    }
	?><hr /> </b></div><br />
             <div style="color:#009;" align="left"> <b>................................................................................................................Only </b></div><br />
         <div style="color:#009;" align="left"><b>Challan No...................................................Date ....................................... </b></div><br />
 <div style="color:#009;" align="left"> <b> 
Order No.....................................................Date .............................................. </b></div><br />
<div style="color:#009;" align="left"> <b> All Subject to Kolkata Jurisdiction</b></div><br />

        </td>
        <td colspan="4" align="">
          
           <div style="padding-top:100px; padding-left:20px;">______________________<br />Buyer's Signature</div>
        </td>
        <td colspan="1" align="center">
           <table>
           <tr >
                  <td align="center"><div style="padding-bottom:50px;">(-)Trade Dis </div></td>
           </tr>
           <tr >
               <td align="center"><div style="padding-top:50px;"> (+)VAT/CST</div> </td>
           </tr>
             <tr >
               <td align="center"><div style="padding-top:50px;"> Total:</div> </td>
           </tr>
           </table>
        </td>
        <td colspan="4" align="center">
           <table>
           <tr>
                 <td align="center"><div style="padding-bottom:50px;"><?php //echo $order_view_arr['final_discount'];
				                                                                // $trd_dis = $order_view_arr['final_discount'];
																				 ?></div></td>
           </tr>
           <tr>
                 <td align="center"><?php // $site_sql = "SELECT vat_txt FROM ".SITE_SETTING." WHERE 1";
//				                        $site_query = mysql_query($site_sql);
//										$site_fetch = mysql_fetch_assoc($site_query);
//									//	echo $site_fetch['vat_txt'];
//										$vat_tax = $site_fetch['vat_txt'];
//										echo $vat_tax;
				  ?></td>
           </tr>
           <tr>
                 <td align="center"><?php // $grad_tot = $fetch_amt['sum(item_amt)']; 
//				                      $net_dis = (($grad_tot) * (($trd_dis)/100));
//									  $tra_per = (($grad_tot) * (($vat_tax)/100));
//						     		  $net_tot = (($grad_tot) - ($net_dis)  + ($tra_per));
//									
//									  
//									  echo $net_tot;
				 ?></td>
           </tr>
           </table>
        </td>
      
        
    </tr>
          <a href="seller_pdf.php"
     <tr>
        <td>
          <font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td>
          <font color="#FFFFFF">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
        <font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
 <font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
        <font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
        <font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        <td>
        <font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font>
        </td>
        <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
       <td><font color="#FFFFFF"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</font></td>
        
    </tr>
    
</table>

</div>
</center>
<div style="padding-left:600px; padding-right:600px;">
<div align="center" style="margin:5; background-color:#03C"><a href="" onclick="window.open('http://localhost/garments/admin/print_pdf.php?bill_no=<?php echo $bill_no; ?>&customer_id=<?php echo $customer_id; ?>'); window.open('http://localhost/garments/admin/seller_pdf.php?bill_no=<?php echo $bill_no; ?>&customer_id=<?php echo $customer_id; ?>'); window.open('http://localhost/garments/admin/trans_pdf.php?bill_no=<?php echo $bill_no; ?>&customer_id=<?php echo $customer_id; ?>');"><font color="#FFFFFF">Print</font></a></div>
</div>
<div align="right" style="padding-right:50px;">SANTOSH FASHION </div>
</body>
</html>
<?php
?>