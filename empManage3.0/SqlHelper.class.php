<?php
    require_once 'Paging.php';
    //这是一个工具类，作用是完成对数据库的操作
    class SqlHelper{
        
        public $conn;
        public $dbname="empmanage";
        var $username="root";
        var $password="root";
        var $host="localhost";
        public function __construct(){
            $this->conn=mysql_connect($this->host,$this->username,$this->password);
            if(!$this->conn){
                die("链接失败".mysql_error());
            }
            mysql_select_db($this->dbname,$this->conn);
        }
        //执行dql语句
        public function execute_dql($sql){
            $res=mysql_query($sql,$this->conn) or die(mysql_error());
            
            return $res;
            //
        }
        //执行dql语句，返回一个数组
        public function execute_dql2($sql){
            $arr=array();
            $res=mysql_query($sql,$this->conn) or die(mysql_error());
            //$i=0;
            //把res=arr
            while($row=mysql_fetch_assoc($res)){
                $arr[]=$row;
            }
            //合理可以马上把$res关闭
            mysql_free_result($res);
            return $arr;
            //
        }
        //考虑分页情况的查询
        //$sql1='select * from where 表名 limit 0,6';
        //$sql2='select count(*) from 表名'
        public function execute_dql_paging($sql1,$sql2,&$paging){
          $res=mysql_query($sql1,$this->conn) or die(mysql_error());  
          $arr=array();
          while($row=mysql_fetch_assoc($res)){
              $arr[]=$row;
          }
          mysql_free_result($res);
          $res=mysql_query($sql2,$this->conn) or die(mysql_error());
          if($row=mysql_fetch_row($res)){
              $paging->pageCount=ceil($row[0]/$paging->pageSize);
              $paging->rowCount=$row[0];          
          }
          $paging->res_array=$arr;
          mysql_free_result($res);

          
          if($paging->pageNow>1){
              $prePage=$paging->pageNow-1;
              $paging->navigate= "<a href='{$paging->gotoUrl}?pageNow=$prePage'>上一页</a>&nbsp";
          }
          if($paging->pageNow<$paging->pageCount){
              $nextPage=$paging->pageNow+1;
              $paging->navigate.="<a href='{$paging->gotoUrl}?pageNow=$nextPage'>下一页</a>&nbsp";
          }
          //使用for打印超链接
          $page_whole=10;
          $start=floor(($paging->pageNow-1)/$page_whole)*$page_whole+1;
          $index=$start;
          if($paging->pageNow>$page_whole){
              $index1=$start-($page_whole+1);
              $paging->navigate.="&nbsp;&nbsp;<a href='{$paging->gotoUrl}?pageNow=$index1'>&nbsp;&nbsp;<<</a>&nbsp;&nbsp;";
          }
          
          for(;$start<$index+$page_whole;$start++){
              $paging->navigate.="<a href='{$paging->gotoUrl}?pageNow=$start'>[$start]</a>";
          }
          
          $paging->navigate.="<a href='{$paging->gotoUrl}?pageNow=$start'>>></a>&nbsp;&nbsp;";
          
        }
        //执行dml语句
        public function execute_dml($sql){
         $b=mysql_query($sql,$this->conn) or die(mysql_error());
         if(!$b){
             return 0;
             
         }else{
             if(mysql_affected_rows($this->conn)>0){
                 return 1;//表示执行成功
             }else {
                 return 2;//表示没有行受影响
             }
         }
         
        }
        //关闭链接
        public function close_connect(){
            if(!empty($this->conn)){
                mysql_close($this->conn);
            }
            
            
        }
    }
?>