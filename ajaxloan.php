<?php
error_reporting(0);
	include("dbconnection.php");
	$sqledit = "SELECT * FROM loan_type where loan_type_id='$_GET[loanid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
?>
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Minimum Amount</label>
                    <input type="text" class="form-control" id="minimumamt" name="minimumamt" placeholder="Minimum amount" value="<?php echo $rsedit[min_amount]; ?>" readonly="readonly" style="background-color:#9C9">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
				  
                  </div>
                  </div>
                
                
                <div class="row">
                <div class="col-md-6 margin-bottom-15">
                 <label for="firstName" class="control-label">Maximum amount</label>
                 <input type="datetime" class="form-control" id="maximumamt" name="maximumamt" placeholder="Maximum amount" value="<?php echo $rsedit[max_amount]; ?>" readonly="readonly" style="background-color:#9C9"> 
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />

                  </div>
                  </div>                
                  
                  
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Interest (In percentage %)</label>
                    <input type="text" class="form-control" name="interest" id="interest" placeholder="Interest" value="<?php echo $rsedit['interest']; ?>" readonly="readonly" style="background-color:#9C9">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />

                  </div>
                  </div>
                
                
                <div class="row">
                <div class="col-md-6 margin-bottom-15">
                 <label for="firstName" class="control-label">Terms (in year)</label>
                 <input type="text" class="form-control" name="terms" id="terms" placeholder="Terms" value="<?php echo $rsedit[terms]; ?>" readonly="readonly" style="background-color:#9C9"> 
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />

                  </div>
                  </div>
                  
                                    <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Loan amount</label>
                    <input type="text" class="form-control" name="amtloanamount" id="amtloanamount" placeholder="Loan amount" value="<?php echo $rsedit[loan_amt]; ?>" onkeyup="calculategrandtotal()">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsamtloanamount" ></span>
                  </div>
                  </div>
                               
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Interest amount</label>
                    <input type="text" class="form-control" name="tinterestamt" id="tinterestamt" placeholder="Interest amount calculates automatically" readonly="readonly" style="background-color:#9C9">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsloanamount" ></span>
                  </div>
                  </div>
                  
                                                 
                  <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Total Payable</label>
                    <input type="text" class="form-control" name="tgrandtotal" id="tgrandtotal" placeholder="Total Payable calculates automatically" readonly="readonly" style="background-color:#9C9">  
                  </div>
                  <div class="col-md-6 margin-bottom-15"><br /><br />
                  <span id="jsloanamount" ></span>
                  </div>
                  </div>
          
              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>  
                </div>
              </div>

             