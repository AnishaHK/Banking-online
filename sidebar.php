<?php
if(isset($_SESSION['emp_id']))
{
	if($rsemployee['emp_type'] == "Admin")
	{
	?>
	<div class="template-page-wrapper">
		  <div class="navbar-collapse collapse templatemo-sidebar" >
			<ul class="templatemo-sidebar-menu">
			  <li class="active"><a href="dashboard.php"><i class="fa fa-home"></i>Dashboard</a></li>         
			   
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Profile <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="adminprofile.php">My Profile</a></li>
				  <li><a href="adminchangepassword.php">Change Password</a></li>
				</ul>
			  </li>
			  
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Customer <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="viewcustomer.php">View Customers </a></li>
				  <li><a href="viewaccounts.php">View Bank Accounts</a></li>
				  <li><a href="viewfdaccounts.php">View FD  Accounts</a></li>
				  <li><a href="viewregisteredpayee.php">View Registered Payees</a></li>
				</ul>
			  </li>
			 
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Loan <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="viewloanpending.php">Pending Loan Accounts</a></li>
				  <li><a href="viewloan.php">View Loan Accounts</a></li>
				  <li><a href="viewloanpayment.php">View Loan Payments</a></li>
				</ul>
			  </li>
			   <?php                  
			 /* <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Transaction <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="depositmoney.php">Deposit Money</a></li>
				  <li><a href="withdrawmoney.php">Withdraw Money</a></li>
				  <li><a href="fundtransfer.php">Fund Transfer</a></li>
				  <li><a href="loanpayment.php">Make Loan Payment</a></li>              
				  <li><a href="empregisteredpayee.php">Add Registered Payee</a></li>
				</ul>
			  </li>
			  */
			  ?>
			  
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Mail <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="mail.php">Compose</a></li>
				  <li><a href="viewinbox.php">Inbox</a></li>
				  <li><a href="viewsentmail.php">Sent Mail</a></li>
				</ul>
			  </li>
			  
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Report <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="viewtransaction.php">Transaction Report</a></li>
				  <li><a href="viewregisteredpayee.php">Registered Payee Report</a></li>
				  <li><a href="viewfdtransaction.php">FD Transaction Report</a></li>
				</ul>
			  </li>
					   
			 <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Account Types <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="accountmaster.php">Add Account Type</a></li>
				  <li><a href="viewaccountmaster.php">View Account Types</a></li>
				  <li><a href="fixeddeposit.php">Add Fixed Deposit Type</a></li>
				  <li><a href="viewfixeddeposit.php">View Fixed Deposit Type</a></li>
				  <li><a href="loantype.php">Add Loan Type</a></li>
				  <li><a href="viewloantype.php">View Loan Type</a></li>
				  
				</ul>
			  </li>
			  
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Employee <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="employee.php">Add Employee</a></li>
				  <li><a href="viewemployee.php">View Employee</a></li>
				</ul>
			  </li>
			  
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Branch <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="branch.php">Add Branch</a></li>
				  <li><a href="viewbranch.php">View Branch</a></li>
				</ul>
			  </li>
			 
			  <li><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Sign Out</a></li>
			</ul>
		  </div><!--/.navbar-collapse -->
	<?php
	}
	if($rsemployee['emp_type'] == "Employee")
	{
	?>
	<div class="template-page-wrapper">
		  <div class="navbar-collapse collapse templatemo-sidebar"  >
			<ul class="templatemo-sidebar-menu">
			  <li class="active"><a href="dashboard.php"><i class="fa fa-home"></i>Dashboard</a></li>         
			   
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Profile <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="empprofile.php">My Profile</a></li>
				  <li><a href="adminchangepassword.php">Change Password</a></li>
				</ul>
			  </li>
			  
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Customer <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="customer.php">Add Customer </a></li>
				  <li><a href="viewcustomer.php">View Customer </a></li>
				  <li><a href="viewaccounts.php">View Bank Account</a></li>
				  <li><a href="viewfdaccounts.php">View FD  Account</a></li>
				  <li><a href="viewregisteredpayee.php">View Registered Payee</a></li>
				</ul>
			  </li>
			 
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Loan <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="viewloanpending.php">Pending Loan Accounts</a></li>
				  <li><a href="viewloan.php">View Loan Accounts</a></li>
				  <li><a href="viewloanpayment.php">View Loan Payment</a></li>
				</ul>
			  </li>
					   
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Transaction <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="depositmoney.php">Deposit Money</a></li>
				  <li><a href="withdrawmoney.php">Withdraw Money</a></li>
				  <li><a href="loanpayment.php">Make Loan Payment</a></li> 
				  <li><a href="fundtransfer.php">Fund Transfer</a></li>            
				  <li><a href="empregisteredpayee.php">Add Registered Payee</a></li>
				</ul>
			  </li>
			  
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Mail <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="mail.php">Compose</a></li>
				  <li><a href="viewinbox.php">Inbox</a></li>
				  <li><a href="viewsentmail.php">Sent Mail</a></li>
				</ul>
			  </li>
			  
			  <li class="sub">
				<a href="javascript:;">
				  <i class="fa fa-database"></i> Report <div class="pull-right"><span class="caret"></span></div>
				</a>
				<ul class="templatemo-submenu">
				  <li><a href="viewtransaction.php">Transaction Report</a></li>
				  <li><a href="viewregisteredpayee.php">Registered Payee Report</a></li>
				  <li><a href="viewfdtransaction.php">FD Transaction Report</a></li>
				</ul>
			  </li>

			 
			  <li><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Sign Out</a></li>
			</ul>
		  </div><!--/.navbar-collapse -->
	<?php
	}
}
if(isset($_SESSION['customer_id']))
{
?>
<div class="template-page-wrapper">
      <div class="navbar-collapse collapse templatemo-sidebar" >
        <ul class="templatemo-sidebar-menu">
          <li class="active"><a href="customerpanel.php"><i class="fa fa-home"></i>Main</a></li>         
           
          <li class="sub">
            <a href="javascript:;">
              <i class="fa fa-database"></i> Profile <div class="pull-right"><span class="caret"></span></div>
            </a>
            <ul class="templatemo-submenu">
              <li><a href="customerprofile.php">My Profile</a></li>
              <li><a href="customerchangepassword.php">Change Login Password</a></li>
              <li><a href="customerchangetranspassword.php">Change Transaction Password</a></li>
            </ul>
          </li>

           <li class="sub">
            <a href="javascript:;">
              <i class="fa fa-database"></i> Bank Accounts <div class="pull-right"><span class="caret"></span></div>
            </a>
            <ul class="templatemo-submenu">
              <li><a href="viewcustbankacc.php">View Bank Accounts</a></li>
              <li><a href="viewcustbanktrans.php">View Bank transactions</a></li>
            </ul>
          </li>
                             
          <li class="sub">
            <a href="javascript:;">
              <i class="fa fa-database"></i> Fund Transfer <div class="pull-right"><span class="caret"></span></div>
            </a>
            <ul class="templatemo-submenu">
              <li><a href="custfundtransfer.php">Transfer Funds</a></li>        
          <li><a href="registeredpayee.php">Add Registered Payee</a></li>
              <li><a href="viewcustregisteredpayee.php">View Registered Payee</a></li>
            </ul>
          </li>
          
          <li class="sub">
            <a href="javascript:;">
              <i class="fa fa-database"></i> FD Accounts <div class="pull-right"><span class="caret"></span></div>
            </a>
            <ul class="templatemo-submenu">
              <li><a href="addcustomerfdaccounts.php">Create FD Account</a></li>
              <li><a href="viewfdtransaction.php">View FD Accounts</a></li>
            </ul>
          </li>
                 
          <li class="sub">
            <a href="javascript:;">
              <i class="fa fa-database"></i> Loan Accounts<div class="pull-right"><span class="caret"></span></div>
            </a>
            <ul class="templatemo-submenu">
              <li><a href="customerloan.php">Loan Account Request</a></li>
              <li><a href="viewcustloanpending.php">Pending Loan Requests</a></li>
              <li><a href="viewcustloan.php">View Loan Accounts</a></li>
              <li><a href="custloanpayment.php">Make Loan Payment</a></li>      
              <li><a href="viewloanpayment.php">View Loan Payment</a></li>
            </ul>
          </li>

          <li class="sub">
            <a href="javascript:;">
              <i class="fa fa-database"></i> Mail <div class="pull-right"><span class="caret"></span></div>
            </a>
            <ul class="templatemo-submenu">
              <li><a href="custmail.php">Compose</a></li>
              <li><a href="viewcusinbox.php">Inbox</a></li>
              <li><a href="viewcustsentmail.php">Sent Mail</a></li>
            </ul>
          </li>
          
          
         
          <li><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Sign Out</a></li>
        </ul>
      </div><!--/.navbar-collapse -->
<?php
}
?>