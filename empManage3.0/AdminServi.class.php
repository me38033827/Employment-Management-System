<?php
    require_once 'SqlHelper.class.php';
    //该类是个业务逻辑处理类，主要完成对admin表的业务逻辑操作
    class AdminService{
        //提供一个验证用户是否合法的方法
        public function checkAdmin($id,$password){
            $sql="select password,name from admin where id=$id";
            //创建一个sqlHelper对象
            $sqlHelper=new SqlHelper();
            $res=$sqlHelper->execute_dql($sql);
            if($row=mysql_fetch_assoc($res)){
                //比对密码
                if(md5($password)==$row['password']){
                    return $row['name'];
                }
            }
            
            //释放资源
            mysql_free_result($res);
            //关闭链接
            $sqlHelper->close_connect();
            return false;
        
        }
        
        
    }
    
?>