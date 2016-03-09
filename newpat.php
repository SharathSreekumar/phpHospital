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
    
    if(substr($imageType,0,5)=="image"){  
      $query = "INSERT INTO `hospital`.`log`(`name`,`addr`,`dob`,`age`,`nos`,`bgroup`,`image`,`con1`,`con2`,`date_visit`)VALUES('$name','$addr','$dob','$age','$nos','$bgroup','$imageData','$con1','$con2','$dateVisit');";
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