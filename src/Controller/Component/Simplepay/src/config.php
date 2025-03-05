<?php
/**
 *  Copyright (C) 2024 OTP Mobil Kft.
 *
 *  PHP version 8.3
 *
 *  This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  SDK
 * @package   SimplePayV2
 * @author    SimplePay IT Support <itsupport@otpmobil.com>
 * @copyright 2024 OTP Mobil Kft.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html  GNU GENERAL PUBLIC LICENSE (GPL V3.0)
 * @link      http://simplepartner.hu/online_fizetesi_szolgaltatas.html
 */
 
use Cake\Core\Configure;

$simplePayConfig = [
	'SANDBOX' 			=> Configure::read('Simplepay.SANDBOX'),
	'HUF_MERCHANT' 		=> Configure::read('Simplepay.HUF_MERCHANT'),	// "OMS51091901"
	'HUF_SECRET_KEY' 	=> Configure::read('Simplepay.HUF_SECRET_KEY'),	// "T0Bf2b7xj1L6L57z0323XuX7X2Z7uu8g"
	'URL'				=> Configure::read('Simplepay.URL'),
	'GET_DATA'			=> Configure::read('Simplepay.GET_DATA'),
	'POST_DATA'			=> Configure::read('Simplepay.POST_DATA'),
	'SERVER_DATA'		=> Configure::read('Simplepay.SERVER_DATA'),
	'LOG_PATH'			=> Configure::read('Simplepay.LOG_PATH'),
];

$config = [
    'SANDBOX' 			=> $simplePayConfig['SANDBOX'] ?? true,
	
    //HUF
    'HUF_MERCHANT' 		=> $simplePayConfig['HUF_MERCHANT'] ?? "OMS51091901",       					//merchant account ID (HUF)
    'HUF_SECRET_KEY' 	=> $simplePayConfig['HUF_SECRET_KEY'] ?? "T0Bf2b7xj1L6L57z0323XuX7X2Z7uu8g",	//secret key for account ID (HUF)

    //EUR
    'EUR_MERCHANT' 		=> "",            										//merchant account ID (EUR)
    'EUR_SECRET_KEY' 	=> "",          										//secret key for account ID (EUR)

    //USD
    'USD_MERCHANT' 		=> "",            										//merchant account ID (USD)
    'USD_SECRET_KEY' 	=> "",          										//secret key for account ID (USD)


    //common return URL
	'URL' 				=> $simplePayConfig['URL'] ?? $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/hu/simplepay/back',

    //optional uniq URL for events
    /*
    'URLS_SUCCESS' => 'http://' . $_SERVER['HTTP_HOST'] . '/success.php',       //url for successful payment
    'URLS_FAIL' => 'http://' . $_SERVER['HTTP_HOST'] . '/fail.php',             //url for unsuccessful
    'URLS_CANCEL' => 'http://' . $_SERVER['HTTP_HOST'] . '/cancel.php',         //url for cancell on payment page
    'URLS_TIMEOUT' => 'http://' . $_SERVER['HTTP_HOST'] . '/timeout.php',       //url for payment page timeout
    */

    'GET_DATA' 			=> $simplePayConfig['GET_DATA'] ?? (isset($_GET['r']) && isset($_GET['s'])) ? ['r' => $_GET['r'], 's' => $_GET['s']] : [],
    'POST_DATA' 		=> $simplePayConfig['POST_DATA'] ?? $_POST,
    'SERVER_DATA' 		=> $simplePayConfig['SERVER_DATA'] ?? $_SERVER,

    'LOGGER' 			=> true,                             					//basic transaction log
    //'LOG_PATH' => 'log',                          							//path of log file
	
	'LOG_PATH' 			=> $simplePayConfig['LOG_PATH'] ?? '/var/www/saghysat/logs/simplepay/',                           //path of log file

    //3DS
    'AUTOCHALLENGE' 	=> false,                      							//in case of unsuccessful payment with registered card run automatic challange
];

if($config["SANDBOX"]){
	$config["HUF_MERCHANT"] 	= "PUBLICTESTHUF";								//merchant account ID (HUF)
	$config["HUF_SECRET_KEY"] 	= "FxDa5w314kLlNseq2sKuVwaqZshZT5d6";			//secret key for account ID (HUF)

	//$config["EUR_MERCHANT"] 	= "PUBLICTESTHUF";								//merchant account ID (EUR)
	//$config["EUR_SECRET_KEY"] 	= "FxDa5w314kLlNseq2sKuVwaqZshZT5d6";		//secret key for account ID (EUR)
	//
	//$config["USD_MERCHANT"] 	= "PUBLICTESTUSD";								//merchant account ID (USD)
	//$config["USD_SECRET_KEY"] 	= "Aa9cDbHc1i2lLmN4z3C542zjXqZiDiCj";		//secret key for account ID (USD)
}
