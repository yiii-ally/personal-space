<?php
session_start(); // 启动会话
session_unset(); // 清空会话变量
session_destroy(); // 销毁会话
header('Location: index.php'); // 跳转到首页
exit();
?>
