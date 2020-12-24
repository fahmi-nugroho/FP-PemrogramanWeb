<?php include_once 'assets/template/header.php'; ?>

    <div class="container-float">
      <div class="row no-gutters">
        <div class="col-md-2 bg-light">
          <ul class="list-group list-group-flush p-2 pt-4">
            <?php
              $query = "SELECT * FROM categories";
              $result = mysqli_query(connection(),$query);
              while($data = mysqli_fetch_array($result)):
            ?>
            <li class="list-group-item"><?php echo $data['nama'] ?></li>
            <?php endwhile; ?>
          </ul>
        </div>
        <div class="col-md-10">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
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
              while($data = mysqli_fetch_array($result)):
            ?>
            <div class="card mr-2 ml-2 mb-2" style="width: 16rem;">
              <img src="assets/img/<?php echo $data['gambar'] ?>" class="card-img-top" alt="<?php echo $data['jenis_voucher'] ?>">
            </div>
            <?php endwhile; ?>
          </div>

          <h4 class="text-center font-weight-bold m-4">PRODUK TERBARU</h4>
          <div class="row justify-content-center mx-auto">
            <?php
              $query = "SELECT * FROM produk ORDER BY id_produk DESC";
              $result = mysqli_query(connection(),$query);
              while($data = mysqli_fetch_array($result)):
            ?>
            <div class="card mr-2 ml-2 mb-2" style="width: 16rem;">
              <img src="assets/img/<?php echo $data['gambar'] ?>" class="card-img-top" alt="...">
              <div class="card-body bg-light">
                <h5 class="card-title"><?php echo $data['nama_produk'] ?></h5>
                <p class="card-text"><?php echo $data['deskripsi'] ?></p>
                <div class="stars mb-1">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                  <i class="far fa-star"></i>
                </div>
                <p class="font-weight-bold">Rp. <?php echo number_format($data['harga']) ?>,00</p>
                <a href="#" class="btn btn-dark" data-target="#produk<?php echo $data['id_produk'] ?>" data-toggle="modal">Detail</a>
              </div>
            </div>
            <?php endwhile; ?>
          </div>
          <?php
            $query = "SELECT * FROM produk";
            $result = mysqli_query(connection(),$query);
            while($data = mysqli_fetch_array($result)):
          ?>
          <div class="modal fade" id="produk<?php echo $data['id_produk'] ?>" tabindex="-1" aria-labelledby="produk<?php echo $data['id_produk'] ?>Label" aria-hidden="true">
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
                      <img src="assets/img/<?php echo $data['gambar'] ?>" alt="">
                    </div>
                    <div class="col-md-6">
                      <table class="table table-borderless">
                        <tr>
                          <th>Nama Toko</th>
                          <td><?php echo $data['penjual'] ?></td>
                        </tr>
                        <tr>
                          <th>Nama Produk</th>
                          <td><?php echo $data['nama_produk'] ?></td>
                        </tr>
                        <tr>
                          <th>Biaya Ongkir</th>
                          <td>Standart</td>
                        </tr>
                        <tr>
                          <th>Rating Produk</th>
                          <td>
                            <div class="stars mb-1">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                          </div>
                        </td>
                        </tr>
                        <tr>
                          <th>Stock Produk</th>
                          <td><?php echo $data['stok']; echo ($data['stok'] > 1) ? " pcs" : " pc" ?></td>
                        </tr>
                        <tr>
                          <th>Harga</th>
                          <td>Rp. <?php echo number_format($data['harga']) ?>,00</td>
                        </tr>
                        <tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                  <?php if (isset($_SESSION['cart_'.$data['id_produk']])): ?>
                      <?php if ($_SESSION['cart_'.$data['id_produk']] < $data['stok']): ?>
                          <button type="button" id="AC-<?= $data['id_produk'] ?>" class="btn btn-success" data-dismiss="modal" onclick="addCarts(<?= $_SESSION['cart_'.$data['id_produk']] ?>, <?= $data['stok'] ?>, <?= $data['id_produk'] ?>)">+ Keranjang</button>
                      <?php else: ?>
                          <button type="button" id="AC-<?= $data['id_produk'] ?>" class="btn btn-success" data-dismiss="modal" onclick="addCarts(<?= $_SESSION['cart_'.$data['id_produk']] ?>, <?= $data['stok'] ?>, <?= $data['id_produk'] ?>)" disabled>+ Keranjang</button>
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
            $.ajax({
                type: "POST",
                url: "dataCart.php",
                data: "action=tambah&id=" + id,
                success: function(data){
                    alert("Berhasil ditambahkan");
                    viewCart();
                    $("#AC-"+id).attr('onclick', "addCarts(" + (++cart) + ", " + stok + ", " + id + ")");
                    if (cart == stok) {
                        $("#AC-"+id).prop('disabled', true);
                    }
                }
            })
        }
    </script>

<?php include_once 'assets/template/footer.php'; ?>
