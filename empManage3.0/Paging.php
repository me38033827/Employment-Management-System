<?php
    class Paging{
        public $pageSize=6;
        public $res_array;      //显示数据
        public $rowCount;      //这是从数据库中获取的
        public $pageNow;     //用户指定
        public $pageCount;     //计算得到
        public $navigate;
        public $gotoUrl;   //表示把分页请求提交给哪个页面
        
    }


?>