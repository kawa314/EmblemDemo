<?php

require_once('dbconfig.php');

class TICKET
{

	private $conn;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function register($name,$detail,$price)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO ticket(name,detail,price)
		                                               VALUES(:tname, :tdetail, :tprice)");

			$stmt->bindparam(":tname", $name);
			$stmt->bindparam(":tdetail", $detail);
			$stmt->bindparam(":tprice", $price);

			$stmt->execute();

			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}


class SALE
{

	private $conn;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function update($user_id, $ticket_id, $quantity)
	{
		try
		{
			$stmt = $this->conn->prepare("UPDATE sale SET quantity=quantity+:quantity WHERE user_id=:user_id AND ticket_id=:ticket_id");
			$stmt->bindparam(":quantity", $quantity);
			$stmt->bindparam(":user_id", $user_id);
			$stmt->bindparam(":ticket_id", $ticket_id);

			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}


	public function register($user_id,$ticket_id,$quantity)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO sale(user_id,date,ticket_id,quantity)
		                                               VALUES(:user_id, :date, :ticket_id, :quantity)");

			$stmt->bindparam(":user_id", $user_id);
			$stmt->bindparam(":date", date("Ymd"));
			$stmt->bindparam(":ticket_id", $ticket_id);
			$stmt->bindparam(":quantity", $quantity);

			$stmt->execute();

			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}


class USER
{

	private $conn;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function register($uname,$umail,$upass,$ubirth)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);

			$stmt = $this->conn->prepare("INSERT INTO user(user_name,user_email,user_pass,birth)
		                                               VALUES(:uname, :umail, :upass, :ubirth)");

			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);
			$stmt->bindparam(":ubirth", $ubirth);

			$stmt->execute();

			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}


	public function doLogin($uname,$umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass FROM user WHERE user_name=:uname OR user_email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['user_pass']))
				{
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}

	public function redirect($url)
	{
		header("Location: $url");
	}

	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>
