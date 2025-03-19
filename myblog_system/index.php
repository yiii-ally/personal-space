<?php
// 引入数据库连接
include 'db.php';

// 查询所有文章，按时间倒序显示
$sql = "SELECT id, title, content, author, time_at FROM articles ORDER BY time_at DESC";
$result = $conn->query($sql);

// 存储文章数据
$articles = [];
if ($result->num_rows > 0) {
    while ($article = $result->fetch_assoc()) {
        $articles[] = $article;
    }
}
//查询评论（不提交评论部分）
//...其他代码
//$conn->close();关闭数据库
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>yiii_blog</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- 引入jQuery -->
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>导航</h2>
            <ul>
                <li><a href="Climbing_equipment.php">登山必备</a></li>
                <li><a href="travle_essentials.php">出行必备</a></li>
                <li><a href="cost_budget.php">费用预算</a></li>
                <li><a href="publish.php">发布文章</a></li>
                <li><a href="login.php">管理员</a></li>
            </ul>
        </div>

        <div class="content">
            <header>
                <div class="header-content">
                    <img src="images/touxiang.jpg" alt="头像" class="avatar">
                    <h1>yiii的博客</h1>
                </div>
            </header>

            <main>
                <section class="mingyan">
                    <h2>萨武神山</h2>
                    <p><strong>勇敢的人先享受世界！！！</strong></p>
                    <blockquote cite="https://www.kekeshici.com/mingyanmingju/waiguo/206447.html">“世界是一本书,<br>从不旅行的人等于只看了这本书的一页而已。”</blockquote>
                    <blockquote cite="#">人生不能重来,18岁只有一次。<br>用热烈而滚烫的青春去追逐自由！<br> 当登上雪山顶的时候，年轻和勇敢才真正显现！</blockquote>
                </section>

                <section class="articles">
                    <?php
                    if (!empty($articles)) {
                        foreach ($articles as $article) {
                            echo '
                            <div class="article" id="article-' . $article['id'] . '">
                                <h3>' . htmlspecialchars($article['title']) . '</h3>
                                <p>' . nl2br(htmlspecialchars($article['content'])) . '</p>
                                <div class="article-info">
                                    <span>发布时间: ' . (isset($article['time_at']) ? htmlspecialchars($article['time_at']) : '未知') . '</span>
                                    <span>发布者: ' . (isset($article['author']) ? htmlspecialchars($article['author']) : '未知') . '</span>
                                </div>';
                            
                            // 评论区
                            echo '
                                <div class="comments-section" id="comments-' . $article['id'] . '">
                                    <h4>评论区:</h4>';
                            
                            // 查询评论
                            $sql_comments = "SELECT commenter_name, content, time_at FROM comments WHERE article_id = " . $article['id'] . " ORDER BY time_at DESC";
                            $result_comments = $conn->query($sql_comments);
                            if ($result_comments->num_rows > 0) {
                                while ($comment = $result_comments->fetch_assoc()) {
                                    echo '<div class="comment">
                                            <p><strong>' . htmlspecialchars($comment['commenter_name']) . '</strong> (' . htmlspecialchars($comment['time_at']) . '):</p>
                                            <p>' . nl2br(htmlspecialchars($comment['content'])) . '</p>
                                          </div>';
                                }
                            } else {
                                echo '<p>暂无评论。</p>';
                            }

             // 评论表单应放在评论区之后
             echo '
             </div>

             <form class="comment-form" data-article-id="' . $article['id'] . '">
                 <label for="commenter_name">用户名:</label>
                 <input type="text" name="commenter_name" required>
                 <label for="comment_content">评论:</label>
                 <textarea name="comment_content" required></textarea>
                 <button type="submit">提交评论</button>
             </form>
         </div>';
                        }
                    } else {
                        echo '<p>暂无文章。</p>';
                    }
                    ?>
                </section>
            </main>

            <footer>
                <p>yiii_blog.</p>
            </footer>
        </div>
    </div>
    <script>
        // 使用AJAX提交评论
        $(document).ready(function () {
            // 监听评论表单提交
            $('.comment-form').on('submit', function (e) {
                e.preventDefault();  // 阻止表单默认提交

                var form = $(this);
                var articleId = form.data('article-id');
                var commenterName = form.find('input[name="commenter_name"]').val();
                var commentContent = form.find('textarea[name="comment_content"]').val();

                $.ajax({
                    url: 'submit_comment.php', // 处理评论提交的PHP脚本
                    type: 'POST',
                    data: {
                        article_id: articleId,
                        commenter_name: commenterName,
                        comment_content: commentContent
                    },
                    success: function (response) {
                        // 动态添加评论
                        var newComment = '<div class="comment"><p><strong>' + commenterName + '</strong>: </p><p>' + commentContent + '</p></div>';
                        $('#comments-' + articleId).append(newComment); // 添加到评论区底部
                        form.find('input[name="commenter_name"], textarea[name="comment_content"]').val(''); // 清空表单
                    },
                    error: function () {
                        alert('评论提交失败，请稍后再试！');
                    }
                });
            });
        });
    </script>

</body>
</html>
