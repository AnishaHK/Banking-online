<?php
include("header.php");
if(!isset($_SESSION['customer_id']))
{
	echo "<script>window.location='index.php';</script>";
}
include("sidebar.php");
?>
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>Customer Panel</h1>
        
              <div class="col-md-12 col-sm-12">
                <div class="panel-group" id="accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          Bank Accounts
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;Account Open date</th>
    <th scope="col">&nbsp;Account No.</th>
    <th scope="col">&nbsp;Account type</th>
    <th scope="col">&nbsp;Interest</th>
    <th scope="col">&nbsp;Balance</th>
    <th scope="col">&nbsp;Unclear balance</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $acprimary = "(Primary)";
 $sql ="SELECT * FROM accounts WHERE customer_id='$_SESSION[customer_id]' and acc_type_id!='0' order by acc_no";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
	 	$sqlaccount_master = "SELECT * FROM account_master where acc_type_id='$rs[acc_type_id]'";
		$qsqlaccount_master = mysqli_query($con,$sqlaccount_master);
		$rsaccount_master = mysqli_fetch_array($qsqlaccount_master);
		
  echo "<tr>
    <td>&nbsp;$rs[acc_date]</td>
    <td>&nbsp;$rs[acc_no] $acprimary</td>
    <td>&nbsp;$rsaccount_master[acc_type] ($rsaccount_master[prefix])</td>
    <td>&nbsp;$rs[interest]%</td>
    <td>&nbsp;$_SESSION[currency] $rs[acc_balance]</td>
    <td>&nbsp;$_SESSION[currency] $rs[unclear_bal]</td>
  </tr>";
  	$acprimary = "";
  }
?>  
</tbody>
</table>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                          Fixed deposit Accounts
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                      <div class="panel-body">
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
  </tr>
  </thead>
  <tbody>
 <?php 
 $acprimary = "(Primary)";
 $sql ="SELECT * FROM accounts WHERE customer_id='$_SESSION[customer_id]' and fd_id!='0' order by acc_no";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
	 	$sqlfixed_deposit = "SELECT * FROM fixed_deposit where fd_id='$rs[fd_id]'";
		$qsqlfixed_deposit = mysqli_query($con,$sqlfixed_deposit);
		$rsfixed_deposit = mysqli_fetch_array($qsqlfixed_deposit);
		$profit = $rs['acc_balance'] * $rs['interest']/100;
		$totrec = $rs['acc_balance'] + $profit;
  echo "<tr>
    <td>&nbsp;$rs[acc_no] $acprimary</td>
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
  </tr>";
  	$acprimary = "";
  }
?>  
</tbody>
</table>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                          Loan accounts
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                      <div class="panel-body">
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
 $sql ="SELECT * FROM loan WHERE  customer_id='$_SESSION[customer_id]'";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
	 	$sqlloan_type= "SELECT * FROM loan_type where loan_type_id='$rs[loan_type_id]'";
		$qsqlloan_type = mysqli_query($con,$sqlloan_type);
		$rsloan_type = mysqli_fetch_array($qsqlloan_type);
		$totamt =  $rs['loan_amt'] + ($rs['loan_amt'] * $rs['interest'] /100);
		
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
	 	$year = $rsloan_type['terms'] . " years";
		$acdate =$rs['create_date'];
	  	echo date('Y-m-d', strtotime($year, strtotime($acdate)) );
	echo "</td>
    <td>&nbsp;₹ $rs[loan_amt]</td>
    <td>&nbsp;₹  ". ($rs['loan_amt'] * $rs['interest'] /100). " ($rs[interest]%)</td>
    <td>&nbsp;₹  ". $totamt . " </td>
    <td>&nbsp;₹  ". $paidamt . " </td>
    <td>&nbsp;₹  ". $pendingamt . " </td>
	<td>&nbsp;<a href='viewloanacdetailed.php?loan_acc_no=$rs[loan_acc_no]'>View</a></td>  </tr>";
  }
?>  
</tbody>
</table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
              
              
              <div class="col-md-12 col-sm-12 margin-bottom-30">
                <div class="panel panel-primary">
                  <div class="panel-heading">Mini statements</div>
                  <div class="panel-body">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;Account No.</th>
    <th scope="col">&nbsp;Amount</th>
    <th scope="col">&nbsp;Particulars</th>
    <th scope="col">&nbsp;Transaction Type</th>
    <th scope="col">&nbsp;Transaction date time</th>
    <th scope="col">&nbsp;Action</th>
  </tr>
  </thead>
  <tbody>
<?php
 // ORDER BY  transaction.trans_id DESC
$sql ="SELECT * FROM transaction INNER JOIN  accounts ON transaction.to_acc_no=accounts.acc_no WHERE accounts.customer_id='$_SESSION[customer_id]' AND (transaction.payment_status='Active' OR transaction.payment_status='Approved')  LIMIT 0,10 ";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
  echo "<tr><td>";
  if($rs['from_acc_no'] != 0)
  {
	  echo "From : " . $rs['from_acc_no'] . "<hr />";
  }
	echo $rs['to_acc_no'];
	echo "</td>
    <td>$rs[amount]</td>
    <td>$rs[particulars]</td>
	<td>$rs[transaction_type]</td>
	<td>$rs[trans_date_time]</td>
	<td>";
	if($rs['payment_status'] == "Pending")
	{
    echo "<a href='viewtransaction.php?trans_id=$rs[trans_id]&st=Active&acno=$rs[to_acc_no]' onclick='confirmtransaction()'>Approve</a> | ";
	echo "<a href='viewtransaction.php?trans_id=$rs[trans_id]&st=Inactive&acno=$rs[to_acc_no]' onclick='confirmtransaction()'>Reject</a>";
	}
	if($rs['transaction_type'] == "Credit")
	{
    echo "<a href='depositmoneyreceipt.php?receiptid=$rs[trans_id]' >Receipt</a>";		
	}
	if($rs['transaction_type'] == "Debit")
	{
    echo "<a href='withdrawmoneyreceipt.php?receiptid=$rs[trans_id]' >Receipt</a>";		
	}
  	echo "</td></tr>";
  }
?> 
</tbody> 
</table>
                  </div>
                </div>
              </div>   
        </div>
      </div>
<?php
include("footer.php");
?>