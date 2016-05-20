<?php
	$con = new mysqli("localhost","root","","");
    if (!$con){
        die('Could not connect: ' . $con->connect_error);
    }

	$path = "imageDb\\";
	$queryI = "SELECT * FROM `hospital`.`patientimage` WHERE `imgId` = '1'";
    $resultI = $con->query($queryI);

    if($resultI->num_rows > 0) {
		while($rowI = $resultI->fetch_assoc()) {
			$name = $rowI['imageName'];
			$imagen = $rowI['imageP'];

			$imagen = base64_encode($imagen);//building back compressed image to the original image
  			
			if(file_exists($path."/".$name))
				$file = fopen($path."/".$name,"w") or die("Unable to open file!");
			else
				$file = fopen($path.$name,"w");
   			echo "File name: ".$path."$name\n";
   			fwrite($file, base64_decode($imagen));
   			fclose($file);
			echo "<td class=\"col-lg-1\"><img style=\"width:100%;height:100px;padding-top:5px;padding-bottom:5px;\" src=\"data:image/png;base64," . $imagen . "\"/></td>";//displays the image
        }
   	}else{
       	$imagen = NULL;
    }
?>