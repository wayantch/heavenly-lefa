<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heavenly - Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/heavenly-store/css/login.css">
    <link rel="shortcut icon" href="/heavenly-store/img/logo.png" type="image/x-icon">

    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

</head>

<body>
    <div class="box-login">
        <h2>Login - Admin</h2>
        <form action="" method="POST">
            <input type="text" name="user" placeholder="Username" class="input-control" autocomplete="off">
            <input type="password" name="pass" placeholder="Password" class="input-control">
            <input type="submit" name="submit" value="Login" class="btn">
        </form>
        <?php 
        if(isset($_POST['submit'])){
            session_start();
            include 'db.php';

            $user = mysqli_real_escape_string($conn, $_POST['user']) ;
            $pass = mysqli_real_escape_string($conn, $_POST['pass']);

            $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username = '".$user."' AND password  = '".MD5($pass)."'");
            if(mysqli_num_rows($cek) > 0){
                $d = mysqli_fetch_object($cek);
                $_SESSION['status_login'] = true;
                $_SESSION['a_global'] = $d;
                $_SESSION['id'] = $d -> id_admin;
                echo '<script>window.location="dasboard.php"</script>';
            } else{
                echo '<script>alert("Username atau Password salah!!!")</script>';   
            }
        }
        ?>
    </div>
</body>

</html>