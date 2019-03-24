<?php

    //接受用户的数据
    //1.id
    $id=$_POST['id'];
    //2.pws
    $password=$_POST['password'];
    //到mysql去验证
    //1.得到链接
    $conn=mysql_connect("localhost","root","root");
    if(!$conn){
        die("链接失败".mysql_errorno());
    }
    //设置访问数据库的编码形式
    mysql_query("set names utf8",$conn)or die(mysql_error());
    //选择数据库
    mysql_select_db("empmanage",$conn)or die(mysql_errno());
    //发送sql语句，验证
    //防止sql注入攻击
    //变化验证逻辑
    $sql="select password,name from admin where id=$id";
    //1.通过输入的id来获取数据库中的密码，然后和输入的密码比对;
    $res=mysql_query($sql,$conn);
    if($row=mysql_fetch_assoc($res)){
        //查询到。
        //取出数据库的密码
        if($row['password']==md5($password)){
            //说明合法
            //取出用户的名字
            $name=$row['name'];
            header("Location:empManage.php?name=$name");
            exit();
        }
        header("Location:login.php?errno=1");
        exit();
    }
    //关闭资源
    mysql_free_result($res);
    mysql_close($conn);
    //简单验证(先不到数据库)
    //     if($id=="100"&&$password=="123"){
    //         //合法
    //         header("Location:empManage.php");
    //         //如果要跳转，则最好exit();
    //         exit();
    //     }else{
    //         //非法用户
    //         header("Location:login.php?errno=1");
    //         exit();    
    //     }
    ?>
