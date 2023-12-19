<?php
// Kết nối đến cơ sở dữ liệu (sử dụng PDO cho bảo mật)
function connectDB() {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Thêm sự kiện mới vào cơ sở dữ liệu
function addEvent($title, $description, $image) {
    $pdo = connectDB();
    
    $stmt = $pdo->prepare("INSERT INTO events (tieu_de, mo_ta, nguon_anh) VALUES (:tieu_de, :mo_ta, :nguon_anh)");
    $stmt->bindParam(':tieu_de', $title);
    $stmt->bindParam(':mo_ta', $description);
    $stmt->bindParam(':nguon_anh', $image);

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
