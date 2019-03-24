<?php
    require_once 'AdminServi.class.php';
    //接受用户的数据
    //1.id
    $id=$_POST['id'];
    //2.pws
    $password=$_POST['password'];
    //实例化一个AdminService方法
    $adminService=new AdminService();
    if($name=$adminService->checkAdmin($id, $password)){
        header("Location:empManage.php?name=$name");
        exit();
        
    }else{
        header("Location:login.php?errno=1");
        exit();
    }
   
    ?>
