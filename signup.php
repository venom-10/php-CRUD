<?php
include('conn.php');
echo '<br>';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $intro = $_POST['intro'];
    $profile = $_FILES["files"]["name"];
    if (strlen($password) >= 6) {
        $cap = preg_match('/[A-Z]/', $password);
        $spe = preg_match('/[!@#$%^&*()]/', $password);
        $num = preg_match('/[0-9]/', $password);
        setcookie('cap', $cap, time()+5, '/');
        setcookie('spe', $spe, time()+5, '/');
        setcookie('num', $num, time()+5, '/');
        if($cap && $spe && $num){
            if ($password !== $cpassword) {
                setcookie('notmatch', 'OK', time()+2, '/');
                header('Location:signedup.php');
            }
            else if (!$profile) {
                $sql = "Insert into $dbname.users (name, email, password, intro) values ('$name', '$email', '$password', '$intro')";
                if ($conn->query($sql) === TRUE) {
                    echo 'User created successfully';
                    setcookie('signedin', 'OK', time()+2, '/');
                    header('Location:signedin.php');
                } else {
                    echo 'Error: ' . $sql . '<br>' . $conn->error;
                }
            } else {
                $tmp_name = $_FILES['files']['tmp_name'];
                $uploadFolder = './uploads';
                $extension = pathinfo($profile, PATHINFO_EXTENSION);
                $filename = $name . "_" . $email . "." . $extension;
                $FileDest = $uploadFolder . "/" . $filename;
                if ($_FILES["files"]["name"] && $_FILES['files']['size'] == 0) {
                    echo 'File size is too big';
                    exit();
                }
                if (move_uploaded_file($tmp_name, $FileDest)) {
                    $sql = "insert into $dbname.users (name, email, password, intro, imagepath) values ('$name', '$email', '$password', '$intro', '$filename')";
                    if ($conn->query($sql)) {
                        echo 'User Created Successfully';
                        setcookie('signedin', 'OK', time()+2, '/');
                        header('Location:signedin.php');
                    } else {
                        echo 'Error: ' . $sql . '<br>' . $conn->error;
                    }
                } else {
                    echo 'Error uploading';
                }
            }
        }
        else
            header('Location:signedup.php');
    }
    else if(strlen($password) < 6){
        setcookie('short', 'OK', time()+2, '/');
        header('Location:signedup.php');
    }
    else if ($password !== $cpassword) {
        setcookie('notmatch', 'OK', time()+2, '/');
        header('Location:signedup.php');
    }
    
}
