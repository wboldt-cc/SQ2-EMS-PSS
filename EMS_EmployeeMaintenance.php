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
		?>
		
		<script>
			function employeeFormChange()
			{				
				if(document.getElementById('employeeTypeDropdown').value == 'fullTimeEmployee')
				{
					document.getElementById('employeeFeilds').innerHTML = "<h3>Personal Information</h3>" +
					"<table border='0'>" +
						"<tr>" +
							"<th align='right'>First Name:</th>" +
							"<td><input type='text' name='firstName'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Last Name:</th>" +
							"<td><input type='text' name='lastName'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Date Of Birth:</th>" +
							"<td><input type='text' name='dob'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>SIN:</th>" +
							"<td><input type='text' name='sinNumber'></td>" +
						"</tr>" +
					"</table>" +
						"<h3>Business Information</h3>" +
					"<table>" +
						"<tr>" +
							"<th align='right'>Date Of Hire:</th>" +
							"<td><input type='text' name='doh'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Date Of Termination:</th>" +
							"<td><input type='text' name='dot'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Salary:</th>" +
							"<td><input type='text' name='salary'></td>" +
						"</tr>" +
					"</table>";
				} 
				else if(document.getElementById('employeeTypeDropdown').value == 'partTimeEmployee')
				{
					document.getElementById('employeeFeilds').innerHTML = "<h3>Personal Information</h3>" +
					"<table border='0'>" +
						"<tr>" +
							"<th align='right'>First Name:</th>" +
							"<td><input type='text' name='firstName'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Last Name:</th>" +
							"<td><input type='text' name='lastName'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Date Of Birth:</th>" +
							"<td><input type='text' name='dob'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>SIN:</th>" +
							"<td><input type='text' name='sinNumber'></td>" +
						"</tr>" +
					"</table>" +
						"<h3>Business Information</h3>" +
					"<table>" +
						"<tr>" +
							"<th align='right'>Date Of Hire:</th>" +
							"<td><input type='text' name='doh'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Date Of Termination:</th>" +
							"<td><input type='text' name='dot'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Hourly Rate:</th>" +
							"<td><input type='text' name='hourlyRate'></td>" +
						"</tr>" +
					"</table>";
				} 
				else if(document.getElementById('employeeTypeDropdown').value == 'seasonalEmployee')
				{
					document.getElementById('employeeFeilds').innerHTML = "<h3>Personal Information</h3>" +
					"<table border='0'>" +
						"<tr>" +
							"<th align='right'>First Name:</th>" +
							"<td><input type='text' name='firstName'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Last Name:</th>" +
							"<td><input type='text' name='lastName'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Date Of Birth:</th>" +
							"<td><input type='text' name='dob'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>SIN:</th>" +
							"<td><input type='text' name='sinNumber'></td>" +
						"</tr>" +
					"</table>" +
						"<h3>Business Information</h3>" +
					"<table>" +
						"<tr>" +
							"<th align='right'>Season:</th>" +
							"<td><input type='text' name='season'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Year:</th>" +
							"<td><input type='text' name='year'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Piece Pay:</th>" +
							"<td><input type='text' name='piecePay'></td>" +
						"</tr>" +
					"</table>";
				} 
				else if(document.getElementById('employeeTypeDropdown').value == 'contractEmployee')
				{
					document.getElementById('employeeFeilds').innerHTML = "<h3>Personal Information</h3>" +
					"<table>" +
						"<tr>" +
							"<th align='right'>Last Name:</th>" +
							"<td><input type='text' name='lastName'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Date Of Birth:</th>" +
							"<td><input type='text' name='dob'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>BN:</th>" +
							"<td><input type='text' name='sinNumber'></td>" +
						"</tr>" +
					"</table>" +
						"<h3>Business Information</h3>" +
					"<table>" +
						"<tr>" +
							"<th align='right'>Contract Start Date:</th>" +
							"<td><input type='text' name='cStartD'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Contract Stop Date:</th>" +
							"<td><input type='text' name='cStopd'></td>" +
						"</tr>" +
						"<tr>" +
							"<th align='right'>Contract Pay:</th>" +
							"<td><input type='text' name='contractPay'></td>" +
						"</tr>" +
					"</table>";
				}
			}
		</script>
		
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
			Manage Employees</br></br>
			<a href= "EMS_EmployeeReports.php">Employee Reports</a><br></br>
			<!-- if user is an administrator -->
			<a href= "EMS_SystemAdmin.php">System Administration</a><br></br>
		</div>

		<div class="margin">
		</div>

		<div class="content"> </br>
			<h2>Employee Maintenance</h2>
			Employee Type:</br>
			<select id='employeeTypeDropdown' onChange="employeeFormChange()">
				<option></option>
				<option value='fullTimeEmployee'>Full-Time Employee</option>
				<option value='partTimeEmployee'>Part-Time Employee</option>
				<option value='seasonalEmployee'>Seasonal Employee</option>
				<option value='contractEmployee'>Contract Employee</option>
			</select>
			</br></br>
			<span id='employeeFeilds'></span>

		</div>

		<div class="margin">
		</div>

		<div class="footer">
			Copyright &copy MATTHEWSOFT
		</div>
		
		<?php
			
		?>

	</body>


</html>