<?php
session_start();
include 'config/functions.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}


$id = $_GET['id'];
$namaBarang = "";
$harga = "";
$stok = "";
$halaman = "Tambah";


if ($id !== 'new') {
    $id = $_GET['id'];
    $halaman = "Edit";
    $queryBarang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_barang WHERE id_barang = '$id'"));
    $namaBarang = $queryBarang['nama_barang'];
    $harga = $queryBarang['harga'];
    $stok = $queryBarang['stok'];
}
// var_dump($id);

if (isset($_POST['save'])) {
    tambahData($_POST, $id);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>

<body>
    <h1><?= $halaman ?> Barang</h1>
    <form action="" method="post">
        <ul>
            <!-- <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama">
            </li> -->
            <li>
                <label for="namaBarang">Nama Barang :</label>
                <input type="text" name="namaBarang" value="<?= $namaBarang ?>" id="namaBarang" required>
            </li>
            <li>
                <label for="harga">Harga : </label>
                <input type="number" name="harga" value="<?= $harga ?>" id="harga" required>
            </li>
            <li>
                <label for="stok">Stok :</label>
                <input type="number" name="stok" value="<?= $stok ?>" id="stok" required>
            </li>
            <li>
                <button name="save" type="submit">
                    Save
                </button>
            </li>
        </ul>
    </form>
</body>

</html>