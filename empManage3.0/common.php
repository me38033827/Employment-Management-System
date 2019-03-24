<?php
    function getLastTime(){
        if(!empty($_COOKIE['lastVisit'])){
            echo"你上次登陆的时间是".$_COOKIE['lastVisit'];
            setcookie("lastVisit",date("Y-m-d  H:i:s"),time()+360000);
            
        }else{
            echo"你是第一次登录";
            setcookie("lastVisit",date("Y-m-d  H:i:s"),time()+24*360000);
            
        }
        
    }

    function getCookieVal($key){
        if(empty($_COOKIE[$key])){
            return"";
            
        }else{
             return $_COOKIE[$key];
            
        }
        
    }
    //把验证用户是否合法封装函数
    function checkUserValidate(){
        session_start();
        if(empty($_SESSION['loginuser'])){
            header("Location: login.php?errno=1");
        }
    }
    

?>