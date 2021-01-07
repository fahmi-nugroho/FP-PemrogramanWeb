<?php
include('conn.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['deletedata'])){
		$id_produk=$_POST['id_produk'];
		$select = "SELECT * FROM produk WHERE id_produk='$id_produk'";
		$select2 = mysqli_query(connection(), $select);
		$data = mysqli_fetch_array($select2);
		unlink('./assets/img/produk/'.$data['gambar']);

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
