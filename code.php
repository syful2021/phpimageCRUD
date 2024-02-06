<?php

session_start();

$connection = mysqli_connect("localhost", "root", "", "php");

if (isset($_POST['save_image'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $image = $_FILES['image']['name'];

    if (file_exists("uploads/" . $image = $_FILES['image']['name'])) {
        $filename =  $_FILES['image']['name'];
        $_SESSION['status'] = $filename . " ;  Image already exists";
        header('location: index.php');
    } else {
        $insert_image_query = "INSERT INTO php_image_crud(name,phone,email,image) VALUES('$name','$phone','$email','$image')";
        $insert_image_query_run = mysqli_query($connection, $insert_image_query);

        if ($insert_image_query_run) {
            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $_FILES['image']['name']);
            $_SESSION['status'] = " Image inserted successfully";
            header('location: index.php');
        } else {
            $_SESSION['status'] = " Image Not inserted successfully";
            header('location: index.php');
        }
    }
}

// Update part

if (isset($_POST['update_image'])) {
    $user_id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != '') {
        $update_filename = $new_image;
    } else {
        $update_filename = $old_image;
    }

    if (file_exists("uploads/" . $image = $_FILES['image']['name'])) {
        $filename =  $_FILES['image']['name'];
        $_SESSION['status'] = $filename . " ;  Image already exists";
        header('location: index.php');
    }
    else
    {
        $update_image_query = "UPDATE php_image_crud SET name='$name', phone='$phone', email='$email', image='$update_filename' WHERE id='$user_id' ";
        $update_image_query_run = mysqli_query($connection, $update_image_query);


        if ($update_image_query_run) {
            if ($_FILES['image']['name'] != '') {
                move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $_FILES['image']['name']);
                unlink("uploads/" . $old_image);
            }
            $_SESSION['status'] = "Image Updated successfully";
            header('location: home.php');
        } else {
            $_SESSION['status'] = "Image Updation failed";
            header('location: edit.php');
        }
    }
}
