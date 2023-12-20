<?php
// Kết nối đến cơ sở dữ liệu (sử dụng PDO cho bảo mật)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Kiểm tra xem có dữ liệu được gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment'])) {
    // Lấy dữ liệu từ form
    $eventId = $_POST['event_id'];
    $comment = $_POST['comment'];

    // Thực hiện truy vấn SQL để thêm bình luận vào bảng comment
    $stmt = $pdo->prepare("INSERT INTO comment (event_id, comment) VALUES (:event_id, :comment)");
    $stmt->bindParam(':event_id', $eventId);
    $stmt->bindParam(':comment', $comment);

    try {
        $stmt->execute();
        echo "Bình luận của bạn đã được thêm thành công!";
    } catch (PDOException $ex) {
        echo "Lỗi: " . $ex->getMessage();
    }
} else {
    // Nếu không có dữ liệu gửi từ form, chuyển hướng về trang chính
    header("Location: index.php");
    exit();
}
?>
