<?php
// Kết nối đến cơ sở dữ liệu (sử dụng PDO cho bảo mật)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=your_database_name', 'your_username', 'your_password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Thực hiện truy vấn SQL để kiểm tra đăng nhập
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Kiểm tra xem có người dùng nào khớp hay không
    if ($stmt->rowCount() > 0) {
        // Đăng nhập thành công
        session_start();
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Điều hướng đến trang chính sau khi đăng nhập
        exit();
    } else {
        // Đăng nhập thất bại
        header("Location: login.php?error=1"); // Redirect với mã lỗi
        exit();
    }
}
?>