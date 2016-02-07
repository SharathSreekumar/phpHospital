<?php
$con = mysqli_connect("localhost","root","","");
session_start();
$_SESSION['id']="1";
$id=$_SESSION['id'];
$name = date('YmdHis');
$newImg = $name.".jpg";
$pathImg = "image/".$name.".jpg";
$file = file_put_contents( $pathImg, file_get_contents('php://input') );
    

//$imageName = mysqli_real_escape_string($con,$_FILES["fileUpload"]["name"]);
$imageName = mysqli_real_escape_string($con,$newImg);   // name of the image
$imageData = mysqli_real_escape_string($con,file_get_contents($pathImg));
$imageType = mysqli_real_escape_string($con,"image/png");     //tells file type - image/ video, etc

$cookie_name = "imageLoc";
$cookie_value = $pathImg;
setcookie($cookie_name, $cookie_value, time() + 86400, "/");
    
if (!$file) {
	print "Error occured here";
	exit();
}else{
    //$sql = "INSERT INTO `dbname`.`entry` (`id`,`images`) VALUES ('$id','$imageData')";
    //$result = mysqli_query($con,$sql);
    //$value = mysqli_insert_id($con);
    //$_SESSION["myvalue"] = $value;
}
$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $pathImg;
print "$url";
?>
