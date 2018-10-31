<html>
<head>
	<title>Home sweet home</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
/* unvisited link */
a:link {
    color: white;
	text-decoration: none;
    
}

/* visited link */
a:visited {
    color: gray;
}

/* mouse over link */
a:hover {
    color: #ffb2bd;
}

</style>

</head>
<center>
<?php 
session_start();
	$con = new mysqli("localhost", "randvid", "password", "randvid");
	if ($con->connect_error) {
		   die("Connection failed: " . $con->connect_error);
		}
		 /* echo "Connected successfully"; 
			Debugging*/
			
	$sql = "SELECT id FROM videos ORDER BY id DESC";
	if ($result = mysqli_query($con, $sql)){
		$big = $result->num_rows;

		/*printf("Result set has %d rows.\n", $big);
			Debugging*/
		
		/* close result set */
		$result->close();
	}
	
	$small = '1';
	
	/* echo $small; 
		Debugging*/
			
	$rand = mt_rand($small,$big);
	
	/* echo $rand;
		Debugging*/
		
	/*$vidresult = mysqli_query($con,"SELECT name FROM videos WHERE id= '$rand' LIMIT 1");*/
	$vidresult = mysqli_query($con,"SELECT name FROM videos order by RAND() LIMIT 1");
	
	/* could possible cause DB crashes in future, AI is also an issue with the previous query because if 
		I remove a video from the DB that will load a blank page, will look into issue further if 
		crashing becomes a problem.
		*/
		
	$vidname = mysqli_fetch_array($vidresult);
	$url = $vidname['name'];

?>
<body bgcolor="#595959">
<video width="720" height="480" loop autoplay>
	<source src="https://slyest.cat/randvid/<?php echo $url; ?>" type="video/webm">
</video>
<br>
<a href="https://slyest.cat/randvid/<?php echo $url; ?>"> Click here for the direct link for this webm </a>
<br>
<br>
<button onclick="refreshFunction()">load random webm</button>

<script>
function refreshFunction() {
    location.reload();
}
</script>
<br>
<br>
<a href="https://twitter.com/slyestcat"><i class="fa fa-twitter"></i></a> 
<a href="https://twitch.tv/slyestcat"><i class="fa fa-twitch"></i></a> 
<a href="https://www.paypal.me/slyestcat"><i class="fa fa-paypal"></i></a> 
<a href="https://www.instagram.com/slyestcat/"><i class="fa fa-instagram"></i></a>
<?php mysqli_close($con); ?>
</center>
</html>