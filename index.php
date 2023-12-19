<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đấu trường nhân phẩm - thắng thua tại nút D</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://images.contentstack.io/v3/assets/blt76b5e73bfd1451ea/blt4e67ae6bea71c31b/6557d3ded6b2f51bf0534b2f/RG_REMIX_RUMBLE_SET_OVERVIEW_WEBSITE_HEADER_WEB_IMAGE_1200X600_(1).jpg?quality=90'); /* Thay đổi thành đường dẫn của ảnh bạn muốn sử dụng */
            background-size: cover;
            background-attachment: fixed;
            margin: 0; /* Loại bỏ margin mặc định */
        }
        hr.white-line {
        border-color: white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/index.php">Đấu trường nhân phẩm - thắng thua tại nút D</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="login.php">Đăng nhập ở đây</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="row pt-5">
    <div class="col-sm-2"></div>
    <div class="col-sm-8 display-1 text-center text-info">Các sự kiện gần đây</div>
    <div class="col-sm-2"></div>
</div>
<hr class="white-line">
<div class="row">
    <?php
   
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "blog";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    // Truy vấn SQL để lấy dữ liệu từ bảng 'event'
    $sql = "SELECT id, nguon_anh, tieu_de, mo_ta FROM event";
    mysqli_set_charset($conn, "utf8mb4");
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card">';
            echo '<img src="' . $row['nguon_anh'] . '" class="card-img-top" alt="Event Image">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['tieu_de'] . '</h5>';
            echo '<p class="card-text">' . $row['mo_ta'] . '</p>';
            echo '<a href="event.php?id=' . $row['id'] . '" class="btn btn-primary">Ghé lại xem sao?</a>';
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
</div>
<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4>Có thể kiếm mình tại:</h4>
                <p>Email: khongranhderepemail@gmail.com</p>
                <p>Phone: 0902ngaymainoitiep</p>
            </div>
            <div class="col-md-6">
                <h4>Tăng thêm tương tác cho tui tại:</h4>
                <p>Phây sờ búc</p>
                <p>now X - ex ConChimXanh</p>
                <p>In sờ ta</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
