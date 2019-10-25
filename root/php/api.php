<?php
/*
 * This file is a part of the second concept of website 
 * for the Las Pegasus Radio project.
 * It's licensed under the GNU AGPLv3-only license.
 * https://github.com/tlpr/www-concept-deux
 */


class ApiFront
{
	
	private const API_ADDRESS = 'http://127.0.0.1/api/v1/';
	private const API_KEY = '';

	private function SendRequest($Http_Address, $Type, $Headers=0)
	{
		
		$ch = curl_init($Http_Address);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $Type);
		
		if ( $Headers )
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($Headers));
			
		$response = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		if ( $status != 200 )
			return NULL;
		
		return json_decode($response, true);
		
	}


	function GetUserInformation ($UserID, $ApiKey=self::API_KEY)
	{
		//if (!$ApiKey) $ApiKey = $this->API_KEY;

		
	}

	function ValidateCredentials($Username, $Password, $ApiKey=self::API_KEY)
	{
		
		//if (!$ApiKey) $ApiKey = $this->API_KEY;
		
		$Address = self::API_ADDRESS . "validate.php?act=credentials&username=$Username".
		"&password=$Password&auth=$ApiKey";
		
		return $this->SendRequest($Address, 'GET');
		
	}

}
