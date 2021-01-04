<?php
session_start();
include('conn.php');

if(isset($_POST['insertdata'])){
	if(isset($_SESSION['user'])){
		$nama_produk=$_POST['nama_produk'];
		$deskripsi=$_POST['deskripsi'];
		$id_kategori=$_POST['id_kategori'];
		$harga=$_POST['harga'];
		$stok=$_POST['stok'];
		$gambar=$_FILES['gambar']['name'];
		$tmp=$_FILES['gambar']['tmp_name'];
		$folder= './assets/img/';
		$penjual = $_SESSION['user']['id'];

		move_uploaded_file($tmp, $folder.$gambar);
		$sql="INSERT INTO produk VALUES(NULL, '$id_kategori','$penjual','$nama_produk','$deskripsi','$harga','$stok', 0,'$gambar')";
		$insert=mysqli_query(connection(),$sql);

		if ($insert) {
			header('location:toko.php');
		} else {
			echo "Data tidak berhasil disimpan";
		}
	} else echo "error";
}
?>
