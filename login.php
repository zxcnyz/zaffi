<?php
    @ob_start();
    session_start();
    if(isset($_POST['proses'])){
        require 'config.php';
            
        $user = strip_tags($_POST['user']);
        $pass = strip_tags($_POST['pass']);

        $sql = 'SELECT member.*, login.user, login.pass, login.role
                FROM member INNER JOIN login ON member.id_member = login.id_member
                WHERE user = ? AND pass = MD5(?)';
        $row = $config->prepare($sql);
        $row->execute(array($user, $pass));
        $jum = $row->rowCount();
        if($jum > 0){
            $hasil = $row->fetch();
            // Cek peran pengguna setelah login berhasil
            if($hasil['role'] == 'admin') {
                $_SESSION['user'] = $hasil['user']; // Set session 'user' sesuai dengan 'user' yang login
                $_SESSION['admin'] = $hasil;
                header("Location: index.php"); // Redirect ke halaman admin
                exit();
            } elseif($hasil['role'] == 'petugas') {
                $_SESSION['user'] = $hasil['user']; // Set session 'user' sesuai dengan 'user' yang login
                $_SESSION['petugas'] = $hasil;
                header("Location: petugas.php"); // Redirect ke halaman petugas
                exit();
            } else {
                // Jika peran tidak diketahui, arahkan ke halaman default
                echo '<script>alert("Peran pengguna tidak valid");window.location="login.php"</script>';
                exit();
            }
        } else {
            echo '<script>alert("Login Gagal");history.go(-1);</script>';
            exit();
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login - MamayoKasir</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
						<div class="p-5">
							<div class="text-center">
								<h4 class="h4 text-gray-900 mb-4"><b>MamayoKasir</b></h4>
							</div>
							<form class="form-login" method="POST">
								<div class="form-group">
									<input type="text" class="form-control form-control-user" name="user"
										placeholder="Username" autofocus>
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-user" name="pass"
										placeholder="Password">
								</div>
								<button class="btn btn-primary btn-block" name="proses" type="submit"><i
										class="fa fa-lock"></i>
									LOGIN</button>
							</form>
							<hr>
							<div class="text-center">
								<a class="small" href="register.php">Create an Account!</a>
							</div>
							<!-- <div class="text-center">
								<a class="small" href="loginpetugas.php">Login as Petugas</a>
							</div> -->
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="sb-admin/vendor/jquery/jquery.min.js"></script>
    <script src="sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="sb-admin/js/sb-admin-2.min.js"></script>
</body>
</html>