<?php
include("header.php");
include("sidebar.php");

if(isset($_GET['delid']))
{
	$sql = "DELETE FROM accounts WHERE acc_no='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Account record deleted successfully...');</script>";
	}
}

?> 

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>View Bank Accounts</h1>
          <p>View Bank Account records.</p>

          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
    <td>&nbsp;" .  date("d-M-y",strtotime($rs['acc_date'])) ."</td>
    <td>&nbsp;$rs[acc_no] $acprimary</td>
    <td>&nbsp;$rsaccount_master[acc_type] ($rsaccount_master[prefix])</td>
    <td>&nbsp;$rs[interest]%</td>
    <td>&nbsp;₹ $rs[acc_balance]</td>
    <td>&nbsp;₹ $rs[unclear_bal]</td>
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
