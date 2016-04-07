<?php
  $con = new mysqli("localhost","root","","");
    if (!$con){
        die('Could not connect: ' . $con->connect_error);
    }

    session_start();

    $name = $_POST["newName"];//$_POST["name of attribute"]
    $addr = $_POST["newAddr"];
    $dob = $_POST["newDoB"];
    $age = $_POST["newAge"];
    $nos = $_POST["newContact"];
    $bgroup = $_POST["bloodGroup"];
    $imgName = "";

    if(!isset($_COOKIE["imageLoc"])) {
      echo "Cookie named '" . "imageLoc" . "' is not set!";
    } else {
      $imgPath = $_COOKIE["imageLoc"];
    }
    
    setcookie("imageLoc", "", time() * 0);
    $imageName = mysqli_real_escape_string($con,$imgName);   // name of the image
    $imageData = mysqli_real_escape_string($con,file_get_contents($imgPath));
    $imageType = mysqli_real_escape_string($con,"image/png");     //tells file type - image/ video, etc
    $con1 = $_POST["newEmerCon1"];
    $con2 = $_POST["newEmerCon2"];
    $dateVisit = Date("Y-m-d");

    $query = "SELECT MAX(`npid`) AS max FROM `hospital`.`log`";
    $result = $con->query($query);

    //get patient id
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $patId = $row['max'] + 1;
      }
    }
    
    if(substr($imageType,0,5)=="image"){

      $imageId = NULL;
      $query = "INSERT INTO `hospital`.`patientimage`(`imageP`)VALUES('$imageData')";
      echo $imageName;
      if($con->query($query) == TRUE){
        $query = "SELECT MAX(`imgId`) AS max FROM `hospital`.`patientimage`";
        $result = $con->query($query);

        if($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $imageId = $row['max'];
          }
        }
      }

      $query = "INSERT INTO `hospital`.`log`(`npid`,`name`,`addr`,`dob`,`age`,`nos`,`bgroup`,`image`,`con1`,`con2`,`date_visit`)VALUES('$patId','$name','$addr','$dob','$age','$nos','$bgroup','$imageId','$con1','$con2','$dateVisit');";
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