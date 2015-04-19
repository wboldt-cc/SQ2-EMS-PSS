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
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
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
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
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
				$returnString = "";
				$queryString = "";
				
				if($result = $link->query($queryString))
				{
					/* add the headings for each column */
					$returnString .= "<table border='1'>
									  <tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
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
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
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
				$returnString = "";
				$queryString = "";
				
				if($result = $link->query($queryString))
				{
					/* add the headings for each column */
					$returnString .= "<table border='1'>
									  <tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
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
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
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
				$returnString = "";
				$queryString = "";
				
				if($result = $link->query($queryString))
				{
					/* add the headings for each column */
					$returnString .= "<table border='1'>
									  <tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
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
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
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
				$returnString = "";
				$queryString = "";
				
				if($result = $link->query($queryString))
				{
					/* add the headings for each column */
					$returnString .= "<table border='1'>
									  <tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
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
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
				}
				
				return $returnString;
			}
			

	</body>


</html>