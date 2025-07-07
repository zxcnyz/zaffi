<?php 
	@ob_start();
	session_start();
	if(!empty($_SESSION['admin'])){ }else{
		echo '<script>window.location="login.php";</script>';
        exit;
	}
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	$hsl = $lihat -> penjualan();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            padding-top: 50px;
        }
        .receipt-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .receipt-header h1 {
            color: #333;
            font-size: 24px;
        }
        .receipt-info {
            margin-bottom: 20px;
        }
        .receipt-info p {
            margin: 5px 0;
        }
        .receipt-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .receipt-table th, .receipt-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .receipt-total {
            margin-top: 20px;
            font-weight: bold;
        }
        .receipt-footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="receipt-container">
            <div class="receipt-header">
                <h1><?php echo $toko['nama_toko'];?></h1>
                <p><?php echo $toko['alamat_toko'];?></p>
            </div>
            <div class="receipt-info">
                <p>Tanggal: <?php echo date("j F Y, G:i");?></p>
                <p>Kasir: <?php echo htmlentities($_GET['nm_member']);?></p>
            </div>
            <table class="receipt-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($hsl as $isi){?>
                    <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $isi['nama_barang'];?></td>
                        <td><?php echo $isi['jumlah'];?></td>
                        <td><?php echo $isi['total'];?></td>
                    </tr>
                    <?php $no++; }?>
                </tbody>
            </table>
            <div class="receipt-total">
                <?php $hasil = $lihat -> jumlah(); ?>
                <p>Total : Rp.<?php echo number_format($hasil['bayar']);?>,-</p>
                <p>Bayar : Rp.<?php echo number_format(htmlentities($_GET['bayar']));?>,-</p>
                <p>Kembali : Rp.<?php echo number_format(htmlentities($_GET['kembali']));?>,-</p>
            </div>
            <div class="receipt-footer">
                <p>Terima Kasih Telah berbelanja di MamayoKasir,!</p>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
