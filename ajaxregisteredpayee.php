<?php
error_reporting(0);
session_start();
include("dbconnection.php");
if(isset($_SESSION['emp_id']))
{
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
        ?>
        <input type="hidden" name="customerid" value="<?php echo $rs['customer_id']; ?>">
        <?php  
          }
        ?>  
        </tbody>
        </table>
        <hr>
	 <?php
     if($_GET['trtype'] == "Intra Bank")
     {
     ?>        
                  
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Bank Account No</label>
<input type="text" class="form-control" name="bankacno" placeholder="Account Number"  onkeyup="loadbankaccount(this.value)" required="required">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsbankacno" ></span>
                  </div>
                </div>
                
                <div id="divbankac"></div>
                
                
                                
              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary" name="submit">Add Account to Registered Payee</button>  
                </div>
              </div>
              
      <?php
	 }
     if($_GET['trtype'] == "Other bank")
	 {
	 ?>
                    <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Payee Name</label>
                    <input type="text" class="form-control" name="payeename" placeholder="Payee Name" value="<?php echo $rsedit['payee_name']; ?>" required="required">  
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jspayeename" ></span>
                  </div>
                </div> 
                  
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Bank Account No</label>
                    <input type="text" class="form-control" name="bankacno" placeholder="Account Number" value="<?php echo $rsedit['bank_acc_no']; ?>" required="required">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsbankacno" ></span>
                  </div>
                </div>
                
                               
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">  Account Type</label>
                   <select required  class="form-control" name="accounttype" placeholder="Account type">  
                   <option value="">Select account type</option>
                    <?php
					$arr = array("Loan account","Fixed deposite","Savings");
					foreach($arr as $val)
					{
						if($val == $rsedit['acc_type'])
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
                  <span id="jsaccounttype" ></span>
                  </div>
                </div>
               
                      
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Bank Name</label>
                    <input type="text" class="form-control" name="bankname" placeholder="Bank Name" value="<?php echo $rsedit['bank_name']; ?>" required="required">  
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsbankname" ></span>
                  </div>
                </div> 
                  
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">IFSC code</label>
                    <input type="text" class="form-control" name="ifsccode" placeholder="IFSC code" required="required" >
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsifsccode" ></span>
                  </div>
                </div>
                
                
                                
              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary" name="submit">Add Account to Registered Payee</button>  
                </div>
              </div>
	<?php
	 }
 }
}
else
{
?>
	<hr>
	 <?php
     if($_GET['trtype'] == "Intra Bank")
     {
     ?>        
                  
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Bank Account No</label>
<input type="text" class="form-control" name="bankacno" placeholder="Account Number"  onkeyup="loadbankaccount(this.value)">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsbankacno" ></span>
                  </div>
                </div>
                
                <div id="divbankac"></div>
                
                
                                
              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary" name="submit">Add Account to Registered Payee</button>  
                </div>
              </div>
              
      <?php
	 }
     if($_GET['trtype'] == "Other bank")
	 {
	 ?>
                    <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Account Holder Name</label>
                    <input type="text" class="form-control" name="payeename" placeholder="Payee Name" value="<?php echo $rsedit['payee_name']; ?>">  
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jspayeename" ></span>
                  </div>
                </div> 
                  
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Bank Account No</label>
                    <input type="text" class="form-control" name="bankacno" placeholder="Account Number" value="<?php echo $rsedit['bank_acc_no']; ?>">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsbankacno" ></span>
                  </div>
                </div>
                
                               
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">  Account Type</label>
                   <select  class="form-control" name="accounttype" placeholder="Account type">  
                   <option value="">Select account type</option>
                    <?php
					$arr = array("Loan account","Fixed deposite","Savings");
					foreach($arr as $val)
					{
						if($val == $rsedit['acc_type'])
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
                  <span id="jsaccounttype" ></span>
                  </div>
                </div>
               
                      
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Bank Name</label>
                    <input type="text" class="form-control" name="bankname" placeholder="Bank Name" value="<?php echo $rsedit['bank_name']; ?>">  
                  </div>
                 <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsbankname" ></span>
                  </div>
                </div> 
                  
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">IFSC code</label>
                    <input type="text" class="form-control" name="ifsccode" placeholder="IFSC code" >
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsifsccode" ></span>
                  </div>
                </div>
                
                
                                
              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary" name="submit">Add Account to Registered Payee</button>  
                </div>
              </div>
	<?php
	 }
	 ?>
<?php
}
?>
