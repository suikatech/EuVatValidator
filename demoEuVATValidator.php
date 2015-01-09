<?php
require('EuVATValidator.class.php');

// Default message
$result = "Submit the VAT Number to validate in the form below";

if (isset($_POST['vatNumber']))
{
	// Create an object
	$euVATValidator = new EuVATValidator();
	
	// Verify
	if ($euVATValidator->verifyVatNumber($_POST['vatNumber']))
	{
		$result = $euVATValidator->cleanVatNumber($_POST['vatNumber']).' is valid';
	}
	else
	{
		$result = $euVATValidator->cleanVatNumber($_POST['vatNumber']).' is not valid';
	}
}
?>
<html>
	<head>
		<title>Demo for EuVATValidator</title>
	</head>
	<body>
		<h1>Demo for EuVATValidator</h1>
		<form action="#" method="POST">
			<fieldset>
				<legend>European VAT Number</legend>
				<input name="vatNumber" placeholder="European VAT Number">
				<input type="submit">
			</fieldset>
		</form>
		<h2>Result</h2>
		<p><?php echo $result; ?></p>
	</body>
</html>
