<?php
namespace Fit;
require_once __DIR__.'/Enums.php';
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
 * Class \Fit\Data
 * Helper class to generate well-formed data that can be written by the 
 * \Fit\Writer class.
 *
 * @example examples/write_and_read_fit_data.php How to use this class
 * @uses \Zend_Io_Reader Binary file parser
 */
class Data {
	
	private $_store = array();
	private $_filetype;
	
	/**
	 * Add a message to the datastore.
	 * @param string $msg_name
	 * @param array $msg_data
	 * @return \Fit\Data
	 * @throws \Fit\DataException
	 */
	public function add($msg_name, array $msg_data) {
		if ($this->_filetype === null) {
			throw new \Fit\DataException('FileType not set, use ->setFile($type) before adding messages.');
		}
		$msg_name	= (string)$msg_name;
		$msg_found	= false;
		$no_msgs	= count($this->_store[$this->_filetype]);
		if ($no_msgs > 0) {
			$last	= $this->_store[$this->_filetype][$no_msgs - 1];
			if ($last['name'] === $msg_name) {
				$this->_store[$this->_filetype][$no_msgs - 1]['data'][] = $msg_data;
				$msg_found = true;
			}
		}
		if (false === $msg_found) {
			$this->_store[$this->_filetype][] = array(
				'name' => $msg_name,
				'data' => array(
					$msg_data
				),
			);
		}
		return $this;
	}
	
	public function getData() {
		return $this->_store;
	}
	
	/**
	 * Set the filetype for the upcoming messages.
	 * @param enum \Fit\FileType $type
	 * @return bool True when a known filetype was set, false when not found.
	 */
	public function setFile($type) {
		$ref = new \ReflectionClass('\Fit\FileType');
		$constants = $ref->getConstants();
		if (array_search($type, $constants) !== false) {
			$this->_filetype = (int)$type;
			$this->_store[$this->_filetype] = array();
			return true;
		}
		$this->_filetype = null;
		return false;
	}
	
}
class DataException extends \Exception {}
