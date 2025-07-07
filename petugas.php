<?php 


	@ob_start();
	session_start();

	if(!empty($_SESSION['petugas'])){
		require 'config.php';
		include $view;
		$lihat = new view($config);
		$toko = $lihat -> toko();
		//  petugas
			include 'petugas/template/header.php';
			include 'petugas/template/sidebar.php';
				if(!empty($_GET['page'])){
					include 'petugas/module/'.$_GET['page'].'/index.php';
				}else{
					include 'petugas/template/home.php';
				}
				include 'admin/template/footer.php';
		// end admin
	}else{
		echo '<script>window.location="login.php";</script>';
		exit;
	}
?>

