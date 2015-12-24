<!--Displays Table with brief information of all patients-->
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><title>Regular Patients | asd</title>
	
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
			<h2 style="text-align:center">REGULAR PATIENTS</h2>
		</div>
		<div class="container col-lg-4"></div>
	</div>
	<div class="row">
		<div class="container col-lg-1"></div>
		<div class="container col-lg-10">
			<form action="reportDetDoc.php" method="post" id="formDocAll">
		<?php
			$con = new mysqli("localhost","root","","");
    		if (!$con){
        		die('Could not connect: ' . $con->connect_error);
    		}

    		$query = "SELECT * FROM `hospital`.`log`";
    		$result = $con->query($query);//execute the query to database it is connected to

    		if($result->num_rows > 0) {
    			echo "<table border='1'>
				<tr>
				<th class=\"col-lg-1\">Name</th>
				<th class=\"col-lg-1\">Address</th>
				<th class=\"col-lg-1\">Date of Birth</th>
				<th class=\"col-lg-1\">Age</th>
				<th class=\"col-lg-1\">Contact Number</th>
				<th class=\"col-lg-1\">Blood Group</th>
				<th class=\"col-lg-1\">Emergency No 1</th>
				<th class=\"col-lg-1\">Emergency No 2</th>
				<th class=\"col-lg-2\">Image</th>
				</tr>";

				while($row = $result->fetch_assoc()) {//fetch the data if row <= num_rows
					echo "<tr>";
					echo "<td class=\"col-lg-1\">" . $row['name'] . "</td>";//fetch row_th patient's name
  					echo "<td class=\"col-lg-1\">" . $row['addr'] . "</td>";//fetch row_th patient's address
  					echo "<td class=\"col-lg-1\">" . $row['dob'] . "</td>";//fetch row_th patient's DoB
  					echo "<td class=\"col-lg-1\">" . $row['age'] . "</td>";//fetch row_th patient's age
  					echo "<td class=\"col-lg-1\">" . $row['nos'] . "</td>";//fetch row_th patient's contact no
  					echo "<td class=\"col-lg-1\">" . $row['bgroup'] . "</td>";//fetch row_th patient's blood group
  					echo "<td class=\"col-lg-1\">" . $row['con1'] . "</td>";//fetch row_th patient's emergency contact no 1
  					echo "<td class=\"col-lg-1\">" . $row['con2'] . "</td>";//fetch row_th patient's emergency contact no 2

  					$imagen = $row['image'];//fetch row_th patient's uploaded image
  					$imagen = base64_encode($imagen);//building back compressed image to the original image
  					echo "<td class=\"col-lg-1\"><img style=\"width:100%;height:100px;padding-top:5px;padding-bottom:5px;\" src=\"data:image/png;base64," . $imagen . "\"/></td>";//displays the image
  					//View report directs to viewing the details of the Patient
  					echo "<td class=\"col-lg-1\"><p style=\"text-align:center\"><button class=\"btn\" type=\"submit\" name=\"viewme\" value=\"". $row['npid'] ."\">View Report</button></p></td>";
  					
  					echo "</tr>";
				}
				echo "</table>";
			}
			$con->close();
		?></form>
	</div>
	<div class="container col-lg-1"></div>
	<script src="js/jquery-1.11.2.min.js"></script>
   	<script src="js/bootstrap.min.js"></script>
   	<script src="js/np.js"></script>
</body>
</html>