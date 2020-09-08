<?php
include_once("./database/constants.php");
// if the session is not set then it will go the following page not dashboard.
if(!isset($_SESSION["userid"])){
	header("location:".DOMAIN."/");
}
?>
<!DOCTYPE html>
<html>

<body>
	<!-- Navbar  -->
	<?php include_once("./templates/header.php"); ?>
	<br/><br/>
	
	<div class="container">
		<div class="row">
			<div class="col-md-10 mx-auto">
				<div class="card" style="box-shadow: 0 0 25px 0 lightgrey;">
					<div class="card-header">
						<h4>New Orders</h4>
					</div>
					<div class="card-body">
						<form id="get_order_data" onsubmit="return false">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" align="right">Order Date</label>
								<div class="col-sm-6">
									<input type="text" id="order_date" class="form-control form-control-sm" value="<?php echo date("d-M-Y"); ?>" name="order_date" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" align="right">Customer name*</label>
								<div class="col-sm-6">
									<input type="text" id="cust_name" class="form-control form-control-sm" placeholder="Enter Customer's Name" name="cust_name" required/>
								</div>
							</div>

							<div class="card" style="box-shadow: 0 0 15px 0 lightgrey;">
								<div class="card-body">
									<h3>Make an Order List</h3>
									<table align="center" style="width: 800px;">
										<thead>
											<tr>
												<th>#</th>
												<th style="text-align: center;">Item Name</th>
												<th style="text-align: center;">Total Quantity</th>
												<th style="text-align: center;">Quantity</th>
												<th style="text-align: center;">Price<small><strong> PKR </strong></small></th>
												<th colspan="3">Total</th>
											</tr> 
										</thead>
										<tbody id="invoice_item">
									<!--	<tr>
												<td><b id="number">1</b></td>
												<td>
													<select name="pid[]" class="form-control form-control-sm" required=""/>
													<option>Washing Machine</option>
												</select>
											</td>
											<td><input type="text" name="tqty[]" class="form-control form-control-sm" readonly=""></td>
											<td><input type="text" name="qty[]" class="form-control form-control-sm" required=""></td>
											<td><input type="text" name="price[]" class="form-control form-control-sm" readonly=""></td>
											<td>Rs.1540</td>
										</tr> -->
									</tbody>
								</table> <!-- table ends here -->

								<center style="padding: 10px;">
									<button class="btn btn-success" style="width: 150px;" id="add">Add</button>
									<button class="btn btn-danger" style="width: 150px;" id="remove">Remove</button>
								</center>
							</div> <!-- Card Body Ends -->
						</div> <!-- Order List Card Ends -->

						<p></p>

						<div class="form-group row">
							<label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
							<div class="col-sm-6">
								<input type="text" name="sub_total" id="sub_total" class="form-control form-control-sm" readonly required/>
							</div>
						</div>
						<div class="form-group row">
							<label for="gst" class="col-sm-3 col-form-label" align="right">GST (18%)</label>
							<div class="col-sm-6">
								<input type="text" name="gst" id="gst" class="form-control form-control-sm" readonly required/>
							</div>
						</div>
						<div class="form-group row">
							<label for="discount" class="col-sm-3 col-form-label" align="right">Discount</label>
							<div class="col-sm-6">
								<input type="text" name="discount" id="discount" class="form-control form-control-sm" required/>
							</div>
						</div>
						<div class="form-group row">
							<label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
							<div class="col-sm-6">
								<input type="text" name="net_total" id="net_total" class="form-control form-control-sm" readonly required/>
							</div>
						</div>
						<div class="form-group row">
							<label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
							<div class="col-sm-6">
								<input type="text" name="paid" id="paid" class="form-control form-control-sm" required/>
							</div>
						</div>
						<div class="form-group row">
							<label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
							<div class="col-sm-6">
								<input type="text" name="due" id="due" class="form-control form-control-sm" readonly required/>
							</div>
						</div>
						<div class="form-group row">
							<label for="payment_type" class="col-sm-3 col-form-label" align="right">Payment Method</label>
							<div class="col-sm-6">
								<select name="payment_type" id="payment_type" class="form-control form-control-sm" required/>
									<option>Cash</option>
									<option>Card</option>
									<option>Draft</option>
									<option>Cheque</option>
								</select>
							</div>
						</div>

						<center>
							<input type="submit" id="order_form" style="width: 150px;" class="btn btn-info" value="Order">
							<input type="submit" id="print_invoice" style="width: 150px;" class="btn btn-success d-none" value="Print">
						</center>
					</form>
				</div>
			</div>
		</div>	
	</div>
</div>

</body>
</html>
