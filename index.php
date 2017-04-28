<?php
session_start();
include "conn.php";

$sql_promotion = <<<cici
select * from goods where hot = 1;
cici;

$sql_goods = <<<cici
select * from goods where hot = 0;
cici;
// promotion
mysqli_query($link, "set character set 'utf8'");
//读库
$res_promotion = mysqli_fetch_all(mysqli_query($link, $sql_promotion), MYSQL_ASSOC);

// goods
$res_goods = mysqli_fetch_all(mysqli_query($link, $sql_goods), MYSQL_ASSOC);

mysqli_close($link);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CiC Cake</title>
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
</head>
<body>
<div class="logotop">
    <nav>
        <span class="logo">
                <a href="#">
                    <img src="img/logo.png" alt="">
                </a>
                </span>
        <ul>
            <li>
            </li>
            <li><span class="searchbtn">
                <input type="text" name="" value="">
                <button type="search">
                 
                </button>
                </span>
            </li>
            <li><span class="reg">
                    <?php
                    if (isset($_SESSION['id']) && isset($_COOKIE['username'])) {
                        echo '<a class="border-l" href=./my-order.php>' . $_COOKIE['username'] . "</a><a href=javascript:signOut('" . $_COOKIE['username'] . "')>退出</a>";
                    } else {
                        echo '<a href="login.php" class="border-l">登录</a><a href="register.php">注册</a>';
                    }
                    ?>
                </span>
            </li>
            <li><span class="cart">
                <img src="img/gouwuche.png" alt="">
                <a href="shop-cart.php">我的购物车</a>
                </span>
            </li>
        </ul>
    </nav>
</div>
<div class="banner">
    <img src="img/bannerwords.png" alt="">
</div>
<div class="menu">
    <ul>
        <li>
            <a href="#"><img src="img/menu1.png" alt=""></a>
        </li>
        <li>
            <a href="#"><img src="img/menu2.png" alt=""></a>
        </li>
        <li>
            <a href="#"><img src="img/menu3.png" alt=""></a>
        </li>
        <li>
            <a href="#"><img src="img/menu4.png" alt=""></a>
        </li>
    </ul>
</div>
<div class="slogon1">
    <p>当季推选</p>
    <p>Season Selection</p>
</div>
<div class="promotion">
    <div>
        <ul>
            <li>
                <p class="promotion-head1">
                    <?php echo $res_promotion[0]['title'] ?>
                </p>
            </li>
            <li>
                <p class="promotion-head2"><?php echo $res_promotion[0]['subtitle-1'] ?></p>
            </li>
            <li>
                <p class="promotion-head3"><?php echo $res_promotion[0]['subtitle-2'] ?></p>
            </li>
            <li>
                <p class="promotion-head4">¥ <?php echo $res_promotion[0]['price'] ?></p>
            </li>
        </ul>
    </div>
    <div>
        <a href="detail.php?id=<?php echo $res_promotion[0]['id'] ?>"><img src="<?php echo $res_promotion[0]['img'] ?>"
                                                                           alt=""></a>
    </div>
</div>
<div class="promotion promotion2">
    <div>
        <a href="detail.php?id=<?php echo $res_promotion[1]['id'] ?>"><img src="<?php echo $res_promotion[1]['img'] ?>"
                                                                           alt=""></a>
    </div>
    <div>
        <ul>
            <li>
                <p class="promotion-head1"><?php echo $res_promotion[1]['title'] ?></p>
            </li>
            <li>
                <p class="promotion-head2"><?php echo $res_promotion[1]['subtitle-1'] ?></p>
            </li>
            <li>
                <p class="promotion-head3"><?php echo $res_promotion[1]['subtitle-2'] ?></p>
            </li>
            <li>
                <p class="promotion-head4">¥ <?php echo $res_promotion[1]['price'] ?></p>
            </li>
        </ul>
    </div>
</div>
<div class="slogon1">
    <p>热销单品</p>
    <p>Selling product</p>
</div>
<?php
for ($j = 0; $j < sizeof($res_goods) / 4; $j++) {

    echo '<div class="goods"><div class="goods-warp">';

    for ($i = $j * 4; $i <= ($j + 1) * 4 - 1; $i++) {

        echo "<div>
                    <a href=detail.php?id=" . $res_goods[$i]['id'] . "><img src='" . $res_goods[$i]['img'] . "' alt=''>
                    </a>
                    <p>" . $res_goods[$i]['title'] . "</p>
                    <p>¥ " . $res_goods[$i]['price'] . "</p>
                    <p>
                        <a href=detail.php?id=" . $res_goods[$i]['id'] . ">加入购物车</a>
                        <a href=detail.php?id=" . $res_goods[$i]['id'] . ">立即购买</a>
                    </p>
             </div>";
    }
    echo '</div></div>';
}
?>
<footer>
    <div class="footer-warp">
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
                    购物指南 | 卡券使用 | 配送方式
                </p>
                <p>
                    服务条款 | 品牌故事 | 网站地图
                </p>

            </div>
        </div>
    </div>
</footer>
<script>
    function signOut(username) {
        var data = "action=signOut&username=" + username;
        postData('./common.php', 'post', data, function (res) {
            if (JSON.parse(res)['code'] == 0) {
                location.href = "./index"
            } else {
                alert("e...网络故障")
            }
        })
    }

    function postData(url, method, parms, callback) {
        var request = new XMLHttpRequest()
        if (request) {
            request.open(method, url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
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
</script>
</body>
</html>