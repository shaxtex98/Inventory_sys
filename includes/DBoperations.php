<?php
/**
 * 
 */
class DBoperation
{

	private $con;

	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

//QUERY SECTION CATEGORY ADDING
	public function addCategory($parent,$cat)
	{
		$pre_stmt = $this->con->prepare("INSERT INTO `categories`(`parent_cat`, `category_name`, `status`) VALUES (?,?,?)");
		$status = 1;
		$pre_stmt->bind_param("isi",$parent,$cat,$status);
		$result = $pre_stmt->execute() or die($this->con->error);
		if($result) 
		{
			return "CATEGORY_ADDED";
		}
		else
		{
			return 0;
		}
	}		


//QUERY SECTION BRANDS ADDING
	public function addBrand($brand_name)
	{
		$pre_stmt = $this->con->prepare("INSERT INTO `brands`(`brand_name`, `status`) VALUES (?,?)");
		$status = 1;
		$pre_stmt->bind_param("si",$brand_name,$status);
		$result = $pre_stmt->execute() or die($this->con->error);
		if($result) 
		{
			return "BRAND_ADDED";
		}
		else
		{
			return 0;
		}
	}	


//QUERY SECTION PRODUCTS ADDING 
	public function addProduct($cid,$bid,$pro_name,$price,$stock,$date)
	{
		$pre_stmt = $this->con->prepare("INSERT INTO `products`(`cid`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`) VALUES (?,?,?,?,?,?,?)");
		$status = 1;
		$pre_stmt->bind_param("iisdisi",$cid,$bid,$pro_name,$price,$stock,$date,$status);
		$result = $pre_stmt->execute() or die($this->con->error);
		if($result) 
		{
			return "NEW_PRODUCT_ADDED";
		}
		else
		{
			return 0;
		}
	}


//QUERY SECTION EXPENSE ADDING 
	public function addExpense($id,$exp_type,$exp_des,$exp_quantity,$exp_date,$exp_receipt,$exp_amt)
	{
		$pre_stmt = $this->con->prepare("INSERT INTO `expense_reg`(`id`, `exp_t_id`, `exp_des`, `exp_quantity`, `expense_date`, `exp_receipt`, `exp_amt`, `status`) VALUES (?,?,?,?,?,?,?,?)");
		$status = '1';
		$id = $_SESSION["userid"];
		$pre_stmt->bind_param("ississii",$id,$exp_type,$exp_des,$exp_quantity,$exp_date,$exp_receipt,$exp_amt,$status);
		$result = $pre_stmt->execute() or die($this->con->error);
		if($result) 
		{
			return "NEW_EXPENSE_ADDED";
		}
		else
		{
			return 0;
		}
	}

	
//QUERY SECTION EXPENSE TYPE ADDING 
	public function addExpenseType($exp_type_input,$exp_t_date)
	{
		$pre_stmt = $this->con->prepare("INSERT INTO `exp_types_table`(`exp_type`, `exp_type_added`, `status`) VALUES (?,?,?)");
		$status = '1';
		$pre_stmt->bind_param("ssi",$exp_type_input,$exp_t_date,$status);
		$result = $pre_stmt->execute() or die($this->con->error);
		if($result) 
		{
			return "NEW_EXPENSE_TYPE_ADDED";
		}
		else
		{
			return 0;
		}
	}


//GETTING ALL THE RECORDS METHOD
	public function getAllRecord($table)
	{
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) 
			{
				$rows[] = $row;
			}
			return $rows;
		}
		
	return "NO_DATA";
	} 

}

//$opr = new DBoperation(); 
//echo $opr->addCategory(1,"Mobiles");
//echo "<pre>";
//print_r($opr->getAllRecord("categories"));

?>