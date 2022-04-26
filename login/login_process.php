<?php

session_start();

// Create connection
$conn = mysqli_connect("localhost", "root", "", "coba");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function login ($submitdata){
    global $conn;
    $email = $_POST['email'];
    $pass = md5(md5('alvian'.$_POST['password']));

    //melakukan pengecekan pada database
    $checkUsers = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    if ( mysqli_num_rows($checkUsers) === 1 ){
        $row = mysqli_fetch_assoc( $checkUsers ); // mysqli_fetch_assoc digunakan untuk menggambil data dari querry result dan dimasukkan ke dalam $row
        if($pass == $row["password"]){// Berguna untuk mengecek password jika sama
           if($row["jabatan"] == "admin"){
               $_SESSION["admin"] = true;
               $_SESSION["user"] = $row['email'];
               header("location: ../backend/admin.php");
           }else if ($row["jabatan"] == "staff_gudang"){
                $_SESSION["staffGudang"] = true;
                $_SESSION["user"] = $row['email'];
                header("location: ../backend/staff_gudang.php");
           }else {
                $_SESSION["staffKantor"] = true;
                $_SESSION["user"] = $row['email'];
                header("location: ../backend/staff_kantor.php");
           };
        } else {
            echo "<p 
            style='padding: 10px;
            background-color: #f44336;
            color: white;
            text-align: center;
            '>
            
            Password Salah
            
            </p>";
        }
    } else {
        echo "<p 
        style='padding: 10px;
        background-color: #f44336;
        color: white;
       text-align: center;
        '>
        
        Username tidak ditemukan

        </p>";
    }
}

// Check connection

?>