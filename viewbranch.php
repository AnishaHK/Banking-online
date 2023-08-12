<?php
include("header.php");
include("sidebar.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM branch WHERE ifsc_code='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1 )
	{
		echo "<script>alert('Branch record deleted successfully...');</script>";
	}
}
?> 

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">

          <h1>View Branch</h1>
          <p>View Branch records.</p>

          <div class="row margin-bottom-30">
            <div class="col-md-12">
              <ul class="nav nav-pills">
                <li class="active"><a href="branch.php">Add Branch Record</a></li>
              </ul>          
            </div>
          </div> 
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
<table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
  <tr>
    <th scope="col">&nbsp;IFSC Code</th>
    <th scope="col">&nbsp;Branch Name</th>
    <th scope="col">&nbsp;Branch Address</th>
    <th scope="col">&nbsp;State</th>
    <th scope="col">&nbsp;Country</th>
    <th scope="col">&nbsp;Action</th>
  </tr>
  </thead>
  <tbody>
 <?php 
 $sql ="SELECT * FROM branch";
 $qsql = mysqli_query($con,$sql);
 while($rs = mysqli_fetch_array($qsql))
 {
  echo "<tr>
    <td>&nbsp;$rs[ifsc_code]</td>
    <td>&nbsp;$rs[branch_name]</td>
    <td>&nbsp;$rs[branch_address]</td>
    <td>&nbsp;$rs[state]</td>
	<td>&nbsp;$rs[country]</td>
    <td>&nbsp;<a href='branch.php?editid=$rs[ifsc_code]' class='btn btn-info'>Edit</a> | <a href='viewbranch.php?delid=$rs[ifsc_code]' onclick='return confirmtodelete()' class='btn btn-danger'>Delete</a></td>
  </tr>";
  }
?>  
</tbody>
</table>
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