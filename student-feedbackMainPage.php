<?php
  session_start();

  // Database connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "BIT102";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  // Assume user is already logged in and student_id is stored in session
  $student_id = $_SESSION['student_id'];
  

  // Fetch polls and votes
  $poll_sql = "SELECT * FROM poll";
  $poll_result = $conn->query($poll_sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Feedback and Improvement Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesElain.css">
  </head>

  <body>
    <div class="py-5 text-center" style="background-image: url('campus.png'); background-size: cover;">
      <div class="container">
        <div class="row">
          <div class="bg-white p-5 mx-auto col-md-8 col-10">
            <h3 class="display-3">Feedback and Improvement Center</h3>
            <p class="mb-3 lead">Let's improve together!</p>
            <p class="mb-4">Welcome to our Student Feedback and Improvement Center! This is where student voices truly matter. Share your valuable feedback, suggestions, and ideas to influence the future direction of our university. Together, let's unleash the full potential of our institution. Be part of the solution!</p> 
          </div>
        </div>
      </div>
    </div>

    <!--✅nav (start poll, vote now, suggestion box)-->
    <section>
      <div class="container py-5">
        <div class="mx-auto col-lg-10">
          <h1 class="text-center">Choose your way</h1>
          <div class="row">
            <div class="col-md-4 px-5 mt-3"> <i class="d-block fa fa-stop-circle fa-4x mb-3 text-muted"></i>
              <h4>Your Voice, Your Poll</h4>
              <p class="mb-3">Create a new poll to share your ideas, gather feedback, and amplify student voices. Your poll is a powerful tool for driving positive change within our university.</p> 
              <button class="btn btn-outline-dark mt-3" type="button" data-toggle="collapse" data-target="#collapsePoll" aria-expanded="false" aria-controls="collapsePoll">
                  Start Poll &raquo
              </button>
            </div>
            <div class="col-md-4 px-5 mt-3"> <i class="d-block fa fa-stop-circle fa-4x mb-3 text-muted"></i>
              <h4>Make Your Choice</h4>
              <p class="mb-3">Make your voice heard by participating in our current voting opportunities. Your participation is key to driving positive outcomes. Join us and make a difference now!</p> 
              <button class="btn btn-outline-dark mt-3" type="button" data-toggle="collapse" data-target="#collapseVote" aria-expanded="false" aria-controls="collapseVote">
                  Vote Now &raquo
              </button>
            </div>
            <div class="col-md-4 px-5 mt-3">
              <i class="d-block fa fa-stop-circle-o fa-4x mb-3 text-muted"></i>
              <h4>Suggestion Box</h4>
              <p class="mb-3">Let your creativity flow and contribute to making our campus community even better! Let's work together to make our university an even better place for everyone.</p> 
              <button class="btn btn-outline-dark mt-3" type="button" data-toggle="collapse" data-target="#collapseSuggest" aria-expanded="false" aria-controls="collapseSuggest">
                  Suggest Now &raquo
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--✅Hidden section for the collapsePoll -->
    <section>
      <div class="collapse mt-3" id="collapsePoll">
          <div class="py-5 bg-light" >
            <div class="container">
              <div class="row">
                <div class="mx-auto text-center col-lg-6">
                </div>
              </div>
              <!--form-->
              <form action="student-newPoll.php" method="POST">
                <section class="order-form m-4">
                  <div class="container pt-4">
                      <div class="row">
                          <div class="col-12 px-4">
                              <h1>Suggest A New Poll</h1>
                              <hr class="mt-1" />
                          </div>
                
                          <div class="col-12">
                              <div class="row mx-4">
                                  <div class="col-12">
                                      <label class="order-form-label" for="firstName">Name</label>
                                  </div>
                                  <div class="col-sm-6">
                                      <div data-mdb-input-init class="form-outline">
                                          <input type="text" id="firstName" class="form-control order-form-input" name="firstName" placeholder="First" required/>
                                      </div>
                                  </div>
                                  <div class="col-sm-6 mt-2 mt-sm-0">
                                      <div data-mdb-input-init class="form-outline">
                                          <input type="text" id="lastName" class="form-control order-form-input" name="lastName" placeholder="Last" required/>
                                      </div>
                                  </div>
                              </div>
                
                              <div class="row mt-3 mx-4">
                                  <div class="col-12">
                                      <label class="order-form-label" for="topic">Poll Topic</label>
                                  </div>
                                  <div class="col-12">
                                      <div data-mdb-input-init class="form-outline">
                                          <input type="text" id="topic" class="form-control order-form-input" name="topic" required/>
                                      </div>
                                  </div>
                              </div>
                
                              <div class="row mt-3 mx-4">
                                  <div class="col-12">
                                    <label class="order-form-label" for="description">Description</label>
                                  </div>
                                  <div class="col-12">
                                    <div data-mdb-input-init class="form-outline">
                                      <textarea class="form-control" id="description" rows="4" placeholder="Message" name="description" required></textarea>
                                    </div>
                                  </div>
                              </div>
                
                              <div class="row mt-3 mx-4">
                                  <div class="col-12">
                                      <label class="order-form-label">Poll option</label>
                                  </div>
                                  <div class="col-12">
                                      <div data-mdb-input-init class="form-outline">
                                          <input type="text" id="option1" class="form-control order-form-input" placeholder="Option 1" name="option1" required/>
                                      </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                      <div data-mdb-input-init class="form-outline">
                                          <input type="text" id="option2" class="form-control order-form-input" placeholder="Option 2" name="option2" required/>
                                      </div>
                                  </div>
                                  <div class="col-12 mt-2">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="text" id="option3" class="form-control order-form-input" placeholder="Option 3" name="option3" required/>
                                    </div>
                                </div>
                              </div>

                              <div class="row mt-3">
                                  <div class="col-12">
                                      <button  type="submit" data-mdb-button-init id="btnSubmit" data-mdb-ripple-init class="btn btn-primary d-block mx-auto btn-submit">Submit</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </section>
              </form>
            </div>
          </div>
      </div> 
    </section>
    <!-- end of hidden section for the collapsePoll -->

    <!--✅Hidden section for the collapseVote-->
    <section>
      <div class="collapse mt-3" id="collapseVote">
        <div class="container mt-4">
          <?php
            if ($poll_result->num_rows > 0) {
                while ($poll_row = $poll_result->fetch_assoc()) {
                    $pollID = $poll_row["id"];
                    $topic = $poll_row["topic"];
                    $description = $poll_row["description"];
                    $option1 = $poll_row["option1"];
                    $option2 = $poll_row["option2"];
                    $option3 = $poll_row["option3"];

                    // Check if the student has already voted on this poll
                    $vote_sql = "SELECT * FROM voteResult WHERE studentID = ? AND pollID = ?";
                    $stmt = $conn->prepare($vote_sql);
                    $stmt->bind_param("ii", $student_id, $pollID);
                    $stmt->execute();
                    $vote_result = $stmt->get_result();

                    $has_voted = $vote_result->num_rows > 0;
                    $stmt->close();
                    ?>

                    <div class="mx-0 mx-sm-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="far fa-file-alt fa-4x mb-3 text-primary"></i>
                                    <p><strong><?php echo $topic; ?></strong></p>
                                    <p><?php echo $description; ?></p>
                                </div>
                                <hr />
                                <form class="px-4" action="student-submitVote.php" method="post">
                                    <input type="hidden" name="pollID" value="<?php echo $pollID; ?>" />
                                    <input type="hidden" name="studentID" value="<?php echo $student_id; ?>" />
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="voteOption" value="option1" id="radio2Example1" <?php echo $has_voted ? 'disabled' : ''; ?> />
                                        <label class="form-check-label" for="radio2Example1"><?php echo $option1; ?></label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="voteOption" value="option2" id="radio2Example2" <?php echo $has_voted ? 'disabled' : ''; ?> />
                                        <label class="form-check-label" for="radio2Example2"><?php echo $option2; ?></label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="voteOption" value="option3" id="radio2Example3" <?php echo $has_voted ? 'disabled' : ''; ?> />
                                        <label class="form-check-label" for="radio2Example3"><?php echo $option3; ?></label>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary" <?php echo $has_voted ? 'disabled' : ''; ?>>Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

        <?php
                }
            } else {
                echo "<p>No polls found.</p>";
            }

            $conn->close();
        ?>
        </div>
      </div>
    </section>
    <!-- end of hidden section for the collapseVote -->

    <!--✅Hidden section for the collapseSuggest-->
	  <section class="suggestionBoxStart text-center">
      <div class="collapse mt-3" id="collapseSuggest">
        <br><br><br><br><br><br><br><br><br><br>
        <h1 class="suggestionBoxStartText">Let’s Improve Together</h1>
        <br><br><br><br><br><br><br><br><br><br><br>
        <!-- Image icon that acts as the button -->
        <a class="contactLink" href="#" id="showContactForm">
          <img src="https://img.icons8.com/?size=100&id=XlnNK4KTDHT7&format=png&color=000000" loading="lazy" width="Auto" height="55" class="bond-arrow"/>
        </a>
        <br><br><br><br><br><br><br><br>
      
        <!-- Hidden section for contact form -->
        <section id="contact-form" class="contact-section1">
            <div class="form-container">
                <h1 class="contact-header text-center">We'd love to hear from you</h1>
                <form action="student-suggestionBox.php" method="POST" style="max-width: 80%;">
                    <div class="form-group">
                        <label class="contact-form">Please share your</label>
                        <input class="contact-form name-field" id="name" type="text" name="name" placeholder="name" required>
                        <label class="contact-form-comma">,</label>
                    </div>
                    <div class="form-group">
                        <label class="contact-form">and</label>
                        <input class="contact-form email-field" id="email" type="text" name="email" placeholder="email" required>
                    </div>
                    <div class="form-group">
                        <textarea class="contact-form message-field" id="message" name="message" placeholder="your message." required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="contact-form">Let’s figure out what project we can do together.</label>
                    </div><br><br>
                    <div class="form-group">
                        <button type="submit" class="contact-form btn btn-light">Submit</button>
                    </div>
                </form>
          </div>
        </section>
      </div>
    </section>
    <!-- End of hidden section for contact form -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    
    <!--when opening one section automatically closes the others-->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const collapseButtons = document.querySelectorAll('[data-toggle="collapse"]');
        
        collapseButtons.forEach(button => {
          button.addEventListener('click', function() {
            const target = this.getAttribute('data-target');
            
            // Close all other collapse sections
            collapseButtons.forEach(otherButton => {
              if (otherButton.getAttribute('data-target') !== target) {
                const otherTarget = otherButton.getAttribute('data-target');
                $(otherTarget).collapse('hide'); // Using Bootstrap's collapse method
              }
            });
    
            // After closing other sections, handle scrolling to the opened section
            $(target).on('shown.bs.collapse', function () {
              // Scroll to the opened section
              $('html, body').animate({
                scrollTop: $(target).offset().top
              }, 500);
    
              // Focus on the opened section for accessibility
              $(target).focus();
            });
          });
        });
      });
    </script>

    <!-- Javascript for hidden section for contact form -->
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				var showContactFormButton = document.getElementById('showContactForm');
				var contactFormSection = document.getElementById('contact-form');
		
				showContactFormButton.addEventListener('click', function(event) {
					event.preventDefault(); // Prevent default anchor behavior
					contactFormSection.style.display = 'block'; // Show the contact form
					// Optionally, you can scroll to the contact form for better user experience
					contactFormSection.scrollIntoView({ behavior: 'smooth' });
				});
			});
		</script>
  </body>
</html>