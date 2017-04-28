<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:./login.php");
    exit;
}
$goodId = $_POST['goodId'];
$count = $_POST['count'];
$userId = $_SESSION['id'];
$response = [];
$goodImg = '';
$goodTitle = 0;
try {
    include "conn.php";
    $sql_select_item = <<<cici
  select * from goods where id = '$goodId'
cici;
// goods-detail
    mysqli_query($link, "set character set 'utf8'");
//读库
    $res_goods = mysqli_fetch_assoc(mysqli_query($link, $sql_select_item));
//    $response['message'] = mysqli_num_rows(mysqli_query($link, $sql_check_cart));
    $goodTitle = $res_goods['title'];
    $goodImg = $res_goods['img'];
    $goodPrice = $res_goods['price'];
//// 存储在session中
//if ($_SESSION['goodsid' == "" && $_SESSION['count']] == "") {
//    $_SESSION['goodsid'] = $goodId . "@";
//    $_SESSION['count'] = $count . "@";
//} else {
//    $arr = explode("@", $_SESSION['goodsid']);
//    if (is_array($goodId, $arr)) {
//        echo "<script>alert('该商品已放入购物车')</script>";
//        exit;
//    }
//    $_SESSION['goodsid'] .= $goodId . "@";
//    $_SESSION['count'] .= $count . "@";
//}
// 存储在数据库中

// 检查数量
    $sql_check_cart = <<<cici
select id from cart where userId = '$userId' and goodId = '$goodId';
cici;

// 检查商品是否在数据库中
// 若是，则增加数量count
    mysqli_query($link, $sql_check_cart);
    if (mysqli_affected_rows($link) > 0) {
        $sql_add_count = <<<cici
update cart set count=count+'$count' where userId = '$userId' and goodId  = '$goodId'
cici;
        mysqli_query($link, $sql_add_count);
        if (mysqli_affected_rows($link) > 0) {
            $response = array(
                'code' => 0,
                'errmsg' => 'success',
                'data' => true,
            );
        }
    } else {
        // 若否，加入到数据库
        $sql_add_cart = <<<cici
insert into cart(goodId,title,img,count,userId,price) values('$goodId','$goodTitle','$goodImg','$count','$userId','$goodPrice')
cici;
        mysqli_query($link, $sql_add_cart);
        if (mysqli_affected_rows($link) > 0) {
            $response = array(
                'code' => 0,
                'errmsg' => 'success',
                'data' => true,
            );
        }
    }
} catch (Exception $e) {
    $response = array(
        'code' => 1,
        'errmsg' => $e->getMessage(),
        'data' => false,
    );
}
mysqli_close($link);
echo json_encode($response);
?>