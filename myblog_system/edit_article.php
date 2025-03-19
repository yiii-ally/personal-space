<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('db.php');

// 检查是否传递了 id 参数
if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // 从数据库获取该文章的信息
    $sql = "SELECT * FROM articles WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $article_id, PDO::PARAM_INT);
    $stmt->execute();

    // 如果文章存在，获取其数据
    if ($stmt->rowCount() > 0) {
        $article = $stmt->fetch();
    } else {
        echo "文章未找到！";
        exit;
    }
} else {
    echo "无效的文章ID！";
    exit;
}

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // 更新数据库中的文章
    $update_sql = "UPDATE articles SET title = ?, content = ? WHERE id = ?";
    $update_stmt = $pdo->prepare($update_sql);
    $update_stmt->bindParam(1, $title);
    $update_stmt->bindParam(2, $content);
    $update_stmt->bindParam(3, $article_id, PDO::PARAM_INT);

    if ($update_stmt->execute()) {
        echo "文章修改成功！<br><a href='admin_dashboard.php'>返回管理页面</a>";
    } else {
        echo "修改文章失败，请重试！";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑文章</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"> <!-- 引入Google字体 -->

    <style>
        /* 页面整体样式 */
        body {
            font-family: 'Poppins', sans-serif;
            background: url('https://example.com/your-background-image.jpg') no-repeat center center fixed; /* 背景图链接 */
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #555;
        }

        /* 文章编辑区域 */
        .container {
            background-color: rgba(255, 255, 255, 0.8); /* 半透明背景 */
            width: 50%;
            margin: 100px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #FF69B4; /* 粉色 */
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        label {
            font-size: 1.1em;
            margin-bottom: 10px;
            display: block;
            color: #333;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 1em;
        }

        input[type="text"] {
            height: 40px;
        }

        textarea {
            height: 200px;
            resize: vertical;
        }

        button {
            background-color: #FF69B4;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 1.2em;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #FF1493; /* 深粉色 */
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #FF69B4;
        }

        /* 链接样式 */
        a {
            text-decoration: none;
            color: #FF69B4;
            font-weight: 600;
        }

        a:hover {
            color: #D44E8D;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>编辑文章</h2>

    <form action="edit_article.php?id=<?php echo $article['id']; ?>" method="POST">
        <div>
            <label for="title">文章标题:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
        </div>
        <div>
            <label for="content">文章内容:</label>
            <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($article['content']); ?></textarea>
        </div>
        <div>
            <button type="submit">提交修改</button>
        </div>
    </form>

    <div class="footer">
        <a href="admin_dashboard.php">返回管理页面</a>
    </div>
</div>

</body>
</html>
