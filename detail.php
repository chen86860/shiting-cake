<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    include "conn.php";

    $sql_goods_detail = <<<cici
select * from goods where id = '$_GET[id]';
cici;

    mysqli_query($link, "set character set 'utf8'");
    //读	库
    $res_goods_detail = mysqli_fetch_array(mysqli_query($link, $sql_goods_detail), MYSQL_ASSOC);

} else {

    header("location:./index.php");

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品详情页</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <style>
        .cart img {
            width: 18px;
        }

        .reg > a:first-child {
            border-right: 2px solid #d65164;
        }

        .list-btn-count {
            display: flex;
        }

        .list-btn-count input {
            width: 40px;
            border: none;
            border-bottom: 1px solid #cacaca;
            border-top: 1px solid #cacaca;
            background-color: #fff;
            color: #000;
            text-align: center;
            box-sizing: border-box;
        }

        .list-btn-count button {
            border: 1px solid #cacaca;
            background-color: #fff;
            color: #cacaca;
            outline: none
        }

        .detail-wrap ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .detail-wrap {
            display: flex;
            width: 1200px;
            margin: 100px auto 0;
            border-bottom: 1px solid #efefef;
        }

        .detail-wrap > div:first-child {
            width: 460px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .detail-wrap > div:first-child img {
            /*width: 460px;*/
            /*max-width: 80%;*/
            max-width: 460px;
            /* max-width: 80%; */
            max-height: 300px;
        }

        .detail-wrap > div:last-child {
            flex: 1
        }

        .detail-wrap-dec1 > p {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        .detail-wrap-dec1 > p:last-child {
            font-size: 14px;
            font-weight: 400;
        }

        .detail-wrap-dec2 {
            background-color: rgba(230, 229, 229, 0.47);
            height: 100px;
            margin: 20px 0;
        }

        .detail-wrap-dec2 > p {
            font-size: 33px;
            color: #d65164;
            margin: 0;
            line-height: 100px;
            padding-left: 20px;
        }

        .detail-wrap-dec2 span {
            font-size: 16px;
            text-decoration: line-through;
            color: #555
        }

        .detail-wrap-dec2 > p > span:first-child {
            text-decoration: none !important;
            color: #d65164 !important;
            padding: 0 !important;
        }

        .detail-wrap-btn {
            margin: 29px 0;
            overflow: hidden;
        }

        .detail-wrap-btn a {
            width: 134px;
            background-color: #d65164;
            border: none;
            height: 42px;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            line-height: 42px;
            outline: none;
            transition: background-color 200ms ease-out;
            border-radius: 100px;
        }

        .detail-wrap-btn a:hover {
            background-color: #de6576;
        }

        .detail-wrap-info > li > p > span:first-child {
            color: #a9a9a9;
            padding-right: 14px;
        }

        .detail-wrap-body p {
            text-align: center;
            font-weight: bold;
            color: #d65164;
            font-size: 16px;
        }

        .list-count > p {
            display: flex
        }
        .addBtn,.subBtn{
            cursor: pointer;
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
        <li><span class="searchbtn">
                    <input type="text" name="" value="">
                    <button type="search">
                    
                    </button>
                    </span>
        </li>
        <li><span class="reg">
                    <a href="login.php">登录</a>
                    <a href="register.php">注册</a>
                    </span>
        </li>
        <li><span class="cart">
                    <img src="img/cart-color.svg" alt="">
                    <a href="shop-cart.php">我的购物车</a>
                    </span>
        </li>
    </ul>
</nav>
<div class="detail-wrap">
    <div>
        <img src=" <?php echo $res_goods_detail['img'] ?>" alt="" id="img">

    </div>
    <div>
        <ul class="detail-wrap-info">
            <li class="detail-wrap-dec1">
                <p id="title"><?php echo $res_goods_detail['title'] . "  " . $res_goods_detail['subtitle-1'] ?></p>
                <p>
                    <?php echo $res_goods_detail['subtitle-2'] ?>
                </p>
            </li>
            <li class="detail-wrap-dec2">
                <p>
                        <span>
              ¥
            </span> <?php echo $res_goods_detail['price'] ?> <span>¥ <?php echo $res_goods_detail['price-old'] ?></span>
                </p>
            </li>
            <li>
                <p>
                    <span>运费</span><span>¥ 8.00（订单满199免运费）</span>
                </p>
            </li>
            <li class="list-count">
                <p>
                    <span>数量</span>
                    <span class="list-btn-count">
                    <button type="" class="subBtn">-</button>
                    <input type="text" value="1" class="count" id="count">
                    <button class="addBtn">+</button>
                </span>
                </p>
            </li>
            <li class="detail-wrap-btn">
                <p><a href="javascript:addCart(<?php echo $res_goods_detail['id'] ?>)">加入购物车</a></p>
            </li>
        </ul>
    </div>
</div>
<div class="detail-wrap-body">
    <p>
            <span>/
        </span> 商品详情
        <span>/
        </span>
    </p>
</div>
<img src="<?php echo $res_goods_detail['img-1'] ?>" alt="">
<img src="<?php echo $res_goods_detail['img-2'] ?>" alt="">
<img src="<?php echo $res_goods_detail['img-3'] ?>" alt="">
<img src="<?php echo $res_goods_detail['img-4'] ?>" alt="">


<!--<div class="footer-helper"></div>
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
</footer>-->
<script>
    var subBtn = document.getElementsByClassName("subBtn")[0]
    var addBtn = document.getElementsByClassName("addBtn")[0]
    var count = document.querySelector("#count")
    subBtn.addEventListener('click', (e) => {
        if (count.value <= 1) {
            return false
        }
        count.value--
    })
    addBtn.addEventListener('click', (e) => {
        count.value++;
    })
    function addCart(id) {
        var data = "goodId=" + id + "&count=" + parseInt(document.querySelector(".count").value)
        postData('./add-cart.php', 'post', data, function (result) {
            if (JSON.parse(result)['code'] == 0) {
                location.href = "./add-cart-succeed.php"
            } else if (JSON.parse(result)['code'] == -1) {
                location.href = "./login.php"
            } else {
                alert("e...网络错误，请重试")
            }
        })
    }

    function postData(url, method, parms, callback) {
        //Get request
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