<html>
<head>
<link rel="shortcut icon" type="image/x-icon" href="https://cdn.discordapp.com/emojis/585580554871635969.png" />
<title>VladLand</title>
<style>
body {
	background-color: #404040;
	color:#FFFFFF;
}
.banner {
  background-image: url("https://s4.anilist.co/file/anilistcdn/user/banner/b147557-uBI077baGXkR.jpg");
  height: 50%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}
</style>
</head>
<body>
<div class="banner">
<h1>Home</h1>
</div>
<?php
//table names are users and waifulist
$link = mysqli_connect('host', 'user', 'password', 'database', 'port');
if (!$link) {
die('Could not connect: ' . mysqli_error());
}

$sql = "SELECT * FROM users;";
$result = mysqli_query($link, $sql);
//$resultcheck = mysqli_num_rows($result);
echo '<table style="width:100%">';

$counter=0;
	while($row = mysqli_fetch_assoc($result)){
		$counter=$counter+1;
		if($counter==1)
		{
			echo '<tr>';
		}
		echo '<form action="/post.php" method="post">';
		echo '<input type="hidden" id="uservalue" name="uservalue" value="'.$row['userid'].'">';
		echo '<input type="hidden" id="username" name="username" value="'.$row['username'].'">';
		echo '<input type="hidden" id="divorcer" name="divorcer" value="1">';
		echo '<input type="hidden" id="divorce1" name="divorce1" value="1">';
		echo '<input type="hidden" id="sort" name="sort" value="0">';
		echo '<td><input type="image" id="'.$row['userid'].'" value="'.$row['userid'].'" src="'.$row['avatar'].'" style="width:200px;"/></a>
		<p><b>'.$row['username'].'</b></p>
		</td></form>';
		if($counter==6)
		{
			echo '</tr>';
			$counter=0;
		}
		
	}
echo '</table>';





//echo 'Connected successfully';
mysqli_close($link);


?>
</body>
</html>
