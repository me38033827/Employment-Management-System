<html>
<head>
<meta http-equiv="content-type"content="text/html;charset=utf-8"/>
<title>
雇员管理列表
</title>
</head>

<?php
    require_once 'EmpService.class.php';
    $conn=mysql_connect("localhost","root","root");
    mysql_query("set names utf8");
    mysql_select_db("empmanage",$conn);
    //创建一个分页对象实例
    require_once 'Paging.php';
    $paging=new Paging();
    $paging->pageNow=1;
    $paging->pageSize=6;
    
    /*$pageSize=6;
    $rowCount=0;   //这个变量值，要从数据库表emp获取
    $pageNow=1;//显示第几页;
    $pageCount=0;//表示共有多少页;*/
    
    if(!empty($_GET['pageNow']))
    {
    $paging->pageNow=$_GET['pageNow'];
    }
    
    $empService=new EmpService();
    $empService->getPaging($paging);
    
    /*
    //创建了EmpService对象实例
    $empService=new EmpService();
    //调用getPageCount方法，获取共有多少页
    $pageCount=$empService->getPageCount($pageSize);
    
    $res=$empService->getEmpListByPage($pageNow, $pageSize);
    */
    
    echo"<table width='700px' bordercolor='green' cellspacing='0px'border='1px'>";
    echo"<tr><th>id</th><th>name</th><th>grede</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>";
    //这里我们需要循环的显示用户的信息
    //我们需要通过数组去取
    /*while($row=mysql_fetch_assoc($res)){
        echo"<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td>".
        "<td><a href='#'>删除用户</a></td><td><a href=''>修改用户</a></td></tr>";
    }*/
    for($i=0;$i<count($paging->res_array);$i++){
        $row=$paging->res_array[$i];
        echo"<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td>".
            "<td><a href='#'>删除用户</a></td><td><a href=''>修改用户</a></td></tr>";
    }
    echo"<h1>雇员信息列表</h1>";
    echo"</table>";
    //打印出页码的超链接
//     for($i=1;$i<=$pageCount;$i++){
//         echo"<a href='empList.php?pageNow=$i'>$i</a>&nbsp";
//     }
    //显示上一页和下一页
    echo"$paging->navigate";
    
    
    /*
    //使用for打印超链接
    $page_whole=10;
    $start=floor(($pageNow-1)/$page_whole)*$page_whole+1;
    $index=$start;
    if($pageNow>$page_whole){
        $index1=$start-($page_whole+1);
        echo"&nbsp;&nbsp;<a href='empList.php?pageNow=$index1'>&nbsp;&nbsp;<<</a>&nbsp;&nbsp;";
    }
    
    for(;$start<$index+$page_whole;$start++){
        echo"<a href='empList.php?pageNow=$start'>[$start]</a>";
    }
    
    echo"<a href='empList.php?pageNow=$start'>>></a>&nbsp;&nbsp;";
    
    //显示当前页和共有多少页
    echo "当前页{$pageNow}/共有{$pageCount}页";
    //制定跳转到某一页
    echo"<br/><br/>";
    */
    ?>
   <form action="empList.php">
        跳转到：<input type="text"name="pageNow"/>
    <input type="submit"value="Go"/>
    </form>
    
</html>