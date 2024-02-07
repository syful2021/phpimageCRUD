<?php

session_start();

$connection = mysqli_connect("localhost", "root", "", "php");

if (isset($_POST['save_image'])) {
    $user_id = $_POST['id'];
    $image = $_FILES['image']['name'];
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $rename = date('is-d_m_Y');
    $newname = $rename . '.' . $extension;

    $filename = $_FILES["image"]["tmp_name"];
    if (move_uploaded_file($filename, 'images/' . $newname)) {
        $insert_image_query = "INSERT INTO about(image) VALUES('$newname')";
        $insert_image_query_run = mysqli_query($connection, $insert_image_query);
        $_SESSION['status'] = " Image inserted successfully";
        header('location: about.php');
    } else {
        $_SESSION['status'] = " Image Not inserted successfully";
        header('location: about.php');
    }
}


// Update part

if (isset($_POST['update_image'])) {
    $user_id = $_POST['id'];
    $new_image = $_FILES['image']['name'];
    $extension = pathinfo($new_image, PATHINFO_EXTENSION);
    $rename = date('is-d_m_Y');
    $newname = $rename . '.' . $extension;

    $old_image = $_POST['old_image'];

    if ($new_image != '') {
        $update_filename = $newname;
    } else {
        $update_filename = $old_image;
    }

    $update_image_query = "UPDATE about SET image='$update_filename' WHERE id='$user_id' ";
    $update_image_query_run = mysqli_query($connection, $update_image_query);

    $filename = $_FILES["image"]["tmp_name"];
    if ($update_image_query_run) {
        if ($filename != '') {
            move_uploaded_file($filename, "images/" . $update_filename);
            unlink("images/" . $old_image);
        }
        $_SESSION['status'] = "Image Updated successfully";
        header('location: about_home.php');
    } else {
        $_SESSION['status'] = "Image Updation failed";
        header('location: about.php');
    }
}

// Delete part

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $image = $_POST['image'];

    $delete_image_query = "DELETE FROM about WHERE id='$id' ";
    $delete_image_query_run = mysqli_query($connection, $delete_image_query);

    if ($delete_image_query_run) {
        unlink("images/" . $image);
        $_SESSION['status'] = "Image deleted!";
        header('location: about_home.php');
    } else {
        $_SESSION['status'] = "Image Not deleted!";
        header('location: about_home.php');
    }
}
