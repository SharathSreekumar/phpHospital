<html>
<body>
  <?php 
	  if($_POST['user']!=="" && $_POST['user']!==" "){//if userId is filled or not

    	$con = new mysqli("localhost","root","","");
      	if (!$con){
        	die('Could not connect: ' . $con->connect_error);
      	}
  	
  		if( $_POST['pwrd'] !== "" && $_POST['pwrd']== $_POST['cnpwrd']){//if password and confirm-password exists or not
    		session_start();
    		$cname1 = $_POST['user'];
    		$cpwrd = $_POST['pwrd'];
        $hospmemNew = $_POST['memberCreate'];

    		$query = "INSERT INTO `hospital`.`account`(`uname`,`pword`,`hospmember`)VALUES('$cname1','$cpwrd','$hospmemNew');";
    		
    	if($con->query($query) == TRUE){// True if username doesn't exist
        include("index.html");
        echo '
       <script type="text/javascript">
       		$(document).ready(function(){alert("Successfully created account. Please Login to access account");});
       </script>';
//EOF;
        exit();
    		}else{//userId already already exist
          include("index.html");
    			echo <<<EOF
       <script type="text/javascript">
          $(document).ready(function(){alert("Username already exists! Please try another Id");});
       </script>
EOF;
        exit();
    		}
    	}else{// if password is not matching
    		echo <<<EOF
       <script type="text/javascript">
       window.onload=function(){alert("Password Incorrect");}
       </script>
EOF;
        include("index.html");
        exit();
    	}
    }else{// if the data in form is empty
    		echo <<<EOF
       <script type="text/javascript">
       window.onload=function(){alert("Please Fill data");}
       </script>
EOF;
        include("index.html");
        exit();
    }
  ?>
</body>
</html>