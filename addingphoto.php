<?php
include('conn.php');
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if($_COOKIE['email']){
        echo 'this';
        
        $id =  $_COOKIE['photoid'];
        $name = $_FILES["files"]["name"];
        $tmp_name = $_FILES['files']['tmp_name'];
        $uploadFolder = './Uploads';
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $sql = "select * from $dbname.userdetails where id ='$id'";
        $row = $conn->query($sql);
        $result = $row->fetch_assoc();
        $username = $result['name'];
        $useremail = $result['email'];
        $filename = $username."_".$useremail.".".$extension;
        $FileDest = $uploadFolder."/".$filename;

        if($name && $_FILES['files']['size'] == 0){
            echo 'File size is too big';
            exit();
        }

        if(move_uploaded_file($tmp_name, $FileDest)){
            $sql = "UPDATE $dbname.userdetails SET imagepath='$filename' WHERE id='$id'";
            if($conn->query($sql)){
                setcookie('upload', 'uploaded', time()+2, '/');
                header('Location:index.php');
            }
            echo 'successfully save : )';
        }else{
            echo 'Error uploading';
        }

    }
    else{
        echo 'Please Log in first to update your profile<br>';
    }
}
else{
    echo 'Wrong Method';
}