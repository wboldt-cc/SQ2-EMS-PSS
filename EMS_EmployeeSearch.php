<!---
Filename: "EMS_EmployeeSearch.php"
Programmers: William Boldt, , and 
Date: April 17, 2015
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
			
			$lastNameToSearchFor = "";
			$firstNameToSearchFor = "";
			$SINtoSearchFor = "";
			
			$queryString = "";
			
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

		
		<!-- Display navigation menu -->
		<div class="menu">
			</br> <b>Operation Modes:</b> </br></br>
			<a href= "EMS_HomePage.php" >Home</a><br></br>
			Search For Employees</br></br>
			<a href= "EMS_EmployeeMaintenance.php">Manage Employees</a><br></br>
			<a href= "EMS_EmployeeReports.php">Employee Reports</a><br></br>
			<!-- if user is an administrator -->
			<a href= "EMS_SystemAdmin.php">System Administration</a><br></br>

		</div>

		<div class="margin">
		</div>

		<div class="content"> </br>
		
		
			<h2>Search Employees</h2><hr>
			
			<form method='post'>
			<?php
			if(!empty($_POST['firstName']))
			{
				$firstNameToSearchFor = $_POST['firstName'];
			}
			else
			{
				$firstNameToSearchFor = "";
			}
			
			if(!empty($_POST['lastName']))
			{
				$lastNameToSearchFor = $_POST['lastName'];
			}
			else
			{
				$lastNameToSearchFor = "";
			}
			
			if(!empty($_POST['SIN']))
			{
				$SINtoSearchFor = $_POST['SIN'];
			}
			else
			{
				$SINtoSearchFor = "";
			}
			
			
			echo "
							First Name: 
							<input type='text' name='firstName' value='$firstNameToSearchFor'>
							&nbsp &nbsp Last Name: 
							<input type='text' name='lastName' value='$lastNameToSearchFor'></br></br>
							Social Insurance Number: 
							<input type='text' name='SIN' value='$SINtoSearchFor'>
							</br></br>
																			
							<input type='submit' value='Search'><br><hr>
						";
			
			if(($lastNameToSearchFor != "") || ($firstNameToSearchFor != "") || ($SINtoSearchFor != ""))// make sure at least one of the search criteria pieces is not blank
			{
				$link = mysqli_connect($serverName, $userName, $password, $databaseName);// connect to the database
								
				if(!$link)
				{
					//if the database connection failed send error message
					 echo "<br>Error: Could not connect to the database.";
				}
				else// we have a connection
				{
					$dropdownMenu = constructDropdownMenu($lastNameToSearchFor, $firstNameToSearchFor, $SINtoSearchFor, $link);
					
					echo "$dropdownMenu";
							
					if(!empty($_POST['employeeToDisplayDropDown']))// check if the user has selected an employee
					{
						$SINofEmployee = $_POST['employeeToDisplayDropDown'];
						
						
						$employeeInfo = changeDisplayedEmployee($SINofEmployee, $link);
						
						echo $employeeInfo;
						/*
						$placeHolder = "";// place holder until we have the data for each field
						
						echo "test     ";
						echo "$SINofEmployee</br></br>";
						
						echo "First Name: $placeHolder </br>
						      Last Name: $placeHolder </br>
							  SIN: $SINofEmployee </br>
							  Date of Birth: $placeHolder </br>
							  Employed with Company: $placeHolder </br>
							  Date of Hire: $placeHolder </br>";
						
						$userType = $_SESSION['userType'];
						
						if($userType == "administrator")
						{
							echo "Date of Termination: $placeHolder </br>
								  Payment Information: $placeHolder </br>";
						}
						*/
						
					}
					
					
					
					
					$link->close();
								
				}
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
			 * Description: 
			 * Parameters: 
			 * Return: 
			 */
			function constructDropdownMenu($lastNameToSearchFor, $firstNameToSearchFor, $SINtoSearchFor, $link)
			{
				$returnString = "";
				$queryString = "";
			
																																
				//select lastName, firstName, SIN from employees where employeeType != contract & employee is active
				$queryString = "SELECT p_lastName, p_firstName, si_number FROM Person ";

				if($lastNameToSearchFor != "")
				{
					$queryString .= "WHERE p_lastName LIKE '%$lastNameToSearchFor%' ";
				}
				
				if($firstNameToSearchFor != "")
				{
					if($lastNameToSearchFor != "")// check if the last name was not blank
					{
						$queryString .= "AND p_firstName LIKE '%$firstNameToSearchFor%' ";
					}
					else// last name was blank
					{
						$queryString .= "WHERE p_firstName LIKE '%$firstNameToSearchFor%' ";
					}
				}
				
				if($SINtoSearchFor != "")
				{
					if(($lastNameToSearchFor != "") || ($firstNameToSearchFor != ""))// check if either of the names were not blank
					{
						$queryString .= "AND si_number LIKE '%$SINtoSearchFor%' ";
					}
					else// both names were blank
					{
						$queryString .= "WHERE si_number LIKE '%$SINtoSearchFor%' ";
					}
				}
				
				$queryString .= "ORDER BY p_lastName;";
				
				//display lastname firstname and sin of employees found in list form.
				//User will be able to click on them and display that employees info
				$returnString = "<select name='employeeToDisplayDropDown'>
										<option value=''></option>";
										
				if($result = $link->query($queryString))// make sure query was successful
				{
					while($row = $result->fetch_assoc())
					{
						$returnString .= "<option value='" . $row["si_number"] . "'>" . $row["p_lastName"] . ", "
   						                 . $row["p_firstName"] . ", "
										 . $row["si_number"] . "</option>";
					}
					
					$returnString .= "</select><input type='submit' value='Display'><br>";
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "There was an error while running the SQL script";
//$returnString = $queryString;
				}												
								
				//$returnString .= "<option value='$SINtoSearchFor'>$lastNameToSearchFor, $firstNameToSearchFor, $SINtoSearchFor</option>
										//<option value='CompanyName'>Dirt, Joe, 333 333 334</option>
										//<option value='ContactName'>Contact Name</option>
									//</select>
									
									//<input type='submit' value='Display'><br>";
			
				return $returnString;
			}
			
			/*
			 * Function: 
			 * Description: 
			 * Parameters: 
			 * Return: 
			 */
			function changeDisplayedEmployee($SINofEmployee, $link)
			{
				$returnString = "";
				$fisrtName = "";
				$lastName = "";
				$dateOfBirth = "";
				$employedWithCompany = "";
				$dateOfHire = "";
				$placeHolder = "";// place holder until we have the data for each field
				
				$queryString = "SELECT * FROM Person WHERE si_number='$SINofEmployee';";
			
			/* 	THIS IS JUST SOME CODE I GRABBED FROM A PREVIOUS ASSIGNMENT. IT DOES NOT WORK */
				if($result = $link->query($queryString))
				{
				/*
					echo "<table border='1'>";
					echo "<tr>";
					echo "<th>CustomerID</th>";
					echo "<th>CompanyName</th>";
					echo "<th>ContactName</th>";
					echo "<th>ContactTitle</th>";
					echo "<th>Address</th>";
					echo "<th>City</th>";
					echo "<th>Region</th>";
					echo "<th>PostalCode</th>";
					echo "<th>Country</th>";
					echo "<th>Phone</th>";
					echo "<th>Fax</th>";
					echo "</tr>";
					*/
					
					while($row = $result->fetch_assoc())
					{
						$returnString .= "First Name: " . $row['p_firstName'] . "</br>
								  Last Name: " . $row['p_lastName'] . "</br>
								  SIN: $SINofEmployee </br>
								  Date of Birth: $placeHolder </br>
								  Employed with Company: $placeHolder </br>
								  Date of Hire: $placeHolder </br>";
							
						$userType = $_SESSION['userType'];
						
						if($userType == "administrator")
						{
							$returnString .= "Date of Termination: $placeHolder </br>
								  Payment Information: $placeHolder </br>";
								
						}	
					}
					
						/*echo "<tr>";
						echo "<td>" . $row["CustomerID"] . "</td>";
						echo "<td>" . $row["CompanyName"] . "</td>";
						echo "<td>" . $row["ContactName"] . "</td>";
						echo "<td>" . $row["ContactTitle"] . "</td>";
						echo "<td>" . $row["Address"] . "</td>";
						echo "<td>" . $row["City"] . "</td>";
						echo "<td>" . $row["Region"] . "</td>";
						echo "<td>" . $row["PostalCode"] . "</td>";
						echo "<td>" . $row["Country"] . "</td>";
						echo "<td>" . $row["Phone"] . "</td>";
						echo "<td>" . $row["Fax"] . "</td>";
						echo "</tr>";	
*/

										
					
					
					$result->free();
				}
				else// query failed
				{
					$returnString = "Could not display the Employees Information. Sorry for the inconvenience";
				}																
						
						
						
				return $returnString;
			}

		?>
		
		
		
		</form>

	</body>


</html>