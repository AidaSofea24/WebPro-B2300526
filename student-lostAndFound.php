<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "BIT102";

    //create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
 
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //fetch content from the database
    $sql = "SELECT id, file_name, file_path, upload_time, title, itemDescription FROM uploads";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student-Lost and Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesElain.css">
</head>
<body>
    <!--User Homepage - textbox in full screen picture-->
    <div class="py-5" style="background-image: url('~campus5.png'); height: 100vh; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="bg-white p-5 mx-auto col-md-8 col-10">
                    <h3 class="display-3">Lost and Found Center</h3>
                    <p class="mb-3 lead">Discover Lost Treasures!</p>
                    <p class="mb-4">
                        Our university's Lost and Found center is dedicated to providing a convenient and reliable service for our students, faculty, and staff. Whether you've misplaced a personal item or found something that doesn't belong to you, our center acts as a central hub for reporting and recovering lost items. We strive to ensure a seamless process, promoting a safe and supportive campus environment where belongings can be safely returned to their rightful owners.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!--Item Details-->
    <div class="container mt-5">
        <div class="row">
            <h1>Lost Item Details</h1>
            <?php
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        $title = $row["title"];
                        $itemDescription = $row["itemDescription"];
                        $filePath = $row["file_path"];
                        $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            ?>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <?php
                                    // Check the datatype for the data, display image if the file is an image
                                    if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                        echo "
                                            <img src='$filePath' 
                                            alt='" . $row["file_name"] . "' 
                                            class='card-img-top img-fluid' 
                                            style='height: 230px; object-fit: cover;' />
                                        ";
                                    } else {
                                        echo "
                                            <div class='card-body'>
                                                <a href='$filePath' class='btn btn-primary'>Download</a>
                                            </div>
                                        ";
                                    }
                                ?>
                                <div class="card-body">
                                    <h5 class="card-title"><strong><?php echo $title; ?></strong></h5>
                                    <p class="card-text"><?php echo $itemDescription; ?></p>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                } else {
                    echo "<p>No files found.</p>";
                }
                $conn->close();
            ?>
        </div>
    </div>

    <!--Overlay gallery-->
    <div class="container-fluid" style="padding-left: 10%; padding-right: 10%;">
        <section>
            <div class="lightbox" data-mdb-lightbox-init>
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6">
                        <!--Take Care of Your Belongings-->
                        <div class="bg-image position-relative">
                            <img src="~overlay1.png" class="w-100 mb-2 mb-md-4 shadow-1-strong rounded" />
                            <div class="mask text-light d-flex justify-content-center align-items-center">
                                <div>
                                    <h4>Take Care of Your Belongings</h4>
                                    <p class="m-0">We encourage all members of our campus community to take proactive steps in safeguarding their belongings. It's essential to remain vigilant and mindful of your personal items at all times. By keeping track of your belongings and securing them properly, you can minimize the risk of loss or misplacement.</p>
                                </div>
                            </div>
                        </div>
                        <!--Report found item-->
                        <div class="bg-image position-relative mt-4 mt-md-0">
                            <img src="~overlay2.jpg" class="w-100 shadow-1-strong rounded" />
                            <div class="mask text-light d-flex justify-content-center align-items-center">
                                <div>
                                    <h4>Report found item</h4>
                                    <p class="m-0">If you have found an item on campus, please bring it to our administration office where our dedicated staff will assist in documenting and posting the found item. By reporting found items to our Lost and Found center, you contribute to the community's effort in reuniting lost belongings with their owners. Your cooperation helps maintain the integrity of our Lost and Found service, ensuring items are promptly returned to those who have lost them.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Look for lost item-->
                    <div class="col-lg-6">
                        <div class="bg-image position-relative">
                            <img src="~overlay3.tiff" class="w-100 shadow-1-strong rounded" />
                            <div class="mask text-light d-flex justify-content-center align-items-center">
                                <div>
                                    <h4>Look for lost item</h4>
                                    <p class="m-0">If you haven't found your lost item listed in our database, don't lose hope. You can reach out to our Lost and Found center immediately and provide details about your lost item, such as a description, where and when it was lost, and any distinguishing features. Our team will actively search our records and notify you if we locate a match. We are committed to assisting you in recovering your lost belongings and fostering a supportive campus community.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
    <footer>
        <div class="" >
            <div class="container">
                <div class="row">
                    <div class="p-4 col-md-3">
                        <h2 class="mb-4">About Us</h2>
                        <p>Our excellent academic programmes are widely accredited so you can easily further your studies, but we offer much more: 8 key attributes for life and career, a vibrant student life and a HELP community that supports your aspirations. We will help you get that piece of paper, but we want to get you ahead in life.</p>
                    </div>
                    <div class="p-4 col-md-3">
                        <h2 class="mb-4">Navigation</h2>
                        <ul class="list-unstyled"> 
                            <a href="#" class="text-dark">Home</a> <br> 
                            <a href="#" class="text-dark">Communication</a> <br> 
                            <a href="#" class="text-dark">Support</a> <br> 
                            <a href="#" class="text-dark">Learning</a> <br> 
                            <a href="#" class="text-dark">Campus Life</a> <br> 
                            <a href="#" class="text-dark">About Us</a> 
                        </ul>
                    </div>
                    <div class="p-4 col-md-6">
                        <h2 class="mb-4">Visit Us</h2>
                        <iframe width="100%" height="350" src="https://maps.google.com/maps?q=HELP%20Subang%202&#038;t=m&#038;z=11&#038;output=embed&#038;iwloc=near" scrolling="no" frameborder="0"></iframe> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                    <p class="text-center">© For educational purposes only </p>
                    </div>
                </div>
            </div>
          </div>
    </footer>
</html>
