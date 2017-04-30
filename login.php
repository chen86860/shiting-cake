<?php
session_start();
//网站跳转
$errmsg = "";
function redirect($string)
{
    echo '<script language = \'javascript\' type = \'text/javascript\' > ';
    echo "window.location.href = '$string' ";
    echo '</script>';
}

//登录判断
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $random_str = "9-l,.gf043";
    $password = md5($_POST['password'] . $_POST['username'] . $random_str);
    try {

        include "conn.php";
        $sql_login = <<<cici
select * from userdata where username = '$username' and password = '$password';
cici;
        $num = mysqli_num_rows(mysqli_query($link, $sql_login));
        $result = mysqli_fetch_assoc(mysqli_query($link, $sql_login));

        if ($num != 0) {
            setcookie('username', $username);
            $_SESSION['id'] = $result['id'];
            redirect("./index.php");
        } else {
            $errmsg = "用户名或密码错误";
        }
        mysqli_close($link);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录 - CiC Cake</title>
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

        #btn_login {
            margin-top: 6px;
            width: 227px;
            padding: 0;
            height: 39px;
            border-radius: 3px;
            border: none;
            margin-left: 3px;
            line-height: 40px;
            text-decoration: none;
            text-align: center;
            color: #fff;
            display: block;
            background-color: #d65164;
            outline: none;
            cursor: pointer;
            transition: background-color 600ms ease-out;
        }

        #btn_login:hover {
            background-color: #e46073;
        }

        .reg > a {
            text-decoration: none;
            font-size: 13.33px;
            color: #222;
        }

        .text2, .text1 {
            position: relative;
        }

        .erruser, .errmsg {
            position: absolute;
            right: 107px;
            top: 6px;
            background-color: #ffffff;
            height: 37px;
            line-height: 37px;
            border-radius: 2px;
            padding: 0 10px;
            opacity: 1;
            color: #F44336;
            transition: opacity 600ms;
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
                    <span class="erruser"></span>
                </p>
            </li>
            <li>
                <p class="text2">
                    <input type="password" placeholder="密码" name="password">
                    <span class="errmsg">
                        <?php if ($errmsg != "") {
                            echo $errmsg;
                        } ?>
                    </span>
                </p>
            </li>
            <li class="btnlogin">
                <p>
                    <input type="submit" value="登录" id="btn_login">
                </p>
            </li>
            <li>
                <p class="reg"><a href="register.php">注册</a></p>
            </li>
        </ul>
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
    ((doc, win) => {
        let form = doc.getElementsByTagName('form')[0],
            username = doc.getElementsByName('username')[0],
            password = doc.getElementsByName('password')[0],
            errmsg = doc.querySelector(".errmsg"),
            erruser = doc.querySelector(".erruser"),
            cookieUser = document.cookie.replace(/(?:(?:^|.*;\s*)username\s*\=\s*([^;]*).*$)|^.*$/, "$1");
        let check = {
            username: () => {
                if (username.value.length === 0) {
                    erruser.innerText = "请输入用户名"
                    tip.username()
                    return false
                }
                if (!((/^[a-zA-Z]{1}([a-zA-Z0-9]|[_]){3,13}$/).test(username.value))) {
                    erruser.innerText = "用户名格式不正确哇~"
                    tip.username()
                    return false
                } else {
                    return true
                }
            },
            password: () => {
                if (password.value.length === 0) {
                    errmsg.innerText = "请输入密码"
                    tip.password()
                    return false
                }
                if (!((/^([a-zA-Z0-9]|[_]){5,17}$/).test(password.value))) {
                    errmsg.innerText = "密码格式不正确哇~"
                    tip.password()
                    return false
                } else {
                    return true
                }
            }
        }
        let tip = {
            username: () => {
                if (erruser.innerText !== '') {
                    erruser.style.opacity = 1
                    setTimeout(() => {
                        erruser.style.opacity = 0
                    }, 2000)
                }
            },
            password: () => {
                if (errmsg.innerText !== '') {
                    errmsg.style.opacity = 1
                    setTimeout(() => {
                        errmsg.style.opacity = 0
                    }, 1000)
                }
            }
        }

        username.value = cookieUser ? cookieUser : ''
        tip.password()
        if (username.value === '') {
            username.focus()
        } else {
            password.focus()
        }
        form.addEventListener('submit', (e) => {
            if (!check.username()) {
                username.focus()
                e.preventDefault()
            }
            if (!check.password()) {
                password.focus()
                e.preventDefault()
            }
            doc.cookie = "username=" + username.value
        })
        addEventListener('keypress', (e) => {
            if (e.keyCode === 13) {
                if (!check.username()) {
                    username.focus()
                    e.preventDefault()
                    return
                }
                if (!check.password()) {
                    password.focus()
                    e.preventDefault()
                    return
                }
                doc.forms[0].submit()
            }
        })
    })(document, window);
</script>
</body>

</html>