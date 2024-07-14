<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Send Email</title>
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
            max-width: 600px;
            width: 100%;
            text-align: center;
            position: relative;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .form-container input, .form-container textarea, .form-container select {
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
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Send Email to Users</h2>
        <form id="email-form" action="adminNewsletterSend.php" method="post" enctype="multipart/form-data">
            <label for="recipients">Select Recipients:</label>
            <select id="recipients" name="recipients" required>
                <option value="all">All Users</option>
                <option value="specific">Specific Users</option>
            </select>
            <div id="specific-users" style="display: none;">
                <!-- Dynamically generated list of users will be inserted here by JavaScript -->
            </div>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" placeholder="Message" required></textarea>
            <input type="file" name="attachment">
            <button type="submit" name="send">Send Email</button>
        </form>
        <div class="message" id="success-message">Email sent successfully!</div>
    </div>

    <script>
        document.getElementById('recipients').addEventListener('change', function() {
            if (this.value === 'specific') {
                document.getElementById('specific-users').style.display = 'block';
            } else {
                document.getElementById('specific-users').style.display = 'none';
            }
        });

        document.getElementById('email-form').addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('success-message').style.display = 'block';
            setTimeout(function() {
                document.getElementById('email-form').submit();
            }, 2000);
        });

        // Fetch users from the database and populate the specific users list
        fetch('fetch_users.php')
            .then(response => response.json())
            .then(data => {
                let usersContainer = document.getElementById('specific-users');
                data.users.forEach(user => {
                    let checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'user_ids[]';
                    checkbox.value = user.email;
                    checkbox.id = `user_${user.id}`;
                    let label = document.createElement('label');
                    label.htmlFor = `user_${user.id}`;
                    label.textContent = user.email;
                    usersContainer.appendChild(checkbox);
                    usersContainer.appendChild(label);
                    usersContainer.appendChild(document.createElement('br'));
                });
            });
    </script>
</body>
</html>
