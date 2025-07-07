




<?php
include 'config.php';

if (isset($_POST['regis'])) {
    // Mengambil nilai dari form
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Mengenkripsi password menggunakan MD5
    $idMember = $_POST['idMember'];
    $role = $_POST['role']; // Secara manual menetapkan role menjadi 'admin'

    // Query untuk menyimpan data ke dalam tabel login
    $sql = "INSERT INTO login (user, pass, id_member, role) VALUES ('$username', '$password', '$idMember', '$role')";

    // Menjalankan query dan memeriksa apakah data berhasil disimpan
    if ($config->query($sql)) {
        // Menggunakan SweetAlert untuk menampilkan notifikasi registrasi berhasil
        echo "<script>
                window.onload = function() {
                    swal({
                        title: 'Registration Successful',
                        text: 'You have successfully registered!',
                        icon: 'success',
                        button: 'OK'
                    }).then(function() {
                        window.location = 'login.php'; // Redirect ke halaman login setelah menekan tombol OK
                    });
                }
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $config->errorInfo();
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

    <title>MamayoKasir - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

<!-- SweetAlert JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div><img src="admin/template/img/regis.jpg" alt="regis"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputusername"
                                    name="username" placeholder="Enter Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="exampleInputpassword"
                                    name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" id="exampleInputnumber"
                                    name="idMember" placeholder="Enter Member ID">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputrole"
                                    name="role" value="admin" readonly="readonly">
                                </div>
                                <button class="btn btn-primary btn-user btn-block" name="regis" type="submit">
                                    Register Account
                                </button>
                                <hr>
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
