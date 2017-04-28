<?php
/**
 * Created by PhpStorm.
 * User: 星星
 * Date: 2017/04/27
 * Time: 23:41
 */
$host = "127.0.0.1";
$user = "root";
$passwords = "";
$database = "cake";

$link = mysqli_connect($host, $user, $passwords) or die("数据库连接失败");
mysqli_select_db($link, $database) or die("数据库选择失败");
?>