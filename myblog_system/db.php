<?php
$servername = "localhost"; // 数据库服务器地址，通常是 localhost
$username = "root"; // 数据库用户名
$password = "root"; // 数据库密码，通常是空的（除非你设置了密码）
$dbname = "myblog_system"; // 你刚创建的数据库名

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("数据库连接失败: " . $conn->connect_error);
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("数据库连接失败: " . $e->getMessage());
}

?>
