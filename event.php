
<?php
include_once 'functions.php';

// Xử lý khi người dùng yêu cầu thêm sự kiện
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addEvent'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

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
        <a class="navbar-brand" href="#">Đấu trường nhân phẩm - thắng thua tại nút D</a>
    </div>
</nav>

    // Gọi hàm thêm sự kiện
    if (addEvent($title, $description, $image)) {
        echo "Event added successfully!";
    } else {
        echo "Error adding event!";
    }
}

// Xử lý khi người dùng yêu cầu xóa sự kiện
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteEvent'])) {
    $eventId = $_POST['eventId'];

    // Gọi hàm xóa sự kiện
    if (deleteEvent($eventId)) {
        echo "Event deleted successfully!";
    } else {
        echo "Error deleting event!";
    }
}
?>