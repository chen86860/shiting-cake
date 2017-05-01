<?php
/**
 * Created by PhpStorm.
 * User: 星星
 * Date: 2017/04/30
 * Time: 20:44
 */
session_start();
if (!isset($_SESSION['id'])) {
    header("location:./login.php");
    exit;
} else {
    $userId = $_SESSION['id'];
}
$res_order_goods = "";
$good_total_mi = 0;
try {

    include "conn.php";
    $sql_orders = <<<cici
select * from orders where userId = $userId
cici;
// order-goods
    mysqli_query($link, "set character set 'utf8'");
    $res_order_goods = mysqli_fetch_all(mysqli_query($link, $sql_orders), MYSQL_ASSOC);
    mysqli_close($link);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的订单 - Cic cake</title>
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <style>
        html {
            width: 100%;
        }

        body {
            font-size: 14px;
        }

        .order-succed {
            width: 1200px;
            margin: 20px auto;
        }

        .order a {
            border: none !important;
        }

        .order-succed > h1 {
            font-size: 24px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-top: 0;
            padding-left: 20px;
            font-weight: 400;
        }

        .order-wrap {
            margin: 0 auto;
            padding: 0 20px 0;
        }

        .list-body {
            display: flex;
            background-color: #f7f7f7;
            margin: 4px auto;
            height: 120px;
            justify-items: center;
        }

        .list-good-img {
            display: flex;
            width: 100px;
            height: 100px;
            align-items: center;
            justify-items: center;
            margin: 10px 20px 10px 40px;
            background-color: #fff;
            box-sizing: border-box;
            text-align: center;
            border: 1px solid #ddd;
        }

        .list-good-img > img {
            max-width: 90px;
            max-height: 90px;
            margin: 0 auto;
        }

        .list-head-1 {
            width: 120px;
            display: flex;
            align-items: center;
        }

        .list-body > .list-head-1:first-child {
            flex: 1;
            display: flex;
            padding: 0 100px 0 0;
            align-items: flex-start;
        }

        .list-good-title {
            padding: 10px;
            text-decoration: none;
            color: #2d2d2d;
        }

        .price-tag {
            font-weight: bold;
            color: #d65164;
        }

        .good-count {
            color: #2d2d2d;
        }

        .statistic {
            text-align: right;
            color: #5d5d5d;
        }

        .list em {
            font-style: normal;
        }

        .subOrder {
            background-color: #d65164;
            border: 0;
            width: 140px;
            color: #fff;
            font-size: 16px;
            text-align: center;
            align-items: center;
            cursor: pointer;
            outline: none;
            height: 40px;
            display: inline-block;
            font-weight: 700;
            text-decoration: none;
            line-height: 40px;
        }

        .order-mon {
            background-color: #f3f3f3;
            height: 50px;
            line-height: 50px;
            padding: 8px 14px 8px;
        }

        .shop-cls {
            margin: 46px auto
        }

        .moneny {
            font-size: 28px;
            font-weight: bold;
            color: #d65164;
        }

        .list {
            padding-right: 14px;
        }

        .pay-method-wrap {
            display: flex;
            align-items: center;
        }

        .pay-method {
            margin: 0 19px 0
        }

        .pay-method > label {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pay-method > label a {
            display: flex;
            width: 180px;
            height: 60px;
            align-items: center;
            justify-items: center;
            border: 1px solid #eee;
        }

        .pay-method > label img {
            max-width: 160px;
            max-height: 48px;
            margin: 0 auto;
        }

        .selected {
            border: 1px solid #d65164 !important;
        }

        .h3 h3 {
            font-size: 16px;
            color: #545454;
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
        <li><span class="reg">
                      <?php
                      if (isset($_SESSION['id']) && isset($_COOKIE['username'])) {
                          echo '<a class="border-l" href=./my-order.php>' . $_COOKIE['username'] . "</a><a href='#' class='logonOut'>退出</a>";
                      } else {
                          echo '<a href="login.php" class="border-l">登录</a><a href="register.php">注册</a>';
                      }
                      ?>
                    </span>
        </li>
    </ul>
</nav>
<div class="order-succed">
    <h1>我的订单</h1>
    <div class="order-wrap">
        <div class="shop-car-wrap">
            <?php
            for ($i = 0; $i < sizeof($res_order_goods); $i++) {
                $good_total_mi += ($res_order_goods[$i]['price'] * $res_order_goods[$i]['count']);
                echo '<div class="list-body">
            <div class="list-head-1">       
                    <a href=detail.php?id=' . $res_order_goods[$i]['goodId'] . ' class="list-good-img">
                        <img src="' . $res_order_goods[$i]['goodImg'] . '" alt=""></a>
                    <a href=detail.php?id=' . $res_order_goods[$i]['goodId'] . ' class="list-good-title">
                        <span>' . $res_order_goods[$i]['title'] . '</span>
                    </a>
            </div>
            <div class="list-head-1">
            <span class="price-tag">
                ¥<span class="single-price"> ' . $res_order_goods[$i]['price'] . '</span>
                </span>
            </div>
            <div class="list-head-1">
            <span class="good-count">
                    <span class="list-btn-count">x' . $res_order_goods[$i]['count'] . '</span>
                    </span>
            </div></div>';
            }
            ?>
        </div>
    </div>
</div>

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
<script>
    ((doc) => {
        let methods = doc.getElementsByClassName('pay-method'),
            tags = doc.querySelectorAll('.pay-method a'),
            logonOut = doc.querySelector('.logonOut'),
            subOrder = doc.querySelector('.subOrder');

        [].forEach.call(methods, (el) => {
            el.addEventListener('click', (e) => {
                    for (let i = 0; i < tags.length; i++) {
                        if (tags[i].className === 'selected') {
                            tags[i].className = ''
                            break
                        } else if (tags[i].firstElementChild.className === 'selected') {
                            tags[i].firstElementChild.className = ''
                        }
                    }
                    if (e.target.nodeName === 'A') {
                        e.target.classList.toggle('selected')
                    } else if (e.target.parentNode.nodeName === 'A') {
                        e.target.parentNode.classList.toggle('selected')
                    }
                    e.preventDefault()
                }
                ,
                false
            )
        });
        let Ajax = (url, method, parms, callback) => {
            var request = new XMLHttpRequest()
            if (request) {
                request.open(method, url, true);
                request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                request.onreadystatechange = function () {
                    if (request.readyState === 4 && request.status === 200) {
                        callback(request.response)
                    }
                }
                request.send(parms)
                return true
            } else {
                alert('Sorry,your browser doesn\'t support XMLHttpRequeset');
                return false
            }
        }
        logonOut.addEventListener('click', (e) => {
            var data = "action=signOut"
            Ajax('./common.php', 'post', data, function (res) {
                console.log(res)
                if (JSON.parse(res)['code'] === 0) {
                    location.href = "./index"
                } else {
                    alert("e...网络故障")
                }
            })
            e.preventDefault()
        });
        subOrder.addEventListener('click', (e) => {
            let data = "action=createOrder";
            Ajax('./common.php', 'post', data, (res) => {
                if (JSON.parse(res)['code'] === 0) {
                    location.href = './order-succeed'
                } else {
                    alert("e...网络故障")
                }
            })
            e.preventDefault()
        })
    })(document);
</script>
</body>
</html>
