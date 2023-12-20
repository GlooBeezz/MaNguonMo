<?php
// Kết nối đến cơ sở dữ liệu (sử dụng PDO cho bảo mật)
function connectDB() {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET NAMES utf8');
        return $pdo;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Lấy thông tin chi tiết sự kiện từ cơ sở dữ liệu
function getEventDetails($eventId) {
    $pdo = connectDB();
    
    $stmt = $pdo->prepare("SELECT * FROM event WHERE id = :id");
    $stmt->bindParam(':id', $eventId);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Lấy danh sách bình luận từ cơ sở dữ liệu
function getComments($eventId) {
    $pdo = connectDB();

    $stmt = $pdo->prepare("SELECT * FROM comment WHERE event_id = :event_id");
    $stmt->bindParam(':event_id', $eventId);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Thêm bình luận vào cơ sở dữ liệu
// Thêm bình luận vào cơ sở dữ liệu
function addComment($eventId, $comment) {
    $pdo = connectDB();

    $stmt = $pdo->prepare("INSERT INTO comment (event_id, comment) VALUES (:event_id, :comment)");
    $stmt->bindParam(':event_id', $eventId);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR); // Đặt kiểu dữ liệu là chuỗi

    return $stmt->execute();
}

// Kiểm tra xem có sự kiện nào được chọn không
$eventId = isset($_GET['id']) ? $_GET['id'] : null;

// Lấy thông tin chi tiết sự kiện
$event = getEventDetails($eventId);

// Lấy danh sách bình luận
$comments = $event ? getComments($eventId) : [];

?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sự Kiện</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <?php if ($event): ?>
                <img src='<?= $event['nguon_anh'] ?>' class="img-thumbnail"/>
                <h2><?= $event['tieu_de'] ?></h2>
                <p><?= $event['mo_ta'] ?></p>
            <?php else: ?>
                <p>Sự kiện không tồn tại.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-8">
            <h4>Bình Luận</h4>
            <?php if ($comments): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="card mb-2">
                        <div class="card-body">
                            <?= $comment['comment'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có bình luận nào.</p>
            <?php endif; ?>

            <form action="process_comment.php" method="post">
                <div class="mb-3">
                    <label for="comment" class="form-label">Bình luận của bạn:</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <input type="hidden" name="event_id" value="<?= $eventId ?>">
                <button type="submit" class="btn btn-primary">Gửi Bình Luận</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
