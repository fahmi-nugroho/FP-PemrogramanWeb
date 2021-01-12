<?php
include ('conn.php');
$target_dir = "assets/img/voucher/";
$gambar=$_FILES["fileToUpload"]["name"];
$target_file = $target_dir . basename($gambar);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
  
    $uploadOk = 1;
  } else {
    echo '<div class="alert alert-danger" role="alert">
  Pastikan file berformat JPG, JPEG dan PNG . Klick untuk kembali ke <a href="admin.php" class="alert-link">Admin </a>.
  </div>';
    $uploadOk = 0;
  }
}

// Check if file already exists

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo '<div class="alert alert-danger" role="alert">
  Pastikan gambar tidak lebih dai 5Mb. Klick untuk kembali ke <a href="admin.php" class="alert-link">Admin </a>.
  </div>';
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {

  echo '<div class="alert alert-danger" role="alert">
  Pastikan file berformat JPG, JPEG dan PNG . Klick untuk kembali ke <a href="admin.php" class="alert-link">Admin </a>.
  </div>';
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo '<div class="alert alert-danger" role="alert">
    Data gagal ditambahkan. Klick untuk kembali ke <a href="admin.php" class="alert-link">Admin </a>.
  </div>';;
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    
    $id_voucher = $_POST['id_voucher'];
    $jenis_voucher = $_POST['jenis_voucher'];
    $update ="UPDATE voucher SET jenis_voucher='$jenis_voucher',gambar='$gambar' WHERE id_voucher='$id_voucher'";
    $res = mysqli_query(connection(), $update);
    header("index.php");
    
    echo '<div class="alert alert-success" role="alert">
    Data Berhasil Ditambahkan. Klick untuk kembali ke <a href="admin.php" class="alert-link">Admin </a>.
  </div>';
  } else {
    echo '<div class="alert alert-danger" role="alert">
    Data gagal ditambahkan. Klick untuk kembali ke <a href="admin.php" class="alert-link">Admin </a>.
  </div>';
  }
}
?>