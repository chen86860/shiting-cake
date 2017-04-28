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
    <title>cic</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <style>
        .cart-succed {
            text-align: center;
            margin: 300px auto;
        }

        .cart a {
            border: none !important;
        }

        .cart-succed a {
            border: none !important;
            display: inline-block;
            width: 162px;
            height: 48px;
            background-color: #d65164;
            color: #fff;
            line-height: 48px;
            margin: 80px 0;
            border-radius: 4px;
        }

        .cart-succed a:hover {
            background-color: #d65164;
        }

        h1 {
            color: #1d1d1d;
            font-weight: 300;
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
        <li><span class="cart">
                    <a href="#">
                        <?php echo $username ?>
                    </a>
                    </span>
        </li>
    </ul>
</nav>
<div class="cart-succed">
    <h1>商品已成功加入购物车！</h1>
    <a href="./shopcar.php">去购物车结算</a></div>
<div class="fooer-helper"></div>
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
