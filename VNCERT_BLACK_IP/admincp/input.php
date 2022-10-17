<?php
require_once ('../connect/dbhelp.php');

$s_ten_dinh_danh = $s_ten_to_chuc = $s_ma_doanh_nghiep = $s_loai_to_chuc = $s_hinh_thuc_su_dung = $s_ngay_tao = $s_trang_thai = '';

if (!empty($_POST)) {
	$s_id = '';

	if (isset($_POST['ten_dinh_danh'])) {
		$s_ten_dinh_danh= $_POST['ten_dinh_danh'];
	}

	if (isset($_POST['ten_to_chuc'])) {
		$s_ten_to_chuc = $_POST['ten_to_chuc'];
	}

	if (isset($_POST['ma_doanh_nghiep'])) {
		$s_ma_doanh_nghiep = $_POST['ma_doanh_nghiep'];
	}
	if (isset($_POST['loai_to_chuc'])) {
		$s_loai_to_chuc= $_POST['loai_to_chuc'];
	}

	if (isset($_POST['hinh_thuc_su_dung'])) {
		$s_hinh_thuc_su_dung = $_POST['hinh_thuc_su_dung'];
	}

	if (isset($_POST['ngay_tao'])) {
		$s_ngay_tao = $_POST['ngay_tao'];
	}
	if (isset($_POST['trang_thai'])) {
		$s_trang_thai = $_POST['trang_thai'];
	}
	if (isset($_POST['id'])) {
		$s_id = $_POST['id'];
	}
	$s_ten_dinh_danh = str_replace('\'', '\\\'', $s_ten_dinh_danh);
	$s_ten_to_chuc = str_replace('\'', '\\\'', $s_ten_to_chuc);
	$s_ma_doanh_nghiep = str_replace('\'', '\\\'', $s_ma_doanh_nghiep);
	$s_loai_to_chuc = str_replace('\'', '\\\'', $s_loai_to_chuc);
	$s_hinh_thuc_su_dung = str_replace('\'', '\\\'', $s_hinh_thuc_su_dung);
	$s_ngay_tao = str_replace('\'', '\\\'', $s_ngay_tao);
	$s_trang_thai  = str_replace('\'', '\\\'', $s_trang_thai);
	$s_id  = str_replace('\'', '\\\'', $s_id);
	

	if ($s_id != '') {
		//update
		$sql = "update tendinhdanh set ten_dinh_danh = '$s_ten_dinh_danh', ten_to_chuc = '$s_ten_to_chuc', ma_doanh_nghiep = '$s_ma_doanh_nghiep', loai_to_chuc = '$s_loai_to_chuc', hinh_thuc_su_dung = '$s_hinh_thuc_su_dung', ngay_tao = '$s_ngay_tao', trang_thai = '$s_trang_thai' where id = " .$s_id;
	} else {
		//insert
		$sql = "insert into tendinhdanh(ten_dinh_danh, ten_to_chuc, ma_doanh_nghiep, loai_to_chuc, hinh_thuc_su_dung, ngay_tao, trang_thai) value ('$s_ten_dinh_danh', '$s_ten_to_chuc', '$s_ma_doanh_nghiep', '$s_loai_to_chuc', '$s_hinh_thuc_su_dung', '$s_ngay_tao', '$s_trang_thai')";
	}

	// echo $sql;

	execute($sql);

	header('Location: index.php');
	die();
}

$id = '';
if (isset($_GET['id'])) {
	$id          = $_GET['id'];
	$sql         = 'select * from tendinhdanh where id = '.$id;
	$ipblacklist = executeResult($sql);
	if ($ipblacklist != null && count($ipblacklist) > 0) {
		$std        = $ipblacklist[0];
		$s_ten_dinh_danh = $std['ten_dinh_danh'];
		$s_ten_to_chuc      = $std['ten_to_chuc'];
		$s_ma_doanh_nghiep  = $std['ma_doanh_nghiep'];
		$s_loai_to_chuc = $std['loai_to_chuc'];
		$s_hinh_thuc_su_dung = $std['hinh_thuc_su_dung'];
		$s_ngay_tao  = $std['ngay_tao'];
		$s_trang_thai  = $std['trang_thai'];
	} else {
		$id = '';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Thêm, Sửa doanh nghiệp</title>
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
				<h2 class="text-center">Thêm hoặc sửa thông tin doanh nghiệp</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
					  <label for="usr">Tên định danh:</label>
					  <input type="text" name="id" value="<?=$id?>" >
					  <input required="true" type="text" class="form-control" id="usr" name="ten_dinh_danh" value="<?=$s_ten_dinh_danh?>">
					</div>
					<div class="form-group">
					  <label for="usr">Tên tổ chức:</label>
					  <input type="text" class="form-control" id="usr" name="ten_to_chuc" value="<?=$s_ten_to_chuc?>">
					</div>
					<div class="form-group">
					  <label for="usr">Mã doanh nghiệp:</label>
					  <input type="text" class="form-control" id="usr" name="ma_doanh_nghiep" value="<?=$s_ma_doanh_nghiep?>">
					</div>
					<div class="form-group">
					  <label for="usr">Loại tổ chức:</label>
					  <input type="text" class="form-control" id="usr" name="loai_to_chuc" value="<?=$s_loai_to_chuc?>">
					</div>
					<div class="form-group">
					  <label for="usr">Hình thức sử dụng:</label>
					  <input type="text" class="form-control" id="usr" name="hinh_thuc_su_dung" value="<?=$s_hinh_thuc_su_dung?>">
					</div>
					<div class="form-group">
					  <label for="usr">Ngày tạo:</label>
					  <input type="text" class="form-control" id="usr" name="ngay_tao" value="<?=$s_ngay_tao?>">
					</div>
					<div class="form-group">
					  <label for="usr">Trạng thái:</label>
					  <input type="text" class="form-control" id="usr" name="trang_thai" value="<?=$s_trang_thai?>">
					</div>
					
					<button class="btn btn-success">Save</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>