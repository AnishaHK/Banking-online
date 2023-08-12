<?php
error_reporting(0);
include("dbconnection.php");
	$sqlregistered_payee = "SELECT * FROM registered_payee where registered_payee_id='$_GET[registered_payee_id]'";
	$qsqlregistered_payee = mysqli_query($con,$sqlregistered_payee);
	$rsregistered_payee = mysqli_fetch_array($qsqlregistered_payee);
?>
<table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <th scope="row">&nbsp;Bank Account type</th>
      <td>&nbsp;<?php echo $rsregistered_payee['registered_payee_type']; ?>
      <input type="hidden" name="regpayregistered_payee_type" value="<?php echo $rsregistered_payee['registered_payee_type']; ?>">
      </td>
    </tr>
    <tr>
      <th scope="row">&nbsp;Payee name</th>
      <td>&nbsp;<?php echo $rsregistered_payee['payee_name']; ?>
      <input type="hidden" name="regpaypayee_name" value="<?php echo $rsregistered_payee['payee_name']; ?>"></td>
    </tr>
    <tr>
      <th scope="row">&nbsp;Bank account No.</th>
      <td>&nbsp;<?php echo $rsregistered_payee['bank_acc_no']; ?>
      <input type="hidden" name="regpaybank_acc_no" value="<?php echo $rsregistered_payee['bank_acc_no']; ?>"></td>
    </tr>
    <tr>
      <th scope="row">&nbsp;Account type</th>
      <td>&nbsp;<?php echo $rsregistered_payee['acc_type']; ?>
      <input type="hidden" name="regpayacc_type" value="<?php echo $rsregistered_payee['acc_type']; ?>"></td>
    </tr>
    <tr>
      <th scope="row">&nbsp;Bank name</th>
      <td>&nbsp;<?php echo $rsregistered_payee['bank_name']; ?>
      <input type="hidden" name="regpaybank_name" value="<?php echo $rsregistered_payee['bank_name']; ?>"></td>
    </tr>
    <tr>
      <th scope="row">&nbsp;IFSC Code</th>
      <td>&nbsp;<?php echo $rsregistered_payee['ifsc_code']; ?>
      <input type="hidden" name="regpayifsc_code" value="<?php echo $rsregistered_payee['ifsc_code']; ?>"></td>
    </tr>
  </tbody>
</table>
