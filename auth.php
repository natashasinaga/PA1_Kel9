<?php 
session_start();
require_once("config/functions.php");

if (isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}
if ( isset($_POST["register"]) ) {
    if ( registrasi_user($_POST) > 0 ) {
        echo "<script>
        window.alert('Berhasil registrasi');
        window.location.href='auth.php';
            </script>";
    } else {
    echo mysqli_error($database);
    }
}    
if (isset ($_POST["login"]) ) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hasil = mysqli_query($database, "SELECT * FROM accounts WHERE username = '$username'");
    
    /// Cek username 
    if ( mysqli_num_rows($hasil) === 1) {
        
        /// Cek password
        $row = mysqli_fetch_assoc($hasil);
        if ( password_verify($password, $row['password']) ) {
            /// Set session
            $_SESSION["login"] = true;
            header("Location: index.php");
        }
    }
    $error = true; 
}

if (isset ($_POST["login"]) ) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hasil = mysqli_query($database, "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'");
    
    /// Cek username 
    if ( mysqli_num_rows($hasil) === 1) {
        
        /// Cek password
            $_SESSION["login"] = true;
            header("Location: index.php");
        }
        $error = true; 
    }

?>
<!DOCTYPE html>
<html lang="en">
<?php
require_once('theme/head.php') ?>
<body class="stretched" >

<section id="content" style="background: url('img/b.jpeg') fixed center;" >

<div class="content-wrap">

    <div class="container clearfix">

        <div class="tabs divcenter nobottommargin clearfix" id="tab-login-register" style="max-width: 500px;">

            <ul class="tab-nav tab-nav2 center clearfix">
                <li class="inline-block"><a href="#tab-login">Login</a></li>
                <li class="inline-block"><a href="#tab-register">Register</a></li>
            </ul>

            <div class="tab-container">

                <div class="tab-content clearfix" id="tab-login">
                    <div class="card nobottommargin">
                        <div class="card-body bg-dark" style="padding: 40px;">
                            <form id="login-form" name="login-form" class="nobottommargin" method="post">
                            <?php if( isset($error) ) : ?>
                                <p style="color:red; font-style:italic;">Username atau password salah</p>
                            <?php endif; ?>
                                <h3 class="text-white">Login</h3>

                                <div class="col_full">
                                    <label for="username" class="text-white">Username:</label>
                                    <input type="text" id="lusername" name="username" value="" class="form-control" placeholder="Username"/>
                                </div>

                                <div class="col_full">
                                    <label for="password" class="text-white">Password:</label>
                                    <input type="password" id="lpassword" name="password" value="" class="form-control" placeholder="Password" />
                                </div>

                                <div class="col_full nobottommargin">
                                    <button class="button button-3d button-black nomargin" id="login" name="login" value="login">Login</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                
                <div style="padding-top:290px;"></div>

                <div class="tab-content clearfix" id="tab-register">
                    <div class="card nobottommargin">
                        <div class="card-body bg-dark" style="padding: 40px;">
                            <h3 class="text-white">Daftar</h3>

                            <form id="register-form" name="register-form" class="nobottommargin" method="post">

                                <div class="col_full">
                                    <label for="name" class="text-white">Nama:</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama"/>
                                </div>

                                <div class="col_full">
                                    <label for="email" class="text-white">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email"/>
                                </div>

                                <div class="col_full">
                                    <label for="lahir" class="text-white">Tanggal lahir:</label>
                                    <input type="text" id="lahir" name="lahir" class="form-control" placeholder="Tanggal lahir"/>
                                </div>

                                <div class="col_full">
                                    <label for="username1" class="text-white">Username:</label>
                                    <input type="text" id="username1" name="username" class="form-control" placeholder="Username"/>
                                </div>

                                <div class="col_full">
                                    <label for="password1" class="text-white">Password:</label>
                                    <input type="password" id="password1" name="password" class="form-control" placeholder="Password" />
                                </div>

                                <div class="col_full">
                                    <label for="cpassword" class="text-white">Masukan Password kembali:</label>
                                    <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Konfirmasi password" />
                                </div>

                                <div class="col_full nobottommargin">
                                    <button class="button button-3d button-black nomargin" id="submit" name="register" value="Daftar">Daftar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

</section><!-- #content end -->
</body>
<?php 
require_once('theme/script.php');
?>
</html>