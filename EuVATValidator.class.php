<?php
/**
* 
* Class to verify EU VAT numbers validity
* Original code by Edouard THIVET (ed@suikatech.com) for Suikatech.com
* License : GPLv3
* 
**/

class EuVATValidator
{
	// The address of the API
	public $soapAPIAddress = "http://ec.europa.eu/taxation_customs/vies/services/checkVatService";

	public function EuVATValidator()
	{
	}
	
	/**
	* 
	* This function creates the request, sends it to the API and reads the response
	* 
	**/
	private function sendCheckRequest ($countryCode, $vatNumber)
	{
		// Building the xml as a string as it is faster than doing it the dom way
		$xmlString = "";
		$xmlString .= '<?xml version="1.0"?>';
		$xmlString .= '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" soap:encodingStyle="http://www.w3.org/2001/12/soap-encoding">';
		$xmlString .= '<soap:Body>';
		$xmlString .= '<m:checkVat xmlns:m="urn:ec.europa.eu:taxud:vies:services:checkVat:types">';
		$xmlString .= '<m:countryCode>'.$countryCode.'</m:countryCode>';
		$xmlString .= '<m:vatNumber>'.$vatNumber.'</m:vatNumber>';
		$xmlString .= '</m:checkVat>';
		$xmlString .= '</soap:Body>';
		$xmlString .= '</soap:Envelope>';
		
		// Create the request and send it
		$options = array(
			'http' => array(
				'header'  => "Content-type: text/xml\r\n",
				'method'  => 'POST',
				'content' => $xmlString,
				'ignore_errors' => true
			),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($this->soapAPIAddress, false, $context);
		
		// Verify response
		// You can parse the xml and get more info but we are only looking for the string we need
		if (strpos($result, "<valid>true</valid>"))
		{
			return true;
		}
		
		return false;
	}
	
	/**
	* 
	* This function check the format fo the VAT Number and passes the number to sendCheckRequest()
	* 
	**/
	public function verifyVatNumber($vatNumberFull)
	{
		// Remove spaces and make everything uppercase
		$vatNumberFull = $this->cleanVatNumber($vatNumberFull);

		// Split country code and numbers
		$countryCode = substr($vatNumberFull, 0, 2);
		$vatNumber = substr($vatNumberFull, 2);

		// Check format
		switch ($countryCode)
		{
			case "AT":
				if (preg_match("/^ATU[0-9]{8}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "BE":
				if (preg_match("/^BE[0-9]{10}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "BG":
				if (preg_match("/^BG[0-9]{9,10}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "CY":
				if (preg_match("/^CY[0-9]{8}L/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "CZ":
				if (preg_match("/^CZ[0-9]{8,10}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "DE":
				if (preg_match("/^DE[0-9]{9}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "DK":
				if (preg_match("/^DK[0-9]{8}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "EE":
				if (preg_match("/^EE[0-9]{9}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "EL":
				if (preg_match("/^EL[0-9]{9}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "ES":
				if (preg_match("/^ES[0-9A-Za-z][0-9]{7}[0-9A-Za-z]/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "FI":
				if (preg_match("/^FI[0-9]{8}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "FR":
				if (preg_match("/^FR[0-9A-Za-z]{2}[0-9]{9}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "GB":
				if (preg_match("/^GB[0-9]{9,12}/", $vatNumberFull) != 1 && preg_match("/^GB(GD|HA)[0-9]{3}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "HR":
				if (preg_match("/^HR[0-9]{11}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "HU":
				if (preg_match("/^HU[0-9]{8}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "IE":
				if (preg_match("/^IE[0-9]([0-9A-Za-z*+])[0-9]{5}(L|WI)/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "IT":
				if (preg_match("/^IT[0-9]{11}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "LT":
				if (preg_match("/^LT[0-9]{9,12}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "LU":
				if (preg_match("/^LU[0-9]{8}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "LV":
				if (preg_match("/^LV[0-9]{11}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "MT":
				if (preg_match("/^MT[0-9]{8}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "NL":
				if (preg_match("/^NL[0-9]{9}B[0-9]{2}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "PL":
				if (preg_match("/^PL[0-9]{10}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "PT":
				if (preg_match("/^PT[0-9]{9}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "RO":
				if (preg_match("/^RO[0-9]{2,10}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "SE":
				if (preg_match("/^SE[0-9]{12}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "SI":
				if (preg_match("/^SI[0-9]{8}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			case "SK":
				if (preg_match("/^SK[0-9]{10}/", $vatNumberFull) != 1)
				{
					return false;
				}
				break;
			default:
				return false;
				break;
		}
		
		// Send request
		return $this->sendCheckRequest ($countryCode, $vatNumber);
	}
		
	/**
	* 
	* This function cleans the VAT Number (remove spaces and set uppercase)
	* 
	**/
	public function cleanVatNumber($vatNumberFull)
	{
		return strtoupper(preg_replace('/\s+/', '', $vatNumberFull));
	}	
}
