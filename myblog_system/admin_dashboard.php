<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include('db.php');

// 获取所有文章
$query = $pdo->query("SELECT * FROM articles ORDER BY time_at DESC");
$articles = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员后台</title>
    <style>
        /* 基本样式 */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #444;
        }

        h2 {
            background-color: #FFB6C1; /* 淡粉色 */
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 2em;
            margin: 0;
        }

        /* 退出登录链接 */
        p a {
            font-size: 1.2em;
            color: #FF69B4; /* 粉色 */
            text-decoration: none;
            margin: 10px 0;
        }

        p a:hover {
            color: #D44E8D;
        }

        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* 表格样式 */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #e1e1e1;
        }

        th {
            background-color: #FFB6C1; /* 淡粉色 */
            color: white;
        }

        td {
            background-color: #fff;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        /* 编辑按钮 */
        td a {
            display: inline-block;
            background-color: #FF69B4; /* 粉红色 */
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        td a:hover {
            background-color: #d44e8d;
        }

        /* 发布新文章按钮 */
        h3 a {
            display: inline-block;
            padding: 12px 24px;
            background-color: #FF69B4;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.2em;
            transition: background-color 0.3s;
        }

        h3 a:hover {
            background-color: #d44e8d;
        }
    </style>
</head>
<body>

    <h2>管理员后台</h2>

    <div class="container">
        <p><a href="logout.php">退出登录</a></p>

        <h3>所有文章</h3>
        <table>
            <thead>
                <tr>
                    <th>标题</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($article['title']); ?></td>
                        <td><?php echo $article['time_at']; ?></td>
                        <td><a href="edit_article.php?id=<?php echo $article['id']; ?>">编辑</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3><a href="publish.php">发布新文章</a></h3>
    </div>

</body>
</html>
