<?php
session_start();
include('includes/header.php') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">

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
                    <h4>PHP Image CRUD; Fetch image with data form the database in php. </h4>
                </div>
                <div class="card-body">

                    <table class="table table-success table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Image</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $connection = mysqli_connect("localhost", "root", "", "php");
                            $fetch_image_query = "SELECT * FROM php_image_crud";
                            $fetch_image_query_run = mysqli_query($connection, $fetch_image_query);

                            if (mysqli_num_rows($fetch_image_query_run) > 0) {
                                foreach ($fetch_image_query_run as $row) {

                            ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>
                                            <img src="<?php echo "uploads/image/" . $row['image']; ?>" width="70" height="70" alt="image">
                                        </td>
                                        <td class="text-center p-4">
                                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success "> Edit </a>
                                        </td>
                                        <td class="text-center p-4">
                                            <form action="code.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <input type="hidden" name="image" value="<?php echo $row['image']; ?>">
                                                <button type="submit" name="delete"  class="btn btn-danger "> Delete </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr colspan="5"> No record Found </tr>
                            <?php
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <a href="index.php" class="btn btn-dark ">Back</a>
    </div>
</div>

<?php include('includes/footer.php') ?>