<?php
include('conn.php');
echo 'this';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_COOKIE['name'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $state = $_POST['state'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        // check if email already exists
        $sql = "SELECT * FROM $dbname.userdetails WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            setcookie('emailalreadyexists', 'true', time() + 2, '/');
            header('location: index.php');
            exit();
        }
        $sql = "INSERT INTO $dbname.userdetails (name, email, state, gender, address) VALUES ('$name', '$email', '$state', '$gender', '$address')";

        if ($conn->query($sql) == true) {
            setcookie('dataadded', 'true', time() + 2, '/');
            header('location: index.php');
        }
    }
    else{
        setcookie('notlogin', 'OK', time()+2, '/');
        header('location: index.php');
    }
}

