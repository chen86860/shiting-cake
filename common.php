<?php
session_start();
/**
 * Created by PhpStorm.
 * User: 星星
 * Date: 2017/04/28
 * Time: 22:39
 */
$response = [];
//if (isset($_POST['action']) && $_POST['action'] == 'signOut') {
//    unset($_SESSION['id']);
//    $response = array(
//        'code' => 0,
//        'errmsg' => 'success',
//        'data' => true,
//    );
//}
try {
    include "conn.php";
    // 检查用户是否注册
    // 开放接口，不要求用户登录
//    if (isset($_POST['action']) && $_POST['action'] == 'checkUser') {
//        $username = $_POST['username'];
//        $response = array(
//            'errmsg' => $username,
//        );
//        $sql_check_user = <<<cici
//select username from userdata where username = '$username'
//cici;
//        try {
//            $num = mysqli_num_rows(mysqli_query($link, $sql_check_user));
//            if ($num > 0) {
//                $response = array(
//                    'code' => 101,
//                    'errmsg' => 'user is exist',
//                    'data' => true,
//                );
//            } else {
//                $response = array(
//                    'code' => 0,
//                    'errmsg' => 'succeed',
//                    'data' => true,
//                );
//            }
//        } catch (Exception $e) {
//            $response = array(
//                // 默认错误码
//                'code' => -1,
//                'errmsg' => $e->getMessage(),
//                'data' => false,
//            );
//        }
//    }
    // 权限控制，当用户没有登录时，阻止使用接口
//    if (!isset($_SESSION['id'])) {
//        header("location:./login.php");
//        mysqli_close($link);
//        exit;
//    }
    $userId = $_SESSION['id'];
    // 购物车操作部分
    // 增加购物车物品数量
//    if (isset($_POST['action']) && $_POST['action'] == 'cartCountAdd' && isset($_POST['id'])) {
//        unset($_SESSION['id']);
//        $goodId = $_POST['id'];
//        $count = $_POST['count'];
//        $sql_cart_add = '';
//        if ($count == 1) {
//            $sql_cart_add = "update cart set count = count + 1 where userId = $userId and goodId = $goodId;";
//        } else {
//            $sql_cart_add = "update cart set count = $count where userId = $userId and goodId = $goodId;";
//        }
//        mysqli_query($link, $sql_cart_add);
//        if (mysqli_affected_rows($link) > 0) {
//            $response = array(
//                'code' => 0,
//                'errmsg' => 'success',
//                'data' => session_id(),
//            );
//        } else {
//            $response = array(
//                'code' => -1,
//                'errmsg' => 'bad',
//                'data' => session_id(),
//            );
//        }
//    }
    // 减少购物车物品数量
    if (isset($_POST['action']) && $_POST['action'] == 'cartCountSub' && isset($_POST['id'])) {
        unset($_SESSION['id']);
        $goodId = $_POST['id'];
        $count = $_POST['count'];
        $sql_cart_add = '';
        if ($count == 1) {
            $sql_cart_add = "update cart set count = count - 1 where userId = $userId and goodId = $goodId;";
        } else {
            $sql_cart_add = "update cart set count = $count where userId = $userId and goodId = $goodId;";
        }
        mysqli_query($link, $sql_cart_add);
        if (mysqli_affected_rows($link) > 0) {
            $response = array(
                'code' => 0,
                'errmsg' => 'success',
                'data' => session_id(),
            );
        } else {
            $response = array(
                'code' => -1,
                'errmsg' => 'bad',
                'data' => session_id(),
            );
        }
    }

//    mysqli_close($link);
} catch (Exception $e) {
    $response = array(
        'code' => -1,
        'errmsg' => $e->getMessage(),
        'data' => false,
    );
}
echo json_encode($response);
?>