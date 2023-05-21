<?php
session_start();
include 'config/functions.php';

// Cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['user'])) {
    $id = $_COOKIE['id'];
    $user = $_COOKIE['user'];

    $result = mysqli_query($conn, "SELECT user FROM tb_user WHERE id_user = $id ");
    $row = mysqli_fetch_assoc($result);

    if ($user === hash('sha256', $row['user'])) {
        // Buat Sesstion
        $_SESSION['login'] = true;
        $_SESSION['user'] = $row['user'];
    }
}

if (isset($_SESSION['login'])) {
    header("Location: index.php");
}


if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Cek User sudah ada / belum
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE user = '$user' ");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) === 1) {

        // Cek Password
        if (password_verify($pass, $row['pass'])) {

            // Buat Sesstion
            $_SESSION['login'] = true;
            $_SESSION['user'] = $row['user'];

            // cek Remember Me
            if (isset($_POST['remember'])) {
                // Buat Cookie
                setcookie('id', $row['id_user'], time() + 60);
                setcookie('user', hash('sha256', $row['user']), time() + 60);
            }

            echo "<script>
            alert('Anda Berhasil Masuk');
                    window.location.href = 'index.php';
                    </script>";
            exit;
        }
    }

    $error = true;
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
            /* display: block; */
        }

        p {
            color: red;
            font-style: italic;
        }
    </style>
</head>

<body>
    <h1>Halaman Login</h1>
    <?php
    if (isset($error)) :
        if (!mysqli_num_rows($result)) {
            echo "<p>Username & Password salah</p>";
        }
        if (mysqli_num_rows($result) && !password_verify($pass, $row['pass'])) {
            echo "<p>Password salah</p>";
        }
    endif;
    ?>
    <form action="" method="post">
        <ul>
            <!-- <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama">
            </li> -->
            <li>
                <label for="user">Username :</label>
                <input type="text" name="user" id="user">
            </li>
            <li>
                <label for="pass">Password : </label>
                <input type="password" name="pass" id="pass">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </li>
            <li>
                <button name="login" type="submit">
                    Login
                </button>
            </li>
        </ul>
    </form>
    <a href="registrasi.php">Halaman Registrasi</a>
</body>

</html>