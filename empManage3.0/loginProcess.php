<?php
    require_once 'AdminServi.class.php';
    //接受用户的数据
    //1.id
    $id=$_POST['id'];
    //2.pws
    $password=$_POST['password'];
    $checkcode=$_POST['checkcode'];
    session_start();
    if($checkcode!=$_SESSION['myCheckCode'])
    {   
        header("Location:login.php?errno=2");
        exit();
    }
    //实例化一个AdminService方法
    $adminService=new AdminService();
    $name=$adminService->checkAdmin($id, $password);
    if($name!=""){
        session_start();
        $_SESSION['loginuser']=$name;  
        header("Location:empManage.php?name=$name");
        exit();
        
    }else{
        header("Location:login.php?errno=1");
        exit();
    }
   
   
    ?>
