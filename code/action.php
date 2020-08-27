<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>学生信息管理</title>
</head>
<body>
<center>
	<?php
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
	
	$id = $_POST['id'];
	$name = $_POST['name'];
	$sex = $_POST['sex'];
	$age = $_POST['age'];
	$classid = $_POST['classid'];
	$score = $_POST['score'];
	
	
	//通过action的值进行对应操作
	switch ($_GET['action']) {
		case 'add':{   //增加操作
			$sql1 = "INSERT INTO stu VALUES ('{$id}', '{$name}', '{$sex}', '{$age}', '{$classid}')";
			$sql2 = "INSERT INTO stu_score VALUES ('{$id}', '{$name}', '{$score}')";
			$rw1 = $pdo->exec($sql1);
			$rw2 = $pdo->exec($sql2);
			if ($rw1>0 && $rw2>0) {
				echo "<script> alert('增加成功');
								window.location='index.php'; //跳转到首页
					 </script>";
			} else {
				echo "<script> alert('增加失败');
								window.history.back(); //返回上一页
					 </script>";
			}
			break;
		}
		case "del": {    //获取表单信息
			$id = $_GET['id'];
			$sql3 = "DELETE FROM stu WHERE id={$id}";
			$sql4 = "DELETE FROM stu_score WHERE id={$id}";
			$pdo->exec($sql3);
			$pdo->exec($sql4);
			header("Location:index.php");	//跳转到首页
			break;
		}
		case "edit" :{   //获取表单信息
			$name = $_POST['name'];
			$sex = $_POST['sex'];
			$age = $_POST['age'];
			$classid = $_POST['classid'];
			$score = $_POST['score'];
			
			$sql5 = "UPDATE stu SET name='{$name}',sex='{$sex}',age='{$age}',classid='{$classid}' WHERE id='{$id}'";
			$sql6 = "UPDATE stu_score SET score='{$score}' WHERE id='{$id}'";
			$rw3 = $pdo->exec($sql5);
			$rw4 = $pdo->exec($sql6);
			if($rw3>0 || $rw4>0){
				echo "<script>alert('修改成功');window.location='index.php'</script>";
			}else{
				echo "<script>alert('修改失败');window.history.back()</script>";
			}
			break;
		}
	}
	?>
</center>
</body>
</html>