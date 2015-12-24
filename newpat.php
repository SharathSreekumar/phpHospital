<?php
	$con = new mysqli("localhost","root","","");
    if (!$con){
        die('Could not connect: ' . $con->connect_error);
    }

    session_start();

    $name = $_POST["newName"];
    $addr = $_POST["newAddr"];
    $dob = $_POST["newDoB"];
    $age = $_POST["newAge"];
    $nos = $_POST["newContact"];
    $bgroup = $_POST["bloodGroup"];

    
    //$image = $_POST["fileUpload"];
    $imageName = mysqli_real_escape_string($con,$_FILES["fileUpload"]["name"]);
    $imageData = mysqli_real_escape_string($con,file_get_contents($_FILES["fileUpload"]["tmp_name"]));
    $imageType = mysqli_real_escape_string($con,$_FILES["fileUpload"]["type"]);    
    $con1 = $_POST["newEmerCon1"];
    $con2 = $_POST["newEmerCon2"];

    /*if (isset($_FILES["fileUpload"]) && !empty($_FILES["fileUpload"])) {
        $imageData = $_FILES['fileUpload']['tmp_name'];
        $imageName = $_FILES['fileUpload']['name'];
        $imageSize = $_FILES['fileUpload']['size'];
        $imageType = $_FILES['fileUpload']['type'];
      */
      if(substr($imageType,0,5)=="image"){  
        $query = "INSERT INTO `hospital`.`log`(`name`,`addr`,`dob`,`age`,`nos`,`bgroup`,`image`,`con1`,`con2`)VALUES('$name','$addr','$dob','$age','$nos','$bgroup','$imageData','$con1','$con2');";
    	  if($con->query($query) == TRUE){
        	include("np.html");
        	echo <<<EOF
       			<script type="text/javascript">
       			window.onload=function(){alert("Successfully entered data");}
       			</script>
EOF;
        	exit();
    	}else{
        	include("np.html");
        	echo <<<EOF
       			<script type="text/javascript">
       				window.onload=function(){alert("Error in connection");}
       			</script>
EOF;
        	exit();
    	}
	}else{
		include("np.html");
        echo <<<EOF
       		<script type="text/javascript">
       			window.onload=function(){alert("Please choose an image");}
       		</script>
EOF;
        exit();
	}
?>