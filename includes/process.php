<?php 

include_once("../database/constants.php");
include_once("DBoperations.php");
include_once("user.php");
include_once("manage.php");

//-----------------1--------------- FOR REGISTRATION  ------------------------------------------
	if (isset($_POST["username"]) AND isset($_POST["email"])) {
	$user = new User();
	$result = $user->createUserAccount($_POST["username"],$_POST["email"],$_POST["password1"],$_POST["usertype"]);
	echo $result;
	exit();
	}


//------------------2--------------- FOR LOGIN ---------------------------------------------
	if (isset($_POST["log_email"]) AND isset($_POST["log_pass"])) {
	$user = new User();
	$result = $user->userLogin($_POST["log_email"],$_POST["log_pass"]);
	echo $result;
	exit();
	}




//--------------------1----------- To fetch CATEGORY For Adding -------------------------------
	if (isset($_POST["getCategory"])) 
	{
	$obj = new DBoperation();
	$rows = $obj->getAllRecord("categories");
	foreach ($rows as $row) 
	{
		echo "<option value='".$row["cid"]."'>".$row["category_name"]."</option>";
	}
	exit();
	}


//-------------------2------------ To fetch BRANDS For Adding --------------------------------------
	if (isset($_POST["getBrand"])) 
	{
	$obj = new DBoperation();
	$rows = $obj->getAllRecord("brands");
	foreach ($rows as $row) 
	{
		echo "<option value='".$row["bid"]."'>".$row["brand_name"]."</option>";
	}
	exit();
	}


//-------------------3---------- To fetch EXPENSE TYPES For Adding --------------------------------
	if (isset($_POST["getExpense"])) 
	{
	$obj = new DBoperation();
	$rows = $obj->getAllRecord("exp_types_table");
	foreach ($rows as $row) 
	{
		echo "<option value='".$row["exp_t_id"]."'>".$row["exp_type"]."</option>";
	}
	exit();
	}




//--------------------1--------------- To Add CATEGORY IN DATABASE -------------------------------
	if (isset($_POST["category_name"]) AND isset($_POST["parent_cat"])) 
	{
	$obj = new DBoperation();
	$result = $obj->addCategory($_POST["parent_cat"],$_POST["category_name"]);
	echo $result;
	exit();
	}


//-------------------2----------------To Add BRAND IN DATABASE------------------------------------
	if (isset($_POST["brand_name"])) 
	{
	$obj = new DBoperation();
	$result = $obj->addBrand($_POST["brand_name"]);
	echo $result;
	exit();
	}


//--------------------3------------To Add PRODUCT IN DATABASE---------------------------------------
	if (isset($_POST["added_date"]) AND isset($_POST["product_name"])) 
	{
	$obj = new DBoperation();
	$result = $obj->addProduct($_POST["select_cat"],
							$_POST["select_brand"],
							$_POST["product_name"],
							$_POST["product_price"],
							$_POST["product_qty"],
							$_POST["added_date"]);
	echo $result;
	exit();
	}


//--------------------4-----------To Add EXPENSE IN DATABASE ---------------------------------------
	if (isset($_POST["exp_date"]) AND isset($_POST["exp_des"])) 
	{
		$obj = new DBoperation();
		$result = $obj->addExpense($_SESSION["userid"],
								$_POST["exp_type"],
								$_POST["exp_des"],
								$_POST["exp_quantity"],
								$_POST["exp_date"],
								$_POST["exp_receipt"],
								$_POST["exp_amt"]);
		echo $result;
		exit();
	}

	
//--------------------5-----------To Add EXPENSE TYPES IN DATABASE ---------------------------------------
	if (isset($_POST["exp_type_input"]) AND isset($_POST["exp_t_date"])) 
	{
		$obj = new DBoperation();
		$result = $obj->addExpenseType($_POST["exp_type_input"],
								$_POST["exp_t_date"]);
		echo $result;
		exit();
	}





//-------------------1---------CATEGORIES MANAGING -------------------------------------------
		//--------------------------------- Managing CATEGORY ---------------------------------------
		if (isset($_POST["manageCategory"])) 
		{
			$m = new Manage();
			$result = $m->manageRecordwithpagination("categories",$_POST["pageno"]);
			$rows = $result["rows"];
			$pagination = $result["pagination"];
			if (count($rows) > 0) 
			{
				$n = (($_POST["pageno"] - 1) * 5) + 1;   //here pageno is multiplying with number of rows to display
				//so suppose if its page 1 . we want to display 5 rows and 1-1 = 0 , 0 * 5 = 0, 0 + 1 = 1 so it will be page no. 1 starting from row 1 . and from page no 2 . 2 - 1 = 1 , 1 * 5 = 5, 5 + 1 = 6 ... so it will start from row 6 
				foreach ($rows as $row) 
				{
					?>
					<tr>
						<td><?php echo $n; ?></td>
						<td><?php echo $row["category"]; ?></td>
						<td><?php echo $row["parent"]; ?></td>
						<td>
							<a href="#" did="<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>
							<a href="#" eid="<?php echo $row['cid']; ?>"class="btn btn-info btn-sm edit_cat" data-toggle="modal" data-target="#form_category">Edit</a>
						</td>
					</tr>
					<?php
					$n++;
				} 
				?>

				<tr><td colspan="5"><?php echo $pagination; ?></td></tr>
				
				<?php 
				exit();
			}
		}
		//----------------------------------------- Deleting CATEGORY ------------------------------------------
		if (isset($_POST["deleteCategory"])) {
			$m = new Manage();
			$result = $m->deleteRecord("categories","cid",$_POST["id"]);
			echo $result;
		}
		//----------------------------------------- Update CATEGORY -------------------------------------------
		if (isset($_POST["updateCategory"])) {
			$m = new Manage();
			$result = $m->getSingleRecord("categories","cid",$_POST["id"]);	
			echo json_encode($result); //I will get the result as an Array in JS
			exit();
		}
		//------------------------------ Update record after getting data CATEGORY ----------------------------
		if (isset($_POST["update_category"])) {
			$m = new Manage();
			$id = $_POST["cid"];
			$name = stripslashes(trim($_POST["update_category"]));
			$parent = $_POST["parent_cat"];
			$result = $m->update_record("categories",["cid"=>$id],["parent_cat"=>$parent,"category_name"=>$name,"status"=>1]);
			echo $result;
		}


//----------------2----------BRANDS MAMAGING ---------------------------------------------------
		//----------------------------------------- Managing BRAND --------------------------------
		if (isset($_POST["manageBrand"])) 
		{
			$m = new Manage();
			$result = $m->manageRecordwithpagination("brands",$_POST["pageno"]);
			$rows = $result["rows"];
			$pagination = $result["pagination"];
			if (count($rows) > 0) 
			{
				$n = (($_POST["pageno"] - 1) * 5) + 1;   //here pageno is multiplying with number of rows to display
				//so suppose if its page 1 . we want to display 5 rows and 1-1 = 0 , 0 * 5 = 0, 0 + 1 = 1 so it will be page no. 1 starting from row 1 . and from page no 2 . 2 - 1 = 1 , 1 * 5 = 5, 5 + 1 = 6 ... so it will start from row 6 
				foreach ($rows as $row) 
				{
					?>
					<tr>
						<td><?php echo $n; ?></td>
						<td><?php echo $row["brand_name"]; ?></td>
						<td>
							<a href="#" did="<?php echo $row['bid']; ?>" class="btn btn-danger btn-sm del_brand">Delete</a>
							<a href="#" eid="<?php echo $row['bid']; ?>"class="btn btn-info btn-sm edit_brand" data-toggle="modal" data-target="#form_brand">Edit</a>
						</td>
					</tr>
					<?php
					$n++;
				} 
				?>

				<tr><td colspan="5"><?php echo $pagination; ?></td></tr>
				
				<?php 
				exit();
			}
		}
		//-------------------------------------DELETING BRAND -------------------------------
		if (isset($_POST["deleteBrand"])) 
		{
			$m = new Manage();
			$result = $m->deleteRecord("brands","bid",$_POST["id"]);
			echo $result;
		}
		//---------------------------------- Update BRAND -------------------------------------------
		if (isset($_POST["updateBrand"])) 
		{
			$m = new Manage();
			$result = $m->getSingleRecord("brands","bid",$_POST["id"]);	
			echo json_encode($result);       //I will get the result as an Array in JS
			exit();
		}
		//---------------------------------Update record after getting data BRAND --------------------
		if (isset($_POST["update_brand"])) 
		{
			$m = new Manage();
			$id = $_POST["bid"];
			$name = stripslashes(trim($_POST["update_brand"]));
			$result = $m->update_record("brands",["bid"=>$id],["brand_name"=>$name,"status"=>1]);
			echo $result;
		}


//-----------------3---------- PRODUCTS MANAGING -------------------------------------
		//-------------------------------- Managing Product ------------------------
		if (isset($_POST["manageProduct"])) 
		{
			$m = new Manage();
			$result = $m->manageRecordwithpagination("products",$_POST["pageno"]);
			$rows = $result["rows"];
			$pagination = $result["pagination"];
			if (count($rows) > 0) 
			{
				$n = (($_POST["pageno"] - 1) * 5) + 1;   //here pageno is multiplying with number of rows to display
				//so suppose if its page 1 . we want to display 5 rows and 1-1 = 0 , 0 * 5 = 0, 0 + 1 = 1 so it will be page no. 1 starting from row 1 . and from page no 2 . 2 - 1 = 1 , 1 * 5 = 5, 5 + 1 = 6 ... so it will start from row 6 
				foreach ($rows as $row) 
				{
					?>
					<tr>
						<td><?php echo $n; ?></td>
						<td><?php echo $row["product_name"]; ?></td>
						<td><?php echo $row["category_name"]; ?></td>
						<td><?php echo $row["brand_name"]; ?></td>
						<td><?php echo $row["product_price"]; ?></td>
						<td><?php echo $row["product_stock"]; ?></td>
						<td><?php echo $row["added_date"]; ?></td>
						<td>
							<a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product">Delete</a>
							<a href="#" eid="<?php echo $row['pid']; ?>"class="btn btn-info btn-sm edit_product" data-toggle="modal" data-target="#form_product">Edit</a>
						</td>
					</tr>
					<?php
					$n++;
				} 
				?>

				<tr><td colspan="5"><?php echo $pagination; ?></td></tr>
				
				<?php 
				exit();
			}
		}
		//--------------------------------- Deleting PRODUCTS ------------------------------
		if (isset($_POST["deleteProduct"])) 
		{
			$m = new Manage();
			$result = $m->deleteRecord("products","pid",$_POST["id"]);
			echo $result;
		}
		//---------------------------------- Update PRODUCTS ----------------------------------
		if (isset($_POST["updateProduct"])) 
		{
			$m = new Manage();
			$result = $m->getSingleRecord("products","pid",$_POST["id"]);	
			echo json_encode($result);       //I will get the result as an Array in JS
			exit();
		}
		//-----------------------------------Update record after getting data PRODUCTS ------------------------
		if (isset($_POST["update_product"])) 
		{
			$m = new Manage();
			$id = $_POST["pid"];
			$name = stripslashes(trim($_POST["update_product"]));
			$cat = $_POST["select_cat"];
			$brand = $_POST["select_brand"];
			$price = stripslashes(trim($_POST["product_price"]));
			$qty = stripslashes(trim($_POST["product_qty"]));
			$date = $_POST["added_date"];
			$result = $m->update_record("products",["pid"=>$id],["cid"=>$cat,"bid"=>$brand,"product_name"=>$name,"product_price"=>$price,"product_stock"=>$qty,"added_date"=>$date]);
			echo $result;
		}


//-------------------4-------- EXPENSES MANAGING -------------------------------------
		//-------------------------------- Managing Expenses ------------------------
		if (isset($_POST["manageExpense"])) 
		{
			$m = new Manage();
			$result = $m->manageRecordwithpagination("expense_reg",$_POST["pageno"]);
			$rows = $result["rows"];
			$pagination = $result["pagination"];
			if (count($rows) > 0) 
			{
				$n = (($_POST["pageno"] - 1) * 5) + 1;   //here pageno is multiplying with number of rows to display
				//so suppose if its page 1 . we want to display 5 rows and 1-1 = 0 , 0 * 5 = 0, 0 + 1 = 1 so it will be page no. 1 starting from row 1 . and from page no 2 . 2 - 1 = 1 , 1 * 5 = 5, 5 + 1 = 6 ... so it will start from row 6 
				foreach ($rows as $row) 
				{
					?>
					<tr>
						<td><?php echo $n; ?></td>
						<td><?php echo $row["username"]; ?></td>
						<td><?php echo $row["exp_type"]; ?></td>
						<td><?php echo $row["exp_des"]; ?></td>
						<td><?php echo $row["exp_quantity"]; ?></td>
						<td><?php echo $row["expense_date"]; ?></td>
						<td><?php echo $row["exp_receipt"]; ?></td>
						<td><?php echo $row["exp_amt"]; ?></td>
						<td>
							<a href="#" did="<?php echo $row['eid']; ?>" class="btn btn-danger btn-sm del_Expense">Delete</a>
							<a href="#" uid="<?php echo $row['eid']; ?>"class="btn btn-info btn-sm edit_Expense" data-toggle="modal" data-target="#update_expense">Edit</a>
						</td>
					</tr>
					<?php
					$n++;
				} 
				?>

				<tr><td colspan="5"><?php echo $pagination; ?></td></tr>
				
				<?php 
				exit();
			}
		}
		//--------------------------------- Deleting Expense ------------------------------
		if (isset($_POST["deleteExpense"])) 
		{
			$m = new Manage();
			$result = $m->deleteRecord("expense_reg","eid",$_POST["id"]);
			echo $result;
		}
		//---------------------------------- Update Expense ----------------------------------
		if (isset($_POST["update_Expense"])) 
		{
			$m = new Manage();
			$result = $m->getSingleRecord("expense_reg","eid",$_POST["id"]);	
			echo json_encode($result);       //I will get the result as an Array in JS
			exit();
		}
		//------------------------Update record after getting data Expense ------------------------
		if (isset($_POST["update_exp_des"])) 
		{
			$m = new Manage();
			$eid = $_POST["eid"];
			$des = stripslashes(trim($_POST["update_exp_des"]));
			$qty = $_POST["update_exp_qty"];
			$receipt = $_POST["update_exp_receipt"];
			$price = stripslashes(trim($_POST["update_exp_amt"]));
			$type = stripslashes(trim($_POST["exp_type"]));
			$date = $_POST["exp_date"];
			$result = $m->update_record("expense_reg",["eid"=>$eid],["exp_t_id"=>$type,"exp_des"=>$des,"exp_quantity"=>$qty,"expense_date"=>$date,"exp_receipt"=>$receipt,"exp_amt"=>$price]);
			echo $result;
		}


//-------------------5---------Expense Types MANAGING -------------------------------------------
		//---------------------------- Expense Types CATEGORY ---------------------------------------
		if (isset($_POST["manageExpenseT"])) 
		{
			$m = new Manage();
			$result = $m->manageRecordwithpagination("exp_types_table",$_POST["pageno"]);
			$rows = $result["rows"];
			$pagination = $result["pagination"];
			if (count($rows) > 0) 
			{
				$n = (($_POST["pageno"] - 1) * 5) + 1;   //here pageno is multiplying with number of rows to display
				//so suppose if its page 1 . we want to display 5 rows and 1-1 = 0 , 0 * 5 = 0, 0 + 1 = 1 so it will be page no. 1 starting from row 1 . and from page no 2 . 2 - 1 = 1 , 1 * 5 = 5, 5 + 1 = 6 ... so it will start from row 6 
				foreach ($rows as $row) 
				{
					?>
					<tr>
						<td><?php echo $n; ?></td>
						<td><?php echo $row["exp_type"]; ?></td>
						<td><?php echo $row["exp_type_added"]; ?></td>
						<td>
							<a href="#" did="<?php echo $row['exp_t_id']; ?>" class="btn btn-danger btn-sm del_exp_type">Delete</a>
							<a href="#" eid="<?php echo $row['exp_t_id']; ?>"class="btn btn-info btn-sm edit_exp_type" data-toggle="modal" data-target="#form_edit_type">Edit</a>
						</td>
					</tr>
					<?php
					$n++;
				} 
				?>

				<tr><td colspan="5"><?php echo $pagination; ?></td></tr>
				
				<?php 
				exit();
			}
		}
		//-------------------------------------- Deleting Expense Type ------------------------------------------
		if (isset($_POST["deleteExpenseT"])) {
			$m = new Manage();
			$result = $m->deleteRecord("exp_types_table","exp_t_id",$_POST["id"]);
			echo $result;
		}
		//----------------------------------------- Update Expense Type -------------------------------------------
		if (isset($_POST["update_Expense_Types"])) {
			$m = new Manage();
			$result = $m->getSingleRecord("exp_types_table","exp_t_id",$_POST["id"]);	
			echo json_encode($result); //I will get the result as an Array in JS
			exit();
		}
		//------------------ Update record after getting data Exp Types ----------------------------
		if (isset($_POST["exp_type_input_up"])) {
			$m = new Manage();
			$id = $_POST["eid"];
			$uname = stripslashes(trim($_POST["exp_type_input_up"]));
			$udate = $_POST["exp_tu_date"];
			$status = '1';
			$result = $m->update_record("exp_types_table",["exp_t_id"=>$id],["exp_type"=>$uname,"exp_type_added"=>$udate,"status"=>'1']);
			echo $result;
		}




//--------------------1--------------- ORDERS PROCESSING ----------------------------------------
	if (isset($_POST["getNewOrderItem"])) 
	{
		$obj = new DBoperation();
		$rows = $obj->getAllRecord("products");

		?>
		<tr>
			<td><b class="number">1</b></td>
			<td>
				<select name="pid[]" class="form-control form-control-sm pid" required>
					<option value="">Choose a Product</option>
					<?php 
					foreach ($rows as $row) 
					{
						?><option value="<?php echo $row["pid"]; ?>"><?php echo $row["product_name"]; ?></option><?php
					}
					?>
				</select>
			</td>
			<td><input type="text" name="tqty[]" class="form-control form-control-sm tqty" readonly=""></td>
			<td><input type="text" name="qty[]" class="form-control form-control-sm qty" required=""></td>
			<td><input type="text" name="price[]" class="form-control form-control-sm price" readonly></td>
			<td><input type="hidden" name="pro_name[]" class="form-control form-control-sm pro_name"></td>
			<td>Rs.<span class="amt">0</span></td>
		</tr>
		<?php 
		exit();
	}

	//-----------------------------GET PRICE AND QTY OF ONE ITEM ------------------------------------
	if (isset($_POST["getPriceAndQty"])) {
		$m = new Manage();
		$result = $m->getSingleRecord("products","pid",$_POST["id"]);
		echo json_encode($result);
		exit();
	}

	if (isset($_POST["order_date"]) AND isset($_POST["cust_name"])) {
		
		$order_date = $_POST["order_date"];
		$cust_name = $_POST["cust_name"];


		/*Now Getting Array Data from order_form*/
		$ar_tqty = $_POST["tqty"];
		$ar_qty = $_POST["qty"];
		$ar_price = $_POST["price"];
		$ar_pro_name = $_POST["pro_name"];


		$sub_total = $_POST["sub_total"];
		$gst = $_POST["gst"];
		$discount = $_POST["discount"];
		$net_total = $_POST["net_total"];
		$paid = $_POST["paid"];
		$due = $_POST["due"];
		$payment_type = $_POST["payment_type"];


		$m = new Manage();
		echo $result = $m->storeCustomerOrderInvoice($order_date,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);


	}		




?>