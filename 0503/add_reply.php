<!DOCTYPE html>
<html lang="zh_Hant">
<head>
	<meta charset="utf-8">
	<title>發表留言</title>
</head>
<body style="padding-top: 60px; background-color: 	#FFDDAA">

<form method="POST" action="add3.php">
	<input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
	<br>
	發表者:
	<input type="text" name="name">
	<br>
	內容(限制500字以內)：
	<br>
	<textarea style="width:600px;height:500px;" name="reply" ></textarea>
	<br>
	<input type="submit"> 
	<?php
	echo '<a href="forum.php?id='.$_GET['id'].'">取消</a>';
	?>
</form>

</body>
</html>