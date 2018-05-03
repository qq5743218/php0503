<!DOCTYPE html>
<html lang="zh_Hant">
<head>
	<meta charset="utf-8">
	<title>發表文章</title>
</head>
<body style="padding-top: 60px; background-color: 	#FFDDAA">

<form method="POST" action="add2.php">
	請輸入標題(限制20字以內)：
	<input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
	<br>
	<textarea style="width:500px;height:20px;" name="title"></textarea>
	<br>
	內容(限制500字以內)：
	<br>
	<textarea style="width:600px;height:500px;" name="content" ></textarea>
	<br>
	發表者:
	<br>
	<input type="text" name="namee">
	<br>
	<input type="submit"> 
	<?php
	echo '<a href="forum.php?id='.$_GET['id'].'">取消</a>';
	?>
</form>

</body>
</html>