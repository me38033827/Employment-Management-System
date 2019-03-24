<html>
<head>
<meta http-equiv="content-type"content="text/html;charset=utf-8"/>
<title>
雇员管理列表
</title>
</head>
<?php
    $conn=mysql_connect("localhost","root","root");
    mysql_query("set names utf8");
    mysql_select_db("empmanage",$conn);
    //
    $pageSize=3;
    $rowCount=0;   //这个变量值，要从数据库表emp获取
    $pageNow=1;//显示第几页;
    $pageCount=0;//表示共有多少也;
    if(!empty($_GET['pageNow']))
    {
    $pageNow=$_GET['pageNow'];
    }
    $sql="select count(id) from emp";
    $res2=mysql_query($sql,$conn);
    //取出行数
    if($row=mysql_fetch_row($res2)){
        $rowCount=$row[0];
    }
    //计算共有多少页
    $pageCount=ceil($rowCount/$pageSize);
    
    $sql="select * from emp limit ".($pageNow-1)*$pageSize.",$pageSize";
    $res=mysql_query($sql,$conn);
    echo"<table width='700px' bordercolor='green' cellspacing='0px'border='1px'>";
    echo"<tr><th>id</th><th>name</th><th>grede</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>";
    //这里我们需要循环的显示用户的信息
    while($row=mysql_fetch_assoc($res)){
        echo"<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td>".
        "<td><a href='#'>删除用户</a></td><td><a href=''>修改用户</a></td></tr>";
    }
    echo"<h1>雇员信息列表</h1>";
    echo"</table>";
    //打印出页码的超链接
    for($i=1;$i<=$pageCount;$i++){
        echo"<a href='empList.php?pageNow=$i'>$i</a>&nbsp";
    }
    
    
    
    
    mysql_free_result($res);
    mysql_close($conn);
?>
</html>