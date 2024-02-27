<?php 

	class Users {
		private $servername = 'localhost';
		private $username = 'newuser';
		private $password = 'root';
		private $database = 'crudoperation';
		public $con;

		public function __construct()
		{
			$this->con = new mysqli($this->servername, $this->username, $this->password, $this->database);
			if (mysqli_connect_error()) {
				trigger_error("Failed to connct to MySQL" . mysqli_connect_error());
			} else {
				return $this->con;
			}
		}

		// validate data 
		public function validateData($id, $name, $email, $password, $contact)
		{
			$errors = array();
			if ($name == '') {
				$errors['name'] = 'Plase enter your Name.';
			}
			if ($email == '') {
				$errors['email'] = 'Plase enter your Email.';
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))  {
				$errors['email'] = 'Please enter your valid Email id.';
			}
			if ($id == '') {
				if ($password == '') {
					$errors['password'] = 'Plase enter your Password.';
				} elseif (strlen($password) < 8) {
					$errors['password'] = 'Password must be 8 characters long.';
				}
			}
			if ($contact == '') {
				$errors['contact'] = 'Plase enter your Contact.';
			} elseif (strlen($contact) < 10) {
				$errors['contact'] = 'Please Enter your Contact number 10 digits long.';
			}
			return $errors;
		}

		//insert data 
		public function setUser($post)
		{
			$name = isset($_POST['name']) ? $this->con->real_escape_string($_POST['name']) : '';
			$email = isset($_POST['email']) ? $this->con->real_escape_string($_POST['email']) : '';
			$password = isset($_POST['password']) ? $this->con->real_escape_string($_POST['password']) : '';
			$contact = isset($_POST['contact']) ? $this->con->real_escape_string($_POST['contact']) : '';
			$id;
			$validation = $this->validateData($id, $name, $email, $password, $contact);
			if (isset($validation) && !empty($validation)) {
				return $validation;
			} else {
				$hashPass = md5($password);
				$query = "INSERT INTO users(name, email, password, contact) VALUES('$name', '$email', '$hashPass', '$contact')";
				$sql = $this->con->query($query);
				if ($sql == true) {
					header("Location:index.php?message1=insert");
				} else {
					echo "Registration Failed try again!";
				}
			}
		}

		//diplay users
		public function displayUsers()
		{
			$query = "SELECT * FROM users";
			$result = $this->con->query($query);
			$data = array();
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
			} else {
				$data['message'] = "No record found!";
			}
			return $data;
		}

		// GET single data in edit form 
		public function getUserById($id)
		{
			$query = "SELECT * FROM users WHERE id = '$id'";
			$result = $this->con->query($query);
			$data = array();
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()){
					$data = $row;
				}
			} else {
				$data['message'] = "No record found!";
			}
			return $data;
		}

		//update data 
		public function setUserUpdate($postUserUpdateData)
		{
			$name = isset($_POST['name']) ? $this->con->real_escape_string($_POST['name']) : '';
			$email = isset($_POST['email']) ? $this->con->real_escape_string($_POST['email']) : '';
			$password;
			//  = isset($_POST['password']) ? $this->con->real_escape_string($_POST['password']) : ''
			$contact = isset($_POST['contact']) ? $this->con->real_escape_string($_POST['contact']) : '';
			$id = isset($_POST['id']) ? $this->con->real_escape_string($_POST['id']) : '';
			$validation = $this->validateData($id, $name, $email, $password, $contact);
			if (isset($validation) && !empty($validation)) {
				return $validation;
			} else {
				$hashPass = md5($password);
				if (!empty($postUserUpdateData) && !empty($id)) {
					$query = "UPDATE users SET name = '$name', email = '$email', contact = '$contact' WHERE id = '$id'";
					$sql = $this->con->query($query);
					if ($sql == true) {
						header("Location:index.php?message2=update");
					} else {
						echo "Record Update Failed try again!";
					}
				}
			}
		}

		// delete user data by user id
		public function deleteUserDataByUserId($id)
		{
			$query = "DELETE FROM users WHERE id = '$id'";
			$sql = $this->con->query($query);
			if ($sql == true) {
				header("Location:index.php?message3=delete");
			} else {
				echo "Record Delete Failed try again!";
			}

		}
	}


?>