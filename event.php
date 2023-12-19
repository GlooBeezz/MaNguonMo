<?php
include_once 'functions.php';

// Xử lý khi người dùng yêu cầu thêm sự kiện
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addEvent'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

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