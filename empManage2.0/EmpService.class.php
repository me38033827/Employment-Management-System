<?php
    require_once 'SqlHelper.class.php';
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
    
    }
?>