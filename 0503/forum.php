<!DOCTYPE html>
<html lang="zh_Hant">
<head>
	<meta charset="utf-8">
	<title>論壇</title>
</head>
<body style="padding-top: 60px; background-color: 	#FFDDAA">
<h2>歡迎來到文章系統</h2>
<br><br>

<?php
echo '<a href="add_forum2.php?id='.$_GET['id'].'">新增文章</a>';
echo '<a href="index.php"> | 回到列表</a>';
//連接資料庫
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
//等同 $stmt = $db->query('select * from moneybook');
$stmt = $db->prepare('select * from forum where k_id = ?');
$stmt->execute([$_GET['id']]);



//檢查結果
/*
$row = $stmt->fetch();
if( !$row ){
	echo '目前沒有文章';
	exit;
}
*/

//echo '<a href="add_forum2.php?id='.$row['k_id'].'">新增文章</a>';

echo '<table border=1>';  //border=1 事後請改用CSS處理
while($row = $stmt->fetch()){  //小心,此處的=號是把右邊的值存往左側

	echo '<tr>';
	//echo '<td>'.$row['m_id'].'</td>';
	echo '<td width="20">！</td>';
	echo '<td width="200">';
	echo '<a href="content.php?id='.$row['f_id'].'">'.$row['f_title'].'</a>';
	echo '<td>';
	echo '<a href="edit2.php?id='.$row['f_id'].'">修改</a> | ';
	echo '<a href="delete2.php?id='.$row['f_id'].'">刪除</a>';
	echo '</td>';
	echo '</td>';
	echo '</tr>';
	echo '<br>';
}
echo '</table>';
?>
</body>
</html>