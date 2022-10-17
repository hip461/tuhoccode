<?php
if (isset($_POST['id'])) {
	$id = $_POST['id'];

	require_once ('../connect/dbhelp.php');
	$sql = 'delete from tendinhdanh where id = '.$id;
	execute($sql);

	echo 'Xoá doanh nghiệp thành công';
}