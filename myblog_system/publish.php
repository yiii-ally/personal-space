<?php
// 引入数据库连接
include 'db.php';

// 如果表单提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取表单数据
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $time_at = time(); // 获取当前的 Unix 时间戳

    // 将 Unix 时间戳转换为 DATETIME 格式
    $time_at_formatted = date('Y-m-d H:i:s', $time_at);

    // 使用 SQL 插入文章数据
    $sql = "INSERT INTO articles (title, content, author, time_at) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $content, $author, $time_at_formatted);

    // 执行 SQL 查询并反馈结果
    if ($stmt->execute()) {
        echo "<p>文章发布成功！</p>";
    } else {
        echo "<p>发布文章失败: " . $stmt->error . "</p>";
    }

    // 关闭语句
    $stmt->close();
}

// 关闭数据库连接
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>发布文章</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            height: 100%;
            background: url('images/发布文章.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: flex-start; /* 改为左对齐 */
            align-items: center;
            color: #fff;
        }

        h1 {
            font-size: 3rem;
            text-align: center;
            margin-bottom: 1rem;
            color: #f8c8d1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            position: relative;
            display: flex;
            flex-direction: column;
            margin-left: 20px; /* 让表单靠左 */
        }

        label {
            font-size: 1.2rem;
            margin-bottom: 8px;
            display: block;
            color: #f8a1b5;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 10px;
            border: 1px solid #f0c5d5;
            font-size: 1rem;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #f8a1b5;
        }

        textarea {
            resize: none;
            min-height: 150px;
        }

        input[type="submit"] {
            background-color: #f8a1b5;
            color: #fff;
            padding: 15px 25px;
            border-radius: 30px;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #f8c8d1;
            transform: scale(1.1);
        }

        input[type="submit"]:active {
            transform: scale(1);
        }

        .form-container p {
            text-align: center;
            font-size: 1.1rem;
            color: #f8a1b5;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>发布新文章</h1>
        <form method="POST" action="publish.php">
            <label for="title">标题:</label>
            <input type="text" id="title" name="title" required>

            <label for="content">内容:</label>
            <textarea id="content" name="content" rows="4" required></textarea>

            <label for="author">作者:</label>
            <input type="text" id="author" name="author" required>

            <input type="submit" value="发布文章">
        </form>
    </div>
</body>
</html>
