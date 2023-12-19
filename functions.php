<?php
// Kết nối đến cơ sở dữ liệu (sử dụng PDO cho bảo mật)
function connectDB() {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=your_database_name', 'your_username', 'your_password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Thêm sự kiện mới vào cơ sở dữ liệu
function addEvent($title, $description, $image) {
    $pdo = connectDB();
    
    $stmt = $pdo->prepare("INSERT INTO events (title, description, image) VALUES (:title, :description, :image)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $image);

    return $stmt->execute();
}

// Xóa sự kiện khỏi cơ sở dữ liệu
function deleteEvent($eventId) {
    $pdo = connectDB();

    $stmt = $pdo->prepare("DELETE FROM events WHERE id = :id");
    $stmt->bindParam(':id', $eventId);

    return $stmt->execute();
}
?>