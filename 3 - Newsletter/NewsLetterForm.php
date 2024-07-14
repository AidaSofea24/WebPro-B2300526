<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Newsletter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            position: relative;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .form-container input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        .form-container .message {
            display: none;
            margin-top: 20px;
            color: #28a745;
        }
        .form-container img.logo {
            max-width: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <img src="logo.png" alt="Logo" class="logo">
        <h2>Subscribe to our Newsletter</h2>
        <form id="subscription-form" action="NewsLetterFormSend.php" method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit" name="send">Subscribe</button>
            <input type="hidden" name="subject" value="Thank you for subscribing to Our Newsletter!">
            <input type="hidden" name="message" value="Hey there! Thanks for subscribing to our Newsletter! This is a great Milestone for us!">
        </form>
        <div class="message" id="success-message">Thank you for subscribing!</div>
    </div>

    <script>
        document.getElementById('subscription-form').addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('success-message').style.display = 'block';
            setTimeout(function() {
                document.getElementById('subscription-form').submit();
            }, 2000);
        });
    </script>
</body>
</html>
