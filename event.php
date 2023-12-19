<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đấu trường nhân phẩm - thắng thua tại nút D</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Đấu trường nhân phẩm - thắng thua tại nút DGame Events</a>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <?php
            // Fetch event details based on $_GET['id']
            $eventId = $_GET['id'] ?? 0; // Replace with proper validation
            $eventDetails = []; // Replace with your database query

            if ($eventDetails) {
                echo '<h2>' . $eventDetails['title'] . '</h2>';
                echo '<p>' . $eventDetails['description'] . '</p>';
            } else {
                echo '<p>Event not found.</p>';
            }
            ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
