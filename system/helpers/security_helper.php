<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2019 - 2022, CodeIgniter Foundation
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @copyright	Copyright (c) 2019 - 2022, CodeIgniter Foundation (https://codeigniter.com/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Security Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/userguide3/helpers/security_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('xss_clean'))
{
	/**
	 * XSS Filtering
	 *
	 * @param	string
	 * @param	bool	whether or not the content is an image file
	 * @return	string
	 */
	function xss_clean($str, $is_image = FALSE)
	{
		return get_instance()->security->xss_clean($str, $is_image);
	}
}

// ------------------------------------------------------------------------


if ( ! function_exists('en'))
{
	 function en($text, $static = false, $length=5)
	{
		//echo $text;echo '<br>';
		if(!empty($text)){
		$charset = file_get_contents(dirname(__FILE__)."/../libraries/Security/char.be3");
		$encode = file_get_contents(dirname(__FILE__)."/../libraries/Security/fai.be3");
		$char = explode('| ', $charset);
		//echo count($char);
		$char[] = '|';
		$char[] = ' ';
		
		$myFile = dirname(__FILE__)."/../libraries/Security/fai.be3";
		$lines = file($myFile); //file in to an array

		
		if ($static == true) {

			is_numeric(str_split($text)[0]) ?
			$number_en   = str_split($text)[0] :
			$number_en   = array_search(strtolower(str_split(strip_tags($text))[0]), str_split('abcdefghijklmnopqrstuvwxyz1234567890 <>'));;
			
			$split_en   = str_split($lines[$number_en+1], $length);
			
		} else {
			$number_en = rand(1, 50);
			$split_en   = str_split($lines[$number_en], $length);
		} 
		
		$text = preg_replace("/\r/", "carlin", $text);
		$text = preg_replace("/\n/", "newlin", $text);
		$text = preg_replace("/\t/", "extab", $text);
		$text = preg_replace("/\a/", "alert", $text);
		
		$split_text = str_split($text);

		
		$alphabetic = $char;
// and $split_en[$i]
		for ($i = 0; $i < count($alphabetic) - 1; $i++) {
			if(isset($alphabetic[$i]) and isset($split_en[$i])){
						
				$en[trim($alphabetic[$i])] = $split_en[$i];
			}
		}
		//$en[' '] = $split_en[$i];
		//$en[chr(13)] = $split_en[$i + 1];
		
		$encrypt = "";
		for ($x = 0; $x < count($split_text); $x++) {

			
			if (isset($en[$split_text[$x]]))
				$encrypt .= $en[$split_text[$x]];
		}

		$r = explode('H', $lines[0])[$number_en] . 'H' . $encrypt;
		
		return $r;
		
	}else{
		return '';
	}
	}
}
if ( ! function_exists('de'))
{
	 function de($string, $length=5)
	{
		if($string){
		$charset = file_get_contents(dirname(__FILE__)."/../libraries/Security/char.be3");
		//$encode = file_get_contents(base_url("be3System/fai.php"));
		//echo $string;
		$char = explode('| ', $charset);
		$char[] = '|';
		$char[] = ' ';

		$myFile = base_url("assets/dist/index.php?i=" . time());
		$lines = file($myFile); //file in to an array

		//$string = $text;
		if(isset(explode('H', $string)[1])){
		$split_text = str_split(explode('H', $string)[1], $length);
		
		
		$split_en   = str_split($lines[array_search(explode('H', $string)[0], explode('H', $lines[0]))], $length);
		$alphabetic = $char;
		$decrypt    = "";
		//print_r($split_en);

		//print_r($de);
		for ($x = 0; $x < count($split_text); $x++) {
			$de = $alphabetic[array_search($split_text[$x], $split_en)];
			if (isset($de)) {
				//echo ''.$split_text[$x].'<br>';
				if ($split_text[$x] == "8dasg") {
					$decrypt .= " ";
				} else if ($split_text[$x] == "\n") {
					$decrypt .= " ";
				} else {

					$decrypt .= trim($de);
				}
			} else {
				$decrypt .= $split_text[$x];
			}
			//echo $decrypt;
		}
		$decrypt = str_replace("carlin", "\r", $decrypt);
		$decrypt = str_replace("newlin", "\n", $decrypt);
		$decrypt = str_replace("extab", "\t", $decrypt);
		$decrypt = str_replace("alert ", "\a", $decrypt);
		//echo $decrypt;
		return nl2br($decrypt);
	}else{
		return $string;
	}
		}else{
			return '';
		}
	}
	
}

// ------------------------------------------------------------------------

if ( ! function_exists('sanitize_filename'))
{
	/**
	 * Sanitize Filename
	 *
	 * @param	string
	 * @return	string
	 */
	function sanitize_filename($filename)
	{
		return get_instance()->security->sanitize_filename($filename);
	}
}

// --------------------------------------------------------------------

if ( ! function_exists('do_hash'))
{
	/**
	 * Hash encode a string
	 *
	 * @todo	Remove in version 3.1+.
	 * @deprecated	3.0.0	Use PHP's native hash() instead.
	 * @param	string	$str
	 * @param	string	$type = 'sha1'
	 * @return	string
	 */
	function do_hash($str, $type = 'sha1')
	{
		if ( ! in_array(strtolower($type), hash_algos()))
		{
			$type = 'md5';
		}

		return hash($type, $str);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('strip_image_tags'))
{
	/**
	 * Strip Image Tags
	 *
	 * @param	string
	 * @return	string
	 */
	function strip_image_tags($str)
	{
		return get_instance()->security->strip_image_tags($str);
	}
}

// ------------------------------------------------------------------------

if ( ! function_exists('encode_php_tags'))
{
	/**
	 * Convert PHP tags to entities
	 *
	 * @param	string
	 * @return	string
	 */
	function encode_php_tags($str)
	{
		return str_replace(array('<?', '?>'), array('&lt;?', '?&gt;'), $str);
	}
}
