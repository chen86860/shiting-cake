<?php
session_start();
/**
 * Created by PhpStorm.
 * User: 星星
 * Date: 2017/04/28
 * Time: 22:39
 */
//if (!isset($_SESSION['id'])) {
//    header("location:./login.php");
//    exit;
//}
$response = [];
if (isset($_POST['action']) && $_POST['action'] == 'signOut') {
    unset($_SESSION['id']);
    $response = array(
        'code' => 0,
        'errmsg' => 'success',
        'data' => true,
    );
}
if (isset($_POST['action']) && $_POST['action'] == 'checkUser') {
    include "conn.php";
    $username = $_POST['username'];
    $response = array(
        'errmsg' => $username,
    );
    $sql_check_user = <<<cici
select username from userdata where username = '$username'
cici;
    try {
        $num = mysqli_num_rows(mysqli_query($link, $sql_check_user));
        if ($num > 0) {
            $response = array(
                'code' => 101,
                'errmsg' => 'user is exist',
                'data' => true,
            );
        } else {
            $response = array(
                'code' => 0,
                'errmsg' => 'succeed',
                'data' => true,
            );
        }
        mysqli_close($link);
    } catch (Exception $e) {
        $response = array(
            // 默认错误码
            'code' => -1,
            'errmsg' => $e->getMessage(),
            'data' => false,
        );
    }
}

echo json_encode($response);
?>