<?php  
session_start();
include('includes/header.php') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php
            if (isset($_SESSION['status'])  && $_SESSION != '') {

            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong> <?php echo $_SESSION['status'];  ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php
                unset($_SESSION['status']);
            }
            ?>

            <div class="card">
                <div class="card-header">
                    <h4>Image CRUD - Edit image with database</h4>
                </div>
                <div class="card-body">

                    <?php

                    $connection = mysqli_connect("localhost", "root", "", "php");
                    $id = $_GET['id'];
                    $fetch_image_query = "SELECT * FROM php_image_crud WHERE id='$id' ";
                    $fetch_image_query_run = mysqli_query($connection, $fetch_image_query);

                    if (mysqli_num_rows($fetch_image_query_run) > 0) 
                    {
                        foreach ($fetch_image_query_run as $row) {
                            // echo $row['id'];
                    ?>
                            <form action="code.php" method="POST" enctype="multipart/form-data">

                                <div class="form-group  mb-3">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" class="form-control">
                                </div>
                                <div class="form-group  mb-3">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" placeholder="Enter  name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Phone Number</label>
                                    <input type="number" name="phone" value="<?php echo $row['phone']; ?>" class="form-control" placeholder="Enter Mobile Number">
                                </div>
                                <div class="form-group  mb-3">
                                    <label for="">Email</label>
                                    <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="Enter Email">
                                </div>
                                <div class="form-group  mb-3">
                                    <label for="">User Image</label>
                                    <input type="file" name="image" class="form-control">
                                    <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>" class="form-control">
                                    <img src="<?php echo "uploads/image/" . $row['image']; ?>" width="70" height="70" alt="image">
                                </div>
                                <div class="form-group  mb-3">
                                    <button type="submit" name="update_image" class="btn btn-info">Update Image</button>
                                </div>
                            </form>
                    <?php
                        }
                    } else {
                        echo "No data found";
                    }

                    ?>


                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php') ?>