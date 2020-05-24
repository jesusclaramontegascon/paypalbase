<?php
/*==================================================================
 PayPal Express Checkout Call
 ===================================================================
*/
// Check to see if the Request object contains a variable named 'token'	
$token = "";
if (isset($_REQUEST['token']))
{
	$token = $_REQUEST['token'];
}

// If the Request object contains the variable 'token' then it means that the user is coming from PayPal site.	
if ( $token != "" )
{

	require_once ("paypalfunctions.php");

	/*
	'------------------------------------
	' Calls the GetExpressCheckoutDetails API call
	'
	' The GetShippingDetails function is defined in PayPalFunctions.jsp
	' included at the top of this file.
	'-------------------------------------------------
	*/
	

	$resArray = GetShippingDetails( $token );
	$ack = strtoupper($resArray["ACK"]);
	if( $ack == "SUCCESS" || $ack == "SUCESSWITHWARNING") 
	{
		/*
		' The information that is returned by the GetExpressCheckoutDetails call should be integrated by the partner into his Order Review 
		' page		
		*/
		/*$email 				= $resArray["EMAIL"]; // ' Email address of payer.
		$payerId 			= $resArray["PAYERID"]; // ' Unique PayPal customer account identification number.
		$payerStatus		= $resArray["PAYERSTATUS"]; // ' Status of payer. Character length and limitations: 10 single-byte alphabetic characters.
		$salutation			= $resArray["SALUTATION"]; // ' Payer's salutation.
		$firstName			= $resArray["FIRSTNAME"]; // ' Payer's first name.
		$middleName			= $resArray["MIDDLENAME"]; // ' Payer's middle name.
		$lastName			= $resArray["LASTNAME"]; // ' Payer's last name.
		$suffix				= $resArray["SUFFIX"]; // ' Payer's suffix.
		$cntryCode			= $resArray["COUNTRYCODE"]; // ' Payer's country of residence in the form of ISO standard 3166 two-character country codes.
		$business			= $resArray["BUSINESS"]; // ' Payer's business name.
		$shipToName			= $resArray["SHIPTONAME"]; // ' Person's name associated with this address.
		$shipToStreet		= $resArray["SHIPTOSTREET"]; // ' First street address.
		$shipToStreet2		= $resArray["SHIPTOSTREET2"]; // ' Second street address.
		$shipToCity			= $resArray["SHIPTOCITY"]; // ' Name of city.
		$shipToState		= $resArray["SHIPTOSTATE"]; // ' State or province
		$shipToCntryCode	= $resArray["SHIPTOCOUNTRYCODE"]; // ' Country code. 
		$shipToZip			= $resArray["SHIPTOZIP"]; // ' U.S. Zip code or other country-specific postal code.
		$addressStatus 		= $resArray["ADDRESSSTATUS"]; // ' Status of street address on file with PayPal   
		$invoiceNumber		= $resArray["INVNUM"]; // ' Your own invoice or tracking number, as set by you in the element of the same name in SetExpressCheckout request .
		$phonNumber			= $resArray["PHONENUM"]; // ' Payer's contact telephone number. Note:  PayPal returns a contact telephone number only if your Merchant account profile settings require that the buyer enter one. 
		*/
session_start();
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<h1>Revisar el pedido antes de confirmar el pago</h1>
<p>
<?php echo "Hola: ".$_SESSION["username"]; ?>
</p>
<p>Cuando hagas clic en el enlace <a href="confirmar-pedido.php">siguiente</a> se procederá al pago en firma del pedido</p>
</body>
</html>
	
	
<?php	
	
	} 
	else  
	{
		//Display a user friendly Error on the page using any of the following error information returned by PayPal
		$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
		$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
		$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
		$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
		
		echo "GetExpressCheckoutDetails API call failed. ";
		echo "Detailed Error Message: " . $ErrorLongMsg;
		echo "Short Error Message: " . $ErrorShortMsg;
		echo "Error Code: " . $ErrorCode;
		echo "Error Severity Code: " . $ErrorSeverityCode;
	}
}
		
?>


