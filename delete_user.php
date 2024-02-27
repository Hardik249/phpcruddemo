<?php 
	include 'users.php';

	$userObject = new Users();
	$id = isset($_GET['deleteId']) ? $_GET['deleteId'] : ''; 
	if ($id && !empty($id)) {
		// echo "string";
		$userObject->deleteUserDataByUserId($id);
		header("Location: index.php?message3=delete");
		exit();
	}
?>
