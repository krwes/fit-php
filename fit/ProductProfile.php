<?php
namespace Fit;
/**
 * @author Karel Wesseling <karel@swc.nl>
 * @version 1.0
 * @copyright (c) 2013, Karel Wesseling
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @package Fit
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of 
 * this software and associated documentation files (the "Software"), to deal in the 
 * Software without restriction, including without limitation the rights to use, copy, 
 * modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, 
 * and to permit persons to whom the Software is furnished to do so, subject to the 
 * following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all 
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS 
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR 
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER 
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION 
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

/**
 * A class that provides access to the product's profile. A profile consists of 
 * a number of file types.
 * Every file type consist of a number of message types.
 * Every message consists of a number of field types.
 */
class ProductProfile {
	
	const DEFAULT_PROTOCOL	= 16;
	const DEFAULT_PROFILE	= 511;
	
	public $product_profiles = array(
		//protocol_version
		16 => array(
			//profile_version
			511 => array(
				'description' => 'Version 511 of the default product profile.',
				'definition_files' => array(
					//these files are looked up in ./fit_file_types/protocol_16/profile_511
					'device',
//					'settings',
//					'sport_settings',
//					'blood_pressure',
//					'weight',
//					'sport_settings',
//					'blood_pressure',
//					'weight',
					'workout',
					'activity',
				),
			),
		),
	);
	
	protected $protocol_version;
	protected $profile_version;
	protected $definition;

	public function __construct(
		$protocol	= self::DEFAULT_PROTOCOL, 
		$version	= self::DEFAULT_PROFILE
	) {
		$this->setProtocolAndProfile($protocol, $version);
	}
	
	/**
	 * @return int The currently used protocol.
	 */
	public function protocol_version() {
		return $this->protocol_version;
	}
	
	/**
	 * 
	 * @return int The currently used profile.
	 */
	public function profile_version() {
		return $this->profile_version;
	}
	
	/**
	 * Returns the full definition of the current product profile.
	 * @return mixed[]
	 */
	public function definition() {
		return $this->definition;
	}
	
	
	/**
	 * @param int		$filetype
	 * @param int		$global_msg_no
	 * @param int		$field_def_number
	 * @return mixed[]	Definition of the field or false when not found. 
	 */
	public function findFieldDefinition($filetype, $global_msg_no, $field_def_number) {
		foreach($this->definition as $fitfiletype) {
			if ($fitfiletype['type'] === (int)$filetype) {
				foreach($fitfiletype['messages'] as $msg) {
					if ($msg['global_msg_number'] === (int)$global_msg_no) {
						foreach($msg['fields'] as $def) {
							if ($def[\Fit\Field::DEF_NUMBER] === (int)$field_def_number) {
								return $def;
							}
						}
					}
				}
				
			}
		}
		return false;
	}

	public function findFieldDefByName($file_type_def, $msg_name) {
		foreach($file_type_def['messages'] as $local_msg_type => $msg) {
			if ($msg['name'] === (string)$msg_name) {
				$msg['local_msg_type'] = $local_msg_type;
				return $msg;
			}
		}
		return null;
	}
	
	/**
	 * Find the message type by name
	 * ie. activity, device, workout, etc
	 * @param string $name
	 * @return mixed[] or null when not found
	 */
	public function findFileTypeByName($name) {
		if (
			is_string($name) &&
			array_key_exists($name, $this->definition)
		) {
			return $this->definition[$name];
		}
		return null;
	}
	
	/**
	 * Find the message type by name
	 * ie. activity, device, workout, etc
	 * @param string $name
	 * @return mixed[] or null when not found
	 */
	public function findFileTypeByType($type) {
		$ref = new \ReflectionClass('\Fit\FileType');
		$constants = $ref->getConstants();
		return $this->findFileTypeByName(array_search($type, $constants));
	}
	
	/**
	 * 
	 * @param int		$protocol
	 * @param int		$profile
	 * @return boolean  True when name and version are valid, false when not.
	 */
	public function setProtocolAndProfile($protocol, $profile) {
		if (
			array_key_exists((int)$protocol, $this->product_profiles) &&
			array_key_exists((int)$profile, $this->product_profiles[$protocol])
		) {
			$this->protocol_version	= (int)$protocol;
			$this->profile_version	= (int)$profile;
			$this->definition		= array();
			foreach($this->product_profiles[$protocol][$profile]['definition_files'] as $filename) {
				$this->definition[$filename] = require __DIR__.'/fit_file_types/protocol_'.$this->protocol_version.'/profile_'.$this->profile_version.'/'.$filename.'.php';
			}
			return true;
		}
		return false;
	}
	
}
