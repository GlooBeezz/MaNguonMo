<?php
// Kết nối đến cơ sở dữ liệu (sử dụng PDO cho bảo mật)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tai_khoan = $_POST['username'];
    $mat_khau = $_POST['password'];

    // Thực hiện truy vấn SQL để kiểm tra đăng nhập
    $stmt = $pdo->prepare("SELECT * FROM user WHERE tai_khoan = :tai_khoan AND mat_khau = :mat_khau");
    $stmt->bindParam(':tai_khoan', $tai_khoan);
    $stmt->bindParam(':mat_khau', $mat_khau);
    $stmt->execute();

    // Kiểm tra xem có người dùng nào khớp hay không
    if ($stmt->rowCount() > 0) {
        // Đăng nhập thành công
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION['user'] = $user;
        header("Location: index.php"); // Điều hướng đến trang chính sau khi đăng nhập
        exit();
    } else {
        // Đăng nhập thất bại
        header("Location: login.php?error=1"); // Redirect với mã lỗi
        exit();
    }
}
?>
