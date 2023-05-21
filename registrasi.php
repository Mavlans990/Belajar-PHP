<?php
include 'config/functions.php';

if (isset($_POST['registrasi'])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('User Berhasil Ditambahkan')
                </script>";
    } else {
        echo mysqli_error($conn);
    }
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
    <h1>Halaman Registrasi</h1>
    <form action="" method="post">
        <ul>
            <!-- <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama">
            </li> -->
            <li>
                <label for="user">User</label>
                <input type="text" name="user" id="user">
            </li>
            <li>
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass">
            </li>
            <li>
                <label for="pass2">Konfirmasi Password</label>
                <input type="password" name="pass2" id="pass2">
            </li>
            <li>
                <button name="registrasi" type="submit">
                    registrasi
                </button>
            </li>
        </ul>
    </form>
    <a href="login.php">Halaman Login</a>
</body>

</html>