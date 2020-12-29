<?php
include('conn.php');


			         	if($_SERVER['REQUEST_METHOD']=='POST'){
                    if(isset($_POST['deletedata'])){
                      $id_produk=$_POST['id_produk'];
                     
                      $sql="DELETE FROM produk where id_produk='$id_produk'";
                      $delete=mysqli_query(connection(),$sql);

                      if ($delete) {
                         header('location:toko.php');
                      }else{
                        echo "Data tidak berhasil dihapus";
                      }
                     
                  }
                }
?>