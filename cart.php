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
    <link rel="icon" href="favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>购物车 - Cic cake</title>
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/cart.css">
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
                      echo '<a class="border-l" href=./my-order.php>' . $_COOKIE['username'] . "</a><a href='#' class='loginOut'>退出</a>";
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
        <div class="list-head-1 list-head-checkbox list-head-checkbox-i"><input type="checkbox" name="" value=""
                                                                                title="全选"
                                                                                class="cart-check-all">
            <span>全选</span>
        </div>
        <div class="list-head-2">商品</div>
        <div class="list-head-1">单价</div>
        <div class="list-head-1">数量</div>
        <div class="list-head-1">小计</div>
        <div class="list-head-1">操作</div>
    </div>
    <div class="list-body">
        <?php
        for ($i = 0; $i < sizeof($res_cart); $i++) {
            echo '<div class="list-good-wrap"><div class="list-head-1 list-head-checkbox"><input class="cart-checkbox" type="checkbox"' . (($res_cart[$i]['checked'] == 1) ? 'checked' : '') . ' name="" value="' . $res_cart[$i]['goodId'] . '"></div>
            <div class="list-head-2 list-good"><a href=detail.php?id=' . $res_cart[$i]['goodId'] . ' class="list-good-img"><img src="' . $res_cart[$i]['img'] . '" alt=""></a> <a href=detail.php?id=' . $res_cart[$i]['goodId'] . '>
                    <p>
                    ' . $res_cart[$i]['title'] . '
                    </p>
                </a>
            </div>
            <div class="list-head-1">¥<span class="single-price"> ' . $res_cart[$i]['price'] . '</span></div>
            <div class="list-head-1">
                    <span class="list-btn-count">
                        <button type="button" class="subBtn">-</button>
                        <input alt=' . $res_cart[$i]['goodId'] . ' type="text" value="' . $res_cart[$i]['count'] . '">
                        <button type="button" class="addBtn">+</button>
                    </span>
            </div>
            <div class="list-head-1">¥
                <span class="list-price">
                    ' . $res_cart[$i]['price'] * $res_cart[$i]['count'] . '.00
                </span>
            </div>
            <div class="list-head-1">
                <a class="cart-del" href="#" rel="' . $res_cart[$i]['goodId'] . '">
                    删除
                </a>
            </div>
        </div>';
        }
        ?>
    </div>
    <div class="shop-cls">
        <div class="shop-cls-checkbox">
            <input type="checkbox" name="" value="" title="全选"
                   class="cart-check-all">全选
        </div>
        <div class="shop-cls-check">
            <p>
                已选商品
                <span class="info-important" id="totalCount">
                    0
                    </span> 件合计（不含运费）： ￥
                <span class="info-important" id="totalPrice">
                    0
                    </span>
            </p>
            <a href="create-order.php" class="create-order">
                结算
            </a>
        </div>
    </div>
</div>
<div class="shop-car-wrap-none">
    <div class="no-goods-wrap">
        <img src="./img/cart-color.svg" alt="">
        <div>
            <p>购物车空空如也~赶紧去首页看看吧~</p>
            <a href="./index.php">去购物></a>
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
    ((doc, win) => {
        let subBtns = doc.getElementsByClassName('subBtn'),
            addBtns = doc.getElementsByClassName('addBtn'),
            checkboxs = doc.getElementsByClassName('cart-checkbox'),
            allCheckbox = doc.getElementsByClassName('cart-check-all'),
            singlePrice = doc.getElementsByClassName('list-price'),
            totalPrice = doc.getElementById('totalPrice'),
            totalCount = doc.getElementById('totalCount'),
            cartDel = doc.getElementsByClassName('cart-del'),
            noGoodsWrap = doc.querySelector('.shop-car-wrap-none'),
            goodsWrap = doc.querySelector('.shop-car-wrap'),
            cartCount = doc.getElementsByClassName('list-good-wrap'),
            loginOut = doc.querySelector('.loginOut'),
            createOrder = doc.querySelector('.create-order'),
            totalMi = 0

        let updateCart = () => {
            return {
                __init: () => {
                    if (parseInt(cartCount.length, 10) === 0) {
                        goodsWrap.style.display = 'none'
                        noGoodsWrap.style.display = 'inherit'
                        return
                    }
                    Array.prototype.forEach.call(checkboxs, (el) => {
                        let mi = parseInt(el.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.firstElementChild.innerText, 10)
                        if (el.checked) {
                            updatecart.setTotal(mi, 'add')
                        }
                    });
                    updatecart.checkAllChange()
                    updatecart.goodsCount()
                },
                add: (id, count = 1) => {
                    let data = 'action=cartCountAdd&id=' + id + '&count=' + count
                    Ajax('./common.php', 'post', data, (res) => {
                        if (JSON.parse(res)['code'] === 0) {
                            console.log('add cart succeed!')
                        } else {
                            console.log('network err')
                        }
                    })
                },
                sub: (id, count = 1) => {
                    let data = 'action=cartCountSub&id=' + id + '&count=' + count
                    Ajax('./common.php', 'post', data, (res) => {
                        if (JSON.parse(res)['code'] === 0) {
                            console.log('sub cart succeed!')
                        } else {
                            console.log('network err')
                        }
                    })
                },
                del: (id) => {
                    let data = 'action=cartGoodDel&id=' + id
                    Ajax('./common.php', 'post', data, (res) => {
                        if (JSON.parse(res)['code'] === 0) {
                            console.log('del succeed!')
                        } else {
                            console.log('network err')
                        }
                    })
                },
                check: (id, mi, t) => {
                    let data = 'action=cartGoodCheck&id=' + id
                    Ajax('./common.php', 'post', data, (res) => {
                        if (JSON.parse(res)['code'] === 0) {
                            console.log('check state changed')
                            updatecart.checkAllChange();
                            if (t) {
                                updatecart.setTotal(mi, 'add')
                            } else {
                                updatecart.setTotal(mi, 'sub')
                            }
                        } else {
                            console.log('network err')
                        }
                    })
                },
                checkAll: (check) => {
                    [].forEach.call(checkboxs, (el) => {
                        el.checked = check ? 'checked' : false
                    })
                    if (check) {
                        totalPrice.innerText = totalMi + '.00'
                    } else {
                        totalPrice.innerText = 0 + '.00'
                    }
                    updatecart.checkAllChange()
                    let state = check ? 1 : 0
                    let data = 'action=cartAllGoodCheck&state=' + state
                    Ajax('./common.php', 'post', data, (res) => {
                        if (JSON.parse(res)['code'] === 0) {
                            console.log('check all state changed')
                        } else {
                            console.log('network err')
                        }
                    })
                },
                checkAllChange: () => {
                    let passed = [].every.call(checkboxs, (el) => {
                        return el.checked
                    })
                    updatecart.goodsCount()
                    updatecart.changeSync(passed)
                },
                changeSync: (passed) => {
                    [].forEach.call(allCheckbox, (el) => {
                        if (passed) {
                            el.checked = true
                        } else {
                            el.checked = false
                        }
                    })
                },
                goodsCount: (t) => {
                    let count = t ? t : 0;
                    [].forEach.call(checkboxs, (el) => {
                        if (el.checked) {
                            count++
                        }
                    })
                    console.log(count)
                    totalCount.innerText = count
                },
                setTotal: (t, op) => {
                    if (op === 'sub') {
                        console.log((parseInt(totalPrice.innerText, 10)));
                        console.log('T', t);
                        totalPrice.innerText = (parseInt(totalPrice.innerText, 10)) - t + '.00';
                    } else if (op === 'add') {
                        totalPrice.innerText = (parseInt(totalPrice.innerText, 10)) + t + '.00';
                    }
                }
            }
        }
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

        // 实例化购物车
        let updatecart = updateCart()
        updatecart.__init()
        // 增加商品数量
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
        // 减少商品数量
        Array.prototype.forEach.call(addBtns, (el) => {
            el.addEventListener(('click'), (e) => {
                let price = parseInt(e.target.parentNode.parentNode.previousElementSibling.firstElementChild.innerText, 10)
                let goodId = parseInt(e.target.previousElementSibling.alt, 10)
                let count = {
                    set: (t) => {
                        e.target.previousElementSibling.value = t
                    },
                    get: () => {
                        return parseInt(e.target.previousElementSibling.value, 10)
                    },
                    add: (t) => {
                        e.target.previousElementSibling.value = parseInt(e.target.previousElementSibling.value, 10) + (t ? t : 1)
                        totalPrice.innerText = parseInt(totalPrice.innerText, 10) + price + '.00'
                        updatecart.add(goodId, t)
                        return true
                    }
                }
                let total = {
                    set: (t) => {
                        e.target.parentElement.parentNode.nextElementSibling.firstElementChild.innerText = t + '.00'
                    },
                    get: () => {
                        return parseInt(e.target.parentElement.parentNode.nextElementSibling.firstElementChild.innerText, 10)
                    }
                }
                if (!count.add()) return
                total.set(price * count.get())
            })
        })
        // 选择盒子状态
        Array.prototype.forEach.call(checkboxs, (el) => {
            el.addEventListener('change', (e) => {
                let minTotal = parseInt(e.target.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.firstElementChild.innerText, 10)
                let goodId = parseInt(e.target.value, 10)
                updatecart.check(goodId, minTotal, e.target.checked)
            })
        });
        // 选择全部盒子
        Array.prototype.forEach.call(allCheckbox, (el) => {
            el.addEventListener('change', (e) => {
                updatecart.checkAll(e.target.checked)
            })
        })
        Array.prototype.forEach.call(cartDel, (el) => {
            el.addEventListener('click', (e) => {
                if (win.confirm('删除商品吗？')) {
                    e.target.parentNode.parentNode.remove()
                    updatecart.del(parseInt(e.target.rel, 10))
                    updatecart.goodsCount()
                }
            })
        })
        Array.prototype.forEach.call(singlePrice, (el) => {
            totalMi += parseInt(el.innerText, 10)
        })
        // 退出登录
        loginOut.addEventListener('click', (e) => {
            Ajax('./common.php', 'post', "action=signOut", function (res) {
                if (JSON.parse(res)['code'] === 0) {
                    location.href = "./index"
                } else {
                    alert("e...网络故障")
                }
            })
            e.preventDefault()
        })
        // 创建订单
        createOrder.addEventListener('click', (e) => {
            if (parseInt(totalCount.innerText, 10) === 0) {
                alert('e...你忘记选中商品了')
            } else {
                location.href = './create-order.php'
            }
            e.preventDefault();
        })
    })
    (document, window);
</script>
</body>
</html>