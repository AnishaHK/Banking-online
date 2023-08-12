<?php
error_reporting(0);
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
    <th scope="col">&nbsp;Login ID</th>
    <th scope="col">&nbsp;Address</th>
  </tr>
  </thead>
  <tbody>
 <?php
 while($rs = mysqli_fetch_array($qsql))
 {
 		$sqlbranch ="SELECT * FROM branch WHERE ifsc_code='$rs[ifsc_code]'";
 		$qsqlbranch = mysqli_query($con,$sqlbranch);
		$rsbranch = mysqli_fetch_array($qsqlbranch);
  echo "<tr>
    <td>&nbsp;$rs[ifsc_code] ($rsbranch[branch_name])</td>
    <td>&nbsp;$rs[first_name]&nbsp;$rs[last_name]</td>
    <td>&nbsp;$rs[login_id]</td>
	<td>$rs[address],<br />$rs[city],<br />$rs[state],<br />$rs[country]<br />Mob: $rs[mob_no]<br /> Email: $rs[email_id]</td>
	 </td>
  </tr>";
  }
?>  
</tbody>
</table>
<hr>
<table  id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead> 
  <tr>
    <th scope="col">&nbsp;Account Number</th>
    <th scope="col">&nbsp;Account type</th>
    <th scope="col">&nbsp;Account Balance</th>
    <th scope="col">&nbsp;Unclear balance</th>
  </tr>
  </thead>
  <tbody>
 <?php
 		$sqlaccounts ="SELECT * FROM accounts INNER JOIN account_master ON accounts.acc_type_id = account_master.acc_type_id WHERE acc_no='$_GET[customeracid]'";
 		$qsqlaccounts = mysqli_query($con,$sqlaccounts);
		$rsaccounts = mysqli_fetch_array($qsqlaccounts);
  echo "<tr>
    <td>&nbsp;$rsaccounts[acc_no]</td>
    <td>&nbsp;$rsaccounts[acc_type]($rsaccounts[prefix])</td>
    <td>Rs. &nbsp;$rsaccounts[acc_balance]</td>
    <td>Rs. &nbsp;$rsaccounts[unclear_bal]</td>
	 </td>
  </tr>";
?>  
</tbody>
</table>
<hr>

<?php
if($_GET['transttype'] == "debit")
{
 		$sqlaccount_master ="SELECT * FROM account_master WHERE acc_type_id='$rsaccounts[acc_type_id]'";
 		$qsqlaccount_master = mysqli_query($con,$sqlaccount_master);
		$rsaccount_master = mysqli_fetch_array($qsqlaccount_master);
		$withdrawalamt = $rsaccounts['acc_balance']-$rsaccount_master['min_balance'];
?>
    <div class="row">
        <div class="col-md-6 margin-bottom-15">
        <label for="firstName" class="control-label">You can Withdraw upto</label>
        <input type="text" class="form-control" name="withdrawalamt" placeholder=" Amount" value="<?php echo $withdrawalamt; ?>" readonly>  
        </div>
        <div class="col-md-6 margin-bottom-15"><br /><br />
        <span id="" ></span>
        </div>
    </div>
<?php
}
?>

<div class="row">
    <div class="col-md-6 margin-bottom-15">
    <label for="firstName" class="control-label">Amount</label>
    <input type="text" class="form-control" name="amount" placeholder="Amount" value="<?php echo $rsedit['amount']; ?>">  
    </div>
    <div class="col-md-6 margin-bottom-15"><br /><br />
    <span id="jsamount" ></span>
    </div>
</div>

<?php
if($_GET['transttype'] != "debit")
{
?> 
    <div class="row">
        <div class="col-md-6 margin-bottom-15">
        <label for="firstName" class="control-label">Deposit type</label>
               <select  class="form-control" name="deposittype" placeholder="Transaction"  value="<?php echo $rsedit['acc_status']; ?>">   
               <option value="">Select deposit type</option>
                <?php
                $arr = array("Cash","Cheque");
                foreach($arr as $val)
                {
                    echo "<option value='$val'>$val</option>";
                }
                ?>
               </select>
        </div>
        <div class="col-md-6 margin-bottom-15"><br /><br />
        <span id="jsdeposittype" ></span>
        </div>
    </div>
<?php
}
?>

<div class="row">
    <div class="col-md-6 margin-bottom-15">
    <label for="firstName" class="control-label">Particulars</label>
    <textarea  class="form-control" name="particulars" placeholder="Particulars"><?php echo $rsedit['particulars']; ?></textarea>
    </div>
    <div class="col-md-6 margin-bottom-15"><br /><br />
    <span id="jsparticulars" ></span>
    </div>
</div>                               
            
<div class="row templatemo-form-buttons">
<div class="col-md-12">
  <button type="submit" class="btn btn-primary" name="submit">Complete transaction</button>  
</div>
</div>
<?php
 }
 ?>