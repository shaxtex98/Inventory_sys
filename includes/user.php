<?php 

/**
 * user class for account creation and login purposes
 */
class User
{

	private $con;
	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();

	}
//CHECKING if User is registered or not (already)
	private function emailExists($email)
	{
		//checks if the email exists or not
		$pre_stmt = $this->con->prepare("SELECT id from users WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) 
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	
//FOR CREATING ACCOUNTS
	public function createUserAccount($username,$email,$password,$usertype)
	{
		//to protect your application from sql injections you can use prepared statements
		if ($this->emailExists($email)) 
		{
			echo "EMAIL_ALREADY_TAKEN";
		}
		else
		{
			$pass_hash = password_hash($password, PASSWORD_BCRYPT,["cost"=>8]);
			$date = date("Y-m-d");
			$notes = "";
			$pre_stmt = $this->con->prepare("INSERT INTO `users`(`username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES (?,?,?,?,?,?,?)");
			$pre_stmt->bind_param("sssssss",$username,$email,$pass_hash,$usertype,$date,$date,$notes);
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) 
			{
				return $this->con->insert_id;
			}
			else
			{
				return "SOME_ERROR";
			}
		}	
	}


//FOR LOGIN PURPOSES
	public function userLogin($email,$password)
	{
		$pre_stmt = $this->con->prepare("SELECT id,username,password,last_login FROM users WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();

		if ($result->num_rows < 1)
		{
			return "NOT_REGISTERD";
		}
		else
		{
			$row = $result->fetch_assoc();
			if (password_verify($password, $row["password"])) 
			{
				$_SESSION["userid"] = $row["id"];
				$_SESSION["username"] = $row["username"];
				$_SESSION["last_login"] = $row["last_login"];

				//here we are updating the user last login when he is loging in
				$last_login = date("Y-m-d h:m:s");
				$pre_stmt = $this->con->prepare("UPDATE users SET last_login = ? WHERE email = ?");
				$pre_stmt->bind_param("ss",$last_login,$email);
				$result = $pre_stmt->execute() or die($this->con->error);
				if ($result) 
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return "PASSWORD_NOT_MATCHED";
			}
		}
	}
	
}

//$user = new User();
//echo $user->createUserAccount("TEST","test@gmail.com","12345678","Admin");

//echo $user->userLogin("test@gmail.com","12345678");
//echo $_SESSION["username"];

?>