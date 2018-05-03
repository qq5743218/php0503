<?php
if( !isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id']) )
{
	echo '不對';
	echo '<a href="index.php">回到列表</a>';
	exit;
}

try {
	$db = new PDO('mysql:host=localhost;dbname=HomeWork2;charset=utf8'
		,'qq5743218','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	echo "ERROR:";
	echo $err->getMessage();  //真實世界不這樣做
	echo '<a href="forum.php?id='.$_GET['id'].'">回到列表</a>';
	exit;
}

$stmt = $db->prepare('delete from reply where f_id=?');
$stmt->execute([$_GET['id']]);

$stmt = $db->prepare('delete from forum where f_id=?');
$stmt->execute([$_GET['id']]);

header('Location: index.php',TRUE,303);  //沒寫,TRUE,333也可以，但是..
