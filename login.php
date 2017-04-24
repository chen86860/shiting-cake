<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <style>
        .userlogin {
            min-width: 1200px;
        }

        .userlogin > ul {
            width: 400px;
            margin: 50px auto;
            height: 300px;
            border: 2px solid #efefef;
            border-top: 2px solid #d65164;
            list-style: none;
            justify-content: center;
            align-items: center;
            border-radius: 3px;
            padding-top: 65px;
        }

        .userlogin > ul > li > p {
            margin-left: 65px;
            padding: 5px 0
        }

        .text1 > input {
            width: 220px;
            height: 35px;
            border-radius: 3px;
            border: 1px solid #dedede;
            margin-left: 3px;
            padding-left: 5px;
            outline: none;
        }

        .text2 > input {
            width: 220px;
            height: 35px;
            border-radius: 3px;
            border: 1px solid #dedede;
            margin-left: 3px;
            padding-left: 5px;
            outline: none;
        }

        .btnlogin > p > input[type="submit"] {
            width: 224px;
            height: 40px;
            border-radius: 3px;
            border: none;
            border: 1px solid #d65164;
            margin-left: 3px;
            line-height: 40px;
            text-decoration: none;
            text-align: center;
            color: #fff;
            display: block;
            background-color: #d65164;
            outline: none;
            cursor: pointer;
            transition: background-color 400ms ease-out;
        }

        .btnlogin > p > button:hover {
            background-color: #e46073;
        }

        .zhuce > a {
            text-decoration: none;
            font-size: 13.33px;
            color: #222;
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
</nav>
<div class="userlogin">
    <form action="login.php" method="post" class="userlogin">
        <ul>
            <li>
                <p class="text1">
                    <input type="text" placeholder="用户名" name="username">
                </p>
            </li>
            <li>
                <p class="text2">
                    <input type="password" placeholder="密码" name="password">
                </p>
            </li>
            <li class="btnlogin">
                <p>
                    <input type="submit">
                </p>
            </li>
            <li>
                <p class="zhuce"><a href="register.php">注册</a></p>
            </li>
        </ul>
    </form>
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
</body>

</html>