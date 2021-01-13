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

    <title>Halaman Admin</title>
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
    <button type="button" onclick="location.href='replace_banner_form.html'" class=" btn btn-dark">Ganti Banner</button>

    <table class="table">
        <br></br>
        <h3>Voucher</h3>
        <button type="button" onclick="location.href='insertvoucher.html'" class=" btn btn-dark">Tambah
            Voucher</button>
        <br></br>
        <thead class="thead-dark">
            <tr>
                <th scope="col">id Voucher</th>
                <th scope="col">Jenis Voucher</th>
                <th scope="col">Gambar</th>
                <th scope="col">Update/Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>

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
                        href="http://localhost/benaya/FP-PemrogramanWeb-master/FP-PemrogramanWeb-master/updatevoucher_form.php?id=<?php echo $data['id_voucher']?>">Update</a>
                    <a href="http://localhost/benaya/FP-PemrogramanWeb-master/FP-PemrogramanWeb-master/deletevoucher_admin.php?id=<?php echo $data['id_voucher']?>"
                        onclick="return confirm('Hapus Data <?php echo $data['id_voucher']?>')" ;>Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
            </tr>
            </tr>
        </tbody>

    </table>

    <table class="table">
        <h3>Produk</h3>
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id Produk</th>
                <th scope="col">Id Kategori</th>
                <th scope="col">Penjual</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok </th>
                <th scope="col">Gambar</th>
                <th scope="col">Update/Delete</th>

            </tr>
        </thead>
        <tbody>
            <tr>

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
                <td><?php echo $data['deskripsi'] ?></td>
                <td><?php echo $data['harga'] ?></td>
                <td><?php echo $data['stok'] ?></td>
                <td><?php echo $data['gambar'] ?></td>
                <td>
                    <a href="http://localhost/benaya/FP-PemrogramanWeb-master/FP-PemrogramanWeb-master/deleteproduk_admin.php?id=<?php echo $data['id_produk']?>"
                        onclick="return confirm('Hapus Data <?php echo $data['id_produk']?>')" ;>Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>




    <table class="table">
        <br></br>
        <h3>User</h3>
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id User</th>
                <th scope="col">Nama User</th>
                <th scope="col">Email User</th>
                <th scope="col">Password User</th>
                <th scope="col">Telepon User</th>
                <th scope="col">Alamat User</th>
                <th scope="col">Foto_User</th>
                <th scope="col">Update/Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
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


                    <a href="http://localhost/benaya/FP-PemrogramanWeb-master/FP-PemrogramanWeb-master/deleteuser_admin.php?id=<?php echo $data['id_user']?>"
                        onclick="return confirm('Hapus Data <?php echo $data['id_user']?>')" ;>Delete</a>

                </td>
            </tr>
            <?php endwhile; ?>
            <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
            <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
            <script type="text/javascript" src="assets/js/script.js"></script>
            </tr>
            </tr>

        </tbody>
    </table>


</body>

</html>