<?php
include("header.php");
if(!isset($_SESSION['emp_id']))
{
	echo "<script>window.location='adminlogin.php';</script>";
}
include("sidebar.php");
?>
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <h1>Dashboard</h1>
      

          <div class="row">
            <div class="col-md-6">
              <div class="templatemo-progress">
                <div class="list-group">
                <a href="viewtransaction.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Total Loan paid</h4>
                    <p class="list-group-item-text">
                    <h3>₹ <?php
					$sql = "Select sum(paid) from loan_payment";
					$qsql = mysqli_query($con,$sql);
					$rs = mysqli_fetch_array($qsql);
					echo $rs[0];
					?></h3>
                    </p>
                  </a>
                  <a href="viewtransaction.php" class="list-group-item active">
                    <h4 class="list-group-item-heading">Total credit Amount</h4>
                    <p class="list-group-item-text">
                    <h3>₹ <?php
					$sql = "Select sum(amount) from transaction where transaction_type='Credit' AND payment_status='Active'";
					$qsql = mysqli_query($con,$sql);
					$rs = mysqli_fetch_array($qsql);
					echo $rs[0];
					?></h3>
                    </p>
                  </a>
                  <a href="viewtransaction.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Total Commision</h4>
                    <p class="list-group-item-text">
                    <h3>₹ <?php
					$sql = "Select sum(comission) from transaction where payment_status='Active'";
					$qsql = mysqli_query($con,$sql);
					$rs = mysqli_fetch_array($qsql);
					echo $rs[0];
					?></h3>
                    </p>
                  </a>
                  <a href="viewaccounts.php" class="list-group-item active">
                    <h4 class="list-group-item-heading">Number of Accounts</h4>
                    <p class="list-group-item-text">
                    <h3> <?php
					$sql = "Select * from accounts where acc_status='Active'";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?></h3>
                    </p>
                  </a>
                  <a href="viewloan.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Number of Loan Accounts</h4>
                    <p class="list-group-item-text">
                    <h3> <?php
					$sql = "Select * from loan";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?></h3>
                    </p>
                  </a>
                  <a href="viewaccountmaster.php" class="list-group-item active">
                    <h4 class="list-group-item-heading">Number of Account Types</h4>
                    <p class="list-group-item-text">
                     <h3> <?php
					$sql = "Select * from account_master where status='Active'";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?></h3>
                    </p>
                  </a>
                  <a href="viewloanpayment.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Number of Loan Payments</h4>
                    <p class="list-group-item-text">
                    <h3> <?php
					$sql = "Select * from loan_payment";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?></h3>
                    </p>
                  </a>
                  <a href="viewbranch.php" class="list-group-item active">
                    <h4 class="list-group-item-heading">Number of Branches</h4>
                    <p class="list-group-item-text">
                     <h3> <?php
					$sql = "Select * from branch";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?></h3>
                    </p>
                  </a>
                  <a href="viewloantype.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Number of Loan Types</h4>
                    <p class="list-group-item-text">
                    <h3> <?php
					$sql = "Select * from loan_type where status='Active'";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?></h3>
                    </p>
                  </a>
                </div>
              </div> 
            </div>
            
            <div class="col-md-6">
              <div class="templatemo-progress">
                <div class="list-group">
                 <a href="viewloan.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Total interest amount</h4>
                    <p class="list-group-item-text">
                     <h3>₹ <?php
					$sql = "Select sum(interest) from loan_payment";
					$qsql = mysqli_query($con,$sql);
					$rs = mysqli_fetch_array($qsql);
					echo $rs[0];
					?></h3>
                    </p>
                  </a>
                  <a href="viewtransaction.php" class="list-group-item active">
                    <h4 class="list-group-item-heading">Total Debit amount</h4>
                    <p class="list-group-item-text">
                     <h3>₹ <?php
					$sql = "Select sum(amount) from transaction where transaction_type='Debit' AND payment_status='Active'";
					$qsql = mysqli_query($con,$sql);
					$rs = mysqli_fetch_array($qsql);
					echo $rs[0];
					?></h3>
                    </p>
                  </a>
                  <a href="viewloan.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Total loan amount</h4>
                    <p class="list-group-item-text">
                     <h3>₹ <?php
					$sql = "Select sum(loan_amt) from loan";
					$qsql = mysqli_query($con,$sql);
					$rs = mysqli_fetch_array($qsql);
					echo $rs[0];
					?></h3>
                    </p>
                  </a>
                  <a href="viewcustomer.php" class="list-group-item active">
                    <h4 class="list-group-item-heading">Number of Customer Accounts</h4>
                    <p class="list-group-item-text">
                      <h3> <?php
					$sql = "Select * from customer where acc_status='Active'";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?></h3>
                    </p>
                  </a>
                  <a href="viewinbox.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Number of mails</h4>
                    <p class="list-group-item-text">
                    <h3> <?php
					$sql = "Select * from mail";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?></h3>
                    </p>
                  </a>
                  <a href="viewemployee.php" class="list-group-item active">
                    <h4 class="list-group-item-heading">Number of Employee Accounts</h4>
                    <p class="list-group-item-text">
                    <h3> <?php
					$sql = "Select * from employee";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?></h3>
                    </p>
                   
                  </a>
                  <a href="viewregisteredpayee.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Number of Registered Payee's</h4>
                    <p class="list-group-item-text">
                    <h3> <?php
					$sql = "Select * from registered_payee";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?></h3>
                    </p>
                  </a>
                  <a href="viewfixeddeposit.php" class="list-group-item active">
                    <h4 class="list-group-item-heading">Number of Fixed Deposits</h4>
                    <p class="list-group-item-text">
                    <h3> <?php
					$sql = "Select * from fixed_deposit";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?>
                    </h3>
                    </p>
                  </a>
                  <a href="viewtransaction.php" class="list-group-item">
                    <h4 class="list-group-item-heading">Number of Transactions</h4>
                    <p class="list-group-item-text">
                    <h3> <?php
					$sql = "Select * from transaction where payment_status='Active'";
					$qsql = mysqli_query($con,$sql);
					echo mysqli_num_rows($qsql);
					?></h3>
                    </p>
                  </a>
                </div>
              </div> 
            </div>
            
            
          </div>   
        </div>
      </div>
<?php
include("footer.php");
?>