<?php
include("dbconnection.php");
$sql ="SELECT * FROM accounts INNER JOIN customer ON accounts.customer_id=customer.customer_id WHERE accounts.acc_no='$_GET[customeracid]' AND accounts.acc_type_id!= '0' AND accounts.acc_status='Active'";
 $qsql = mysqli_query($con,$sql);
 if(mysqli_num_rows($qsql) == 0)
 {
	 echo "0";
 }
 else
 {
?>
<table  id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead> 
  <tr>
    <th scope="col">&nbsp;IFSC Code</th>
    <th scope="col">&nbsp;Name</th>
    <th scope="col">&nbsp;Account Number</th>
    <th scope="col">&nbsp;Account type</th>
  </tr>
  </thead>
  <tbody>
 <?php
 while($rs = mysqli_fetch_array($qsql))
 {
	 
	  	$sqlaccounts ="SELECT * FROM accounts INNER JOIN account_master ON accounts.acc_type_id = account_master.acc_type_id WHERE acc_no='$_GET[customeracid]'";
 		$qsqlaccounts = mysqli_query($con,$sqlaccounts);
		$rsaccounts = mysqli_fetch_array($qsqlaccounts);
		
 		$sqlbranch ="SELECT * FROM branch WHERE ifsc_code='$rs[ifsc_code]'";
 		$qsqlbranch = mysqli_query($con,$sqlbranch);
		$rsbranch = mysqli_fetch_array($qsqlbranch);
  echo "<tr>
    <td>&nbsp;$rs[ifsc_code] ($rsbranch[branch_name])</td>
    <td>&nbsp;$rs[first_name]&nbsp;$rs[last_name]</td>
    <td>&nbsp;$rsaccounts[acc_no]</td>
	<td>$rsaccounts[acc_type]($rsaccounts[prefix])</td>
	 </td>
  </tr>";
?>
<input type="hidden" class="form-control" name="payeename" required="required" placeholder="Payee Name" value="<?php echo $rs['first_name'] . " ".$rs['last_name']; ?>">
<input type="hidden" class="form-control" name="bankacno" required="required" placeholder="Account Number" value="<?php echo $rsaccounts['acc_no']; ?>">
<input type="hidden" class="form-control" name="accounttype" required="required" placeholder="Account type" value="<?php echo $rsaccounts['acc_type']; ?>">
<input type="hidden" class="form-control" name="bankname" required="required" placeholder="Bank Name" value="eBanking">
 <input type="hidden" class="form-control" name="ifsccode" required="required" placeholder="IFSC code"  value="<?php echo $rs['ifsc_code']; ?>">
<?php  
  }
?>  
</tbody>
</table> 
<hr>
<?php
 }
 ?>
