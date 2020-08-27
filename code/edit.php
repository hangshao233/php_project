<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>学生信息管理</title>

</head>
<body>
<center>
   <?php
		include_once"menu.php";
		//连接数据库
		$mysql_conf = array(
			'host'    => '127.0.0.1', 
			'db'      => 'student', 
			'db_user' => 'root', 
			'db_pwd'  => 'root'
		);
		try {
			$pdo = new PDO("mysql:host=" . $mysql_conf['host'] . ";dbname=" . $mysql_conf['db'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);
		} catch (PDOException $e) {
			die("数据库连接失败" . $e->getMessage());
		}
		$pdo->query("SET NAMES 'UTF8'");	//防止中文乱码
		
		//拼接sql语句，取出信息
		$sql1 = "SELECT * FROM stu WHERE id =".$_GET['id'];
		$sql2 = "SELECT * FROM stu_score WHERE id =".$_GET['id'];
		$stmt1 = $pdo->query($sql1);	//返回预处理对象
		$stmt2 = $pdo->query($sql2);	//返回预处理对象
		if($stmt1->rowCount()>0 && $stmt2->rowCount()>0){
			$stu = $stmt1->fetch(PDO::FETCH_ASSOC);	//按照关联数组进行解析
			$stu_score = $stmt2->fetch(PDO::FETCH_ASSOC);	//按照关联数组进行解析
		}else{
			die("没有要修改的数据！");
		}
    ?>
    <form id="addstu" name="editstu" method="post" action="action.php?action=edit">
        <input type="hidden" name="id" id="id" value="<?php echo $stu['id'];?>"/>
        <table>
				 <tr>
                <td>学号</td>
                <td><input id="id" name="id" type="text" value="<?php echo $stu['id']?>"/></td>

            </tr>
            <tr>
                <td>姓名</td>
                <td><input id="name" name="name" type="text" value="<?php echo $stu['name']?>"/></td>

            </tr>
            <tr>
                <td>性别</td>
                <td><input type="radio" name="sex" value="男" <?php echo ($stu['sex']=="男")? "checked" : ""?>/> 男
                    <input type="radio" name="sex" value="女"  <?php echo ($stu['sex']=="女")? "checked" : ""?>/> 女
                </td>
            </tr>
            <tr>
                <td>年龄</td>
                <td><input type="text" name="age" id="age" value="<?php echo $stu['age']?>"/></td>
            </tr>
            <tr>
                <td>班级</td>
                <td><input id="classid" name="classid" type="text" value="<?php echo $stu['classid']?>"/></td>
            </tr>
				 <tr>
                <td>成绩</td>
                <td><input id="score" name="score" type="text" value="<?php echo $stu_score['score']?>"/></td>

            </tr>
            <tr>
                <td> </td>
                <td><input type="submit" value="修改"/>  
                    <input type="reset" value="重置"/>
                </td>
            </tr>
        </table>

    </form>



</center>
</body>
</html>