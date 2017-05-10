<?php
// include 'conn.php';
// // 执行 SQL 查询
// //$query = 'SELECT * FROM userdata';
// // 释放结果集
// //mysqli_free_result($result);

// // 测试注册
// $sql_reg_insert = <<<cici
// insert into userdata(username,password,nickname,email,mobile) values('1','2','2','2','2')
// cici;
// mysqli_query($link, $sql_reg_insert);
// if (mysqli_affected_rows($link)) {
//     echo "succeed!";
// } else {
//     echo "bad!";
//     exit;
// }

// // 关闭连接
// mysqli_close($link);
// echo $_POST['dsds']

if($_POST['username'] == 'jack'){
    echo "YES";
}else{
    echo "NO";
}
?>