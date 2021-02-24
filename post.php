<html>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="https://cdn.discordapp.com/emojis/585580554871635969.png" />
	<title>Waifu Expert</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
body {
	background-color: #404040;
	color:#FFFFFF;
}
div.polaroid {
  width: 220px;
  background-color: #969696;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin-bottom: 25px;
  margin-left:10px;
  margin-right:10px;
  color: black;
  vertical-align: top!important;
}
	
div.container {
  text-align: center;
  padding: 10px 20px;
  vertical-align: top!important;
}	
	
	
#hvrBtn {
  display: none; /* Hidden by default */
  position: fixed; /* Fixed/sticky position */
  bottom: 20px; /* Place the button at the bottom of the page */
  right: 30px; /* Place the button 30px from the right */
  z-index: 99; /* Make sure it does not overlap */
  border: none; /* Remove borders */
  outline: none; /* Remove outline */
  background-color: red; /* Set a background color */
  color: white; /* Text color */
  cursor: pointer; /* Add a mouse pointer on hover */
  padding: 15px; /* Some padding */
  border-radius: 10px; /* Rounded corners */
  font-size: 18px; /* Increase font size */
}

#hvrBtn:hover {
  background-color: #555; /* Add a dark-grey background on hover */
}
	

.redBackground{
    background-color: white;  
}
	
	
.banner {
  background-image: url("https://s4.anilist.co/file/anilistcdn/user/banner/b147557-uBI077baGXkR.jpg");
  height: 40%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}
</style>

</head>
<body onload="javascript:toggleHide();definer()">
	<button onclick="topFunction()" id="hvrBtn" title="Go to top">Top</button>


<div class="banner">
<a href="https://waifu.expert"><h1>Home</h1></a>
</div>
<?php
session_start();
//table names are users and waifulist
$link = mysqli_connect('host', 'user', 'password', 'database', 'port');
if (!$link) {
die('Could not connect: ' . mysqli_error());
}

$userid = $_POST['uservalue'];
$username = $_POST['username'];
$sort = $_POST['sort'];
$divorce1 = $_POST['divorce1'];
$divorcer = $_POST['divorcer'];
$displaylist = $_POST['displaylist'];


if(isset($_SESSION['screen_width']) AND isset($_SESSION['screen_height'])){
	$swidth=$_SESSION['screen_width'];
} else if(isset($_REQUEST['width']) AND isset($_REQUEST['height'])) {
    $_SESSION['screen_width'] = $_REQUEST['width'];
    $_SESSION['screen_height'] = $_REQUEST['height'];
	$swidth=$_SESSION['screen_width'];
    header('Location: ' . $_SERVER['PHP_SELF']);
}else{}

$wwidth=$swidth/300;
if($wwidth<3){
	$wwidth=3;
}

echo '<input type="text" class="marrybox" id="marrybox" name="fname" value="" style="display: block; position:absolute;top:35%; right:125px;">
<button onclick="getmarry()" id="myBtn1" title="Get Marry String" style="display: block; position:absolute;top:35%; right:8px;">Get Marry String</button>
';

echo "<h1>  ".$username."'s harem</h1>";
echo '
	<button onclick="toggleHide()"style="position:absolute; top:38%;right:8px;">Divorce box</button>
	<form action="/post.php" method="post">

		<input type="hidden" id="uservalue" name="uservalue" value="'.$userid.'">
		<input type="hidden" id="username" name="username" value="'.$username.'">
		<input type="hidden" id="sort" name="sort" value="'.$sort.'">

		<select name="displaylist" id="displaylist" onchange="this.form.submit()" style="position:absolute; top:38%;left:120px;">
			<option value="50">50</option>
			<option value="100">100</option>
			<option value="500">All</option>
		</select>
	</form>


	<form action="/post.php" method="post">
		<input type="hidden" id="uservalue" name="uservalue" value="'.$userid.'">
		<input type="hidden" id="username" name="username" value="'.$username.'">';

if($displaylist<10){
	$displaylist=50;
}
if($sort==0){
	echo '
		<input type="hidden" id="sort" name="sort" value="1">	
		<input type="submit" value="Sort by Kakera" id="sort1" style="position:absolute; top:38%;left:8px;"></input>';

		$sql = "SELECT * FROM waifulist where wowner=".$userid." order by worder asc limit ".$displaylist.";";

}else{
	echo '
		<input type="hidden" id="sort" name="sort" value="0">
		<input type="submit" value="Sort by Order" id="sort1" style="position:absolute; top:38%;left:8px;"></input>';
	
		$sql = "SELECT * FROM waifulist where wowner=".$userid." order by wkak+0 desc limit ".$displaylist.";";	
}

$result = mysqli_query($link, $sql);

echo '
	</form>
	<form action="/post.php" method="post">
		<input type="hidden" id="sort" name="sort" value="'.$sort.'">
		<input type="hidden" id="uservalue" name="uservalue" value="'.$userid.'">
		<input type="hidden" id="username" name="username" value="'.$username.'">

		<input type="submit" class="divorcebox" id="divorcebox" value="Get Divorce String"style=" position:absolute; top:38%;right:100px;">
';




echo '<table style="width:100%">';

$counter=0;
$counter2=0;
	while($row = mysqli_fetch_assoc($result)){
		$counter=$counter+1;
		if($counter==1)
		{
			echo '<tr>';
		}
		echo '
			<td>
				<div class="polaroid" name="div'.$counter2.'">
					<div name="div'.$counter2.' class="div'.$counter2.'">
						<div name="#'.$row['wcolor'].'" style="background-color:#'.$row['wcolor'].';">
							<div id="divorcebox5" name="'.$row["wname"].'">
								<input class="divorcebox" type="checkbox" class="chk " id="div'.$counter2.'" name="div'.$counter2.'" value="'.$row['wname'].'" style="display:none; position: relative; float:left; top:33px;left:3px;"/>
							</div>
						<h1 id="'.$row["wname"].'"></h1>
						<label for="div'.$counter2.'"><img class="img" src="'.$row['wavatar'].'" style="width:200px; margin-bottom:10px;margin-left:10px; margin-top:10px;" /></label>
						
						</div>
					</div>
					<div class="container">
					<h3 style="margin-top:-7px;margin-bottom:-2px;">'.$row['wname'].'</h3>
				</div>
				<b style="position: relative;bottom:4px;font-size: 20px;margin-bottom-:3px;margin-left:5px;margin-top:-15px;padding-top:-10px;">'.$row['wkak'].'</b><img src="https://cdn.discordapp.com/emojis/469835869059153940.png" alt="ka" style="width:20px;"/></br>
			';
		if($row['wkeys']>0){
			if($row['wkeys']<3){
				echo '
					<b style="position: relative; float:right; bottom:13px;right:3px;font-size: 20px;margin-bottom-:3px;margin-left:5px;margin-top:-15px;padding-top:-10px;">'.$row['wkeys'].'</b><img src="https://cdn.discordapp.com/emojis/689474580041171096.png" alt="ka" style="position: relative; float:right;width:20px;bottom:25px;right:3px"/>
					';
			}
				else{
					echo '<b style="position: relative; float:right; bottom:13px;right:3px;font-size: 20px;margin-bottom-:3px;margin-left:5px;margin-top:-15px;padding-top:-10px;">'.$row['wkeys'].'</b><img src="https://cdn.discordapp.com/emojis/689475660896272501.png" alt="ka" style="position: relative; float:right;width:20px;bottom:25px;right:3px;"/>';
				}
		}
		echo '
		</div>
		</td>';
		if($counter>($wwidth-1))
		{
			echo '</tr>';
			$counter=0;
		}
		$counter2=$counter2+1;
	}
echo '</table>';



$divorcerstring="";
$counter3=0;
while($counter3<$counter2+1){
	$divorcer1=$_POST['div'.$counter3];
	if(strlen($divorcer1)>1){
		if(strlen($divorcerstring)>1){
			$divorcerstring=$divorcerstring.'$'.$divorcer1;
		}else{
			$divorcerstring=$divorcerstring.''.$divorcer1;
			
		}
	
	}
	$counter3=$counter3+1;
	//echo $divorcer1;
	if($counter3==$counter2){
		echo '<input type="text" class="divorcebox" id="divorcebox" name="fname" value="$divorce '.$divorcerstring.'"style="display: block; position:absolute;top:38%; right:230px;">';
		
	}
}

echo '</form>';

mysqli_close($link);




?>
<script>


var hvrbtn = document.getElementById("hvrBtn");


//====scroll to top button stuff======
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    hvrbtn.style.display = "block";
  } else {
    hvrbtn.style.display = "none";
  }
}

//========Checkbox recolor and soon marry arranger=============
//assuming people wont have more than 500 waifus
var i1=0;
var numbersorter=[1,2];
var numbersorter1=[1,2];
function definer(){
while(i1<300){
	
	numbersorter[i1]=i1;
	i1++;
}
}
var waifusorter = ["",""];




$("input[type='checkbox']").change(function(){
    if($(this).is(":checked")){
     		var y ="";
			var orderr;
			y = $(this).parent().attr('name');
			
			orderr=parseInt(numbersorter.find(element => element > 0),10);
			delete numbersorter[orderr];
			waifusorter[orderr]=y;
			
			$("[id='"+y+"']").text(orderr);
			
			
    		$(this).parent().parent().css("background-color", "yellow");
       
			//$("[id='Koto']").text(orderr); //just for testing
	
	
	
	
	
	
	
	}else{if($(this).not(":checked")){
		var x = $(this).parent().parent().attr('name');
        
       
		var y1;
		y1 = $(this).parent().attr('name');
		var x1;
		x1 = parseInt($("[id='"+y1+"']").text(),10);
		numbersorter[(x1)]=x1;
		
		delete waifusorter[numbersorter[x1]];

		//$("[id='Emilia']").text(x1);  //just for testing
		$("[id='"+y1+"']").text("");
		
		
		$(this).parent().parent().css("background-color", x);
		
		
		}
    }
});

var sortmarrystring;
var counter=0;
var disposable=0;
function getmarry(){
	i1=0;
	counter=0;
	sortmarrystring="$sortmarry ";
	while(i1<waifusorter.length){
		
		

		if(waifusorter[i1].length>0)
			if(counter==0){
			
				counter=1;

			}
			else{
				sortmarrystring=sortmarrystring+"$";
			//delete waifusorter[i1];
			}
		sortmarrystring=sortmarrystring+""+waifusorter[i1];

		i1++;
	}
	$("[id='marrybox']").val(sortmarrystring);
	
}

//===== Scroll to top button=====
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

//===== Hide all things with id divorcebox on click =========
function toggleHide() {
  var x = document.getElementById("divorcebox");
  var allElements= document.querySelectorAll('[id="divorcebox"]');
  if (x.style.display === "none") {
    new_display_value = "block";
  } else {
    new_display_value = "none";
  }
    for(i=0;i<allElements.length;i++){
     allElements[i].style.display=new_display_value;
  }
}
</script>
</body>
</html>
