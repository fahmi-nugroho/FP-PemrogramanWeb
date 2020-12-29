<?php
session_start();
require 'conn.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/all.min.css">

    <title>Hello, world!</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <h3><i class="fas fa-shopping-cart mr-2"></i></h3>
        <a class="navbar-brand" href="index.php">My Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline ml-auto my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
            </form>
            <h5><i class="fas fa-shopping-cart mt-2 mr-4 ml-3" data-toggle="tooltip" title="Keranjang Belanja"></i></h5>
            <h5><i class="fas fa-grip-lines-vertical mt-2 mr-4"></i></h5>
            <button class="btn btn-outline-dark mr-3" type="button">Masuk</button>
            <button class="btn btn-dark" type="button">Daftar</button>
        </div>
    </nav>
    <tbody>
        <?php
            $view = "SELECT * FROM produk";
            $res = mysqli_query(connection(),$view);
            ?>

        <?php while($data = mysqli_fetch_array($res)) : ?>
        <tr>
            <td><?php echo $data['id_produk'] ?></td>
            <td><?php echo $data['id_kategori'] ?></td>
            <td><?php echo $data['penjual'] ?></td>
            <td><?php echo $data['nama_produk'] ?></td>
            <td><?php echo $data['harga'] ?></td>
            <td><?php echo $data['stok'] ?></td>
            <td>
                <a href="http://localhost/benaya/barokah/updateproduk.php?id=<?php echo $data['id_produk']?>">Update</a>
                <a href="http://localhost/benaya/barokah/deleteproduk.php?id=<?php echo $data['id_produk']?>"
                    onclick="return confirm('Hapus Data <?php echo $data['nama']?>')" ;>Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>


        <?php
            $view = "SELECT * FROM voucher";
            $res = mysqli_query(connection(),$view);
            ?>

        <?php while($data = mysqli_fetch_array($res)) : ?>
        <tr>
            <td><?php echo $data['id_voucher'] ?></td>
            <td><?php echo $data['jenis_voucher'] ?></td>
            <td><?php echo $data['gambar'] ?></td>

            <td>
                <a
                    href="http://localhost/benaya/barokah/updateproduk.php?id=<?php echo $data['id_voucher']?>">Update</a>
                <a href="http://localhost/benaya/barokah/deleteproduk.php?id=<?php echo $data['id_voucher']?>"
                    onclick="return confirm('Hapus Data <?php echo $data['nama']?>')" ;>Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>


        <?php
            $view = "SELECT * FROM user";
            $res = mysqli_query(connection(),$view);
            ?>

        <?php while($data = mysqli_fetch_array($res)) : ?>
        <tr>
            <td><?php echo $data['id_user'] ?></td>
            <td><?php echo $data['nama_user'] ?></td>
            <td><?php echo $data['email_user'] ?></td>
            <td><?php echo $data['pass_user'] ?></td>
            <td><?php echo $data['telepon_user'] ?></td>
            <td><?php echo $data['alamat_user'] ?></td>
            <td><?php echo $data['foto_user'] ?></td>
            <td>
                <a href="http://localhost/benaya/barokah/updateproduk.php?id=<?php echo $data['id_produk']?>">Update</a>
                <a href="http://localhost/benaya/barokah/deleteproduk.php?id=<?php echo $data['id_produk']?>"
                    onclick="return confirm('Hapus Data <?php echo $data['nama']?>')" ;>Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>

        <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="assets/js/script.js"></script>

</body>

</html>