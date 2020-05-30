<?php

if (isset($_POST['signup_submit'])) {

		require_once 'dbh.inc.php';

		$username = $_POST['fullname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		function locate($error,$username,$email) 
		{
			header("Location: ../signup.php?error=".$error."&username=".$username."&mail=".$email);
		}

		if(empty($username) || empty($email) || empty($password) || empty($confirm_password) ) {
			locate('EmptyFields',$username,$email);
			exit();
		} 
		elseif(!preg_match("/^[a-zA-Z0-9]*$/",$username) && !filter_var($email,FILTER_VALIDATE_EMAIL)) {
			header("Location: ../signup.php?error=InvalidDetails");
			exit();
		}
		elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			locate('InvalidEmail',$username,$email);
			exit();
		}
		elseif(!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
			locate('InvalidName',$username,$email);
			exit();
		}
		elseif(!preg_match("/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])/",$password)) {
			locate('InvalidPassword',$username,$email);
			exit();
		}
		elseif(strlen($password)  < 8) {
			locate('shortPassword',$username,$email);
			exit();
		} 
		elseif(strlen($password)  > 15) {
			locate('longPassword',$username,$email);
			exit();
		}
		elseif ($password !== $confirm_password) {
			locate('PasswordNotMatch',$username,$email);
			exit();
		}
		else {
			$sql = "SELECT email FROM users WHERE email= ?;";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../signup.php?error=SqlError");
				exit();
			}
			else {
				mysqli_stmt_bind_param($stmt,"s",$email);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$result_check = mysqli_stmt_num_rows($stmt);
				if($result_check > 0) {
					locate('EmailTaken',$username,$email);
					exit();
				}
				else {
					$sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?);";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../signup.php?error=SqlError");
						exit();
					}
					else {
						$hash_password = password_hash($password, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hash_password);
						mysqli_stmt_execute($stmt);
						header("Location: ../signup.php?signup=success");
						exit();
					}
				}

			}
		} 
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
}
else {
	header("Location: ../signup.php");
	exit();
}