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
        $hospmemLog = $_POST['memberLog'];//admin or doc
        
        //checks if the user's name,password and memberIdentity is matching
        $query = "SELECT * FROM `hospital`.`account` WHERE `uname`='$name1'  AND `pword`='$pwd1' AND `hospmember`='$hospmemLog'; ";


        $result = $con->query($query);

        if ($result->num_rows > 0) {// the data is found, the num_rows = 1
          if ($hospmemLog == "admin") {
            //If admin, Direct the user totlog.html page
            header("Location:log.html");
          }else{
            //If doctor, Direct the user totlog.html page
            header("Location:doc.php");
          exit();
          }
        }else{  
          include("index.html");
          //Pop's up if the data w.r.t database is incorrect
          echo <<<EOF
          <script type="text/javascript">
          window.onload=function(){alert("Invalid UserId or Password");}
          </script>
EOF;
          exit();
        }
      }
    }else{
      //Pop's up if the form is incomplete, onload-> means that when the page is loading pop the alert, while ready-> pop's after the page is loaded
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