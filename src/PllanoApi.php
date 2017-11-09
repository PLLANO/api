<?php
/**
* PLLANO REST API
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
*
* @category        PLLANO
* @package         pllano/api
* @version         1.0
* @author          PLLANO
* @copyright       Copyright (c) 2017 PLLANO
* @license         http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
*
* EXTENSION INFORMATION
*
* PLLANO API       https://github.com/pllano/api/
*
*/

/**
* REST API PLLANO
*
* @author	PLLANO <support@pllano.com>
*/

class PllanoApi
{

private $_api_url;
private $_country;

	/**
	* Constructor.
	*
	* @param string $public_key
	* @param string $format
	* @param string $country
	*
	* @throws InvalidArgumentException
	*/
	public function __construct($country)
	{
	
		if (empty($country)) {
			throw new InvalidArgumentException('country is empty');
		}
		
		$this->_country = $country;
		$this->_api_url = 'https://'.$this->_country.'.pllano.com/api/v1/json/';
		
	}

	/**
	* API get
	*
	* @param array $params
	* @param string $action
	* @param string $uid
	*
	* @return array
	*/
	public function get($params = array(), $action, $uid = null)
	{
		
		if(!isset($params['public_key'])){
			throw new InvalidArgumentException('public_key is empty');
		}
		
		$real_uid = (isset($uid)) ? '/'.$uid : '';
		$url = $this->_api_url . $action . $real_uid;
		
		if(isset($uid)) {
			$query = $url . "?public_key=".$params['public_key'];
		} else {
			$get_array = http_build_query($params);
			$query = $url . $get_array;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $query);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		$server_output = curl_exec($ch);
		// $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		// $server_output = file_get_contents($query); // Альтернативный метод получения информации
		
		return json_decode($server_output);

	}
	
	/**
	* API post
	*
	* @param string $action
	* @param array $params
	*
	* @return array
	*/
	public function post($params = array(), $action, $uid = null)
	{
		if(!isset($params['public_key'])){
			throw new InvalidArgumentException('public_key is null');
		}

		$url = $this->_api_url . $action;
		$post_array = http_build_query($params);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		$server_output = curl_exec($ch);
		// $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		return json_decode($server_output);
		
	}

	/**
	* API put
	*
	* @param string $action
	* @param array $params
	*
	* @return array
	*/
	public function put($params = array(), $action, $uid = null)
	{

		if(!isset($params['public_key'])){
			throw new InvalidArgumentException('public_key is empty');
		}
		
		$real_uid = (isset($uid)) ? '/'.$uid : '';
		$url = $this->_api_url . $action . $real_uid;
		
		$post_array = http_build_query($params);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 1);
		// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // no need anymore
		// or
		// curl_setopt($ch, CURLOPT_PUT, 1); // no need anymore
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json', 'X-HTTP-Method-Override: PUT'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		$server_output = curl_exec($ch);
		// $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		return json_decode($server_output);
		
	}

	/**
	* API delete
	*
	* @param string $action
	* @param array $params
	*
	* @return array
	*/
	public function delete($params = array(), $action, $uid = null)
	{

		if(!isset($params['public_key'])){
			throw new InvalidArgumentException('public_key is empty');
		}
		
		if(isset($uid)) {
			$query = $url . "?public_key=".$params['public_key'];
		} else {
			$get_array = http_build_query($params);
			$query = $url . $get_array;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $query);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		$server_output = curl_exec($ch);
		// $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		
		// $server_output = file_get_contents($query); // Альтернативный метод получения информации
		
		return json_decode($server_output);
		
	}

}
