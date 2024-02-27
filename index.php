<?php 
	include 'users.php';

	$userObject = new Users();
	$users = $userObject->displayUsers();

	$isValid;
	$id = isset($_GET['deleteId']) ? $_GET['deleteId'] : ''; 
	if ($id && !empty($id)) {
		if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
			// echo "string";
			// $userObject->deleteUserDataByUserId($id);
			// header("Location: index.php?message3=delete");
			// exit();
		}
	}
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
	<script>
	    function confirmDelete(userId) {
	        var userConfirmation = confirm('Are you sure?');
	        if (userConfirmation) {
	        	window.location = "delete_user.php?deleteId=" + userId;
	            // // Use AJAX to send a request to delete the user
	            // var xhr = new XMLHttpRequest();
	            // xhr.onreadystatechange = function () {
	            //     if (xhr.readyState === 4 && xhr.status === 200) {
	            //         // Handle the response, if needed
	            //         alert(xhr.responseText);
	            //     }
	            // };
	            // xhr.open("DELETE", "delete_user.php?id=" + userId, true);
	            // xhr.send();
	        }
	        return false;
	    }
	</script>

</head>
<body>
	<div class="card text-center">
		<h4>
			<a href="index.php" class="text-dark">PHP CRUD using OOP and MySQL</a>
		</h4>
	</div>
	<div class="container">
		<?php
			if (isset($_GET['message1']) == 'insert') {
			 	echo "<div class='alert alert-success alert-dismissible'>
			 		<button type='button' class='close' data-dismiss='alert'>
			 			&times;
			 		</button>
			 		Your Registration added Successfully
			 	</div>";
			}
			if (isset($_GET['message2']) == 'update') {
			 	echo "<div class='alert alert-success alert-dismissible'>
			 		<button type='button' class='close' data-dismiss='alert'>
			 			&times;
			 		</button>
			 		Record Updated Successfully
			 	</div>";
			}
			if (isset($_GET['message3']) == 'delete') {
			 	echo "<div class='alert alert-success alert-dismissible'>
			 		<button type='button' class='close' data-dismiss='alert'>
			 			&times;
			 		</button>
			 		Record Deleted Successfully
			 	</div>";
			}
		?>
		<h2>
			View Records
			<a href="addUser.php" class="btn btn-primary" style="float: right;">Add New Record</a>
		</h2>
		<?php
		 if (!array_key_exists('message', $users)) { ?>
			<table class="table">
				<thead>
					<tr>
						<!-- <th>Id</th> -->
						<th>No</th>
						<th>Name</th>
						<th>Email</th>
						<th>Contact</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$users = $userObject->displayUsers();
						foreach ($users as $key => $user) { 
					?>
						<tr>
							<!-- <td><?php echo $user['id']; ?></td> -->
							<td><?php echo $key+1; ?></td>
							<td><?php echo $user['name']; ?></td>
							<td><?php echo $user['email']; ?></td>
							<td><?php echo $user['contact']; ?></td>
							<td>
								<a href="addUser.php?editId=<?php echo $user['id'] ?>">
									<i title="edit" class="fa fa-pencil" area-hidden="true"></i>
								</a>&nbsp;
								<a href="javascript:void(0)" style="color: red;" onclick="return confirmDelete(<?php echo $user['id']; ?>)" type="button">
								    <i title="delete" class="fa fa-trash" area-hidden="true"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php } else {
			echo $users['message'];
		} ?>
	</div>
</body>
</html>