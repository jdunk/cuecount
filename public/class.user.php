<?php

require_once 'dbconfig.php';

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
	
	public function lastID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($uname, $email, $upass, $code)
	{
		try
		{							
			$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO users(userName,userEmail,userPass,tokenCode) 
			                                             VALUES(:user_name, :user_mail, :user_pass, :active_code)");
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE userEmail=:email_id");
			$stmt->execute([':email_id' => $email]);
			$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() != 1) {
				return 'error';
			}

			if($userRow['userStatus'] != "Y") {
				return 'inactive';
			}

			if($userRow['userPass'] != md5($upass))
			{
				return 'error';
			}

			session(['userSession' => $userRow['userID']]);
			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return 'error';
		}
	}

	public function is_logged_in()
	{
		return !empty(session('userSession'));
	}
	
	public function logout()
	{
		session(['userSession' => null]);
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail                 
		$mail->Host       = "smtp.gmail.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username=env('SEND_MAIL_USERNAME');
		$mail->Password=env('SEND_MAIL_PASSWORD');
		$mail->SetFrom('jamesemocko@gmail.com','Cue Count');
		$mail->AddReplyTo("jamesemocko@gmail.com","Cue Count");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}	
}