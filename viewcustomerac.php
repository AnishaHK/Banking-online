<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM customer WHERE customer_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Customer record deleted successfully...');</script>";
	}
}

if(isset($_GET['chst']))
{
	$sql = "update customer set  acc_status='$_GET[chst]' where customer_id ='$_GET[customeracid]'";
	$qsql = mysqli_query($con,$sql);
	if(!$qsql)
	{
		echo mysqli_error($con);
	}
	if(mysqli_affected_rows($con) == 1)
	{
		 $sql ="SELECT * FROM customer WHERE customer_id='$_GET[customeracid]'";
		 $qsql = mysqli_query($con,$sql);
		 $rs = mysqli_fetch_array($qsql);
		echo "<script>alert('Customer Account updated successfully..');</script>";
			
			if($_GET['chst'] == "Active")
			{
				include("sendmail.php");
				$msg = "<strong>Dear Customer,</strong><br><br>
				Thank you for banking with eBanking.<br>
				Your account activated successfully...";
				sendmail($rs['email_id'],"eBanking Account Activation detail..",$msg,"eBanking");
			}
	}
}
if(isset($_GET['acno']))
{
	$sql = "update accounts set  acc_status='$_GET[st]' where acc_no ='$_GET[acno]'";
	$qsql = mysqli_query($con,$sql);
	if(!$qsql)
	{
		echo mysqli_error($con);
	}
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Account record updated successfully..');</script>";
	}
}
?>
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>View Customer</h1>

          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
<table  id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead> 
  <tr>
    <th scope="col">&nbsp;IFSC Code</th>
    <th scope="col">&nbsp;Name</th>
    <th scope="col">&nbsp;Login ID</th>
    <th scope="col">&nbsp;Address</th>
    <th scope="col">&nbsp;Account Date</th>
    <th scope="col">&nbsp;Documents</th>
    <th scope="col">&nbsp;Account Status</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM customer WHERE customer_id='$_GET[customeracid]'";
 $qsql = mysqli_query($con,$sql);
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
	<td>&nbsp;";
	echo date("d-M-Y",strtotime($rs['acc_open_date']));
	if($rs['last_login'] != "0000-00-00 00:00:00")
	{
	echo "<br><br>Last Login - ".$rs['last_login'];
	}
	echo "</td><td>";
	echo "<a href='documents/$rs[idproof]' download><strong>ID Proof</strong></a><hr>";
	echo "<a href='documents/$rs[addressproof]' download><strong>Address Proof</strong></a>";
	echo "</td>
	<td>$rs[acc_status]";
	if($rs['acc_status'] == "Pending")
	{
		echo "<br><strong><a href='viewcustomerac.php?customeracid=$_GET[customeracid]&chst=Active'>Activate</a></strong>";	
	}
	if($rs['acc_status'] == "Inactive")
	{
		echo "<br><strong><a href='viewcustomerac.php?customeracid=$_GET[customeracid]&chst=Active'>Activate</a></strong>";	
	}
	if($rs['acc_status'] == "Active")
	{
		echo "<br><strong><a href='viewcustomerac.php?customeracid=$_GET[customeracid]&chst=Inactive'>Inactive</a></strong>";	
	}
	echo "</td></td> </tr>";
  }
?>  
</tbody>
</table>
<hr />
			<ul class="nav nav-pills">
                <li class="active"><a href="addbankaccounts.php?customeracid=<?php echo $_GET['customeracid']; ?>&type=Account">Add Bank Account <span class="badge">			<?php				
				 		$sqlaccountcount ="SELECT * FROM accounts WHERE customer_id='$_GET[customeracid]' and acc_type_id!='0'";
 						$qsqlaccountcount = mysqli_query($con,$sqlaccountcount);
						echo mysqli_num_rows($qsqlaccountcount);
				?></span></a></li>
                <li class="active"><a href="loan.php?customeracid=<?php echo $_GET['customeracid']; ?>&type=Loan">Add Loan Account <span class="badge"><?php
				 		$sqlaccountcount ="SELECT * FROM loan WHERE customer_id='$_GET[customeracid]' ";
 						$qsqlaccountcount = mysqli_query($con,$sqlaccountcount);
						echo mysqli_num_rows($qsqlaccountcount);
				?></span></a></li>
                <li class="active"><a href="addfdaccounts.php?customeracid=<?php echo $_GET['customeracid']; ?>&type=FD">Add Fixed deposit Account <span class="badge"><?php
				 		$sqlaccountcount ="SELECT * FROM accounts WHERE customer_id='$_GET[customeracid]' and fd_id!='0'";
 						$qsqlaccountcount = mysqli_query($con,$sqlaccountcount);
						echo mysqli_num_rows($qsqlaccountcount);
				?></span></a></li>
                
                <li class="active"><a href="viewinbox.php?customeracid=<?php echo $_GET['customeracid']; ?>">View Mails (<?php
				 		$sqlaccountcount ="SELECT * FROM mail INNER JOIN customer ON mail.sender_id = customer.customer_id WHERE mail.message_type='CustomerAdmin' AND mail.emp_status!='Deleted' AND sender_id='$_GET[customeracid]'";
 						$qsqlaccountcount = mysqli_query($con,$sqlaccountcount);
						echo mysqli_error($con);
						echo mysqli_num_rows($qsqlaccountcount);
				?>)</a></li>
                <li class="active"><a href="mail.php?customeracid=<?php echo $_GET['customeracid']; ?>">Send Mail</a></li>
              </ul>
<hr />
<h1>View Bank Account detail:</h1>
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;Account No.</th>
    <th scope="col">&nbsp;Account date</th>
    <th scope="col">&nbsp;Account type</th>
    <th scope="col">&nbsp;Interest</th>
    <th scope="col">&nbsp;Balance</th>
    <th scope="col">&nbsp;Unclear balance</th>
    <th scope="col">&nbsp;Status</th>
    <th scope="col">&nbsp;Action</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $acprimary = "(Primary)";
 $sql ="SELECT * FROM accounts WHERE customer_id='$_GET[customeracid]' and acc_type_id!='0' order by acc_no";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
	 	$sqlaccount_master = "SELECT * FROM account_master where acc_type_id='$rs[acc_type_id]'";
		$qsqlaccount_master = mysqli_query($con,$sqlaccount_master);
		$rsaccount_master = mysqli_fetch_array($qsqlaccount_master);
		
  echo "<tr>
    <td>&nbsp;$rs[acc_no] $acprimary</td>
    <td>&nbsp;" . date("d-M-Y",strtotime($rs['acc_date'])) . "</td>
    <td>&nbsp;$rsaccount_master[acc_type] ($rsaccount_master[prefix])</td>
    <td>&nbsp;$rs[interest]%</td>
    <td>&nbsp;₹ $rs[acc_balance]</td>
    <td>&nbsp;₹ $rs[unclear_bal]</td>
    <td>&nbsp;$rs[acc_status]</td>
    <td>&nbsp;";
	if($rs['acc_status'] == "Inactive")
	{
	echo "<a href='viewcustomerac.php?acno=$rs[acc_no]&st=Active&customeracid=$_GET[customeracid]'>Activate</a>";	
	}
	if($rs['acc_status']== "Active")
	{
	echo "<a href='viewcustomerac.php?acno=$rs[acc_no]&st=Inactive&customeracid=$_GET[customeracid]'>Deactivate</a>";
	}
	echo "</td>
  </tr>";
  	$acprimary = "";
  }
?>  
</tbody>
</table>
<hr />
<h1>View Loan Account detail:</h1>
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;Loan Account No</th>
    <th scope="col">&nbsp;Loan Type</th>
    <th scope="col">&nbsp;Created Date</th>
    <th>Last date</th>
    <th scope="col">&nbsp;Loan Amount</th>
    <th scope="col">&nbsp;Interest Amount</th>
    <th scope="col">&nbsp;Total Payable</th>
    <th scope="col">&nbsp;Total Paid</th>
    <th scope="col">&nbsp;Balance</th>
    <th scope="col">&nbsp;Action</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM loan WHERE  customer_id='$_GET[customeracid]'";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
	 	$sqlloan_type= "SELECT * FROM loan_type where loan_type_id='$rs[loan_type_id]'";
		$qsqlloan_type = mysqli_query($con,$sqlloan_type);
		$rsloan_type = mysqli_fetch_array($qsqlloan_type);
		$totamt =  $rs[loan_amt] + ($rs[loan_amt] * $rs['interest'] /100);
		
		$sqlloan_payment= "SELECT IFNULL(SUM(paid),0) FROM loan_payment where loan_acc_no='$rs[loan_acc_no]'";
		$qsqlloan_payment = mysqli_query($con,$sqlloan_payment);
		$rsloan_payment = mysqli_fetch_array($qsqlloan_payment);
		$paidamt =$rsloan_payment[0];
		
		$pendingamt =$totamt - $paidamt ;
  echo "<tr>
    <td>&nbsp;$rs[loan_acc_no]</td>
    <td>&nbsp;$rsloan_type[loan_type]</td>
    <td>&nbsp;$rs[create_date]</td>
	<td>&nbsp;";
	 	$year = "$rsloan_type[terms] years";
		$acdate =$rs[create_date];
	  	echo date('Y-m-d', strtotime($year, strtotime($acdate)) );
	echo "</td>
    <td>&nbsp;₹ $rs[loan_amt]</td>
    <td>&nbsp;₹  ". ($rs['loan_amt'] * $rs['interest'] /100). " ($rs[interest]%)</td>
    <td>&nbsp;₹  ". $totamt . " </td>
    <td>&nbsp;₹  ". $paidamt . " </td>
    <td>&nbsp;₹  ". $pendingamt . " </td>
	<td>&nbsp;<a href='viewloanacdetailed.php?loan_acc_no=$rs[loan_acc_no]'>View</a></td>
  </tr>";
  }
?>  
</tbody>
</table>
<hr />
<h1>View Fixed deposit Account detail:</h1>
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;Account No.</th>
    <th scope="col">&nbsp;Account date</th>
    <th scope="col">&nbsp;Maturity date</th>
    <th scope="col">&nbsp;Account type</th>
    <th scope="col">&nbsp;Investment amount</th>
    <th scope="col">&nbsp;Profit</th>
    <th scope="col">&nbsp;Total Receivable</th>
    <th scope="col">&nbsp;Status</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $acprimary = "(Primary)";
 $sql ="SELECT * FROM accounts WHERE customer_id='$_GET[customeracid]' and fd_id!='0' order by acc_no";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
	 	$sqlfixed_deposit = "SELECT * FROM fixed_deposit where fd_id='$rs[fd_id]'";
		$qsqlfixed_deposit = mysqli_query($con,$sqlfixed_deposit);
		$rsfixed_deposit = mysqli_fetch_array($qsqlfixed_deposit);
		$profit = $rs['acc_balance'] * $rs['interest']/100;
		$totrec = $rs['acc_balance'] + $profit;
  echo "<tr>
    <td>&nbsp;$rs[acc_no]</td>
    <td>&nbsp;$rs[acc_date]</td>
    <td>&nbsp;";
	 	$year = "$rsfixed_deposit[terms] years";
		$acdate =$rs['acc_date'];
	  echo date('Y-m-d', strtotime($year, strtotime($acdate)) );
	echo "</td>
    <td>&nbsp;$rsfixed_deposit[deposit_type]  ($rsfixed_deposit[prefix])</td>
    <td>&nbsp;₹ $rs[acc_balance]</td>
    <td>&nbsp;₹ $profit ($rs[interest]%)</td>
    <td>&nbsp;₹ $totrec </td>
    <td>&nbsp;$rs[acc_status]</td>
  </tr>";
  	$acprimary = "";
  }
?>  
</tbody>
</table>

            </div>
          </div>
        </div>
      </div>
      </div>

<script type="application/javascript">
function confirmtodelete()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false; 
	}
}
</script>
<?php
include("datatables.php");
include("footer.php");
?>