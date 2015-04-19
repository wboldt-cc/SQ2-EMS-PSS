<?php
	function ValidateName($name, &$errorMessage)
	{
		$validateStatus = 0;
		$errorMessage = "Invalid Characters Found:</br>";

		for ($i = 0; $i < strlen($name); $i++)
		{
			if (ctype_alpha($name[$i]) == false)
			{
				if ($name[$i] != '\'' && $name[$i] != '-')
				{
					$errorMessage .= $name[$i] . " ";
					$validateStatus = 1;
				}
			}
		}

		if ($validateStatus == 1)
		{
			$errorMessage .= "</br></br>Please Be Sure To Only Enter:</br>A-Z</br>a-z</br></br>";
		}
		else
		{
			$errorMessage = "";
		}
		
		return $validateStatus;
	}
	
	function ValidateSocialInsuranceNumber($socialInsuranceNumber, &$errorMessage)
	{
		$validateStatus = 0;
		$sinValNumTwoStr = "";
		$checkSum = 0;
		$sinNumLength = 9;
		$sinNumInt = array();
		$sinValNumOne = 0;
		$sinValNumTwo = 0;
		$roundedUpInt = 0;
		$errorMessage = "Invalid Characters Found:\n";

		for ($i = 0; $i < strlen($socialInsuranceNumber); $i++)
		{
			if($socialInsuranceNumber[$i] == ' ')
			{
				$socialInsuranceNumber = str_replace(' ', '', $socialInsuranceNumber);
			}
		}

		if (strlen($socialInsuranceNumber) == $sinNumLength)
		{
			for ($i = 0; $i < strlen($socialInsuranceNumber); $i++)
			{
				if (ctype_digit ($socialInsuranceNumber[$i]) == false)
				{
					$errorMessage .= $socialInsuranceNumber[$i] . " ";
					$validateStatus = 1;
				}
				else
				{
					$sinNumInt[$i] = $socialInsuranceNumber[$i];
				}
			}

			if ($validateStatus == 0)
			{
				//add up all the numbers in the odd placeholders
				for ($i = 0; $i <= 6; $i++)
				{
					$sinValNumOne .= intval($sinNumInt[$i]);

					$i++;
				}

				//add up all the numbers in the even placeholders
				for ($i = 1; $i <= 7; $i++)
				{
					$sinValNumTwoStr .= (string)(intval($sinNumInt[$i]) * 2);
					$i++;
				}

				for ($i = 0; $i < strlen($sinValNumTwoStr); $i++)
				{
					$sinValNumTwo .= $sinValNumTwoStr[$i];
				}

				$sinValNumOne .= $sinValNumTwo;
				$roundedUpInt = $sinValNumOne;

				while (($roundedUpInt % 10) != 0)
				{
					$roundedUpInt++;
				}

				$checkSum = intval($socialInsuranceNumber[8]);
				if ($checkSum != ($roundedUpInt - $sinValNumOne))
				{
					$validateStatus = 1;
					$errorMessage = "Invalid Checksum. Please Be Sure To Enter A Valid SIN.\n";
				}
			}
			else
			{
				$errorMessage .= "\n\nPlease Be Sure To Only Enter:\n0-9\n";
			}
		}
		else
		{
			$errorMessage = "Please Be Sure You Social Insurance Number\nIs 9 Digits In Length\n";
			$validateStatus = 1;
		}

		if ($validateStatus == 0)
		{
			$errorMessage = "";
		}

		return $validateStatus;
	}
	
	function ValidateDateOfBirth($dateOfBirth, $dateOfHire, $dateOfTermination, &$errorMessage)
	{
		$validateStatus = 0;
		$ageRequirement = 16;
		$errorMessage = "";

		if ($dateOfBirth != "1000-01-01")
		{
			if (dateOfHire != "1000-01-01")
			{
				if ((dateOfHire.Year - dateOfBirth.Year) < ageRequirement)
				{
					validateStatus = false;
					errorMessage += "Please Be Sure The Employee Is Over 16 Years Old\nBefore Hiring\n\n";
				}
			}

			if (dateOfTermination != DateTime.MinValue)
			{
				if (dateOfBirth > dateOfTermination)
				{
					validateStatus = false;
					errorMessage += "Please Be Sure The Employee Is Over 16 Years Old\nBefore Terminating\n\n";
				}
			}
		}
		else 
		{
			validateStatus = false;
			errorMessage = "Please Enter A Valid Date Of Birth\n";
		}

		return validateStatus;
	}
?>