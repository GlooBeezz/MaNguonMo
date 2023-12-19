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
        <a class="navbar-brand" href="/index.php">Đấu trường nhân phẩm - thắng thua tại nút D</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Đăng nhập ở đây</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
// Thực hiện kết nối đến cơ sở dữ liệu
$servername = "localhost"; // Thay thế bằng tên máy chủ MySQL của bạn
$username = "root"; // Thay thế bằng tên người dùng MySQL của bạn
$password = ""; // Thay thế bằng mật khẩu của bạn
$dbname = "blog"; // Thay thế bằng tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Truy vấn SQL để lấy dữ liệu từ bảng 'event'
$sql = "SELECT id, nguon_anh, tieu_de, mo_ta FROM event";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card">';
        echo '<img src="' . $row['nguon_anh'] . '" class="card-img-top" alt="Event Image">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['tieu_de'] . '</h5>';
        echo '<p class="card-text">' . $row['mo_ta'] . '</p>';
        echo '<a href="event.php?id=' . $row['id'] . '" class="btn btn-primary">Details</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "Không có sự kiện nào.";
}
$conn->close();
?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
