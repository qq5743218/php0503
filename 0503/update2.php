<?php
if( !isset($_POST['id']) 
	|| !isset($_POST['title']) || !isset($_POST['content'])
	|| empty($_POST['id'])
	|| empty($_POST['title']) || empty($_POST['content']) 
	|| !is_numeric($_POST['id']) )
{
	echo '不對';
	echo '<a href="index.php">回到列表</a>';
	exit;
}

//資料庫連線
try {
	$db = new PDO('mysql:host=localhost;dbname=HomeWork2;charset=utf8'
		,'qq5743218','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	echo "ERROR:";
	echo $err->getMessage();  //真實世界不這樣做
	echo '<a href="forum.php?id='.$_POST['id'].'">回到列表</a>';
	exit;
}

//查詢
$stmt = $db->prepare('update forum set f_title=?,f_content=? where f_id=?');
$stmt->execute([$_POST['title'],$_POST['content'],$_POST['id']]);

//善後
header('Location: index.php',TRUE,303);  //沒寫,TRUE,333也可以，但是..