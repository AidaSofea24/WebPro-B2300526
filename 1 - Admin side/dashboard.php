<?php 
$page_title = "Home page";
include('includes/session_check.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <h2>Access when you are logged in</h2>

                        <!--to add more, start from here-->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Register A New Student</h5>
                                        <p class="card-text">Register a new student for the service.</p>
                                        <a href="register.php" class="btn btn-primary">Register New Student Here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Student List</h5>
                                        <p class="card-text">Manage student from here</p>
                                        <a href="list_user.php" class="btn btn-primary">View Student List</a>
                                    </div>
                                </div>
                            </div>
                            <!--end from here-->

                            <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Mental Health Booking</h5>
                                        <p class="card-text">Manage and book mental health appointments.</p>
                                        <a href="admin.php" class="btn btn-primary">Go to Mental Health Booking</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Poll Admin</h5>
                                        <p class="card-text">Administer and manage polls.</p>
                                        <a href="poll_admin.php" class="btn btn-primary">Go to Poll Admin</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more sections as needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
