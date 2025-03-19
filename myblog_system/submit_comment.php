<?php
// 引入数据库连接
include 'db.php';

// 获取评论数据
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['article_id'], $_POST['commenter_name'], $_POST['comment_content'])) {
    $article_id = (int)$_POST['article_id'];
    $commenter_name = mysqli_real_escape_string($conn, $_POST['commenter_name']);
    $comment_content = mysqli_real_escape_string($conn, $_POST['comment_content']);

    // 插入评论到数据库
    $sql = "INSERT INTO comments (article_id, commenter_name, content,time_at) VALUES ('$article_id', '$commenter_name', '$comment_content',NOW())";
    
    if ($conn->query($sql) === TRUE) {
        echo '评论提交成功';
    } else {
        echo '评论提交失败: ' . $conn->error;
    }

    $conn->close();
} else {
    echo '无效的请求';
}
?>
