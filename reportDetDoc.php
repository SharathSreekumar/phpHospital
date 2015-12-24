<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><title>Report-Details | asd</title>
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
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
            					<li><a href="rp.html">Regular Patient</a></li>
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
		<div class="container col-lg-4"></div>
		<div class="container col-lg-4">
			<div>
				<form action="" method="post"  enctype="multipart/form-data" onSubmit="return verifyRegData()" id="formRegPat">
				<?php

							$con = new mysqli("localhost","root","","");
    						if (!$con){
        						die('Could not connect: ' . $con->connect_error);
    						}

    						$id = $_POST['viewme'];

    						$query = "SELECT * FROM `hospital`.`log` WHERE `npid`='$id'";
    						$result = $con->query($query);

    						if($result->num_rows > 0) {
    							while($row = $result->fetch_assoc()) {
    								echo "<label class=\"col-lg-12\"><input type=\"hidden\" name=\"subme\" value=".$row['npid']."/></label>";
									echo "<label class=\"col-lg-6\">Name:</label><label class=\"col-lg-6\">".$row['name']."</label>";
									echo "<label class=\"col-lg-6\">Age:</label><label class=\"col-lg-6\">".$row['age']."</label>";
									echo "<label class=\"col-lg-6\">Contact Number:</label><label class=\"col-lg-6\">".$row['nos']."</label>";
									echo "<label class=\"col-lg-6\">Blood Group:</label><label class=\"col-lg-6\">".$row['bgroup']."</label>";
									echo "<label class=\"col-lg-6\" style=\"padding-left:0px;padding-right:0px\">Emergency Contact1:</label><label class=\"col-lg-6\">".$row['con1']."</label>";
									echo "<label class=\"col-lg-6\" style=\"padding-left:0px;padding-right:0px\">Emergency Contact2:</label><label class=\"col-lg-6\">".$row['con2']."</label>";
									echo "<h4><label>SUFFERING FROM</label></h4><label class=\"col-lg-12\">".$row['suffer']."</label>";
									echo "<h4><label>MEDICATION</label></h4><label class=\"col-lg-12\">".$row['medicine']."</label>";
									echo "<h3><label>PHYSICIAN</label></h3>";
									echo "<label class=\"col-lg-6\">Name:</label><label class=\"col-lg-6\">".$row['doctor']."</label>";
									echo "<label class=\"col-lg-6\">Contact No:</label><label class=\"col-lg-6\">".$row['contact']."</label>";
								}
							}
							$con->close();
				?>
				</form>
			</div>
		</div>
		<div class="container col-lg-4"></div>
	</div>
	<script src="js/jquery-1.11.2.min.js"></script>
   	<script src="js/bootstrap.min.js"></script>
   	<script src="js/rp.js"></script>
</body>
</html>
