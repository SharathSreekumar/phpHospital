<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><title>Report-Details | asd</title>
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<!--<style type="text/css">
        .img{ 
            background:#ffffff;
            /*padding:12px;
            border:1px solid #999999;*/
        }
        .backgrnd{
            background-image:url("hospital.jpg");
        }

        .transbox{
            background: rgba(255,255,255,0.3);
            /*opacity: 0.4;*/
        }
	</style>-->
</head>
<body class="backgrnd">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<div class="navbar-brand">
					<h4>HEALTHCARE</h4>
				</div>
			</div>
			<div class="collapse navbar-collapse col" id="bs-example-navbar-collapse-1">
    	      		<ul class="nav navbar-nav navbar-right">
        	    		<li><a href="log.html">Home</a></li>
    		        	<li><a href="#support">Support</a></li>
    		        	<li class="dropdown"><a href="#forms" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Forms <span class="caret"></span></a>
    		        		<ul class="dropdown-menu">
            					<li><a href="np.html">New Patient</a></li>
            					<li><a href="rp.php">Regular Patient</a></li>
          					</ul>
    		        	</li>
        	    		<li><a href="#specs">Specs</a></li>
            			<li><a href="#team">The Team</a></li>
            			<li><a href="#contact">Contact Us</a></li>
          			</ul>
        	</div>
		</div>
	</nav>
	<div class="container"></div>
	<div class="row">
		<div class="container col-lg-4"></div>
		<div class="container col-lg-4">
			<h2 style="text-align:center">REPORT</h2>
		</div>
		<div class="container col-lg-4"></div>
	</div>
	<div class="row">
		<div class="container col-lg-2"></div>
		<div class="container col-lg-8">
			<div class="row jumbotron transbox">
				<div class="container col-lg-4"><!--Image & past reports-->
					<div>
						<form action="" method="post"  enctype="multipart/form-data" onSubmit="return verifyRegData()" id="formRegPat"><!--action="" so that we remain in same page / excute in same page-->
							<?php

							$con = new mysqli("localhost","root","","");
    						if (!$con){// checking if Connection  to database is successful or not
        						die('Could not connect: ' . $con->connect_error);
    						}

    						$id = $_POST['viewme'];//$var_name = $_POST['name_of_the_html/php_elements'].value

    						$query = "SELECT * FROM `hospital`.`log` WHERE `npid`='$id'";//find the specific patients data from the database
    						$result = $con->query($query);//execute the query

    						if($result->num_rows > 0) {//checks if num_rows > 0
    							while($row = $result->fetch_assoc()) {//while row <= num_rows
    								echo "<label class=\"col-lg-12\"><input type=\"hidden\" name=\"subme\" value=".$row['npid']."/></label>";//store the id value, but not display i.e. hidden
    								$imagen = $row['image'];//fetch row_th patient's uploaded image
  									$imagen = base64_encode($imagen);//building back compressed image to the original image
    								echo "<div class=\"col-lg-12\"><img style=\"width:100%;height:250px;padding-top:5px;padding-bottom:5px;\" src=\"data:image/png;base64," . $imagen . "\"/></div>";
    								$tempName = $row['name'];
    								$tempId = $row['npid'];
								}
							}
							
							$query = "SELECT * FROM `hospital`.`log` WHERE `name`='$tempName' AND `npid`!= '$tempId' ORDER BY `date_visit` DESC";//find the specific patients data from the database
    						$result = $con->query($query);//execute the query

    						echo "<table class=\"table\">";
							echo "<tr><th>"."Previous Report"."</th></tr>";

							if($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "<tr>";
									echo "<td><button class=\"btn\" name=\"viewme\" formaction=\"reportDetDoc.php\"value=". $row['npid'] .">".$row['date_visit']."</button></td>";
									echo "</tr>";
								}
								echo "</table>";
							}else {
								echo "<tr>";
								echo "<td><p>"."No Previous Record"."</p></td>";
								echo "</tr></table>";
							}

							$con->close();//close the connection after execution
							?>
						</form>
					</div>
				</div>
				<div class="container col-lg-8">
					<div>
						<form action="" method="post"  enctype="multipart/form-data" onSubmit="return verifyRegData()" id="formRegPat"><!--action="" so that we remain in same page / excute in same page-->
							<?php

							$con = new mysqli("localhost","root","","");
    						if (!$con){// checking if Connection  to database is successful or not
        						die('Could not connect: ' . $con->connect_error);
    						}

    						$id = $_POST['viewme'];//$var_name = $_POST['name_of_the_html/php_elements'].value

    						$query = "SELECT * FROM `hospital`.`log` WHERE `npid`='$id'";//find the specific patients data from the database
    						$result = $con->query($query);//execute the query

    						if($result->num_rows > 0) {//checks if num_rows > 0
    							while($row = $result->fetch_assoc()) {//while row <= num_rows
    								echo "<label class=\"col-lg-12\"><input type=\"hidden\" name=\"subme\" value=".$row['npid']."/></label>";//store the id value, but not display i.e. hidden
    								echo "<label class=\"col-lg-6\">Name:</label><label class=\"col-lg-6\">".$row['name']."</label>";//display patient's name
									echo "<label class=\"col-lg-6\">Age:</label><label class=\"col-lg-6\">".$row['age']."</label>";//patient's age
									echo "<label class=\"col-lg-6\">Contact Number:</label><label class=\"col-lg-6\">".$row['nos']."</label>";//patient's contact no
									echo "<label class=\"col-lg-6\">Blood Group:</label><label class=\"col-lg-6\">".$row['bgroup']."</label>";//patient's blood Grp
									if($row['con1'] == NULL)
										echo "<label class=\"col-lg-6\" style=\"padding-left:0px;padding-right:0px\">Emergency Contact1:</label><label class=\"col-lg-6\">"." - "."</label>";//patient's emergency Contact No 1
									else
										echo "<label class=\"col-lg-6\" style=\"padding-left:0px;padding-right:0px\">Emergency Contact1:</label><label class=\"col-lg-6\">".$row['con1']."</label>";//patient's emergency Contact No 1
									if($row['con2'] == NULL)
										echo "<label class=\"col-lg-6\" style=\"padding-left:0px;padding-right:0px\">Emergency Contact2:</label><label class=\"col-lg-6\">"." - "."</label>";//patient's emergency Contact No 1
									else
										echo "<label class=\"col-lg-6\" style=\"padding-left:0px;padding-right:0px\">Emergency Contact2:</label><label class=\"col-lg-6\">".$row['con2']."</label>";//patient's emergency Contact No 1
									echo "<h4><label>SUFFERING FROM</label></h4><label class=\"col-lg-12\">".$row['suffer']."</label>";//patient suffering from
									echo "<h4><label>MEDICATION</label></h4><label class=\"col-lg-12\">".$row['medicine']."</label>";//patient's prescribed medicine
									echo "<h3><label>PHYSICIAN</label></h3>";
									if($row['doctor'] == NULL)
										echo "<label class=\"col-lg-6\">Name:</label><label class=\"col-lg-6\">"." - "."</label>";//patient's Physician/Doctor
									else
										echo "<label class=\"col-lg-6\">Name:</label><label class=\"col-lg-6\">".$row['doctor']."</label>";//patient's Physician/Doctor
									if($row['contact'] == NULL)
										echo "<label class=\"col-lg-6\">Contact No:</label><label class=\"col-lg-6\">"." - "."</label>";
									else
										echo "<label class=\"col-lg-6\">Contact No:</label><label class=\"col-lg-6\">".$row['contact']."</label>";//Doctor's Contact No
								}
							}
							$con->close();//close the connection after execution
							?>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="container col-lg-2"></div>
	</div>
	<script src="js/jquery-1.11.2.min.js"></script>
   	<script src="js/bootstrap.min.js"></script>
   	<script src="js/rp.js"></script>
</body>
</html>
