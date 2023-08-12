<?php
error_reporting(0);
session_start();
include("dbconnection.php");
$sql ="SELECT * FROM loan INNER JOIN loan_type ON loan.loan_type_id = loan_type.loan_type_id WHERE loan.loan_acc_no='$_GET[loanaccid]' AND loan.status='Active'";
$qsql = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($qsql);
 if(mysqli_num_rows($qsql) == 0)
 {
	 echo "0";
 }
 else
 {
	$sqlloan_payment ="SELECT sum(paid) FROM loan_payment WHERE loan_acc_no='$_GET[loanaccid]'";
	$qsqlloan_payment = mysqli_query($con,$sqlloan_payment);
	$rsloan_payment = mysqli_fetch_array($qsqlloan_payment);
	
	$sqlcustomer ="SELECT * FROM customer WHERE customer_id='$rs[customer_id]'";
	$qsqlcustomer = mysqli_query($con,$sqlcustomer);
	$rscustomer = mysqli_fetch_array($qsqlcustomer);
?>
    <table  id="example1" class="table table-striped table-bordered" cellspacing="0" width="50%">
    <tbody> 
       <tr>
        <th scope="col">&nbsp;Customer</th>
        <td scope="col">&nbsp;<?php echo $rscustomer[first_name] . " ". $rscustomer['last_name']; ?></td>
      </tr>
       <tr>
        <th scope="col">&nbsp;Branch Code</th>
        <td scope="col">&nbsp;<?php echo $rscustomer[ifsc_code] ; ?></td>
      </tr>
      <tr>
        <th scope="col">&nbsp;Loan Account Number</th>
        <td scope="col">&nbsp;<?php echo $rs['loan_acc_no']; ?></td>
      </tr>
      <tr>
        <th scope="col">&nbsp;Loan type</th>
        <td scope="col">&nbsp;<?php echo $rs[loan_type]." (".$rs[prefix].")"; ?></td>
      </tr>
      <tr>
        <th scope="col">&nbsp;Loan amount</th>
        <td scope="col">&nbsp;Rs.<?php echo $rs['loan_amt']; ?></td>
      </tr>

      <tr>
        <th scope="col">&nbsp;Interest</th>
        <td scope="col">&nbsp;<?php echo $rs['interest']; ?>%</td>
      </tr>
      <tr>
        <th scope="col">&nbsp;Interest amount</th>
        <td scope="col">&nbsp;Rs. <?php echo ($rs['loan_amt'] * $rs['interest'] /100); ?></td>
      </tr>
      <tr>
        <th scope="col">&nbsp;Total payable amount</th>
        <td scope="col">&nbsp;Rs. <?php echo $totamt =  $rs['loan_amt'] + ($rs['loan_amt'] * $rs['interest'] /100); ?></td>
      </tr>
      <tr>
        <th scope="col">&nbsp;Total paid amount</th>
        <td scope="col">&nbsp;Rs. <?php echo $rsloan_payment[0]; ?></td>
      </tr>
      <tr>
        <th scope="col">&nbsp;Balance amount</th>
        <td scope="col">&nbsp;Rs. <?php echo $balamt = $totamt - $rsloan_payment[0]; ?></td>
      </tr>
      </tbody>
    </table>
    
    <input type="hidden" name="custid" value="<?php echo $rs['customer_id']; ?>" >
    <input type="hidden" name="loan_amt" value="<?php echo $rs['loan_amt']; ?>" >    
    <input type="hidden" name="interest" value="<?php echo $rs['interest']; ?>" >   
    <input type="hidden" name="totamt" id="totamt" value="<?php echo $balamt; ?>" >  


<?php
if(isset($_SESSION['customer_id']))
{
?>
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Select Account number </label>                  
<select name="account"  class="form-control" onChange="showcustomer(this.value)">
<option value="">Select Account</option>
<?php
$sqlacc ="SELECT * FROM accounts WHERE acc_status='Active' AND acc_type_id!='0' AND customer_id='$_SESSION[customer_id]'";
$qsqlacc = mysqli_query($con,$sqlacc);
while($rsacc = mysqli_fetch_array($qsqlacc))
{
	echo "<option value='$rsacc[acc_no]'>$rsacc[acc_no]</option>";	
}
?>
</select>
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jspayeeid" ></span>
                  </div>
                </div>
                  
                  <div id="divcustrecloadid" ></div>

<?php
}
?>

<?php
if(isset($_SESSION['emp_id']))
{
?>                                
    
           <div class="row">
              <div class="col-md-6 margin-bottom-15">
                <label for="firstName" class="control-label">Paid amount</label>
                <input type="text" class="form-control" name="paidamt" id="paidamt" placeholder="Paid amount" onKeyUp="calculatebal(totamt.value,this.value)">  
              </div>
               <div class="col-md-6 margin-bottom-15"><br /><br />
              <span id="jspaidamt" ></span>
              </div>
              </div>
            
            
            <div class="row">
              <div class="col-md-6 margin-bottom-15">
                <label for="firstName" class="control-label">Balance amount</label>
                <input type="text" class="form-control" name="balanceamt" id="balanceamt" placeholder="Total Amount" value="<?php echo $rsedit['total_amt']; ?>" readonly>
              </div>
               <div class="col-md-6 margin-bottom-15"><br /><br />
              <span id="jstotalamount" ></span>
              </div>
            </div>               


                 <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Payment Type</label>
                    <select class="form-control margin-bottom-15" name="paymenttype">
                    <option value="">Select payment type</option>
                    <?php
					$arr = array("Cheque","Cash");
					foreach($arr as $val)
					{
						if($val == $rsedit[payment_type])
						{
						echo "<option value='$val' selected>$val</option>";
						}
						else
						{
						echo "<option value='$val'>$val</option>";
						}
					}
					?>
                  </select> 
                  </div>
                   <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jspaymenttype" ></span>
                  </div>
                  </div>
                  
                    <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary" name="submit">Make Payment</button>  
                </div>
              </div>
<?php
}
}
 ?>