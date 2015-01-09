# EuVatValidator
PHP Class to validate European VAT numbers using VIES SOAP API

This class makes the validation of European VAT Number easy. It perfoms some format validation and queries the SOAP API of the VIES website ( http://ec.europa.eu/taxation_customs/vies/?locale=en ).

## How to use example
```php
// Create an instance of the class
$euVATValidator = new EuVATValidator();
// Validate Vat Number
if ($euVATValidator->verifyVatNumber("VAT_NUMBER_TO_VALIDATE"))
{
	echo "Valid";
}
else
{
	echo "Invalid";
}
```

## Test file
An example file `demoEuVATValidator.php` is included and can be used to test the class.

## Licence
This class is released under the GPLv3 licence
