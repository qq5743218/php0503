<head>
	<meta charset="utf-8">
	<title>文章</title>
</head>
<body style="padding-top: 60px; background-color: 	#FFDDAA">
<?php
	echo '<a href="index.php"> | 回到列表</a>  |  ';
//資料庫連線
try {
	$db = new PDO('mysql:host=localhost;dbname=HomeWork2;charset=utf8'
		,'qq5743218','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
		$i = 1;
}catch(PDOException $err) {
	echo "ERROR:";
	echo $err->getMessage();  //真實世界不這樣做
	echo '<a href="forum.php?id='.$_GET['id'].'">回到列表</a>';
	exit;
}



//查詢
$stmt = $db->prepare('select * from forum where f_id = ?');
$stmt->execute([$_GET['id']]);

//檢查結果
$row = $stmt->fetch();
if( !$row ){
	echo '資料不存在';
	echo '<a href="forum.php?id='.$_GET['id'].'">回到列表</a>';
	exit;
}
?>

<form>
	<input type="hidden" name="id" value="<?php echo $row['f_id']; ?>">
	標題:
	<?php 
		echo $row['f_title'];
	?>
	<hr>
	<br><br>
	內容:
	<?php
		echo $row['f_content'];
		echo '<br><br><br><br>';
	?>
	發表者:
	<?php
		echo $row['f_name'];
		echo '<br><br><br><br>';
	/*
		$rerow = $re->fetch();
		if( !$rerow ){
		echo '目前尚未有留言';
		}
		*//*
	while($roww = $re->fetch()){
		$roww['r_id'] = 1;
		echo $roww['r_id'];
		$roww['r_id'] = $roww['r_id'] + 1;
		echo '<br>';
		echo $roww['r_content'];
		echo '<hr>';
	}*/
	
	?>
	<?php

	
	echo '<a href="add_reply.php?id='.$_GET['id'].'">留言</a>';
	?>
	<hr>
</form>
<?php

/*
//查詢
$stmtt = $db->prepare('select * from reply where r_id = ?');
$stmt->execute();

//檢查結果
$roww = $stmtt->fetch();
if( !$roww ){
	echo '資料不存在';
	echo '<a href="forum.php?id='.$_GET['id'].'">回到列表</a>';
	exit;
}
*/

	$stmtt = $db->prepare('select * from reply where f_id = ?');
	$stmtt->execute([$_GET['id']]);
	while($roww = $stmtt->fetch()){
	echo '<hr>';
	echo '<h3>樓層: '.$i.'</h3>';
	echo $roww['r_content'];
	echo '<br>';
	echo '<h3>發表者: </h3>';
	echo $roww['r_name'];
	echo '<br>';
	$i = $i+1;
	}
	
?> 
</body>