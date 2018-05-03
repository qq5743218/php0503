<!DOCTYPE html>
<html lang="zh_Hant">
<head>
	<meta charset="utf-8">
	<title>編輯</title>
</head>
<body style="padding-top: 60px; background-color: 	#FFDDAA">
<?php
//取得要編輯的id, 確認格式正確
if( !isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id']) )
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
	echo '<a href="index.php">回到列表</a>';
	exit;
}

//查詢
$stmt = $db->prepare('select * from kanban where k_id = ?');
$stmt->execute([$_GET['id']]);

//檢查結果
$row = $stmt->fetch();
if( !$row ){
	echo '資料不存在';
	echo '<a href="index.php">回到列表</a>';
	exit;
}
?>

<form method="POST" action="update.php">
	<input type="hidden" name="id" value="<?php echo $row['k_id']; ?>">
	請輸入論壇名稱：<input type="text" name="kname" value="<?php echo $row['k_name'];?>">
	<input type="submit"> <a href="index.php">取消</a>
</form>

</body>
</html>