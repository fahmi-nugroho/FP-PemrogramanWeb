<?php

    include ('db/conn.php');

		if($_SERVER['REQUEST_METHOD'] === 'POST') {
        	$sku = $_POST['sku'];
			$nama = $_POST['nama'];
        	$kategori = $_POST['kategori'];
        	$stok = $_POST['stok'];
        	$harga = $_POST['harga'];

    
        $update ="UPDATE produk SET sku = '$sku', nama='$nama', kategori='$kategori', stok='$stok',harga='$harga'
                WHERE sku = '$sku'";
        $res = mysqli_query(connection(), $update);
        header("Location: http://localhost/benaya/barokah/");
    }

    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sku = $_GET['id'];
        $sql_get ="SELECT * FROM produk WHERE sku = '$sku'";
        $res_get = mysqli_query(connection(),$sql_get);
           
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Update Data</title>

</head>

<body>
    <h1>Update Data</h1>
    <a href="index.php">Kembali</a>
    <form action="update.php" method="POST">
        <?php while($data = mysqli_fetch_array($res_get)): ?>

        <td>SKU</td>
        <td><?php echo $data['sku']; ?> <input type="hidden" name="sku" value="<?php echo $data['sku']; ?>"></td><br>
        <td>Nama Barang</td>
        <td><input type="text" name="nama" value="<?php echo $data['nama']; ?>"></td>


        <td>Kategori</td>
        <td>
            <select name="kategori">
                <option selected disabled>----Pilih----</option>
                <option value="Makanan" <?php echo $data['kategori']=='Makanan'? 'selected="selected"' : '' ?>>Makanan
                </option>
                <option value="Minuman" <?php echo $data['kategori']=='Minuman'? 'selected="selected"' : '' ?>>Minuman
                </option>
                <option value="Alat Tulis Kerja"
                    <?php echo $data['kategori']=='Alat Tulis Kerja'? 'selected="selected"' : '' ?>>Alat Tulis Kerja
                </option>
                <option value="Kecantikan" <?php echo $data['kategori']=='Kecantikan'? 'selected="selected"' : '' ?>>
                    Kecantikan</option>
                <option value="Other" <?php echo $data['kategori']=='Other'? 'selected="selected"' : '' ?>> Other
                </option>

            </select>
        </td>

        <td>Stok</td>
        <td><input type="text" name="stok" value="<?php echo $data['stok']; ?>"></td>
        <td>Harga</td>
        <td><input type="text" name="harga" value="<?php echo $data['harga']; ?>"></td><br>
        <input type="submit" name="submit" value="Update">
        <?php endwhile; ?>
    </form>
</body>

</html>