<?php
$conn = mysqli_connect('Localhost', 'root', '', 'belajar_php');

function registrasi($data)
{
    global $conn;

    $user = strtolower($data['user']);
    $pass = mysqli_real_escape_string($conn, $data["pass"]);
    $pass2 = mysqli_real_escape_string($conn, $data["pass2"]);

    // Cek User sudah ada / belum
    $result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE user = '$user' "));
    if ($result) {
        echo "<script>
                alert('User Sudah digunakan')
                </script>";
        return false;
    }

    //cek Konfirmasi Password
    if ($pass !== $pass2) {
        echo "<script>
                alert('Konfirmasi password tidak sempurna')
                </script>";
        return false;
    }

    // Enkripsi Password
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    // var_dump($pass);

    // Tambahkan ke database
    mysqli_query($conn, "INSERT INTO tb_user VALUES('', '', '$user', '$pass', '')");

    return mysqli_affected_rows($conn);
}

function tambahData($data, $id)
{
    global $conn;

    $namaBarang   = htmlspecialchars($data['namaBarang']);
    $harga        = htmlspecialchars($data['harga']);
    $stok         = htmlspecialchars($data['stok']);

    if ($id == "new") {
        $insertData = mysqli_query($conn, "INSERT INTO tb_barang( id_barang, nama_barang, harga, stok)
                                                VALUES( '', '$namaBarang', '$harga', '$stok' )");

        if ($insertData) {
            echo "<script>
                        alert('Data Berhasil Ditambahkan');
                        window.location.href = 'index.php';
                    </script>";
        } else {
            echo "<script>
                        alert('Data Gagal Ditambahkan');
                        window.location.href = 'edit_barang.php?id=new';
                    </script>";
        }
    } else {
        $upadteData = mysqli_query($conn, "UPDATE tb_barang SET 
            nama_barang = '$namaBarang',
            harga = '$harga',
            stok = '$stok'
            WHERE id_barang = '$id'
            ");

        if ($upadteData) {
            echo "<script>
                        alert('Data Berhasil Di-Update');
                        window.location.href = 'index.php';
                    </script>";
        } else {
            echo "<script>
                        alert('Data Gagal Di-Update');
                        window.location.href = 'edit_barang.php?id=" . $id . "';
                    </script>";
        }
    }
}

function hapusData($id)
{
    global $conn;
    $hapusData = mysqli_query($conn, "DELETE FROM tb_barang WHERE id_barang = '$id'");

    if ($hapusData) {
        echo "<script>
                    alert('Data Berhasil Di-Hapus');
                    window.location.href = 'index.php';
                </script>";
    } else {
        echo "<script>
                    alert('Data Gagal Di-hapus');
                    window.location.href = 'index.php';
                </script>";
    }
}
