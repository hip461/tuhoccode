<?php
require_once ('../connect/dbhelp.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Quản lý thông tin người dùng</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/f2ca551897.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="./css/style.css">
</head>
<?php
if(!isset($_SESSION['username'])){
	header('Location:index.php');
} else {
if(isset($_SESSION['username'])&&($_SESSION['username']!="admin")){
	echo '<script type = "text/javascript">';
	echo 'alert("sai thông tin đăng nhập admin");';
	echo 'window.location.href = "logout.php "';
	echo '</script>';
}
}

?>
<body>
	<div class="container-fluid">
		<div class="ontop">
			<ul id="intop">
                <li><a href="./trangchu.php" >Quản lý định danh</a></li>
                <li><a href="./manauser.php" >Quản lý tài khoản</a></li>
					<a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Đăng xuất</a>
			</ul>
		</div>
		<div class="panel panel-primary" style="padding-top:50px;">
			<div class="text-center">
				<a href="index.php"><img style = " object-fit: none;" src="../img/logo.jpg" alt=" Logo vncert"/></a>
				<h1>Quản lý thông tin người dùng</h1>
				<h3> Xin chào người dùng: <p style = "display: inline; color: red; text-align: center;"><?php echo $_SESSION['username'];?></p></h3> 
				
				<form method="get">
					<input type="search" name="tim_kiem" class="form-control" style="margin-top: 15px; margin-bottom: 15px;" placeholder="Tìm kiếm">
				</form>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Stt</th>
							<th>Họ và tên quản lý</th>
							<th>Chức danh</th>
							<th>Gmail</th>
							<th>Tài khoản đăng nhập</th>
							<th width="30px"></th>
							<th width="30px"></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
						$trang = 1;
						if (isset($_GET['trang'])) {
							$trang = $_GET['trang'];
						}

						$tim_kiem = '';
						if (isset($_GET['tim_kiem'])){
							$tim_kiem = $_GET['tim_kiem'];
						}

						$sql_so_dong = "select count(*) from member ";
						$mang_so_dong = mysqli_query($conn, $sql_so_dong);
						$ket_qua_so_dong = mysqli_fetch_array($mang_so_dong);
						$so_dong = $ket_qua_so_dong["count(*)"];
						$so_dong_tren_trang = 10;
						$so_trang = ceil($so_dong / $so_dong_tren_trang);
						$bo_qua = $so_dong_tren_trang * ($trang - 1);
						$sql = "select * from member where username like '%$tim_kiem%' limit $so_dong_tren_trang offset $bo_qua";

						$ipblacklist = executeResult($sql);

						$index = 1;
						foreach ($ipblacklist as $std) {
							echo '<tr>
									<td>'.($index++).'</td>
									<td>'.$std['fullname'].'</td>
									<td>'.$std['position'].'</td>
									<td>'.$std['email'].'</td>
									<td>'.$std['username'].'</td>
									<td><button class="btn btn-warning" onclick=\'window.open("inputuser.php?id='.$std['id'].'","_self")\'>Edit</button></td>
									<td><button class="btn btn-danger" onclick="deleteuser('.$std['id'].')">Delete</button></td>		</tr>';
						}
					?>
					</tbody>
				</table>
					<button class="btn btn-success" onclick="window.open('addedit_user.php', '_self')">Thêm người dùng</button>

			</div>
								<div class="pagination" style="width=100%; text-align: center; justify-content: center">
									<?php	
										if($trang>=2)
										echo '<a href="?trang=1"‘  style="margin: 7px 5px 0px 5px;"><i class="fa-sharp fa-solid fa-backward"></i></a>';
									?>
									<?php	
										if($trang>=2)
										echo '<a href="?trang='.($trang-1).'"‘ style="color: red; text-align: center;margin: 5px 5px 0px 5px;"> Prev </a>';
									?>

									<?php for ($i = 1; $i <= 5; $i++) { ?>
										<a href="?trang=<?php echo $i ?>" class="page-js" style=" display: block;
											text-align: center;
											line-height: 30px;
											text-decoration: none;
											font-size: 15PX;
											color: #939393;
											min-width: 50px;
											height: 35px;
											border-style:solid;
											margin: 0px 5px 5px 5px;
											border-radius: 2px;">
											<?php echo $i ?>
										</a>

									<?php } ?>

									<!-- đoạn input -->
									<?php	
										if($trang<$so_trang)
										echo '<input type="number" style="width:100px; height:35px; margin:0px 0px 5px 5px;border-color: red;border-style:double;" class="input-pagenumber"‘></input>';
										echo 'of '.($so_trang).'';
									?>
									
									<?php	
										if($trang<$so_trang)
										echo '<a href="?trang='.($trang+1).'" ""‘ style="color: red; text-align: center;margin: 5px 5px 0px 5px;"> Next </a>';
									?>
									<?php	
										if($trang<$so_trang)
										echo '<a href="?trang='.($so_trang).'" ""‘ style="margin: 7px 5px 0px 5px;"><i class="fa-sharp fa-solid fa-forward"></i></a>';
									?>
		</div>
	</div>
	<script type="text/javascript">
		function deleteuser(id) {
			option = confirm('Bạn có muốn xoá người dùng này không')
			if(!option) {
				return;
			}

			console.log(id)
			$.post('delete_user.php', {
				'id': id
			}, function(data) {
				alert(data)
				location.reload()
			})
		}
		const inputPageNumEl = document.querySelector(".input-pagenumber")
		var pageNumber = 1;
		pageNumber = window.location.href.split("=")[1]
		inputPageNumEl.value = pageNumber
		console.log(pageNumber) 
		console.log(window.location.href)
		// chuyen trang
		inputPageNumEl.addEventListener('keypress', (e) => {
		
			// enter to go page
			if(e.code === "Enter")
			{
			console.log("enter")
				window.location.href = `manauser.php?trang=${inputPageNumEl.value}`
			}
		})

	</script>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>