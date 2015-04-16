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
				background-color:#d0e4fe;
			}
		</style>

		<link rel="stylesheet" href="styles.css" type="text/css">

		<title>EMS-PPS</title>

		<div class="logo">
			<img src="images\Logo.jpg" alt="Sorry, this image could not be displayed" width= "454" height="153"/>
		</div>

		<?php
			// Start the session
			session_start();
			
			$lastName = "";
			$firstName = "";
			$SIN = "";
			
			$queryString = "";
			
			$_SESSION['serverName'] = $serverName;
			$_SESSION['userName'] = $userName;
			$_SESSION['password'] = $password;
			$_SESSION['databaseName'] = $databaseName;	
			$_SESSION['userType'] = $userType;
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
			
			<?php
			if(!empty($_POST['firstName']))
			{
				$firstName = $_POST['firstName'];
			}
			else
			{
				$firstName = "";
			}
			
			if(!empty($_POST['lastName']))
			{
				$lastName = $_POST['lastName'];
			}
			else
			{
				$lastName = "";
			}
			
			if(!empty($_POST['SIN']))
			{
				$SIN = $_POST['SIN'];
			}
			else
			{
				$SIN = "";
			}
			
			
			echo "<form method='post'>
							First Name: 
							<input type='text' name='firstName' value='$firstName'>
							&nbsp &nbsp Last Name: 
							<input type='text' name='lastName' value='$lastName'></br></br>
							Social Insurance Number: 
							<input type='text' name='SIN' value='$SIN'>
							</br></br>
																			
							<input type='submit' value='Search'><br><hr>
						</form>";
			
			if(($lastName != "") || ($firstName != "") || ($SIN != ""))// make sure at least one of the search criteria pieces is not blank
			{
				//display lastname firstname and sin of employees found in list form.
				//User will be able to click on them and display that employees info
			}
			
			
			
			
			
			
			
			?>
			
			

		</div>

		<div class="margin">
		</div>

		<div class="footer">
			Copyright &copy Ava-Program-O!
		</div>

	</body>


</html>