<?php
include '../config/functions.php';
usleep(500000);
// $query = mysqli_query($conn, "SELECT * FROM tb_barang");
// var_dump($query);
// if (isset($_POST['get_barang'])) {
//     $nama_barang = mysqli_real_escape_string($conn, $_POST['get_barang']);
//     // $ex_barang = explode(" | ", $nama_barang);
//     // $id_barang = $ex_barang[0];

//     $hasil = "Tes";
//     $sql_uom_barang = mysqli_query($conn, "SELECT * FROM tb_barang WHERE nama_barang = '" . $nama_barang . "'");
//     if ($row_uom_barang = mysqli_fetch_array($sql_uom_barang)) {
//     }

//     echo $hasil;
// }
if (isset($_POST['get_barang'])) {
    $nama_barang = mysqli_real_escape_string($conn, $_POST['get_barang']);
    // $ex_barang = explode(" | ", $nama_barang);
    // $id_barang = $ex_barang[0];

    $hasil = "";
    $sql_uom_barang = mysqli_query($conn, "SELECT * FROM tb_barang WHERE nama_barang LIKE '%" . $nama_barang . "%'");

    if ($sql_uom_barang == true) {
        $hasil = $hasil . '
            <table border="1" width="1000">
                <thead>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </thead>
                <tbody style="text-align: center;">
                ';
        // $queryBarang = mysqli_query($conn, "SELECT * FROM tb_barang");
        $no = 1;
        while ($row = mysqli_fetch_assoc($sql_uom_barang)) {
            // var_dump($row);
            $hasil = $hasil . '
                        <tr>
                            <td>' . $no++ . '</td>
                            <td>' . $row['nama_barang'] . '</td>
                            <td>' . $row['harga'] . '</td>
                            <td>' . $row['stok'] . '</td>
                            <td>
                                <a href="edit_barang.php?id=' . $row['id_barang'] . '">Edit</a>
                                |
                                <a href="hapus_barang.php?id=' . $row['id_barang'] . '" onclick="return confirm(Apakah)">Hapus</a>
                            </td>
                        </tr>
                    ';
        }
        $hasil = $hasil . '
                </tbody>
            </table>
        ';
    }
    echo $hasil;
}

if (isset($_POST['cari_nama_barang'])) {
    $nama_barang = mysqli_real_escape_string($conn, $_POST['cari_nama_barang']);

    $hasil = "jjkk";
    $sql_get_barang = mysqli_query($conn, "SELECT nama_barang FROM tb_barang WHERE nama_barang LIKE '%" . $nama_barang . "%' ORDER BY nama_barang ASC LIMIT 50");
    while ($row_barang = mysqli_fetch_array($sql_get_barang)) {
        // $hasil = $hasil . '
        //     <option value="' . $row_barang['nama_barang'] . '">
        // ';
    }

    echo $hasil;
}
