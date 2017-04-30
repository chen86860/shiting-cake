<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:./login.php");
    exit;
}

$userId = $_SESSION['id'];
$session_id = session_id();
try {
    include "conn.php";
    $sql_cart = <<<cici
select * from cart where userId = '$userId';
cici;
// Cart
    mysqli_query($link, "set character set 'utf8'");
    $res_cart = mysqli_fetch_all(mysqli_query($link, $sql_cart), MYSQL_ASSOC);
    mysqli_close($link);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>购物车</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <style>
        .shop-car-wrap {
            width: 1200px;
            margin: 40px auto 80px;
        }

        .list-head {
            display: flex;
            width: 100%;
            height: 60px;
            border: 1px solid #ddd;
            background: #f3f3f3;
        }

        .list-head .list-head-2 {
            margin-left: 76px;
        }

        .list-good-wrap {
            display: flex;
            width: 100%;
            background: #ffffff;
            border-bottom: 1px solid #ccc;
            padding: 15px 0 15px;
            margin: 6px 0 0;
            border: 1px solid #eee;
        }

        .list-head-1 {
            width: 10%;
            align-items: center;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .list-head-2 {
            flex: 1;
            width: 50%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .list-head-checkbox {
            width: 56px;
            text-align: center;
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }

        .list-head .list-head-checkbox {
            align-items: center;
            justify-content: flex-end;
            margin-left: 14px;
            margin-right: 10px;
        }

        .list-head .list-head-checkbox input {
            margin-right: 10px;
        }

        .list-good a {
            text-decoration: none;
            color: #444;
            align-self: flex-start;
            transition: background-color 300ms;
        }

        .list-good a:hover {
            color: #d65164;
        }

        .list-good p {
            margin: 0
        }

        .list-good-img {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            width: 100px;
            box-sizing: border-box;
        }

        .list-good-img img {
            width: 100%;
        }

        .list-btn-count {
            display: flex;
            align-items: center;
        }

        .list-btn-count input {
            width: 20px;
            border: 1px solid #cacaca;
            background-color: #fff;
            color: #000;
            text-align: center;
        }

        .list-btn-count button {
            border: 1px solid #cacaca;
            background-color: #fff;
            color: #cacaca;
            outline: none
        }

        .shop-cls {
            width: 100%;
            text-align: right;
            height: 50px;
            border: 1px solid #eee;
            margin: 20px 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .shop-cls-check {
            height: 100%;
            display: flex;
        }

        .shop-cls-checkbox input {
            margin-left: 16px;
            margin-right: 10px;
        }

        .shop-cls-check p {
            margin-right: 20px;
            display: flex;
            align-items: center;
        }

        .shop-cls-check > button {
            background-color: #d65164;
            border: 0;
            width: 130px;
            color: #fff;
            font-size: 16px;
            text-align: center;
            align-items: center;
            cursor: pointer;
            outline: none;
            height: 100%;
            display: inline-block;
        }
    </style>
</head>
<body>
<nav>
        <span class="logo">
            <a href="index.php">
                <img src="img/logo.png" alt="">
                <span>购物车</span>
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
    </ul>
</nav>
<div class="shop-car-wrap">
    <div class="list-head">
        <div class="list-head-1 list-head-checkbox"><input type="checkbox" name="" value="">全选</div>
        <div class="list-head-2">商品</div>
        <div class="list-head-1">单价</div>
        <div class="list-head-1">数量</div>
        <div class="list-head-1">小计</div>
        <div class="list-head-1">操作</div>
    </div>
    <div class="list-body">
        <?php
        for ($i = 0; $i < sizeof($res_cart); $i++) {
            echo '<div class="list-good-wrap"><div class="list-head-1 list-head-checkbox"><input type="checkbox" name="" value=""></div>
            <div class="list-head-2 list-good"><a href=detail.php?id=' . $res_cart[$i]['goodId'] . ' class="list-good-img"><img src="' . $res_cart[$i]['img'] . '" alt=""></a> <a href=detail.php?id=' . $res_cart[$i]['goodId'] . '>
                    <p>
                    ' . $res_cart[$i]['title'] . '
                    </p>
                </a>
            </div>
            <div class="list-head-1">¥<span class="price-sigle"> ' . $res_cart[$i]['price'] . '</span></div>
            <div class="list-head-1">
                    <span class="list-btn-count">
                        <button type="button" class="subBtn">-</button>
                        <input alt=' . $res_cart[$i]['goodId'] . ' type="text" class="good-count" value="' . $res_cart[$i]['count'] . '">
                        <button type="button" class="addBtn">+</button>
                    </span>
            </div>
            <div class="list-head-1">¥
                <span class="list-price">
                    ' . $res_cart[$i]['price'] * $res_cart[$i]['count'] . '.00
                </span>
            </div>
            <div class="list-head-1">
                <a href="javascript:delGood(' . $res_cart[$i]['goodId'] . ')">
                    删除
                </a>
            </div>
        </div>';
        }
        ?>
    </div>
    <div class="shop-cls">
        <div class="shop-cls-checkbox">
            <input type="checkbox" name="" value="">全选
        </div>
        <div class="shop-cls-check">
            <p>
                已选商品
                <span class="info-important" id="totalCount">
                    1
                    </span> 件合计（不含运费）： ￥
                <span class="info-important" id="totalPrice">
                    2149
                    </span>
            </p>
            <button>
                结算
            </button>
        </div>
    </div>
</div>
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
<script>
    ((doc, win) => {
        let subBtns = doc.getElementsByClassName("subBtn"),
            addBtns = doc.getElementsByClassName("addBtn"),
            prices = doc.getElementsByClassName("list-price"),
            goodCounts = doc.getElementsByClassName("good-count"),
            totalPrice = doc.getElementById('totalPrice'),
            totalCount = doc.getElementById('totalCount')


        let updateCart = () => {
            return {
                add: (id, count = 1) => {
                    let data = "action=cartCountAdd&id=" + id + "&count=" + count
                    Ajax('./common.php', 'post', data, (res) => {
                        console.log(res)
//                        if (JSON.parse(res)['code'] === 0) {
//                            console.log('add cart succeed!')
//                        } else {
//                            console.log('network err')
//                        }
                    })
                },
                sub: (id, count = 1) => {
                    let data = "action=cartCountSub&id=" + id + "&count=" + count
                    Ajax('./common.php', 'post', data, (res) => {
                        console.log(res)
//                        if (JSON.parse(res)['code'] === 0) {
//                            console.log('sub cart succeed!')
//                        } else {
//                            console.log('network err')
//                        }
                    })
                }
            }
        }
        let Ajax = (url, method, parms, callback) => {
            var request = new XMLHttpRequest()
            if (request) {
                request.open(method, url, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.onreadystatechange = function () {
                    if (request.readyState == 4 && request.status == 200) {
                        callback(request.response)
                    }
                }
                request.send(parms + "&session_id=" + "<?php echo $session_id?>")
                return true
            } else {
                alert('Sorry,your browser doesn\'t support XMLHttpRequeset');
                return false
            }
        }

        let updatecart = updateCart()
        Array.prototype.forEach.call(subBtns, (el) => {
            el.addEventListener(('click'), (e) => {
                let price = parseInt(e.target.parentElement.parentElement.previousElementSibling.firstElementChild.innerText, 10)
                let goodId = parseInt(e.target.nextElementSibling.alt, 10)
                let count = {
                    set: (t) => {
                        e.target.nextElementSibling.value = t
                    },
                    get: () => {
                        return parseInt(e.target.nextElementSibling.value, 10)
                    },
                    sub: (t) => {
                        if (parseInt(e.target.nextElementSibling.value, 10) < 2) return false
                        e.target.nextElementSibling.value -= t ? t : 1
                        totalPrice.innerText = parseInt(totalPrice.innerText, 10) - price + '.00'
                        updatecart.sub(goodId)
                        return true
                    }
                }
                let total = {
                    set: (t) => {
                        e.target.parentElement.parentElement.nextElementSibling.firstElementChild.innerText = t + '.00'
                    },
                    get: () => {
                        return parseInt(e.target.parentElement.parentElement.nextElementSibling.firstElementChild.innerText, 10)
                    }
                }
                if (!count.sub()) return
                total.set(price * count.get())
            })
        });
    })(document, window);
</script>
</body>

</html>