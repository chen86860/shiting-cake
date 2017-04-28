<?php
session_start();
//网站跳转
function redirect($string)
{
    echo '<script language = \'javascript\' type = \'text/javascript\' > ';
    echo "window.location.href = '$string' ";
    echo '</script>';
}

//判断用户是否存在
if (isset($_POST['username']) && $_POST['username'] != "") {
    $username = $_POST['username'];
}
if (isset($_POST['password']) && $_POST['password'] != "") {
    $random_str = "9-l,.gf043";
    $password = md5($_POST['password'].$_POST['username'].$random_str);
}
if (isset($_POST['nickname']) && $_POST['nickname'] != "") {
    $nickname = $_POST['nickname'];
}
if (isset($_POST['email']) && $_POST['email'] != "") {
    $email = $_POST['email'];
}
if (isset($_POST['mobile']) && $_POST['mobile'] != "") {
    $mobile = $_POST['mobile'];

    include "conn.php";
    $sql_reg_insert = <<<cici
insert into userdata(username,password,nickname,email,mobile) values('$username','$password','$nickname','$email','$mobile')
cici;
    mysqli_query($link, $sql_reg_insert);
    if (mysqli_affected_rows($link)) {
        setcookie('username', $username);
        redirect("http://localhost/cake/reg-succeed.php");
    } else {
        echo "bad!";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <title>注册</title>
    <style>
        .regiter_warp {
            margin: 20px auto;
            width: 90%;
            clear: both;
            height: 500px;
            width: 1100px;
        }

        .regiter_title {
            font-size: 24px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-top: 0;
            padding-left: 20px;
        }

        .submitform > ul {
            list-style: none;
            float: left;
        }

        .submitform {
            display: flex;
            width: 500px;
            flex-wrap: nowrap;
        }

        label {
            cursor: default;
        }

        .submitform > ul > li > p {
            font-size: 14px;
            text-align: right;
            margin: 8px auto;
            position: relative;
        }

        .submitform > ul > li > p > span > input {
            margin-left: 8px;
        }

        .tips p {
            font-size: 14px;
            margin-top: 27px;
        }

        .tips a {
            color: #d65164;
            text-decoration: none;
        }

        .tips a:hover {
            color: #d65164;
        }

        input[type=text] {
            width: 220px;
            height: 35px;
            border: 1px solid #dddddd;
            border-radius: 3px;
        }

        input {
            padding-left: 3px;
            outline: none;
        }

        input[type=password] {
            width: 220px;
            height: 35px;
            border: 1px solid #dddddd;
            border-radius: 3px;
        }

        input {
            padding-left: 3px;
            outline: none;
        }

        #btn_reg {
            width: 228px;
            line-height: 32px;
            height: 32px;
            text-decoration: none;
            width: 100px;
            text-align: center;
            display: inline-block;
            border-radius: 3px;
            border: none;
            border: 1px solid #d65164;
            color: #fff;
            font-size: 14px;
            background-color: #d65164;
            transition: background-color 400ms ease-out;
            cursor: pointer;
        }

        #btn_reg:hover {
            background-color: #e46073;
        }

        .subBtn > p {
            text-align: right;
        }

        .form-wrap {
            display: flex;
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
<div class="regiter_warp">
    <p class="regiter_title">欢迎注册</p>
    <form action="register.php" method="post" onkeydown="keydown()">
        <div class="form-wrap">
            <div class="submitform">
                <ul>
                    <li>
                        <p>
                            <label>用户名</label>
                            <span>
    <input  type="text" id="tbx_user" name="username"></span><br>
                            <label>
                                <span id="RegularExpressionValidator2" style="visibility:hidden;">用户名格式不正确</span><span
                                    id="RequiredFieldValidator1" style="visibility:hidden;">请输入用户名</span>
                            </label>
                        </p>
                    </li>
                    <li>
                        <p>
                            <label>密码</label>
                            <span>
    <input name="password" type="password" id="tbx_psw"></span><br>
                            <label>
                                <span id="RegularExpressionValidator4" style="visibility:hidden;">密码格式不正确</span><span
                                    id="RequiredFieldValidator2" style="visibility:hidden;">请输入密码</span>
                            </label>
                        </p>
                    </li>
                    <li>
                        <p>
                            <label>重复密码</label>
                            <span>
    <input name="password_confirm" type="password" id="tbx_psw_confirm"></span><br>
                            <label>
                                <span id="CompareValidator1" style="visibility:hidden;">两次密码不一致</span>
                            </label>
                        </p>
                    </li>

                    <li>
                        <p>
                            <label>名字</label>
                            <span>
    <input name="nickname" type="text" id="tbx_nickname"></span><br>
                            <label>
                                <span id="RequiredFieldValidator3" style="visibility:hidden;">第一印象很重要，起个响亮的名号吧</span>
                            </label>
                        </p>
                    </li>
                    <li>
                        <p>
                            <label>邮箱</label>
                            <span>
<input name="email" type="text" id="tbx_email"></span>
                            <br>
                            <label>
                                <span id="RegularExpressionValidator1" style="visibility:hidden;">请输入正确的邮箱</span>
                            </label>
                        </p>
                    </li>
                    <li>
                        <p>
                            <label>手机号码</label>
                            <span>
    <input name="mobile" type="text" id="tbx_phone"></span><br>
                            <span id="RegularExpressionValidator3" style="visibility:hidden;">请输入正确的手机号</span>
                            <label>
                            </label>
                        </p>
                    </li>
                    <li>
    <span class="subBtn">
    <p>
    <input type="submit" value="注册" id="btn_reg">
    </p>
    </span>
                    </li>
                </ul>
            </div>
            <div class="tips">
                <p>> 已有账户？<a href="login.php">直接登录</a></p>
            </div>
        </div>
    </form>
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
    function keydown() {
        if (event.keycode == 13) {
            event.returnvalue = false;  //不刷新界面
            form.btnok.click(); //表单提交
        }
    }
</script>
</body>

</html>
