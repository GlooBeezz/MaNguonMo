<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash mật khẩu

    // Kết nối đến cơ sở dữ liệu
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Thực hiện truy vấn SQL để kiểm tra xem tài khoản đã tồn tại chưa
        $stmt = $pdo->prepare("SELECT * FROM user WHERE tai_khoan = :tai_khoan");
        $stmt->bindParam(':tai_khoan', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Tài khoản đã tồn tại. Vui lòng chọn một tài khoản khác.";
        } else {
            // Nếu tài khoản chưa tồn tại, thêm người dùng mới vào cơ sở dữ liệu
            $insertStmt = $pdo->prepare("INSERT INTO user (tai_khoan, mat_khau) VALUES (:tai_khoan, :mat_khau)");
            $insertStmt->bindParam(':tai_khoan', $username);
            $insertStmt->bindParam(':mat_khau', $password);

            if ($insertStmt->execute()) {
                echo "Đăng ký thành công!";
            } else {
                echo "Đăng ký thất bại. Vui lòng thử lại.";
            }
        }
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Đăng ký</h2>
            <form method="post" action="register.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Tài khoản</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="register">Đăng ký</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
