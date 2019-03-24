<?php
    require_once 'EmpService.class.php';
    //接收用户要删除的用户id
    $empService=new EmpService();
    
    
    if(!empty($_REQUEST['flag'])){
        //这时我们知道要删除用户
        $flage=$_REQUEST['flag'];
        if($flage=="del"){
            $id=$_REQUEST['id'];
            if($empService->delEmpById($id)==1){
                    header("Location:ok.php");
                    exit();
               
                }else{
                    header("Location:error.php");
                    exit();
                    
                }
         }else if($flage=="addemp"){
             $name=$_POST['name'];
             $grade=$_POST['grade'];
             $email=$_POST['email'];
             $salary=$_POST['salary'];
             $res=$empService->addEmp($name, $grade, $email, $salary);
             if($res=1){
                 header("Location:ok.php");
                    exit();
             }else{
                 header("Location:error.php");
                 exit();
             }   
         }else if($flage=="updateemp"){
             $id=$_POST['id'];
             $name=$_POST['name'];
             $grade=$_POST['grade'];
             $email=$_POST['email'];
             $salary=$_POST['salary'];
             $res=$empService->updateEmp($id,$name, $grade, $email, $salary);
             if($res=1){
                 header("Location:ok.php");
                 exit();
             }else{
                 header("Location:error.php");
                 exit();
             }
             
         }
    }
    ?>