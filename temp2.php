
<?php
	$con = new mysqli("localhost","root","","");
    if (!$con){
       die('Could not connect: ' . $con->connect_error);
    }

    session_start();

	exec('"C:\wamp\www\final2\del probe\del probe\bin\Debug\del probe.exe"');
	exec('"C:\wamp\www\final2\delete\delete\bin\Debug\delete.exe"');
	exec('"C:\wamp\www\final2\match\SourceAFIS-1.7.0\Sample\bin\Debug\Sample.exe"');
	exec('"C:\wamp\www\final2\probe del\probe del\bin\Debug\probe del.exe"');
	exec('"C:\wamp\www\final2\probestore\probestore\bin\Debug\probestore.exe"');
	exec('"C:\wamp\www\final2\delim\delim\bin\Debug\delim.exe"');

	$query = "SELECT MAX(`Id`) AS max FROM `hospital`.`probe`";
	$result = $con->query($query);

	$imgId = 1;

	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
        	$imgId = $row['max'];
      	}
    }

	$query0 = "SELECT `img` AS p FROM `hospital`.`probe` WHERE `Id`='$imgId'";
	$result0 = $con->query($query0);

	if($result0->num_rows > 0) {
    	while($row = $result0->fetch_assoc()){
            $x = $row['p'];
          	$query1 = "SELECT `Id` AS fid FROM `hospital`.`finger3` WHERE `imgleft` LIKE '%$x%' OR `imgright` LIKE '%$x%'";
          	$result1 = $con->query($query1);
		  	if($result1->num_rows > 0) {
          		while($row = $result1->fetch_assoc()) {
            		$fingerId = $row['fid'];
					$query2 = "SELECT * FROM `hospital`.`log` WHERE `finger` = '$fingerId'";
    				$result2 = $con->query($query2);
					if($result2->num_rows > 0) {
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
					}else{ echo "result 2 else";echo $result2->num_rows;}
          		}
        	}else{ echo "result 1 else"; echo $result1->num_rows;}
	  	}
    }else{
		echo "No data";
		echo $result0->num_rows;
	}
	$con->close();
?>