<?php
session_start();
include 'config/functions.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Mencari Nama 
$whereNama = "";
$nama = "";
if (isset($_POST['search'])) {
    if ($_POST['nama'] !== "") {
        $nama = $_POST['nama'];
        $whereNama = "WHERE nama_barang LIKE '%$nama%'";
    }
}

// Aritmatika Pagination
$jumlahDataHalaman = 3;
$jumlahData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_barang $whereNama"));
// var_dump($jumlahData);
$jumlahHalaman = ceil($jumlahData / $jumlahDataHalaman);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$dataAwal = ($jumlahDataHalaman * $halamanAktif) - $jumlahDataHalaman;

// $queryBarang = mysqli_query($conn, "SELECT * FROM tb_barang $whereNama LIMIT $dataAwal, $jumlahDataHalaman");
$queryBarang = mysqli_query($conn, "SELECT * FROM tb_barang $whereNama");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .loading {
            position: absolute;
            width: 50px;
            top: 126px;
            z-index: -1;
            display: none;
        }
    </style>



</head>

<body>
    <a href="logout.php">Logout</a>
    <h1>Data Barang</h1>
    <a href="edit_barang.php?id=new">Tambah Barang</a>
    <br><br>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
        <input type="text" name="nama" id="cariNama" class="cariNama" value="<?= $nama ?>" onclick="this.select()" placeholder="Cari Nama...">
        <!-- <input type="text" name="" id="" class="nama_barang" style="width:180px;" autocomplete="off" list="list_barang" onclick="this.select()"> -->
        <datalist id=" list_barang" class="list_barang">
        </datalist>
        <!-- <button type="submit" name="search" id="tombolCari">Cari</button> -->
        <img src="img/loading-2.gif" class="loading" srcset="">
    </form>
    <br>

    <!-- Pagination -->
    <?php
    // if ($halamanAktif > 1) {
    //     echo '
    //         <a href="?halaman=' . ($halamanAktif - 1) . '" style="font-weight:bold">&laquo;</a>
    //         ';
    // }
    // for ($i = 1; $i <= $jumlahHalaman; $i++) {
    //     if ($i == $halamanAktif) {
    //         echo '
    //         <a href="?halaman=' . $i . '" style="font-weight:bold">' . $i . '</a>
    //         ';
    //     } else {
    //         echo '
    //         <a href="?halaman=' . $i . '" >' . $i . '</a>
    //         ';
    //     }
    // }
    // if ($halamanAktif < $jumlahHalaman) {
    //     echo '
    //         <a href="?halaman=' . ($halamanAktif + 1) . '" style="font-weight:bold">&raquo;</a>
    //         ';
    // }
    ?>
    <div id="ubahTable" class="ubahTable">
        <table border="1" width="1000">
            <thead>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </thead>
            <tbody style="text-align: center;">
                <?php
                // $queryBarang = mysqli_query($conn, "SELECT * FROM tb_barang");
                $no = 1;
                while ($row = mysqli_fetch_assoc($queryBarang)) {
                    // var_dump($row);
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_barang'] ?></td>
                        <td><?= $row['harga'] ?></td>
                        <td><?= $row['stok'] ?></td>
                        <td>
                            <a href="edit_barang.php?id=<?= $row['id_barang'] ?>">Edit</a>
                            |
                            <a href="hapus_barang.php?id=<?= $row['id_barang'] ?>" onclick="return confirm('Apakah Data ini Ingin Di-Hapus')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <!-- <script src="js/script.js"></script> -->
</body>

</html>
<script src="js/jquery-3.7.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("keyup", ".cariNama", function() {
            var cariNama = $(this).val();
            var loading = $('.loading').show()
            $.ajax({
                type: "POST",
                url: "ajax/ajax_barang.php",
                data: {
                    "get_barang": cariNama
                },
                cache: true,
                success: function(result) {
                    $('.loading').hide();
                    $(".ubahTable").html(result);
                }
            });
        });

        // $(document).on(".keyup", ".nama_barang", function() {
        //     var nama_barang = $(this).val();
        //     $.ajax({
        //         type: "POST",
        //         url: "ajax/ajax_barang.php",
        //         data: {
        //             "cari_nama_barang": nama_barang
        //         },
        //         cache: true,
        //         success: function(result) {
        //             $(".list_barang").html(result);
        //         }
        //     });
        // });
    });
</script>