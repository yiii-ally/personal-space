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

$result = $conn->query("select * from climbing_equipment");

?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>户外装备清单</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff; /* 轻柔的背景色 */
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            border-bottom: 4px solid #16a085;
        }

        h1 {
            font-size: 36px;
            letter-spacing: 1px;
        }

        section {
            margin: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .equipment_list img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 5px;
            border-bottom: 2px solid #16a085;
        }

        ul {
            padding-left: 20px;
            list-style: disc;
            font-size: 18px;
        }

        li {
            margin-bottom: 10px;
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #2c3e50;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        footer p {
            margin: 0;
            font-size: 16px;
        }

        a {
            color: #16a085;
            text-decoration: none;
        }

        a:hover {
            color: #2c3e50;
        }

    </style>
</head>
<body>

<header>
    <h1>户外装备清单</h1>
</header>

<section class="equipment_list">
    <img src="images/户外装备清单.jpg" alt="装备示例">
</section>

<section>
    <h2>穿着用品</h2>
    <?php
    if ($result->num_rows > 0) {
        // 输出数据
        while($row = $result->fetch_assoc()) {
            echo "<ul><li>" . $row["户外装备清单"] . "</li></ul>"; 
        }
    } else {
        echo "0 结果";
    }
    ?>
</section>

<footer>
    <p>户外装备清单</p>
</footer>

</body>
</html>
