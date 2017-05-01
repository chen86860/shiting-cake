<?php
/**
 * Created by PhpStorm.
 * User: 星星
 * Date: 2017/04/28
 * Time: 1:09
 */
function redirect($string)
{
    echo '<script language = \'javascript\' type = \'text/javascript\' > ';
    echo "window.location.href = '$string' ";
    echo '</script>';
}

if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
} else {
    redirect("/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>支付成功 - Cic cake</title>
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <style>
        .order-succed {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 200px;
        }

        .order-succed div {
            width: 100%;
            text-align: center;
        }

        .order a {
            border: none !important;
        }

        .order-succed a {
            border: none !important;
            display: inline-block;
            width: 120px;
            height: 43px;
            background-color: #d65164;
            color: #fff;
            line-height: 43px;
            margin: 80px 0;
            border-radius: 4px;
            transition: background-color 600ms ease-out;
        }

        .order-succed a:hover {
            background-color: #e46073;
        }

        .order-succed img {
            width: 60px;
            padding: 0 10px 0;
        }

        h1 {
            color: #1d1d1d;
            font-weight: 400;
            display: flex;
            font-size: 20px;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
<nav>
        <span class="logo">
            <a href="index.php">
                <img src="img/logo.png" alt="">
        </a>
        </span>
    <ul>
        <li>
        </li>
        <li><span class="order">
                    <a href="#">
                        <?php echo $username ?>
                    </a>
                    </span>
        </li>
    </ul>
</nav>
<div class="order-succed">
    <div><img src="./img/finished.png" alt="">
        <h1>支付成功！我们尽快会为你发货！</h1>
    </div>
    <div>
        <a href="./my-order.php">查看订单</a></div>
</div>
<div class="footer-helper"></div>
<footer>
    <div class="footer-warp-container">
        <div class="footer-comm">
            <p>订购服务热线： 800-628-5656
            </p>
            <p>营业时间： 9:00~23:00
            </p>
        </div>
        <div class="footer-chat">
            <img src="img/qcode.png" alt="">
            <p>扫二维码 关注本店最新动态</p>
            <p>
                <img src="img/footer-chat-1.png" alt="">
                <img src="img/footer-chat-2.png" alt="">
                <img src="img/footer-chat-3.png" alt="">
                <img src="img/footer-chat-4.png" alt="">
            </p>
        </div>
        <div>
            <p>
                <a href="#">购物指南</a> | <a href="#">卡券使用</a> | <a href="">配送方式</a>
            </p>
            <p>
                <a href="#">服务条款</a> | <a href="#">品牌故事</a> | <a href="">网站地图</a>
            </p>
        </div>
    </div>
</footer>
</body>
</html>
