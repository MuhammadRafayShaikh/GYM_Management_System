<!-- resources/views/mail/member.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title> <!-- Using the subject as the title -->
    <style>
        /* Same CSS as before for styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
            color: #333333;
            line-height: 1.6;
        }

        .content h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #777777;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: #ffffff;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>{{ $subject }}</h1> <!-- Displaying the subject in the header -->
        </div>
        <div class="content">
            <h2>Hello,</h2>
            <p>{{ $msg }}</p> <!-- Displaying the message content here -->
            <a href="{{ url('/') }}" class="button">Visit Our Website</a>
            <p>Thank you,<br>Our Gym Team</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Our Gym. All rights reserved.
        </div>
    </div>
</body>

</html>
