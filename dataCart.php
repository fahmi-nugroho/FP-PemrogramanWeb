<?php
session_start();
require 'conn.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if ($action == "tambah") {
            $query = "SELECT * FROM produk WHERE id_produk = $id";
            $produk = mysqli_query(connection() ,$query);
            $data = mysqli_fetch_array($produk);

            if (isset($_SESSION['cart_'.$id]) && $_SESSION['cart_'.$id] < $data['stok']) {
                $_SESSION['cart_'.$id] ++;
            } else {
                $_SESSION['cart_'.$id] = 1;
                $_SESSION['cart'] += 1;
            }
        } elseif ($action == "kurang") {
            if ($_SESSION['cart_'.$id] > 1) {
                $_SESSION['cart_'.$id] --;
            } else {
                unset($_SESSION['cart_'.$id]);
                $_SESSION['cart'] --;
            }
        }
    } elseif ($action == "total") {
        $price = 0;
        if (isset($_SESSION['cart']) && $_SESSION['cart'] > 0) {
            foreach ($_SESSION as $key => $value) {
                if (substr($key, 0, 5) == "cart_") {
                    $id = substr($key, 5, strlen($key));
                    $query = "SELECT * FROM produk WHERE id_produk = $id";
                    $produk = mysqli_query(connection(), $query);
                    $data = mysqli_fetch_array($produk);

                    $price += $value * $data['harga'];
                }
            }
            echo "Rp. ".number_format($price).",00";
        } else {
            echo "Rp. ".number_format($price).",00";
        }
    } elseif ($action == "view") {
        $no = 0;
        if (isset($_SESSION['cart']) && $_SESSION['cart'] > 0) { ?>
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
            <tbody> <?php
                foreach ($_SESSION as $key => $value) {
                    if (substr($key,0,5) == "cart_") {
                        $id = substr($key, 5, strlen($key) - 5);
                        $query = "SELECT * FROM produk WHERE id_produk = $id";
                        $produk = mysqli_query(connection(), $query);
                        $data = mysqli_fetch_array($produk); ?>
                        <tr>
                            <th scope="row"><?= ++$no ?></th>
                            <td><?= $data['penjual'] ?></td>
                            <td><img src="assets/img/<?= $data['gambar'] ?>" style="width:60px; height:60px" alt=""></td>
                            <td><?= $data['nama_produk'] ?></td>
                            <td>Rp. <?= number_format($data['harga']) ?>,00</td>
                            <td>
                                <button type="button" class="btn btn-dark mr-2" name="button" onclick="addCart(<?= $value ?>, <?= $data['stok'] ?>, <?= $id ?>)">+</button>
                                <?= $value ?>
                                <button type="button" class="btn btn-dark ml-2" name="button" onclick="minCart(<?= $value ?>, <?= $data['stok'] ?>, <?= $id ?>)">-</button>
                            </td>
                        </tr> <?php
                    }
                } ?>
            </tbody> <?php
        } else { ?>
            <h1 class="display-4 text-center">Cart Kosong</h1> <?php
        }
    }
}
?>
