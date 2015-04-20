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

			$typeOfReport = "";
			$companyName = "";	
			$generatedReport = "";			
			
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
			/* the following variables are used to have the report type the user selected stay selected when they submit the form */
			$sReportSelected = "";
			$whwReportSelected = "";
			$pReportSelected = "";
			$aeReportSelected = "";
			$ieReportSelected = "";
									
			if(!empty($_POST['reportToGenerateDropDown']) && !empty($_POST['companyName']))
			{
				$typeOfReport = $_POST['reportToGenerateDropDown'];
				$companyName = $_POST['companyName'];
				$generatedReport = "";
				
				$link = mysqli_connect($serverName, $userName, $password, $databaseName);// connect to the database

				if(!$link)
				{
					//if the database connection failed send error message
					 echo "<br>Error: Could not connect to the database.";
				}
				else// we have a connection
				{
					switch($typeOfReport)
					{
					case "sReport":
						$generatedReport = generate_sReport($link, $companyName);
						$sReportSelected = "selected";
						break;
					case "whwReport":
						$generatedReport .= generate_whwReport($link, $companyName);
						$whwReportSelected = "selected";
						break;
					case "pReport":
						$generatedReport .= generate_pReport($link, $companyName);
						$pReportSelected = "selected";
						break;
					case "aeReport":
						$generatedReport .= generate_aeReport($link, $companyName);
						$aeReportSelected = "selected";
						break;
					case "ieReport":
						$generatedReport .= generate_ieReport($link, $companyName);
						$ieReportSelected = "selected";
						break;
					}
					
					$generatedReport .= "<br> &nbsp&nbspRun by: $userName<br>";
					
				}
				
			}	
			else// user either hasn't chosen a report type or a company name (or both)
			{
				if(empty($_POST['companyName']))
				{
					$generatedReport .= "Please enter a name for the company to generate the reports for.<br>";
				}
				else
				{
					$companyName = $_POST['companyName'];
				}
				
				if(empty($_POST['reportToGenerateDropDown']))
				{
					$generatedReport .= "Please select a report type from the drop down menu.";
				}
				else
				{
					$typeOfReport = $_POST['reportToGenerateDropDown'];
					switch($typeOfReport)
					{
					case "sReport":
						$sReportSelected = "selected";
						break;
					case "whwReport":
						$whwReportSelected = "selected";
						break;
					case "pReport":
						$pReportSelected = "selected";
						break;
					case "aeReport":
						$aeReportSelected = "selected";
						break;
					case "ieReport":
						$ieReportSelected = "selected";
						break;
					}
				}
				
			}
			
			echo "<form method='post'>		
					What is the name of the company to display: &nbsp&nbsp&nbsp&nbsp&nbsp
					<input type='text' name='companyName' value='$companyName'><br>
					Which type of report would you like to display? 
						<select name='reportToGenerateDropDown'>
										<option value=''></option>
										<option value='sReport' $sReportSelected>Seniority</option>
										<option value='whwReport' $whwReportSelected>Weekly Hours Worked</option>";
			if($userType == "administrator")
			{
				echo "<option value='pReport' $pReportSelected>Payroll</option>
					  <option value='aeReport' $aeReportSelected>Active Employees</option>
					  <option value='ieReport' $ieReportSelected>Inactive Employees</option>";
			}
			
			echo "		</select>
						<input type='submit' value='Generate Report'><br><hr>										
				  </form>";
				  
			
			echo "$generatedReport";
				
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
					
					$returnString .= "Date Generated: DATE";
					
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
										<th colspan='3'>FullTime</th>
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
					
					$returnString .= "For Week Ending: WEEK";
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
					$returnString .= "<table border='1'>
									  <tr>
										<th colspan='3'>FullTime</th>
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
										<th colspan='4'>FullTime</th>
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
					
					$returnString .= "For Week Ending: WEEK";
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
					$returnString .= "<table border='1'>
									  <tr>
										<th colspan='4'>FullTime</th>
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
										<th colspan='3'>FullTime</th>
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
					
					$returnString .= "Date Generated: DATE";
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not generate the report. Sorry for the inconvenience";
					$returnString .= "<table border='1'>
									  <tr>
										<th colspan='3'>FullTime</th>
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
					
					$returnString .= "Date Generated: DATE";				
					
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