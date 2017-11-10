<?php
/**
*	This file is part of the REST API PLLANO library
*
*	@license http://opensource.org/licenses/MIT
*	@link https://github.com/pllano/api/
*	@version 1.0
*	@package pllano.api
*
*	For the full copyright and license information, please view the LICENSE
*	file that was distributed with this source code.
*/

//	Включить вывод ошибок
//	ini_set('error_reporting', E_ALL);
//	ini_set('display_errors', 1);
//	ini_set('display_startup_errors', 1);

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
	public function get($params = array(), $action, $metod = null, $uid = null)
	{
		
		if(!isset($params['public_key'])){
			throw new InvalidArgumentException('public_key is empty');
		}
		
		$metod = (isset($metod)) ? $metod : 'get';
		
		$real_uid = (isset($uid)) ? '/'.$uid : '';
		$url = $this->_api_url .''. $action .''. $real_uid;

		if(isset($uid)) {
			$get_url = $url . "?public_key=".$params['public_key'];
		} else {
			$get_array = http_build_query($params);		
			$get_url = $url .'?'. $get_array;
		}

		if($metod) {
		if($metod == 'curl') {
			$ch = curl_init();
			//	curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
			curl_setopt($ch, CURLOPT_URL, $get_url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
			//	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$output = curl_exec($ch);
			curl_close($ch);
		} else {
			$output = file_get_contents($get);
		}
		}

		for ($i = 0; $i <= 31; ++$i) {
			$output = str_replace(chr($i), "", $output); 
		}
			$output = str_replace(chr(127), "", $output);

		if (0 === strpos(bin2hex($output), 'efbbbf')) {
			$output = substr($output, 3);
		}
	
		$return_array = json_decode($output, true);
 		
		switch (json_last_error()) {
		
        case JSON_ERROR_NONE:
            return $return_array;
        break;
        case JSON_ERROR_DEPTH:
            return 'JSON_ERROR_DEPTH - Достигнута максимальная глубина стека';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            return 'JSON_ERROR_STATE_MISMATCH - Некорректные разряды или не совпадение режимов';
        break;
        case JSON_ERROR_CTRL_CHAR:
            return 'JSON_ERROR_CTRL_CHAR - Некорректный управляющий символ';
        break;
        case JSON_ERROR_SYNTAX:
            return 'JSON_ERROR_SYNTAX - Синтаксическая ошибка, не корректный JSON';
        break;
        case JSON_ERROR_UTF8:
            return 'JSON_ERROR_UTF8 - Некорректные символы UTF-8, возможно неверная кодировка';
        break;
        default:
            return 'Неизвестная ошибка';
        break;
		
		}

	}
	
	/**
	* API post
	*
	* @param string $action
	* @param array $params
	*
	* @return array
	*/
	public function post($params = array(), $action, $metod = null, $uid = null)
	{
		if(!isset($params['public_key'])){
			throw new InvalidArgumentException('public_key is null');
		}

		$url = $this->_api_url . $action;
		$post_array = http_build_query($params);

		$ch = curl_init();
		//	curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		$output = curl_exec($ch);
		//	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		for ($i = 0; $i <= 31; ++$i) {
			$output = str_replace(chr($i), "", $output); 
		}
			$output = str_replace(chr(127), "", $output);

		if (0 === strpos(bin2hex($output), 'efbbbf')) {
			$output = substr($output, 3);
		}
	
		$return_array = json_decode($output, true);
 		
		switch (json_last_error()) {
		
        case JSON_ERROR_NONE:
            return $return_array;
        break;
        case JSON_ERROR_DEPTH:
            return 'JSON_ERROR_DEPTH - Достигнута максимальная глубина стека';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            return 'JSON_ERROR_STATE_MISMATCH - Некорректные разряды или не совпадение режимов';
        break;
        case JSON_ERROR_CTRL_CHAR:
            return 'JSON_ERROR_CTRL_CHAR - Некорректный управляющий символ';
        break;
        case JSON_ERROR_SYNTAX:
            return 'JSON_ERROR_SYNTAX - Синтаксическая ошибка, не корректный JSON';
        break;
        case JSON_ERROR_UTF8:
            return 'JSON_ERROR_UTF8 - Некорректные символы UTF-8, возможно неверная кодировка';
        break;
        default:
            return 'Неизвестная ошибка';
        break;
		
		}
		
	}

	/**
	* API put
	*
	* @param string $action
	* @param array $params
	*
	* @return array
	*/
	public function put($params = array(), $action, $metod = null, $uid = null)
	{

		if(!isset($params['public_key'])){
			throw new InvalidArgumentException('public_key is empty');
		}
		
		$real_uid = (isset($uid)) ? '/'.$uid : '';
		$url = $this->_api_url . $action . $real_uid;
		
		$post_array = http_build_query($params);

		$ch = curl_init();
		// curl_setopt($ch, CURLOPT_HEADER, 1);
		// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // no need anymore
		// or
		// curl_setopt($ch, CURLOPT_PUT, 1); // no need anymore
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json', 'X-HTTP-Method-Override: PUT'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_array);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		$output = curl_exec($ch);
		// $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		for ($i = 0; $i <= 31; ++$i) {
			$output = str_replace(chr($i), "", $output); 
		}
			$output = str_replace(chr(127), "", $output);

		if (0 === strpos(bin2hex($output), 'efbbbf')) {
			$output = substr($output, 3);
		}
	
		$return_array = json_decode($output, true);
 		
		switch (json_last_error()) {
		
        case JSON_ERROR_NONE:
            return $return_array;
        break;
        case JSON_ERROR_DEPTH:
            return 'JSON_ERROR_DEPTH - Достигнута максимальная глубина стека';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            return 'JSON_ERROR_STATE_MISMATCH - Некорректные разряды или не совпадение режимов';
        break;
        case JSON_ERROR_CTRL_CHAR:
            return 'JSON_ERROR_CTRL_CHAR - Некорректный управляющий символ';
        break;
        case JSON_ERROR_SYNTAX:
            return 'JSON_ERROR_SYNTAX - Синтаксическая ошибка, не корректный JSON';
        break;
        case JSON_ERROR_UTF8:
            return 'JSON_ERROR_UTF8 - Некорректные символы UTF-8, возможно неверная кодировка';
        break;
        default:
            return 'Неизвестная ошибка';
        break;
		
		}
		
	}

	/**
	* API delete
	*
	* @param string $action
	* @param array $params
	*
	* @return array
	*/
	public function delete($params = array(), $action, $metod = null, $uid = null)
	{

		if(!isset($params['public_key'])){
			throw new InvalidArgumentException('public_key is empty');
		}
		
		if(isset($uid)) {
			$delete_url = $url . "?public_key=".$params['public_key'];
		} else {
			$delete_array = http_build_query($params);
			$delete_url = $url . $delete_array;
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $delete_url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		$output = curl_exec($ch);
		// $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		for ($i = 0; $i <= 31; ++$i) {
			$output = str_replace(chr($i), "", $output); 
		}
			$output = str_replace(chr(127), "", $output);

		if (0 === strpos(bin2hex($output), 'efbbbf')) {
			$output = substr($output, 3);
		}
	
		$return_array = json_decode($output, true);
 		
		switch (json_last_error()) {
		
        case JSON_ERROR_NONE:
            return $return_array;
        break;
        case JSON_ERROR_DEPTH:
            return 'JSON_ERROR_DEPTH - Достигнута максимальная глубина стека';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            return 'JSON_ERROR_STATE_MISMATCH - Некорректные разряды или не совпадение режимов';
        break;
        case JSON_ERROR_CTRL_CHAR:
            return 'JSON_ERROR_CTRL_CHAR - Некорректный управляющий символ';
        break;
        case JSON_ERROR_SYNTAX:
            return 'JSON_ERROR_SYNTAX - Синтаксическая ошибка, не корректный JSON';
        break;
        case JSON_ERROR_UTF8:
            return 'JSON_ERROR_UTF8 - Некорректные символы UTF-8, возможно неверная кодировка';
        break;
        default:
            return 'Неизвестная ошибка';
        break;
		
		}
		
	}

}
