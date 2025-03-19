<?php
//在代码开头添加以下代码，启用错误显示
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "myblog_system";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: ". $conn->connect_error);
}

// 编写并执行SQL查询语句
$result = $conn -> query("select * from cost_budget");
// 将查询结果转换为数组
$equipment = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $equipment[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>装备费用预算清单</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: space-around;
            padding: 20px;
            background-color: rgb(173, 216, 230); 
        }

        img {
            max-width: 400px;
        }

        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div>
        <img src="images/风景图.jpg" alt="风景图">
        <h2>趁年轻出发吧</h2>
        <p>少年</p>
    </div>
    <div>
        <h2>装备费用预算清单</h2>
        <table>
            <thead>
                <tr>
                    <th>装备（新手版）</th>
                    <th>费用</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipment as $item) {?>
                    <tr>
                        <td><?php echo $item['equipment_name'];?></td>
                        <td><?php echo $item['price'];?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</body>

</html>
<?php
// 关闭数据库连接
$conn->close();
?>