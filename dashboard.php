<?php
  require 'conn.php';
  session_start();

  if (!isset($_SESSION['user'])) {
      message('Mohon login terlebih dahulu');
      redirect('index.php');
  }

  if (isset($_POST['password'])) {
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $query = "UPDATE user SET pass_user='$pass' WHERE id_user = ".$_SESSION['user']['id'];
    $result = mysqli_query(connection(), $query);
    if ($result) {
      message('Password Berhasil Diubah');
    }
    else {
      message('Password Gagal Diubah');
    }
    redirect('dashboard.php');
  }

  if (isset($_POST['nama'])) {
    $nama = $_POST['nama'];
    $nomor = $_POST['nomorKontak'];

    $error = $_FILES['gambar']['error'];

    if ($error === 4) {
      $gambar = $data['foto_user'];
    }
    else {
      $nama_file = $_FILES['gambar']['name'];
      $tmpName = $_FILES['gambar']['tmp_name'];

      $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
      $ekstensiGambar = explode('.', $nama_file);
      $ekstensiGambar = strtolower(end($ekstensiGambar));

      if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        message('Yang Anda Upload Bukan Gambar!');
        redirect('dashboard.php');
      }

      $namaFileBaru = uniqid();
      $namaFileBaru .= '.';
      $namaFileBaru .= $ekstensiGambar;

      move_uploaded_file($tmpName, 'assets/img/'.$namaFileBaru);
      $gambar = $namaFileBaru;
    }

    $query = "UPDATE user SET nama_user='$nama', telepon_user='$nomor', foto_user='$gambar' WHERE id_user = ".$_SESSION['user']['id'];
    $result = mysqli_query(connection(), $query);
    if ($result) {
      message('Profil Berhasil Diubah');
    }
    else {
      message('Profil Gagal Diubah');
    }
    redirect('dashboard.php');
  }

  $query = "SELECT * FROM user WHERE id_user = ".$_SESSION['user']['id'];
  $result = mysqli_query(connection(), $query);
  $data = mysqli_fetch_array($result);
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <h3><i class="fas fa-shopping-cart mr-2"></i></h3>
      <a class="navbar-brand" href="index.php">My Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 ml-auto mr-auto">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form>
        <h5 class="pt-2 mr-2"><?php echo $data['nama_user'] ?></h5>
        <?php
        if (strlen($data['foto_user']) === 0) {
          echo "<img src='assets/img/playstation1.png' style='width: 40px; height: 40px; border: 1px solid black; border-radius: 50%;'>";
        }
        else {
          echo "<img src='assets/img/".$data['foto_user']."' style='width: 40px; height: 40px; border: 1px solid black; border-radius: 50%;'>";
        }
        ?>
        <h5><a href="" class="" data-toggle="tooltip" title="Keluar" onclick="logout()"><i class="fas fa-sign-out-alt mt-2 ml-2 text-dark"></i></a></h5>
      </div>
    </nav>

    <div class="row no-gutters mt-5">
      <div class="col-md-2 bg-light mt-2 pr-3 pt-3">
        <ul class="nav flex-column ml-3 mb-3">
          <li class="nav-item">
            <a class="nav-link active text-dark" href="dashboard.html"><i class="fas fa-user mr-2"></i> Profil</a><hr>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="toko.php"><i class="fas fa-store mr-2"></i> Toko</a>
          </li>
        </ul>
      </div>
      <div class="col-md-10 p-5 pt-2">
        <h3><i class="fas fa-user mr-2"></i> Profil</h3>
        <hr>
        <div class="row align-items-center">
          <div class="col-4">
            <div class="card bg-dark ml-auto mr-auto text-white" style="width: 20rem;">
              <?php
              if (strlen($data['foto_user']) === 0) {
                echo "<img src='assets/img/playstation1.png' style='width: 100px; height: 100px; border: 1px solid white; border-radius: 50%;' class='card-img-top mr-auto ml-auto mt-2'>";
              }
              else {
                echo "<img src='assets/img/".$data['foto_user']."' style='width: 100px; height: 100px; border: 1px solid white; border-radius: 50%;' class='card-img-top mr-auto ml-auto mt-2'>";
              }
              ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo $data['nama_user'] ?></h5>
                <p class="card-text"><?php echo $data['email_user'] ?></p>
                <div class="row mt-3">
                  <a href="#" class="btn btn-light mr-auto ml-auto" data-toggle="modal" data-target="#gantiSandi">Ganti Sandi</a>
                  <a href="#" class="btn btn-light mr-auto ml-auto" data-toggle="modal" data-target="#gantiProfil">Ganti Profil</a>
                </div>
              </div>
            </div>
            <div class="modal fade" id="gantiSandi" tabindex="-1" aria-labelledby="gantiSandiLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="gantiSandiLabel">Ganti Sandi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="dashboard.php">
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                      </div>
                      <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword">
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnPassword" class="btn btn-primary">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="gantiProfil" tabindex="-1" aria-labelledby="gantiProfilLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="gantiProfilLabel">Ganti Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama_user'] ?>">
                      </div>
                      <div class="form-group">
                        <label for="nomorKontak">Nomor Kontak</label>
                        <input type="text" class="form-control" name="kontak" id="nomorKontak" value="<?php echo $data['telepon_user'] ?>">
                      </div>
                      <div class="form-group">
                        <div class="mb-3">
                          <div class="input-group mb-3">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="inputGambar" name="gambar" aria-describedby="inputGroupFileAddon01">
                              <label class="custom-file-label" for="inputGambar">Foto Profil</label>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-8">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Saldo My Shop</th>
                  <th scope="col">Saldo My Shop Point</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo "Rp. ".number_format($data['wallet'], 2, ',', '.') ?></td>
                  <td>0</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row mt-2 mb-2">
          <h4 class="mr-auto ml-auto"><i class="fas fa-history"></i> Riwayat</h4>
        </div>
        <div class="row">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Toko</th>
                <th scope="col">Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Kuantitas</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>G-Shop</td>
                <td><img src="assets/img/produk1.png" style="width:60px; height:60px" alt=""></td>
                <td>Playstation 4</td>
                <td>Rp. 4.000.000,00</td>
                <td>1</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>

  </body>
</html>

<script type="text/javascript">
  $(function () {
    $("#btnPassword").click(function () {
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();
        if (password != confirmPassword) {
            alert("Password Tidak Sama");
            return false;
        }
        return true;
    });
  });
  function logout(){
    <?php
      unset($_SESSION['cart']);
      unset($_SESSION['user']);
      redirect('dashboard.php');
    ?>
  }
</script>
