
<html>
<head>
<meta http-equiv="content-type"content="text/html;charset=utf-8"/>
</head>
<img src="images/2.gif"width="200px"height="100px">
<hr/>
<?php
    require_once 'common.php';
    checkUserValidate();
    echo"欢迎".$_GET['name']."登陆成功";
    echo"<br/><a href='login.php'>返回重新登录</a>";
    getLastTime();
    
?>
<h1>主界面</h1>
<a href="empList.php">管理用户</a><br/>
<a href="addEmp.php">添加用户</a><br/>
<a href="">查询用户</a><br/>
<a href="">退出系统</a><br/>
<hr/>
<img src="images/logo.jpg" width="200px">
</html>