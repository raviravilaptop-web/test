<?php
// Basic server info
$phpVersion = phpversion();
$serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown';
$loadedExtensions = get_loaded_extensions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Server Test | PHP Status</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #2b5876, #4e4376);
            min-height: 100vh;
            color: white;
        }
        .card {
            border-radius: 20px;
        }
        .header-title {
            font-size: 2.3rem;
            font-weight: 700;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="header-title">🚀 PHP Server Test Page</h1>
        <p class="lead">Check your server configuration & PHP status</p>
    </div>

    <div class="row justify-content-center">

        <!-- PHP Version -->
        <div class="col-md-6 mb-4">
            <div class="card shadow p-4 text-dark">
                <h4>🧩 PHP Version</h4>
                <hr>
                <p class="fw-bold text-primary" style="font-size: 1.2rem;">
                    <?php echo $phpVersion; ?>
                </p>
            </div>
        </div>

        <!-- Server Software -->
        <div class="col-md-6 mb-4">
            <div class="card shadow p-4 text-dark">
                <h4>🖥 Server Software</h4>
                <hr>
                <p class="fw-bold text-success" style="font-size: 1.2rem;">
                    <?php echo $serverSoftware; ?>
                </p>
            </div>
        </div>

        <!-- Loaded extensions -->
        <div class="col-md-12 mb-4">
            <div class="card shadow p-4 text-dark">
                <h4>📦 Loaded PHP Extensions</h4>
                <hr>
                <div style="max-height: 200px; overflow-y: auto;">
                    <ul>
                        <?php foreach ($loadedExtensions as $ext): ?>
                            <li><?php echo $ext; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- phpinfo button -->
        <div class="col-md-12 text-center mt-4">
            <a href="?info=1" class="btn btn-light btn-lg px-4 shadow">Show Full phpinfo()</a>
        </div>

        <?php if (isset($_GET['info'])): ?>
            <div class="col-md-12 mt-5 bg-white p-4 rounded shadow text-dark">
                <?php phpinfo(); ?>
            </div>
        <?php endif; ?>

    </div>
</div>

</body>
</html>
