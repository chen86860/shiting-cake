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
    $password = md5($_POST['password'] . $_POST['username'] . $random_str);
}
if (isset($_POST['nickname']) && $_POST['nickname'] != "") {
    $nickname = $_POST['nickname'];
}
if (isset($_POST['email']) && $_POST['email'] != "") {
    $email = $_POST['email'];
}
if (isset($_POST['mobile']) && $_POST['mobile'] != "") {
    $mobile = $_POST['mobile'];
    try {
        include "conn.php";
        $sql_login = <<<cici
select * from userdata where username = '$username' and password = '$password';
cici;
        $sql_reg_insert = <<<cici
insert into userdata(username,password,nickname,email,mobile) values('$username','$password','$nickname','$email','$mobile');
cici;
        mysqli_query($link, $sql_reg_insert);
        if (mysqli_affected_rows($link)) {
            $result = mysqli_fetch_assoc(mysqli_query($link, $sql_login));
            setcookie('username', $username);
            $_SESSION['id'] = $result['id'];
            redirect("./reg-succeed.php");
        } else {
            echo "bad!";
            exit;
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
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <title>注册 - CiC Cake</title>
    <style>
        .regiter_warp {
            margin: 20px auto;
            clear: both;
            height: 500px;
            width: 1200px;
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
            margin: 8px auto 12px;
            position: relative;
        }

        .submitform > ul > li > p > span > input {
            margin-left: 8px;
            margin-bottom: 4px;
        }

        .tips p {
            font-size: 14px;
            margin-top: 27px;
        }

        a {
            color: #d65164;
            text-decoration: none;
        }

        a:hover {
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
            line-height: 39px;
            height: 39px;
            text-decoration: none;
            width: 225px;
            margin-top: 20px;
            text-align: center;
            padding: 0;
            display: inline-block;
            border-radius: 3px;
            border: none;
            color: #fff;
            font-size: 14px;
            background-color: #d65164;
            transition: background-color 600ms ease-out;
            cursor: pointer;
        }

        #btn_reg[disabled="disabled"] {
            background-color: #eee;
        }

        #btn_reg[disabled="disabled"]:hover {
            background-color: #eee;
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

        .username-li {
            position: relative;
        }

        .ndStatus {
            text-align: left;
            width: 100%;
            display: inline-block;
            left: 70px;
            position: relative;
            margin: 0;
            font-size: 12px;
        }

        .ndSucceed, .ndError, .ndLoading {
            background-repeat: no-repeat;
            background-size: contain;
            padding-left: 20px;
        }

        .ndSucceed {
            color: #51b53c !important;
            background-image: url("./img/icon/ok.svg");
            background-size: 12px;
            background-position: 0px 50%;
        }

        .ndError {
            color: #ef913e !important;
            background-image: url("./img/icon/alert.svg");
        }

        .ndLoading {
            color: #717171;
            background-image: url("./img/icon/tail-spin.svg");
            background-size: 12px;
            background-position: 4px 50%;
        }

        .form-agreement {
            margin: 0 65px 0 !important;
            text-align: left !important;
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
    <form action="register.php" method="post">
        <div class="form-wrap">
            <div class="submitform">
                <ul>
                    <li class="username-li">
                        <p>
                            <label>用户名</label>
                            <span>
                                <input type="text" id="tbx_user" name="username" autocomplete="false"></span><br>
                            <span id="usernameValidator" class="ndStatus"></span>
                        </p>
                    </li>
                    <li>
                        <p>
                            <label>密码</label>
                            <span>
                                <input name="password" type="password" id="tbx_psw"></span><br>
                            <label>
                                <span id="passwordValidator" class="ndStatus"></span>
                            </label>
                        </p>
                    </li>
                    <li>
                        <p>
                            <label>重复密码</label>
                            <span>
                                <input name="password_confirm" type="password" id="tbx_psw_confirm"></span><br>
                            <label>
                                <span id="passwordConfirmValidator" class="ndStatus"></span>
                            </label>
                        </p>
                    </li>
                    <li>
                        <p>
                            <label>名字</label>
                            <span>
                                <input name="nickname" type="text" id="tbx_nickname"></span><br>
                            <label>
                                <span id="nicknameValidator" class="ndStatus"></span>
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
                                <span id="emailValidator" class="ndStatus"></span>
                            </label>
                        </p>
                    </li>
                    <li>
                        <p>
                            <label>手机号码</label>
                            <span><input name="mobile" type="text" id="tbx_phone"></span><br>
                            <label>
                                <span id="mobileValidator" class="ndStatus"></span>
                            </label>
                        </p>
                    </li>
                    <li>
                        <p class="form-agreement">
                            <label>
                                <input type="checkbox" name="agreement">同意 <a href="./agreement.html"
                                                                              target="_blank">《用户协议》</a></label>
                        </p>
                    </li>
                    <li>
                        <span class="subBtn">
                        <p>
                        <input type="submit" value="注册" id="btn_reg" disabled="disabled">
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
    ((doc, win) => {
        let username = doc.getElementsByName('username')[0],
            password = doc.getElementsByName('password')[0],
            password_confirm = doc.getElementsByName('password_confirm')[0],
            nickname = doc.getElementsByName('nickname')[0],
            email = doc.getElementsByName('email')[0],
            mobile = doc.getElementsByName('mobile')[0],
            agreement = doc.getElementsByName('agreement')[0],
            form = doc.getElementsByTagName('form')[0],
            btnReg = doc.getElementById('btn_reg'),
            timer = null,
            passedGroup = ['username', 'password', 'password_confirm', 'nickname', 'email', 'mobile', 'agreement'],
            eventKeyup = new Event('keyup');
        let Validator = () => {
            return {
                username: () => {
                    sign.add('username')
                    if (!((/^[a-zA-Z]{1}([a-zA-Z0-9]|[_]){3,13}$/).test(username.value))) {
                        tip.error('4~12个字符,可使用字母\数字.字母开头')
                        return false
                    } else {
                        return true
                    }
                },
                password: () => {
                    sign.add('password')
                    if (!((/^([a-zA-Z0-9]|[_]){5,17}$/).test(password.value))) {
                        tip.error('6~16个字符，区分大小写', "passwordValidator")
                        return false
                    } else {
                        return true
                    }
                },
                password_confirm: () => {
                    sign.add('password_confirm')
                    if (!((/^([a-zA-Z0-9]|[_]){5,17}$/).test(password.value)) || password_confirm.value !== password.value) {
                        tip.error('两次密码输入不一致', "passwordConfirmValidator")
                        return false
                    } else {
                        return true
                    }
                },
                nickname: () => {
                    sign.add('nickname')
                    if (1 < nickname.value.length && nickname.value.length < 20) {
                        return true
                    } else {
                        tip.error('第一印象很重要，起个响亮的名号吧', "nicknameValidator")
                        return false
                    }
                },
                email: () => {
                    sign.add('email')
                    if (!(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/).test(email.value)) {
                        tip.error('邮箱格式不正确', "emailValidator")
                        return false
                    } else {
                        return true
                    }
                },
                mobile: () => {
                    sign.add('mobile')
                    if ((/^1[0-9]{10}$/).test(mobile.value)) {
                        return true
                    } else {
                        tip.error('手机号码格式不正确', "mobileValidator")
                        return false
                    }
                }
            }
        }
        // prams element id
        let Tips = () => {
            return {
                loading: (msg, el) => {
                    let validator = el ? doc.getElementById(el) : doc.getElementById('usernameValidator')
                    validator.className = 'ndStatus ndLoading'
                    validator.innerText = msg ? msg : "loading"
                },
                error: (msg, el) => {
                    let validator = el ? doc.getElementById(el) : doc.getElementById('usernameValidator')
                    validator.className = 'ndStatus ndError'
                    validator.innerText = msg ? msg : "bad"
                },
                succeed: (msg, el) => {
                    let validator = el ? doc.getElementById(el) : doc.getElementById('usernameValidator')
                    validator.className = 'ndStatus ndSucceed'
                    validator.innerText = msg ? msg : "ok"
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
                request.send(parms)
                return true
            } else {
                alert('Sorry,your browser doesn\'t support XMLHttpRequeset');
                return false
            }
        }
        let signGroup = () => {
            return {
                remove: (el) => {
                    passedGroup.splice(passedGroup.indexOf(el), 1)
                },
                add: (el) => {
                    if (passedGroup.indexOf(el) === -1) {
                        passedGroup.push(el)
                    }
                }
            }
        }
        let tip = Tips()
        let validator = Validator()
        let sign = signGroup()
        username.addEventListener('keyup', (e) => {
            if (!validator.username())return
            tip.loading()
            clearTimeout(timer)
            timer = setTimeout((inputStr) => {
                let data = 'action=checkUser&username=' + inputStr
                Ajax('./common.php', 'post', data, (res) => {
                    console.log(res)
                    if ((JSON.parse(res))['code'] === 0) {
                        tip.succeed("恭喜，该用户名可注册~(•̀ω•́ )ゝ")
                        sign.remove('username')
                        doc.dispatchEvent(eventKeyup)
                    } else {
                        tip.error("该用户名已经注册啦~再换个吧~(。・`ω´・)")
                        sign.add('username')
                    }
                })
            }, 1000, username.value)
        })
        password.addEventListener('keyup', (e) => {
            if (!validator.password()) return
            tip.succeed("OK", "passwordValidator")
            sign.remove('password')
            if (!validator.password_confirm()) return
            tip.succeed("OK", "passwordConfirmValidator")
            sign.remove('password_confirm')
        })
        password_confirm.addEventListener('keyup', (e) => {
            if (!validator.password_confirm()) return
            tip.succeed("OK", "passwordConfirmValidator")
            sign.remove('password_confirm')
        })
        nickname.addEventListener('keyup', (e) => {
            if (!validator.nickname())return
            tip.succeed("OK", "nicknameValidator")
            sign.remove('nickname')
        })
        email.addEventListener('keyup', (e) => {
            if (!validator.email())return
            tip.succeed("OK", "emailValidator")
            sign.remove('email')
        })
        mobile.addEventListener('keyup', (e) => {
            if (!validator.mobile())return
            tip.succeed("OK", "mobileValidator")
            sign.remove('mobile')
        })
        doc.addEventListener('keypress', (e) => {
            let event = new Event('submit');
            if (e.keyCode === 13) {
                form.dispatchEvent(event)
            }
        })
        agreement.addEventListener('change', (e) => {
            if (agreement.checked) {
                sign.remove('agreement')
                doc.dispatchEvent(eventKeyup)
            } else {
                sign.add('agreement')
                btnReg.setAttribute('disabled', 'disabled')
            }
        })
        doc.addEventListener('keyup', (e) => {
            if (passedGroup.length === 0) {
                btnReg.removeAttribute('disabled')
            } else {
                btnReg.setAttribute('disabled', 'disabled')
            }
        })
        // 表单提交事件
        // 拦截所有提交事件统一处理
        form.addEventListener('submit', (e) => {
            if (passedGroup.length !== 0) {
                e.preventDefault();
            }
        })

    })(document, window)
</script>
</body>

</html>
