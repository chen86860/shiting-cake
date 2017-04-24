<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$x = 5; // 全局作用域
//function myTest()
//{
//    $y = 10; // 局部作用域
//    global $x;
//    echo "<p>测试函数内部的变量：</p>";
//    echo "变量 x 是：$x";
//    echo "<br>";
//    echo "变量 y 是：$y";
//}
//
//myTest();

//echo "<span>PHP is fun!</span>","<span>php is fun</span>","<span>php is fun</span>";

//字符串
$string1 = "liangshiting";
$string2 = 'cici';
//echo "My name is $string";

//数字
$num1 = 10;
$num2 = -10;

// 浮点数
$num3 = 10.3;
$num4 = 2e3;
//echo  $num4;

//布尔值 PHP 逻辑
$x = true;
$y = false;

if ($y) {
    echo $num4;
}

// 数组
$arr = array("cici", 10, true, 10e3);
//echo $arr[0]; // 0

//NULL 值
//if($arr[0] == NULL){
//    echo "arr[4] is null";
//}


///PHP 字符串函数

//strlen() 函数返回字符串的长度，以字符计。
//echo strlen("Hello world!"); // 12

//PHP strpos() 函数
//strpos() 函数用于检索字符串内指定的字符或文本。
//echo strpos("Hello world!","World");

//$txt1 = "Hello";
//$txt1 .= " world!";
//echo $txt1;

$a2 = array("cici", 2);
$a1 = array("liangshiting", 1, "high");
$a4 = $a2 + $a1;
var_dump($a4);


$a1 = array("a" => "liangshiting", "b" => 1, "c" => "high");
$a2 = array("d" => "cici", "e" => 2);
//$a3 = $a1 + $a2;
//var_dump($a3);
//$x = 2;
//switch ($x) {
//    case 1:
//        echo "Number 1";
//        break;
//    case 2:
//        echo "Number 2";
//        break;
//    case 3:
//        echo "Number 3";
//        break;
//    default:
//        echo "No number between 1 and 3";
//}
//echo "<br>";
//for ($x = 0; $x <= 10; $x++) {
//    echo "数字是：$x <br>";
//}

$colors = array("red", "green", "blue", "yellow");

foreach ($colors as $value) {
    echo "$value <br>";
}

count($colors);


function chen($name="chen"){
    echo $name."long";
}
chen("Jack");


?>
</body>
</html>
