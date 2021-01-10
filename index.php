<?php include_once 'assets/template/header.php'; ?>

    <div class="container-float">
      <div class="row no-gutters">
        <div class="col-md-2 bg-light">
          <ul class="list-group list-group-flush p-2 pt-4">
            <?php
              $query = "SELECT * FROM categories";
              $result = mysqli_query(connection(),$query);
              while ($data = mysqli_fetch_array($result)):
            ?>
            <li class="list-group-item"><?php echo $data['nama'] ?></li>
            <?php endwhile; ?>
          </ul>
        </div>
        <div class="col-md-10">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner banner">
              <div class="carousel-item active">
                <img src="assets/img/banner1.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="assets/img/banner2.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="assets/img/banner3.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          <h4 class="text-center font-weight-bold m-4">VOUCHER GAME</h4>
          <div class="row justify-content-center mx-auto">
            <?php
              $query = "SELECT * FROM voucher";
              $result = mysqli_query(connection(),$query);
              while ($data = mysqli_fetch_array($result)):
            ?>
            <div class="card mr-2 ml-2 mb-2" style="width: 16rem;">
              <a href="<?php echo "voucher.php?jenis=".$data['id_voucher'] ?>"><img src="assets/img/voucher/<?php echo $data['gambar'] ?>" class="card-img-top" alt="<?php echo $data['jenis_voucher'] ?>"></a>
            </div>
            <?php endwhile; ?>
          </div>

          <h4 class="text-center font-weight-bold m-4">PRODUK TERBARU</h4>
          <div class="row justify-content-center mx-auto produk">
            <?php
                $query = "SELECT * FROM produk WHERE stok > 0 ORDER BY id_produk DESC";
                $result = mysqli_query(connection(), $query);
                while ($data = mysqli_fetch_array($result)):
            ?>
            <div class="card mr-2 ml-2 mb-3" style="width: 16rem;">
              <img src="assets/img/produk/<?php echo $data['gambar'] ?>" class="card-img-top gambar-produk-i" alt="...">
              <div class="card-body bg-light">
                <h5 class="card-title">
                    <?php
                        $desc = $data['nama_produk'];
                        $trim = substr($desc,0,38);

                        if (strlen($desc) > 40) {
                            echo $trim."...";
                        } else {
                            echo $desc;
                            if (strlen($desc) < 20) {
                                echo "<br><br>";
                            }
                        }
                    ?>

                </h5>
                <div class="stars">
                    <?php
                        $twos = floor($data['stars'] / 2);
                        $ones = $data['stars'] - ($twos * 2);
                        $zeros = 5 - ($twos + $ones);
                    ?>

                    <?php for ($x = 0; $x < $twos; $x++): ?>
                        <i class="fas fa-star"></i>
                    <?php endfor; ?>

                    <?php for ($x = 0; $x < $ones; $x++): ?>
                        <i class="fas fa-star-half-alt"></i>
                    <?php endfor; ?>

                    <?php for ($x = 0; $x < $zeros; $x++): ?>
                        <i class="far fa-star"></i>
                    <?php endfor; ?>
                </div>
                <p class="font-weight-bold mt-1 mb-2">Rp. <?php echo number_format($data['harga'], 2, ',', '.') ?></p>
                <a href="#" class="btn btn-dark" data-target="#produk<?php echo $data['id_produk'] ?>" data-toggle="modal">Detail</a>
              </div>
            </div>
            <?php endwhile; ?>
          </div>
          <?php
            $query = "SELECT * FROM produk";
            $result = mysqli_query(connection(), $query);
            while ($data = mysqli_fetch_array($result)):
          ?>
          <div class="modal fade produk-m" id="produk<?php echo $data['id_produk'] ?>" tabindex="-1" aria-labelledby="produk<?php echo $data['id_produk'] ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="produk<?php echo $data['id_produk'] ?>Label">Detail Produk</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <img src="assets/img/produk/<?php echo $data['gambar'] ?>" alt="">
                    </div>
                    <div class="col-md-6">
                      <table class="table table-borderless">
                        <tr>
                          <th>Toko</th>
                          <td><?php echo mysqli_fetch_array(mysqli_query(connection(), "SELECT nama_user FROM user WHERE id_user =".$data['penjual']))[0] ?></td>
                        </tr>
                        <tr>
                          <th>Produk</th>
                          <td><?php echo $data['nama_produk'] ?></td>
                        </tr>
                        <tr>
                          <th>Deskripsi</th>
                          <td><?php echo $data['deskripsi'] ?></td>
                        </tr>
                        <tr>
                          <th>Ongkir</th>
                          <td>Standart</td>
                        </tr>
                        <tr>
                          <th>Rating</th>
                          <td>
                            <div class="stars mb-1">
                                <?php
                                    $twos = floor($data['stars'] / 2);
                                    $ones = $data['stars'] - ($twos * 2);
                                    $zeros = 5 - ($twos + $ones);
                                ?>

                                <?php for ($x = 0; $x < $twos; $x++): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>

                                <?php for ($x = 0; $x < $ones; $x++): ?>
                                    <i class="fas fa-star-half-alt"></i>
                                <?php endfor; ?>

                                <?php for ($x = 0; $x < $zeros; $x++): ?>
                                    <i class="far fa-star"></i>
                                <?php endfor; ?>
                          </div>
                        </td>
                        </tr>
                        <tr>
                          <th>Stok</th>
                          <td><?php echo $data['stok']; echo ($data['stok'] > 1) ? " pcs" : " pc" ?></td>
                        </tr>
                        <tr>
                          <th>Harga</th>
                          <td>Rp. <?php echo number_format($data['harga'], 2, ',', '.') ?></td>
                        </tr>
                        <tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                  <?php if (isset($_SESSION['cart']['cart_'.$data['id_produk']])): ?>
                      <?php if ($_SESSION['cart']['cart_'.$data['id_produk']] < $data['stok']): ?>
                          <button type="button" id="AC-<?= $data['id_produk'] ?>" class="btn btn-success" data-dismiss="modal" onclick="addCarts(<?= $_SESSION['cart']['cart_'.$data['id_produk']] ?>, <?= $data['stok'] ?>, <?= $data['id_produk'] ?>)">+ Keranjang</button>
                      <?php else: ?>
                          <button type="button" id="AC-<?= $data['id_produk'] ?>" class="btn btn-success" data-dismiss="modal" onclick="addCarts(<?= $_SESSION['cart']['cart_'.$data['id_produk']] ?>, <?= $data['stok'] ?>, <?= $data['id_produk'] ?>)" disabled>+ Keranjang</button>
                      <?php endif; ?>
                  <?php else: ?>
                      <button type="button" id="AC-<?= $data['id_produk'] ?>" class="btn btn-success" data-dismiss="modal" onclick="addCarts(0, <?= $data['stok'] ?>, <?= $data['id_produk'] ?>)">+ Keranjang</button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <?php endwhile; ?>

        </div>
      </div>
    </div>

    <script type="text/javascript">
        function addCarts(cart, stok, id){
            <?php if (isset($_SESSION['user'])): ?>
                $.ajax({
                    type: "POST",
                    url: "dataCart.php",
                    data: "action=tambah&id=" + id,
                    success: function(data){
                        if (data == "sama") {
                            alert("Tidak bisa membeli barang sendiri");
                        } else {
                            alert("Berhasil ditambahkan");
                            viewCart();
                            $("#AC-"+id).attr('onclick', "addCarts(" + (++cart) + ", " + stok + ", " + id + ")");
                            if (cart == stok) {
                                $("#AC-"+id).prop('disabled', true);
                            }
                        }
                    }
                })
            <?php else: ?>
                alert('Mohon login terlebih dahulu');
            <?php endif; ?>
        }
    </script>

<?php include_once 'assets/template/footer.php'; ?>
