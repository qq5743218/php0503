<?php
if( !isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id']) )
{
	echo '����';
	echo '<a href="index.php">�^��C��</a>';
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
	echo $err->getMessage();  //�u��@�ɤ��o�˰�
	echo '<a href="forum.php?id='.$_GET['id'].'">�^��C��</a>';
	exit;
}

$stmt = $db->prepare('delete from reply where f_id=?');
$stmt->execute([$_GET['id']]);

$stmt = $db->prepare('delete from forum where f_id=?');
$stmt->execute([$_GET['id']]);

header('Location: index.php',TRUE,303);  //�S�g,TRUE,333�]�i�H�A���O..
