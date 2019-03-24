<?php
    require_once 'SqlHelper.class.php';
    require_once 'Emp.class.php';
    class EmpService{
    
    //一个函数可以获取共有多少页
    function getPageCount($pageSize){
        
        //需要查询出$rowCount
        $sql="select count(id) from emp";
        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dql($sql);
        //这样就可以计算出$pageCount
        if($row=mysql_fetch_row($res)){
            $pageCount=ceil($row[0]/$pageSize);
        }
        
        //释放资源，关闭链接
        mysql_free_result($res);
        $sqlHelper->close_connect();
        return $pageCount;
    }
    
    //一个函数可以获取应当显示的雇员信息
    function getEmpListByPage($pageNow,$pageSize){
        $sql="select * from emp limit ".($pageNow-1)*$pageSize.",$pageSize";
        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dql2($sql);
        
        //释放资源关闭连接
        $sqlHelper->close_connect();
        return $res;
        
    }
    
    //第二种使用封装的方式完成分页
    function getPaging($paging){
        $sqlHelper=new SqlHelper();
        $sql1="select * from emp limit "
            .($paging->pageNow-1)*$paging->pageSize.","
            .$paging->pageSize;
        $sql2="select count(id) from emp";
        $sqlHelper->execute_dql_paging($sql1, $sql2, $paging);
        $sqlHelper->close_connect();
    }
    
    //根据id删除emp记录
    public function delEmpById($id){
        $sql="delete from emp where id=$id";
        $sqlHelper=new SqlHelper();
        return $sqlHelper->execute_dml($sql);
    }
    
    //添加emp
    public function addEmp($name,$grade,$email,$salary){
        $sql="insert into emp (name,grade,email,salary) values ('$name','$grade','$email','$salary')";
        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dml($sql);
        $sqlHelper->close_connect();
        return $res;
        
    }
    public function getEmpById($id){
        $sql="select * from emp where id=$id";
        $sqlHelper=new SqlHelper();
        $arr=$sqlHelper->execute_dql2($sql);
        $sqlHelper->close_connect();
        $emp=new Emp();
        $emp->setEmail($arr[0]['email']);
        $emp->setName($arr[0]['name']);
        $emp->setGrade($arr[0]['grade']);
        $emp->setSalary($arr[0]['salary']);
        $emp->setId($arr[0]['id']);
        
        return $emp;

    }
    public function updateEmp($id,$name,$grade,$email,$salary){
        $sql="update emp set name='$name' , grade=$grade , email='$email' , salary=$salary where id=$id";
        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dml($sql);
        $sqlHelper->close_connect();
        return $res;
        
    }
    }
?>