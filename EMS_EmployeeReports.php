<!---
Filename: "Home Page.html"
Programmer: William Boldt
Date: December 8, 2013
--->
<html>


	<head>

		<style>
			body
			{
				background-color:#585858;
			}
		</style>

		<link rel="stylesheet" href="styles.css" type="text/css">

		<title>EMS-PPS</title>

		<?php
			// Start the session
			session_start();			
			
			$serverName = $_SESSION['serverName'];
			$userName = $_SESSION['userName'];
			$password = $_SESSION['password'];
			$databaseName = $_SESSION['databaseName'];	
			$userType = $_SESSION['userType'];
			
			$link = "";			
			
		?>
		
	</head>


	<body>

		<div class="header">
			<br/>
			<h1>EMS-PPS</h1>
			<br/>
		</div>
		
		
		

		<div class="menu">
			</br> <b>Operation Modes:</b> </br></br>
			<a href= "EMS_HomePage.php" >Home</a><br></br>
			<a href= "EMS_EmployeeSearch.php" >Search For Employees</a><br></br>
			<a href= "EMS_EmployeeMaintenance.php">Manage Employees</a><br></br>
			Employee Reports</br></br>
			<!-- if user is an administrator -->
			<a href= "EMS_SystemAdmin.php">System Administration</a><br></br>

		</div>

		<div class="margin">
		</div>

		<div class="content"> </br>
			<h2>Employee Reports</h2>
			<?php
			echo "<form method='post'>		
					Which type of report would you like to generate? 
						<select name='reportToGenerateDropDown'>
										<option value=''></option>
										<option value='sReport'>Seniority</option>
										<option value='whwReport'>Weekly Hours Worked</option>";
			if($userType == "administrator")
			{
				echo "<option value='pReport'>Payroll</option>
					  <option value='aeReport'>Active Employee</option>
					  <option value='ieReport'>Inactive Employee</option>";
			}
			
			echo "		</select>
						<input type='submit' value='Generate Report'><br><hr>										
				  </form>";
				  
			$companyName = "test company";
			$link = mysqli_connect($serverName, $userName, $password, $databaseName);// connect to the database
								
				if(!$link)
				{
					//if the database connection failed send error message
					 echo "<br>Error: Could not connect to the database.";
				}
				else// we have a connection
				{
					$stringToEcho = generate_sReport($link, $companyName);
					$stringToEcho .= generate_whwReport($link, $companyName);
					$stringToEcho .= generate_pReport($link, $companyName);
					$stringToEcho .= generate_aeReport($link, $companyName);
					$stringToEcho .= generate_ieReport($link, $companyName);
			
					echo "$stringToEcho";
				}
				
				
			?>

		</div>

		<div class="margin">
		</div>

		<div class="footer">
			Copyright &copy MATTHEWSOFT
		</div>
		
		<?php
		// this is where all of the functions for the page are declared
			
			/*
			 * Function: 
			 * Description: This function generates the ___ Report and returns it as a string
			 * Parameters: The link to the database connection and the name of the company
			 *             that the report should be generated for
			 * Return: The ___ Report as a string
			 */
			function generate_sReport($link, $companyName)
			{
				$returnString = "Seniority Report ($companyName)<br>";
				$queryString = "SELECT * FROM sReport WHERE companyName=$companyName;";
			
				if($result = $link->query($queryString))
				{
					/* add the headings for each column */
					$returnString .= "<table border='1'>
									  <tr>
										<th>Employee Name</th>
										<th>SIN</th>
										<th>Type</th>
										<th>Date Of Hire</th>
										<th>Years of Service</th>
									  </tr>";
					
					while($row = $result->fetch_assoc())
					{
						$returnString .= "<tr>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
										  </tr>";
													
					}		

					$returnString .= "</table>";
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
					
					$returnString .= "<table border='1'>
									  <tr>
										<th>Employee Name</th>
										<th>SIN</th>
										<th>Type</th>
										<th>Date Of Hire</th>
										<th>Years of Service</th>
									  </tr>";
									  $returnString .= "</table>";
				}
				
				return $returnString;
			}
			
			/*
			 * Function: 
			 * Description: This function generates the ___ Report and returns it as a string
			 * Parameters: The link to the database connection and the name of the company
			 *             that the report should be generated for
			 * Return: The ___ Report as a string
			 */
			function generate_whwReport($link, $companyName)
			{
				$returnString = "Weekly Hours Worked Report ($companyName)<br>";
				$queryString = "SELECT * FROM whwReport WHERE companyName=$companyName;";
				
				if($result = $link->query($queryString))
				{
					/* add the headings for each column */
					$returnString .= "<table border='1'>
									  <tr>
										<th>FullTime</th>
									  </tr>
									  <tr>
										<th>Employee Name</th>
										<th>SIN</th>
										<th>Hours</th>
									  </tr>";
					
					while($row = $result->fetch_assoc())
					{
						$returnString .= "<tr>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
										  </tr>";
													
					}				
					
					$returnString .= "</table>";
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
					$returnString .= "<table border='1'>
									  <tr>
										<th>FullTime</th>
									  </tr>
									  <tr>
										<th>Employee Name</th>
										<th>SIN</th>
										<th>Hours</th>
									  </tr>";
									  $returnString .= "</table>";
				}
				
				return $returnString;
			}
			
			/*
			 * Function: 
			 * Description: This function generates the ___ Report and returns it as a string
			 * Parameters: The link to the database connection and the name of the company
			 *             that the report should be generated for
			 * Return: The ___ Report as a string
			 */
			function generate_pReport($link, $companyName)
			{
				$returnString = "Payroll Report ($companyName)<br>";
				$queryString = "SELECT * FROM pReport WHERE companyName=$companyName;";
				
				if($result = $link->query($queryString))
				{
					/* add the headings for each column */
					$returnString .= "<table border='1'>
									  <tr>
										<th>FullTime</th>
									  </tr>
									  <tr>
										<th>Employee Name</th>
										<th>Hours</th>
										<th>Gross</th>
										<th>Notes</th>
									  </tr>";
					
					while($row = $result->fetch_assoc())
					{
						$returnString .= "<tr>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
										  </tr>";
													
					}	
					
					$returnString .= "</table>";
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
					$returnString .= "<table border='1'>
									  <tr>
										<th>FullTime</th>
									  </tr>
									  <tr>
										<th>Employee Name</th>
										<th>Hours</th>
										<th>Gross</th>
										<th>Notes</th>
									  </tr>";
									  $returnString .= "</table>";
				}
				
				return $returnString;
			}
			
			/*
			 * Function: 
			 * Description: This function generates the ___ Report and returns it as a string
			 * Parameters: The link to the database connection and the name of the company
			 *             that the report should be generated for
			 * Return: The ___ Report as a string
			 */
			function generate_aeReport($link, $companyName)
			{
				$returnString = "Active Employment Report ($companyName)<br>";
				$queryString = "SELECT * FROM aeReport WHERE companyName=$companyName;";
				
				if($result = $link->query($queryString))
				{
					/* add the headings for each column */
					$returnString .= "<table border='1'>
									  <tr>
										<th>FullTime</th>
									  </tr>
									  <tr>
										<th>Employee Name</th>
										<th>Date Of Hire</th>
										<th>Avg. Hours</th>
									  </tr>";
					
					while($row = $result->fetch_assoc())
					{
						$returnString .= "<tr>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
										  </tr>";
													
					}				
					
					$returnString .= "</table>";
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
					$returnString .= "<table border='1'>
									  <tr>
										<th>FullTime</th>
									  </tr>
									  <tr>
										<th>Employee Name</th>
										<th>Date Of Hire</th>
										<th>Avg. Hours</th>
									  </tr>";
					$returnString .= "</table>";
				}
				
				return $returnString;
			}
			
			/*
			 * Function: 
			 * Description: This function generates the ___ Report and returns it as a string
			 * Parameters: The link to the database connection and the name of the company
			 *             that the report should be generated for
			 * Return: The ___ Report as a string
			 */
			function generate_ieReport($link, $companyName)
			{
				$returnString = "Inactive Employment Report ($companyName)<br>";
				$queryString = "SELECT * FROM sReport WHERE companyName=$companyName;";
				
				if($result = $link->query($queryString))
				{
					/* add the headings for each column */
					$returnString .= "<table border='1'>
									  <tr>
										<th>Employee Name</th>
										<th>Hired</th>
										<th>Terminated</th>
										<th>Type</th>
										<th>Reason For Leaving</th>
									  </tr>";
					
					while($row = $result->fetch_assoc())
					{
						$returnString .= "<tr>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
											<td>" . $row[""] . "</td>
										  </tr>";
													
					}		

					$returnString .= "</table>";					
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
					$returnString .= "<table border='1'>
									  <tr>
										<th>Employee Name</th>
										<th>Hired</th>
										<th>Terminated</th>
										<th>Type</th>
										<th>Reason For Leaving</th>
									  </tr>";
					$returnString .= "</table>";
				}
				
				return $returnString;
			}
		?>	

	</body>


</html>