<?php

session_start();

$connection = mysqli_connect("localhost", "root", "", "php");

if(isset($_POST['save_image']))
{
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['emailimage'];
    $image = $_FILES['image']['name'];

    $insert_image_query = "INSERT INTO php_image_crud(name,phone,email,image) VALUES('$name','$phone','$email','$image')";
    $insert_image_query_run = mysqli_query($connection, $insert_image_query);
    
    if($insert_image_query_run)
    {
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/".$_FILES['image']['name']);
        $_SESSION['status'] = " Image inserted successfully";
        header('location: index.php');
    }
    else
    {
        $_SESSION['status'] = " Image Not inserted successfully";
        header('location: index.php');
    }

}

?>