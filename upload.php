<form action="" method='post' enctype="multipart/form-data">
<input type="file" name="file"/><br><br>
	<input type="submit" value="Upload"/>
</form>
</form>



<?php 

$name = $_FILES['file']['name'];
$tmp_name = $_FILES['file']['tmp_name'];

$position= strpos($name, ".");

$fileextension= substr($name, $position + 1);

$fileextension= strtolower($fileextension);

$newfilename = time() . rand(100,999) . '.webm';

/*echo $newfilename;*/

if (isset($name)) {

	$path= 'randvid/';
	
	if (empty($name)){
		
		echo "Please choose a file";
		
	} else if (!empty($name)){
		
		if (($fileextension !== "webm")){
			
			echo "The file extension must be .webm in order to be uploaded";
			
		} else if (($fileextension == "webm")){
			
			if (move_uploaded_file($tmp_name, $path.$newfilename)) {
				
				$con = new mysqli("localhost", "randvid", "password", "randvid");
					if ($con->connect_error) {
						   die("Connection failed: " . $con->connect_error);
						}
					/*echo "Connected successfully";*/
					
				if ($con->query("INSERT INTO videos (name) VALUES ('$newfilename')") === TRUE) {
					/*printf("file was databased correctly");*/
				}

				mysqli_close($con);
				
				echo 'Uploaded!';

			}
		}
	}
}

/* TODO Fix issue where it populates two sql entires */


?>
