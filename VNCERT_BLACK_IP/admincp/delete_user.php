<?php
if (isset($_POST['id'])) {
	$id = $_POST['id'];

	require_once ('../connect/dbhelp.php');
	$sql = 'delete from member where id = '.$id;
	execute($sql);

	echo 'Xoá người dùng thành công';
}