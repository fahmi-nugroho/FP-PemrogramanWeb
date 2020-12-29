<?php
include('conn.php');


                if($_SERVER['REQUEST_METHOD']=='POST'){
                   if(isset($_POST['update'])){
                      $id_produk=$_POST['id_produk'];
                      $nama_produk=$_POST['nama_produk'];
                      $deskripsi=$_POST['deskripsi'];
                      $id_kategori=$_POST['id_kategori'];
                      $harga=$_POST['harga'];
                      $stok=$_POST['stok'];
                      $gambar = $_FILES['gambar']['name'];
                      $tmp = $_FILES['gambar']['tmp_name'];
                      // Set path folder tempat menyimpan fotonya
                      $path = './assets/img/';
                      


                      // Proses upload
                   if(move_uploaded_file($tmp, $path.$gambar)){ // Cek apakah gambar berhasil diupload atau tidak
                      // Query untuk menampilkan data  berdasarkan id yang dikirim
                      $query = "SELECT * FROM produk WHERE id_produk='$id_produk'";
                      $sql = mysqli_query(connection(), $query); // Eksekusi/Jalankan query dari variabel $query
                      $data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql
                      // Cek apakah file foto sebelumnya ada di folder images
                      if(is_file('./assets/img/'.$data['gambar'])) // Jika foto ada
                        unlink('./assets/img/'.$data['gambar']); // Hapus file foto sebelumnya yang ada di folder images

                                       
                                       $sql="UPDATE produk SET id_kategori='$id_kategori',nama_produk='$nama_produk',deskripsi='$deskripsi',harga='$harga',stok='$stok',gambar='$gambar' WHERE id_produk='$id_produk'";
                                       $update=mysqli_query(connection(),$sql);

                                       if ($update) {
                                           header('location:toko.php');
                                        }else{
                                          echo "Data tidak berhasil disimpan";
                                        }
                       }else{
                          $sql="UPDATE produk SET id_kategori='$id_kategori',nama_produk='$nama_produk', deskripsi='$deskripsi',harga='$harga',stok='$stok' WHERE id_produk='$id_produk'";
                          $update=mysqli_query(connection(),$sql);
                           header('location:toko.php');
                         }
                                    

                  }
                }
?>