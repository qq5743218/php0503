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
	echo '<a href="forum.php?id='.$_GET['id'].'">回到列表</a>';
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

<form method="POST" action="update2.php">
	<input type="hidden" name="id" value="<?php echo $row['f_id']; ?>">
	<br>
	請輸入標題(限制20字以內)：
	<input type="text" style="width:500px;height:20px;" name="title" value="<?php echo $row['f_title']; ?>">
	<br>
	內容(限制500字以內)：
	<br>
	<input type="text" style="width:600px;height:500px;" name="content" value="<?php echo $row['f_content']?>">
	<br>
	<input type="submit"> 
	<?php
	echo '<a href="forum.php?id='.$_GET['id'].'">取消</a>'
	?>
	</form>

</body>
</html>