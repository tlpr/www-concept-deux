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

	// requires full URL to send request to, request type/method (GET/POST/PUT/DELETE)
	// and optionally $Headers (in case if not using GET)
	// returns array with returned data or NULL if operation did not succeeded.
	private function SendRequest($Http_Address, $Type, $Headers=0)
	{
		
		$ch = curl_init($Http_Address);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $Type);
		
		if ( $Headers )
		{
			// Create an JSON object out of the array to
			// send it through the PUT request.
			if ( $Type == 'PUT' )
			{
				$Headers = json_encode($Headers);
				
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json','Content-Length: '.strlen($Headers)));
				
				curl_setopt($ch, CURLOPT_POSTFIELDS, $Headers);
			}
			
			// Otherwise, just send Headers as an array.
			else
			{
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($Headers));
			}
		}
			
		$response = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		//if ( $status != 200 )
		//	return NULL;
		
		return $response;
		//return json_decode($response, true);
		
	}


	/////////////////////////////////////////
	// USER MANAGEMENT

	function GetUserInformation ($UserID, $ApiKey=self::API_KEY)
	{

		$Address = self::API_ADDRESS . "user.php?id=$UserID".
		"&auth=$ApiKey";
		
		return $this->SendRequest($Address, 'GET');
		
	}
	
	function CreateNewUser ($Username, $Password, $Email=0, $ApiKey=self::API_KEY)
	{
		
		$Address = self::API_ADDRESS . "user.php?auth=$ApiKey";
		$Headers = array(
			'username' => $Username,
			'password' => $Password,
		);
		
		if ( $Email ) // if not 0
			$Headers['email'] = $Email;
		
		return $this->SendRequest($Address, 'POST', $Headers);
		
	}
	
	function ModifyUser ($UserID, $SettingsToChange, $ApiKey=self::API_KEY)
	{
		
		$Address = self::API_ADDRESS . "user.php?id=$UserID&auth=$ApiKey";
		return $this->SendRequest($Address, 'PUT', $SettingsToChange);
		
	}
	
	function DeleteUser ($UserID, $ApiKey=self::API_KEY)
	{
		
		$Address = self::API_ADDRESS . "user.php?id=$UserID&auth=$ApiKey";
		return $this->SendRequest($Address, 'DELETE');
		
	}
	
	
	/////////////////////////////////////////
	// CREDENTIALS VALIDATION
	
	function ValidateCredentials ($Username, $Password, $ApiKey=self::API_KEY)
	{
		
		$Address = self::API_ADDRESS . "validate.php?act=credentials&username=$Username".
		"&password=$Password&auth=$ApiKey";
		
		return $this->SendRequest($Address, 'GET');
		
	}
	
	function ValidateTwoFactor ($UserID, $Token, $ApiKey=self::API_KEY)
	{
		
		$Address = self::API_ADDRESS . "validate.php?act=totp&user_id=$UserID".
		"&code=$Token&auth=$ApiKey";
		
		return $this->SendRequest($Address, 'GET');
		
	}
	
	
	/////////////////////////////////////////
	// ACCOUNT INVITES
	
	function GenerateInviteCode ($UserID, $ApiKey=self::API_KEY)
	{
		
		$Address = self::API_ADDRESS . "invite.php?id=$UserID&auth=$ApiKey";
		return $this->SendRequest($Address, 'POST');
		
	}
	
	// TODO: Always returns success for some reason. (API causes this)
	function ValidateInviteCode ($Username, $Code, $ApiKey=self::API_KEY)
	{
		
		$Address = self::API_ADDRESS . "invite.php?auth=$ApiKey";
		$Headers = array(
			'user_id' => $Username,
			'code' => $Code
		);
		
		return $this->SendRequest($Address, 'PUT', $Headers);
		
	}
	
	
	/////////////////////////////////////////
	// SONG MANAGEMENT
	
	function GetSongInformation ($SongID, $ApiKey=self::API_KEY)
	{
		
		$Address = self::API_ADDRESS . "song.php?song_id=$SongID&auth=$ApiKey";
		return $this->SendRequest($Address, 'GET');
		
	}
	
	function CreateSongEntry ($SongName, $AlbumTitle, $ApiKey=self::API_KEY)
	{
		
		$Address = self::API_ADDRESS . "song.php?auth=$ApiKey";
		$Headers = array(
			'song_name' => $SongName,
			'album_title' => $AlbumTitle
		);
		
		return $this->SendRequest($Address, 'POST', $Headers);
		
	}
	
	// $SongIdentifier is either a number that symbolizes ID, or
	// a string that symbolizes a full song title.
	function RemoveSongEntry ($SongIdentifier, $ApiKey=self::API_KEY)
	{
		
		if ( is_numeric($SongIdentifier) )
		{
			$Address = self::API_ADDRESS . 'song.php?format=by_id'.
			"&id=$SongIdentifier&auth=$ApiKey";
		}
		else
		{
			$SongIdentifier = urlencode($SongIdentifier);
			
			$Address = self::API_ADDRESS . 'song.php?format=by_title'.
			"&id=$SongIdentifier&auth=$ApiKey";
		}
		
		return $this->SendRequest($Address, 'DELETE');
		
	}
	
	

}
