<html>
<head>
	<?php
		include 'validate.php';
	?>
</head>
<body>
	<div class="margin">
	</div>

	<div class="content"> </br>
		<h2>Employee Maintenance</h2>
		Employee Type:</br>
		<form method='post'>
			<input type='text' name='testText'></input>
			<input type='submit' id='desu' value='Herru'></input>
		</form>
		</br></br>
		<span id='testSpan'>
			<?php
				$errorMessage='';
				if(ValidateSocialInsuranceNumber($_POST['testText'], $errorMessage) > 0)
				{
					echo "</br>";
					echo $errorMessage;
				}
			?>
		</span>

	</div>
	</br>
</body>
</html>