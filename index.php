<?php
session_start();
include('includes/header.php') ?>


<section>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <h4>Image CRUD - insert image in database</h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST" enctype="multipart/form-data">

                            <div class="form-group  mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter  name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="number" name="phone" class="form-control" placeholder="Enter Mobile Number">
                            </div>
                            <div class="form-group  mb-3">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="form-group  mb-3">
                                <label for="">User Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group  mb-3">
                                <button type="submit" name="save_image" class="btn btn-primary">Save Image</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('includes/footer.php') ?>