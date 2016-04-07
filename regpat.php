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
					<h4><div class="icon">HEALTHCARE</div></h4>
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
			<h2 style="text-align:center">PATIENT'S BRIEF DESCRIPTION</h2>
		</div>
		<div class="container col-lg-4"></div>
	</div>
	<div class="row">
		<div class="container col-lg-4"></div>
		<div class="container col-lg-4">
			<form action="regpat.php" method="post" class="form-inline" role="search">
        		<div class="form-group">
          			<input type="text" style="padding-right:160px" name="searchPat" class="form-control" placeholder="Search Patients by Name" value="" autofocus/>
      			</div>
      			<button type="submit" class="btn btn-default">Search</button>
      		</form>
		</div>
		<div class="container col-lg-4"></div>
	</div>
	<div class="row">
		<div class="container col-lg-1"></div>
		<div class="container col-lg-10">
			<form action="rp.php" method="post" id="formRegPat">
		<?php
			$con = new mysqli("localhost","root","","");
    		if (!$con){
        		die('Could not connect: ' . $con->connect_error);
    		}

    		if(isset($_POST['searchPat']) && $_POST['searchPat']!=" "){//if search box is not empty
    			$patName = $_POST['searchPat'];
    			$altQuery = "SELECT `name`,MAX(`date_visit`) as 'date' FROM `hospital`.`log` WHERE `name` LIKE '%$patName%'";
    			$result2 = $con->query($altQuery);
    			if($result2->num_rows > 0) {

    				$row2 = $result2->fetch_assoc();
    				$rowTemp = $row2['date'];
    				$query = "SELECT * FROM `hospital`.`log` WHERE `name` LIKE '%$patName%' AND `date_visit`='$rowTemp' ORDER BY `date_visit` DESC";//" AND `date_visit`=$altQuery";//display specific patient/patients data from the database
    				$result = $con->query($query);

    				if($result->num_rows > 0) {// if row > 0, then 'n' data exists
    					echo "<table class=\"table table-bordered\">
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

						// while row <= num_rows, fetch the data
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td class=\"col-lg-1\">" . $row['name'] . "</td>";//$row['attribute-in-database']
  							echo "<td class=\"col-lg-1\">" . $row['addr'] . "</td>";
  							echo "<td class=\"col-lg-1\">" . $row['dob'] . "</td>";
  							echo "<td class=\"col-lg-1\">" . $row['age'] . "</td>";
  							echo "<td class=\"col-lg-1\">" . $row['nos'] . "</td>";
  							echo "<td class=\"col-lg-1\">" . $row['bgroup'] . "</td>";
  							echo "<td class=\"col-lg-1\">" . $row['con1'] . "</td>";
  							echo "<td class=\"col-lg-1\">" . $row['con2'] . "</td>";
  							$imageId = $row['image'];
  							$queryI = "SELECT * FROM `hospital`.`patientimage` WHERE `imgId` = '$imageId'";
        					$resultI = $con->query($queryI);

        					if($resultI->num_rows > 0) {
          						while($rowI = $resultI->fetch_assoc()) {
            						$imagen = $rowI['imageP'];
            						$imagen = base64_encode($imagen);//building back compressed image to the original image
  									echo "<td class=\"col-lg-1\"><img style=\"width:100%;height:100px;padding-top:5px;padding-bottom:5px;\" src=\"data:image/png;base64," . $imagen . "\"/></td>";//displays the image
          						}
        					}else{
        						$imagen = NULL;
        					}

  							// $imagen = base64_encode($imagen);//building back compressed image to the original image
  							// echo "<td class=\"col-lg-1\"><img style=\"width:100%;height:100px;padding-top:5px;padding-bottom:5px;\" src=\"data:image/png;base64," . $imagen . "\"/></td>";//displays the image
  							// //Edit button directs the page to Update option
  							//View report directs to viewing the details of the Patient
  							echo "<td class=\"col-lg-1\"><p style=\"text-align:center;\"><button type=\"submit\"class=\"btn\" name=\"subme\" style=\"width:103px;\" value=". $row['npid'] .">Edit</button></p><p><button class=\"btn\" name=\"viewme\" formaction=\"reportDetDoc.php\"value=". $row['npid'] .">View Report</button></p></td>";
								  					
  							echo "</tr>";
						}
						echo "</table>";
					}else{
						echo "No data";
					}
    			}
				$con->close();
    		}else{
    			$query = "SELECT * FROM `hospital`.`log` ORDER BY `name` ASC,`date_visit` DESC";//display all the patients data from the database ordered name in Ascending & date in descending
    			$result = $con->query($query);

    			if($result->num_rows > 0) {// if row > 0, then 'n' data exists
    				echo "<table class=\"table table-bordered\">
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

					// while row <= num_rows, fetch the data
					while($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td class=\"col-lg-1\">" . $row['name'] . "</td>";//$row['attribute-in-database']
  						echo "<td class=\"col-lg-1\">" . $row['addr'] . "</td>";
  						echo "<td class=\"col-lg-1\">" . $row['dob'] . "</td>";
  						echo "<td class=\"col-lg-1\">" . $row['age'] . "</td>";
  						echo "<td class=\"col-lg-1\">" . $row['nos'] . "</td>";
  						echo "<td class=\"col-lg-1\">" . $row['bgroup'] . "</td>";
  						echo "<td class=\"col-lg-1\">" . $row['con1'] . "</td>";
  						echo "<td class=\"col-lg-1\">" . $row['con2'] . "</td>";
  						$imageId = $row['image'];
  						$queryI = "SELECT * FROM `hospital`.`patientimage` WHERE `imgId` = '$imageId'";
        				$resultI = $con->query($queryI);

       					if($resultI->num_rows > 0) {
         						while($rowI = $resultI->fetch_assoc()) {
           						$imagen = $rowI['imageP'];
           						$imagen = base64_encode($imagen);//building back compressed image to the original image
  								echo "<td class=\"col-lg-1\"><img style=\"width:100%;height:100px;padding-top:5px;padding-bottom:5px;\" src=\"data:image/png;base64," . $imagen . "\"/></td>";//displays the image
          					}
        				}else{
        					$imagen = NULL;
        				}

  						// $imagen = base64_encode($imagen);//building back compressed image to the original image
  						// echo "<td class=\"col-lg-1\"><img style=\"width:100%;height:100px;padding-top:5px;padding-bottom:5px;\" src=\"data:image/png;base64," . $imagen . "\"/></td>";//displays the image
  						// //Edit button directs the page to Update option
  						//View report directs to viewing the details of the Patient
  						echo "<td class=\"col-lg-1\"><p style=\"text-align:center;\"><button type=\"submit\"class=\"btn\" name=\"subme\" style=\"width:103px;\" value=". $row['npid'] .">Edit</button></p><p><button class=\"btn\" name=\"viewme\" formaction=\"reportDetDoc.php\"value=". $row['npid'] .">View Report</button></p></td>";
								  					
  						echo "</tr>";
					}
				}
				$con->close();
			}
		?></form>
	</div>
	<div class="container col-lg-1"></div>
	<script src="js/jquery-1.11.2.min.js"></script>
   	<script src="js/bootstrap.min.js"></script>
   	<script src="js/np.js"></script>
</body>
</html>