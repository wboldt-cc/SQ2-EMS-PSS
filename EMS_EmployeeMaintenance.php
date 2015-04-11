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
			<a href= "EMS_EmployeeSearch.php" >Search For Employees</a><br></br>
			<a href= "EMS_HomePage.php" >Home</a><br></br>
			<a href= "EMS_EmployeeReports.php">Employee Reports</a><br></br>
			<!-- if user is an administrator -->
			<a href= "EMS_SystemAdmin.php">System Administration</a><br></br>

			
		</div>

		<div class="margin">
		</div>

		<div class="content"> </br>
			<h2>Employee Maintenance</h2>

			Please select an option on the left.

		</div>

		<div class="margin">
		</div>

		<div class="footer">
			Copyright &copy Ava-Program-O!
		</div>


	</body>


</html>