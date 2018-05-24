<?php
//輸入====================================================

//資料庫建立==============================================

try {
	$db = new PDO('mysql:host=localhost;dbname=test0329;charset=utf8'
		,'mememe','123456', array( 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		) );
}catch(PDOException $err) {
	echo "ERROR:";
	echo $err->getMessage();  //真實世界不這樣做
	echo '<a href="list.php">回到列表</a>';
	exit;
}
//查詢====================================================

$stmt = $db->prepare('select * from moneybook');
$stmt->execute();

//輸出====================================================

$data = array();

while($row = $stmt->fetch()){
	$data[] = (object)[
		'prod' => $row['name'],
		'price' => $row['cost'],
		'id' => $row['m_id']
	];
	
}

http_response_code(200);
header("Content-type: application/json;charset=UTF-8");
echo json_encode($data);