<?php
/**AO™ Library is a vanilla and evolving framework for developing websites, applications, and APIs using web technology.
 * Originator: Anthony O. Osawere - @iamodao - www.osawere.com  © 2020 | Apache License
 * ============================================================================================
 * oCurrency ~ Summary of Class • DEPENDENCY»
 */
class oCurrency {
	//DATABASE • Currency Database
	public static function database(){
		$o = array(
			'NGN' => array('iSign' => '₦', 'iCountry' => 'Nigeria', 'iCurrency' => 'Naira'),
			'USD' => array('iSign' => '$', 'iCountry' => 'United States', 'iCurrency' => 'Dollar'),
			'GBP' => array('iSign' => '£', 'iCountry' => 'United Kingdom', 'iCurrency' => 'Pound'),
			'EUR' => array('iSign' => '€', 'iCountry' => 'Europe', 'iCurrency' => 'Euro'),
			'JPY' => array('iSign' => '¥', 'iCountry' => 'Japan', 'iCurrency' => 'Yen'),
			'INR' => array('iSign' => '₹', 'iCountry' => 'India', 'iCurrency' => 'Rupee'),
		);
		return $o;
	}





	//TO • RETURN - CURRENCY/SYMBOL/COUNTRY
	public static function to($code, $i='iData'){
		$database = self::database();
		if(array_key_exists($code, $database)){
			$currency = $database[$code];
			if(!empty($currency[$i])){return $currency[$i];}
			elseif($i == 'iData'){
				$currency['iCode'] = $code;
				return $currency;
			}
		}
		return false;
	}
} // EndOfClass - oCurrency