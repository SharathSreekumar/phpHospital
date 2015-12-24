<html>
<body>
  <?php 
    if($_POST['uname']!=="" && $_POST['uname']!==" "){

      $con = new mysqli("localhost","root","","");
      if (!$con){
        die('Could not connect: ' . $con->connect_error);
      }
  
      session_start();
    
      if (!isset($_SESSION['userid'])){
        $name1=$_POST['uname'];
        $pwd1=$_POST['lpwrd'];
        $hospmemLog = $_POST['memberLog'];
        
        $query = "SELECT * FROM `hospital`.`account` WHERE `uname`='$name1'  AND `pword`='$pwd1' AND `hospmember`='$hospmemLog'; ";

        $result = $con->query($query);

        if ($result->num_rows > 0) {
          if ($hospmemLog == "admin") {
            header("Location:log.html");
          }else{
            //include("index.html");
          /*echo <<<EOF
          <script type="text/javascript">
          window.onload=function(){alert("Not an admin");}
          </script>
EOF;*/    
            header("Location:doc.php");
          exit();
          }
	       //forward("log.html");
        }else{  
          include("index.html");
          echo <<<EOF
          <script type="text/javascript">
          window.onload=function(){alert("Invalid UserId or Password");}
          </script>
EOF;
          exit();
        }
      }
    }else{
      echo <<<EOF
        <script type="text/javascript">
        window.onload=function(){alert("Please enter Username and password");}
        </script>
EOF;
      include("index.html");
      exit();
    } 
  ?>
</body>
</html>