<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing Page</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Poppins", sans-serif;
        }

        .box {
            background: white;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            text-align: center;
            animation: fadeIn 1.2s ease;
            width: 90%;
            max-width: 600px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-weight: 600;
            color: #333;
        }

        p {
            margin: 0;
            font-size: 18px;
            color: #555;
        }

        .footer-text {
            margin-top: 15px;
            font-size: 15px;
            color: #777;
            letter-spacing: 0.5px;
        }
    </style>
</head>

<body>
    <div class="box">
        <h1>Welcome to our Testing Page</h1>
        
        <p>Digital Division | Chief Secretariat</p>
        <p>North Western Province</p>

        <div class="footer-text">Responsive • Modern • Animated</div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
