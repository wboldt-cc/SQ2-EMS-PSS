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

		

		<div class="menu">
			</br> <b>Operation Modes:</b> </br></br>
			<a href= "EMS_HomePage.php" >Home</a><br></br>
			<a href= "EMS_EmployeeMaintenance.php">Manage Employees</a><br></br>
			<a href= "EMS_EmployeeReports.php">Employee Reports</a><br></br>
			<!-- if user is an administrator -->
			<a href= "EMS_SystemAdmin.php">System Administration</a><br></br>

		</div>

		<div class="margin">
		</div>

		<div class="content"> </br>
		
		
			<h2>Search Employees</h2>
			<hr>
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
				$link = mysqli_connect($serverName, $userName, $password, $databaseName); //connects to the database
								
				if(!$link)
				{
					//if the database connection failed send error message
					 echo "<br>Error: Could not connect to the database. Please check your input.";
				}
				else// we have a connection
				{
					$dropdownMenu = constructDropdownMenu($lastNameToSearchFor, $firstNameToSearchFor, $SINtoSearchFor, $link);
					
					echo "$dropdownMenu";
							
					if(!empty($_POST['employeeToDisplay']))
					{
					$stringy = $_POST['employeeToDisplay'];
						echo "test     ";
						echo "$stringy";
					}
					
					
					
					
$link->close();
								
				}
			}
			
			
			
			
			
			
			
			?>
			
			

		</div>

		<div class="margin">
		</div>

		<div class="footer">
			Copyright &copy Ava-Program-O!
		</div>
		
		
		<?php
		
			
			function constructDropdownMenu($lastNameToSearchFor, $firstNameToSearchFor, $SINtoSearchFor, $link)
			{
				$returnString = "";
			
				//display lastname firstname and sin of employees found in list form.
				//User will be able to click on them and display that employees info
				$returnString = "
									<select name='employeeToDisplay'><!--dropdown box which specifies the sorting method-->
										<option value=''></option>
										<option value='$SINtoSearchFor'>$lastNameToSearchFor, $firstNameToSearchFor, $SINtoSearchFor</option>
										<option value='CompanyName'>Dirt, Joe, 333 333 334</option>
										<option value='ContactName'>Contact Name</option>
									</select>
									
									<input type='submit' value='Display'><br>
									
									
								
								";
			
				return $returnString;
			}
			
			
			function changeDisplayedEmployee()
			{
			
			}
			
			
		
		?>
		
		</form>

	</body>


</html>