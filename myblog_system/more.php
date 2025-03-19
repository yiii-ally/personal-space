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

$result = $conn -> query("select * from more");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>四姑娘大峰雪山攀登</title>
    <style>
        /* 全局样式 */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ffeb3b, #f8d7b5);
            color: #333;
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            line-height: 1.6;
        }

        h1, h2 {
            color: #fff;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        h2 {
            font-size: 1.5rem;
            margin-top: 0;
        }

        /* 内容容器 */
        .content {
            width: 90%;
            max-width: 1200px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .section {
            margin-bottom: 30px;
        }

        .section h2 {
            font-size: 1.8rem;
            color: #ff9800;
            margin-bottom: 10px;
        }

        .section p {
            font-size: 1rem;
            line-height: 1.8;
            color: #555;
        }

        .highlight {
            background-color: #fff8e1;
            padding: 5px 10px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #ff9800;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* 响应式设计 */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.3rem;
            }

            .content {
                padding: 15px;
            }

            table {
                font-size: 0.9rem;
            }
        }
        /* 图片控制 */
        .more1 img, .more2 img, .more3 img {
            width: 100%;
            max-width: 600px; /* 根据需要设置最大宽度 */
            height: auto;     /* 保持图片比例 */
            display: block;   /* 防止图片下方出现空隙 */
            margin: 0 auto;   /* 图片居中 */
        }
        .more1, .more2, .more3 {
    margin-bottom: 20px; /* 给每个section增加底部空间 */
        }

    </style>
</head>

<body>

    <h1>四姑娘大峰雪山攀登攻略</h1>
    
    <div class="content">
        <!-- 第一部分：零经验能否攀登雪山 -->
        <div class="section">
            <h2>零经验无体力能去爬雪山吗？</h2>
            <p>户外攀登者在初次尝试爬雪山时，往往受限于两大困难：零经验、体能缺乏。<br>
            缺乏经验，代表着很难判断该路段的危险程度、不知道如何选择适合的装备、也不知道遭遇恶劣天气时如何应对等，这些困难在城市里很难遭遇也更容易解决，但在攀登雪山时不懂这些专业问题往往是致命的。所以第一次爬，选择海拔低、坡度小、冰裂缝少、很少雪崩，安全系数高的雪山非常重要。</p>
            <p>体能缺乏也是个痛点。试想在氧气稀缺的高原，个人高反还没适应过来,就得一天内走上8个小时的徒步行程,这种马不停蹄的攀爬,随着海拔的上升，不仅体能消耗大，身体素质也赶不上，很多山友最后因为体能未完成登顶的情况，比比皆是。</p>
            <section class="more1">
            <img src="images/more1.jpg" alt="雪山盛景">
            </section>
            <p>但还是想爬雪山，怎么办？<br>
            客观不可逆环境下，当然是爬一座难度较低、体能要求较低，冰雪技术要求低的雪山。而主观可逆条件下，个人可锻炼身体蓄积体能，经验方面寻找协作队伍、当地向导的帮助。</p>
        </div>

        <!-- 第二部分：为什么选择四姑娘大峰 -->
        <div class="section">
            <h2>人生第一座雪山为什么要选四姑娘大峰？</h2>
            <p>经过凯乐石多年的户外经验，我们根据雪山攀登地理优势、雪山观赏价值、雪山体验价值三大层面上，推荐一座对新人最友好的雪山—四姑娘大峰。</p>
            <section class="more3">
            <img src="images/more3.jpg" alt="四姑娘山大峰">
            </section>
            <p><span class="highlight">四姑娘大峰</span>，又名大姑娘，与其它三座山峰（二姑娘、三姑娘、四姑娘）组成“东方的阿尔卑斯”—四姑娘山，内有长评沟、海子沟、双桥沟三个山谷，属于中国地貌第二阶梯四川盆地向青藏高原的过渡地带。</p>
            <p>四姑娘山区,气候冬寒夏凉,常年干燥,雨量稀少,最佳攀登季节是4-12月,但5月降水量集中,不便攀登。早晚凉,中午热，是四姑娘山典型的高原气候。</p>
        </div>
            <section class="more2">
            <img src="images/more2.jpg" alt="雪山盛景">
            </section>
        <!-- 表格：雪山必备物品 -->
        <div class="section">
            <h2>雪山必备物品清单</h2>
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
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$i}</td>
                            <td>{$row['category']}</td>
                            <td>{$row['item_name']}</td>
                            <td>{$row['quantity']}</td>
                        </tr>";
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <!-- 第三部分：登顶攻略 -->
        <div class="section">
            <h2>四姑娘大峰登顶攻略</h2>
            <p>行程安排简版及详细行程请查看下文。</p>
        </div>
    </div>

</body>
</html>
