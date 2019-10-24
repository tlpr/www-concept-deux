<?php
/*
 * This file is a part of the second concept of website 
 * for the Las Pegasus Radio project.
 * It's licensed under the GNU AGPLv3-only license.
 * https://github.com/tlpr/www-concept-deux
 */


class ApiFront
{
	
	private $API_ADDRESS = 'http://127.0.0.1/api/v1/';
	private $API_KEY = '';

	private function SendRequest($Http_Address, $Type, $Headers=0)
	{
		
		$ch = curl_init($Http_Address);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $Type);
		
		if ( $Headers )
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($Headers));
			
		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
		
	}


	function GetUserInformation ($UserID, $ApiKey=0)
	{
		if (!$ApiKey) $ApiKey = $this->API_KEY;

		
	}

	function ValidateCredentials($Username, $Password, $ApiKey=0)
	{
		
		if (!$ApiKey) $ApiKey = $this->API_KEY;
		
		$Address = $this->API_ADDRESS . "validate.php?act=credentials&username=$Username".
		"&password=$Password&auth=$ApiKey";
		
		return $this->SendRequest($http_address, 'GET');
		
	}

}
