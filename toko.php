<?php
session_start();
require 'conn.php';

if(!isset($_SESSION['user'])){
    die("<b>Oops!</b> Access Failed.
        <p>Sistem Logout. Anda harus melakukan Login kembali.</p>
        <button type='button' onclick=location.href='index.php'>Back</button>");
} else {
    $query = "SELECT * FROM user WHERE id_user = ".$_SESSION['user']['id'];
    $result = mysqli_query(connection(),$query);
    $data = mysqli_fetch_array($result);

    if (!isset($data['telepon_user']) || !isset($data['alamat_user']) || !isset($data['foto_user'])) {
        message("Mohon lengkapi profil terlebih dahulu");
        redirect("dashboard.php");
    }
} ?>
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
    <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>

    <title> Toko </title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <h3><i class="fas fa-shopping-cart mr-2"></i></h3>
      <a class="navbar-brand" href="index.php">My Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 ml-auto mr-auto" method="POST">
          <input class="form-control mr-sm-2" type="search" placeholder="nama produk lengkap" aria-label="Search" name="cari">
          <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form>
        <h5 class="pt-2 mr-2"><?php echo $_SESSION['user']['nama']?></h5>
        <img src="assets/img/playstation1.png" alt="" class="" style="width: 40px; height: 40px; border: 1px solid black; border-radius: 50%;">
        <h5><a href="logout.php" class="" data-toggle="tooltip" title="Keluar"><i class="fas fa-sign-out-alt mt-2 ml-2 text-dark"></i></a></h5>
      </div>
    </nav>

    <div class="row no-gutters mt-5">
      <div class="col-md-2 bg-light mt-2 pr-3 pt-3">
        <ul class="nav flex-column ml-3 mb-3">
          <li class="nav-item">
            <a class="nav-link active text-dark" href="dashboard.php"><i class="fas fa-user mr-2"></i> Profil</a><hr>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-dark" href="dvoucher.php"><i class="fas fa-ticket-alt"></i> Voucher</a><hr>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="toko.php"><i class="fas fa-store mr-2"></i> Toko</a><hr>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="penjualan.php"><i class="fas fa-store mr-2"></i> Penjualan</a>
          </li>
        </ul>
      </div>
      <div class="col-md-10 p-5 pt-2">
        <h3><i class="fas fa-store mr-2"></i> Toko </h3>
        <hr>
        <div class="row mt-2 mb-2">
          <h4 class="mr-auto ml-auto"><i class="fas fa-box-open"></i> Produk Yang Dijual</h4>
        </div>
        <div class="row">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Harga</th>
                <th scope="col">Kuantitas</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
            	<?php
               if ($_SERVER['REQUEST_METHOD']=== 'POST')  {
                    $search=$_POST['cari'];
                    $query="SELECT * FROM produk WHERE nama_produk='$search'";
                    $result = mysqli_query(connection(),$query);
                }else{
	                  $query="SELECT * FROM produk WHERE penjual= ".$_SESSION['user']['id'];
	                  $result=mysqli_query(connection(),$query);

               }
                  $no=1;
                ?>
              <?php while ($data= mysqli_fetch_array($result)): ?>

              <tr>
                <td><?php echo $no++;?></td>
                <td><img src="assets/img/produk/<?= $data['gambar'] ?>" style="width:60px; height:60px" alt=""></td>
                <td><?php echo $data['nama_produk']?></td>
                 <td>
                      <?php

                          if ($data['id_kategori'] == '1'){
                            echo "Game";
                          }
                          elseif($data['id_kategori']== '2'){
                            echo "Console Game";
                          }
                          elseif($data['id_kategori']== '3'){
                            echo "Aksesoris Game";
                          }

                      ?>

                    </td>
                <td><?php echo $data['deskripsi']?></td>
                <td>Rp. <?= number_format($data['harga']) ?>,00</td>
                <td><?php echo $data['stok']?></td>
                <td><button id="edit" type="button" class="btn btn-warning" name="button" data-toggle="modal" data-target="#editBarang"  data-id_produk="<?= $data['id_produk'];?>" data-id_kategori="<?= $data['id_kategori'];?>"  data-nama_produk="<?= $data['nama_produk'];?>" data-deskripsi="<?= $data['deskripsi'];?>" data-harga="<?= $data['harga'];?>" data-stok="<?= $data['stok'];?>"data-gambar="<?= $data['gambar'];?>">Edit</button> <button id="hapus" type="button" class="btn btn-danger" name="button" data-toggle="modal" data-target="#hapusBarang" data-id_produk="<?= $data['id_produk'];?>">Hapus</button></td>
              </tr>
              <?php endwhile?>
            </tbody>
          </table>
          <button type="button" class="btn btn-dark" name="button" data-toggle="modal" data-target="#tambahBarang">Tambah Barang</button>
          <div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="tambahBarangLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="tambahBarangLabel">Tambah Barang</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="insertproduk.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="nama">Nama Produk</label>
                      <input type="text" class="form-control" id="nama" name="nama_produk">
                    </div>
                    <div class="form-group">
                      <label for="tipe">Tipe Produk</label>
                      <select id="tipe" class="form-control" name="id_kategori">
                        <option value="2">Console</option>
                        <option value="1">Game</option>
                        <option value="3">Aksesoris</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="harga">Harga</label>
                      <input type="text" class="form-control" id="harga" name="harga">
                    </div>
                    <div class="form-group">
                      <label for="kuantitas">Kuantitas</label>
                      <input type="text" id="kuantitas" name="stok" class="form-control" value="">
                    </div>
                    <div class="form-group">
                      <label for="peskripsi">Deskripsi</label>
                      <input type="text" id="deskripsi" name="deskripsi" class="form-control" value="">
                    </div>
                    <div class="form-group">
                      <label for="inputGambar<?= $_SESSION['user']['id'] ?>">Gambar</label>
                      <div class="mb-3">
                        <div class="input-group mb-3">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGambar<?= $_SESSION['user']['id'] ?>" name="gambar" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGambar<?= $_SESSION['user']['id'] ?>">Gambar</label>
                            <script>
                              $('#inputGambar<?= $_SESSION['user']['id'] ?>').on('change',function(){
                                var upload = document.getElementById('inputGambar<?= $_SESSION['user']['id'] ?>').files;
                                if (upload[0].size > 2000000) {
                                  alert('File Melebihi 2MB');
                                }
                                else {
                                  //get the file name
                                  var fileName = $(this).val();
                                  var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
                                  //replace the "Choose a file" label
                                  $(this).next('.custom-file-label').html(cleanFileName);
                                }
                              })
                            </script>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" name="insertdata">Tambah</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="editBarang" tabindex="-1" aria-labelledby="editBarangLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editBarangLabel">Edit Barang</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" id="modalupdate">
                  <form action="updateproduk.php" method="POST" enctype="multipart/form-data">
                  	<input type="hidden" name="id_produk" id="id_produk">
                    <div class="form-group">
                      <label for="nama">Nama Produk</label>
                      <input type="text" class="form-control" id="nama" name="nama_produk" placeholder="Playstation 4">
                    </div>
                    <div class="form-group">
                      <label for="tipe">Tipe Produk</label>
                      <select id="tipe" class="form-control" name="id_kategori">
                        <option value="2" selected>Console</option>
                        <option value="1">Game</option>
                        <option value="3">Aksesoris</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="harga">Harga</label>
                      <input type="text" class="form-control" id="harga" name="harga" placeholder="Rp. 4.000.000,00">
                    </div>
                    <div class="form-group">
                      <label for="kuantitas">Kuantitas</label>
                      <input type="text" id="kuantitas" name="stok" class="form-control" value="" placeholder="1">
                    </div>
                    <div class="form-group">
                      <label for="peskripsi">Deskripsi</label>
                      <input type="text" id="deskripsi" name="deskripsi" class="form-control" value="">
                    </div>
                    <div class="form-group">
                      <label for="gambar">Gambar</label>
                      <input type="file" id="gambar" name="gambar" class="form-control" value="" placeholder="produk1.png">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" name="update">Edit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
           <div class="modal fade" id="hapusBarang" tabindex="-1" aria-labelledby="hapusBarangLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="hapusBarangLabel">Hapus Prodak</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="deleteproduk.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="hidden" name="id_produk" id="id_produk">
                      <h4>Ingin menghapus produk?</h4>
                    </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                  <button type="submit" class="btn btn-success" name="deletedata">Ya</button>
              </form>
               </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>


<script>
      $(document).on("click","#edit", function(){
        let id_produk=$(this).data('id_produk');
        let nama_produk=$(this).data('nama_produk');
        let deskripsi=$(this).data('deskripsi');
        let id_kategori=$(this).data('id_kategori');
        let harga=$(this).data('harga');
        let stok=$(this).data('stok');
        let gambar=$(this).data('gambar');

        $("#modalupdate #id_produk").val(id_produk);
        $("#modalupdate #nama").val(nama_produk);
        $("#modalupdate #deskripsi").val(deskripsi);
        $("#modalupdate #tipe").val(id_kategori);
        $("#modalupdate #harga").val(harga);
        $("#modalupdate #kuantitas").val(stok);
        $("#modalupdate #gambar").val(gambar);
      });

      $(document).on("click","#hapus", function(){
        let id_produk=$(this).data('id_produk');

        $(".modal-body #id_produk").val(id_produk);
      });
    </script>
  </body>
</html>
