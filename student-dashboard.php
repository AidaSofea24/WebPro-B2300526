<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Homepage</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <!--dashboard-->
        <div>
          <nav class="navbar bg-body-tertiary fixed-top" >
            <div class="container-fluid">
              <a class="navbar-brand" href="#">
                <img src="~logo.png" width="Auto" height="80"/>
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" style="color: #2F4F87;">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasNavbarLabel" >Help Student Service Center</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <!--Communication and Information Sharing-->
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Communication
                      </a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="http://localhost/bit-102/3%20-%20Newsletter/NewsLetterForm.html">School Newsletter</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Forum Discussion</a></li>
                      </ul>
                    </li>
                    <!--Support and Services-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Support
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Booking System</a></li>
                          <ul>
                            <li><a class="dropdown-item" href="#">DSA Booking</a></li>
                          </ul>
                          <ul>
                            <li><a class="dropdown-item" href="#">HIS Booking</a></li>
                          </ul>
                          <ul>
                            <li><a class="dropdown-item" href="#">FCDT Booking</a></li>
                          </ul>
                          <ul>
                            <li><a class="dropdown-item" href="http://localhost/bit-102/1%20-%20Admin%20side/needed%20files/lib_booking.php">library Booking</a></li>
                          </ul>
                          <ul>
                            <li><a class="dropdown-item" href="http://localhost/bit-102/1%20-%20Admin%20side/needed%20files/plsplspls.html">Mental Health Therapy Booking</a></li>
                          </ul>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="student-feedbackMainPage.php">Feedback and Improvement</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="student-lostAndFound.php">Lost and Found</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Safety and Security</a></li>
                        </ul>
                    </li>
                    <!--Learning and Academics-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Learning
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="http://localhost/bit-102/1%20-%20Admin%20side/needed%20files/lib.html">E-library</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Study Partner</a></li>
                        </ul>
                    </li>
                    <!--Campus Life-->
                    <li class="nav-item">
                        <a class="nav-link" href="student-campusLife.html">Campus Life</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="http://localhost/bit-102/2%20-%20Login/log_out_form.php">Log out</a>
                  </li>
                  </ul>
                </div>
              </div>
            </div>
          </nav>
      </div>
        
    </body>
</html>