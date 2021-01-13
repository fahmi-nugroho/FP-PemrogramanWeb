<!DOCTYPE html>
<html>

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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <h3><i class="fas fa-shopping-cart mr-2"></i></h3>
        <a class="navbar-brand" href="index.php">My Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline ml-auto my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
            </form>
            <h5><i class="fas fa-shopping-cart mt-2 mr-4 ml-3" data-toggle="tooltip" title="Keranjang Belanja"></i></h5>
            <h5><i class="fas fa-grip-lines-vertical mt-2 mr-4"></i></h5>
            <button class="btn btn-outline-dark mr-3" type="button">Masuk</button>
            <button class="btn btn-dark" type="button">Daftar</button>
        </div>
    </nav>

    <form action="updatevoucher_admin.php" method="post" enctype="multipart/form-data">
        <!-- <input type="hidden" name="id_voucher" value="<?= $_GET['id']; ?>"> -->
        <input type="hidden" name="id_voucher" value="<?= $_GET['id']; ?>">
        <td>jenis voucher</td>
        <input type="text" name="jenis_voucher" id="jenis_voucher" autocomplete="off">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Perbarui" name="submit">
    </form>
    </form>
</body>

</html>