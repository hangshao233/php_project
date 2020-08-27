<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>学生信息管理</title>
	<script>
		function doDel(id) {
			if (confirm("确定要删除么？")) {
				window.location = 'action.php?action=del&id='+id;
			}
		}
	</script>
</head>
<body>
<center>
	<?php
		include_once "menu.php";
	?>
	<h3>浏览学生信息</h3>
	<table width="600" border="1">
		<tr align="center">
			<th>学号</th>
			<th>姓名</th>
			<th>性别</th>
			<th>年龄</th>
			<th>班级</th>
			<th>操作</th>
		</tr>
	<?php
		//1.连接数据库
		$mysql_conf1 = array(
			'host'    => '127.0.0.1', 
			'db'      => 'student', 
			'db_user' => 'root', 
			'db_pwd'  => 'root'
		);
		try {
			$pdo1 = new PDO("mysql:host=" . $mysql_conf1['host'] . ";dbname=" . $mysql_conf1['db'], $mysql_conf1['db_user'], $mysql_conf1['db_pwd']);
		} catch (PDOException $e) {
			die("数据库连接失败" . $e->getMessage());
		}
		//2.解决中文乱码问题
		$pdo1->query("SET NAMES 'UTF8'");
		//3.执行sql语句，并实现解析和遍历
		$sql1 = "SELECT * FROM stu ";
		foreach ($pdo1->query($sql1) as $row) {
			echo "<tr align='center'>";
			echo "<td>{$row['id']}</td>";
			echo "<td>{$row['name']}</td>";
			echo "<td>{$row['sex']}</td>";
			echo "<td>{$row['age']}</td>";
			echo "<td>{$row['classid']}</td>";
			echo "<td>
					<a href='javascript:doDel({$row['id']})'>删除</a>
					<a href='edit.php?id=({$row['id']})'>修改</a>
				</td>";
			echo "</tr>";
		}
	?>
	</table>
	
	<br>
	<br>
	<br>
	
	<h3>浏览成绩信息</h3>
	<table width="600" border="1">
		<tr  align="center">
			<th>学号</th>
			<th>姓名</th>
			<th>专业课成绩</th>
			<th>操作</th>
		</tr>
	<?php
		//1.连接数据库
		$mysql_conf2 = array(
			'host'    => '127.0.0.1', 
			'db'      => 'student', 
			'db_user' => 'root', 
			'db_pwd'  => 'root'
		);
		try {
			$pdo2 = new PDO("mysql:host=" . $mysql_conf2['host'] . ";dbname=" . $mysql_conf2['db'], $mysql_conf2['db_user'], $mysql_conf2['db_pwd']);
		} catch (PDOException $e) {
			die("数据库连接失败" . $e->getMessage());
		}
		//2.解决中文乱码问题
		$pdo2->query("SET NAMES 'UTF8'");
		//3.执行sql语句，并实现解析和遍历
		$sql2 = "SELECT * FROM stu_score ";
		foreach ($pdo2->query($sql2) as $row) {
			echo "<tr align='center'>";
			echo "<td>{$row['id']}</td>";
			echo "<td>{$row['name']}</td>";
			echo "<td>{$row['score']}</td>";
			echo "<td>
					<a href='javascript:doDel({$row['id']})'>删除</a>
					<a href='edit.php?id=({$row['id']})'>修改</a>
				</td>";
			echo "</tr>";
		}
	?>
	</table>
	
</center>
</body>
</html>