<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alert</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Modal Template -->
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="alertModalLabel">Notification</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modalMessage">
            <!-- Message goes here -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>

    <script>
    function showModal(message, redirectUrl) {
        document.getElementById('modalMessage').innerText = message;
        $('#alertModal').modal('show');
        $('#alertModal').on('hidden.bs.modal', function () {
            window.location.href = redirectUrl;
        });
    }
    </script>

    <?php
    if (isset($_GET['message']) && isset($_GET['redirect'])) {
        $message = $_GET['message'];
        $redirect = $_GET['redirect'];
        echo "<script>
        showModal('$message', '$redirect');
        </script>";
    }
    ?>
</body>
</html>
