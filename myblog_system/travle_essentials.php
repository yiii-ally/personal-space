<?php
$servername = "localhost"; // 数据库服务器地址
$username = "root"; // 数据库用户名
$password = "root"; // 数据库密码
$dbname = "myblog_system"; // 数据库名称
include_once 'db.php';
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: ". $conn->connect_error);
}

$result = $conn -> query("select * from travle_essentials");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>旅游必备物品清单</title>
    <style>
        body {
            background-color: #FFEB3B; /* 鲜艳的黄色背景 */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        h1 {
            font-size: 36px;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #FF9800;
            color: white;
            font-size: 18px;
        }

        td {
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* 响应式设计：小屏幕优化 */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }

            h1 {
                font-size: 28px;
            }

            th, td {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <h1>旅游必备物品清单</h1>
    <table>
        <thead>
            <tr>
                <th>序号</th>
                <th>类别</th>
                <th>具体物品</th>
                <th>数量</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1; // 初始化序号变量
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$i}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['item_name']}</td>
                        <td>{$row['quantity']}</td>
                      </tr>";
                $i++; // 每次循环序号自增
            }
           ?>
        </tbody>
    </table>
</body>

</html>
