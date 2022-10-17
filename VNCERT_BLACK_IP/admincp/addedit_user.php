<?php
require_once ('../connect/dbhelp.php');

$s_fullname = $s_position = $s_email = $s_username = $s_pass = '';

if (!empty($_POST)) {
	$s_id = '';

	if (isset($_POST['fullname'])) {
		$s_fullname= $_POST['fullname'];
	}

	if (isset($_POST['positon'])) {
		$s_position = $_POST['position'];
	}

	if (isset($_POST['email'])) {
		$s_email = $_POST['email'];
	}

	if (isset($_POST['username'])) {
		$s_username = $_POST['username'];
	}
	if (isset($_POST['pass'])) {
		$s_pass= $_POST['pass'];
	}

	if (isset($_POST['id'])) {
		$s_id = $_POST['id'];
	}
	$s_fullname = str_replace('\'', '\\\'', $s_fullname);
    $s_position = str_replace('\'', '\\\'', $s_position);
	$s_email = str_replace('\'', '\\\'', $s_email);
	$s_username = str_replace('\'', '\\\'', $s_username);
	$s_pass = str_replace('\'', '\\\'', $s_pass);
	$s_id  = str_replace('\'', '\\\'', $s_id);
	

	if ($s_id != '') {
		//update
		$sql = "update member set fullname = '$s_fullname', position = '$s_position', email = '$s_email', username = '$s_username', pass = '$s_pass' where id = " .$s_id;
	} else {
		//insert
		$sql = "insert into member(fullname, position, email, username, pass) value ('$s_fullname', '$s_position', '$s_email', '$s_username', '$s_pass')";
	}

	// echo $sql;

	execute($sql);

	header('Location: manauser.php');
	die();
}

$id = '';
if (isset($_GET['id'])) {
	$id          = $_GET['id'];
	$sql         = 'select * from member where id = '.$id;
	$ipblacklist = executeResult($sql);
	if ($ipblacklist != null && count($ipblacklist) > 0) {
		$std        = $ipblacklist[0];
		$s_fullname = $std['fullname'];
		$s_position  = $std['position'];
		$s_email      = $std['email'];
		$s_username  = $std['username'];
		$s_pass = $std['pass'];
	} else {
		$id = '';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Thêm, Sửa người dùng</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm hoặc sửa thông tin người dùng</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
					  <label for="usr">Họ và tên:</label>
					  <input type="text" name="id" value="<?=$id?>" >
					  <input required="true" type="text" class="form-control" id="usr" name="fullname" value="<?=$s_fullname?>">
					</div>
                    <div class="form-group">
					  <label for="usr">Chức danh:</label>
					  <input type="text" class="form-control" id="usr" name="position" value="<?=$s_position?>">
					</div>
					<div class="form-group">
					  <label for="usr">Gmail:</label>
					  <input type="text" class="form-control" id="usr" name="email" value="<?=$s_email?>">
					</div>
					<div class="form-group">
					  <label for="usr">Tài khoản:</label>
					  <input type="text" class="form-control" id="usr" name="username" value="<?=$s_username?>">
					</div>
					<div class="form-group">
					  <label for="usr">Password:</label>
					  <input type="text" class="form-control" id="usr" name="pass" value="<?=$s_pass?>">
					</div>
					
					<button class="btn btn-success">Save</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>