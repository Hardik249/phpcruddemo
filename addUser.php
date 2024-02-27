<?php 
	include 'users.php';

	$userObject = new Users();

	// edit user form
	$id = isset($_GET['editId']) ? $_GET['editId'] : ''; 
	if ($id && !empty($id)) {
		$user = $userObject->getUserById($_GET['editId']);
	}

	// insert data 
	$validateInsertData;
	if (isset($_POST['submit'])) {
		$validateInsertData = $userObject->setUser($_POST);
		if (isset($validateInsertData) && empty($validateInsertData)) {
			header('Location:index.php?message=insert');
		}
	}

	// update data 
	if (isset($_POST['update'])) {
		$validateInsertData = $userObject->setUserUpdate($_POST);
	}
	// echo "<pre>"; print_r($validateInsertData); exit;
	// if (isset($validateInsertData)) {
	// 	echo "<pre>12"; print_r($validateInsertData); exit;
	// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP CRUD using OOP and MySQL</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="card text-center">
		<h4>
			<a href="index.php" class="text-dark">PHP CRUD using OOP and MySQL</a>
		</h4>
	</div>
	<div class="container">
		<form action="addUser.php<?php echo $id ? '?editId=' . $id : ''; ?>" method="POST">
			<input type="hidden" name="id" value="<?php echo $id ? $id : ''; ?>">
			<div class="form-group">
				<label>Name : </label>
				<input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?php echo $id ? $user['name'] : ''; ?>">
				<span class="text-danger"><?php echo isset($validateInsertData) ? $validateInsertData['name'] : ''; ?></span>
			</div>
			<div class="form-group">
				<label>Email : </label>
				<input type="text" name="email" class="form-control" placeholder="Enter your Email" value="<?php echo $id ? $user['email'] : ''; ?>">
				<span class="text-danger"><?php echo isset($validateInsertData) ? $validateInsertData['email'] : ''; ?></span>
			</div>
			<?php if ($id == '') { ?>
				<div class="form-group">
					<label>Password : </label>
					<input type="password" name="password" class="form-control" placeholder="Enter your Password">
					<span class="text-danger"><?php echo isset($validateInsertData) ? $validateInsertData['password'] : ''; ?></span>
				</div>
			<?php } ?>
			<div class="form-group">
				<label>Contact : </label>
				<input type="text" name="contact" class="form-control" placeholder="Enter your Contact" value="<?php echo $id ? $user['contact'] : ''; ?>">
				<span class="text-danger"><?php echo isset($validateInsertData) ? $validateInsertData['contact'] : ''; ?></span>
			</div>
			<?php if ($id) { ?>
				<input type="submit" name="update" class="btn btn-primary" style="float: right;" value="Update">
			<?php } else { ?>
				<input type="submit" name="submit" class="btn btn-primary" style="float: right;" value="Submit">
			<?php } ?>
		</form>
	</div>
</body>
</html>