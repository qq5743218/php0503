<!DOCTYPE html>
<html lang="zh_Hant">
<head>
	<meta charset="utf-8">
	<title>首頁</title>
</head>
<body style="padding-top: 60px; background-color: 	#FFDDAA">
<h2>歡迎來到論壇系統</h2>
<br><br>
<a href="add_forum.html">新增論壇</a>
<?php
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
	exit;
}

//查詢
//等同 $stmt = $db->query('select * from moneybook');
$stmt = $db->prepare('select * from kanban');
$stmt->execute();

echo '<table border=1>';  //border=1 事後請改用CSS處理
while($row = $stmt->fetch()){  //小心,此處的=號是把右邊的值存往左側
	echo '<tr>';
	//echo '<td>'.$row['m_id'].'</td>';
	echo '<td>!</td>';
	echo '<td>';
	echo '<a href="forum.php?id='.$row['k_id'].'">'.$row['k_name'].'</a>';
	echo '<td>';
	echo '<a href="edit.php?id='.$row['k_id'].'">修改</a> | ';
	echo '<a href="delete.php?id='.$row['k_id'].'">刪除</a>';
	echo '</td>';
	echo '</td>';
	echo '</tr>';
}
echo '</table>';
?>
<hr>
<br>
</body>
</html>