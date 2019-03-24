<html>
<head>
<meta http-equiv="content-type"content="text/html;charset=utf-8"/>
<title>
雇员管理列表
</title>
<script type="text/javascript">
<!--
	function confirmDele(val){
		return window.confirm("是否要删除id为"+val+"的用户");
	}
//-->
</script>
</head>
<img src="images/2.gif"width="200px"height="100px">
<hr/>
<?php
    require_once 'EmpService.class.php';
    require_once 'common.php';
    checkUserValidate();
    //创建一个分页对象实例
    require_once 'Paging.php';
    $empService=new EmpService();
    
    $paging=new Paging();
    $paging->pageNow=1;
    $paging->pageSize=6;
    $paging->gotoUrl='empList.php';
    
    if(!empty($_GET['pageNow']))
    {
    $paging->pageNow=$_GET['pageNow'];
    }
    

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
    
    for($i=0;$i<count($paging->res_array);$i++){
        $row=$paging->res_array[$i];
        echo"<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td>".
            "<td><a onclick='return confirmDele({$row['id']})' href='empProcess.php?flag=del&id={$row['id']}'>删除用户</a></td><td><a href='updateEmpUI.php?id={$row['id']}'>修改用户</a></td></tr>";
    }
    echo"<h1>雇员信息列表</h1>";
    echo"</table>";
 
    //显示上一页和下一页
    echo"$paging->navigate";
    
    
    
    
    //显示当前页和共有多少页
    echo "当前页{$paging->pageNow}/共有{$paging->pageCount}页";
    //制定跳转到某一页
    echo"<br/><br/>";
    
    ?>
   <form action="empList.php">
        跳转到：<input type="text"name="pageNow"/>
    <input type="submit"value="Go"/>
    </form>
    <hr/>
<img src="images/logo.jpg" width="200px">
</html>