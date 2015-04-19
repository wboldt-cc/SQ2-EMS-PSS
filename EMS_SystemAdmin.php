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
			<a href= "EMS_EmployeeReports.php">Employee Reports</a><br></br>
			System Administration

		</div>

		<div class="margin">
		</div>

		<div class="content"> </br>
			<h2>System Administration</h2>
			
			
			<form method='post'>
			
			<?php
			if($userType == 'administrator')
			{						
				echo "Enter the name of the company to add: ";
				echo "<input type='text' name='companyToAdd'> ";
				echo "&nbsp&nbsp<input type='submit' value='Add'><br><hr>";
				
				
				if(!empty($_POST['companyToAdd']))
				{
					$companyToAdd = $_POST['companyToAdd'];
					
					if($companyToAdd != "")
					{
						if(strlen($companyToAdd) >= 50)// make sure the company name isn't too long
						{
							echo "The company name you entered was too long. We accept up to 50 characters. Please enter a shorter company name.";
						}
						else// company length is proper length
						{
						
							$link = mysqli_connect($serverName, $userName, $password, $databaseName);// connect to the database
										
							if(!$link)
							{
								//if the database connection failed send error message
								 echo "<br>Error: Could not connect to the database.";
							}
							else// we have a connection
							{
							
								$returnedString = addCompany($companyToAdd, $link);
							
								echo "<br>$returnedString";
								
							}
						}
						
					}// end 'if' statement
					
				}// end 'if' statement	
				
				
			}
			else// user is not an administrator
			{
				echo "You do not have access to this page.";
			}
			
			
			?>
			
			
			</form>
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
			function addCompany($companyToAdd, $link)
			{
				$returnString = "";				
				$queryString = "INSERT INTO Company (companyName) VALUES('$companyToAdd');";							
				
				if($result = $link->query($queryString))// make sure query was successful
				{
					
					$returnString .= "The company: '$companyToAdd' was successfully added to the database.";
					
					//$result->free();
				}
				else// query failed
				{
					$returnString = "There was an error attempting to enter the company into the database.";
//$returnString = $queryString;
				}	
				
				return $returnString;
			}
			
			
			
		?>

	</body>


</html>