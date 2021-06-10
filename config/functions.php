<?php 
$database = mysqli_connect("localhost", "root","", "proyekakhir");

function query($query) {
    global $database;
    $result = mysqli_query($database, $query);
    $rows =[];
    while ($row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function registrasi_user($data) {
    global $database;
    
    $name = htmlspecialchars( $data["name"]);
    $email = htmlspecialchars( $data["email"]);
    $lahir = htmlspecialchars( $data["lahir"]);
    $username = strtolower( stripslashes(htmlspecialchars( $data["username"])) );
    $password = mysqli_real_escape_string ( $database, htmlspecialchars( $data["password"]));
    $password2 = mysqli_real_escape_string ($database, htmlspecialchars( $data["cpassword"]));
    /// cek username gaboleh duplikat
    $result = mysqli_query($database, "SELECT username FROM accounts WHERE username = '$username'");

    if ( mysqli_fetch_assoc ( $result ) ) {
        echo "<script>
            alert('Username sudah terdaftar, cari username lain!')
            </script>";
        return false;
    }

    if (empty($username)) {
        echo "<script>
        alert('Masukin Username yang bener!!');
        </script>";  return false;
    } else if (strlen($username) < 8) {
        echo "<script>
        alert('Username minimum 8 karakter!!');
        </script>"; return false;
    } else if (empty($password)) {
        echo "<script>
        alert('Masukin Password yang bener!!');
        </script>"; return false;
    } else if (strlen($password) < 8) {
        echo "<script>
        alert('Password minimum 8 karakter!!');
        </script>"; return false;
    } else if ( $password != $password2 ) { 
          /// Cek password konfirmasi
            echo "<script>
                alert('Password konfirmasi tidak sama')
                </script>";
                return false;
        } else{
     
        /// Tambah user baru
        mysqli_query($database, "INSERT INTO accounts VALUES('','$name','$email','$lahir','$username','$password')" );

        return mysqli_affected_rows($database); 
        }
}
?>